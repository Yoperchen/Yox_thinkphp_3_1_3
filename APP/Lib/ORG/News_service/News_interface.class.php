<?php
/**
* 新闻API接口类
* 获取新闻数据
* Copyright (c) 2014-2015 http://www.linglingtang.com, All rights reserved.
* Author: 陈永鹏Yoper <944975166@qq.com>
*/
interface News_interface
{
    
    public function get_news_info($film_info);
    public function search_news($condition);
    public function get_news_comment();
}
//示例代码
