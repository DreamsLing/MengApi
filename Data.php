<?php

/**
 * QQ：861683052
 */


$Output_format=@$_SERVER['format'] ?: $_SERVER['type'];
$Output_callback=@$_SERVER['callback'];


	/**	 * 获取用户端IP
	 *
	 * @return string
	 */
public static function get_ip()
{
$unknown='unknown';
    if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'],$unknown))
		{
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else if(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'],$unknown))
		{
		$ip=@$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
    }
}

/**
 * 随机IP
 *
 * @return string
 */
function rand_ip()
{
    return mt_rand(0,255).' . '.mt_rand(0,255).' . '.mt_rand(0,255).' . '.mt_rand(0,255);
}
