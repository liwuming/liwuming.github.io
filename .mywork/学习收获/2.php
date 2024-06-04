<?php
/**
 * 用于检测业务代码死循环或者长时间阻塞等问题
 * 如果发现业务卡死，可以将下面declare打开（去掉//注释），并执行php start.php reload
 * 然后观察一段时间workerman.log看是否有process_timeout异常
 */
//declare(ticks=1);
use \GatewayWorker\Lib\Gateway;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

//require __DIR__.'/Api.php';

/**
 * 主逻辑
 * 主要是处理 onConnect onMessage onClose 三个方法
 * onConnect 和 onClose 如果不需要可以不用实现并删除
 */
class Events {
  protected static $db = null;
  protected static $days = 0;
  protected static $expire = 1800;
  /*接收消息者*/
  protected static $packages = [];
  protected static $domain = "http://static.ibiancheng.net";
  protected static $upload_path = root_path . '/uploads';
  // protected static $device_file_path = null;

  //当businessWorker进程启动时触发。每个进程生命周期内都只会触发一次。
  public static function onWorkerStart( $businessWorker ) {
    self::$db = new \Workerman\MySQL\Connection( CONFIG['host'], CONFIG['port'], CONFIG['user'], CONFIG['password'], CONFIG['dbname'] );
  }

  /**
   * 当客户端发来消息时触发
   * @param int $clientId 连接id
   * @param mixed $message 具体消息
   */
  //static $clients=array();
  public static function onMessage( $clientId, $message ) {
    $unixtime = time();

    $table_name = prefix . 'devices';
    $table_devices = prefix . 'devices';
    $table_request = prefix . 'request';
    $table_response = prefix . 'response';

    echo PHP_EOL . PHP_EOL . $message;
    echo PHP_EOL . PHP_EOL . 'start:' . $message[0] . '---' . substr( $message, -1 );

    if ( $message[0] == '[' && substr( $message, -1 ) == ']' ) {
      $logs = file_get_contents( './log.txt' );

      $logs .= PHP_EOL . $message;
      file_put_contents( './log.txt', $logs );
      $reg = '/\[(\w{2})\*(\d{10})\*([0-9abcdef]{4})\*([^*\[\]]+)\]/i';
      preg_match_all( $reg, $message, $match_result );

      if ( empty( $match_result ) ) {
        $error_log_path = __DIR__ . '/error.log';
        $error_logs = file_get_contents( $error_log_path );
        $error_logs .= PHP_EOL . $message;
        file_put_contents( $error_log_path, $error_logs );
      } else {
        //self::$uid = $deviceinfo['id'];
        //echo PHP_EOL.PHP_EOL.$deviceSN.'--'.$deviceinfo['id'].PHP_EOL.PHP_EOL;
        /*
        if(file_exists(self::$device_file_path)){
            $contents = file_get_contents(self::$device_file_path);
            if(!empty($contents)){
                $cache_data = json_decode($contents,true);

                if(!empty($cache_data['heart_rate'])){
                    if($cache_data['clientId'] != $clientId){
                        $cache_data['heart_rate'] = null;
                    }
                }
            }
        }else{
            // $deviceinfo = self::$db->select('customer_id,pedometer_state,pedometer_start,pedometer_end')->from(prefix.'customer')->where('deviceid='.$deviceSN)->row();
            // $cache_data = array(
            //     'id'=>(int)$deviceinfo['customer_id'],
            //     'deviceid'=>$deviceSN,
            //     'pedometer_state'=>$deviceinfo['pedometer_state'],
            //     'pedometer_start'=>$deviceinfo['pedometer_start'],
            //     'pedometer_end'=>$deviceinfo['pedometer_end'],
            //     'heart_rate'=>null,
            // );
        }*/


        $table_setting_logs = prefix . 'setting_logs';
        foreach ( $match_result[0] as $key => $response ) {
          $deviceSN = $match_result[2][$key];
          self::$days = self::getdays();
          $fields = 'id,device_sn,state,electricity,sport_steps,heart_rate_min,heart_rate_max,sport_state,sport1_start,sport1_end,sport2_start,sport2_end,sport3_start,sport3_end';
          $deviceinfo = self::$db->select( $fields )->from( $table_name )->where( "device_sn='{$deviceSN}'" )->row();
          Gateway::bindUid( $clientId, $deviceinfo['id'] );

          $parse_one = explode( '*', substr( $response, 1, -1 ) );
          //$deviceid = $parse_one[1];
          // self::$device_file_path = self::$device_path.$deviceSN;
          $parse_two = explode( ',', $parse_one[3] );
          $stype = strtoupper( $parse_two[0] );

          echo PHP_EOL . "--UPLOAD----------{$stype}---------{$message}----{$response}";
          // echo PHP_EOL.$message.PHP_EOL;
          // var_dump($parse_two);
          // if($stype=='TK'){
          //     var_dump($parse_two);
          //     if($parse_two[1]){
          //         $nums=file_put_contents(__DIR__.'/cache/'.$unixtime.'.txt',$message);
          //         echo PHP_EOL.'---TK--'.$num;  
          //     }else{
          //         echo PHP_EOL.'=======================TK-404';
          //     }
          // }else{
          //     echo 121;
          // }

          if ( $stype == 'TK' ) {
            $row_data = array(
              'deviceid' => $deviceSN,
              'stype' => $stype,
              'contents' => $parse_one[3],
              'parse' => '',
              'response' => bin2hex( $parse_two[1] ),
              'state' => 1,
              'days' => self::$days,
              'unixtime' => $unixtime,
              'addtime' => date( 'Y-m-d H:i:s', $unixtime )
            );
            echo PHP_EOL . '============xxxxxxxxxxxxxxxx===================';
            var_dump( $row_data );
            //self::$db->insert(prefix.'response')->cols($row_data)->query();
          } else {
            $row_data = array(
              'deviceid' => $deviceSN,
              'stype' => $stype,
              'contents' => $parse_one[3],
              'parse' => json_encode( $parse_one ),
              'response' => $message,
              'state' => 1,
              'days' => self::$days,
              'unixtime' => $unixtime,
              'addtime' => date( 'Y-m-d H:i:s', $unixtime )
            );
            self::$db->insert( prefix . 'response' )->cols( $row_data )->query();
          }

          //$cache_data['clientId'] = $clientId;
          //$cache_data['expire'] = $unixtime+self::$expire;
          //self::$deviceInfo = $cache_data;
          /*
              处理平台自动回复
          */
          $action = self::getaction( $stype );
          switch ($stype) {
            //心跳包
            case 'LK':
              try {
                /*判断计步开关--是否开启了计步器，进行计步处理*/
                if ( count( $parse_two ) > 1 ) {
                  /*步数,翻滚次数,电量百分数*/
                  $step = $parse_two[1] - $deviceinfo['sport_steps'];
                  $data1 = array(
                    'electricity' => $parse_two[3],
                    'activetime1' => $unixtime,
                    'activedays1' => self::$days
                  );
                  if ( $step > 0 ) {
                    $data1['sport_steps'] = $parse_two[1];
                  } else if ( $step < 0 ) {
                    $data1['sport_steps'] = 0;
                  }

                  echo 'saaa--' . $deviceinfo['id'];
                  self::$db->update( $table_devices )->cols( $data1 )->where( "id={$deviceinfo['id']}" )->query();
                  //self::success($item,'操作成功');

                  //判断是否开启了计步开关
                  if ( empty( $deviceinfo['sport_state'] ) ) {
                    $table_healthy_sport_logs = prefix . 'healthy_sport_logs';
                    /*
                    $checked = false;
                    $unixtime = time();
                    $today = date('Y-m-d',$unixtime);
                    $sport1_start = strtotime($today.' '.$device_info['sport1_start'].':00');
                    $sport1_end = strtotime($today.' '.$device_info['sport1_end'].':00');
        
                    $sport2_start = strtotime($today.' '.$device_info['sport2_start'].':00');
                    $sport2_end = strtotime($today.' '.$device_info['sport2_end'].':00');
                    
                    $sport3_start = strtotime($today.' '.$device_info['sport3_start'].':00');
                    $sport3_end = strtotime($today.' '.$device_info['sport3_end'].':00');
        
                    if($unixtime>=$sport1_start && $unixtime<=$sport1_end){
                        $checked = true;
                    }else if($unixtime>=$sport2_start && $unixtime<=$sport2_end){
                        $checked = true;
                    }else if($unixtime>=$sport3_start && $unixtime<=$sport3_end){
                        $checked = true;
                    }
                    */
                    // if($checked==true){
                    $days = self::getdays();
                    $rowinfo = self::$db->select( 'id' )->from( $table_healthy_sport_logs )->where( "uid={$deviceinfo['id']} and days={$days}" )->row();

                    if ( empty( $rowinfo ) ) {
                      $data = array(
                        'days' => self::$days,
                        'steps' => $step > 0 ? $step : 0,
                        'unixtime' => $unixtime,
                        'addtime' => date( 'Y-m-d H:i:s', $unixtime ),
                        'deviceid' => $deviceSN,
                        'uid' => $deviceinfo['id'],
                      );
                      $fk_id = self::$db->insert( $table_healthy_sport_logs )->cols( $data )->query();

                      if ( $fk_id > 0 ) {
                        echo PHP_EOL . PHP_EOL . '--lk--success-1111';
                      } else {
                        echo PHP_EOL . PHP_EOL . '--lk--error-2222';
                      }
                    } else if ( $step > 0 ) {
                      $sql = "UPDATE `{$table_healthy_sport_logs}` SET `steps` = steps+{$step} WHERE id={$rowinfo['id']}";
                      // $rows = self::$db->update($table_healthy_sport_logs)->cols(array('steps'=>''+$parse_two[1]))->where('id='.$rowinfo['id'])->query();
                      $rows = self::$db->query( $sql );
                      if ( $rows > 0 ) {
                        echo PHP_EOL . PHP_EOL . '--lk--success-333';
                      } else {
                        echo PHP_EOL . PHP_EOL . '--lk--error-444';
                      }
                    }
                    // }
                  } else {
                    echo PHP_EOL . PHP_EOL . '--lk--运动开关关闭';
                  }
                  //  && 
                  // //步数,翻滚次数,电量百分数
                  // Api::sports(self::$db,$deviceinfo,$parse_two[1]);

                  // ]
                  // 实例:[SG*8800000015*000D*LK,50,100,100]
                }
              } catch ( \Exception $e ) {
                var_dump( $e->getMessage() );
                self::error_log( $deviceinfo, $e->getMessage() );
                echo PHP_EOL . PHP_EOL . '--LK--exception';
              } finally {
                self::send1( $deviceinfo, 'lk' );
              }
              break;
            case 'TK':
              $contents = file_get_contents( __DIR__ . '/1.txt' );
              echo PHP_EOL . 'xxxxxxxxxxxxxxxxx-----------' . PHP_EOL . '======TKTKTKTK=============' . $contents;
              $parse_one = explode( '*', substr( $contents, 1, -1 ) );

              echo PHP_EOL . '==========TK===========';
              var_dump( $parse_one );
              $parse_two = explode( ',', $parse_one[3] );
              $stype = strtoupper( $parse_two[0] );
              var_dump( $parse_two );
              $file_name = $unixtime . mt_rand( 1000, 9999 );

              echo PHP_EOL . '==========TK===========';
              var_dump( $parse_two );
              $upload_path = self::$upload_path . '/cache/' . date( 'Ymd', $unixtime );
              if ( !file_exists( $upload_path ) ) {
                mkdir( $upload_path, 755, true );
              }

              $file_path = $upload_path . '/' . $file_name . '.amr';
              // echo PHP_EOL.$file_path;
              $nums = file_put_contents( $file_path, $parse_two[1] );
              if ( $nums > 0 ) {
                $output_path = date( 'Ymd', $unixtime );
                if ( !file_exists( self::$upload_path . '/' . $output_path ) ) {
                  mkdir( self::$upload_path . '/' . $output_path, 755, true );
                }

                $file_save_path = '/' . $output_path . '/' . $file_name . '.mp3';
                $process = new Process( ['ffmpeg', '-i', $file_path, self::$upload_path . $file_save_path] );
                $process->run();
                if ( $process->isSuccessful() ) {
                  $process->getOutput();
                  self::send1( $deviceinfo, 'tk,1' );

                  $data = array(
                    'stype' => 1,
                    'voice_src' => self::$domain . $file_save_path,
                    'days' => $days,
                    'unixtime' => $unixtime,
                    'addtime' => date( 'Y-m-d H:i:s', $unixtime ),
                    'device_sn' => self::$deviceid,
                    'uid' => self::$uid
                  );
                  $fk_id = self::$db->insert( prefix . 'chat_message' )->cols( $data )->query();

                  if ( $fk_id > 0 ) {
                    $data['id'] = $fk_id;
                    $result = array(
                      'action' => 1036,
                      'code' => 100,
                      'data' => $data
                    );
                    if ( Gateway::isUidOnline( self::$deviceid ) ) {
                      Gateway::sendToUid( self::$deviceid, json_encode( $result ) );

                      echo PHP_EOL . "TK----isUidOnline---yes";
                    } else {
                      echo PHP_EOL . "TK----isUidOnline---no";
                    }
                  } else {
                    echo PHP_EOL . '---error---sxxx';
                  }
                } else {
                  self::send1( $deviceinfo, 'tk,0' );
                  echo PHP_EOL . 'TK--error--11';
                  throw new ProcessFailedException( $process );
                }
              } else {
                self::send1( $deviceinfo, 'tk,0' );
                echo PHP_EOL . 'TK--error--222';

              }
              /*
              echo PHP_EOL.'TK---------------======================';
              $nums=file_put_contents(__DIR__.'/1.txt',$message);
              echo PHP_EOL."---------------======================".$nums;
              
              return false;
              $message='1111';
              $nums=file_put_contents('./1.txt',$message);
              echo $nums;
              die;
          $hex="";
          echo PHP_EOL."--length--".$parse_two[2];
          for($i=0;$i<strlen($parse_two[2]);$i++){
              $hex.=dechex(ord($parse_two[2][$i]));
          }
          $hex=strtoupper($hex);
            
              self::send1($deviceinfo,'TK,1');
            echo $hex;die;
            */
              break;
            //位置数据包--4G
            case 'UP_LTE':
            case 'UP_WCDMA':
            case 'UP_TDSCDMA':
              //是否开启定位功能
              if ( $parse_two[3] == 'A' ) {
                $table_device_fences = prefix . 'divice_fences';
                $rowinfo = self::$db->select( 'id,sname,lat,lng,radius,state' )->from( $table_device_fences )->where( "uid={$deviceinfo['id']} and state=1 and is_delete=0" )->row();
                if ( !empty( $rowinfo ) ) {
                  /*
                      经纬度用南纬是负，北纬是正，
                      东经是正，西经是负。 
                  */
                  $lat1 = strtoupper( $parse_two[5] ) == 'S' ? -$parse_two[4] : $parse_two[4];
                  $lng1 = strtoupper( $parse_two[7] ) == 'W' ? -$parse_two[6] : $parse_two[6];
                  $lat2 = $rowinfo['lat'];
                  $lng2 = $rowinfo['lng'];
                  $distance = self::getDistance( $lat1, $lng1, $lat2, $lng2 );
                  if ( $distance > $rowinfo['radius'] ) {
                    $data = array(
                      'stype' => 5,
                      'remark' => "检测到超出围栏--{$rowinfo['sname']}",
                      'days' => $days,
                      'unixtime' => $unixtime,
                      'addtime' => date( 'Y-m-d H:i:s', $unixtime ),
                      'deviceid' => self::$deviceid,
                      'uid' => $deviceinfo['id']
                    );
                    self::$db->insert( $table_alarm_msg )->cols( $data )->query();
                  } else {
                    echo PHP_EOL . '在围栏之内';
                  }
                }
              }
              //是否开启计步器
              self::send1( $stype );
              break;
            /*单次测量体温*/
            case 'BODYTEMP2':
              //判断设备是否在线
              if ( Gateway::isUidOnline( self::$deviceid ) ) {
                $data = array(
                  'action' => '1048-one',
                  'code' => 200,
                  'msg' => '收到指令请求'
                );
                echo PHP_EOL . 'BODYTEMP2--on';
                Gateway::sendToUid( self::$deviceid, json_encode( $data ) );
              } else {
                echo PHP_EOL . 'BODYTEMP2--off';
              }
              break;
            /*体温上传*/
            case 'BTEMP2':
              try {
                $table_body_temp_logs = prefix . 'healthy_body_temp_logs';

                $row_data = array(
                  'days' => $days,
                  'temperature' => $parse_two[2],
                  'uid' => $deviceinfo['id'],
                  'deviceid' => $deviceinfo['device_sn'],
                  'unixtime' => $unixtime,
                  'addtime' => date( 'Y-m-d H:i:s', $unixtime ),
                );
                $fk_id = self::$db->insert( $table_body_temp_logs )->cols( $row_data )->query();
                if ( $fk_id > 0 ) {
                  self::success( "1048-two", null, '操作成功' );
                } else {
                  self::error( "1048-two", '操作失败' );
                }
              } catch ( \Exception $e ) {
                var_dump( $e->getMessage() );
                self::error_log( $deviceinfo, $e->getMessage() );
              }
              break;
            /*设置计步信息*/
            case 'PEDO':
              try {
                $stype = 'sport';
                $rowinfo = self::$db->select( 'id,stype3,params,state,unixtime,uid' )->from( $table_setting_logs )->where( "days={$days} and stype2='{$stype}'" )->orderByDesc( array( 'id' ) )->row();
                if ( !empty( $rowinfo ) && !empty( $rowinfo['params'] ) ) {
                  $data = json_decode( $rowinfo['params'], true );
                  switch ((int) $rowinfo['stype3']) {
                    case 1:
                      $rows = self::$db->update( $table_devices )->cols( array( 'sport_state' => $data['sport_state'] ) )->where( "id='{$rowinfo['uid']}'" )->query();
                      if ( $rows > 0 ) {
                        self::$db->update( $table_setting_logs )->cols( array( 'state' => 1 ) )->where( "id={$rowinfo['id']}" )->query();
                        self::success( $action, $data, '操作成功' );
                      } else {
                        echo PHP_EOL . PHP_EOL . "--{$stype}---no";
                        self::error( $action, '操作失败' );
                        return;
                      }
                      break;
                    case 2:
                      if ( !empty( $data['sport_state'] ) )
                        unset($data['sport_state']);
                      $rows = self::$db->update( $table_devices )->cols( $data )->where( "id='{$rowinfo['uid']}'" )->query();
                      if ( $rows > 0 ) {
                        echo PHP_EOL . PHP_EOL . "--{$stype}-----ok2";
                        self::$db->update( $table_setting_logs )->cols( array( 'state' => 1 ) )->where( "id={$rowinfo['id']}" )->query();
                        self::success( $action, $data, '操作成功' );
                        return true;
                      } else {
                        echo self::$db->lastSQL();
                        echo PHP_EOL . PHP_EOL . "--{$stype}-----no2";
                        self::error( $action, '操作失败' );
                        return true;
                      }
                      break;
                    case 3:
                      switch ($rowinfo['state']) {
                        case 0:
                          $rows = self::$db->update( $table_devices )->cols( array( 'sport_state' => $data['sport_state'] ) )->where( "id='{$rowinfo['uid']}'" )->query();
                          if ( $rows > 0 ) {
                            echo PHP_EOL . PHP_EOL . "--{$stype}---ok";
                            self::$db->update( $table_setting_logs )->cols( array( 'state' => 2 ) )->where( "id={$rowinfo['id']}" )->query();
                            return;
                          } else {
                            echo PHP_EOL . PHP_EOL . "--{$stype}---no";
                            return;
                          }
                          break;
                        case 1:
                          echo PHP_EOL . PHP_EOL . '--PEDO--已更新完成';
                          return;
                          break;
                        case 2:
                          echo PHP_EOL . PHP_EOL . '--PEDO--重复重新';
                          return;
                          break;
                        case 3:
                          $rows = self::$db->update( $table_devices )->cols( array( 'sport_state' => $data['sport_state'] ) )->where( "id='{$rowinfo['uid']}'" )->query();
                          if ( $rows > 0 ) {
                            echo PHP_EOL . PHP_EOL . "--{$stype}-ok";
                            self::$db->update( $table_setting_logs )->cols( array( 'state' => 1 ) )->where( "id={$rowinfo['id']}" )->query();
                            self::success( $action, $data, '操作成功' );
                            return true;
                          } else {
                            echo PHP_EOL . PHP_EOL . "--{$stype}-no";
                            self::error( $action, '操作失败' );
                            return true;
                          }
                          break;
                        default:
                          echo PHP_EOL . PHP_EOL . '--PEDO--异常状态';
                          return false;
                          break;
                      }
                      break;
                    default:
                      echo PHP_EOL . '--PEDO--here';
                      break;
                  }
                } else {
                  self::error( $item, '操作失败' );
                  return true;
                }
              } catch ( \Exception $e ) {
                var_dump( $e->getMessage() );
                self::error_log( $deviceinfo, $e->getMessage() );
              }
              break;
            /*设置计步信息*/
            case 'WALKTIME':
              try {
                $stype = 'sport';
                $rowinfo = self::$db->select( 'id,stype3,params,state,unixtime,uid' )->from( $table_setting_logs )->where( "days={$days} and stype2='{$stype}'" )->orderByDesc( array( 'id' ) )->row();
                if ( !empty( $rowinfo ) && !empty( $rowinfo['params'] ) ) {
                  $data = json_decode( $rowinfo['params'], true );
                  switch ((int) $rowinfo['stype3']) {
                    case 1:
                      $rows = self::$db->update( $table_devices )->cols( array( 'sport_state' => $data['sport_state'] ) )->where( "id='{$rowinfo['uid']}'" )->query();
                      if ( $rows > 0 ) {
                        self::$db->update( $table_setting_logs )->cols( array( 'state' => 1 ) )->where( "id={$rowinfo['id']}" )->query();
                        self::success( $action, $data, '操作成功' );
                      } else {
                        echo PHP_EOL . PHP_EOL . "--{$stype}---no";
                        self::error( $action, '操作失败' );
                        return;
                      }
                      break;
                    case 2:
                      if ( !empty( $data['sport_state'] ) )
                        unset($data['sport_state']);
                      $rows = self::$db->update( $table_devices )->cols( $data )->where( "id='{$rowinfo['uid']}'" )->query();
                      if ( $rows > 0 ) {
                        echo PHP_EOL . PHP_EOL . "--{$stype}-----ok2";
                        self::$db->update( $table_setting_logs )->cols( array( 'state' => 1 ) )->where( "id={$rowinfo['id']}" )->query();
                        self::success( $action, $data, '操作成功' );
                        return true;
                      } else {
                        echo self::$db->lastSQL();
                        echo PHP_EOL . PHP_EOL . "--{$stype}-----no2";
                        self::error( $action, '操作失败' );
                        return true;
                      }
                      break;
                    case 3:
                      //unset($data['sport_state']);
                      switch ($rowinfo['state']) {
                        case 0:
                          $rows = self::$db->update( $table_devices )->cols( $data )->where( "id='{$rowinfo['uid']}'" )->query();
                          if ( $rows > 0 ) {
                            echo PHP_EOL . PHP_EOL . "--{$stype}---ok1";
                            self::$db->update( $table_setting_logs )->cols( array( 'state' => 3 ) )->where( "id={$rowinfo['id']}" )->query();
                            return true;
                          } else {
                            echo PHP_EOL . PHP_EOL . "--{$stype}---no1";
                            return;
                          }
                          break;
                        case 1:
                          echo PHP_EOL . PHP_EOL . '--PEDO--已更新完成';
                          return;
                          break;
                        case 2:
                          $rows = self::$db->update( $table_devices )->cols( $data )->where( "id='{$rowinfo['uid']}'" )->query();
                          if ( $rows > 0 ) {
                            echo PHP_EOL . PHP_EOL . "--{$stype}-----ok2";
                            self::$db->update( $table_setting_logs )->cols( array( 'state' => 1 ) )->where( "id={$rowinfo['id']}" )->query();
                            self::success( $action, $data, '操作成功' );
                            return true;
                          } else {
                            echo self::$db->lastSQL();
                            echo PHP_EOL . PHP_EOL . "--{$stype}-----no2";
                            self::error( $action, '操作失败' );
                            return true;
                          }
                          break;
                        case 3:
                          echo PHP_EOL . PHP_EOL . '--PEDO--重复重新';
                          return;
                          break;
                        default:
                          echo PHP_EOL . PHP_EOL . '--PEDO--异常状态';
                          return false;
                          break;
                      }
                      break;
                    default:
                      echo PHP_EOL . '--WALKTIME--here';
                      break;
                  }
                } else {
                  self::error( $item, '操作失败' );
                  return false;
                }
              } catch ( \Exception $e ) {
                var_dump( $e->getMessage() );
                //self::error_log($db,$deviceinfo,$e->getMessage());
              }
              break;
            /*设置紧急电话号码*/
            case 'SOS':
            /*跌倒报警灵敏度*/
            case 'LSSET':
            /*定位间隔*/
            case 'UPLOAD':
            /*跌倒报警开关*/
            case 'FALLDOWN':
            /*设置循环测量体温*/
            case 'BODYTEMP':
            /*设置定时测量体温*/
            case 'BTTIMESET':
              try {
                $rowinfo = self::$db->select( 'id,params,state,unixtime,uid' )->from( $table_setting_logs )->where( "days={$days} and stype2='{$stype}'" )->orderByDesc( array( 'id' ) )->row();
                if ( !empty( $rowinfo ) && !empty( $rowinfo['params'] ) && empty( $rowinfo['state'] ) ) {
                  $data = json_decode( $rowinfo['params'], true );
                  $rows = self::$db->update( $table_devices )->cols( $data )->where( "id='{$rowinfo['uid']}'" )->query();
                  if ( $rows > 0 ) {
                    echo PHP_EOL . PHP_EOL . 'BODYTEMP-ok';
                    self::$db->update( $table_setting_logs )->cols( array( 'state' => 1 ) )->where( "id={$rowinfo['id']}" )->query();
                    self::success( $action, null, '操作成功' );
                    return false;
                  } else {
                    var_dump( $data );
                    echo PHP_EOL . PHP_EOL . 'BODYTEMP-no---sql:' . ( self::$db->lastSQL() );
                    self::$db->update( $table_setting_logs )->cols( array( 'state' => 2 ) )->where( "id={$rowinfo['id']}" )->query();
                    self::error( $action, '操作失败' );
                    return false;
                  }
                } else {
                  self::error( $item, '操作失败' );
                  return false;
                }
              } catch ( \Exception $e ) {
                var_dump( $e->getMessage() );
                //self::error_log($deviceinfo,$e->getMessage());
              }
              break;
            /*血氧定时测量心率血压*/
            case 'HRTSTART':
              try {
                echo PHP_EOL . PHP_EOL . '---HRTSTART---xxx';
                $table_healthy_heart_rate_logs = prefix . 'healthy_heart_rate_logs';
                $rowinfo = self::$db->select( 'id,state' )->from( $table_request )->where( "days=" . self::$days . " and stype='{$stype}'" )->orderByDesc( array( 'id' ) )->row();
                $data = array(
                  'dbp' => 0,
                  'sbp' => 0,
                  'heart_rate' => 0,
                  'years' => date( 'Y', $unixtime ),
                  'months' => date( 'm', $unixtime ),
                  'days' => self::$days,
                  'hours' => date( 'G', $unixtime ),
                  'state' => 0,
                  'unixtime' => $unixtime,
                  'addtime' => date( 'Y-m-d H:i:s', $unixtime ),
                  'deviceid' => $deviceinfo['device_sn'],
                  'uid' => $deviceinfo['id'],
                );
                $fk_id = (int) self::$db->insert( $table_healthy_heart_rate_logs )->cols( $data )->query();

                if ( !empty( $rowinfo ) && empty( $rowinfo['state'] ) ) {
                  $rows = self::$db->update( $table_request )->cols( array( 'state' => 1 ) )->where( "id={$rowinfo['id']}" )->query();
                  $result = $rows ? array( 'action' => "{$item}", 'code' => 200 ) : array( 'action' => "{$item}", 'code' => 100 );

                  if ( Gateway::isUidOnline( $deviceSN ) ) {
                    Gateway::sendToUid( $deviceSN, json_encode( $result ) );
                    return false;
                  } else {
                    echo 'asaa--121';
                  }
                }
              } catch ( \Exception $e ) {
                echo PHP_EOL . PHP_EOL . '-----HRTSTART--exception';
              }
              break;
            /*终端心率血压上传*/
            case 'BPHRT':
              try {
                $table_alarm_msg = prefix . 'alarm_msg';
                $table_healthy_heart_rate_logs = prefix . 'healthy_heart_rate_logs';
                $rowinfo = self::$db->select( 'id,dbp,sbp,heart_rate,oxygen,state' )->from( $table_healthy_heart_rate_logs )->where( "days=" . self::$days . " and uid='{$deviceinfo['id']}'" )->orderByDesc( array( 'id' ) )->row();

                if ( !empty( $rowinfo ) ) {
                  switch ($rowinfo['state']) {
                    case 0:
                      $rows = self::$db->update( $table_healthy_heart_rate_logs )->cols( array( 'dbp' => $parse_two[1], 'sbp' => $parse_two[2], 'heart_rate' => $parse_two[3], 'state' => 1 ) )->where( "id={$rowinfo['id']}" )->query();
                      break;
                    case 1:
                      echo PHP_EOL . PHP_EOL . '---BPHRT---重复更新';
                      break;
                    case 2:
                      $rows = self::$db->update( $table_healthy_heart_rate_logs )->cols( array( 'dbp' => $parse_two[1], 'sbp' => $parse_two[2], 'heart_rate' => $parse_two[3], 'state' => 3 ) )->where( "id={$rowinfo['id']}" )->query();
                      $result = $rows ? array( 'action' => "{$item}", 'code' => 200 ) : array( 'action' => "{$item}", 'code' => 100 );
                      Gateway::sendToUid( $deviceSN, json_encode( $result ) );
                      break;
                    case 3:
                      echo PHP_EOL . PHP_EOL . '---BPHRT---已更新成功';
                      break;
                    default:
                      echo PHP_EOL . PHP_EOL . '---BPHRT---异常状态';
                      break;
                  }
                } else if ( empty( $rowinfo ) ) {
                  $result = empty( $fk_id ) ? array( 'action' => $action, 'code' => 200 ) : array( 'action' => $action, 'code' => 100 );
                  Gateway::sendToUid( $deviceSN, json_encode( $result ) );
                } else {
                  echo PHP_EOL . PHP_EOL . '---BPHRT---here';
                }

                /*高压异常报警消息*/
                if ( !empty( $deviceinfo['heart_rate_max'] ) && $parse_two[1] > $deviceinfo['heart_rate_max'] ) {
                  $data2 = array(
                    'stype' => 1,
                    'remark' => "检测到心率{$parse_two[1]},超出设置的最大异常值--{$deviceinfo['heart_rate_max']}",
                    'days' => self::$days,
                    'unixtime' => $unixtime,
                    'addtime' => date( 'Y-m-d H:i:s', $unixtime ),
                    'deviceid' => $deviceinfo['device_sn'],
                    'uid' => $deviceinfo['id']
                  );
                  self::$db->insert( $table_alarm_msg )->cols( $data2 )->query();
                } else if ( empty( $deviceinfo['heart_rate_max'] ) ) {
                  echo PHP_EOL . PHP_EOL . '未设置heart_rate_max--111';
                } else if ( $parse_two[1] > $deviceinfo['heart_rate_max'] ) {
                  echo PHP_EOL . PHP_EOL . '未设置heart_rate_max--222';
                }

                if ( !empty( $deviceinfo['heart_rate_min'] ) && $parse_two[2] < $deviceinfo['heart_rate_min'] ) {
                  $data3 = array(
                    'stype' => 2,
                    'remark' => "检测到心率{$parse_two[2]},超出设置的最小异常值--{$deviceinfo['heart_rate_min']}",
                    'days' => self::$days,
                    'unixtime' => $unixtime,
                    'addtime' => date( 'Y-m-d H:i:s', $unixtime ),
                    'deviceid' => $deviceinfo['device_sns'],
                    'uid' => $deviceinfo['id']
                  );
                  self::$db->insert( $table_alarm_msg )->cols( $data3 )->query();
                } else if ( empty( $deviceinfo['heart_rate_min'] ) ) {
                  echo PHP_EOL . PHP_EOL . '未设置heart_rate_min--111';
                } else if ( $parse_two[2] < $deviceinfo['heart_rate_min'] ) {
                  echo PHP_EOL . PHP_EOL . '未设置heart_rate_min--222';
                }
              } catch ( \Exception $e ) {
                var_dump( $e->getMessage() );
                echo PHP_EOL . PHP_EOL . '-----BPHRT--exception';
              }
              break;
            case 'OXYGEN':
              try {
                if ( empty( $parse_two[1] ) ) {
                  $table_healthy_heart_rate_logs = prefix . 'healthy_heart_rate_logs';
                  $rowinfo = self::$db->select( 'id,dbp,sbp,heart_rate,oxygen,state' )->from( $table_healthy_heart_rate_logs )->where( "days=" . self::$days . " and uid='{$deviceinfo['id']}'" )->orderByDesc( array( 'id' ) )->row();
                  if ( !empty( $rowinfo ) ) {
                    switch ($rowinfo['state']) {
                      case 0:
                        $rows = self::$db->update( $table_healthy_heart_rate_logs )->cols( array( 'oxygen' => $parse_two[2], 'state' => 2 ) )->where( "id={$rowinfo['id']}" )->query();
                        break;
                      case 1:
                        $rows = self::$db->update( $table_healthy_heart_rate_logs )->cols( array( 'oxygen' => $parse_two[2], 'state' => 3 ) )->where( "id={$rowinfo['id']}" )->query();
                        $result = $rows ? array( 'action' => $item, 'code' => 200 ) : array( 'action' => $item, 'code' => 100 );
                        Gateway::sendToUid( $deviceSN, json_encode( $result ) );
                        break;
                      case 2:
                        echo PHP_EOL . PHP_EOL . '---OXYGEN---重复更新';
                        break;
                      case 3:
                        echo PHP_EOL . PHP_EOL . '---OXYGEN---已更新成功';

                        break;
                      default:
                        echo PHP_EOL . PHP_EOL . '---OXYGEN---异常状态';
                        break;
                    }
                  } else if ( empty( $rowinfo ) ) {
                    $data = array(
                      'oxygen' => $parse_two[2],
                      'years' => date( 'Y', $unixtime ),
                      'months' => date( 'm', $unixtime ),
                      'days' => self::$days,
                      'state' => 2,
                      'unixtime' => $unixtime,
                      'addtime' => date( 'Y-m-d H:i:s', $unixtime ),
                      'deviceid' => $deviceinfo['device_sn'],
                      'uid' => $deviceinfo['id']
                    );
                    $fk_id = (int) self::$db->insert( $table_healthy_heart_rate_logs )->cols( $data )->query();
                    $result = $fk_id ? array( 'action' => $item, 'code' => 200 ) : array( 'action' => $item, 'code' => 100 );
                    Gateway::sendToUid( $deviceSN, json_encode( $result ) );
                  } else {
                    echo PHP_EOL . PHP_EOL . '---OXYGEN---';
                  }
                } else {
                  $action = 1053;
                  $table_healthy_oxygen_logs = prefix . 'healthy_oxygen_logs';
                  $data = array(
                    'oxygen' => $parse_two[2],
                    'years' => date( 'Y', $unixtime ),
                    'months' => date( 'm', $unixtime ),
                    'days' => self::$days,
                    'state' => 2,
                    'unixtime' => $unixtime,
                    'addtime' => date( 'Y-m-d H:i:s', $unixtime ),
                    'deviceid' => $deviceinfo['device_sn'],
                    'uid' => $deviceinfo['id']
                  );
                  $fk_id = (int) self::$db->insert( $table_healthy_oxygen_logs )->cols( $data )->query();
                  $result = $fk_id ? array( 'action' => $item, 'code' => 200 ) : array( 'action' => $item, 'code' => 100 );
                  Gateway::sendToUid( $deviceSN, json_encode( $result ) );
                }
                self::send1( $deviceinfo, "{$stype},1" );
              } catch ( \Exception $e ) {
                self::send1( $deviceinfo, "{$stype},0" );
              }
              break;
            /*短信报警开关*/
            case 'SMSONOFF':
            /*设置摘除报警开关*/
            case 'REMOVESMS':
            /*设置语音报时开关*/
            case 'HSW':
            /*设置接听模式*/
            case 'APPLOCK':
            /*情景模式*/
            case 'PROFILE':
            /*设置安全模式*/
            case 'DEVREFUSEPHONESWITCH':
              $rowinfo = self::$db->select( 'id,params,state,unixtime,uid' )->from( $table_setting_logs )->where( "days={$days} and stype2='{$stype}'" )->orderByDesc( array( 'id' ) )->row();
              if ( !empty( $rowinfo ) && empty( $rowinfo['state'] ) ) {
                $data = json_decode( $rowinfo['params'], true );
                $rows = self::$db->update( $table_devices )->cols( $data )->where( "id='{$rowinfo['uid']}'" )->query();
                if ( $rows > 0 ) {
                  echo PHP_EOL . PHP_EOL . 'REMOVESMS-ok';
                  self::$db->update( $table_setting_logs )->cols( array( 'state' => 1 ) )->where( "id={$rowinfo['id']}" )->query();
                  self::success( $action, $data, '操作成功' );
                  return false;
                } else {
                  echo PHP_EOL . PHP_EOL . 'REMOVESMS-no';
                  self::$db->update( $table_setting_logs )->cols( array( 'state' => 2 ) )->where( "id={$rowinfo['id']}" )->query();
                  self::error( $item['action'], '操作失败' );
                  return false;
                }
              } else {
                echo PHP_EOL . PHP_EOL . '--here--here';
              }
              break;
            /*
                $rowinfo = self::$db->select('id,params,state,unixtime,uid')->from($table_setting_logs)->where("days={$days} and stype2='{$stype}'")->orderByDesc(array('id'))->row();
                if(!empty($rowinfo) && !empty($rowinfo['params']) && empty($rowinfo['state']) ){
                    $data = json_decode($rowinfo['params'],true);
                    
                    $rows = self::$db->update($table_devices)->cols($data)->where("id='{$rowinfo['uid']}'")->query();
                    if($rows>0){
                        self::$db->update($table_setting_logs)->cols(array('state'=>1))->where("id={$rowinfo['id']}")->query();
                        self::success($item,'操作成功');
                        return false;
                    }else{
                        self::$db->update($table_setting_logs)->cols(array('state'=>2))->where("id={$rowinfo['id']}")->query();
                        self::error($item,'操作失败');
                        return false;
                    }
                }else{

                }
                break;
                $rowinfo = self::$db->select('id,params,state,unixtime,uid')->from($table_setting_logs)->where("days={$days} and stype2='{$stype}'")->orderByDesc(array('id'))->row();
                if(!empty($rowinfo) && !empty($rowinfo['params']) && empty($rowinfo['state']) ){
                    $data = json_decode($rowinfo['params'],true);
                    
                    $rows = self::$db->update($table_devices)->cols($data)->where("id='{$rowinfo['uid']}'")->query();
                    if($rows>0){
                        echo PHP_EOL.PHP_EOL.'LSSET-ok';
                        self::$db->update($table_setting_logs)->cols(array('state'=>1))->where("id={$rowinfo['id']}")->query();
                        self::success($item,'操作成功');
                        return false;
                    }else{
                        echo PHP_EOL.PHP_EOL.'LSSET-no';
                        self::$db->update($table_setting_logs)->cols(array('state'=>2))->where("id={$rowinfo['id']}")->query();
                        self::error($item,'操作失败');
                        return false;
                    }
                }else{
                    
                }
                break;*/
            /*设置闹钟提醒*/
            case 'REMIND':
              $rowinfo = self::$db->select( 'id,params,state,unixtime,uid' )->from( $table_setting_logs )->where( "days={$days} and stype2='{$stype}'" )->orderByDesc( array( 'id' ) )->row();
              if ( !empty( $rowinfo ) && !empty( $rowinfo['params'] ) && empty( $rowinfo['state'] ) ) {
                $data = json_decode( $rowinfo['params'], true );

                $rows = self::$db->update( $table_devices )->cols( $data )->where( "id='{$rowinfo['uid']}'" )->query();
                if ( $rows > 0 ) {
                  echo PHP_EOL . PHP_EOL . 'REMIND-ok';
                  self::$db->update( $table_setting_logs )->cols( array( 'state' => 1 ) )->where( "id={$rowinfo['id']}" )->query();
                  self::success( $item, '操作成功' );
                  return false;
                } else {
                  echo PHP_EOL . PHP_EOL . 'REMIND-no';
                  self::$db->update( $table_setting_logs )->cols( array( 'state' => 2 ) )->where( "id={$rowinfo['id']}" )->query();
                  self::error( $item, '操作失败' );
                  return false;
                }
              } else {
                echo PHP_EOL . PHP_EOL . '--here--here';
              }
              break;
            /*设置定时开关机*/
            case 'SPOF':
              $item = 1086;
              $rowinfo = self::$db->select( 'id,params,state,unixtime,uid' )->from( $table_setting_logs )->where( "days={$days} and stype2='{$stype}'" )->orderByDesc( array( 'id' ) )->row();
              if ( !empty( $rowinfo ) && !empty( $rowinfo['params'] ) && empty( $rowinfo['state'] ) ) {
                $params = json_decode( $rowinfo['params'], true );
                /*关机设置*/
                if ( empty( $params['stype'] ) ) {
                  $data = array(
                    'cron_boot_state' => $params['state'],
                    'boot_datetime' => $params['datetime'],
                    'boot_weekdays' => $params['weekdays']
                  );
                } else {
                  $data = array(
                    'cron_shutdown_state' => $params['state'],
                    'shutdown_datetime' => $params['datetime'],
                    'shutdown_weekdays' => $params['weekdays']
                  );
                }
                $rows = self::$db->update( $table_devices )->cols( $data )->where( "id='{$rowinfo['uid']}'" )->query();
                if ( $rows > 0 ) {
                  echo PHP_EOL . PHP_EOL . 'REMIND-ok';
                  self::$db->update( $table_setting_logs )->cols( array( 'state' => 1 ) )->where( "id={$rowinfo['id']}" )->query();
                  self::success( $item, '操作成功' );
                  return false;
                } else {
                  echo PHP_EOL . PHP_EOL . 'REMIND-no';
                  self::$db->update( $table_setting_logs )->cols( array( 'state' => 2 ) )->where( "id={$rowinfo['id']}" )->query();
                  self::error( $item, '操作失败' );
                  return false;
                }
              }
              break;
            case 'PHBX':
            case 'DPHBX':
              $rowinfo = self::$db->select( 'id,params,state,unixtime,uid' )->from( $table_setting_logs )->where( "days={$days} and stype2='{$stype}'" )->orderByDesc( array( 'id' ) )->row();
              if ( !empty( $rowinfo ) && empty( $rowinfo['state'] ) ) {
                $data = json_decode( $rowinfo['params'], true );
                $table_contacts = prefix . 'contacts';
                $rows = self::$db->update( $table_contacts )->cols( $data )->where( "id={$params['fk_id']} and uid={$deviceinfo['id']}" )->query();
                if ( $rows > 0 ) {
                  echo PHP_EOL . PHP_EOL . 'PHBX-ok';
                  self::$db->update( $table_setting_logs )->cols( array( 'state' => 1 ) )->where( "id={$rowinfo['id']}" )->query();
                  self::success( $item, null, '操作成功' );
                  return false;
                } else {
                  echo PHP_EOL . PHP_EOL . 'PHBX-no';
                  self::$db->update( $table_setting_logs )->cols( array( 'state' => 2 ) )->where( "id={$rowinfo['id']}" )->query();
                  self::error( $item, '操作失败' );
                  return false;
                }
              }
              break;
            /*设置定时开关机*/
            case 'SPOF':
              $item = 1086;
              $rowinfo = self::$db->select( 'id,params,state,unixtime,uid' )->from( $table_setting_logs )->where( "days={$days} and stype2='{$stype}'" )->row();
              if ( !empty( $rowinfo ) && empty( $rowinfo['state'] ) ) {
                $params = json_decode( $rowinfo['params'], true );

                /*关机设置*/
                if ( empty( $params ) ) {
                  $data = array(
                    'cron_shutdown_state' => $params['state'],
                    'shutdown_datetime' => $params['datetime'],
                    'shutdown_weekdays' => $params['weekdays']
                  );
                } else {
                  $data = array(
                    'cron_boot_state' => $params['state'],
                    'boot_datetime' => $params['datetime'],
                    'boot_weekdays' => $params['weekdays']
                  );
                }
                $rows = self::$db->update( $table_setting_logs )->cols( $data )->where( "id={$rowinfo['id']}" )->query();
                if ( $rows > 0 ) {
                  echo PHP_EOL . PHP_EOL . 'REMIND-ok';
                  self::$db->update( $table_setting_logs )->cols( array( 'state' => 1 ) )->where( "id={$rowinfo['id']}" )->query();
                  self::success( $item, '操作成功' );
                  return false;
                } else {
                  echo PHP_EOL . PHP_EOL . 'REMIND-no';
                  self::$db->update( $table_setting_logs )->cols( array( 'state' => 2 ) )->where( "id={$rowinfo['id']}" )->query();
                  self::error( $item, '操作失败' );
                  return false;
                }
              }
              break;
            default:

              break;
            //报警信息
            // case 'AL':
            // case 'AL_LTE':
            //     $fk_id = Api::alarm(self::$db,$parse_one[3]);
            //     self::send_one($stype);
            //     break;
            // //位置数据包--4G
            // case 'UP_LTE':
            // case 'UP_WCDMA':
            // case 'UP_TDSCDMA':
            //     //是否开启了计步器
            //     if($parse_two[3]=='A'){
            //         /*
            //             经纬度用南纬是负，北纬是正，
            //             东经是正，西经是负。 
            //         */
            //         $lat1=strtoupper($parse_two[5])=='S' ? -$parse_two[4]: $parse_two[4];
            //         $lng1=strtoupper($parse_two[7])=='W' ? -$parse_two[6]: $parse_two[6];

            //         $lat2=112.437143;
            //         $lng2=34.672539;

            //         $distance = self::getDistance($lat1,$lng1,$lat2,$lng2);
            //         if($distance>300){
            //             echo PHP_EOL.'围栏之外';
            //         }else{
            //             echo PHP_EOL.'在围栏之内';
            //         }
            //     }
            //     //是否开启计步器
            //     self::send_one($stype);
            //     break;
            // //定位间隔
            // case 'UPLOAD':
            // //请求语音信息
            // case 'TKQ':
            //     self::send_one($stype);
            //     break;
            // //体温
            // case 'BTEMP2':
            //     self::send_one($stype);
            //     Api::temperature(self::$db,$cache_data,$parse_two[2]);
            //     break;
            // case 'BPHRT':
            //     if(!empty($cache_data['heart_rate']) && !empty($cache_data['heart_rate']['oxygen']) && $cache_data['heart_rate']['expire']>time()){
            //         $heart_rate = array(
            //             'dbp' => $parse_two[1],
            //             'sbp' => $parse_two[2],
            //             'heart_rate' => $parse_two[3],
            //             'oxygen'=>$cache_data['heart_rate']['oxygen']
            //         );
            //         $cache_data['heart_rate'] = null;
            //         Api::heartrate(self::$db,$cache_data,$heart_rate);
            //     }else{
            //         $cache_data['heart_rate'] = array(
            //             'dbp' =>$parse_two[1],
            //             'sbp' =>$parse_two[2],
            //             'heart_rate' => $parse_two[3],
            //             'oxygen'=>null,
            //             'expire'=>$unixtime+self::$expire
            //         );
            //     }
            //     break;
            // case 'OXYGEN':
            //     if(!empty($cache_data['heart_rate']) && !empty($cache_data['heart_rate']['dbp']) && $cache_data['heart_rate']['expire']>time()){
            //         $heart_rate = array(
            //             'dbp' =>$cache_data['heart_rate']['dbp'],
            //             'sbp' =>$cache_data['heart_rate']['sbp'],
            //             'heart_rate' =>$cache_data['heart_rate']['heart_rate'],
            //             'oxygen'=>$parse_two[2],
            //         );
            //         $cache_data['heart_rate'] = null;
            //         Api::heartrate(self::$db,$cache_data,$heart_rate);
            //     }else{
            //         $cache_data['heart_rate'] = array(
            //             'dbp' =>null,
            //             'sbp' =>null,
            //             'heart_rate' => null,
            //             'oxygen'=>$parse_two[2],
            //             'expire'=>$unixtime+self::$expire
            //         );
            //     }
            //     break;
          }
          // file_put_contents(self::$device_file_path,json_encode($cache_data));
        }
      }
    } else if ( $message[0] == '{' && substr( $message, -1 ) == '}' ) {
      //$contents = substr($message,1,strlen($message)-2);
      // $contents = self::hex2str($contents);
      $obj = json_decode( $message, true );
      if ( !empty( $obj['action'] ) && !empty( $obj['deviceid'] ) ) {
        $reg = '/^\d{10}$/';
        $action = $obj['action'];
        //app作为接收者时使用
        $deviceSN = trim( $obj['deviceid'] );

        if ( !preg_match( $reg, $deviceSN ) ) {
          $result = array(
            'action' => $action,
            'code' => 100,
            'msg' => '非法请求--无效参数deviceid'
          );
          var_dump( $result );
          Gateway::sendToClient( $clientId, json_encode( $result ) );
          return false;
        }

        //$fields = 'id,device_sn,stype,state,electricity,mode_scene,wifi1_fence_state1,wifi1_fence_state2,wifi1_fence_name,wifi1_mac_address,wifi1_fence_remark,wifi2_fence_state1,wifi2_fence_state2,wifi2_fence_name,wifi2_mac_address,wifi2_fence_remark,wifi3_fence_state1,wifi3_fence_state2,wifi3_fence_name,wifi3_mac_address,wifi3_fence_remark,sport_state,sport1_start,sport1_end,sport2_start,sport2_end,sport3_start,sport3_end,medicine1_state,activetime1,activedays1,activetime2,activedays2';
        $fields = 'id,device_sn,stype,state,electricity,activetime1,activetime2';
        $deviceinfo = self::$db->select( $fields )->from( $table_name )->where( "device_sn='{$deviceSN}'" )->row();
        if ( empty( $deviceinfo ) ) {
          $result = array(
            'action' => $action,
            'code' => 100,
            'msg' => '非法请求--设备不存在'
          );
          var_dump( $result );
          Gateway::sendToClient( $clientId, json_encode( $result ) );
          return false;
        }
        //手环作为接收者时使用
        $deviceid = $deviceinfo['id'];
        switch ($action) {
          /*绑定设备*/
          case 1000:
            Gateway::bindUid( $clientId, $deviceSN );
            $result = array(
              'action' => $action,
              'code' => 100,
            );
            if ( Gateway::isUidOnline( $deviceSN ) ) {
              $result['code'] = 200;
              $result['msg'] = '设备绑定成功';
            } else {
              $result['msg'] = '设备绑定失败';
            }
            Gateway::sendToClient( $clientId, json_encode( $result ) );
            return true;
            break;
          /*获取设备的状态信息*/
          case 1001:
            try {
              $diff = $unixtime - $deviceinfo['activetime2'];
              $response = array(
                'action' => $action,
                'code' => 100
              );
              if ( Gateway::isUidOnline( $deviceid ) && $diff < 750 ) {
                $response['code'] = 200;
                $response['electricity'] = $deviceinfo['electricity'];
                $response['msg'] = '查询成功--设备在线';
              } else {
                $response['msg'] = '查询成功--设备离线';
              }
              Gateway::sendToClient( $clientId, json_encode( $reponse ) );
              return true;
            } catch ( \Exception $e ) {
              var_dump( $e->getMessage() );
            }
            break;
          //app首页专用心跳包
          case '1002':
            $data = array(
              'activetime1' => $unixtime,
              'activedays1' => self::$days,
              'activetime1_char' => date( 'Y-m-d H:i:s', $unixtime )
            );
            $rows = self::$db->update( $table_devices )->cols( $data )->where( "id={$deviceinfo['id']} and is_delete=0" )->query();
            $response = array(
              'action' => $action,
              'code' => 200,
              'msg' => $rows > 0 ? 'connection is ok' : 'connection is ok,but update fail'
            );
            Gateway::sendToClient( $clientId, json_encode( $response ) );
            break;
          //app非首页心跳包
          case '1003':
            $response = array(
              'action' => $action,
              'code' => 200,
              'msg' => 'connection is ok'
            );
            Gateway::sendToClient( $clientId, json_encode( $response ) );
            break;
          /*单次获取位置信息*/
          case '1011':
            self::send2( $action, 'cr' );
            break;
          case '1012':
            $seconds = 0;
            switch ($obj['stype']) {
              //1分钟
              case 1:
                $seconds = 60;
                break;
              //10分钟
              case 2:
                $seconds = 600;
                break;
              //30分钟
              case 3:
                $seconds = 1800;
                break;
              //1小时
              case 4:
                $seconds = 3600;
                break;
              //6小时
              case 5:
                $seconds = 21600;
                break;
              //12小时
              case 6:
                $seconds = 43200;
                break;
            }
            self::send2( $action, 'UPLOAD', $seconds, array( 'position_interval' => $seconds ) );
            break;
          /*获取wifi围栏列表*/
          case 1021:
            try {
              $rows = array();
              if ( !empty( $deviceinfo['wifi1_fence_state1'] ) ) {
                $rows[] = array(
                  'id' => 1,
                  'fence_name' => $deviceinfo['wifi1_fence_name'],
                  'fence_mac_address' => $deviceinfo['wifi1_mac_address'],
                  'fence_state' => $deviceinfo['wifi1_fence_state2'],
                  'fence_remark' => $deviceinfo['wifi1_fence_remark']
                );
              }

              if ( !empty( $deviceinfo['wifi2_fence_state1'] ) ) {
                $rows[] = array(
                  'id' => 2,
                  'fence_name' => $deviceinfo['wifi1_fence_name'],
                  'fence_mac_address' => $deviceinfo['wifi1_mac_address'],
                  'fence_state' => $deviceinfo['wifi2_fence_state2'],
                  'fence_remark' => $deviceinfo['wifi1_fence_remark']
                );
              }

              if ( !empty( $deviceinfo['wifi3_fence_state1'] ) ) {
                $rows[] = array(
                  'id' => 3,
                  'fence_name' => $deviceinfo['wifi3_fence_name'],
                  'fence_mac_address' => $deviceinfo['wifi3_mac_address'],
                  'fence_state' => $deviceinfo['wifi3_fence_state2'],
                  'fence_name' => $deviceinfo['wifi3_fence_name'],
                );
              }

              $result = array( 'action' => $action, 'code' => 200, 'data' => $rows, 'msg' => '获取数据成功' );
              Gateway::sendToClient( $clientId, json_encode( $result ) );
            } catch ( \Exception $e ) {
              $result = array( 'action' => $action, 'code' => 100, 'msg' => '系统异常--' . $e->getMessage() );
              Gateway::sendToClient( $clientId, json_encode( $result ) );
              return false;
            }
            break;
          /*新增或保存wifi围栏*/
          case 1022:
            $deviceid = self::$deviceid;
            $table_response = prefix . 'response';
            /*如何排序*/
            $rowinfo = self::$db->select( 'id,contents,unixtime' )->from( $table_response )->where( "days={$days} and deviceid='{$deviceid}' and stype='UD_LTE'" )->orderByDesc( array( 'id' ) )->row();

            echo self::$db->lastSQL();

            var_dump( $rowinfo );
            if ( !empty( $rowinfo ) && $unixtime - $rowinfo['unixtime'] < 1800 ) {
              $wifi_list = self::getwifis( $rowinfo['contents'] );
              $result = array( 'action' => $action, 'code' => 200, 'data' => $wifi_list, 'remark' => 'one' );
              echo json_encode( $result );
              Gateway::sendToClient( $clientId, json_encode( $result ) );
              return false;
            } else {
              $wifi_list = self::getwifis( $rowinfo['contents'] );
              $result = array( 'action' => $action, 'code' => 100, 'data' => $wifi_list, 'remark' => 'two' );

              echo json_encode( $result );
              Gateway::sendToClient( $clientId, json_encode( $result ) );
              return false;
              //self::send2($action,'CR');
              //return false;
              //self::send2($action,"SPOF","{$hour},{$minute},{$state},0,{$stype},{$weekdays}",$params);
            }
            break;
          /*获取gps围栏列表*/
          case 1024:
            try {
              $table_device_fences = prefix . 'device_fences';

              $fields = 'id,sname,lat,lng,radius,state,addtime';
              echo PHP_EOL . $fields;
              $rows = self::$db->select( '*' )->from( $table_device_fences )->where( "uid='" . self::$uid . "' and is_delete=0" )->orderByDesc( array( 'id' ) )->query();

              echo PHP_EOL . self::$db->lastSQL();
              $result = array( 'action' => $action, 'code' => 200, 'msg' => '获取数据成功', 'data' => $rows );
              Gateway::sendToClient( $clientId, json_encode( $result ) );
            } catch ( \Exception $e ) {
              echo 3331111;
              $result = array(
                'action' => $action,
                'code' => 100,
                'msg' => '操作失败--系统异常--' . $e->getMessage(),
              );
              Gateway::sendToClient( $clientId, json_encode( $result ) );
            }
            break;
          /*新增或保存gps围栏*/
          case 1025:
            echo PHP_EOL . PHP_EOL . '============1025====================';
            try {
              $table_device_fences = prefix . 'device_fences';
              if ( empty( $obj['fence_name'] ) ) {
                echo PHP_EOL . PHP_EOL . '============1025 111====================';
                $result = array(
                  'action' => $action,
                  'code' => 100,
                  'msg' => '操作失败--缺少必要参数--fence_raidus',
                );
              } else if ( empty( $obj['lat'] ) ) {
                echo PHP_EOL . PHP_EOL . '============1025 222====================';
                $result = array(
                  'action' => $action,
                  'code' => 100,
                  'msg' => '操作失败--缺少必要参数--fence_raidus',
                );
              } else if ( empty( $obj['lng'] ) ) {
                echo PHP_EOL . PHP_EOL . '============1025 333====================';
                $result = array(
                  'action' => $action,
                  'code' => 100,
                  'msg' => '操作失败--缺少必要参数--fence_raidus',
                );
              } else if ( empty( $obj['fence_radius'] ) ) {
                echo PHP_EOL . PHP_EOL . '============1025 444====================';
                $result = array(
                  'action' => $action,
                  'code' => 100,
                  'msg' => '操作失败--缺少必要参数--fence_raidus',
                );
              } else {
                echo PHP_EOL . PHP_EOL . '============1025 555====================';
                if ( empty( $obj['fk_id'] ) ) {
                  $data = array(
                    'sname' => $obj['fence_name'],
                    'stype' => 2,
                    'lng' => $obj['lng'],
                    'lat' => $obj['lat'],
                    'radius' => $obj['fence_radius'],
                    'state' => empty( $obj['state'] ) ? 0 : 1,
                    'deviceid' => self::$deviceid,
                    'uid' => self::$uid,
                    'unixtime' => $unixtime,
                    'addtime' => date( 'Y-m-d H:i:s', $unixtime )
                  );

                  var_dump( $data );
                  $fk_id = (int) self::$db->insert( $table_device_fences )->cols( $data )->query();
                  $result = $fk_id ? array( 'action' => $action, 'code' => 200 ) : array( 'action' => $action, 'code' => 100 );
                } else {
                  $fk_id = (int) $obj['fk_id'];
                  $data = array(
                    'sname' => $obj['fence_name'],
                    'lng' => $obj['lng'],
                    'lat' => $obj['lat'],
                    'radius' => $obj['fence_radius'],
                    'state' => empty( $obj['state'] ) ? 0 : 1,
                  );
                  $rows = self::$db->update( $table_device_fences )->cols( $data )->where( "id={$fk_id} and uid=" . self::$uid )->query();
                  $result = $rows ? array( 'action' => $action, 'code' => 200 ) : array( 'action' => $action, 'code' => 100 );
                }
              }
              echo 2111;
              Gateway::sendToClient( $clientId, json_encode( $result ) );
            } catch ( \Exception $e ) {
              echo 31121;
              $result = array(
                'action' => $action,
                'code' => 100,
                'msg' => '操作失败--系统异常--' . $e->getMessage(),
              );
              Gateway::sendToClient( $clientId, json_encode( $result ) );
            }
            break;
          /*删除gps围栏*/
          case 1026:
            try {
              if ( empty( $obj['fk_id'] ) ) {
                $result = array( 'action' => $action, 'code' => 100, 'msg' => '操作失败--缺少必要参数--fk_id' );
              } else {
                $fk_id = (int) $obj['fk_id'];
                $table_device_fences = prefix . 'device_fences';
                $rows = self::$db->update( $table_device_fences )->cols( array( 'is_delete' => 1 ) )->where( "id={$fk_id} and uid=" . self::$uid )->query();
                $result = $rows ? array( 'action' => $action, 'code' => 200, 'data' => array( 'fk_id' => $fk_id ) ) : array( 'action' => $action, 'code' => 100 );
              }
              Gateway::sendToClient( $clientId, json_encode( $result ) );
            } catch ( \Exception $e ) {
              $result = array(
                'action' => $action,
                'code' => 100,
                'msg' => '操作失败--系统异常--' . $e->getMessage(),
              );
              Gateway::sendToClient( $clientId, json_encode( $result ) );
            }
            break;
          /*获取gps围栏详情*/
          case 1027:
            try {
              if ( empty( $obj['fk_id'] ) ) {
                $result = array( 'action' => $action, 'code' => 100, 'msg' => '操作失败--缺少必要参数--fk_id' );
              } else {
                $fk_id = (int) $obj['fk_id'];
                switch ($fk_id) {
                  case 1:
                    if ( empty( $deviceinfo['wifi1_fence_state1'] ) ) {
                      $result = array(
                        'action' => $action,
                        'code' => 100,
                        'msg' => '操作失败--记录不存在',
                      );
                    } else {
                      $result = array(
                        'id' => 1,
                        'sname' => $deviceinfo['wifi1_fence_name'],
                        'mac_address' => $deviceinfo['wifi1_mac_address'],
                        'remark' => $deviceinfo['wifi1_fence_remark'],
                        'state' => $deviceinfo['wifi1_fence_state2']
                      );
                    }
                    break;
                  case 2:
                    if ( empty( $deviceinfo['wifi2_fence_state1'] ) ) {
                      $result = array(
                        'action' => $action,
                        'code' => 100,
                        'msg' => '操作失败--记录不存在',
                      );
                    } else {
                      $result = array(
                        'id' => 2,
                        'sname' => $deviceinfo['wifi2_fence_name'],
                        'mac_address' => $deviceinfo['wifi2_mac_address'],
                        'remark' => $deviceinfo['wifi2_fence_remark'],
                        'state' => $deviceinfo['wifi2_fence_state2']
                      );
                    }
                    break;
                  case 3:
                    if ( empty( $deviceinfo['wifi3_fence_state1'] ) ) {
                      $result = array(
                        'action' => $action,
                        'code' => 100,
                        'msg' => '操作失败--记录不存在',
                      );
                    } else {
                      $result = array(
                        'id' => 3,
                        'sname' => $deviceinfo['wifi3_fence_name'],
                        'mac_address' => $deviceinfo['wifi3_mac_address'],
                        'remark' => $deviceinfo['wifi3_fence_remark'],
                        'state' => $deviceinfo['wifi3_fence_state2']
                      );
                    }
                    break;
                  default:
                    $table_device_fences = prefix . 'device_fences';
                    $fenceInfo = self::$db->select( 'id,sname,radius,lat,lng,state' )->from( $table_device_fences )->where( "id={$fk_id} and uid=" . self::$uid )->row();

                    $result = $fenceInfo ? array( 'action' => $action, 'code' => 200, 'data' => $fenceInfo ) : array( 'action' => $action, 'code' => 100 );
                }
              }
              Gateway::sendToClient( $clientId, json_encode( $result ) );
            } catch ( \Exception $e ) {
              $result = array(
                'action' => $action,
                'code' => 100,
                'msg' => '操作失败--系统异常--' . $e->getMessage(),
              );
              Gateway::sendToClient( $clientId, json_encode( $result ) );
            }
            break;
          /*获取gps围栏详情*/
          case 1028:
            try {
              $table_device_fences = prefix . 'device_fences';
              $stype = 'UD_LTE';
              // $deviceid = self::$deviceid;
              // $table_response = prefix.'response';
              // $table_device_fences = prefix.'device_fences';
              // $fenceInfo = self::$db->select('id,sname,radius,lat,lng,state')->from($table_response)->where("days={$days} and stype='{$stype}'")->orderByDesc(array('id'))->row();
              $rowinfo = self::$db->select( 'id,contents,unixtime' )->from( $table_response )->where( "days={$days} and deviceid='{$deviceid}' and stype='UD_LTE'" )->orderByDesc( array( 'id' ) )->row();


              $rowinfo = self::$db->select( 'id,contents,unixtime' )->from( $table_response )->where( "days={$days} and deviceid='{$deviceid}' and stype='UD_LTE'" )->orderByDesc( array( 'id' ) )->row();

              echo self::$db->lastSQL();

              var_dump( $rowinfo );
              if ( !empty( $rowinfo ) && $unixtime - $rowinfo['unixtime'] < 1800 ) {
                $wifi_list = self::getwifis( $rowinfo['contents'] );
                $result = array( 'action' => $action, 'code' => 200, 'data' => $wifi_list, 'remark' => 'one' );
                echo json_encode( $result );
                Gateway::sendToClient( $clientId, json_encode( $result ) );
                return false;
              } else {
                $wifi_list = self::getwifis( $rowinfo['contents'] );
                $result = array( 'action' => $action, 'code' => 100, 'data' => $wifi_list, 'remark' => 'two' );

                echo json_encode( $result );
                Gateway::sendToClient( $clientId, json_encode( $result ) );
                return false;
                //self::send2($action,'CR');
                //return false;
                //self::send2($action,"SPOF","{$hour},{$minute},{$state},0,{$stype},{$weekdays}",$params);
              }


              if ( empty( $obj['id'] ) ) {
                $data = array(
                  'wifi_name' => $obj['wifi_name'],
                  'stype' => 1,
                  'wifi_mac_address' => $obj['wifi_mac_address'],
                  'remark' => empty( $obj['remark'] ) ? '' : trim( $obj['remark'] ),
                  'unixtime' => $unixtime,
                  'addtime' => date( 'Y-m-d H:i:s', $unixtime )
                );
                $fk_id = (int) self::$db->insert( $table_device_fences )->cols( $data )->query();
                $result = $fk_id ? array( 'action' => $action, 'code' => 200 ) : array( 'action' => $action, 'code' => 100 );
                Gateway::sendToClient( $clientId, json_encode( $result ) );
                return false;
              } else {
                $fk_id = (int) $obj['id'];
                $data = array(
                  'wifi_name' => $obj['wifi_name'],
                  'wifi_mac_address' => $obj['wifi_mac_address'],
                  'remark' => empty( $obj['remark'] ) ? '' : trim( $obj['remark'] )
                );
                $rows = self::$db->update( $table_device_fences )->cols( $data )->where( "id={$fk_id}" )->query();
                $result = $rows ? array( 'action' => $action, 'code' => 200 ) : array( 'action' => $action, 'code' => 100 );
                Gateway::sendToClient( $clientId, json_encode( $result ) );
                return false;
              }


              $result = $fenceInfo ? array( 'action' => $action, 'code' => 200, 'data' => $fenceInfo ) : array( 'action' => $action, 'code' => 100 );
              Gateway::sendToClient( $clientId, json_encode( $result ) );
            } catch ( \Exception $e ) {
              $result = array(
                'action' => $action,
                'code' => 100,
                'msg' => '操作失败--系统异常--' . $e->getMessage(),
              );
              Gateway::sendToClient( $clientId, json_encode( $result ) );
            }
            break;
          /*电话联系人*/
          case 1031:
            try {
              $table_contacts = prefix . 'contacts';
              $rows = self::$db->select( '*' )->from( $table_contacts )->where( "uid=" . self::$uid . " and state=1 and is_delete=0" )->query();
              $result = array( 'action' => $action, 'code' => 200, 'data' => $rows );
              Gateway::sendToClient( $clientId, json_encode( $result ) );
            } catch ( \Exception $e ) {
              $result = array(
                'action' => $action,
                'code' => 100,
                'msg' => '操作失败--系统异常--' . $e->getMessage(),
              );
              Gateway::sendToClient( $clientId, json_encode( $result ) );
            }
            break;
          /*保存电话联系人*/
          case 1032:
            try {
              if ( empty( $obj['cname'] ) ) {
                $result = array( 'action' => $action, 'code' => 100, 'msg' => '操作失败--缺少必要参数cname' );
                Gateway::sendToClient( $clientId, json_encode( $result ) );
                return false;
              } else if ( empty( $obj['phone'] ) ) {
                $result = array( 'action' => $action, 'code' => 100, 'msg' => '操作失败--缺少必要参数phone' );
                Gateway::sendToClient( $clientId, json_encode( $result ) );
                return false;
              } else if ( !self::checkphone( $obj['phone'] ) ) {
                $result = array( 'action' => $action, 'code' => 100, 'msg' => '操作失败--请输入正确手机号' );
                Gateway::sendToClient( $clientId, json_encode( $result ) );
                return false;
              } else if ( empty( $obj['fk_id'] ) ) {
                $table_contacts = prefix . 'contacts';
                $rowinfo = self::$db->select( 'id,index' )->from( $table_contacts )->where( "uid={$deviceinfo['id']} and state=0" )->orderByAsc( array( 'id' ) )->row();

                if ( empty( $rowinfo ) ) {
                  $result = array( 'action' => $action, 'code' => 100, 'msg' => '操作失败--至多可添加15个联系人' );
                  Gateway::sendToClient( $clientId, json_encode( $result ) );
                } else {
                  $index = (int) $rowinfo['index'];
                  $phone = trim( $obj['phone'] );
                  $data = array(
                    'fk_id' => $rowinfo['id'],
                    'cname' => $obj['cname'],
                    'avatar' => $obj['avatar'],
                    'phone' => $phone,
                    'remark' => $obj['remark']
                  );
                }
              } else if ( empty( $obj['index'] ) ) {
                $result = array( 'action' => $action, 'code' => 100, 'msg' => '操作失败--请输入正确手机号' );
                Gateway::sendToClient( $clientId, json_encode( $result ) );
                return false;
              } else {
                $index = (int) $obj['index'];
                $phone = trim( $obj['phone'] );
                $data = array(
                  'fk_id' => $obj['fk_id'],
                  'cname' => $obj['cname'],
                  'avatar' => $obj['avatar'],
                  'phone' => $phone,
                  'remark' => $obj['remark']
                );
              }
              self::send2( $action, "PHBX", "{$index},{$phone},", $data );
            } catch ( \Exception $e ) {
              $result = array(
                'action' => $action,
                'code' => 100,
                'msg' => '操作失败--系统异常--' . $e->getMessage(),
              );
              Gateway::sendToClient( $clientId, json_encode( $result ) );
            }
            break;
          /*删除电话联系人*/
          case 1033:
            try {
              if ( empty( $obj['fk_id'] ) ) {
                $result = array( 'action' => $action, 'code' => 100, 'msg' => '操作失败--缺少必要参数fk_id' );
                Gateway::sendToClient( $clientId, json_encode( $result ) );
                return false;
              }

              $fk_id = (int) $obj['fk_id'];
              $table_contacts = prefix . 'contacts';
              $rowinfo = self::$db->select( 'id,index' )->from( $table_contacts )->where( "uid={$deviceinfo['id']} and state=1" )->row();

              if ( empty( $rowinfo ) ) {
                $result = array( 'action' => $action, 'code' => 100, 'msg' => '操作失败--记录不存在' );
                Gateway::sendToClient( $clientId, json_encode( $result ) );
                return false;
              } else {
                $data = array( 'state' => 0 );
                self::send2( $action, "DPHBX", $rowinfo['index'], $data );
              }
            } catch ( \Exception $e ) {
              $result = array(
                'action' => $action,
                'code' => 100,
                'msg' => '操作失败--系统异常--' . $e->getMessage(),
              );
              Gateway::sendToClient( $clientId, json_encode( $result ) );
            }
            break;
          /*意见反馈*/
          case 1038:
            try {
              $result = array();
              $title = empty( $obj['title'] ) ? '' : trim( $obj['title'] );
              $contents = empty( $obj['contents'] ) ? '' : trim( $obj['contents'] );
              $phone = empty( $obj['phone'] ) ? '' : trim( $obj['phone'] );

              if ( empty( $title ) ) {
                $result = array( 'action' => $action, 'code' => 100, 'msg' => '操作失败--缺少必要参数title' );
              } else if ( strlen( $contents ) > 100 ) {
                $result = array( 'action' => $action, 'code' => 100, 'msg' => '操作失败--意见标题至多100字符' );
              } else if ( empty( $contents ) ) {
                $result = array( 'action' => $action, 'code' => 100, 'msg' => '操作失败--缺少必要参数contents' );
              }
              /*else if(strlen($contents)<10){
                  $result = array('action'=>$action,'code'=>100,'msg'=>'操作失败--意见内容至少10字符');
              }*/


              if ( empty( $result ) ) {
                $data = array(
                  'title' => $title,
                  'contents' => $contents,
                  'phone' => $phone,
                  'imgs' => empty( $obj['imgs'] ) ? '' : json_encode( $obj['imgs'] ),
                  'unixtime' => $unixtime,
                  'addtime' => date( 'Y-m-d H:i:s', $unixtime ),
                  'uid' => $deviceinfo['id'],
                );
                $table_feedback = prefix . 'feedback';
                $fk_id = (int) self::$db->insert( $table_feedback )->cols( $data )->query();
                $result = $fk_id ? array( 'action' => $action, 'code' => 200 ) : array( 'action' => $action, 'code' => 100 );
              }
              Gateway::sendToClient( $clientId, json_encode( $result ) );
            } catch ( \Exception $e ) {
              $result = array(
                'action' => $action,
                'code' => 100,
                'msg' => '操作失败--系统异常--' . $e->getMessage(),
              );
              var_dump( $result );
              Gateway::sendToClient( $clientId, json_encode( $result ) );
            }
            break;
          /*app给手环发送语音消息*/
          /*新增或保存wifi围栏*/
          case 10251:
            $days = self::getdays();
            $unixtime = time();
            $deviceid = self::$deviceid;
            $table_response = prefix . 'response';
            $table_device_fences = prefix . 'device_fences';

            /*如何排序*/
            $rowinfo = self::$db->select( 'id,contents,unixtime' )->from( $table_response )->where( "days={$days} and deviceid='{$deviceid}' and stype='UD_LTE'" )->orderByDesc( array( 'id' ) )->row();

            echo self::$db->lastSQL();


            if ( empty( $obj['id'] ) ) {
              $data = array(
                'wifi_name' => $obj['wifi_name'],
                'stype' => 1,
                'wifi_mac_address' => $obj['wifi_mac_address'],
                'remark' => empty( $obj['remark'] ) ? '' : trim( $obj['remark'] ),
                'unixtime' => $unixtime,
                'addtime' => date( 'Y-m-d H:i:s', $unixtime )
              );
              $fk_id = (int) self::$db->insert( $table_device_fences )->cols( $data )->query();
              $result = $fk_id ? array( 'action' => $action, 'code' => 200 ) : array( 'action' => $action, 'code' => 100 );
              Gateway::sendToClient( $clientId, json_encode( $result ) );
              return false;
            } else {
              $fk_id = (int) $obj['id'];
              $data = array(
                'wifi_name' => $obj['wifi_name'],
                'wifi_mac_address' => $obj['wifi_mac_address'],
                'remark' => empty( $obj['remark'] ) ? '' : trim( $obj['remark'] )
              );
              $rows = self::$db->update( $table_device_fences )->cols( $data )->where( "id={$fk_id}" )->query();
              $result = $rows ? array( 'action' => $action, 'code' => 200 ) : array( 'action' => $action, 'code' => 100 );
              Gateway::sendToClient( $clientId, json_encode( $result ) );
              return false;
            }
            break;
          /*获取心率血压--get_heart_rate*/
          case 1041:
            try {
              $days = 739151;
              $table_name = 'hlk_healthy_heart_rate_logs';

              $sql = "select sum(dbp) as `dbp`,sum(sbp) as `sbp`,sum(heart_rate) as `heart_rate`,count(*) as `rows`,hours from {$table_name} where days={$days} group by hours";

              echo $sql;
              $rows = self::$db->query( $sql );
              $result = array();
              if ( !empty( $rows ) ) {
                $dbps = array();
                $sbps = array();
                $hrs = array();
                $tmp = array();
                foreach ( $rows as $row ) {
                  $tmp[$row['hours']] = array(
                    'dbp' => self::formate( $row['dbp'] / $row['rows'] ),
                    'sbp' => self::formate( $row['sbp'] / $row['rows'] ),
                    'heart_rate' => self::formate( $row['heart_rate'] / $row['rows'] ),
                  );
                }

                for ( $i = 0; $i < 24; $i++ ) {
                  if ( array_key_exists( $i, $tmp ) ) {
                    $dbps[] = $tmp[$i]['dbp'];
                    $sbps[] = $tmp[$i]['sbp'];
                    $hrs[] = $tmp[$i]['heart_rate'];
                  } else {
                    $dbps[] = 0;
                    $sbps[] = 0;
                    $hrs[] = 0;
                  }
                }
                $result = array(
                  'action' => $action,
                  'code' => 200,
                  'data' => array(
                    'rows' => count( $rows ),
                    'dbps' => $dbps,
                    'sbps' => $sbps,
                    'hrs' => $hrs,
                  )
                );
              } else {
                $result = array(
                  'action' => $action,
                  'code' => 200,
                  'data' => array(
                    'rows' => 0
                  )
                );
              }
              Gateway::sendToClient( $clientId, json_encode( $result ) );
            } catch ( \Exception $e ) {
              echo PHP_EOL . PHP_EOL . '--exception--1041';
            }
            break;
          /*测量心率血压--send_heart_rate*/
          case 1042:
            //首先判断设备是否在线
            self::send2( $deviceinfo, $clientId, $action, 'hrtstart', 1 );
            break;
          /*测量心率血压--设置状态*/
          case 1043:
            if ( empty( $obj['state'] ) ) {
              $interval = 0;
            } else {
              $interval = 65535;
            }
            $params = array( 'heart_rate_state' => 0 );
            self::send2( $action, 'hrtstart', $interval, $params = array( 'heart_rate_state' => $interval ? 1 : 0 ) );
            break;
          /*测量心率血压--设置频率*/
          case 1044:
            if ( empty( $obj['state'] ) ) {
              echo '1044-111';
              self::error( $action, '操作失败--缺少必要参数state' );
              return false;
            } else {
              echo '1044-222';
              $item = (int) $obj['state'];
              $items = array(
                1 => 300,
                2 => 600,
                3 => 1800,
                4 => 3600,
                5 => 7200,
                6 => 10800,
                7 => 14400,
                8 => 21600,
                9 => 51200
              );
              if ( array_key_exists( $item, $items ) ) {
                $seconds = $items[$item];
                self::send2(
                  $deviceinfo,
                  $clientId,
                  $action,
                  'hrtstart',
                  $seconds,
                  array(
                    'heart_rate_item' => $item,
                    'heart_rate_interval' => $seconds
                  )
                );
              } else {
                self::error( $action, '操作失败--无效参数state' );
                return false;
              }
            }
            break;
          /*设置异常心率血压--setting_heart_rate*/
          case 1045:
            if ( empty( $obj['heart_rate_min'] ) ) {
              echo PHP_EOL . '--111--one';
              self::error( $action, '操作失败--缺少必要参数heart_rate_min' );
              return false;
            } else if ( empty( $obj['heart_rate_max'] ) ) {
              echo PHP_EOL . '--222--two';
              self::error( $action, '操作失败--缺少必要参数heart_rate_max' );
              return false;
            } else {
              $data = array(
                'heart_rate_min' => (int) $obj['heart_rate_min'],
                'heart_rate_max' => (int) $obj['heart_rate_max']
              );
              $rows = self::$db->update( $table_devices )->cols( $data )->where( "id={$deviceinfo['id']}" )->query();
              echo PHP_EOL . "--333--three---rows:{$rows}";
              if ( $rows > 0 ) {
                self::success( $action, '操作成功' );
                return false;
              } else {
                self::error( $action, '操作失败--无效参数state' );
                return false;
              }
            }
            break;
          /*获取计步信息---get_sport*/
          case 1046:
            try {
              /*
              只有在线状态，才有电量信息，
              
              110,离线
              120，
              */

              $uid = self::$uid;
              $table_healthy_sport_logs = prefix . "healthy_sport_logs";
              $days = empty( $obj['date'] ) ? self::getdays() : self::getdays( $obj['date'] );

              $rowinfo = self::$db->select( '*' )->from( $table_healthy_sport_logs )->where( "uid = '{$uid}' and days={$days}  and is_delete=0" )->orderByDesc( array( 'id' ) )->row();

              if ( empty( $rowinfo ) ) {
                $result = array(
                  'action' => $action,
                  'code' => 200,
                  'data' => array(
                    'steps' => 0,
                    'mileage' => 0,
                    'calorie' => 0
                  )
                );
              } else {
                $result = array(
                  'action' => $action,
                  'code' => 200,
                  'data' => array(
                    'steps' => $rowinfo['steps'],
                    'mileage' => 0,
                    'calorie' => 0
                  )
                );
              }
              Gateway::sendToClient( self::$clientId, json_encode( $result ) );
            } catch ( \Exception $e ) {
              echo PHP_EOL . PHP_EOL . '--1046==========';
              var_dump( $e->getMessage() );
            }
            break;
          /*设置计步信息--setting_sport
              stype3，
              1，仅修改状态
              2，仅修改时间段
              3，两者都需要修改。
          */
          case 1047:
            $state = (int) $obj['sport_state'];
            $step = empty( $obj['step'] ) ? 0 : (int) $obj['step'];
            $weight = empty( $obj['weight'] ) ? 0 : (int) $obj['weight'];

            $data1 = array(
              'sport_state' => $state,
              'sport1_start' => $obj['sport1_start'],
              'sport1_end' => $obj['sport1_end'],
              'sport2_start' => $obj['sport2_start'],
              'sport2_end' => $obj['sport2_end'],
              'sport3_start' => $obj['sport3_start'],
              'sport3_end' => $obj['sport3_end']
            );

            $data2 = array(
              'sport_state' => (int) $deviceinfo['sport_state'],
              'sport1_start' => $deviceinfo['sport1_start'],
              'sport1_end' => $deviceinfo['sport1_end'],
              'sport2_start' => $deviceinfo['sport2_start'],
              'sport2_end' => $deviceinfo['sport2_end'],
              'sport3_start' => $deviceinfo['sport3_start'],
              'sport3_end' => $deviceinfo['sport3_end']
            );

            $data3 = array(
              'sport1_start' => $obj['sport1_start'],
              'sport1_end' => $obj['sport1_end'],
              'sport2_start' => $obj['sport2_start'],
              'sport2_end' => $obj['sport2_end'],
              'sport3_start' => $obj['sport3_start'],
              'sport3_end' => $obj['sport3_end']
            );

            $data4 = array(
              'sport1_start' => $deviceinfo['sport1_start'],
              'sport1_end' => $deviceinfo['sport1_end'],
              'sport2_start' => $deviceinfo['sport2_start'],
              'sport2_end' => $deviceinfo['sport2_end'],
              'sport3_start' => $deviceinfo['sport3_start'],
              'sport3_end' => $deviceinfo['sport3_end']
            );

            $hash1 = md5( json_encode( $data1 ) );
            $hash2 = md5( json_encode( $data2 ) );
            $hash3 = md5( json_encode( $data3 ) );
            $hash4 = md5( json_encode( $data4 ) );

            echo $hash1 . '--' . $hash2;
            var_dump( $data1 );
            var_dump( $data2 );
            var_dump( $deviceinfo );
            if ( $hash1 == $hash2 ) {
              $result = array();
              if ( $step != $deviceinfo['step'] || $weight != $deviceinfo['weight'] ) {
                $data = array(
                  'step' => $step,
                  'weight' => $weight
                );
                $rows = self::$db->update( $table_devices )->cols( $data )->where( "id={$deviceinfo['id']}" )->query();
                $result = $rows > 0 ? array( 'action' => $action, 'code' => 200, 'msg' => '操作成功', 'data' => $data ) : array( 'action' => $action, 'code' => 100, 'msg' => '操作失败--数据未更新' );
              } else {
                $result = array( 'action' => $action, 'code' => 100, 'msg' => '操作失败--数据未更新' );
              }
              echo json_encode( $result );
              Gateway::sendToClient( self::$clientId, json_encode( $result ) );
              return false;
            } else if ( $hash3 != $hash4 && (int) $deviceinfo['sport_state'] != $state ) {
              $command1 = self::getcommand( $deviceinfo, 'PEDO', $state );
              $command2 = self::getcommand( $deviceinfo, 'WALKTIME', "{$obj['sport1_start']}-{$obj['sport1_end']},{$obj['sport2_start']}-{$obj['sport2_end']},{$obj['sport3_start']}-{$obj['sport3_end']}" );

              Gateway::sendToUid( self::$uid, $command1 );
              usleep( 30000 );
              Gateway::sendToUid( self::$uid, $command2 );
              $table_setting_logs = prefix . 'setting_logs';

              $data1['step'] = $step;
              $data1['weight'] = $weight;
              $row_data2 = array(
                'stype1' => $action,
                'stype2' => 'sport',
                'stype3' => 3,
                'command' => "{$command1},{$command2}",
                'days' => $days,
                'params' => json_encode( $data ),
                'device_sn' => self::$deviceid,
                'unixtime' => $unixtime,
                'uid' => self::$uid,
              );
              $fk_id = (int) self::$db->insert( $table_setting_logs )->cols( $row_data2 )->query();

              $msg = $fk_id > 0 ? PHP_EOL . PHP_EOL . "--1047--更新成功--3" : PHP_EOL . PHP_EOL . "--1047--更新失败--3";
              echo $msg;
            } else if ( $hash3 == $hash4 && $deviceinfo['sport_state'] != $state ) {
              $data = array(
                'sport_state' => $state,
                'step' => $step,
                'weight' => $weight
              );
              $command = self::getcommand( $deviceinfo, 'PEDO', $state );
              Gateway::sendToUid( self::$uid, $command );
              $table_setting_logs = prefix . 'setting_logs';
              $row_data2 = array(
                'stype1' => $action,
                'stype2' => 'sport',
                'stype3' => 1,
                'command' => "{$command}",
                'days' => $days,
                'params' => json_encode( $data ),
                'device_sn' => self::$deviceid,
                'unixtime' => $unixtime,
                'uid' => self::$uid,
              );
              $fk_id = (int) self::$db->insert( $table_setting_logs )->cols( $row_data2 )->query();
              $msg = $fk_id > 0 ? PHP_EOL . PHP_EOL . "--1047--更新成功--1" : PHP_EOL . PHP_EOL . "--1047--更新失败--1";
              echo $msg;
            } else if ( $hash3 != $hash4 && $deviceinfo['sport_state'] == $state ) {
              $data3['step'] = $step;
              $data3['weight'] = $weight;
              $command = self::getcommand( $deviceinfo, 'WALKTIME', "{$obj['sport1_start']}-{$obj['sport1_end']},{$obj['sport2_start']}-{$obj['sport2_end']},{$obj['sport3_start']}-{$obj['sport3_end']}" );
              Gateway::sendToUid( self::$uid, $command );
              $table_setting_logs = prefix . 'setting_logs';
              $row_data2 = array(
                'stype1' => $action,
                'stype2' => 'sport',
                'stype3' => 2,
                'command' => "{$command}",
                'days' => $days,
                'params' => json_encode( $data3 ),
                'device_sn' => self::$deviceid,
                'unixtime' => $unixtime,
                'uid' => self::$uid,
              );
              $fk_id = (int) self::$db->insert( $table_setting_logs )->cols( $row_data2 )->query();

              $msg = $fk_id > 0 ? PHP_EOL . PHP_EOL . "--1047--更新成功--2" : PHP_EOL . PHP_EOL . "--1047--更新失败--2";
              echo $msg;
            } else {
              echo PHP_EOL . '-1047--异常状态--here';
            }
            break;
          /*设置吃药提醒--setting_medicine*/
          // case 1046:

          // break;
          /*获取体温信息--get_body_temp*/
          // case 1047:

          // break;
          /*单次体温--send_body_temp*/
          case 1048:
            self::send2( $deviceinfo, $clientId, $action, 'BODYTEMP2' );

            //self::send2("{$action}-one",'BODYTEMP2');
            break;
          /*循环测量设置--setting_body_temp1*/
          case 1049:
            try {
              $state = 0;
              $interval = 0;
              if ( !empty( $obj['state'] ) )
                $state = 1;
              if ( !empty( $obj['interval'] ) )
                $interval = (int) $obj['interval'];

              $data = array(
                'body_temp1_state' => $state,
                'body_temp1_interval' => $interval
              );
              self::send2( $deviceinfo, $clientId, $action, "BODYTEMP", "{$state},{$interval}", $data );
            } catch ( \Exception $e ) {
              echo PHP_EOL . PHP_EOL . '---1049';
              var_dump( $e->getMessage() );
            }
            break;
          /*定时测量设置--setting_body_temp2*/
          case 1050:
            $body_temp1_stype = empty( $obj['body_temp1_stype'] ) ? 0 : 1;
            $body_temp2_stype = empty( $obj['body_temp2_stype'] ) ? 0 : 1;
            $body_temp3_stype = empty( $obj['body_temp3_stype'] ) ? 0 : 1;

            $body_temp1_datetime = $obj['body_temp1_datetime'];
            $body_temp2_datetime = $obj['body_temp2_datetime'];
            $body_temp3_datetime = $obj['body_temp3_datetime'];

            self::send2(
              $deviceinfo,
              $clientId,
              $action,
              "BTTIMESET",
              "3,{$body_temp1_datetime}\${$body_temp1_stype},{$body_temp2_datetime}\${$body_temp2_stype},{$body_temp3_datetime}\${$body_temp1_stype}",
              array(
                'body_temp1_stype' => $body_temp1_stype,
                'body_temp1_datetime' => $body_temp1_datetime,
                'body_temp2_stype' => $body_temp2_stype,
                'body_temp2_datetime' => $body_temp2_datetime,
                'body_temp3_stype' => $body_temp3_stype,
                'body_temp3_datetime' => $body_temp3_datetime
              )
            );
            break;
          /*获取血氧数据--get_blood_oxygen*/
          case 1055:
            try {
              $days = 739151;
              $table_name = 'hlk_healthy_heart_rate_logs';
              $sql = "select sum(oxygen) as `oxygen`,count(*) as `rows`,hours from {$table_name} where days={$days} group by hours";

              $rows = self::$db->query( $sql );

              var_dump( $rows );
              $result = array();
              if ( !empty( $rows ) ) {
                $tmp = array();
                $oxygens = array();
                foreach ( $rows as $row ) {
                  $tmp[$row['hours']] = self::formate( $row['oxygen'] / $row['rows'] );
                }

                for ( $i = 0; $i < 24; $i++ ) {
                  $oxygens[] = array_key_exists( $i, $tmp ) ? $tmp[$i] : 0;
                }
                $result = array(
                  'action' => $action,
                  'code' => 200,
                  'data' => array(
                    'rows' => count( $rows ),
                    'oxygens' => $oxygens,
                  )
                );
              } else {
                $result = array(
                  'action' => $action,
                  'code' => 200,
                  'data' => array(
                    'rows' => 0
                  )
                );
              }
              Gateway::sendToClient( self::$clientId, json_encode( $result ) );
            } catch ( \Exception $e ) {
              echo PHP_EOL . PHP_EOL . '--exception--1041';
            }
            break;
          /*获取报警消息列表*/
          case 1061:
            try {
              if ( empty( $obj['uid'] ) ) {
                self::error( $action, '操作失败--无效参数state' );
                return false;
              }

              $uid = (int) $obj['uid'];
              $table_alarm_msg = prefix . "alarm_msg";
              $rows = self::$db->select( '*' )->from( $table_alarm_msg )->where( "uid = '{$uid}' and is_delete=0" )->orderByDesc( array( 'id' ) )->query();

              $data = array(
                'action' => $action,
                'code' => 200,
                'msg' => '',
                'data' => $rows
              );
              Gateway::sendToClient( $clientId, json_encode( $data ) );

            } catch ( \Exception $e ) {
              echo PHP_EOL . PHP_EOL;
              var_dump( $e );
            }
            break;
          /*获取常见问题列表*/
          case 1063:
            try {
              $uid = (int) $obj['uid'];
              $table_article = prefix . "article";
              $rows = self::$db->select( 'id,title,cat_id,addtime' )->from( $table_article )->where( "is_delete=0" )->orderByDesc( array( 'id', 'sort_order' ) )->query();

              $data = array(
                'action' => $action,
                'code' => 200,
                'msg' => '获取数据成功',
                'data' => $rows
              );
              Gateway::sendToClient( $clientId, json_encode( $data ) );
            } catch ( \Exception $e ) {
              echo PHP_EOL . PHP_EOL;
              var_dump( $e );
            }
            break;
          /*获取常见问题详情内容*/
          case 1064:
            try {
              if ( empty( $obj['fk_id'] ) ) {
                $data = array(
                  'action' => $action,
                  'code' => 100,
                  'msg' => '获取数据失败--缺少必要参数fk_id',
                  'data' => null
                );
              } else {
                $fk_id = (int) $obj['fk_id'];
                $table_article = prefix . "article";
                $articleInfo = self::$db->select( '*' )->from( $table_article )->where( "id = '{$fk_id}' and is_delete=0" )->row();

                if ( empty( $articleInfo ) ) {
                  $data = array(
                    'action' => $action,
                    'code' => 100,
                    'msg' => '获取数据失败--无效参数fk_id，记录不存在',
                    'data' => null
                  );
                } else {
                  $data = array(
                    'action' => $action,
                    'code' => 200,
                    'msg' => '获取数据成功',
                    'data' => $articleInfo
                  );
                }
              }
              Gateway::sendToClient( $clientId, json_encode( $data ) );
            } catch ( \Exception $e ) {
              echo PHP_EOL . PHP_EOL;
              var_dump( $e );
            }
            break;
          /*找设备*/
          case 1071:
            self::send2( $deviceinfo, $clientId, $action, 'find' );
            break;
          /*远程关机*/
          case 1072:
            self::send2( $deviceinfo, $clientId, $action, 'POWEROFF' );
            break;
          /*重启设备*/
          case 1073:
            self::send2( $deviceinfo, $clientId, $action, 'RESET' );
            break;
          /*恢复出厂设置*/
          case 1074:
            self::send2( $deviceinfo, $clientId, $action, 'FACTORY' );
            break;
          /*设置短信报警开关--13*/
          case 1075:
            $state = empty( $obj['state'] ) ? 0 : 1;
            self::send2( $deviceinfo, $clientId, $action, 'SMSONOFF', $state, array( 'alarm_sms' => $state ) );
            break;
          /*设置拆除开关--22*/
          case 1076:
            $state = empty( $obj['state'] ) ? 0 : 1;
            self::send2( $deviceinfo, $clientId, $action, 'REMOVESMS', $state, array( 'alarm_remove' => $state ) );
            break;
          /*设置语音报时*/
          case 1077:
            $state = empty( $obj['state'] ) ? 0 : 1;
            self::send2( $deviceinfo, $clientId, $action, 'HSW', $state, array( 'voice_clock' => $state ) );
            break;
          /*设置安全模式*/
          case 1078:
            $state = empty( $obj['state'] ) ? 0 : 1;
            self::send2( $deviceinfo, $clientId, $action, 'DEVREFUSEPHONESWITCH', $state, array( 'mode_safe' => $state ) );
            break;
          /*设置接听模式*/
          case 1079:
            $state = empty( $obj['state'] ) ? 0 : 1;
            self::send2( $deviceinfo, $clientId, $action, 'APPLOCK', "JT-{$state}", array( 'mode_answer' => $state ) );
            break;
          /*设置情景模式*/
          case 1080:
            if ( empty( $obj['state'] ) ) {
              self::error( $action, '操作失败--缺少必要参数state' );
              return false;
            } else {
              $state = (int) $obj['state'];
              if ( in_array( $state, [1, 2, 3, 4] ) ) {
                self::send2( $action, 'PROFILE', $state, array( 'mode_scene' => $state ) );
                return false;
              } else {
                self::error( $action, '操作失败--无效参数state' );
                return false;
              }
            }
            break;
          /*设置设备信息*/
          case 1081:
            $sname = trim( $obj['sname'] );
            $phone = trim( $obj['phone'] );
            $contact_person = trim( $obj['contact_person'] );
            $contact_phone = trim( $obj['contact_phone'] );

            $is_filter_lbs = empty( $obj['is_filter_lbs'] ) ? 0 : 1;
            $is_filter_wifi = empty( $obj['is_filter_wifi'] ) ? 0 : 1;

            $data = array(
              'sname' => $sname,
              'phone' => $phone,
              'contact_person' => $contact_person,
              'contact_phone' => $contact_phone,
              'is_filter_lbs' => $is_filter_lbs,
              'is_filter_wifi' => $is_filter_wifi
            );
            $rows = self::$db->update( $table_devices )->cols( $data )->where( "id={$deviceinfo['id']}" )->query();
            var_dump( '1071--update--' . $rows );
            if ( $rows > 0 ) {
              self::success( $action );
            } else {
              self::error( $action, '', 100 );
            }
            break;
          /*设置密码*/
          case 1082:
            if ( empty( $obj['pwd1'] ) ) {
              self::error( $action, '操作失败--原密码不可为空' );
              return false;
            } else if ( empty( $obj['pwd2'] ) ) {
              self::error( $action, '操作失败--请输入新密码' );
              return false;
            } else if ( empty( $obj['pwd2'] ) ) {
              self::error( $action, '操作失败--请输入确认新密码' );
              return false;
            }

            $pwd2 = trim( $obj['pwd2'] );
            $pwd3 = trim( $obj['pwd3'] );
            if ( $pwd2 == $pwd3 ) {
              $pwd1 = trim( $obj['pwd1'] );
              $password_old = self::getpwd( $pwd1, $deviceinfo['salt'] );

              if ( $password_old == $deviceinfo['password'] ) {
                $salt = self::getsalt();
                $password = self::getpwd( $pwd2, $salt );
                $data = array(
                  'password' => $password,
                  'salt' => $salt
                );
                $rows = self::$db->update( $table_devices )->cols( $data )->where( "id={$deviceinfo['id']}" )->query();
                if ( $rows > 0 ) {
                  self::success( $action );
                } else {
                  self::error( $action );
                }
              } else {
                self::error( $action, '操作失败--原密码错误' );
                return false;
              }
            } else {
              self::error( $action, '操作失败--两次新密码输入不一致' );
              return false;
            }
            break;
          /*设置紧急号码*/
          case 1083:
            $emergency_phone1 = $emergency_phone2 = $emergency_phone3 = '';
            if ( !empty( $obj['emergency_phone1'] ) ) {
              $tmp_phone1 = trim( $obj['emergency_phone1'] );
              if ( self::checkphone( $tmp_phone1 ) )
                $emergency_phone1 = $tmp_phone1;
            }

            if ( !empty( $obj['emergency_phone2'] ) ) {
              $tmp_phone2 = trim( $obj['emergency_phone2'] );
              if ( self::checkphone( $tmp_phone2 ) )
                $emergency_phone2 = $tmp_phone2;
            }

            if ( !empty( $obj['emergency_phone3'] ) ) {
              $tmp_phone3 = trim( $obj['emergency_phone3'] );
              if ( self::checkphone( $tmp_phone3 ) )
                $emergency_phone3 = $tmp_phone3;
            }

            self::send2(
              $deviceinfo,
              $clientId,
              $action,
              'SOS',
              "{$emergency_phone1},{$emergency_phone2},{$emergency_phone3}",
              array(
                'emergency_phone1' => $emergency_phone1,
                'emergency_phone2' => $emergency_phone2,
                'emergency_phone3' => $emergency_phone3
              )
            );
            // self::success($action,null,'',210);
            return true;

            /*
            if(!empty($emergency_phone1) && !empty($emergency_phone2) && !empty($emergency_phone3)){
                self::send2($action,'SOS',"{$emergency_phone1},{$emergency_phone2},{$emergency_phone3}",array(
                    'emergency_phone1'=>$emergency_phone1,
                    'emergency_phone2'=>$emergency_phone2,
                    'emergency_phone3'=>$emergency_phone3
                ));
                return true;
            }else{
                if(!empty($emergency_phone1)) self::send2($action,'sos1',$emergency_phone1);
                if(!empty($emergency_phone2)) self::send2($action,'sos2',$emergency_phone2);
                if(!empty($emergency_phone3)) self::send2($action,'sos3',$emergency_phone3);
            }*/
            break;
          /*设置闹钟提醒*/
          case 1084:
            $clock1_state = trim( $obj['clock1_state'] );
            $clock1_datetime = trim( $obj['clock1_datetime'] );

            $clock2_state = trim( $obj['clock2_state'] );
            $clock2_datetime = trim( $obj['clock2_datetime'] );

            $clock3_state = trim( $obj['clock3_state'] );
            $clock3_datetime = trim( $obj['clock3_datetime'] );
            $clock3_weekdays = trim( $obj['clock3_weekdays'] );

            $command = "{$clock1_datetime}-{$clock1_state}-1,{$clock2_datetime}-{$clock2_state}-2,{$clock2_datetime}-{$clock2_state}-3-{$clock3_weekdays}";
            echo $command;
            self::send2(
              $deviceinfo,
              $clientId,
              $action,
              'REMIND',
              $command,
              array(
                'clock1_state' => $clock1_state,
                'clock1_datetime' => $clock1_datetime,
                'clock2_state' => $clock2_state,
                'clock2_datetime' => $clock2_datetime,
                'clock3_state' => $clock3_state,
                'clock3_datetime' => $clock3_datetime,
                'clock3_weekdays' => $clock3_weekdays,
              )
            );
            break;
          /*设置跌倒报警开关*/
          case 1085:
            $alarm_fall_state = empty( $obj['alarm_fall_state'] ) ? 0 : 1;
            $alarm_fall_phone = empty( $obj['alarm_fall_phone'] ) ? 0 : 1;

            self::send2(
              $deviceinfo,
              $clientId,
              $action,
              "FALLDOWN",
              "{$alarm_fall_state},{$alarm_fall_phone}",
              array(
                'alarm_fall_state' => $alarm_fall_state,
                'alarm_fall_phone' => $alarm_fall_phone
              )
            );
            break;
          /*设置跌倒报警灵敏度*/
          case 1086:
            echo PHP_EOL . PHP_EOL . '1086--111';
            if ( isset( $obj['level'] ) ) {
              echo PHP_EOL . PHP_EOL . '1086--222';
              $level = (int) $obj['level'];
              if ( in_array( $level, [0, 1, 2, 3, 4, 5, 6] ) ) {
                self::send2( $action, "LSSET", "{$level}+6", array( 'alarm_fall_level' => $level ) );
              } else {
                self::error( $action, '操作失败--无效参数level' );
                return false;
              }
            } else {
              echo PHP_EOL . PHP_EOL . '1086--3333';
              self::error( $action, '操作失败--缺少必要参数level' );
              return false;
            }
            break;
          /*设置定时开关机*/
          case 1087:
            $stype = empty( $obj['stype'] ) ? 0 : 1;
            $state = empty( $obj['state'] ) ? 0 : 1;

            $hour = trim( $obj['hour'] );
            $minute = trim( $obj['minute'] );
            $weekdays = trim( $obj['weekdays'] );

            $params = array(
              'stype' => $stype,
              'state' => $state,
              'hour' => $hour,
              'minute' => $minute,
              'datetime' => "{$hour}:{$minute}",
              'weekdays' => $weekdays
            );
            self::send2( $deviceinfo, $clientId, $action, "SPOF", "{$hour},{$minute},{$state},0,{$stype},{$weekdays}", $params );
            break;
          /*设置提醒*/
          case 1088:
            $state = (int) $obj['state'];
            if ( !in_array( $state, [1, 2, 3, 4] ) ) {
              self::error( $action, '操作失败--异常参数' );
              return false;
            } else if ( $deviceinfo['mode_scene'] == $state ) {
              self::error( $action, '操作失败--状态未改变' );
              return false;
            } else {
              self::send2( $deviceinfo, $clientId, $action, "profile", $state, $state );
            }
            break;
          /*测试--mp3转amr格式*/
          case 1100:

            /*
            $today = date('Ymd',$unixtime);
              if(!file_exists(self::$upload_path.'/'.$today)){
                  mkdir(self::$upload_path.'/'.$today,755,true);
              }
              $file_name = self::unique();
            $file_save_uri = '/'.$today.'/'.$file_name;
            $file_save_path = self::$upload_path.$file_save_uri;
              
              $file_path = __DIR__.'/2.mp3';
              $process = new Process(['ffmpeg', '-i',"{$file_path}.mp3", "{$file_save_path}.amr"]);
              $process->run();
              if ($process->isSuccessful()) {
                  $process->getOutput();
                  $contents = "TK,".file_get_contents("{$file_save_path}.amr");
                  $length=str_pad(dechex(strlen($contents)),4,'0',STR_PAD_LEFT);
                  $command = strtoupper("[3G*{$device_id}*{$length}*{$contents}]");
                  
                  if(Gateway::isUidOnline(self::$uid)){
                      Gateway::sendToUid(self::$uid,$command);
                  }else{
                      echo PHP_EOL."TK----isUidOnline---no";
                  }
                  
                  $table_chat_message = prefix.'chat_message';
                  $hash_sha = md5(sha1("{$stype}-{$days}-{$unixtime}"));
                  
                  $data = array(
                      'stype'=>2,
                      'voice_src'=>self::$domain."{$file_save_uri}.mp3",
                      'days'=>$days,
                      'unixtime'=>$unixtime,
                      'addtime'=>date('Y-m-d H:i:s',$unixtime),
                      'device_sn'=>self::$deviceid,
                      'uid'=>self::$uid
                  );
                  $fk_id = (int)self::$db->insert($table_chat_message)->cols($data)->query();
                  
                  if($fk_id>0){
                      $send_data = array(
                          'code'=>200,
                          'msg'=>'操作成功',
                      );
                  }else{
                      $send_data = array(
                          'code'=>130,
                          'msg'=>'操作失败',
                      );
                  }
                  var_dump($send_data);
                  Gateway::sendToClient($clientId,json_encode($send_data));
                  // self::send1('tk,1');
                  // $data = array(
                  //     'stype'=>1,
                  //     'voice_src'=>self::$domain.$file_save_path,
                  //     'days'=>$days,
                  //     'unixtime'=>$unixtime,
                  //     'addtime'=>date('Y-m-d H:i:s',$unixtime),
                  //     'device_sn'=>self::$deviceid,
                  //     'uid'=>self::$uid
                  // );
                  // $fk_id=self::$db->insert(prefix.'chat_message')->cols($data)->query();
                  // if($fk_id>0){
                  //     $data['id'] = $fk_id;
                  //     $result = array(
                  //         'action'=>1036,
                  //         'code'=>100,
                  //         'data'=>$data
                  //     );
                      
                      
                  //     if(Gateway::isUidOnline(self::$deviceid)){
                  //         Gateway::sendToUid(self::$deviceid,json_encode($result));
                      
                  //         echo PHP_EOL."TK----isUidOnline---yes";
                  //     }else{
                  //         echo PHP_EOL."TK----isUidOnline---no";
                  //     }
                  // }else{
                  //     echo PHP_EOL.'---error---sxxx';   
                  // }
              }else{
                  self::send1($deviceinfo,'tk,0');
                  echo PHP_EOL.'TK--error--11';
                  throw new ProcessFailedException($process);
              }
              */
            break;
          /*===========健康页=====================*/
          /*单次测量心率血压*/
          case 1200:
            self::send2( $deviceinfo, $clientId, $action, 'hrtstart', 1 );
            break;
          /*设置计步信息*/
          case 1210:
            $state = (int) $obj['sport_state'];
            $step = empty( $obj['step'] ) ? 0 : (int) $obj['step'];
            $weight = empty( $obj['weight'] ) ? 0 : (int) $obj['weight'];

            $data1 = array(
              'sport_state' => $state,
              'sport1_start' => $obj['sport1_start'],
              'sport1_end' => $obj['sport1_end'],
              'sport2_start' => $obj['sport2_start'],
              'sport2_end' => $obj['sport2_end'],
              'sport3_start' => $obj['sport3_start'],
              'sport3_end' => $obj['sport3_end']
            );

            $data2 = array(
              'sport_state' => (int) $deviceinfo['sport_state'],
              'sport1_start' => $deviceinfo['sport1_start'],
              'sport1_end' => $deviceinfo['sport1_end'],
              'sport2_start' => $deviceinfo['sport2_start'],
              'sport2_end' => $deviceinfo['sport2_end'],
              'sport3_start' => $deviceinfo['sport3_start'],
              'sport3_end' => $deviceinfo['sport3_end']
            );

            $data3 = array(
              'sport1_start' => $obj['sport1_start'],
              'sport1_end' => $obj['sport1_end'],
              'sport2_start' => $obj['sport2_start'],
              'sport2_end' => $obj['sport2_end'],
              'sport3_start' => $obj['sport3_start'],
              'sport3_end' => $obj['sport3_end']
            );

            $data4 = array(
              'sport1_start' => $deviceinfo['sport1_start'],
              'sport1_end' => $deviceinfo['sport1_end'],
              'sport2_start' => $deviceinfo['sport2_start'],
              'sport2_end' => $deviceinfo['sport2_end'],
              'sport3_start' => $deviceinfo['sport3_start'],
              'sport3_end' => $deviceinfo['sport3_end']
            );

            $hash1 = md5( json_encode( $data1 ) );
            $hash2 = md5( json_encode( $data2 ) );
            $hash3 = md5( json_encode( $data3 ) );
            $hash4 = md5( json_encode( $data4 ) );

            echo $hash1 . '--' . $hash2;

            var_dump( $data1 );
            var_dump( $data2 );
            var_dump( $deviceinfo );
            if ( $hash1 == $hash2 ) {
              $result = array();
              if ( $step != $deviceinfo['step'] || $weight != $deviceinfo['weight'] ) {
                $data = array(
                  'step' => $step,
                  'weight' => $weight
                );
                $rows = self::$db->update( $table_devices )->cols( $data )->where( "id={$deviceinfo['id']}" )->query();
                $result = $rows > 0 ? array( 'action' => $action, 'code' => 200, 'msg' => '操作成功', 'data' => $data ) : array( 'action' => $action, 'code' => 100, 'msg' => '操作失败--数据未更新' );
              } else {
                $result = array( 'action' => $action, 'code' => 100, 'msg' => '操作失败--数据未更新' );
              }
              echo json_encode( $result );
              Gateway::sendToClient( self::$clientId, json_encode( $result ) );
              return false;
            } else if ( $hash3 != $hash4 && (int) $deviceinfo['sport_state'] != $state ) {
              $command1 = self::getcommand( $deviceinfo, 'PEDO', $state );
              $command2 = self::getcommand( $deviceinfo, 'WALKTIME', "{$obj['sport1_start']}-{$obj['sport1_end']},{$obj['sport2_start']}-{$obj['sport2_end']},{$obj['sport3_start']}-{$obj['sport3_end']}" );

              Gateway::sendToUid( self::$uid, $command1 );
              usleep( 30000 );
              Gateway::sendToUid( self::$uid, $command2 );
              $table_setting_logs = prefix . 'setting_logs';

              $data1['step'] = $step;
              $data1['weight'] = $weight;
              $row_data2 = array(
                'stype1' => $action,
                'stype2' => 'sport',
                'stype3' => 3,
                'command' => "{$command1},{$command2}",
                'days' => $days,
                'params' => json_encode( $data ),
                'device_sn' => self::$deviceid,
                'unixtime' => $unixtime,
                'uid' => self::$uid,
              );
              $fk_id = (int) self::$db->insert( $table_setting_logs )->cols( $row_data2 )->query();

              $msg = $fk_id > 0 ? PHP_EOL . PHP_EOL . "--1047--更新成功--3" : PHP_EOL . PHP_EOL . "--1047--更新失败--3";
              echo $msg;
            } else if ( $hash3 == $hash4 && $deviceinfo['sport_state'] != $state ) {
              $data = array(
                'sport_state' => $state,
                'step' => $step,
                'weight' => $weight
              );
              $command = self::getcommand( $deviceinfo, 'PEDO', $state );
              Gateway::sendToUid( self::$uid, $command );
              $table_setting_logs = prefix . 'setting_logs';
              $row_data2 = array(
                'stype1' => $action,
                'stype2' => 'sport',
                'stype3' => 1,
                'command' => "{$command}",
                'days' => $days,
                'params' => json_encode( $data ),
                'device_sn' => self::$deviceid,
                'unixtime' => $unixtime,
                'uid' => self::$uid,
              );
              $fk_id = (int) self::$db->insert( $table_setting_logs )->cols( $row_data2 )->query();
              $msg = $fk_id > 0 ? PHP_EOL . PHP_EOL . "--1047--更新成功--1" : PHP_EOL . PHP_EOL . "--1047--更新失败--1";
              echo $msg;
            } else if ( $hash3 != $hash4 && $deviceinfo['sport_state'] == $state ) {
              $data3['step'] = $step;
              $data3['weight'] = $weight;
              $command = self::getcommand( $deviceinfo, 'WALKTIME', "{$obj['sport1_start']}-{$obj['sport1_end']},{$obj['sport2_start']}-{$obj['sport2_end']},{$obj['sport3_start']}-{$obj['sport3_end']}" );
              Gateway::sendToUid( self::$uid, $command );
              $table_setting_logs = prefix . 'setting_logs';
              $row_data2 = array(
                'stype1' => $action,
                'stype2' => 'sport',
                'stype3' => 2,
                'command' => "{$command}",
                'days' => $days,
                'params' => json_encode( $data3 ),
                'device_sn' => self::$deviceid,
                'unixtime' => $unixtime,
                'uid' => self::$uid,
              );
              $fk_id = (int) self::$db->insert( $table_setting_logs )->cols( $row_data2 )->query();

              $msg = $fk_id > 0 ? PHP_EOL . PHP_EOL . "--1047--更新成功--2" : PHP_EOL . PHP_EOL . "--1047--更新失败--2";
              echo $msg;
            } else {
              echo PHP_EOL . '-1047--异常状态--here';
            }
          /*设置吃药提醒*/
          case 1220:

            break;
          /*单次测量体温*/
          case 1230:
            self::send2( $deviceinfo, $clientId, $action, 'BODYTEMP2' );
            break;
          /*设置循环测量体温*/
          case 1231:
            try {
              $state = 0;
              $interval = 0;
              if ( !empty( $obj['state'] ) )
                $state = 1;
              if ( !empty( $obj['interval'] ) )
                $interval = (int) $obj['interval'];

              $data = array(
                'body_temp1_state' => $state,
                'body_temp1_interval' => $interval
              );
              self::send2( $deviceinfo, $clientId, $action, "BODYTEMP", "{$state},{$interval}", $data );
            } catch ( \Exception $e ) {
              echo PHP_EOL . PHP_EOL . '---1049';
              var_dump( $e->getMessage() );
            }
            break;
          /*设置定时测量体温*/
          case 1232:
            $body_temp1_stype = empty( $obj['body_temp1_stype'] ) ? 0 : 1;
            $body_temp2_stype = empty( $obj['body_temp2_stype'] ) ? 0 : 1;
            $body_temp3_stype = empty( $obj['body_temp3_stype'] ) ? 0 : 1;

            $body_temp1_datetime = $obj['body_temp1_datetime'];
            $body_temp2_datetime = $obj['body_temp2_datetime'];
            $body_temp3_datetime = $obj['body_temp3_datetime'];

            self::send2(
              $deviceinfo,
              $clientId,
              $action,
              "BTTIMESET",
              "3,{$body_temp1_datetime}\${$body_temp1_stype},{$body_temp2_datetime}\${$body_temp2_stype},{$body_temp3_datetime}\${$body_temp1_stype}",
              array(
                'body_temp1_stype' => $body_temp1_stype,
                'body_temp1_datetime' => $body_temp1_datetime,
                'body_temp2_stype' => $body_temp2_stype,
                'body_temp2_datetime' => $body_temp2_datetime,
                'body_temp3_stype' => $body_temp3_stype,
                'body_temp3_datetime' => $body_temp3_datetime
              )
            );
            break;
          /*===========设置页===============*/
          //短信报警开关
          case 1400:

            break;
          //拆除报警开关
          case 1401:

            break;
          //语音报时开关
          case 1402:

            break;
          //跌倒报警开关
          case 1403:

            break;
          //安全模式

          case 1406:

            break;
          //接听模式
          case 1407:

            break;
          //情景模式
          case 1408:

            break;
          //找设备
          case 1409:

            break;
          //跌倒报警灵敏度
          case 1410:

            break;
          //闹钟设置
          case 1420:

            break;
          //定时开关机
          case 1430:

            break;
          //重启
          case 1440:

            break;
          //关机
          case 1450:

            break;
          default:

            break;
        }
      } else {
        echo '异常参数,缺少必要字段--action';
      }
    } else {
      $length = 0;
      $days = self::getdays();
      if ( $message[0] == '<' && substr( $message, -1 ) == '>' ) {
        echo PHP_EOL . "--{$clientId}--wechat--111";
        $length = hexdec( substr( 1, 4, $message ) );
        /*消息类型，1手环给app发送消息，2app给手环发送消息*/
        $parse_result = explode( '*', $message );
        self::$packages[$clientId][] = 2;
        self::$packages[$clientId][] = $length;
        self::$packages[$clientId][] = $parse_result[3];
      } else if ( $message[0] == '<' ) {
        echo PHP_EOL . "--{$clientId}--wechat--222";
        self::$packages[$clientId][] = 2;
        self::$packages[$clientId][] = hexdec( substr( $message, 1, 4 ) );
        self::$packages[$clientId][] = $message;
      } else if ( substr( $message, -1 ) == '>' ) {
        echo PHP_EOL . "--{$clientId}--wechat--333";
        self::$packages[$clientId][] = $message;
      } else if ( $message[0] == '[' ) {
        echo PHP_EOL . "--{$clientId}--wechat--444";
        $parse_result = explode( '*', $message );
        self::$packages[$clientId][] = 2;
        self::$packages[$clientId][] = hexdec( $parse_result[2] );
        self::$packages[$clientId][] = $parse_result[3];
      } else if ( substr( $message, -1 ) == ']' ) {
        echo PHP_EOL . "--{$clientId}--wechat--555";
        self::$packages[$clientId][] = substr( $message, 0, -1 );
      } else {
        echo PHP_EOL . "--{$clientId}--wechat--6666";
        self::$packages[$clientId][] = $message;
      }
      $contents = '';

      var_dump( self::$packages[$clientId] );
      foreach ( self::$packages[$clientId] as $index => $item ) {
        echo PHP_EOL . 'index--:' . $index;
        echo PHP_EOL . 'item--:' . $item;
        //var_dump($item);
        if ( $index > 1 ) {
          $contents .= $item;
        }
      }
      if ( self::$packages[$clientId][1] > 0 && strlen( $contents ) == self::$packages[$clientId][1] ) {
        /*拼接完整数据包*/
        if ( self::$packages[$clientId][0] == 1 ) {
          unset(self::$packages[$clientId]);
          //     $params=json_decode(substr($contents,6,-1),true);
          // 	$today = date('Ymd',$unixtime);
          //     if(!file_exists(self::$upload_path.'/'.$today)){
          //         mkdir(self::$upload_path.'/'.$today,755,true);
          //     }
          //     $file_name = self::unique();
          // 	$file_save_uri = '/'.$today.'/'.$file_name;
          // 	$file_save_path = self::$upload_path.$file_save_uri;
          //     $nums=file_put_contents($file_save_path.'.mp3',base64_decode($params['voicestr']));


          //     $contents = file_get_contents(__DIR__.'/1.txt');
          //     echo PHP_EOL.'xxxxxxxxxxxxxxxxx-----------'.PHP_EOL.'======TKTKTKTK============='.$contents;
          //     $parse_one = explode('*',substr($contents,1,-1));

          //     echo PHP_EOL.'==========TK===========';
          //     var_dump($parse_one);
          //     $parse_two = explode(',',$parse_one[3]);
          //     $stype = strtoupper($parse_two[0]);
          //     var_dump($parse_two);
          $file_name = self::unique();
          $upload_path = self::$upload_path . '/cache/' . date( 'Ymd', $unixtime );
          if ( !file_exists( $upload_path ) ) {
            mkdir( $upload_path, 755, true );
          }
          $file_path = $upload_path . '/' . $file_name . '.amr';
          $nums = file_put_contents( $file_path, $contents );
          if ( $nums > 0 ) {
            $output_path = date( 'Ymd', $unixtime );
            if ( !file_exists( self::$upload_path . '/' . $output_path ) ) {
              mkdir( self::$upload_path . '/' . $output_path, 755, true );
            }
            $file_save_path = '/' . $output_path . '/' . $file_name . '.mp3';
            $process = new Process( ['ffmpeg', '-i', $file_path, self::$upload_path . $file_save_path] );
            $process->run();
            if ( $process->isSuccessful() ) {
              $process->getOutput();
              self::send1( $deviceinfo, 'tk,1' );
              $data = array(
                'stype' => 1,
                'voice_src' => self::$domain . $file_save_path,
                'days' => $days,
                'unixtime' => $unixtime,
                'addtime' => date( 'Y-m-d H:i:s', $unixtime ),
                'device_sn' => self::$deviceid,
                'uid' => self::$uid
              );
              $fk_id = self::$db->insert( prefix . 'chat_message' )->cols( $data )->query();

              if ( $fk_id > 0 ) {
                $data['id'] = $fk_id;
                $result = array(
                  'action' => 1036,
                  'code' => 100,
                  'data' => $data
                );
                if ( Gateway::isUidOnline( self::$deviceid ) ) {
                  Gateway::sendToUid( self::$deviceid, json_encode( $result ) );
                  echo PHP_EOL . "TK----isUidOnline---yes";
                } else {
                  echo PHP_EOL . "TK----isUidOnline---no";
                }
              } else {
                echo PHP_EOL . '---error---sxxx';
              }
            } else {
              self::send1( $deviceinfo, 'tk,0' );
              echo PHP_EOL . 'TK--error--11';
              //throw new ProcessFailedException($process);
            }
          } else {
            self::send1( $deviceinfo, 'tk,0' );
            echo PHP_EOL . 'TK--error--222';
          }
          /*
          echo PHP_EOL.'TK---------------======================';
          $nums=file_put_contents(__DIR__.'/1.txt',$message);
          echo PHP_EOL."---------------======================".$nums;
          
          return false;
          $message='1111';
          $nums=file_put_contents('./1.txt',$message);
          echo $nums;
          die;
      $hex="";
      echo PHP_EOL."--length--".$parse_two[2];
      for($i=0;$i<strlen($parse_two[2]);$i++){
          $hex.=dechex(ord($parse_two[2][$i]));
      }
      $hex=strtoupper($hex);
          
          self::send1($deviceinfo,'TK,1');
          echo $hex;die;
          */
        } else if ( self::$packages[$clientId][0] == 2 ) {
          $params = json_decode( substr( $contents, 6, -1 ), true );
          $today = date( 'Ymd', $unixtime );
          if ( !file_exists( self::$upload_path . '/' . $today ) ) {
            mkdir( self::$upload_path . '/' . $today, 755, true );
          }
          $file_name = self::unique();
          $file_save_uri = '/' . $today . '/' . $file_name;
          $file_save_path = self::$upload_path . $file_save_uri;
          $nums = file_put_contents( $file_save_path . '.mp3', base64_decode( $params['voicestr'] ) );

          echo PHP_EOL . PHP_EOL . "--send--mp3---" . $nums;
          if ( $nums > 0 ) {
            //$process = new Process(["ffmpeg","-i","{$file_save_path}.mp3","-c:a libopencore_amrnb -ac 1 -ar 8000 -b:a 7.95K -y","{$file_save_path}.amr"]);
            // $process = new Process('ffmpeg -i {$file_save_path}.mp3 -c:a libopencore_amrnb -ac 1 -ar 8000 -b:a 7.95K -y {$file_save_path}.amr');
            echo PHP_EOL . PHP_EOL . '---process--';
            $process = new Process( ['ffmpeg', '-i', "{$file_save_path}.mp3", "{$file_save_path}.amr"] );
            // $ffmpeg = FFMpeg\FFMpeg::create();
            // $audio = $ffmpeg->open("{$file_save_path}.aac");

            // $format = new FFMpeg\Format\Audio\Amr();
            // $format->on('progress', function ($audio, $format, $percentage) {
            //     echo "$percentage % transcoded";
            // });
            // $format->setAudioChannels(2)->setAudioKiloBitrate(256);
            // $audio->save($format,"{$file_save_path}.amr");
            $process->run();
            if ( $process->isSuccessful() ) {
              $process->getOutput();

              //$file_save_path = self::;
              //$contents = self::$upload_path.'/'.date('Ymd',$unixtime).'/1.amr';
              // $contents = "TK,".file_get_contents("{$contents}.amr");

              //$contents = "TK,".file_get_contents("{$file_save_path}.amr");
              $contents = "TK," . file_get_contents( "{$file_save_path}.amr" );
              $length = str_pad( dechex( strlen( $contents ) ), 4, '0', STR_PAD_LEFT );
              $command = strtoupper( "[3G*{$device_id}*{$length}*{$contents}]" );

              if ( Gateway::isUidOnline( self::$uid ) ) {
                Gateway::sendToUid( self::$uid, $command );
              } else {
                echo PHP_EOL . "TK----isUidOnline---no";
              }

              $table_chat_message = prefix . 'chat_message';
              $hash_sha = md5( sha1( "{$stype}-{$days}-{$unixtime}" ) );

              $data = array(
                'stype' => 2,
                'voice_src' => self::$domain . "{$file_save_uri}.mp3",
                'days' => $days,
                'unixtime' => $unixtime,
                'addtime' => date( 'Y-m-d H:i:s', $unixtime ),
                'device_sn' => self::$deviceid,
                'uid' => self::$uid
              );
              $fk_id = (int) self::$db->insert( $table_chat_message )->cols( $data )->query();

              if ( $fk_id > 0 ) {
                $send_data = array(
                  'code' => 200,
                  'msg' => '操作成功',
                );
              } else {
                $send_data = array(
                  'code' => 130,
                  'msg' => '操作失败',
                );
              }

              Gateway::sendToClient( $clientId, json_encode( $send_data ) );
              // self::send1($deviceinfo,'tk,1');
              // $data = array(
              //     'stype'=>1,
              //     'voice_src'=>self::$domain.$file_save_path,
              //     'days'=>$days,
              //     'unixtime'=>$unixtime,
              //     'addtime'=>date('Y-m-d H:i:s',$unixtime),
              //     'device_sn'=>self::$deviceid,
              //     'uid'=>self::$uid
              // );
              // $fk_id=self::$db->insert(prefix.'chat_message')->cols($data)->query();
              // if($fk_id>0){
              //     $data['id'] = $fk_id;
              //     $result = array(
              //         'action'=>1036,
              //         'code'=>100,
              //         'data'=>$data
              //     );


              //     if(Gateway::isUidOnline(self::$deviceid)){
              //         Gateway::sendToUid(self::$deviceid,json_encode($result));

              //         echo PHP_EOL."TK----isUidOnline---yes";
              //     }else{
              //         echo PHP_EOL."TK----isUidOnline---no";
              //     }
              // }else{
              //     echo PHP_EOL.'---error---sxxx';   
              // }
            } else {
              self::send1( $deviceinfo, 'tk,0' );
              echo PHP_EOL . 'TK--error--11';
              throw new ProcessFailedException( $process );
            }
          }
        } else {
          unset(self::$packages[$clientId]);
          echo PHP_EOL . PHP_EOL . '---异常chat-message--stype--' . self::$packages[$clientId][0];
        }
        // 	//file_put_contents()
        // 	   echo PHP_EOL.'==========TK===========';
        //                     var_dump($parse_one);
        //                     $parse_two = explode(',',$parse_one[3]);
        //                     $stype = strtoupper($parse_two[0]);
        //                     var_dump($parse_two);
        //                     $file_name = $unixtime.mt_rand(1000,9999);

        //                     echo PHP_EOL.'==========TK===========';
        //                     var_dump($parse_two);
        //                     $upload_path = self::$upload_path.'/cache/'.date('Ymd',$unixtime);
        //                     if(!file_exists($upload_path)){
        //                         mkdir($upload_path,755,true);
        //                     }

        //                     $file_path = $upload_path.'/'.$file_name.'.amr';
        //                     // echo PHP_EOL.$file_path;
        //                     if($nums>0){


        //                         $file_save_path = '/'.$output_path.'/'.$file_name.'.mp3';
        //                         $process = new Process(['ffmpeg', '-i',$file_path,self::$upload_path.$file_save_path]);
        //                         $process->run();
        //                         if ($process->isSuccessful()) {
        //                             $process->getOutput();
        //                             self::send1($deviceinfo,'tk,1');

        //                             $data = array(
        //                                 'stype'=>1,
        //                                 'voice_src'=>self::$domain.$file_save_path,
        //                                 'days'=>$days,
        //                                 'unixtime'=>$unixtime,
        //                                 'addtime'=>date('Y-m-d H:i:s',$unixtime),
        //                                 'device_sn'=>self::$deviceid,
        //                                 'uid'=>self::$uid
        //                             );
        //                             $fk_id=self::$db->insert(prefix.'chat_message')->cols($data)->query();


        //                             if($fk_id>0){
        //                                 $data['id'] = $fk_id;
        //                                 $result = array(
        //                                     'action'=>1036,
        //                                     'code'=>100,
        //                                     'data'=>$data
        //                                 );


        //                                 if(Gateway::isUidOnline(self::$deviceid)){
        //                                     Gateway::sendToUid(self::$deviceid,json_encode($result));

        //                                     echo PHP_EOL."TK----isUidOnline---yes";
        //                                 }else{
        //                                     echo PHP_EOL."TK----isUidOnline---no";
        //                                 }
        //                             }else{
        //                                 echo PHP_EOL.'---error---sxxx';   
        //                             }
        //                         }else{
        //                             self::send1($deviceinfo,'tk,0');
        //                             echo PHP_EOL.'TK--error--11';
        //                             throw new ProcessFailedException($process);
        //                         }
        //                     }else{
        //                         self::send1($deviceinfo,'tk,0');
        //                         echo PHP_EOL.'TK--error--222';

        //                     }


      } else {
        file_put_contents( __DIR__ . '/10.txt', $contents );
        echo PHP_EOL . PHP_EOL . '---other---one：' . self::$packages[$clientId][1] . '========two:' . ( strlen( $contents ) == self::$packages[$clientId][0] );
        echo PHP_EOL . PHP_EOL . '==first--===--length:' . strlen( $contents ) . '=======================';
      }
    }
  }

  /*仅仅发送给设备，无需入库的指令*/
  public static function send1( $deviceinfo = null, $contents = '' ) {
    try {
      $length = str_pad( dechex( strlen( $contents ) ), 4, '0', STR_PAD_LEFT );
      $command = strtoupper( "[3G*{$deviceinfo['device_sn']}*{$length}*{$contents}]" );
      Gateway::sendToUid( $deviceinfo['id'], $command );
    } catch ( \Exception $e ) {
      var_dump( $e->getMessage() );
      //self::error_log($deviceinfo,$e->getMessage());
    }
  }


  /*app给手环发送指令*/
  public static function send2( $deviceinfo, $clientId, $action, $stype, $body = '', $params = null ) {
    try {
      $response = null;
      if ( Gateway::isUidOnline( $deviceinfo['id'] ) ) {
        $unixtime = time();
        $contents = empty( $body ) ? $stype : "{$stype},{$body}";
        $length = str_pad( dechex( strlen( $contents ) ), 4, '0', STR_PAD_LEFT );
        $command = strtoupper( "[3G*{$deviceinfo['device_sn']}*{$length}*{$contents}]" );
        Gateway::sendToUid( $deviceinfo['id'], $command );

        //发送前先可以用Gateway::getClientIdByUid判断下uid是否有在线的clientId。
        $table_request = prefix . 'request';
        $row_data = array(
          'deviceid' => $deviceinfo['device_sn'],
          'stype' => self::stypeinfo( $stype ),
          'contents' => $contents,
          'response' => $command,
          'days' => self::$days,
          'unixtime' => $unixtime,
          'addtime' => date( 'Y-m-d H:i:s', $unixtime )
        );
        $fk_id1 = (int) self::$db->insert( $table_request )->cols( $row_data )->query();
        if ( isset( $params ) ) {
          echo 'send2---111';
          $table_setting_logs = prefix . 'setting_logs';
          $hash_sha = md5( sha1( "{$stype}-{$days}-{$unixtime}" ) );
          $row_data2 = array(
            'stype1' => $action,
            'stype2' => $stype,
            'stype3' => is_array( $params ) ? 1 : 0,
            'command' => $command,
            'days' => self::$days,
            'hash_sha' => $hash_sha,
            'params' => is_array( $params ) ? json_encode( $params ) : $params,
            'device_sn' => $deviceinfo['device_sn'],
            'unixtime' => $unixtime,
            'uid' => $deviceinfo['id'],
          );
          $fk_id2 = (int) self::$db->insert( $table_setting_logs )->cols( $row_data2 )->query();

          if ( $fk_id1 > 0 && $fk_id2 > 0 ) {
            $send_data = array(
              'code' => 200,
              'msg' => '操作成功',
            );
          } else if ( empty( $fk_id1 ) || empty( $fk_id2 ) ) {
            $send_data = array(
              'code' => 120,
              'msg' => '发送失败,但插入数据库失败',
            );
          } else {
            $send_data = array(
              'code' => 130,
              'msg' => '操作失败',
            );
          }
        } else if ( $fk_id1 > 0 ) {
          $send_data = array(
            'code' => 200,
            'msg' => '操作成功',
          );
        } else {
          $send_data = array(
            'code' => 130,
            'msg' => '操作失败',
          );
        }
        Gateway::sendToClient( $clientId, json_encode( $response ) );
      } else if ( defined( 'debug' ) && debug == true ) {
        echo PHP_EOL . 'success-exception--' . $action;
        var_dump( !empty( self::$deviceSN ) );
        var_dump( Gateway::isUidOnline( self::$receiver ) );
      } else {
        $response = array(
          'action' => $action,
          'code' => 110,
          ''
        );
        Gateway::sendToClient( $clientId, json_encode( $response ) );
      }
    } catch ( \Exception $e ) {
      var_dump( $e->getMessage() );
      //self::error_log($deviceinfo,$e->getMessage());
    }
  }

  protected static function getcommand( $deviceinfo, $stype, $body = '' ) {
    try {
      $contents = empty( $body ) ? $stype : "{$stype},{$body}";
      $length = str_pad( dechex( strlen( $contents ) ), 4, '0', STR_PAD_LEFT );
      $command = strtoupper( "[3G*{$deviceinfo['device_sn']}*{$length}*{$contents}]" );
      return $command;
    } catch ( \Exception $e ) {
      var_dump( $e->getMessage() );
      //self::error_log($deviceinfo,$e->getMessage());
    }
  }


  /*仅仅发送给设备，无需入库的指令*/
  public static function getaction( $stype = '' ) {
    try {
      $maps = array(
        'UPLOAD' => 1012,
        'BPHRT' => 1043,
        'HRTSTART' => 1045,
        /*设置短信报警开关*/
        'SMSONOFF' => 1075,
        /*设置移除报警开关*/
        'REMOVESMS' => 1076,
        /*设置语音报时开关*/
        'HSW' => 1077,
        /*设置安全模式*/
        'DEVREFUSEPHONESWITCH' => 1078,
        /*设置接听模式*/
        'APPLOCK' => 1079,
        /*设置场景模式*/
        'PROFILE' => 1080,
        'PHBX' => 1032,
        'DPHBX' => 1030,

        /*获取心率血压*/
        'HRTSTART' => '1042-one',

        'BPHRT' => '1042-two',
        /*血氧响应*/
        'OXYGEN' => '1042-two',

        'PEDO' => 1047,
        'WALKTIME' => 1047,
        'BODYTEMP' => 1049,
        'BTTIMESET' => 1050,

        /*紧急手机号*/
        'SOS' => 1083,
        'REMIND' => 1084,
        'FALLDOWN' => 1085,
        'LSSET' => 1086,
        /*设置定时开关机*/
        'SPOF' => 1087,
      );
      return !empty( $stype ) && array_key_exists( $stype, $maps ) ? $maps[$stype] : array( 'action' => 0, 'field' => '' );
    } catch ( \Exception $e ) {
      var_dump( $e->getMessage() );
      //self::error_log($deviceinfo,$e->getMessage());
    }
  }


  /**
   * 给终端发送消息
   */
  public static function send_one( $data ) {
    try {
      $device_id = self::$deviceid;
      $length = str_pad( dechex( strlen( $data ) ), 4, '0', STR_PAD_LEFT );
      $contents = "[3G*{$device_id}*{$length}*{$data}]";
      $result = Gateway::sendToClient( self::$clientId, $contents );
      $row_data = array(
        'deviceid' => $device_id,
        'stype' => self::stypeinfo( $data ),
        'contents' => $data,
        'response' => $contents,
        'state' => $result,
        'addtime' => date( 'Y-m-d H:i:s', time() )
      );
      self::$db->insert( prefix . 'request' )->cols( $row_data )->query();
    } catch ( \Exception $e ) {
      var_dump( $e->getMessage() );
      //self::error_log($deviceinfo,$e->getMessage());
    }
  }


  /*字符串转16进制*/
  protected static function str2hex( $str = '' ) {
    $hex = '';
    for ( $i = 0; $i < strlen( $str ); $i++ ) {
      $hex .= dechex( ord( $str[$i] ) );
    }
    return $hex;
  }

  /**16进制转字符串**/
  protected static function hex2str( $hex ) {
    $str = '';
    for ( $i = 0; $i < strlen( $hex ) - 1; $i += 2 ) {
      $str .= chr( hexdec( $hex[$i] . $hex[$i + 1] ) );
    }
    return $str;
  }


  /**
   * 当用户断开连接时触发
   * @param int $clientId 连接id
   */
  public static function send_two( $data ) {
    try {
      $data = strtoupper( $data );
      $device_id = self::$deviceInfo['deviceid'];
      if ( self::$deviceInfo['expire'] != time() ) {
        // $length = sprintf('%04d',dechex(strlen($data)));
        $length = str_pad( dechex( strlen( $data ) ), 4, '0', STR_PAD_LEFT );
        $contents = "[3G*{$device_id}*{$length}*{$data}]";

        $result = Gateway::sendToClient( self::$deviceInfo['clientId'], $contents );
        $row_data = array(
          'deviceid' => $device_id,
          'stype' => self::stypeinfo( $data ),
          'contents' => $data,
          'response' => $contents,
          'state' => $result,
          'addtime' => date( 'Y-m-d H:i:s', time() )
        );
        $fk_id = (int) self::$db->insert( prefix . 'request' )->cols( $row_data )->query();

        if ( !empty( $result ) && $fk_id > 0 ) {
          $send_data = array(
            'code' => 200,
            'msg' => '操作成功',
          );
        } else if ( !empty( $result ) && empty( $fk_id ) ) {
          $send_data = array(
            'code' => 120,
            'msg' => '发送失败,但插入数据库失败',
          );
        } else {
          $send_data = array(
            'code' => 130,
            'msg' => '操作失败',
          );
        }
      } else {
        $send_data = array(
          'code' => 110,
          'msg' => '设备可能已掉线',
        );
      }
      $x = Gateway::sendToClient( self::$clientId, json_encode( $send_data ) );
    } catch ( \Exception $e ) {
      self::error_log( $deviceinfo, $e->getMessage() );
    }
  }


  public static function stypeinfo( $stype = '' ) {
    if ( empty( $stype ) ) {
      return '';
    } else {
      $actions = array(
        'LK' => '心跳包',
        'UD' => '位置数据上报',
        'UD3' => '位置数据上报',
        'UD_WCDMA' => '位置数据上报',
        'UD_LTE' => '位置数据上报',
        'UD_TDSCDMA' => '位置数据上报',
        'UD2' => '盲点补传数据',
        'AL' => '报警数据上报',
        'WAD' => '请求地址指令',
        'WG' => '请求经纬度指令',
        'UPLOAD' => '数据上传间隔设置',
        'CENTER' => '中心号码设置',
        'SLAVE' => '辅助中心号码',
        'PW' => '控制密码设置',
        'CALL' => '拨打电话',
        'SMS' => '发送短信',
        'MONITOR' => '监听',
        'SOS1' => 'SOS号码设置',
        'UPGRADE' => '远程升级',
        'IP' => 'IP端口设置',
        'FACTORY' => '恢复出厂设置',
        'LZ' => '设置语言和时区',
        'SOSSMS' => 'SOS短信报警开关',
        'LOWBAT' => '低电短信报警开关',
        'APN' => 'APN设置',
        'ANY' => '短信权限控制',
        'TS' => '17.参数查询',
        'VERNO' => '18.版本查询',
        'RESET' => '19.重启',
        'CR' => '20.定位指令',
        'POWEROFF' => '21.关机指令',
        'REMOVE' => '22.取下手环报警开关',
        'MESSAGE' => '23.短语显示设置指令',
        'WHITELIST' => '24.白名单设置指令',
        'PHB' => '25.电话本设置指令',
        'PHBX' => '26.设置带图片的电话本',
        'TK' => '27.对讲功能',
        'GPRSGPS' => '28.GPRS开关',
        'LED' => '29.GPS/GSM指示灯',
        'LSN' => '30.跑马灯自动感应开关',
        'ANS' => '31.接听模式',
        'VON' => '32.震动报警功能设置',
        'NON' => '33.声音感应报警功能设置',
        'MOD' => '34.报警模式',
        'DND' => '35.安全模式',
        'WIFIFENCE' => '36.wifi防丢',
        'REMIND' => '37.闹钟设置',
        'TAKEPILLS' => '38.吃药提醒',
        'PIC' => '39.远程拍照指令',
        'FTP' => '40.FTP地址指令',
        'FTPPWD' => '41.FTP用户名和密码',
        'FON' => '42.跌倒报警',
        'HRTSTART' => '43.心率协议',
        'SPOF' => '45.定时开关机',

        //v48通讯协议
        'LK' => '心跳包',
        'UPLOAD' => '定位间隔',
        'ICCID' => 'ICCID,IMEI,IMSI数据',
        'TKQ' => '请求语音消息',
        'WALKTIME' => '计步时间段',
        'PEDO' => '计步打开',


        'PEDO' => '心率血压',
        'PEDO' => '体温测量单次',
        'PEDO' => '体温测量间隔',
        'PEDO' => '体温测量循环',

        //吃药提醒
        'HSW' => '语音报时开关',

        'FALLDOWN' => '跌倒报警开关',
        //找设备
        'FIND' => '找设备',
      );

      // echo PHP_EOL.$stype;
      if ( array_key_exists( $stype, $actions ) ) {
        return $stype . '--' . $actions[$stype];
      } else {
        return $stype;
      }
    }
  }


  /**
   * 获取天数
   */
  public static function getdays( $str_date = null ) {
    $sql = !empty( $str_date ) ? 'select to_days("' . $str_date . '") as days' : 'select to_days(now())as days';
    $row = self::$db->query( $sql );
    if ( $str_date === null )
      self::$days = $row[0]['days'];
    return $row[0]['days'];
  }


  /**
   * 计算两点直接的距离，单位米
   */
  public static function getDistance( $lat1, $lng1, $lat2, $lng2 ) {
    $earth_radius = 6371.393;
    $dLat = deg2rad( $lat2 - $lat1 );
    $dLon = deg2rad( $lng2 - $lng1 );

    $a = sin( $dLat / 2 ) * sin( $dLat / 2 ) + cos( deg2rad( $lat1 ) ) * cos( deg2rad( $lat2 ) ) * sin( $dLon / 2 ) * sin( $dLon / 2 );
    $c = 2 * asin( sqrt( $a ) );
    $d = $earth_radius * $c;
    return $d * 1000;
  }


  /**
   * 获取设备信息
   */
  public static function getDeviceInfo( $device_sn, $fields = '' ) {
    $fields = empty( $fields ) ? "id,device_sn" : "id,device_sn,{$fields}";
    $table_name = prefix . 'devices';
    return self::$db->select( 'id' )->from( $table_name )->where( "device_sn='{$device_sn}'" )->row();
  }


  function txtTobinary( $word ) {
    $txtarr = str_split( $word );
    //定义一个空字符串存储
    $bin_str = '';
    //转成数字再转成二进制字符串，最后联合起来。
    foreach ( $txtarr as $value )
      $bin_str .= decbin( ord( $value ) );
    //正则截取
    $bin_str = preg_replace( '/^.{4}(.{4}).{2}(.{6}).{2}(.{6})$/', '$1$2$3', $bin_str );
    return $bin_str;


  }



  /**
   * 讲二进制转换成字符串
   */
  protected static function bin2str( $str ) {
    $arr = explode( ' ', $str );
    foreach ( $arr as &$v ) {
      $v = pack( "H" . strlen( base_convert( $v, 2, 16 ) ), base_convert( $v, 2, 16 ) );
    }
    return join( '', $arr );
  }

  public static function decode( $str = '' ) {
    $str = str_replace( '/0X7D/g', '0X7D 0X01', $str );
    $str = str_replace( '/0X5B/g', '0X7D 0X02', $str );
    $str = str_replace( '/0X5D/g', '0X7D 0X03', $str );
    $str = str_replace( '/0X2C/g', '0X7D 0X04', $str );
    $str = str_replace( '/0X2A/g', '0X7D 0X05', $str );
    return $str;
  }


  public static function encode( $str = '' ) {
    $fields = empty( $fields ) ? "id,device_sn" : "id,device_sn,{$fields}";
    $table_name = prefix . 'devices';
    return self::$db->select( 'id' )->from( $table_name )->where( "device_sn='{$device_sn}'" )->row();
  }



  /**
   * 错误日志
   */
  public static function error_log( $deviceinfo, $message = null ) {
    if ( !empty( $message ) ) {
      $unixtime = time();
      //$called_list = debug_backtrace();
      //$last = $called_list[count($called_list)-2];
      //$path = $last['class'].'/'.$last['function'];
      $path = '';

      $data = array(
        'days' => self::$days,
        'action' => $path,
        'message' => $message,
        'deviceid' => $deviceinfo['device_sn'],
        'unixtime' => $unixtime,
        'addtime' => date( 'Y-m-d H:i:s', $unixtime ),
      );
      self::$db->insert( prefix . 'error_log' )->cols( $data )->query();
    }
  }


  /*解析心跳包字符串*/
  protected static function getwifis( $contents = '' ) {
    $wifi_list = array();
    if ( !empty( $contents ) ) {
      $reg = '/((?:\w?,\w{2}:\w{2}:\w{2}:\w{2}:\w{2}:\w{2},[\d\-]+,)+)\d+\.\d+$/';
      preg_match( $reg, $contents, $match_result );

      if ( !empty( $match_result ) ) {
        $wifi_items = explode( ',', $match_result[1] );

        $times = floor( count( $wifi_items ) / 3 );
        for ( $i = 0; $i < $times; $i++ ) {
          $wifi_name = $wifi_items[3 * $i];
          $wifi_list[] = array(
            'item' => $i + 1,
            'wifi_name' => empty( $wifi_name ) ? "WiFi " . ( $i + 1 ) : $wifi_name,
            'wifi_mac_address' => $wifi_items[3 * $i + 1],
          );
        }
      }
    }
    return $wifi_list;
  }



  protected static function getpwd( $password = '', $salt = '' ) {
    return empty( $salt ) ? sha1( md5( $password ) ) : sha1( md5( md5( $password ) . $salt ) );
  }


  /*加密函数*/
  protected static function getsalt( $length = 6 ) {
    $chars = array( 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z' );

    $code = '';
    $rand_keys = array_rand( $chars, $length );
    foreach ( $rand_keys as $rand_key ) {
      $code .= $chars[$rand_key];
    }
    return $code;
  }

  /*加密函数*/
  protected static function encrypt( $data ) {
    $result = openssl_encrypt( $data, openssl_method, openssl_secret_key, openssl_options, openssl_iv );
    return base64_encode( $result );
  }


  /*解密函数*/
  protected static function decrypt( $data, $prefix = '' ) {
    $data = base64_decode( $data );
    $result = openssl_decrypt( $data, openssl_method, openssl_secret_key, openssl_options, openssl_iv );
    if ( !empty( $prefix ) ) {
      $result = str_replace( $prefix, '', $result );
    }
    return $result;
  }

  protected static function success( $action, $data = null, $msg = '', $code = 200 ) {
    if ( !empty( self::$deviceSN ) && Gateway::isUidOnline( self::$deviceSN ) ) {
      $result = array(
        'action' => $action,
        'code' => $code,
        'msg' => $msg,
        'data' => $data
      );
      echo 'success--xxx';
      var_dump( $result );
      //Gateway::sendToClient($deviceSN,json_encode($result));
      Gateway::sendToUid( self::$deviceSN, json_encode( $result ) );
    } else if ( defined( 'debug' ) && debug == true ) {
      echo PHP_EOL . 'success-exception--' . $action;
      var_dump( !empty( self::$deviceSN ) );
      var_dump( Gateway::isUidOnline( $deviceSN ) );
    } else {
      echo PHP_EOL . PHP_EOL . 'success-exception';
    }
  }





  protected static function error( $receiver, $action, $msg = '', $code = 100 ) {
    if ( Gateway::isUidOnline( $receiver ) ) {
      $result = array(
        'action' => $action,
        'code' => $code,
        'msg' => $msg
      );
      Gateway::sendToUid( $receiver, json_encode( $result ) );
    } else if ( defined( 'debug' ) && debug == true ) {
      echo 333;
      var_dump( !empty( $receiver ) );
      echo 444;
      var_dump( Gateway::isUidOnline( $receiver ) );
    } else {
      echo PHP_EOL . PHP_EOL . 'error-exception';
    }
  }



  protected static function unique() {
    return date( 'Ymd', time() ) . uniqid();
  }

  protected static function formate( $num ) {
    //判断是否是小数，
    $str_number = strval( $num );
    if ( strpos( $str_number, '.' ) ) {
      $reg = '/(\d+)\.(\d|(\d{2})\d*)$/';
      preg_match( $reg, $str_number, $match_result );
      if ( !empty( $match_result ) ) {
        $result = count( $match_result ) == 4 ? $match_result[1] . '.' . $match_result[3] : $match_result[1] . '.' . $match_result[2];
        return floatval( $result );
      } else {
        return $num;
      }
      var_dump( $match_result );
    } else {
      return $num;
    }
  }

  protected static function checkphone( $phone = '' ) {
    if ( empty( $phone ) )
      return false;
    $reg = '/^1(3[0-9]|5[0-3,5-9]|6[6]|7[0135678]|8[0-9]|9[89])\d{8}$/';
    preg_match( $reg, $phone, $match_result );
    return $match_result ? true : false;
  }

  /**
   * 当用户断开连接时触发
   * @param int $clientId 连接id
   */
  public static function onClose( $device_id ) {
    // 向所有人发送 
    //Gateway::unbindUid($clientId, $req_data['uid']);
    //GateWay::sendToAll("$clientId logout\r\n");
  }
}
