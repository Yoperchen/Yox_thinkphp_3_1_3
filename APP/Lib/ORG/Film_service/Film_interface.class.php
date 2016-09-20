<?php
/**
* 电影API接口类
* 获取电影数据
* Copyright (c) 2014-2015 http://www.linglingtang.com, All rights reserved.
* Author: 陈永鹏Yoper <944975166@qq.com>
*/
interface Film_interface
{
    
    public function get_film_info($film_info);
    public function get_film_list($condition);
    public function search_film($condition);
    
}
//示例代码
