<?php
/**
* 天气服务类
* 获取天气数据,根据传参不同，调用不同的类
* Copyright (c) 2014-2015 http://www.linglingtang.com, All rights reserved.
* Author: 陈永鹏Yoper <944975166@qq.com>
*/
class Weather_service
{
    private $weather_obj='';
    
    function __construct($weather_obj_name)
    {
        require "Weather_interface.class.php";
        require "$weather_obj_name.class.php";
        if(!class_exists($weather_obj_name))
        {
            die($weather_obj_name.' 类不存在');
        }
        $this->weather_obj = new $weather_obj_name();
    }
    
    public function get_weather_info7($city_info)
    {
        $result = array('status'=>0);
        if(empty($city_info))
        {
            $result['message']='城市信息为空';
        }
        $get_weather_result=$this->weather_obj->get_weather_info7($city_info);
        if(!empty($get_weather_result['data']))
        {
            $result['status']=1;
            $result['message']='获取天气信息成功';
        }
        $result['data']=$get_weather_result['data'];
        return $result;
    }
    public function get_weather_by_date($city_info,$date_str)
    {
        $result = array('status'=>0);
        if(empty($city_info))
        {
            $result['message']='城市信息为空';
        }
        $get_weather_result=$this->weather_obj->get_weather_by_date($city_info,$date_str);
        if(!empty($get_weather_result['data']))
        {
            $result['status']=1;
            $result['message']='获取天气信息成功';
        }
        $result['data']=$get_weather_result['data'];
        return $result;
    }
}
//示例代码
