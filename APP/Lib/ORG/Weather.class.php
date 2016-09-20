<?php
/**
* 中国天气网天气API接口类
* 获取中国天气网天气数据，接口申请地址：http://openweather.weather.com.cn/
* Copyright (c) 2014-2015 http://www.linglingtang.com, All rights reserved.
* Author: 陈永鹏Yoper <944975166@qq.com>
*/
class Weather{
//private_key，从中国天气网获取
private $private_key='206f6c_SmartWeatherAPI_e231dba';
//appid，从中国天气网获取
private $appid='19436500780942dd';
//天气现象编码对应
protected $weather_phenomenon_arr= array(
	'00'=>array('NAMEEN'=>'Sunny','NAMECN'=>'晴'),
	'01'=>array('NAMEEN'=>'Cloudy','NAMECN'=>'多云'),
	'02'=>array('NAMEEN'=>'Overcast','NAMECN'=>'阴'),
	'03'=>array('NAMEEN'=>'Shower','NAMECN'=>'阵雨'),
	'04'=>array('NAMEEN'=>'Thundershower','NAMECN'=>'雷阵雨'),
	'05'=>array('NAMEEN'=>'Thundershower with hail','NAMECN'=>'雷阵雨伴有冰雹'),
	'06'=>array('NAMEEN'=>'Sleet','NAMECN'=>'雨夹雪'),
	'07'=>array('NAMEEN'=>'Light rain','NAMECN'=>'小雨'),
	'08'=>array('NAMEEN'=>'Moderate rain','NAMECN'=>'中雨'),
	'09'=>array('NAMEEN'=>'Heavy rain','NAMECN'=>'大雨'),
	'10'=>array('NAMEEN'=>'Storm','NAMECN'=>'暴雨'),
	'11'=>array('NAMEEN'=>'Heavy storm','NAMECN'=>'大暴雨'),
	'12'=>array('NAMEEN'=>'Severe storm','NAMECN'=>'特大暴雨'),
	'13'=>array('NAMEEN'=>'Snow flurry','NAMECN'=>'阵雪'),
	'14'=>array('NAMEEN'=>'Light snow','NAMECN'=>'小雪'),
	'15'=>array('NAMEEN'=>'Moderate snow','NAMECN'=>'中雪'),
	'16'=>array('NAMEEN'=>'Heavy snow','NAMECN'=>'大雪'),
	'17'=>array('NAMEEN'=>'Snowstorm','NAMECN'=>'暴雪'),
	'18'=>array('NAMEEN'=>'Foggy','NAMECN'=>'雾'),
	'19'=>array('NAMEEN'=>'Ice rain','NAMECN'=>'冻雨'),
	'20'=>array('NAMEEN'=>'Duststorm','NAMECN'=>'沙尘暴'),
	'21'=>array('NAMEEN'=>'Light to moderate rain','NAMECN'=>'小到中雨 '),
	'22'=>array('NAMEEN'=>'Moderate to heavy rain','NAMECN'=>'中到大雨'),
	'23'=>array('NAMEEN'=>'Heavy rain to storm','NAMECN'=>'大到暴雨'),
	'24'=>array('NAMEEN'=>'Storm to heavy storm','NAMECN'=>'暴雨到大暴雨'),
	'25'=>array('NAMEEN'=>'Heavy to severe storm','NAMECN'=>'大暴雨到特大暴雨'),
	'26'=>array('NAMEEN'=>'Light to moderate snow','NAMECN'=>'小到中雪 '),
	'27'=>array('NAMEEN'=>'Moderate to heavy snow','NAMECN'=>'中到大雪'),
	'28'=>array('NAMEEN'=>'Heavy snow to snowstorm','NAMECN'=>'大到暴雪'),
	'29'=>array('NAMEEN'=>'Dust','NAMECN'=>'浮尘'),
	'30'=>array('NAMEEN'=>'Sand','NAMECN'=>'扬沙'),
	'31'=>array('NAMEEN'=>'Sandstorm','NAMECN'=>'强沙尘暴'),
	'53'=>array('NAMEEN'=>'Haze','NAMECN'=>'霾'),
	'99'=>array('NAMEEN'=>'Unknown','NAMECN'=>'无'),
);
//风力编码
protected $wind_power_arr=array(
	'0'=>array('NAMEEN'=>'No wind','NAMECN'=>'无持续风向'),
	'1'=>array('NAMEEN'=>'Northeast','NAMECN'=>'东北风'),
	'2'=>array('NAMEEN'=>'East','NAMECN'=>'东风'),
	'3'=>array('NAMEEN'=>'Southeast','NAMECN'=>'东南风'),
	'4'=>array('NAMEEN'=>'South','NAMECN'=>'南风'),
	'5'=>array('NAMEEN'=>'Southwest','NAMECN'=>'西南风 '),
	'6'=>array('NAMEEN'=>'West','NAMECN'=>'西风'),
	'7'=>array('NAMEEN'=>'Northwest','NAMECN'=>'西北风'),
	'8'=>array('NAMEEN'=>'North','NAMECN'=>'北风'),
	'9'=>array('NAMEEN'=>'Whirl wind','NAMECN'=>'旋转风'),
);
//风向编码
protected $wind_direction_arr=array(
	'0'=>array('NAMEEN'=>'<10m/h','NAMECN'=>'微风'),
	'1'=>array('NAMEEN'=>'10~17m/h','NAMECN'=>'3-4 级'),
	'2'=>array('NAMEEN'=>'17~25m/h','NAMECN'=>'4-5 级'),
	'3'=>array('NAMEEN'=>'25~34m/h','NAMECN'=>'5-6 级'),
	'4'=>array('NAMEEN'=>'34~43m/h','NAMECN'=>'6-7 级'),
	'5'=>array('NAMEEN'=>'43~54m/h','NAMECN'=>'7-8 级'),
	'6'=>array('NAMEEN'=>'54~65m/h','NAMECN'=>'8-9 级'),
	'7'=>array('NAMEEN'=>'65~77m/h','NAMECN'=>'9-10 级'),
	'8'=>array('NAMEEN'=>'77~89m/h','NAMECN'=>'10-11 级'),
	'9'=>array('NAMEEN'=>'89~102m/h','NAMECN'=>'11-12 级'),
);

public $areaids_arr=array(
'101010100'=>array(
		'AREAID'=>'101010100',//区域 ID
		'NAMEEN'=>'beijing',//城市英文名
		'NAMECN'=>'北京',//城市中文名 
		'DISTRICTEN'=>'beijing',//城市所在市英文名 
		'DISTRICTCN'=>'北京',//城市所在市中文名 
		'PROVEN'=>'beijing',//城市所在省英文名 
		'PROVCN'=>'北京',//城市所在省中文名 
		'NATIONEN'=>'china',//城市所在国家英文名
		'NATIONCN'=>'中国',//城市所在国家中文名
		),
'101020100'=>array('AREAID'=>'101020100','NAMEEN'=>'shanghai','NAMECN'=>'上海','DISTRICTEN'=>'shanghai','DISTRICTCN'=>'上海','PROVEN'=>'shanghai','PROVCN'=>'上海','NATIONEN'=>'china','NATIONCN'=>'中国'),
'101030100'=>array(
		'AREAID'=>'101030100',//区域 ID
		'NAMEEN'=>'tianjin',//城市英文名
		'NAMECN'=>'天津',//城市中文名 
		'DISTRICTEN'=>'tianjin',//城市所在市英文名 
		'DISTRICTCN'=>'天津',//城市所在市中文名 
		'PROVEN'=>'tianjin',//城市所在省英文名 
		'PROVCN'=>'天津',//城市所在省中文名 
		'NATIONEN'=>'china',//城市所在国家英文名
		'NATIONCN'=>'中国',//城市所在国家中文名
		),
'101040100'=>array(
		'AREAID'=>'101040100',//区域 ID
		'NAMEEN'=>'chongqing',//城市英文名
		'NAMECN'=>'重庆',//城市中文名 
		'DISTRICTEN'=>'chongqing',//城市所在市英文名 
		'DISTRICTCN'=>'重庆',//城市所在市中文名 
		'PROVEN'=>'chongqing',//城市所在省英文名 
		'PROVCN'=>'重庆',//城市所在省中文名 
		'NATIONEN'=>'china',//城市所在国家英文名
		'NATIONCN'=>'中国',//城市所在国家中文名
		),

'101050101'=>array('AREAID'=>'101050101',	'NAMEEN'=>'haerbin',	'NAMECN'=>'哈尔滨',	'DISTRICTEN'=>'haerbin',	'DISTRICTCN'=>'哈尔滨',	'PROVEN'=>'heilongjiang',	'PROVCN'=>'黑龙江',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101050201'=>array('AREAID'=>'101050201',	'NAMEEN'=>'qiqihaer',	'NAMECN'=>'齐齐哈尔',	'DISTRICTEN'=>'qiqihaer',	'DISTRICTCN'=>'齐齐哈尔',	'PROVEN'=>'heilongjiang',	'PROVCN'=>'黑龙江',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101050301'=>array('AREAID'=>'101050301',	'NAMEEN'=>'mudanjiang',	'NAMECN'=>'牡丹江',	'DISTRICTEN'=>'mudanjiang',	'DISTRICTCN'=>'牡丹江',	'PROVEN'=>'heilongjiang',	'PROVCN'=>'黑龙江',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101050401'=>array('AREAID'=>'101050401',	'NAMEEN'=>'jiamusi',	'NAMECN'=>'佳木斯',	'DISTRICTEN'=>'jiamusi',	'DISTRICTCN'=>'佳木斯',	'PROVEN'=>'heilongjiang',	'PROVCN'=>'黑龙江',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101050501'=>array('AREAID'=>'101050501',	'NAMEEN'=>'suihua',	'NAMECN'=>'绥化',	'DISTRICTEN'=>'suihua',	'DISTRICTCN'=>'绥化',	'PROVEN'=>'heilongjiang',	'PROVCN'=>'黑龙江',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101050601'=>array('AREAID'=>'101050601',	'NAMEEN'=>'heihe',	'NAMECN'=>'黑河',	'DISTRICTEN'=>'heihe',	'DISTRICTCN'=>'黑河',	'PROVEN'=>'heilongjiang',	'PROVCN'=>'黑龙江',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101050701'=>array('AREAID'=>'101050701',	'NAMEEN'=>'daxinganling',	'NAMECN'=>'大兴安岭',	'DISTRICTEN'=>'daxinganling',	'DISTRICTCN'=>'大兴安岭',	'PROVEN'=>'heilongjiang',	'PROVCN'=>'黑龙江',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101050801'=>array('AREAID'=>'101050801',	'NAMEEN'=>'yichun',	'NAMECN'=>'伊春',	'DISTRICTEN'=>'yichun',	'DISTRICTCN'=>'伊春',	'PROVEN'=>'heilongjiang',	'PROVCN'=>'黑龙江',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101050901'=>array('AREAID'=>'101050901',	'NAMEEN'=>'daqing',	'NAMECN'=>'大庆',	'DISTRICTEN'=>'daqing',	'DISTRICTCN'=>'大庆',	'PROVEN'=>'heilongjiang',	'PROVCN'=>'黑龙江',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101051002'=>array('AREAID'=>'101051002',	'NAMEEN'=>'qitaihe',	'NAMECN'=>'七台河',	'DISTRICTEN'=>'qitaihe',	'DISTRICTCN'=>'七台河',	'PROVEN'=>'heilongjiang',	'PROVCN'=>'黑龙江',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101051101'=>array('AREAID'=>'101051101',	'NAMEEN'=>'jixi',	'NAMECN'=>'鸡西',	'DISTRICTEN'=>'jixi',	'DISTRICTCN'=>'鸡西',	'PROVEN'=>'heilongjiang',	'PROVCN'=>'黑龙江',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101051201'=>array('AREAID'=>'101051201',	'NAMEEN'=>'hegang',	'NAMECN'=>'鹤岗',	'DISTRICTEN'=>'hegang',	'DISTRICTCN'=>'鹤岗',	'PROVEN'=>'heilongjiang',	'PROVCN'=>'黑龙江',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101051301'=>array('AREAID'=>'101051301',	'NAMEEN'=>'shuangyashan',	'NAMECN'=>'双鸭山',	'DISTRICTEN'=>'shuangyashan',	'DISTRICTCN'=>'双鸭山',	'PROVEN'=>'heilongjiang',	'PROVCN'=>'黑龙江',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101060101'=>array('AREAID'=>'101060101',	'NAMEEN'=>'changchun',	'NAMECN'=>'长春',	'DISTRICTEN'=>'changchun',	'DISTRICTCN'=>'长春',	'PROVEN'=>'jilin',	'PROVCN'=>'吉林',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101060201'=>array('AREAID'=>'101060201',	'NAMEEN'=>'jilin',	'NAMECN'=>'吉林',	'DISTRICTEN'=>'jilin',	'DISTRICTCN'=>'吉林',	'PROVEN'=>'jilin',	'PROVCN'=>'吉林',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101060301'=>array('AREAID'=>'101060301',	'NAMEEN'=>'yanji',	'NAMECN'=>'延吉',	'DISTRICTEN'=>'yanji',	'DISTRICTCN'=>'延边',	'PROVEN'=>'jilin',	'PROVCN'=>'吉林',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101060401'=>array('AREAID'=>'101060401',	'NAMEEN'=>'siping',	'NAMECN'=>'四平',	'DISTRICTEN'=>'siping',	'DISTRICTCN'=>'四平',	'PROVEN'=>'jilin',	'PROVCN'=>'吉林',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101060501'=>array('AREAID'=>'101060501',	'NAMEEN'=>'tonghua',	'NAMECN'=>'通化',	'DISTRICTEN'=>'tonghua',	'DISTRICTCN'=>'通化',	'PROVEN'=>'jilin',	'PROVCN'=>'吉林',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101060601'=>array('AREAID'=>'101060601',	'NAMEEN'=>'baicheng',	'NAMECN'=>'白城',	'DISTRICTEN'=>'baicheng',	'DISTRICTCN'=>'白城',	'PROVEN'=>'jilin',	'PROVCN'=>'吉林',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101060701'=>array('AREAID'=>'101060701',	'NAMEEN'=>'liaoyuan',	'NAMECN'=>'辽源',	'DISTRICTEN'=>'liaoyuan',	'DISTRICTCN'=>'辽源',	'PROVEN'=>'jilin',	'PROVCN'=>'吉林',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101060801'=>array('AREAID'=>'101060801',	'NAMEEN'=>'songyuan',	'NAMECN'=>'松原',	'DISTRICTEN'=>'songyuan',	'DISTRICTCN'=>'松原',	'PROVEN'=>'jilin',	'PROVCN'=>'吉林',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101060901'=>array('AREAID'=>'101060901',	'NAMEEN'=>'baishan',	'NAMECN'=>'白山',	'DISTRICTEN'=>'baishan',	'DISTRICTCN'=>'白山',	'PROVEN'=>'jilin',	'PROVCN'=>'吉林',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101070101'=>array('AREAID'=>'101070101',	'NAMEEN'=>'shenyang',	'NAMECN'=>'沈阳',	'DISTRICTEN'=>'shenyang',	'DISTRICTCN'=>'沈阳',	'PROVEN'=>'liaoning',	'PROVCN'=>'辽宁',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101070201'=>array('AREAID'=>'101070201',	'NAMEEN'=>'dalian',	'NAMECN'=>'大连',	'DISTRICTEN'=>'dalian',	'DISTRICTCN'=>'大连',	'PROVEN'=>'liaoning',	'PROVCN'=>'辽宁',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101070301'=>array('AREAID'=>'101070301',	'NAMEEN'=>'anshan',	'NAMECN'=>'鞍山',	'DISTRICTEN'=>'anshan',	'DISTRICTCN'=>'鞍山',	'PROVEN'=>'liaoning',	'PROVCN'=>'辽宁',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101070401'=>array('AREAID'=>'101070401',	'NAMEEN'=>'fushun',	'NAMECN'=>'抚顺',	'DISTRICTEN'=>'fushun',	'DISTRICTCN'=>'抚顺',	'PROVEN'=>'liaoning',	'PROVCN'=>'辽宁',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101070501'=>array('AREAID'=>'101070501',	'NAMEEN'=>'benxi',	'NAMECN'=>'本溪',	'DISTRICTEN'=>'benxi',	'DISTRICTCN'=>'本溪',	'PROVEN'=>'liaoning',	'PROVCN'=>'辽宁',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101070601'=>array('AREAID'=>'101070601',	'NAMEEN'=>'dandong',	'NAMECN'=>'丹东',	'DISTRICTEN'=>'dandong',	'DISTRICTCN'=>'丹东',	'PROVEN'=>'liaoning',	'PROVCN'=>'辽宁',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101070701'=>array('AREAID'=>'101070701',	'NAMEEN'=>'jinzhou',	'NAMECN'=>'锦州',	'DISTRICTEN'=>'jinzhou',	'DISTRICTCN'=>'锦州',	'PROVEN'=>'liaoning',	'PROVCN'=>'辽宁',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101070801'=>array('AREAID'=>'101070801',	'NAMEEN'=>'yingkou',	'NAMECN'=>'营口',	'DISTRICTEN'=>'yingkou',	'DISTRICTCN'=>'营口',	'PROVEN'=>'liaoning',	'PROVCN'=>'辽宁',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101070901'=>array('AREAID'=>'101070901',	'NAMEEN'=>'fuxin',	'NAMECN'=>'阜新',	'DISTRICTEN'=>'fuxin',	'DISTRICTCN'=>'阜新',	'PROVEN'=>'liaoning',	'PROVCN'=>'辽宁',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101071001'=>array('AREAID'=>'101071001',	'NAMEEN'=>'liaoyang',	'NAMECN'=>'辽阳',	'DISTRICTEN'=>'liaoyang',	'DISTRICTCN'=>'辽阳',	'PROVEN'=>'liaoning',	'PROVCN'=>'辽宁',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101071101'=>array('AREAID'=>'101071101',	'NAMEEN'=>'tieling',	'NAMECN'=>'铁岭',	'DISTRICTEN'=>'tieling',	'DISTRICTCN'=>'铁岭',	'PROVEN'=>'liaoning',	'PROVCN'=>'辽宁',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101071201'=>array('AREAID'=>'101071201',	'NAMEEN'=>'chaoyang',	'NAMECN'=>'朝阳',	'DISTRICTEN'=>'chaoyang',	'DISTRICTCN'=>'朝阳',	'PROVEN'=>'liaoning',	'PROVCN'=>'辽宁',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101071301'=>array('AREAID'=>'101071301',	'NAMEEN'=>'panjin',	'NAMECN'=>'盘锦',	'DISTRICTEN'=>'panjin',	'DISTRICTCN'=>'盘锦',	'PROVEN'=>'liaoning',	'PROVCN'=>'辽宁',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101071401'=>array('AREAID'=>'101071401',	'NAMEEN'=>'huludao',	'NAMECN'=>'葫芦岛',	'DISTRICTEN'=>'huludao',	'DISTRICTCN'=>'葫芦岛',	'PROVEN'=>'liaoning',	'PROVCN'=>'辽宁',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101080101'=>array('AREAID'=>'101080101',	'NAMEEN'=>'huhehaote',	'NAMECN'=>'呼和浩特',	'DISTRICTEN'=>'huhehaote',	'DISTRICTCN'=>'呼和浩特',	'PROVEN'=>'neimenggu',	'PROVCN'=>'内蒙古',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101080201'=>array('AREAID'=>'101080201',	'NAMEEN'=>'baotou',	'NAMECN'=>'包头',	'DISTRICTEN'=>'baotou',	'DISTRICTCN'=>'包头',	'PROVEN'=>'neimenggu',	'PROVCN'=>'内蒙古',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101080301'=>array('AREAID'=>'101080301',	'NAMEEN'=>'wuhai',	'NAMECN'=>'乌海',	'DISTRICTEN'=>'wuhai',	'DISTRICTCN'=>'乌海',	'PROVEN'=>'neimenggu',	'PROVCN'=>'内蒙古',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101080401'=>array('AREAID'=>'101080401',	'NAMEEN'=>'jining',	'NAMECN'=>'集宁',	'DISTRICTEN'=>'jining',	'DISTRICTCN'=>'集宁',	'PROVEN'=>'neimenggu',	'PROVCN'=>'内蒙古',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101080501'=>array('AREAID'=>'101080501',	'NAMEEN'=>'tongliao',	'NAMECN'=>'通辽',	'DISTRICTEN'=>'tongliao',	'DISTRICTCN'=>'通辽',	'PROVEN'=>'neimenggu',	'PROVCN'=>'内蒙古',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101080601'=>array('AREAID'=>'101080601',	'NAMEEN'=>'chifeng',	'NAMECN'=>'赤峰',	'DISTRICTEN'=>'chifeng',	'DISTRICTCN'=>'赤峰',	'PROVEN'=>'neimenggu',	'PROVCN'=>'内蒙古',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101080701'=>array('AREAID'=>'101080701',	'NAMEEN'=>'eerduosi',	'NAMECN'=>'鄂尔多斯',	'DISTRICTEN'=>'eerduosi',	'DISTRICTCN'=>'鄂尔多斯',	'PROVEN'=>'neimenggu',	'PROVCN'=>'内蒙古',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101080801'=>array('AREAID'=>'101080801',	'NAMEEN'=>'linhe',	'NAMECN'=>'临河',	'DISTRICTEN'=>'bayannaoer',	'DISTRICTCN'=>'巴彦淖尔',	'PROVEN'=>'neimenggu',	'PROVCN'=>'内蒙古',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101080901'=>array('AREAID'=>'101080901',	'NAMEEN'=>'xilinhaote',	'NAMECN'=>'锡林浩特',	'DISTRICTEN'=>'xilinguole',	'DISTRICTCN'=>'锡林郭勒',	'PROVEN'=>'neimenggu',	'PROVCN'=>'内蒙古',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101081001'=>array('AREAID'=>'101081001',	'NAMEEN'=>'hailaer',	'NAMECN'=>'海拉尔',	'DISTRICTEN'=>'hulunbeier',	'DISTRICTCN'=>'呼伦贝尔',	'PROVEN'=>'neimenggu',	'PROVCN'=>'内蒙古',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101081101'=>array('AREAID'=>'101081101',	'NAMEEN'=>'wulanhaote',	'NAMECN'=>'乌兰浩特',	'DISTRICTEN'=>'xinganmeng',	'DISTRICTCN'=>'兴安盟',	'PROVEN'=>'neimenggu',	'PROVCN'=>'内蒙古',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101081201'=>array('AREAID'=>'101081201',	'NAMEEN'=>'azuoqi',	'NAMECN'=>'阿左旗',	'DISTRICTEN'=>'alashanmeng',	'DISTRICTCN'=>'阿拉善盟',	'PROVEN'=>'neimenggu',	'PROVCN'=>'内蒙古',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101090101'=>array('AREAID'=>'101090101',	'NAMEEN'=>'shijiazhuang',	'NAMECN'=>'石家庄',	'DISTRICTEN'=>'shijiazhuang',	'DISTRICTCN'=>'石家庄',	'PROVEN'=>'hebei',	'PROVCN'=>'河北',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101090201'=>array('AREAID'=>'101090201',	'NAMEEN'=>'baoding',	'NAMECN'=>'保定',	'DISTRICTEN'=>'baoding',	'DISTRICTCN'=>'保定',	'PROVEN'=>'hebei',	'PROVCN'=>'河北',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101090301'=>array('AREAID'=>'101090301',	'NAMEEN'=>'zhangjiakou',	'NAMECN'=>'张家口',	'DISTRICTEN'=>'zhangjiakou',	'DISTRICTCN'=>'张家口',	'PROVEN'=>'hebei',	'PROVCN'=>'河北',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101090402'=>array('AREAID'=>'101090402',	'NAMEEN'=>'chengde',	'NAMECN'=>'承德',	'DISTRICTEN'=>'chengde',	'DISTRICTCN'=>'承德',	'PROVEN'=>'hebei',	'PROVCN'=>'河北',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101090501'=>array('AREAID'=>'101090501',	'NAMEEN'=>'tangshan',	'NAMECN'=>'唐山',	'DISTRICTEN'=>'tangshan',	'DISTRICTCN'=>'唐山',	'PROVEN'=>'hebei',	'PROVCN'=>'河北',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101090601'=>array('AREAID'=>'101090601',	'NAMEEN'=>'langfang',	'NAMECN'=>'廊坊',	'DISTRICTEN'=>'langfang',	'DISTRICTCN'=>'廊坊',	'PROVEN'=>'hebei',	'PROVCN'=>'河北',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101090701'=>array('AREAID'=>'101090701',	'NAMEEN'=>'cangzhou',	'NAMECN'=>'沧州',	'DISTRICTEN'=>'cangzhou',	'DISTRICTCN'=>'沧州',	'PROVEN'=>'hebei',	'PROVCN'=>'河北',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101090801'=>array('AREAID'=>'101090801',	'NAMEEN'=>'hengshui',	'NAMECN'=>'衡水',	'DISTRICTEN'=>'hengshui',	'DISTRICTCN'=>'衡水',	'PROVEN'=>'hebei',	'PROVCN'=>'河北',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101090901'=>array('AREAID'=>'101090901',	'NAMEEN'=>'xingtai',	'NAMECN'=>'邢台',	'DISTRICTEN'=>'xingtai',	'DISTRICTCN'=>'邢台',	'PROVEN'=>'hebei',	'PROVCN'=>'河北',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101091001'=>array('AREAID'=>'101091001',	'NAMEEN'=>'handan',	'NAMECN'=>'邯郸',	'DISTRICTEN'=>'handan',	'DISTRICTCN'=>'邯郸',	'PROVEN'=>'hebei',	'PROVCN'=>'河北',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101091101'=>array('AREAID'=>'101091101',	'NAMEEN'=>'qinhuangdao',	'NAMECN'=>'秦皇岛',	'DISTRICTEN'=>'qinhuangdao',	'DISTRICTCN'=>'秦皇岛',	'PROVEN'=>'hebei',	'PROVCN'=>'河北',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101100101'=>array('AREAID'=>'101100101',	'NAMEEN'=>'taiyuan',	'NAMECN'=>'太原',	'DISTRICTEN'=>'taiyuan',	'DISTRICTCN'=>'太原',	'PROVEN'=>'shanxi',	'PROVCN'=>'山西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101100201'=>array('AREAID'=>'101100201',	'NAMEEN'=>'datong',	'NAMECN'=>'大同',	'DISTRICTEN'=>'datong',	'DISTRICTCN'=>'大同',	'PROVEN'=>'shanxi',	'PROVCN'=>'山西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101100301'=>array('AREAID'=>'101100301',	'NAMEEN'=>'yangquan',	'NAMECN'=>'阳泉',	'DISTRICTEN'=>'yangquan',	'DISTRICTCN'=>'阳泉',	'PROVEN'=>'shanxi',	'PROVCN'=>'山西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101100401'=>array('AREAID'=>'101100401',	'NAMEEN'=>'jinzhong',	'NAMECN'=>'晋中',	'DISTRICTEN'=>'jinzhong',	'DISTRICTCN'=>'晋中',	'PROVEN'=>'shanxi',	'PROVCN'=>'山西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101100501'=>array('AREAID'=>'101100501',	'NAMEEN'=>'changzhi',	'NAMECN'=>'长治',	'DISTRICTEN'=>'changzhi',	'DISTRICTCN'=>'长治',	'PROVEN'=>'shanxi',	'PROVCN'=>'山西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101100601'=>array('AREAID'=>'101100601',	'NAMEEN'=>'jincheng',	'NAMECN'=>'晋城',	'DISTRICTEN'=>'jincheng',	'DISTRICTCN'=>'晋城',	'PROVEN'=>'shanxi',	'PROVCN'=>'山西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101100701'=>array('AREAID'=>'101100701',	'NAMEEN'=>'linfen',	'NAMECN'=>'临汾',	'DISTRICTEN'=>'linfen',	'DISTRICTCN'=>'临汾',	'PROVEN'=>'shanxi',	'PROVCN'=>'山西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101100801'=>array('AREAID'=>'101100801',	'NAMEEN'=>'yuncheng',	'NAMECN'=>'运城',	'DISTRICTEN'=>'yuncheng',	'DISTRICTCN'=>'运城',	'PROVEN'=>'shanxi',	'PROVCN'=>'山西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101100901'=>array('AREAID'=>'101100901',	'NAMEEN'=>'shuozhou',	'NAMECN'=>'朔州',	'DISTRICTEN'=>'shuozhou',	'DISTRICTCN'=>'朔州',	'PROVEN'=>'shanxi',	'PROVCN'=>'山西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101101001'=>array('AREAID'=>'101101001',	'NAMEEN'=>'xinzhou',	'NAMECN'=>'忻州',	'DISTRICTEN'=>'xinzhou',	'DISTRICTCN'=>'忻州',	'PROVEN'=>'shanxi',	'PROVCN'=>'山西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101101100'=>array('AREAID'=>'101101100',	'NAMEEN'=>'lvliang',	'NAMECN'=>'吕梁',	'DISTRICTEN'=>'lvliang',	'DISTRICTCN'=>'吕梁',	'PROVEN'=>'shanxi',	'PROVCN'=>'山西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101110101'=>array('AREAID'=>'101110101',	'NAMEEN'=>'xian',	'NAMECN'=>'西安',	'DISTRICTEN'=>'xian',	'DISTRICTCN'=>'西安',	'PROVEN'=>'shan-xi',	'PROVCN'=>'陕西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101110200'=>array('AREAID'=>'101110200',	'NAMEEN'=>'xianyang',	'NAMECN'=>'咸阳',	'DISTRICTEN'=>'xianyang',	'DISTRICTCN'=>'咸阳',	'PROVEN'=>'shan-xi',	'PROVCN'=>'陕西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101110300'=>array('AREAID'=>'101110300',	'NAMEEN'=>'yanan',	'NAMECN'=>'延安',	'DISTRICTEN'=>'yanan',	'DISTRICTCN'=>'延安',	'PROVEN'=>'shan-xi',	'PROVCN'=>'陕西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101110401'=>array('AREAID'=>'101110401',	'NAMEEN'=>'yulin',	'NAMECN'=>'榆林',	'DISTRICTEN'=>'yulin',	'DISTRICTCN'=>'榆林',	'PROVEN'=>'shan-xi',	'PROVCN'=>'陕西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101110501'=>array('AREAID'=>'101110501',	'NAMEEN'=>'weinan',	'NAMECN'=>'渭南',	'DISTRICTEN'=>'weinan',	'DISTRICTCN'=>'渭南',	'PROVEN'=>'shan-xi',	'PROVCN'=>'陕西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101110601'=>array('AREAID'=>'101110601',	'NAMEEN'=>'shangluo',	'NAMECN'=>'商洛',	'DISTRICTEN'=>'shangluo',	'DISTRICTCN'=>'商洛',	'PROVEN'=>'shan-xi',	'PROVCN'=>'陕西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101110701'=>array('AREAID'=>'101110701',	'NAMEEN'=>'ankang',	'NAMECN'=>'安康',	'DISTRICTEN'=>'ankang',	'DISTRICTCN'=>'安康',	'PROVEN'=>'shan-xi',	'PROVCN'=>'陕西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101110801'=>array('AREAID'=>'101110801',	'NAMEEN'=>'hanzhong',	'NAMECN'=>'汉中',	'DISTRICTEN'=>'hanzhong',	'DISTRICTCN'=>'汉中',	'PROVEN'=>'shan-xi',	'PROVCN'=>'陕西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101110901'=>array('AREAID'=>'101110901',	'NAMEEN'=>'baoji',	'NAMECN'=>'宝鸡',	'DISTRICTEN'=>'baoji',	'DISTRICTCN'=>'宝鸡',	'PROVEN'=>'shan-xi',	'PROVCN'=>'陕西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101111001'=>array('AREAID'=>'101111001',	'NAMEEN'=>'tongchuan',	'NAMECN'=>'铜川',	'DISTRICTEN'=>'tongchuan',	'DISTRICTCN'=>'铜川',	'PROVEN'=>'shan-xi',	'PROVCN'=>'陕西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101111101'=>array('AREAID'=>'101111101',	'NAMEEN'=>'yangling',	'NAMECN'=>'杨凌',	'DISTRICTEN'=>'yangling',	'DISTRICTCN'=>'杨凌',	'PROVEN'=>'shan-xi',	'PROVCN'=>'陕西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101120101'=>array('AREAID'=>'101120101',	'NAMEEN'=>'jinan',	'NAMECN'=>'济南',	'DISTRICTEN'=>'jinan',	'DISTRICTCN'=>'济南',	'PROVEN'=>'shandong',	'PROVCN'=>'山东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101120201'=>array('AREAID'=>'101120201',	'NAMEEN'=>'qingdao',	'NAMECN'=>'青岛',	'DISTRICTEN'=>'qingdao',	'DISTRICTCN'=>'青岛',	'PROVEN'=>'shandong',	'PROVCN'=>'山东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101120301'=>array('AREAID'=>'101120301',	'NAMEEN'=>'zibo',	'NAMECN'=>'淄博',	'DISTRICTEN'=>'zibo',	'DISTRICTCN'=>'淄博',	'PROVEN'=>'shandong',	'PROVCN'=>'山东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101120401'=>array('AREAID'=>'101120401',	'NAMEEN'=>'dezhou',	'NAMECN'=>'德州',	'DISTRICTEN'=>'dezhou',	'DISTRICTCN'=>'德州',	'PROVEN'=>'shandong',	'PROVCN'=>'山东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101120501'=>array('AREAID'=>'101120501',	'NAMEEN'=>'yantai',	'NAMECN'=>'烟台',	'DISTRICTEN'=>'yantai',	'DISTRICTCN'=>'烟台',	'PROVEN'=>'shandong',	'PROVCN'=>'山东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101120601'=>array('AREAID'=>'101120601',	'NAMEEN'=>'weifang',	'NAMECN'=>'潍坊',	'DISTRICTEN'=>'weifang',	'DISTRICTCN'=>'潍坊',	'PROVEN'=>'shandong',	'PROVCN'=>'山东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101120701'=>array('AREAID'=>'101120701',	'NAMEEN'=>'jining',	'NAMECN'=>'济宁',	'DISTRICTEN'=>'jining',	'DISTRICTCN'=>'济宁',	'PROVEN'=>'shandong',	'PROVCN'=>'山东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101120801'=>array('AREAID'=>'101120801',	'NAMEEN'=>'taian',	'NAMECN'=>'泰安',	'DISTRICTEN'=>'taian',	'DISTRICTCN'=>'泰安',	'PROVEN'=>'shandong',	'PROVCN'=>'山东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101120901'=>array('AREAID'=>'101120901',	'NAMEEN'=>'linyi',	'NAMECN'=>'临沂',	'DISTRICTEN'=>'linyi',	'DISTRICTCN'=>'临沂',	'PROVEN'=>'shandong',	'PROVCN'=>'山东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101121001'=>array('AREAID'=>'101121001',	'NAMEEN'=>'heze',	'NAMECN'=>'菏泽',	'DISTRICTEN'=>'heze',	'DISTRICTCN'=>'菏泽',	'PROVEN'=>'shandong',	'PROVCN'=>'山东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101121101'=>array('AREAID'=>'101121101',	'NAMEEN'=>'binzhou',	'NAMECN'=>'滨州',	'DISTRICTEN'=>'binzhou',	'DISTRICTCN'=>'滨州',	'PROVEN'=>'shandong',	'PROVCN'=>'山东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101121201'=>array('AREAID'=>'101121201',	'NAMEEN'=>'dongying',	'NAMECN'=>'东营',	'DISTRICTEN'=>'dongying',	'DISTRICTCN'=>'东营',	'PROVEN'=>'shandong',	'PROVCN'=>'山东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101121301'=>array('AREAID'=>'101121301',	'NAMEEN'=>'weihai',	'NAMECN'=>'威海',	'DISTRICTEN'=>'weihai',	'DISTRICTCN'=>'威海',	'PROVEN'=>'shandong',	'PROVCN'=>'山东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101121401'=>array('AREAID'=>'101121401',	'NAMEEN'=>'zaozhuang',	'NAMECN'=>'枣庄',	'DISTRICTEN'=>'zaozhuang',	'DISTRICTCN'=>'枣庄',	'PROVEN'=>'shandong',	'PROVCN'=>'山东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101121501'=>array('AREAID'=>'101121501',	'NAMEEN'=>'rizhao',	'NAMECN'=>'日照',	'DISTRICTEN'=>'rizhao',	'DISTRICTCN'=>'日照',	'PROVEN'=>'shandong',	'PROVCN'=>'山东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101121601'=>array('AREAID'=>'101121601',	'NAMEEN'=>'laiwu',	'NAMECN'=>'莱芜',	'DISTRICTEN'=>'laiwu',	'DISTRICTCN'=>'莱芜',	'PROVEN'=>'shandong',	'PROVCN'=>'山东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101121701'=>array('AREAID'=>'101121701',	'NAMEEN'=>'liaocheng',	'NAMECN'=>'聊城',	'DISTRICTEN'=>'liaocheng',	'DISTRICTCN'=>'聊城',	'PROVEN'=>'shandong',	'PROVCN'=>'山东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101130101'=>array('AREAID'=>'101130101',	'NAMEEN'=>'wulumuqi',	'NAMECN'=>'乌鲁木齐',	'DISTRICTEN'=>'wulumuqi',	'DISTRICTCN'=>'乌鲁木齐',	'PROVEN'=>'xinjiang',	'PROVCN'=>'新疆',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),

'101130201'=>array('AREAID'=>'101130201',	'NAMEEN'=>'kelamayi',	'NAMECN'=>'克拉玛依',	'DISTRICTEN'=>'kelamayi',	'DISTRICTCN'=>'克拉玛依',	'PROVEN'=>'xinjiang',	'PROVCN'=>'新疆',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101130301'=>array('AREAID'=>'101130301',	'NAMEEN'=>'shihezi',	'NAMECN'=>'石河子',	'DISTRICTEN'=>'shihezi',	'DISTRICTCN'=>'石河子',	'PROVEN'=>'xinjiang',	'PROVCN'=>'新疆',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101130401'=>array('AREAID'=>'101130401',	'NAMEEN'=>'changji',	'NAMECN'=>'昌吉',	'DISTRICTEN'=>'changji',	'DISTRICTCN'=>'昌吉',	'PROVEN'=>'xinjiang',	'PROVCN'=>'新疆',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101130501'=>array('AREAID'=>'101130501',	'NAMEEN'=>'tulufan',	'NAMECN'=>'吐鲁番',	'DISTRICTEN'=>'tulufan',	'DISTRICTCN'=>'吐鲁番',	'PROVEN'=>'xinjiang',	'PROVCN'=>'新疆',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101130601'=>array('AREAID'=>'101130601',	'NAMEEN'=>'kuerle',	'NAMECN'=>'库尔勒',	'DISTRICTEN'=>'bayinguoleng',	'DISTRICTCN'=>'巴音郭楞',	'PROVEN'=>'xinjiang',	'PROVCN'=>'新疆',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101130701'=>array('AREAID'=>'101130701',	'NAMEEN'=>'alaer',	'NAMECN'=>'阿拉尔',	'DISTRICTEN'=>'alaer',	'DISTRICTCN'=>'阿拉尔',	'PROVEN'=>'xinjiang',	'PROVCN'=>'新疆',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101130801'=>array('AREAID'=>'101130801',	'NAMEEN'=>'akesu',	'NAMECN'=>'阿克苏',	'DISTRICTEN'=>'akesu',	'DISTRICTCN'=>'阿克苏',	'PROVEN'=>'xinjiang',	'PROVCN'=>'新疆',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101130901'=>array('AREAID'=>'101130901',	'NAMEEN'=>'kashi',	'NAMECN'=>'喀什',	'DISTRICTEN'=>'kashi',	'DISTRICTCN'=>'喀什',	'PROVEN'=>'xinjiang',	'PROVCN'=>'新疆',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),

'101131001'=>array('AREAID'=>'101131001',	'NAMEEN'=>'yining',	'NAMECN'=>'伊犁',	'DISTRICTEN'=>'yining',	'DISTRICTCN'=>'伊犁',	'PROVEN'=>'xinjiang',	'PROVCN'=>'新疆',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101131101'=>array('AREAID'=>'101131101',	'NAMEEN'=>'tacheng',	'NAMECN'=>'塔城',	'DISTRICTEN'=>'tacheng',	'DISTRICTCN'=>'塔城',	'PROVEN'=>'xinjiang',	'PROVCN'=>'新疆',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101131201'=>array('AREAID'=>'101131201',	'NAMEEN'=>'hami',	'NAMECN'=>'哈密',	'DISTRICTEN'=>'hami',	'DISTRICTCN'=>'哈密',	'PROVEN'=>'xinjiang',	'PROVCN'=>'新疆',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101131301'=>array('AREAID'=>'101131301',	'NAMEEN'=>'hetian',	'NAMECN'=>'和田',	'DISTRICTEN'=>'hetian',	'DISTRICTCN'=>'和田',	'PROVEN'=>'xinjiang',	'PROVCN'=>'新疆',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101131401'=>array('AREAID'=>'101131401',	'NAMEEN'=>'xinjiang',	'NAMECN'=>'阿勒泰',	'DISTRICTEN'=>'xinjiang',	'DISTRICTCN'=>'阿勒泰',	'PROVEN'=>'xinjiang',	'PROVCN'=>'新疆',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101131501'=>array('AREAID'=>'101131501',	'NAMEEN'=>'atushi',	'NAMECN'=>'阿图什',	'DISTRICTEN'=>'kezhou',	'DISTRICTCN'=>'克州',	'PROVEN'=>'xinjiang',	'PROVCN'=>'新疆',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101131601'=>array('AREAID'=>'101131601',	'NAMEEN'=>'bole',	'NAMECN'=>'博乐',	'DISTRICTEN'=>'boertala',	'DISTRICTCN'=>'博尔塔拉',	'PROVEN'=>'xinjiang',	'PROVCN'=>'新疆',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101140101'=>array('AREAID'=>'101140101',	'NAMEEN'=>'lasa',	'NAMECN'=>'拉萨',	'DISTRICTEN'=>'lasa',	'DISTRICTCN'=>'拉萨',	'PROVEN'=>'xizang',	'PROVCN'=>'西藏',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101140201'=>array('AREAID'=>'101140201',	'NAMEEN'=>'rikaze',	'NAMECN'=>'日喀则',	'DISTRICTEN'=>'rikaze',	'DISTRICTCN'=>'日喀则',	'PROVEN'=>'xizang',	'PROVCN'=>'西藏',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101140301'=>array('AREAID'=>'101140301',	'NAMEEN'=>'shannan',	'NAMECN'=>'山南',	'DISTRICTEN'=>'shannan',	'DISTRICTCN'=>'山南',	'PROVEN'=>'xizang',	'PROVCN'=>'西藏',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101140401'=>array('AREAID'=>'101140401',	'NAMEEN'=>'linzhi',	'NAMECN'=>'林芝',	'DISTRICTEN'=>'linzhi',	'DISTRICTCN'=>'林芝',	'PROVEN'=>'xizang',	'PROVCN'=>'西藏',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101140501'=>array('AREAID'=>'101140501',	'NAMEEN'=>'changdu',	'NAMECN'=>'昌都',	'DISTRICTEN'=>'changdu',	'DISTRICTCN'=>'昌都',	'PROVEN'=>'xizang',	'PROVCN'=>'西藏',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101140601'=>array('AREAID'=>'101140601',	'NAMEEN'=>'naqu',	'NAMECN'=>'那曲',	'DISTRICTEN'=>'naqu',	'DISTRICTCN'=>'那曲',	'PROVEN'=>'xizang',	'PROVCN'=>'西藏',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101140701'=>array('AREAID'=>'101140701',	'NAMEEN'=>'ali',	'NAMECN'=>'阿里',	'DISTRICTEN'=>'ali',	'DISTRICTCN'=>'阿里',	'PROVEN'=>'xizang',	'PROVCN'=>'西藏',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101150101'=>array('AREAID'=>'101150101',	'NAMEEN'=>'xining',	'NAMECN'=>'西宁',	'DISTRICTEN'=>'xining',	'DISTRICTCN'=>'西宁',	'PROVEN'=>'qinghai',	'PROVCN'=>'青海',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101150201'=>array('AREAID'=>'101150201',	'NAMEEN'=>'haidong',	'NAMECN'=>'海东',	'DISTRICTEN'=>'haidong',	'DISTRICTCN'=>'海东',	'PROVEN'=>'qinghai',	'PROVCN'=>'青海',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101150201'=>array('AREAID'=>'101150301',	'NAMEEN'=>'huangnan',	'NAMECN'=>'黄南',	'DISTRICTEN'=>'huangnan',	'DISTRICTCN'=>'黄南',	'PROVEN'=>'qinghai',	'PROVCN'=>'青海',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101150401'=>array('AREAID'=>'101150401',	'NAMEEN'=>'hainan',	'NAMECN'=>'海南',	'DISTRICTEN'=>'hainan',	'DISTRICTCN'=>'海南',	'PROVEN'=>'qinghai',	'PROVCN'=>'青海',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),

'101150501'=>array('AREAID'=>'101150501',	'NAMEEN'=>'guoluo',	'NAMECN'=>'果洛',	'DISTRICTEN'=>'guoluo',	'DISTRICTCN'=>'果洛',	'PROVEN'=>'qinghai',	'PROVCN'=>'青海',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101150601'=>array('AREAID'=>'101150601',	'NAMEEN'=>'yushu',	'NAMECN'=>'玉树',	'DISTRICTEN'=>'yushu',	'DISTRICTCN'=>'玉树',	'PROVEN'=>'qinghai',	'PROVCN'=>'青海',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101150701'=>array('AREAID'=>'101150701',	'NAMEEN'=>'haixi',	'NAMECN'=>'海西',	'DISTRICTEN'=>'haixi',	'DISTRICTCN'=>'海西',	'PROVEN'=>'qinghai',	'PROVCN'=>'青海',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101150801'=>array('AREAID'=>'101150801',	'NAMEEN'=>'haibei',	'NAMECN'=>'海北',	'DISTRICTEN'=>'haibei',	'DISTRICTCN'=>'海北',	'PROVEN'=>'qinghai',	'PROVCN'=>'青海',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101150901'=>array('AREAID'=>'101150901',	'NAMEEN'=>'geermu',	'NAMECN'=>'格尔木',	'DISTRICTEN'=>'geermu',	'DISTRICTCN'=>'格尔木',	'PROVEN'=>'qinghai',	'PROVCN'=>'青海',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101160101'=>array('AREAID'=>'101160101',	'NAMEEN'=>'lanzhou',	'NAMECN'=>'兰州',	'DISTRICTEN'=>'lanzhou',	'DISTRICTCN'=>'兰州',	'PROVEN'=>'gansu',	'PROVCN'=>'甘肃',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101160201'=>array('AREAID'=>'101160201',	'NAMEEN'=>'dingxi',	'NAMECN'=>'定西',	'DISTRICTEN'=>'dingxi',	'DISTRICTCN'=>'定西',	'PROVEN'=>'gansu',	'PROVCN'=>'甘肃',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101160301'=>array('AREAID'=>'101160301',	'NAMEEN'=>'pingliang',	'NAMECN'=>'平凉',	'DISTRICTEN'=>'pingliang',	'DISTRICTCN'=>'平凉',	'PROVEN'=>'gansu',	'PROVCN'=>'甘肃',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101160401'=>array('AREAID'=>'101160401',	'NAMEEN'=>'qingyang',	'NAMECN'=>'庆阳',	'DISTRICTEN'=>'qingyang',	'DISTRICTCN'=>'庆阳',	'PROVEN'=>'gansu',	'PROVCN'=>'甘肃',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101160501'=>array('AREAID'=>'101160501',	'NAMEEN'=>'wuwei',	'NAMECN'=>'武威',	'DISTRICTEN'=>'wuwei',	'DISTRICTCN'=>'武威',	'PROVEN'=>'gansu',	'PROVCN'=>'甘肃',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101160601'=>array('AREAID'=>'101160601',	'NAMEEN'=>'jinchang',	'NAMECN'=>'金昌',	'DISTRICTEN'=>'jinchang',	'DISTRICTCN'=>'金昌',	'PROVEN'=>'gansu',	'PROVCN'=>'甘肃',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101160701'=>array('AREAID'=>'101160701',	'NAMEEN'=>'zhangye',	'NAMECN'=>'张掖',	'DISTRICTEN'=>'zhangye',	'DISTRICTCN'=>'张掖',	'PROVEN'=>'gansu',	'PROVCN'=>'甘肃',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101160801'=>array('AREAID'=>'101160801',	'NAMEEN'=>'jiuquan',	'NAMECN'=>'酒泉',	'DISTRICTEN'=>'jiuquan',	'DISTRICTCN'=>'酒泉',	'PROVEN'=>'gansu',	'PROVCN'=>'甘肃',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101160901'=>array('AREAID'=>'101160901',	'NAMEEN'=>'tianshui',	'NAMECN'=>'天水',	'DISTRICTEN'=>'tianshui',	'DISTRICTCN'=>'天水',	'PROVEN'=>'gansu',	'PROVCN'=>'甘肃',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101161001'=>array('AREAID'=>'101161001',	'NAMEEN'=>'wudu',	'NAMECN'=>'武都',	'DISTRICTEN'=>'longnan',	'DISTRICTCN'=>'陇南',	'PROVEN'=>'gansu',	'PROVCN'=>'甘肃',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101161101'=>array('AREAID'=>'101161101',	'NAMEEN'=>'linxia',	'NAMECN'=>'临夏',	'DISTRICTEN'=>'linxia',	'DISTRICTCN'=>'临夏',	'PROVEN'=>'gansu',	'PROVCN'=>'甘肃',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101161201'=>array('AREAID'=>'101161201',	'NAMEEN'=>'hezuo',	'NAMECN'=>'合作',	'DISTRICTEN'=>'gannan',	'DISTRICTCN'=>'甘南',	'PROVEN'=>'gansu',	'PROVCN'=>'甘肃',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),

'101161301'=>array('AREAID'=>'101161301',	'NAMEEN'=>'baiyin',	'NAMECN'=>'白银',	'DISTRICTEN'=>'baiyin',	'DISTRICTCN'=>'白银',	'PROVEN'=>'gansu',	'PROVCN'=>'甘肃',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101161401'=>array('AREAID'=>'101161401',	'NAMEEN'=>'jiayuguan',	'NAMECN'=>'嘉峪关',	'DISTRICTEN'=>'jiayuguan',	'DISTRICTCN'=>'嘉峪关',	'PROVEN'=>'gansu',	'PROVCN'=>'甘肃',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101170101'=>array('AREAID'=>'101170101',	'NAMEEN'=>'yinchuan',	'NAMECN'=>'银川',	'DISTRICTEN'=>'yinchuan',	'DISTRICTCN'=>'银川',	'PROVEN'=>'ningxia',	'PROVCN'=>'宁夏',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101170301'=>array('AREAID'=>'101170301',	'NAMEEN'=>'wuzhong',	'NAMECN'=>'吴忠',	'DISTRICTEN'=>'wuzhong',	'DISTRICTCN'=>'吴忠',	'PROVEN'=>'ningxia',	'PROVCN'=>'宁夏',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101170401'=>array('AREAID'=>'101170401',	'NAMEEN'=>'guyuan',	'NAMECN'=>'固原',	'DISTRICTEN'=>'guyuan',	'DISTRICTCN'=>'固原',	'PROVEN'=>'ningxia',	'PROVCN'=>'宁夏',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101170501'=>array('AREAID'=>'101170501',	'NAMEEN'=>'zhongwei',	'NAMECN'=>'中卫',	'DISTRICTEN'=>'zhongwei',	'DISTRICTCN'=>'中卫',	'PROVEN'=>'ningxia',	'PROVCN'=>'宁夏',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101180101'=>array('AREAID'=>'101180101',	'NAMEEN'=>'zhengzhou',	'NAMECN'=>'郑州',	'DISTRICTEN'=>'zhengzhou',	'DISTRICTCN'=>'郑州',	'PROVEN'=>'henan',	'PROVCN'=>'河南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101180201'=>array('AREAID'=>'101180201',	'NAMEEN'=>'anyang',	'NAMECN'=>'安阳',	'DISTRICTEN'=>'anyang',	'DISTRICTCN'=>'安阳',	'PROVEN'=>'henan',	'PROVCN'=>'河南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101180301'=>array('AREAID'=>'101180301',	'NAMEEN'=>'xinxiang',	'NAMECN'=>'新乡',	'DISTRICTEN'=>'xinxiang',	'DISTRICTCN'=>'新乡',	'PROVEN'=>'henan',	'PROVCN'=>'河南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101180401'=>array('AREAID'=>'101180401',	'NAMEEN'=>'xuchang',	'NAMECN'=>'许昌',	'DISTRICTEN'=>'xuchang',	'DISTRICTCN'=>'许昌',	'PROVEN'=>'henan',	'PROVCN'=>'河南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101180501'=>array('AREAID'=>'101180501',	'NAMEEN'=>'pingdingshan',	'NAMECN'=>'平顶山',	'DISTRICTEN'=>'pingdingshan',	'DISTRICTCN'=>'平顶山',	'PROVEN'=>'henan',	'PROVCN'=>'河南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101180601'=>array('AREAID'=>'101180601',	'NAMEEN'=>'xinyang',	'NAMECN'=>'信阳',	'DISTRICTEN'=>'xinyang',	'DISTRICTCN'=>'信阳',	'PROVEN'=>'henan',	'PROVCN'=>'河南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101180701'=>array('AREAID'=>'101180701',	'NAMEEN'=>'nanyang',	'NAMECN'=>'南阳',	'DISTRICTEN'=>'nanyang',	'DISTRICTCN'=>'南阳',	'PROVEN'=>'henan',	'PROVCN'=>'河南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101180801'=>array('AREAID'=>'101180801',	'NAMEEN'=>'kaifeng',	'NAMECN'=>'开封',	'DISTRICTEN'=>'kaifeng',	'DISTRICTCN'=>'开封',	'PROVEN'=>'henan',	'PROVCN'=>'河南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101180901'=>array('AREAID'=>'101180901',	'NAMEEN'=>'luoyang',	'NAMECN'=>'洛阳',	'DISTRICTEN'=>'luoyang',	'DISTRICTCN'=>'洛阳',	'PROVEN'=>'henan',	'PROVCN'=>'河南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101181001'=>array('AREAID'=>'101181001',	'NAMEEN'=>'shangqiu',	'NAMECN'=>'商丘',	'DISTRICTEN'=>'shangqiu',	'DISTRICTCN'=>'商丘',	'PROVEN'=>'henan',	'PROVCN'=>'河南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101181101'=>array('AREAID'=>'101181101',	'NAMEEN'=>'jiaozuo',	'NAMECN'=>'焦作',	'DISTRICTEN'=>'jiaozuo',	'DISTRICTCN'=>'焦作',	'PROVEN'=>'henan',	'PROVCN'=>'河南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101181201'=>array('AREAID'=>'101181201',	'NAMEEN'=>'hebi',	'NAMECN'=>'鹤壁',	'DISTRICTEN'=>'hebi',	'DISTRICTCN'=>'鹤壁',	'PROVEN'=>'henan',	'PROVCN'=>'河南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101181301'=>array('AREAID'=>'101181301',	'NAMEEN'=>'puyang',	'NAMECN'=>'濮阳',	'DISTRICTEN'=>'puyang',	'DISTRICTCN'=>'濮阳',	'PROVEN'=>'henan',	'PROVCN'=>'河南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101181401'=>array('AREAID'=>'101181401',	'NAMEEN'=>'zhoukou',	'NAMECN'=>'周口',	'DISTRICTEN'=>'zhoukou',	'DISTRICTCN'=>'周口',	'PROVEN'=>'henan',	'PROVCN'=>'河南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101181501'=>array('AREAID'=>'101181501',	'NAMEEN'=>'luohe',	'NAMECN'=>'漯河',	'DISTRICTEN'=>'luohe',	'DISTRICTCN'=>'漯河',	'PROVEN'=>'henan',	'PROVCN'=>'河南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101181601'=>array('AREAID'=>'101181601',	'NAMEEN'=>'zhumadian',	'NAMECN'=>'驻马店',	'DISTRICTEN'=>'zhumadian',	'DISTRICTCN'=>'驻马店',	'PROVEN'=>'henan',	'PROVCN'=>'河南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101181701'=>array('AREAID'=>'101181701',	'NAMEEN'=>'sanmenxia',	'NAMECN'=>'三门峡',	'DISTRICTEN'=>'sanmenxia',	'DISTRICTCN'=>'三门峡',	'PROVEN'=>'henan',	'PROVCN'=>'河南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101181801'=>array('AREAID'=>'101181801',	'NAMEEN'=>'jiyuan',	'NAMECN'=>'济源',	'DISTRICTEN'=>'jiyuan',	'DISTRICTCN'=>'济源',	'PROVEN'=>'henan',	'PROVCN'=>'河南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101190101'=>array('AREAID'=>'101190101',	'NAMEEN'=>'nanjing',	'NAMECN'=>'南京',	'DISTRICTEN'=>'nanjing',	'DISTRICTCN'=>'南京',	'PROVEN'=>'henan',	'PROVCN'=>'河南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101190201'=>array('AREAID'=>'101190201',	'NAMEEN'=>'wuxi',	'NAMECN'=>'无锡',	'DISTRICTEN'=>'wuxi',	'DISTRICTCN'=>'无锡',	'PROVEN'=>'jiangsu',	'PROVCN'=>'江苏',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101190301'=>array('AREAID'=>'101190301',	'NAMEEN'=>'zhenjiang',	'NAMECN'=>'镇江',	'DISTRICTEN'=>'zhenjiang',	'DISTRICTCN'=>'镇江',	'PROVEN'=>'jiangsu',	'PROVCN'=>'江苏',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101190401'=>array('AREAID'=>'101190401',	'NAMEEN'=>'suzhou',	'NAMECN'=>'苏州',	'DISTRICTEN'=>'suzhou',	'DISTRICTCN'=>'苏州',	'PROVEN'=>'jiangsu',	'PROVCN'=>'江苏',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101190501'=>array('AREAID'=>'101190501',	'NAMEEN'=>'nantong',	'NAMECN'=>'南通',	'DISTRICTEN'=>'nantong',	'DISTRICTCN'=>'南通',	'PROVEN'=>'jiangsu',	'PROVCN'=>'江苏',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101190601'=>array('AREAID'=>'101190601',	'NAMEEN'=>'yangzhou',	'NAMECN'=>'扬州',	'DISTRICTEN'=>'yangzhou',	'DISTRICTCN'=>'扬州',	'PROVEN'=>'jiangsu',	'PROVCN'=>'江苏',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101190701'=>array('AREAID'=>'101190701',	'NAMEEN'=>'yancheng',	'NAMECN'=>'盐城',	'DISTRICTEN'=>'yancheng',	'DISTRICTCN'=>'盐城',	'PROVEN'=>'jiangsu',	'PROVCN'=>'江苏',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101190801'=>array('AREAID'=>'101190801',	'NAMEEN'=>'xuzhou',	'NAMECN'=>'徐州',	'DISTRICTEN'=>'xuzhou',	'DISTRICTCN'=>'徐州',	'PROVEN'=>'jiangsu',	'PROVCN'=>'江苏',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101190901'=>array('AREAID'=>'101190901',	'NAMEEN'=>'huaian',	'NAMECN'=>'淮安',	'DISTRICTEN'=>'huaian',	'DISTRICTCN'=>'淮安',	'PROVEN'=>'jiangsu',	'PROVCN'=>'江苏',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101191001'=>array('AREAID'=>'101191001',	'NAMEEN'=>'lianyungang',	'NAMECN'=>'连云港',	'DISTRICTEN'=>'lianyungang',	'DISTRICTCN'=>'连云港',	'PROVEN'=>'jiangsu',	'PROVCN'=>'江苏',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101191101'=>array('AREAID'=>'101191101',	'NAMEEN'=>'changzhou',	'NAMECN'=>'常州',	'DISTRICTEN'=>'changzhou',	'DISTRICTCN'=>'常州',	'PROVEN'=>'jiangsu',	'PROVCN'=>'江苏',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101191201'=>array('AREAID'=>'101191201',	'NAMEEN'=>'taizhou',	'NAMECN'=>'泰州',	'DISTRICTEN'=>'taizhou',	'DISTRICTCN'=>'泰州',	'PROVEN'=>'jiangsu',	'PROVCN'=>'江苏',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101191301'=>array('AREAID'=>'101191301',	'NAMEEN'=>'suqian',	'NAMECN'=>'宿迁',	'DISTRICTEN'=>'suqian',	'DISTRICTCN'=>'宿迁',	'PROVEN'=>'jiangsu',	'PROVCN'=>'江苏',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101200101'=>array('AREAID'=>'101200101',	'NAMEEN'=>'wuhan',	'NAMECN'=>'武汉',	'DISTRICTEN'=>'wuhan',	'DISTRICTCN'=>'武汉',	'PROVEN'=>'hubei',	'PROVCN'=>'湖北',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101200201'=>array('AREAID'=>'101200201',	'NAMEEN'=>'xiangyang',	'NAMECN'=>'襄阳',	'DISTRICTEN'=>'xiangyang',	'DISTRICTCN'=>'襄阳',	'PROVEN'=>'hubei',	'PROVCN'=>'湖北',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101200301'=>array('AREAID'=>'101200301',	'NAMEEN'=>'ezhou',	'NAMECN'=>'鄂州',	'DISTRICTEN'=>'ezhou',	'DISTRICTCN'=>'鄂州',	'PROVEN'=>'hubei',	'PROVCN'=>'湖北',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101200401'=>array('AREAID'=>'101200401',	'NAMEEN'=>'xiaogan',	'NAMECN'=>'孝感',	'DISTRICTEN'=>'xiaogan',	'DISTRICTCN'=>'孝感',	'PROVEN'=>'hubei',	'PROVCN'=>'湖北',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101200501'=>array('AREAID'=>'101200501',	'NAMEEN'=>'huanggang',	'NAMECN'=>'黄冈',	'DISTRICTEN'=>'huanggang',	'DISTRICTCN'=>'黄冈',	'PROVEN'=>'hubei',	'PROVCN'=>'湖北',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101200601'=>array('AREAID'=>'101200601',	'NAMEEN'=>'huangshi',	'NAMECN'=>'黄石',	'DISTRICTEN'=>'huangshi',	'DISTRICTCN'=>'黄石',	'PROVEN'=>'hubei',	'PROVCN'=>'湖北',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101200701'=>array('AREAID'=>'101200701',	'NAMEEN'=>'xianning',	'NAMECN'=>'咸宁',	'DISTRICTEN'=>'xianning',	'DISTRICTCN'=>'咸宁',	'PROVEN'=>'hubei',	'PROVCN'=>'湖北',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101200801'=>array('AREAID'=>'101200801',	'NAMEEN'=>'jingzhou',	'NAMECN'=>'荆州',	'DISTRICTEN'=>'jingzhou',	'DISTRICTCN'=>'荆州',	'PROVEN'=>'hubei',	'PROVCN'=>'湖北',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101200901'=>array('AREAID'=>'101200901',	'NAMEEN'=>'yichang',	'NAMECN'=>'宜昌',	'DISTRICTEN'=>'yichang',	'DISTRICTCN'=>'宜昌',	'PROVEN'=>'hubei',	'PROVCN'=>'湖北',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101201001'=>array('AREAID'=>'101201001',	'NAMEEN'=>'enshi',	'NAMECN'=>'恩施',	'DISTRICTEN'=>'enshi',	'DISTRICTCN'=>'恩施',	'PROVEN'=>'hubei',	'PROVCN'=>'湖北',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101201101'=>array('AREAID'=>'101201101',	'NAMEEN'=>'shiyan',	'NAMECN'=>'十堰',	'DISTRICTEN'=>'shiyan',	'DISTRICTCN'=>'十堰',	'PROVEN'=>'hubei',	'PROVCN'=>'湖北',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101201201'=>array('AREAID'=>'101201201',	'NAMEEN'=>'shennongjia',	'NAMECN'=>'神农架',	'DISTRICTEN'=>'shennongjia',	'DISTRICTCN'=>'神农架',	'PROVEN'=>'hubei',	'PROVCN'=>'湖北',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101201301'=>array('AREAID'=>'101201301',	'NAMEEN'=>'suizhou',	'NAMECN'=>'随州',	'DISTRICTEN'=>'suizhou',	'DISTRICTCN'=>'随州',	'PROVEN'=>'hubei',	'PROVCN'=>'湖北',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101201401'=>array('AREAID'=>'101201401',	'NAMEEN'=>'jingmen',	'NAMECN'=>'荆门',	'DISTRICTEN'=>'jingmen',	'DISTRICTCN'=>'荆门',	'PROVEN'=>'hubei',	'PROVCN'=>'湖北',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101201501'=>array('AREAID'=>'101201501',	'NAMEEN'=>'tianmen',	'NAMECN'=>'天门',	'DISTRICTEN'=>'tianmen',	'DISTRICTCN'=>'天门',	'PROVEN'=>'hubei',	'PROVCN'=>'湖北',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101201601'=>array('AREAID'=>'101201601',	'NAMEEN'=>'xiantao',	'NAMECN'=>'仙桃',	'DISTRICTEN'=>'xiantao',	'DISTRICTCN'=>'仙桃',	'PROVEN'=>'hubei',	'PROVCN'=>'湖北',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101201701'=>array('AREAID'=>'101201701',	'NAMEEN'=>'qianjiang',	'NAMECN'=>'潜江',	'DISTRICTEN'=>'qianjiang',	'DISTRICTCN'=>'潜江',	'PROVEN'=>'hubei',	'PROVCN'=>'湖北',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101210101'=>array('AREAID'=>'101210101',	'NAMEEN'=>'hangzhou',	'NAMECN'=>'杭州',	'DISTRICTEN'=>'hangzhou',	'DISTRICTCN'=>'杭州',	'PROVEN'=>'zhejiang',	'PROVCN'=>'浙江',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101210201'=>array('AREAID'=>'101210201',	'NAMEEN'=>'huzhou',	'NAMECN'=>'湖州',	'DISTRICTEN'=>'huzhou',	'DISTRICTCN'=>'湖州',	'PROVEN'=>'zhejiang',	'PROVCN'=>'浙江',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101210301'=>array('AREAID'=>'101210301',	'NAMEEN'=>'jiaxing',	'NAMECN'=>'嘉兴',	'DISTRICTEN'=>'jiaxing',	'DISTRICTCN'=>'嘉兴',	'PROVEN'=>'zhejiang',	'PROVCN'=>'浙江',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101210401'=>array('AREAID'=>'101210401',	'NAMEEN'=>'ningbo',	'NAMECN'=>'宁波',	'DISTRICTEN'=>'ningbo',	'DISTRICTCN'=>'宁波',	'PROVEN'=>'zhejiang',	'PROVCN'=>'浙江',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101210501'=>array('AREAID'=>'101210501',	'NAMEEN'=>'shaoxing',	'NAMECN'=>'绍兴',	'DISTRICTEN'=>'shaoxing',	'DISTRICTCN'=>'绍兴',	'PROVEN'=>'zhejiang',	'PROVCN'=>'浙江',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101210601'=>array('AREAID'=>'101210601',	'NAMEEN'=>'taizhou',	'NAMECN'=>'台州',	'DISTRICTEN'=>'taizhou',	'DISTRICTCN'=>'台州',	'PROVEN'=>'zhejiang',	'PROVCN'=>'浙江',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101210701'=>array('AREAID'=>'101210701',	'NAMEEN'=>'wenzhou',	'NAMECN'=>'温州',	'DISTRICTEN'=>'wenzhou',	'DISTRICTCN'=>'温州',	'PROVEN'=>'zhejiang',	'PROVCN'=>'浙江',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101210801'=>array('AREAID'=>'101210801',	'NAMEEN'=>'lishui',	'NAMECN'=>'丽水',	'DISTRICTEN'=>'lishui',	'DISTRICTCN'=>'丽水',	'PROVEN'=>'zhejiang',	'PROVCN'=>'浙江',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101210901'=>array('AREAID'=>'101210901',	'NAMEEN'=>'jinhua',	'NAMECN'=>'金华',	'DISTRICTEN'=>'jinhua',	'DISTRICTCN'=>'金华',	'PROVEN'=>'zhejiang',	'PROVCN'=>'浙江',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101211001'=>array('AREAID'=>'101211001',	'NAMEEN'=>'quzhou',	'NAMECN'=>'衢州',	'DISTRICTEN'=>'quzhou',	'DISTRICTCN'=>'衢州',	'PROVEN'=>'zhejiang',	'PROVCN'=>'浙江',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101211101'=>array('AREAID'=>'101211101',	'NAMEEN'=>'zhoushan',	'NAMECN'=>'舟山',	'DISTRICTEN'=>'zhoushan',	'DISTRICTCN'=>'舟山',	'PROVEN'=>'zhejiang',	'PROVCN'=>'浙江',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101220101'=>array('AREAID'=>'101220101',	'NAMEEN'=>'hefei',	'NAMECN'=>'合肥',	'DISTRICTEN'=>'hefei',	'DISTRICTCN'=>'合肥',	'PROVEN'=>'anhui',	'PROVCN'=>'安徽',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101220201'=>array('AREAID'=>'101220201',	'NAMEEN'=>'bengbu',	'NAMECN'=>'蚌埠',	'DISTRICTEN'=>'bengbu',	'DISTRICTCN'=>'蚌埠',	'PROVEN'=>'anhui',	'PROVCN'=>'安徽',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101220301'=>array('AREAID'=>'101220301',	'NAMEEN'=>'wuhu',	'NAMECN'=>'芜湖',	'DISTRICTEN'=>'wuhu',	'DISTRICTCN'=>'芜湖',	'PROVEN'=>'anhui',	'PROVCN'=>'安徽',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101220401'=>array('AREAID'=>'101220401',	'NAMEEN'=>'huainan',	'NAMECN'=>'淮南',	'DISTRICTEN'=>'huainan',	'DISTRICTCN'=>'淮南',	'PROVEN'=>'anhui',	'PROVCN'=>'安徽',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101220501'=>array('AREAID'=>'101220501',	'NAMEEN'=>'maanshan',	'NAMECN'=>'马鞍山',	'DISTRICTEN'=>'maanshan',	'DISTRICTCN'=>'马鞍山',	'PROVEN'=>'anhui',	'PROVCN'=>'安徽',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101220601'=>array('AREAID'=>'101220601',	'NAMEEN'=>'anqing',	'NAMECN'=>'安庆',	'DISTRICTEN'=>'anqing',	'DISTRICTCN'=>'安庆',	'PROVEN'=>'anhui',	'PROVCN'=>'安徽',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101220701'=>array('AREAID'=>'101220701',	'NAMEEN'=>'suzhou',	'NAMECN'=>'宿州',	'DISTRICTEN'=>'suzhou',	'DISTRICTCN'=>'宿州',	'PROVEN'=>'anhui',	'PROVCN'=>'安徽',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101220801'=>array('AREAID'=>'101220801',	'NAMEEN'=>'fuyang',	'NAMECN'=>'阜阳',	'DISTRICTEN'=>'fuyang',	'DISTRICTCN'=>'阜阳',	'PROVEN'=>'anhui',	'PROVCN'=>'安徽',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101220901'=>array('AREAID'=>'101220901',	'NAMEEN'=>'bozhou',	'NAMECN'=>'亳州',	'DISTRICTEN'=>'bozhou',	'DISTRICTCN'=>'亳州',	'PROVEN'=>'anhui',	'PROVCN'=>'安徽',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101221001'=>array('AREAID'=>'101221001',	'NAMEEN'=>'huangshan',	'NAMECN'=>'黄山',	'DISTRICTEN'=>'huangshan',	'DISTRICTCN'=>'黄山',	'PROVEN'=>'anhui',	'PROVCN'=>'安徽',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101221101'=>array('AREAID'=>'101221101',	'NAMEEN'=>'chuzhou',	'NAMECN'=>'滁州',	'DISTRICTEN'=>'chuzhou',	'DISTRICTCN'=>'滁州',	'PROVEN'=>'anhui',	'PROVCN'=>'安徽',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101221201'=>array('AREAID'=>'101221201',	'NAMEEN'=>'huaibei',	'NAMECN'=>'淮北',	'DISTRICTEN'=>'huaibei',	'DISTRICTCN'=>'淮北',	'PROVEN'=>'anhui',	'PROVCN'=>'安徽',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101221301'=>array('AREAID'=>'101221301',	'NAMEEN'=>'tongling',	'NAMECN'=>'铜陵',	'DISTRICTEN'=>'tongling',	'DISTRICTCN'=>'铜陵',	'PROVEN'=>'anhui',	'PROVCN'=>'安徽',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101221401'=>array('AREAID'=>'101221401',	'NAMEEN'=>'xuancheng',	'NAMECN'=>'宣城',	'DISTRICTEN'=>'xuancheng',	'DISTRICTCN'=>'宣城',	'PROVEN'=>'anhui',	'PROVCN'=>'安徽',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101221501'=>array('AREAID'=>'101221501',	'NAMEEN'=>'luan',	'NAMECN'=>'六安',	'DISTRICTEN'=>'luan',	'DISTRICTCN'=>'六安',	'PROVEN'=>'anhui',	'PROVCN'=>'安徽',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101221701'=>array('AREAID'=>'101221701',	'NAMEEN'=>'chizhou',	'NAMECN'=>'池州',	'DISTRICTEN'=>'chizhou',	'DISTRICTCN'=>'池州',	'PROVEN'=>'anhui',	'PROVCN'=>'安徽',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101230101'=>array('AREAID'=>'101230101',	'NAMEEN'=>'fuzhou',	'NAMECN'=>'福州',	'DISTRICTEN'=>'fuzhou',	'DISTRICTCN'=>'福州',	'PROVEN'=>'fujian',	'PROVCN'=>'福建',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101230201'=>array('AREAID'=>'101230201',	'NAMEEN'=>'xiamen',	'NAMECN'=>'厦门',	'DISTRICTEN'=>'xiamen',	'DISTRICTCN'=>'厦门',	'PROVEN'=>'fujian',	'PROVCN'=>'福建',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101230301'=>array('AREAID'=>'101230301',	'NAMEEN'=>'ningde',	'NAMECN'=>'宁德',	'DISTRICTEN'=>'ningde',	'DISTRICTCN'=>'宁德',	'PROVEN'=>'fujian',	'PROVCN'=>'福建',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101230401'=>array('AREAID'=>'101230401',	'NAMEEN'=>'putian',	'NAMECN'=>'莆田',	'DISTRICTEN'=>'putian',	'DISTRICTCN'=>'莆田',	'PROVEN'=>'fujian',	'PROVCN'=>'福建',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101230501'=>array('AREAID'=>'101230501',	'NAMEEN'=>'quanzhou',	'NAMECN'=>'泉州',	'DISTRICTEN'=>'quanzhou',	'DISTRICTCN'=>'泉州',	'PROVEN'=>'fujian',	'PROVCN'=>'福建',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101230601'=>array('AREAID'=>'101230601',	'NAMEEN'=>'zhangzhou',	'NAMECN'=>'漳州',	'DISTRICTEN'=>'zhangzhou',	'DISTRICTCN'=>'漳州',	'PROVEN'=>'fujian',	'PROVCN'=>'福建',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101230701'=>array('AREAID'=>'101230701',	'NAMEEN'=>'longyan',	'NAMECN'=>'龙岩',	'DISTRICTEN'=>'longyan',	'DISTRICTCN'=>'龙岩',	'PROVEN'=>'fujian',	'PROVCN'=>'福建',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101230801'=>array('AREAID'=>'101230801',	'NAMEEN'=>'sanming',	'NAMECN'=>'三明',	'DISTRICTEN'=>'sanming',	'DISTRICTCN'=>'三明',	'PROVEN'=>'fujian',	'PROVCN'=>'福建',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101230901'=>array('AREAID'=>'101230901',	'NAMEEN'=>'nanping',	'NAMECN'=>'南平',	'DISTRICTEN'=>'nanping',	'DISTRICTCN'=>'南平',	'PROVEN'=>'fujian',	'PROVCN'=>'福建',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101240101'=>array('AREAID'=>'101240101',	'NAMEEN'=>'nanchang',	'NAMECN'=>'南昌',	'DISTRICTEN'=>'nanchang',	'DISTRICTCN'=>'南昌',	'PROVEN'=>'jiangxi',	'PROVCN'=>'江西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101240201'=>array('AREAID'=>'101240201',	'NAMEEN'=>'jiujiang',	'NAMECN'=>'九江',	'DISTRICTEN'=>'jiujiang',	'DISTRICTCN'=>'九江',	'PROVEN'=>'jiangxi',	'PROVCN'=>'江西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101240301'=>array('AREAID'=>'101240301',	'NAMEEN'=>'shangrao',	'NAMECN'=>'上饶',	'DISTRICTEN'=>'shangrao',	'DISTRICTCN'=>'上饶',	'PROVEN'=>'jiangxi',	'PROVCN'=>'江西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101240401'=>array('AREAID'=>'101240401',	'NAMEEN'=>'fuzhou',	'NAMECN'=>'抚州',	'DISTRICTEN'=>'fuzhou',	'DISTRICTCN'=>'抚州',	'PROVEN'=>'jiangxi',	'PROVCN'=>'江西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101240501'=>array('AREAID'=>'101240501',	'NAMEEN'=>'yichun',	'NAMECN'=>'宜春',	'DISTRICTEN'=>'yichun',	'DISTRICTCN'=>'宜春',	'PROVEN'=>'jiangxi',	'PROVCN'=>'江西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101240601'=>array('AREAID'=>'101240601',	'NAMEEN'=>'jian',	'NAMECN'=>'吉安',	'DISTRICTEN'=>'jian',	'DISTRICTCN'=>'吉安',	'PROVEN'=>'jiangxi',	'PROVCN'=>'江西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101240701'=>array('AREAID'=>'101240701',	'NAMEEN'=>'ganzhou',	'NAMECN'=>'赣州',	'DISTRICTEN'=>'ganzhou',	'DISTRICTCN'=>'赣州',	'PROVEN'=>'jiangxi',	'PROVCN'=>'江西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101240801'=>array('AREAID'=>'101240801',	'NAMEEN'=>'jingdezhen',	'NAMECN'=>'景德镇',	'DISTRICTEN'=>'jingdezhen',	'DISTRICTCN'=>'景德镇',	'PROVEN'=>'jiangxi',	'PROVCN'=>'江西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101240901'=>array('AREAID'=>'101240901',	'NAMEEN'=>'pingxiang',	'NAMECN'=>'萍乡',	'DISTRICTEN'=>'pingxiang',	'DISTRICTCN'=>'萍乡',	'PROVEN'=>'jiangxi',	'PROVCN'=>'江西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101241001'=>array('AREAID'=>'101241001',	'NAMEEN'=>'xinyu',	'NAMECN'=>'新余',	'DISTRICTEN'=>'xinyu',	'DISTRICTCN'=>'新余',	'PROVEN'=>'jiangxi',	'PROVCN'=>'江西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101241101'=>array('AREAID'=>'101241101',	'NAMEEN'=>'yingtan',	'NAMECN'=>'鹰潭',	'DISTRICTEN'=>'yingtan',	'DISTRICTCN'=>'鹰潭',	'PROVEN'=>'jiangxi',	'PROVCN'=>'江西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101250101'=>array('AREAID'=>'101250101',	'NAMEEN'=>'changsha',	'NAMECN'=>'长沙',	'DISTRICTEN'=>'changsha',	'DISTRICTCN'=>'长沙',	'PROVEN'=>'hunan',	'PROVCN'=>'湖南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101250201'=>array('AREAID'=>'101250201',	'NAMEEN'=>'xiangtan',	'NAMECN'=>'湘潭',	'DISTRICTEN'=>'xiangtan',	'DISTRICTCN'=>'湘潭',	'PROVEN'=>'hunan',	'PROVCN'=>'湖南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101250301'=>array('AREAID'=>'101250301',	'NAMEEN'=>'zhuzhou',	'NAMECN'=>'株洲',	'DISTRICTEN'=>'zhuzhou',	'DISTRICTCN'=>'株洲',	'PROVEN'=>'hunan',	'PROVCN'=>'湖南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101250401'=>array('AREAID'=>'101250401',	'NAMEEN'=>'hengyang',	'NAMECN'=>'衡阳',	'DISTRICTEN'=>'hengyang',	'DISTRICTCN'=>'衡阳',	'PROVEN'=>'hunan',	'PROVCN'=>'湖南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101250501'=>array('AREAID'=>'101250501',	'NAMEEN'=>'chenzhou',	'NAMECN'=>'郴州',	'DISTRICTEN'=>'chenzhou',	'DISTRICTCN'=>'郴州',	'PROVEN'=>'hunan',	'PROVCN'=>'湖南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101250601'=>array('AREAID'=>'101250601',	'NAMEEN'=>'changde',	'NAMECN'=>'常德',	'DISTRICTEN'=>'changde',	'DISTRICTCN'=>'常德',	'PROVEN'=>'hunan',	'PROVCN'=>'湖南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101250700'=>array('AREAID'=>'101250700',	'NAMEEN'=>'yiyang',	'NAMECN'=>'益阳',	'DISTRICTEN'=>'yiyang',	'DISTRICTCN'=>'益阳',	'PROVEN'=>'hunan',	'PROVCN'=>'湖南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101250801'=>array('AREAID'=>'101250801',	'NAMEEN'=>'loudi',	'NAMECN'=>'娄底',	'DISTRICTEN'=>'loudi',	'DISTRICTCN'=>'娄底',	'PROVEN'=>'hunan',	'PROVCN'=>'湖南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101250901'=>array('AREAID'=>'101250901',	'NAMEEN'=>'shaoyang',	'NAMECN'=>'邵阳',	'DISTRICTEN'=>'shaoyang',	'DISTRICTCN'=>'邵阳',	'PROVEN'=>'hunan',	'PROVCN'=>'湖南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101251001'=>array('AREAID'=>'101251001',	'NAMEEN'=>'yueyang',	'NAMECN'=>'岳阳',	'DISTRICTEN'=>'yueyang',	'DISTRICTCN'=>'岳阳',	'PROVEN'=>'hunan',	'PROVCN'=>'湖南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101251101'=>array('AREAID'=>'101251101',	'NAMEEN'=>'zhangjiajie',	'NAMECN'=>'张家界',	'DISTRICTEN'=>'zhangjiajie',	'DISTRICTCN'=>'张家界',	'PROVEN'=>'hunan',	'PROVCN'=>'湖南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101251201'=>array('AREAID'=>'101251201',	'NAMEEN'=>'huaihua',	'NAMECN'=>'怀化',	'DISTRICTEN'=>'huaihua',	'DISTRICTCN'=>'怀化',	'PROVEN'=>'hunan',	'PROVCN'=>'湖南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101251401'=>array('AREAID'=>'101251401',	'NAMEEN'=>'yongzhou',	'NAMECN'=>'永州',	'DISTRICTEN'=>'yongzhou',	'DISTRICTCN'=>'永州',	'PROVEN'=>'hunan',	'PROVCN'=>'湖南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101251501'=>array('AREAID'=>'101251501',	'NAMEEN'=>'jishou',	'NAMECN'=>'吉首',	'DISTRICTEN'=>'xiangxi',	'DISTRICTCN'=>'湘西',	'PROVEN'=>'hunan',	'PROVCN'=>'湖南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101260101'=>array('AREAID'=>'101260101',	'NAMEEN'=>'guiyang',	'NAMECN'=>'贵阳',	'DISTRICTEN'=>'guiyang',	'DISTRICTCN'=>'贵阳',	'PROVEN'=>'guizhou',	'PROVCN'=>'贵州',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101260201'=>array('AREAID'=>'101260201',	'NAMEEN'=>'zunyi',	'NAMECN'=>'遵义',	'DISTRICTEN'=>'zunyi',	'DISTRICTCN'=>'遵义',	'PROVEN'=>'guizhou',	'PROVCN'=>'贵州',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101260301'=>array('AREAID'=>'101260301',	'NAMEEN'=>'anshun',	'NAMECN'=>'安顺',	'DISTRICTEN'=>'anshun',	'DISTRICTCN'=>'安顺',	'PROVEN'=>'guizhou',	'PROVCN'=>'贵州',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101260401'=>array('AREAID'=>'101260401',	'NAMEEN'=>'duyun',	'NAMECN'=>'都匀',	'DISTRICTEN'=>'qiannan',	'DISTRICTCN'=>'黔南',	'PROVEN'=>'guizhou',	'PROVCN'=>'贵州',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101260501'=>array('AREAID'=>'101260501',	'NAMEEN'=>'kaili',	'NAMECN'=>'凯里',	'DISTRICTEN'=>'qiandongnan',	'DISTRICTCN'=>'黔东南',	'PROVEN'=>'guizhou',	'PROVCN'=>'贵州',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101260601'=>array('AREAID'=>'101260601',	'NAMEEN'=>'tongren',	'NAMECN'=>'铜仁',	'DISTRICTEN'=>'tongren',	'DISTRICTCN'=>'铜仁',	'PROVEN'=>'guizhou',	'PROVCN'=>'贵州',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101260701'=>array('AREAID'=>'101260701',	'NAMEEN'=>'bijie',	'NAMECN'=>'毕节',	'DISTRICTEN'=>'bijie',	'DISTRICTCN'=>'毕节',	'PROVEN'=>'guizhou',	'PROVCN'=>'贵州',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101260801'=>array('AREAID'=>'101260801',	'NAMEEN'=>'shuicheng',	'NAMECN'=>'水城',	'DISTRICTEN'=>'liupanshui',	'DISTRICTCN'=>'六盘水',	'PROVEN'=>'guizhou',	'PROVCN'=>'贵州',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101260901'=>array('AREAID'=>'101260901',	'NAMEEN'=>'xingyi',	'NAMECN'=>'兴义',	'DISTRICTEN'=>'qianxinan',	'DISTRICTCN'=>'黔西南',	'PROVEN'=>'guizhou',	'PROVCN'=>'贵州',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101270101'=>array('AREAID'=>'101270101',	'NAMEEN'=>'chengdu',	'NAMECN'=>'成都',	'DISTRICTEN'=>'chengdu',	'DISTRICTCN'=>'成都',	'PROVEN'=>'sichuan',	'PROVCN'=>'四川',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101270201'=>array('AREAID'=>'101270201',	'NAMEEN'=>'panzhihua',	'NAMECN'=>'攀枝花',	'DISTRICTEN'=>'panzhihua',	'DISTRICTCN'=>'攀枝花',	'PROVEN'=>'sichuan',	'PROVCN'=>'四川',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101270301'=>array('AREAID'=>'101270301',	'NAMEEN'=>'zigong',	'NAMECN'=>'自贡',	'DISTRICTEN'=>'zigong',	'DISTRICTCN'=>'自贡',	'PROVEN'=>'sichuan',	'PROVCN'=>'四川',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101270401'=>array('AREAID'=>'101270401',	'NAMEEN'=>'mianyang',	'NAMECN'=>'绵阳',	'DISTRICTEN'=>'mianyang',	'DISTRICTCN'=>'绵阳',	'PROVEN'=>'sichuan',	'PROVCN'=>'四川',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101270501'=>array('AREAID'=>'101270501',	'NAMEEN'=>'nanchong',	'NAMECN'=>'南充',	'DISTRICTEN'=>'nanchong',	'DISTRICTCN'=>'南充',	'PROVEN'=>'sichuan',	'PROVCN'=>'四川',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101270601'=>array('AREAID'=>'101270601',	'NAMEEN'=>'dazhou',	'NAMECN'=>'达州',	'DISTRICTEN'=>'dazhou',	'DISTRICTCN'=>'达州',	'PROVEN'=>'sichuan',	'PROVCN'=>'四川',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101270701'=>array('AREAID'=>'101270701',	'NAMEEN'=>'suining',	'NAMECN'=>'遂宁',	'DISTRICTEN'=>'suining',	'DISTRICTCN'=>'遂宁',	'PROVEN'=>'sichuan',	'PROVCN'=>'四川',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101270801'=>array('AREAID'=>'101270801',	'NAMEEN'=>'guangan',	'NAMECN'=>'广安',	'DISTRICTEN'=>'guangan',	'DISTRICTCN'=>'广安',	'PROVEN'=>'sichuan',	'PROVCN'=>'四川',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101270901'=>array('AREAID'=>'101270901',	'NAMEEN'=>'bazhong',	'NAMECN'=>'巴中',	'DISTRICTEN'=>'bazhong',	'DISTRICTCN'=>'巴中',	'PROVEN'=>'sichuan',	'PROVCN'=>'四川',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101271001'=>array('AREAID'=>'101271001',	'NAMEEN'=>'luzhou',	'NAMECN'=>'泸州',	'DISTRICTEN'=>'luzhou',	'DISTRICTCN'=>'泸州',	'PROVEN'=>'sichuan',	'PROVCN'=>'四川',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101271101'=>array('AREAID'=>'101271101',	'NAMEEN'=>'yibin',	'NAMECN'=>'宜宾',	'DISTRICTEN'=>'yibin',	'DISTRICTCN'=>'宜宾',	'PROVEN'=>'sichuan',	'PROVCN'=>'四川',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101271201'=>array('AREAID'=>'101271201',	'NAMEEN'=>'neijiang',	'NAMECN'=>'内江',	'DISTRICTEN'=>'neijiang',	'DISTRICTCN'=>'内江',	'PROVEN'=>'sichuan',	'PROVCN'=>'四川',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101271301'=>array('AREAID'=>'101271301',	'NAMEEN'=>'ziyang',	'NAMECN'=>'资阳',	'DISTRICTEN'=>'ziyang',	'DISTRICTCN'=>'资阳',	'PROVEN'=>'sichuan',	'PROVCN'=>'四川',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101271401'=>array('AREAID'=>'101271401',	'NAMEEN'=>'leshan',	'NAMECN'=>'乐山',	'DISTRICTEN'=>'leshan',	'DISTRICTCN'=>'乐山',	'PROVEN'=>'sichuan',	'PROVCN'=>'四川',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101271501'=>array('AREAID'=>'101271501',	'NAMEEN'=>'meishan',	'NAMECN'=>'眉山',	'DISTRICTEN'=>'meishan',	'DISTRICTCN'=>'眉山',	'PROVEN'=>'sichuan',	'PROVCN'=>'四川',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101271601'=>array('AREAID'=>'101271601',	'NAMEEN'=>'liangshan',	'NAMECN'=>'凉山',	'DISTRICTEN'=>'liangshan',	'DISTRICTCN'=>'凉山',	'PROVEN'=>'sichuan',	'PROVCN'=>'四川',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101271701'=>array('AREAID'=>'101271701',	'NAMEEN'=>'yaan',	'NAMECN'=>'雅安',	'DISTRICTEN'=>'yaan',	'DISTRICTCN'=>'雅安',	'PROVEN'=>'sichuan',	'PROVCN'=>'四川',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101271801'=>array('AREAID'=>'101271801',	'NAMEEN'=>'ganzi',	'NAMECN'=>'甘孜',	'DISTRICTEN'=>'ganzi',	'DISTRICTCN'=>'甘孜',	'PROVEN'=>'sichuan',	'PROVCN'=>'四川',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101271901'=>array('AREAID'=>'101271901',	'NAMEEN'=>'aba',	'NAMECN'=>'阿坝',	'DISTRICTEN'=>'aba',	'DISTRICTCN'=>'阿坝',	'PROVEN'=>'sichuan',	'PROVCN'=>'四川',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101272001'=>array('AREAID'=>'101272001',	'NAMEEN'=>'deyang',	'NAMECN'=>'德阳',	'DISTRICTEN'=>'deyang',	'DISTRICTCN'=>'德阳',	'PROVEN'=>'sichuan',	'PROVCN'=>'四川',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101272101'=>array('AREAID'=>'101272101',	'NAMEEN'=>'guangyuan',	'NAMECN'=>'广元',	'DISTRICTEN'=>'guangyuan',	'DISTRICTCN'=>'广元',	'PROVEN'=>'sichuan',	'PROVCN'=>'四川',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101280101'=>array('AREAID'=>'101280101',	'NAMEEN'=>'guangzhou',	'NAMECN'=>'广州',	'DISTRICTEN'=>'guangzhou',	'DISTRICTCN'=>'广州',	'PROVEN'=>'guangdong',	'PROVCN'=>'广东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101280201'=>array('AREAID'=>'101280201',	'NAMEEN'=>'shaoguan',	'NAMECN'=>'韶关',	'DISTRICTEN'=>'shaoguan',	'DISTRICTCN'=>'韶关',	'PROVEN'=>'guangdong',	'PROVCN'=>'广东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101280301'=>array('AREAID'=>'101280301',	'NAMEEN'=>'huizhou',	'NAMECN'=>'惠州',	'DISTRICTEN'=>'huizhou',	'DISTRICTCN'=>'惠州',	'PROVEN'=>'guangdong',	'PROVCN'=>'广东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101280401'=>array('AREAID'=>'101280401',	'NAMEEN'=>'meizhou',	'NAMECN'=>'梅州',	'DISTRICTEN'=>'meizhou',	'DISTRICTCN'=>'梅州',	'PROVEN'=>'guangdong',	'PROVCN'=>'广东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101280501'=>array('AREAID'=>'101280501',	'NAMEEN'=>'shantou',	'NAMECN'=>'汕头',	'DISTRICTEN'=>'shantou',	'DISTRICTCN'=>'汕头',	'PROVEN'=>'guangdong',	'PROVCN'=>'广东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101280601'=>array('AREAID'=>'101280601',	'NAMEEN'=>'shenzhen',	'NAMECN'=>'深圳',	'DISTRICTEN'=>'shenzhen',	'DISTRICTCN'=>'深圳',	'PROVEN'=>'guangdong',	'PROVCN'=>'广东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101280701'=>array('AREAID'=>'101280701',	'NAMEEN'=>'zhuhai',	'NAMECN'=>'珠海',	'DISTRICTEN'=>'zhuhai',	'DISTRICTCN'=>'珠海',	'PROVEN'=>'guangdong',	'PROVCN'=>'广东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101280800'=>array('AREAID'=>'101280800',	'NAMEEN'=>'foshan',	'NAMECN'=>'佛山',	'DISTRICTEN'=>'foshan',	'DISTRICTCN'=>'佛山',	'PROVEN'=>'guangdong',	'PROVCN'=>'广东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101280901'=>array('AREAID'=>'101280901',	'NAMEEN'=>'zhaoqing',	'NAMECN'=>'肇庆',	'DISTRICTEN'=>'zhaoqing',	'DISTRICTCN'=>'肇庆',	'PROVEN'=>'guangdong',	'PROVCN'=>'广东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101281001'=>array('AREAID'=>'101281001',	'NAMEEN'=>'zhanjiang',	'NAMECN'=>'湛江',	'DISTRICTEN'=>'zhanjiang',	'DISTRICTCN'=>'湛江',	'PROVEN'=>'guangdong',	'PROVCN'=>'广东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101281101'=>array('AREAID'=>'101281101',	'NAMEEN'=>'jiangmen',	'NAMECN'=>'江门',	'DISTRICTEN'=>'jiangmen',	'DISTRICTCN'=>'江门',	'PROVEN'=>'guangdong',	'PROVCN'=>'广东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101281201'=>array('AREAID'=>'101281201',	'NAMEEN'=>'heyuan',	'NAMECN'=>'河源',	'DISTRICTEN'=>'heyuan',	'DISTRICTCN'=>'河源',	'PROVEN'=>'guangdong',	'PROVCN'=>'广东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101281301'=>array('AREAID'=>'101281301',	'NAMEEN'=>'qingyuan',	'NAMECN'=>'清远',	'DISTRICTEN'=>'qingyuan',	'DISTRICTCN'=>'清远',	'PROVEN'=>'guangdong',	'PROVCN'=>'广东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101281401'=>array('AREAID'=>'101281401',	'NAMEEN'=>'yunfu',	'NAMECN'=>'云浮',	'DISTRICTEN'=>'yunfu',	'DISTRICTCN'=>'云浮',	'PROVEN'=>'guangdong',	'PROVCN'=>'广东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101281501'=>array('AREAID'=>'101281501',	'NAMEEN'=>'chaozhou',	'NAMECN'=>'潮州',	'DISTRICTEN'=>'chaozhou',	'DISTRICTCN'=>'潮州',	'PROVEN'=>'guangdong',	'PROVCN'=>'广东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101281601'=>array('AREAID'=>'101281601',	'NAMEEN'=>'dongguan',	'NAMECN'=>'东莞',	'DISTRICTEN'=>'dongguan',	'DISTRICTCN'=>'东莞',	'PROVEN'=>'guangdong',	'PROVCN'=>'广东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101281701'=>array('AREAID'=>'101281701',	'NAMEEN'=>'zhongshan',	'NAMECN'=>'中山',	'DISTRICTEN'=>'zhongshan',	'DISTRICTCN'=>'中山',	'PROVEN'=>'guangdong',	'PROVCN'=>'广东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101281801'=>array('AREAID'=>'101281801',	'NAMEEN'=>'yangjiang',	'NAMECN'=>'阳江',	'DISTRICTEN'=>'yangjiang',	'DISTRICTCN'=>'阳江',	'PROVEN'=>'guangdong',	'PROVCN'=>'广东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101281901'=>array('AREAID'=>'101281901',	'NAMEEN'=>'jieyang',	'NAMECN'=>'揭阳',	'DISTRICTEN'=>'jieyang',	'DISTRICTCN'=>'揭阳',	'PROVEN'=>'guangdong',	'PROVCN'=>'广东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101282001'=>array('AREAID'=>'101282001',	'NAMEEN'=>'maoming',	'NAMECN'=>'茂名',	'DISTRICTEN'=>'maoming',	'DISTRICTCN'=>'茂名',	'PROVEN'=>'guangdong',	'PROVCN'=>'广东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101282101'=>array('AREAID'=>'101282101',	'NAMEEN'=>'shanwei',	'NAMECN'=>'汕尾',	'DISTRICTEN'=>'shanwei',	'DISTRICTCN'=>'汕尾',	'PROVEN'=>'guangdong',	'PROVCN'=>'广东',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101290101'=>array('AREAID'=>'101290101',	'NAMEEN'=>'kunming',	'NAMECN'=>'昆明',	'DISTRICTEN'=>'kunming',	'DISTRICTCN'=>'昆明',	'PROVEN'=>'yunnan',	'PROVCN'=>'云南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101290201'=>array('AREAID'=>'101290201',	'NAMEEN'=>'dali',	'NAMECN'=>'大理',	'DISTRICTEN'=>'dali',	'DISTRICTCN'=>'大理',	'PROVEN'=>'yunnan',	'PROVCN'=>'云南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101290301'=>array('AREAID'=>'101290301',	'NAMEEN'=>'honghe',	'NAMECN'=>'红河',	'DISTRICTEN'=>'honghe',	'DISTRICTCN'=>'红河',	'PROVEN'=>'yunnan',	'PROVCN'=>'云南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101290301'=>array('AREAID'=>'101290301',	'NAMEEN'=>'honghe',	'NAMECN'=>'红河',	'DISTRICTEN'=>'honghe',	'DISTRICTCN'=>'红河',	'PROVEN'=>'yunnan',	'PROVCN'=>'云南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101290401'=>array('AREAID'=>'101290401',	'NAMEEN'=>'qujing',	'NAMECN'=>'曲靖',	'DISTRICTEN'=>'qujing',	'DISTRICTCN'=>'曲靖',	'PROVEN'=>'yunnan',	'PROVCN'=>'云南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101290501'=>array('AREAID'=>'101290501',	'NAMEEN'=>'baoshan',	'NAMECN'=>'保山',	'DISTRICTEN'=>'baoshan',	'DISTRICTCN'=>'保山',	'PROVEN'=>'yunnan',	'PROVCN'=>'云南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101290601'=>array('AREAID'=>'101290601',	'NAMEEN'=>'wenshan',	'NAMECN'=>'文山',	'DISTRICTEN'=>'wenshan',	'DISTRICTCN'=>'文山',	'PROVEN'=>'yunnan',	'PROVCN'=>'云南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101290701'=>array('AREAID'=>'101290701',	'NAMEEN'=>'yuxi',	'NAMECN'=>'玉溪',	'DISTRICTEN'=>'yuxi',	'DISTRICTCN'=>'玉溪',	'PROVEN'=>'yunnan',	'PROVCN'=>'云南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101290801'=>array('AREAID'=>'101290801',	'NAMEEN'=>'chuxiong',	'NAMECN'=>'楚雄',	'DISTRICTEN'=>'chuxiong',	'DISTRICTCN'=>'楚雄',	'PROVEN'=>'yunnan',	'PROVCN'=>'云南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101290901'=>array('AREAID'=>'101290901',	'NAMEEN'=>'puer',	'NAMECN'=>'普洱',	'DISTRICTEN'=>'puer',	'DISTRICTCN'=>'普洱',	'PROVEN'=>'yunnan',	'PROVCN'=>'云南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101291001'=>array('AREAID'=>'101291001',	'NAMEEN'=>'zhaotong',	'NAMECN'=>'昭通',	'DISTRICTEN'=>'zhaotong',	'DISTRICTCN'=>'昭通',	'PROVEN'=>'yunnan',	'PROVCN'=>'云南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101291101'=>array('AREAID'=>'101291101',	'NAMEEN'=>'lincang',	'NAMECN'=>'临沧',	'DISTRICTEN'=>'lincang',	'DISTRICTCN'=>'临沧',	'PROVEN'=>'yunnan',	'PROVCN'=>'云南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101291201'=>array('AREAID'=>'101291201',	'NAMEEN'=>'nujiang',	'NAMECN'=>'怒江',	'DISTRICTEN'=>'nujiang',	'DISTRICTCN'=>'怒江',	'PROVEN'=>'yunnan',	'PROVCN'=>'云南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101291301'=>array('AREAID'=>'101291301',	'NAMEEN'=>'xianggelila',	'NAMECN'=>'香格里拉',	'DISTRICTEN'=>'diqing',	'DISTRICTCN'=>'迪庆',	'PROVEN'=>'yunnan',	'PROVCN'=>'云南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101291401'=>array('AREAID'=>'101291401',	'NAMEEN'=>'lijiang',	'NAMECN'=>'丽江',	'DISTRICTEN'=>'lijiang',	'DISTRICTCN'=>'丽江',	'PROVEN'=>'yunnan',	'PROVCN'=>'云南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101291501'=>array('AREAID'=>'101291501',	'NAMEEN'=>'dehong',	'NAMECN'=>'德宏',	'DISTRICTEN'=>'dehong',	'DISTRICTCN'=>'德宏',	'PROVEN'=>'yunnan',	'PROVCN'=>'云南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101291601'=>array('AREAID'=>'101291601',	'NAMEEN'=>'jinghong',	'NAMECN'=>'景洪',	'DISTRICTEN'=>'xishuangbanna',	'DISTRICTCN'=>'西双版纳',	'PROVEN'=>'yunnan',	'PROVCN'=>'云南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101300101'=>array('AREAID'=>'101300101',	'NAMEEN'=>'nanning',	'NAMECN'=>'南宁',	'DISTRICTEN'=>'nanning',	'DISTRICTCN'=>'南宁',	'PROVEN'=>'guangxi',	'PROVCN'=>'广西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101300201'=>array('AREAID'=>'101300201',	'NAMEEN'=>'chongzuo',	'NAMECN'=>'崇左',	'DISTRICTEN'=>'chongzuo',	'DISTRICTCN'=>'崇左',	'PROVEN'=>'guangxi',	'PROVCN'=>'广西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101300301'=>array('AREAID'=>'101300301',	'NAMEEN'=>'liuzhou',	'NAMECN'=>'柳州',	'DISTRICTEN'=>'liuzhou',	'DISTRICTCN'=>'柳州',	'PROVEN'=>'guangxi',	'PROVCN'=>'广西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101300401'=>array('AREAID'=>'101300401',	'NAMEEN'=>'laibin',	'NAMECN'=>'来宾',	'DISTRICTEN'=>'laibin',	'DISTRICTCN'=>'来宾',	'PROVEN'=>'guangxi',	'PROVCN'=>'广西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101300501'=>array('AREAID'=>'101300501',	'NAMEEN'=>'guilin',	'NAMECN'=>'桂林',	'DISTRICTEN'=>'guilin',	'DISTRICTCN'=>'桂林',	'PROVEN'=>'guangxi',	'PROVCN'=>'广西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101300601'=>array('AREAID'=>'101300601',	'NAMEEN'=>'wuzhou',	'NAMECN'=>'梧州',	'DISTRICTEN'=>'wuzhou',	'DISTRICTCN'=>'梧州',	'PROVEN'=>'guangxi',	'PROVCN'=>'广西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101300701'=>array('AREAID'=>'101300701',	'NAMEEN'=>'hezhou',	'NAMECN'=>'贺州',	'DISTRICTEN'=>'hezhou',	'DISTRICTCN'=>'贺州',	'PROVEN'=>'guangxi',	'PROVCN'=>'广西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101300801'=>array('AREAID'=>'101300801',	'NAMEEN'=>'guigang',	'NAMECN'=>'贵港',	'DISTRICTEN'=>'guigang',	'DISTRICTCN'=>'贵港',	'PROVEN'=>'guangxi',	'PROVCN'=>'广西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101300901'=>array('AREAID'=>'101300901',	'NAMEEN'=>'yulin',	'NAMECN'=>'玉林',	'DISTRICTEN'=>'yulin',	'DISTRICTCN'=>'玉林',	'PROVEN'=>'guangxi',	'PROVCN'=>'广西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101301001'=>array('AREAID'=>'101301001',	'NAMEEN'=>'baise',	'NAMECN'=>'百色',	'DISTRICTEN'=>'baise',	'DISTRICTCN'=>'百色',	'PROVEN'=>'guangxi',	'PROVCN'=>'广西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101301101'=>array('AREAID'=>'101301101',	'NAMEEN'=>'qinzhou',	'NAMECN'=>'钦州',	'DISTRICTEN'=>'qinzhou',	'DISTRICTCN'=>'钦州',	'PROVEN'=>'guangxi',	'PROVCN'=>'广西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101301201'=>array('AREAID'=>'101301201',	'NAMEEN'=>'hechi',	'NAMECN'=>'河池',	'DISTRICTEN'=>'hechi',	'DISTRICTCN'=>'河池',	'PROVEN'=>'guangxi',	'PROVCN'=>'广西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101301301'=>array('AREAID'=>'101301301',	'NAMEEN'=>'beihai',	'NAMECN'=>'北海',	'DISTRICTEN'=>'beihai',	'DISTRICTCN'=>'北海',	'PROVEN'=>'guangxi',	'PROVCN'=>'广西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101301401'=>array('AREAID'=>'101301401',	'NAMEEN'=>'fangchenggang',	'NAMECN'=>'防城港',	'DISTRICTEN'=>'fangchenggang',	'DISTRICTCN'=>'防城港',	'PROVEN'=>'guangxi',	'PROVCN'=>'广西',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101310101'=>array('AREAID'=>'101310101',	'NAMEEN'=>'haikou',	'NAMECN'=>'海口',	'DISTRICTEN'=>'haikou',	'DISTRICTCN'=>'海口',	'PROVEN'=>'hainan',	'PROVCN'=>'海南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101310201'=>array('AREAID'=>'101310201',	'NAMEEN'=>'sanya',	'NAMECN'=>'三亚',	'DISTRICTEN'=>'sanya',	'DISTRICTCN'=>'三亚',	'PROVEN'=>'hainan',	'PROVCN'=>'海南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101310202'=>array('AREAID'=>'101310202',	'NAMEEN'=>'dongfang',	'NAMECN'=>'东方',	'DISTRICTEN'=>'dongfang',	'DISTRICTCN'=>'东方',	'PROVEN'=>'hainan',	'PROVCN'=>'海南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101310203'=>array('AREAID'=>'101310203',	'NAMEEN'=>'lingao',	'NAMECN'=>'临高',	'DISTRICTEN'=>'lingao',	'DISTRICTCN'=>'临高',	'PROVEN'=>'hainan',	'PROVCN'=>'海南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101310204'=>array('AREAID'=>'101310204',	'NAMEEN'=>'chengmai',	'NAMECN'=>'澄迈',	'DISTRICTEN'=>'chengmai',	'DISTRICTCN'=>'澄迈',	'PROVEN'=>'hainan',	'PROVCN'=>'海南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101310205'=>array('AREAID'=>'101310205',	'NAMEEN'=>'danzhou',	'NAMECN'=>'儋州',	'DISTRICTEN'=>'danzhou',	'DISTRICTCN'=>'儋州',	'PROVEN'=>'hainan',	'PROVCN'=>'海南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101310206'=>array('AREAID'=>'101310206',	'NAMEEN'=>'changjiang',	'NAMECN'=>'昌江',	'DISTRICTEN'=>'changjiang',	'DISTRICTCN'=>'昌江',	'PROVEN'=>'hainan',	'PROVCN'=>'海南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101310207'=>array('AREAID'=>'101310207',	'NAMEEN'=>'baisha',	'NAMECN'=>'白沙',	'DISTRICTEN'=>'baisha',	'DISTRICTCN'=>'白沙',	'PROVEN'=>'hainan',	'PROVCN'=>'海南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101310208'=>array('AREAID'=>'101310208',	'NAMEEN'=>'qiongzhong',	'NAMECN'=>'琼中',	'DISTRICTEN'=>'qiongzhong',	'DISTRICTCN'=>'琼中',	'PROVEN'=>'hainan',	'PROVCN'=>'海南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101310209'=>array('AREAID'=>'101310209',	'NAMEEN'=>'dingan',	'NAMECN'=>'定安',	'DISTRICTEN'=>'dingan',	'DISTRICTCN'=>'定安',	'PROVEN'=>'hainan',	'PROVCN'=>'海南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101310210'=>array('AREAID'=>'101310210',	'NAMEEN'=>'tunchang',	'NAMECN'=>'屯昌',	'DISTRICTEN'=>'tunchang',	'DISTRICTCN'=>'屯昌',	'PROVEN'=>'hainan',	'PROVCN'=>'海南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101310211'=>array('AREAID'=>'101310211',	'NAMEEN'=>'qionghai',	'NAMECN'=>'琼海',	'DISTRICTEN'=>'qionghai',	'DISTRICTCN'=>'琼海',	'PROVEN'=>'hainan',	'PROVCN'=>'海南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101310212'=>array('AREAID'=>'101310212',	'NAMEEN'=>'wenchang',	'NAMECN'=>'文昌',	'DISTRICTEN'=>'wenchang',	'DISTRICTCN'=>'文昌',	'PROVEN'=>'hainan',	'PROVCN'=>'海南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101310214'=>array('AREAID'=>'101310214',	'NAMEEN'=>'baoting',	'NAMECN'=>'保亭',	'DISTRICTEN'=>'baoting',	'DISTRICTCN'=>'保亭',	'PROVEN'=>'hainan',	'PROVCN'=>'海南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101310215'=>array('AREAID'=>'101310215',	'NAMEEN'=>'wanning',	'NAMECN'=>'万宁',	'DISTRICTEN'=>'wanning',	'DISTRICTCN'=>'万宁',	'PROVEN'=>'hainan',	'PROVCN'=>'海南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101310216'=>array('AREAID'=>'101310216',	'NAMEEN'=>'lingshui',	'NAMECN'=>'陵水',	'DISTRICTEN'=>'lingshui',	'DISTRICTCN'=>'陵水',	'PROVEN'=>'hainan',	'PROVCN'=>'海南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101310217'=>array('AREAID'=>'101310217',	'NAMEEN'=>'xisha',	'NAMECN'=>'西沙',	'DISTRICTEN'=>'xisha',	'DISTRICTCN'=>'西沙',	'PROVEN'=>'hainan',	'PROVCN'=>'海南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101310220'=>array('AREAID'=>'101310220',	'NAMEEN'=>'nansha',	'NAMECN'=>'南沙',	'DISTRICTEN'=>'nansha',	'DISTRICTCN'=>'南沙',	'PROVEN'=>'hainan',	'PROVCN'=>'海南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101310221'=>array('AREAID'=>'101310221',	'NAMEEN'=>'ledong',	'NAMECN'=>'乐东',	'DISTRICTEN'=>'ledong',	'DISTRICTCN'=>'乐东',	'PROVEN'=>'hainan',	'PROVCN'=>'海南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101310222'=>array('AREAID'=>'101310222',	'NAMEEN'=>'wuzhishan',	'NAMECN'=>'五指山',	'DISTRICTEN'=>'wuzhishan',	'DISTRICTCN'=>'五指山',	'PROVEN'=>'hainan',	'PROVCN'=>'海南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101310224'=>array('AREAID'=>'101310224',	'NAMEEN'=>'zhongsha',	'NAMECN'=>'中沙',	'DISTRICTEN'=>'zhongsha',	'DISTRICTCN'=>'中沙',	'PROVEN'=>'hainan',	'PROVCN'=>'海南',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101320101'=>array('AREAID'=>'101320101',	'NAMEEN'=>'hongkong',	'NAMECN'=>'香港',	'DISTRICTEN'=>'hongkong',	'DISTRICTCN'=>'香港',	'PROVEN'=>'hongkong',	'PROVCN'=>'香港',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101330101'=>array('AREAID'=>'101330101',	'NAMEEN'=>'macao',	'NAMECN'=>'澳门',	'DISTRICTEN'=>'macao',	'DISTRICTCN'=>'澳门',	'PROVEN'=>'macao',	'PROVCN'=>'澳门',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101340101'=>array('AREAID'=>'101340101',	'NAMEEN'=>'taibeixian',	'NAMECN'=>'台北',	'DISTRICTEN'=>'taibeixian',	'DISTRICTCN'=>'台北',	'PROVEN'=>'taiwan',	'PROVCN'=>'台湾',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101340201'=>array('AREAID'=>'101340201',	'NAMEEN'=>'gaoxiong',	'NAMECN'=>'台北',	'DISTRICTEN'=>'gaoxiong',	'DISTRICTCN'=>'高雄',	'PROVEN'=>'taiwan',	'PROVCN'=>'台湾',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101340401'=>array('AREAID'=>'101340401',	'NAMEEN'=>'taizhong',	'NAMECN'=>'台中',	'DISTRICTEN'=>'taizhong',	'DISTRICTCN'=>'台中',	'PROVEN'=>'taiwan',	'PROVCN'=>'台湾',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),
'101310230'=>array('AREAID'=>'101310230',	'NAMEEN'=>'nanzidao',	'NAMECN'=>'南子岛',	'DISTRICTEN'=>'nanzidao',	'DISTRICTCN'=>'南子岛',	'PROVEN'=>'taiwan',	'PROVCN'=>'台湾',	'NATIONEN'=>'china',	'NATIONCN'=>'中国'),

);

public function get_weather_info($areaid=0){
	set_time_limit(0);
	$appid_six=substr($this->appid,0,6);
	$areaid = @$areaid?$areaid: '101280101';  
	$type='forecast_v';
	$date=date("YmdHi");
	$public_key="http://open.weather.com.cn/data/?areaid=".$areaid."&type=".$type."&date=".$date."&appid=".$this->appid;
	 
	$key = base64_encode(hash_hmac('sha1',$public_key,$this->private_key,TRUE));
	 
	$URL="http://open.weather.com.cn/data/?areaid=".$areaid."&type=".$type."&date=".$date."&appid=".$appid_six."&key=".urlencode($key);
	//echo $URL."<br /-->";
	 
	$weather_json_string=file_get_contents($URL);
	$weather_arr =json_decode($weather_json_string,true);

	//将编码转换为文字描述
	foreach($weather_arr['f']['f1'] as $key=>$tmp)
	{
		$weather_arr['f']['f1'][$key]['fa'] = $this->weather_phenomenon_arr[$weather_arr['f']['f1'][$key]['fa']]['NAMECN'];//白天天气现象
		$weather_arr['f']['f1'][$key]['fb'] = $this->weather_phenomenon_arr[$weather_arr['f']['f1'][$key]['fb']]['NAMECN'];//晚上天气现象
		$weather_arr['f']['f1'][$key]['fe'] = $this->wind_direction_arr[$weather_arr['f']['f1'][$key]['fe']]['NAMECN'];//白天风向
		$weather_arr['f']['f1'][$key]['ff'] = $this->wind_direction_arr[$weather_arr['f']['f1'][$key]['ff']]['NAMECN'];//晚上风向
		$weather_arr['f']['f1'][$key]['fg'] = $this->wind_power_arr[$weather_arr['f']['f1'][$key]['fg']]['NAMECN'];//白天风力
		$weather_arr['f']['f1'][$key]['fh'] = $this->wind_power_arr[$weather_arr['f']['f1'][$key]['fh']]['NAMECN'];//晚上风力
		$weather_arr['f']['f1'][$key]['fi'] = explode('|',$weather_arr['f']['f1'][$key]['fi']);//日出日落时间
	}
	 $weekarray=array("日","一","二","三","四","五","六");
	$time = time();
	$weather_arr['year']=date('Y',$time);
	$weather_arr['month']=date('m',$time);
	$weather_arr['day']=date('d',$time);
	$weather_arr['month_day']=date('m-d',$time);
	$weather_arr['year_month_day']=date('Y-m-d',$time);
	$weather_arr['H']=date('H',$time);
	$weather_arr['week']=$weekarray[date("w")];
	$weather_arr['holiday']='';
	if(date('m-d',$time)=='01-01'){
		$weather_arr['holiday']='元旦';
	}
	if(date('m-d',$time)=='03-08'){
		$weather_arr['holiday']='妇女节';
	}
	if(date('m-d',$time)=='03-12'){
		$weather_arr['holiday']='植树节';
	}
	if(date('m-d',$time)=='03-15'){
		$weather_arr['holiday']='消费者权益保护日';
	}
	if(date('m-d',$time)=='05-01'){
		$weather_arr['holiday']='劳动节';
	}
	if(date('m-d',$time)=='05-04'){
		$weather_arr['holiday']='青年节';
	}
	if(date('m-d',$time)=='05-20'){
	    $weather_arr['holiday']='情人节';
	}
	if(date('m-d',$time)=='06-01'){
		$weather_arr['holiday']='儿童节';
	}
	if(date('m-d',$time)=='09-10'){
		$weather_arr['holiday']='教师节';
	}
	if(date('m-d',$time)=='10-01'){
		$weather_arr['holiday']='国庆节';
	}
	if(date('m-d',$time)=='10-24'){
		$weather_arr['holiday']='程序员节';
	}
	if(date('m-d',$time)=='11-11'){
	    $weather_arr['holiday']='光棍节';
	}
	return $weather_arr;
}

/*
输出参数
c1 区域 ID 101010100
c2 城市英文名 beijing
c3 城市中文名 北京
c4 城市所在市英文名 beijing
c5 城市所在市中文名 北京
c6 城市所在省英文名 beijing
c7 城市所在省中文名 北京
SmartWeatherAPI Open 版接口使用说明书 <Lite>
6
c8 城市所在国家英文名 china
c9 城市所在国家中文名 中国
c10 城市级别 1
c11 城市区号 010
c12 邮编 100000
c13 经度 116.391
c14 纬度 39.904
c15 海拔 33
c16 雷达站号 AZ9010
f0 预报发布时间 201203061100
fa 白天天气现象编号 01
fb 晚上天气现象编号 01
fc 白天天气温度(摄氏度) 11
fd 晚上天气温度(摄氏度) 0
fe 白天风向编号 4
ff 晚上风向编号 4
fg 白天风力编号 1
fh 晚上风力编号 0
fi 日出日落时间(中间用|分割) 06:44|18:21
*/
/*
天气现象编码表 
00 晴 Sunny
01 多云 Cloudy
02 阴 Overcast
03 阵雨 Shower
04 雷阵雨 Thundershower
05 雷阵雨伴有冰雹 Thundershower with hail
06 雨夹雪 Sleet
07 小雨 Light rain
08 中雨 Moderate rain
09 大雨 Heavy rain
10 暴雨 Storm
11 大暴雨 Heavy storm
12 特大暴雨 Severe storm
13 阵雪 Snow flurry
14 小雪 Light snow
15 中雪 Moderate snow
16 大雪 Heavy snow
17 暴雪 Snowstorm
18 雾 Foggy
19 冻雨 Ice rain
20 沙尘暴 Duststorm
21 小到中雨 Light to moderate rain
22 中到大雨 Moderate to heavy rain
23 大到暴雨 Heavy rain to storm
24 暴雨到大暴雨 Storm to heavy storm
25 大暴雨到特大暴雨 Heavy to severe storm
26 小到中雪 Light to moderate snow
27 中到大雪 Moderate to heavy snow
28 大到暴雪 Heavy snow to snowstorm
29 浮尘 Dust
30 扬沙 Sand
31 强沙尘暴 Sandstorm
53 霾 Haze
99 无 Unknown
*/
/*
风力风向编码表 
风向编号 中文名称  英文名称  风力编号  中文名称  英文名称
0        无持续风向 No wind 0 微风 <10m/h
1        东北风 Northeast 1 3-4 级 10~17m/h
2        东风 East 2 4-5 级 17~25m/h
3        东南风 Southeast 3 5-6 级 25~34m/h
4        南风 South 4 6-7 级 34~43m/h
5        西南风 Southwest 5 7-8 级 43~54m/h
6        西风 West 6 8-9 级 54~65m/h
7        西北风 Northwest 7 9-10 级 65~77m/h
8        北风 North 8 10-11 级 77~89m/h
9        旋转风 Whirl wind 9 11-12 级 89~102m/h
*/
}
//示例代码
// $areaid=@$_REQUEST['areaid']?$_REQUEST['areaid']:0;
// $weather_obj = new weather();
//print_r($weather_obj->get_weather_info($areaid));
//echo '<br/><br/>城市ID列表：<br/>';
//foreach($weather_obj->areaids_arr as $key=>$areaid){
//	echo $areaid['AREAID'].' '.$areaid['NAMECN'].'<br/>';
//}