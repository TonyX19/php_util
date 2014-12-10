<?php
function get_login_page()
{
	$cookie_dir = __DIR__.'/cookie/book';
	echo 'isset_cookie:', var_dump(file_exists($cookie_dir));
	var_dump($cookie_dir);
	$ch = curl_init();
	$header1 = array(
		'Host:kyfw.12306.cn
		Accept-Language:zh-cn,zh;q=0.8,en-us;q=0.5,en;q=0.3
		Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8
		Connection:keep-alive'
	);
	$header = array(
		'Host:localhost',
		'Accept-Language:zh-cn,zh;q=0.8,en-us;q=0.5,en;q=0.3',
		'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
		'Connection:keep-alive',
	);
	$options = array(
	//	CURLOPT_URL => 'http://localhost/yii2Release/advanced/backend/web/index.php?r=site/login',	
	//	CURLOPT_URL => 'https://kyfw.12306.cn/otn/login/init',	
		CURLOPT_URL => 'https://kyfw.12306.cn/otn/modifyUser/initQueryUserInfo',	
//		CURLOPT_URL => 'https://www.baidu.com',	
		CURLOPT_NOBODY => FALSE,
		CURLOPT_HEADER => TRUE,
		CURLOPT_PORT  => 443,
		CURLOPT_RETURNTRANSFER => TRUE,
		CURLOPT_SSL_VERIFYHOST => FALSE,
		CURLOPT_SSL_VERIFYPEER => FALSE,
		CURLOPT_USERAGENT => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.10; rv:34.0) Gecko/20100101 Firefox/34.0',
		CURLOPT_ENCODING => 'gzip, deflate',
		CURLOPT_HTTPHEADER => $header1,
//		CURLOPT_COOKIEJAR => $cookie_dir,
		CURLOPT_COOKIEFILE => $cookie_dir,
	);
	curl_setopt_array($ch, $options);
	$xyz = curl_exec($ch);
	$error = curl_error($ch);
	var_dump($error);
	$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
	$header = substr($xyz, 0, $header_size);
	var_dump($header);
	$fp = fopen('log.html','w');
	var_dump($xyz);
	$fw_flag = fwrite($fp, $xyz);	
	if(!$fw_flag)
		echo '写入失败';
	return $xyz;
}
get_login_page();



?>
