<?php
/**
 * @package  Common
 * @author   Yoper <944975166@qq.com>
 */
 function write_log($method,$log_data,$level=Log::INFO)
 {
     Log::write($method.':'.var_export($log_data,true),$level);
     return true;
 }
/**
 * 删除空值
 * @param string $v
 * @return boolean
 */
function Yocms_del_empty($v)
{
	if ($v==="" || $v=="" || $v==null)//当数组中存在空值时，换回false
	{
		return false;
	}
	return true;
}
/**
 * 检查客户端
 *
 * @return boolean
 */
function Yocms_is_mobile()
{
	$user_agent = $_SERVER['HTTP_USER_AGENT'];  
	$mobile_agents = Array("240x320","acer","acoon","acs-","abacho","ahong","airness","alcatel","amoi","android","iphone","anywhereyougo.com","applewebkit/525","applewebkit/532","asus","audio","au-mic","avantogo","becker","benq","bilbo","bird","blackberry","blazer","bleu","cdm-","compal","coolpad","danger","dbtel","dopod","elaine","eric","etouch","fly ","fly_","fly-","go.web","goodaccess","gradiente","grundig","haier","hedy","hitachi","htc","huawei","hutchison","inno","ipad","ipaq","ipod","jbrowser","kddi","kgt","kwc","lenovo","lg ","lg2","lg3","lg4","lg5","lg7","lg8","lg9","lg-","lge-","lge9","longcos","maemo","mercator","meridian","micromax","midp","mini","mitsu","mmm","mmp","mobi","mot-","moto","nec-","netfront","newgen","nexian","nf-browser","nintendo","nitro","nokia","nook","novarra","obigo","palm","panasonic","pantech","philips","phone","pg-","playstation","pocket","pt-","qc-","qtek","rover","sagem","sama","samu","sanyo","samsung","sch-","scooter","sec-","sendo","sgh-","sharp","siemens","sie-","softbank","sony","spice","sprint","spv","symbian","tablet","talkabout","tcl-","teleca","telit","tianyu","tim-","toshiba","tsm","up.browser","utec","utstar","verykool","virgin","vk-","voda","voxtel","vx","wap","wellco","wig browser","wii","windows ce","wireless","xda","xde","zte");  
	$is_mobile = false;  
	foreach ($mobile_agents as $device) 
	{
	//这里把值遍历一遍，用于查找是否有上述字符串出现过  
	if (stristr($user_agent, $device)) 
	{ 
	//stristr 查找访客端信息是否在上述数组中，不存在即为PC端。  
		$is_mobile = true;  
		break;  
	} 
	}
	return $is_mobile; 
}
/**
 * 随机字符串
 * @param unknown_type $len
 * @return multitype:number string multitype:string
 */
function random_string($len)
{
	$pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';    //字符池
	$random_string='';
	for($i=0; $i<$len; $i++)
	{
	$random_string .= $pattern{mt_rand(0,35)};    //生成php随机数
	}
	return array('status'=>1,'message'=>'成功',
			'data'=>array('random_string'=>$random_string));
}
/**
 * 字符串截取
 * @param string $str
 * @param int $start
 * @param int $length
 * @param sting $charset
 * @param boolen $suffix
 * @return string|unknown
 */
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true) 
{ 
	if(function_exists("mb_substr"))
	{
		if($suffix) 
			return mb_substr($str, $start, $length, $charset)."..."; 
		else 
			return mb_substr($str, $start, $length, $charset); 
	} 
	elseif(function_exists('iconv_substr')) 
	{
		if($suffix) 
			return iconv_substr($str,$start,$length,$charset)."..."; 
		else 
			return iconv_substr($str,$start,$length,$charset); 
	} 
	$re['utf-8'] = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef][x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";
	$re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/"; 
	$re['gbk'] = "/[x01-x7f]|[x81-xfe][x40-xfe]/"; 
	$re['big5'] = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/"; 
	preg_match_all($re[$charset], $str, $match); 
	$slice = join("",array_slice($match[0], $start, $length)); 
	if($suffix) return $slice."…"; 
	return $slice;
}