<?php
/**
* 新浪天气API接口类
* 获取新浪天气数据，http://weather.news.sina.com.cn/
* Copyright (c) 2014-2015 http://www.linglingtang.com, All rights reserved.
* Author: 陈永鹏Yoper <944975166@qq.com>
*/
class Sina_weather implements Weather_interface
{
    //api_url，接口地址
    private $api_url='http://php.weather.sina.com.cn/xml.php';
    //密码，密码固定
    private $password='DJOYnieT8234jlsK';
    //天气数据
    private $weather       =array();
    //要获取的天气字段
    private $weather_fields=array(
        'city_id'=>'',//城市id
        'weather'=>'',//天气序列
        'phenomenon'=>'',//天气现象|晴/多云/阴/阵雨/雷阵雨/雷阵雨伴有冰雹/雨夹雪/小雨/中雨..
        'temperature'=>'',//温度
        'wind_direction'=>'',//风向|无持续风向/东北风/东风/东南风/南风/西南风/西风/西北风/北风/旋转风
        'wind_power'=>'',//风力|微风/3-4 级/4-5 级/5-6 级/6-7 级
        'pm25'=>'',//pm2.5
        'weather_date'=>'',//日期
    );
    
    function __construct(){
    }
    /**
     * 获取7天天气数据
     * @param array $city_info
     */
    public function get_weather_info7($city_info)
    {
        $result = array('status'=>0);
        if(empty($city_info['short_name']))
        {
            $result['message']='城市名称为空';
            return $result;
        }
        $curl_data=array();
        $curl_data['password']=$this->password;
        //城市名转成gb2312编码
        $curl_data['city']=mb_convert_encoding($city_info['short_name'], 'gb2312', 'utf-8');
        //http://php.weather.sina.com.cn/xml.php?password=DJOYnieT8234jlsK&city=
        //获取7天数据
        for($i=0;$i<=6;$i++)
        {
            $curl_data['day']=$i;
            $curl_result_xml= $this->curl($curl_data,'get');
            $curl_result_array=json_decode(json_encode((array) simplexml_load_string($curl_result_xml)), true);
            print_r($curl_result_array);
//                 [Weather] => Array
//                 (
//                     [city] => 惠州
//                     [status1] => 多云
//                     [status2] => 多云
//                     [figure1] => duoyun
//                     [figure2] => duoyun
//                     [direction1] => 无持续风向
//                     [direction2] => 无持续风向
//                     [power1] => ≤3
//                     [power2] => ≤3
//                     [temperature1] => 35
//                     [temperature2] => 27
//                     [ssd] => 8
//                     [tgd1] => 30
//                     [tgd2] => 30
//                     [zwx] => 1
//                     [ktk] => 2
//                     [pollution] => 3
//                     [xcz] => 5
//                     [zho] => Array
//                     (
//                     )

//                     [diy] => Array
//                     (
//                     )

//                     [fas] => Array
//                     (
//                     )

//                     [chy] => 1
//                     [zho_shuoming] => 暂无
//                     [diy_shuoming] => 暂无
//                     [fas_shuoming] => 暂无
//                     [chy_shuoming] => 短袖衫、短裙、短裤、薄型T恤衫、敞领短袖棉衫
//                     [pollution_l] => 轻度
//                     [zwx_l] => 最弱
//                     [ssd_l] => 较热
//                     [fas_l] => 暂无
//                     [zho_l] => 暂无
//                     [chy_l] => 薄短袖类
//                     [ktk_l] => 适宜开启(制冷)
//                     [xcz_l] => 不适宜
//                     [diy_l] => 暂无
//                     [pollution_s] => 对空气污染物扩散无明显影响
//                     [zwx_s] => 紫外线最弱
//                     [ssd_s] => 户外活动不适宜在中午前后展开。
//                     [ktk_s] => 适宜开启空调
//                     [xcz_s] => 洗车后当日有降水、大风或沙尘天气，不适宜洗车
//                     [gm] => 2
//                     [gm_l] => 易发期
//                     [gm_s] => 天气闷热，注意预防热伤风；
//                     [yd] => 5
//                     [yd_l] => 不适宜
//                     [yd_s] => 天气闷热，不适宜户外运动；
//                     [savedate_weather] => 2016-07-17
//                     [savedate_life] => 2016-07-17
//                     [savedate_zhishu] => 2016-07-17
//                     [udatetime] => 2016-07-16 17:10:00
//                 )
            $this->weather_fields['city_id']=$city_info['city_id'];
            $this->weather_fields['weather']=$curl_result_array['Weather'];
            $this->weather_fields['phenomenon']=$curl_result_array['Weather']['status1'].'~'.$curl_result_array['Weather']['status2'];
            $this->weather_fields['temperature']=$curl_result_array['Weather']['temperature1'].'~'.$curl_result_array['Weather']['temperature1'];
            $this->weather_fields['wind_direction']=$curl_result_array['Weather']['direction1'].'~'.$curl_result_array['Weather']['direction2'];
            $this->weather_fields['wind_power']=$curl_result_array['Weather']['power1'].'~'.$curl_result_array['Weather']['power2'];
            $this->weather_fields['weather_date']=$curl_result_array['Weather']['savedate_life'];
            $this->weather7=array();
            $this->weather7[]=$this->weather_fields;
            
        }
        
//         print_r($result);
        if(!empty($this->weather7))
        {
            $result['status']=1;
            $result['data']=$this->weather7;
        }
        return $result;
    }
    /**
     * 获取指定日期天气数据
     * @param array $city_info
     * @param string $date|2019-8-8
     */
    public function get_weather_by_date($city_info,$date_str)
    {
        $result = array('status'=>0);
        if(empty($city_info['short_name']))
        {
            $result['message']='城市名称为空';
            return $result;
        }
        $curl_data=array();
        $curl_data['password']=$this->password;
        //城市名转成gb2312编码
        $curl_data['city']=mb_convert_encoding($city_info['short_name'], 'gb2312', 'utf-8');
        $date_time = strtotime($date_str);
        $today_time = strtotime(date('Y-m-d'));
        if(empty($date_str))
        {
            //今天的
            $day=0;
        }
        else{
            $day = ($date_time-$today_time)/86400;
        }
        $curl_data['day']=$day;
        $curl_result_xml= $this->curl($curl_data,'get');
        $curl_result_array=json_decode(json_encode((array) simplexml_load_string($curl_result_xml)), true);
        
        $this->weather_fields['city_id']=$city_info['city_id'];
        $this->weather_fields['weather']=$curl_result_array['Weather'];
        $this->weather_fields['phenomenon']=$curl_result_array['Weather']['status1'].'~'.$curl_result_array['Weather']['status2'];
        $this->weather_fields['temperature']=$curl_result_array['Weather']['temperature1'].'~'.$curl_result_array['Weather']['temperature1'];
        $this->weather_fields['wind_direction']=$curl_result_array['Weather']['direction1'].'~'.$curl_result_array['Weather']['direction2'];
        $this->weather_fields['wind_power']=$curl_result_array['Weather']['power1'].'~'.$curl_result_array['Weather']['power2'];
        $this->weather_fields['weather_date']=$curl_result_array['Weather']['savedate_life'];
        $this->weather=array();
        $this->weather=$this->weather_fields;
        
        if(!empty($this->weather))
        {
            $result['status']=1;
            $result['data']=$this->weather;
        }
        return $result;
    }
    
    /**
     * curl
     * @param array $data
     * @return array
     */
    private function curl($data,$method='get')
    {
        //$headers=array();
        //$headers[]='CLIENT-IP:127.0.0.1';
        //$headers[]='X-FORWARDED-FOR:127.0.0.1';
        $data['t']=rand(1000, 9999);
//         $data= http_build_query($data);
//         echo $data;
//	echo $data.'<br/>';
        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL,$this->api_url );
        if($method!='get'){
            curl_setopt ( $ch, CURLOPT_POST, 1 );
        }
        //curl_setopt ($ch, CURLOPT_HTTPHEADER , $headers );
        curl_setopt ($ch, CURLOPT_REFERER, "http://www.sina.com.cn/ ");//构造来路
        curl_setopt ($ch, CURLOPT_HEADER, 0 );
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ($ch, CURLOPT_POSTFIELDS, $data );
        $result = curl_exec ( $ch );
        curl_close ( $ch );
        return $result;
    }
}
