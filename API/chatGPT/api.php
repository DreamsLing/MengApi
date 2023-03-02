<?php

/**
 * chatGPT
 */


@include $_SERVER['DOCUMENT_ROOT'].'/Data.php';//引入调用文件
@include $_SERVER['DOCUMENT_ROOT'].'/Safety.php';//引入安全、日志记录文件
$text=@$_REQUEST['text'];


send::null_parame_reply('text',$text);//空 参数 回复


$keys='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';
$url='https://api.openai.com/v1/completions';
$post='{"prompt": "'.$text.'", "max_tokens": 2048, "model": "text-davinci-003"}';
$data=curl_post($url,$post);
$json=json_decode($data,true);


if (! @$json['error'])

{

	switch($Output_format)	{

	case 'json':

		$arr=array(

			'code' => 200,

			'data' => array(

				'text' => $json['choices'][0]['text']

				)

			);

		echo send::content($arr,'json');

	break;

	case 'text':

		echo send::content($json['choices'][0]['text']);

	break;

	default:

		echo $data;

	}
}
else
{
	echo send::content($json,'json');
}

function curl_post($url,$post)
{
global $keys;
$curl=curl_init();//开启curl
curl_setopt($curl,CURLOPT_URL,$url);
curl_setopt($curl,CURLOPT_POSTFIELDS,$post);
curl_setopt($curl,CURLOPT_HTTPHEADER,array(
	'content-type: application/json',
	'Authorization: Bearer '.$keys.''
	));
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
$data=curl_exec($curl);
curl_close($curl);
  return $data;
}
