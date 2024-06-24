 
 
## 根据url实现保存图片

```php
  public function download() {
    $url = 'https://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKnOWJq8icA8YD96gbANl1bUpWJ8KW37DoOveR61vgEQ8HVuQ5aDzR7sdu7UGN90NrvtuKcawia4uAw/132';

    $unixtime = time();
    $today = date( 'Ymd', $unixtime );
    $filename = date( "YmdHis", $unixtime ) . mt_rand( 1000, 9999 );
    $filepath = ROOT_PATH . "/public/uploads/{$today}/{$filename}.png";
    if (!is_dir( ROOT_PATH . "/public/uploads/{$today}" )) {
      mkdir( ROOT_PATH . "/public/uploads/{$today}", 755, true );
    }

    echo ROOT_PATH . "/public/uploads/{$today}/{$filename}.png";
    $ch = curl_init( $url );
    $fp = fopen( $filepath, 'wb' );
    curl_setopt( $ch, CURLOPT_FILE, $fp );
    curl_setopt( $ch, CURLOPT_HEADER, 0 );
    curl_exec( $ch );
    curl_close( $ch );
    fclose( $fp );

    echo "<img src='/uploads/{$today}/{$filename}.png'>";
  }
```
