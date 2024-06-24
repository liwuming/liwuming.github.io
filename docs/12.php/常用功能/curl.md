<?php
define('RATE_FILE_PATH','./cache.json');
$cn2sg = getrateinfo();
die($cn2sg);


//$rate = (int)trim($result[1])/100;
//file_put_contents(RATE_FILE_PATH,json_encode(array('rate'=>$rate,'expire'=>strtotime('+30 min'))));

function getrateinfo(){
	$rate=0;
	$url = 'https://www.safe.gov.cn/AppStructured/hlw/RMBQuery.do';
	/*if(file_exists(RATE_FILE_PATH)){
		$obj = json_decode(file_get_contents(RATE_FILE_PATH),true);
		if(!empty($obj) && $obj['expire']>time()){
			return $obj['rate'];
		}
	}*/

	$response = httpd($url);
	if($response['code'] == 200){
		file_put_contents('cn2sg.html',$response['data']);
		$reg = '/<\/s:iterator>\s+-->\s+<tr class="first" onMouseover=\'this.style.backgroundColor="#fffcbf"\' onMouseout=\'this.style.backgroundColor="#eff6fe"\'>\s+<td td width="8%" align="center" >\s+[\d\-]{10}\s+<\/td>\s*?<td td width="8%" align="center" >\s*?\d+\.\d+\s*?<\/td>\s*?<td td width="8%" align="center" >\s*?\d+\.\d+\s*?<\/td>\s*?<td td width="8%" align="center" >\s*?\d+\.\d+\s*?<\/td>\s*?<td td width="8%" align="center" >\s*?\d+\.\d+\s*?<\/td>\s*?<td td width="8%" align="center" >\s*?\d+\.\d+\s*?<\/td>\s*?<td td width="8%" align="center" >\s*?\d+\.\d+\s*?<\/td>\s*?<td td width="8%" align="center" >\s*?\d+\.\d+\s*?<\/td>\s*?<td td width="8%" align="center" >\s*?([\d\.]+)\s*?<\/td>\s*?<td td width="8%" align="center" >\s*?\d+\.\d+\s*?<\/td>\s*?<td td width="8%" align="center" >\s*?\d+\.\d+\s*?<\/td>\s*?<td td width="8%" align="center" >\s*?\d+\.\d+\s*?<\/td>\s*?<td td width="8%" align="center" >\s*?\d+\.\d+\s*?<\/td>\s*?<td td width="8%" align="center" >\s*?\d+\.\d+\s*?<\/td>\s*?<td td width="8%" align="center" >\s*?\d+\.\d+\s*?<\/td>\s*?<td td width="8%" align="center" >\s*?\d+\.\d+\s*?<\/td>\s*?<td td width="8%" align="center" >\s*?\d+\.\d+\s*?<\/td>\s*?<td td width="8%" align="center" >\s*?\d+\.\d+\s*?<\/td>\s*?<td td width="8%" align="center" >\s*?\d+\.\d+\s*?<\/td>\s*?<td td width="8%" align="center" >\s*?\d+\.\d+\s*?<\/td>\s*?<td td width="8%" align="center" >\s*?\d+\.\d+\s*?<\/td>\s*?<td td width="8%" align="center" >\s*?\d+\.\d+\s*?<\/td>\s*?<td td width="8%" align="center" >\s*?\d+\.\d+\s*?<\/td>\s*?<td td width="8%" align="center" >\s*?\d+\.\d+\s*?<\/td>\s*?<td td width="8%" align="center" >\s*?\d+\.\d+\s*?<\/td>\s*?<td td width="8%" align="center" >\s*?\d+\.\d+\s*?<\/td>/si';	
		
		preg_match($reg,$response['data'],$result);
		
		
		var_dump($result);
		$rate = (int)trim($result[1])/100;
		file_put_contents(RATE_FILE_PATH,json_encode(array('rate'=>$rate,'expire'=>strtotime('+30 min'))));
	}else{
		file_put_contents(RATE_FILE_PATH,'');
	}
	return $rate;
}

function httpd($url){
	$header = array(
		'Host:www.safe.gov.cn',
		'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.2676.76 Safari/537.36',
		'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
		'Accept-Encoding:gzip, deflate, br',
		'Accept-Language:zh-CN,zh;q=0.8,zh-TW;q=0.7,zh-HK;q=0.5,en-US;q=0.3,en;q=0.2',
		'Connection:keep-alive',
		'Cookie: __tasessionId=m2fb03lwk1592693729225; __ac_nonce=05eee93e700f29c6e38ae; __ac_signature=_02B4Z6wo00f01EQ.CZwAAIBD1JGlwKC4jBxEPg0AAE.m20',
		'TE:Trailers',
		'Upgrade-Insecure-Requests:1',
	);
	// 百度蜘蛛
	$ips = array(
		'220.181.108.95',//这个是百度抓取首页的公用IP,如是220.181.108段的话，根本来说你的网站会每天隔夜快照 
		'220.181.108.92',//同上98%抓取首页，大概还会抓取其他（不是指内页）220.181段属于权重IP段此段爬过的文章或首页根本24小时放出来。
		'220.181.108.91',//属于综合的，重要抓取首页和内页或其他，属于权重IP段，爬过的文章或首页根本24小时放出来。
		'220.181.108.75',//重点抓取更新文章的内页到达90%，8%抓取首页，2%其他。权重IP段，爬过的文章或首页根本24小时放出来。
		'220.181.108.86',//公用抓取首页IP权重段，普通前往代码是30400代表未更新。
		'220.181.108.89',//公用抓取首页IP权重段，普通前往代码是30400代表未更新。
		'220.181.108.94',//公用抓取首页IP权重段，普通前往代码是30400代表未更新。
		'220.181.108.97',//公用抓取首页IP权重段，普通前往代码是30400代表未更新。
		'220.181.108.80',//公用抓取首页IP权重段，普通前往代码是30400代表未更新。
		'220.181.108.77',//公用抓首页IP权重段，普通前往代码是30400代表未更新。
		'220.181.108.83',//公用抓取首页IP权重段，普通前往代码是30400代表未更新。
		'60.172.229.61',
		'61.129.45.72',
	);  
	
	$ip = array_rand($ips);
	
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HTTPHEADER,$header);
	curl_setopt($curl, CURLOPT_REFERER, "https://www.baidu.com");   //构造来路 
	//伪造百度蜘蛛IP  

	curl_setopt($curl,CURLOPT_HTTPHEADER,array('X-FORWARDED-FOR:'.$ip.'','CLIENT-IP:'.$ip.'')); 
	//伪造百度蜘蛛头部
	curl_setopt($curl,CURLOPT_USERAGENT,"Mozilla/5.0 (compatible; Baiduspider/2.0; +http://www.baidu.com/search/spider.html)");

	//curl_setopt($curl,CURLOPT_ENCODING,'gzip');
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);	//数据存到成字符串吧，别给我直接输出到屏幕了
	curl_setopt($curl,CURLOPT_TIMEOUT,100);          	//单位 秒，也可以使用
	curl_setopt($curl,CURLOPT_FOLLOWLOCATION,1);
	curl_setopt($curl,CURLOPT_AUTOREFERER,1);
	curl_setopt($curl,CURLOPT_FRESH_CONNECT,1);
	curl_setopt($curl,CURLOPT_HEADER,0);
	curl_setopt($curl, CURLOPT_NOBODY, 0);
	curl_setopt($curl,CURLOPT_MAXREDIRS,3);
	curl_setopt($curl,CURLOPT_FOLLOWLOCATION,true);
	curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,20);
	
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	
	//执行并获取HTML文档内容
	$data = curl_exec($curl);
	//curl是否出错

	$error_no = curl_errno($curl);
	if (empty($error_no)) {
		
		$code = curl_getinfo($curl,CURLINFO_HTTP_CODE);
		//$encode = mb_detect_encoding($data, array('ASCII','UTF-8','GB2312','GBK','BIG5')); 
		/*if($encode != 'UTF-8'){
			$data = mb_convert_encoding($data, 'UTF-8',$encode);
		}*/
		$result = array('code'=>200,'data'=>$data);
	}else{
		$msg = curl_error($curl);
		$result = array('code'=>100,'url'=>$url,'msg'=>$msg); 
	}
	curl_close($curl); //用完记得关掉他
	return $result;
	return true;
}