<?php

/**
 * 宝塔算法
 * 引入文件
 */


function BT_Signature($BT_KEY)//签名算法
{
$now_time=time();//时间戳10位
$data=array(
	'request_token' => md5($now_time.md5($BT_KEY)),	'request_time' => $now_time
	);
	return $data;
}

function BT_Post($url,$data)//保存Cookie方便下次调用
{
global $BT_PANEL;//宝塔面板地址
$cookie_file='../'.$BT_PANEL.'.cookie';//定义cookie保存位置
	if (! file_exists($cookie_file))
	{
	$fp = fopen($cookie_file,'w+');
	fclose($fp);
	}
$curl=curl_init();
curl_setopt($curl,CURLOPT_URL,$url);
curl_setopt($curl,CURLOPT_TIMEOUT,30);
curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
curl_setopt($curl,CURLOPT_COOKIEJAR,$cookie_file);
curl_setopt($curl,CURLOPT_COOKIEFILE,$cookie_file);
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false); 
curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);//不直接输出内容
$data=curl_exec($curl);
curl_close($curl);
	return $data;
}
