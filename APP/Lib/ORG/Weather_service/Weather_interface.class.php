<?php
/**
* 天气API接口类
* 获取天气数据
* Copyright (c) 2014-2015 http://www.linglingtang.com, All rights reserved.
* Author: 陈永鹏Yoper <944975166@qq.com>
*/
interface Weather_interface
{

    /**
     * 获取7天天气数据
     * @param array $city_info
     */
    public function get_weather_info7($city_info);
    /**
     * 获取指定日期天气数据
     * @param array $city_info
     * @param string $date
     */
    public function get_weather_by_date($city_info,$date);
    
}
//示例代码
