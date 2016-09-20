<?php
/**
* 电影服务类
* 获取电影数据,根据传参不同，调用不同的类
* Copyright (c) 2014-2015 http://www.linglingtang.com, All rights reserved.
* Author: 陈永鹏Yoper <944975166@qq.com>
*/
class News_service
{
    private $news_obj=null;
    
    function __construct($news_obj_name)
    {
        if(empty($news_obj_name))
        {
            $news_obj_name='Mianbao_film';
        }
        require "News_interface.class.php";
        require "$news_obj_name.class.php";
        if(!class_exists($news_obj_name))
        {
            die($news_obj_name.' 类不存在');
        }
        $this->news_obj = new $news_obj_name();
    }
    /**
     * 根据电影相关信息(如电影名称)获取更多电影信息
     * @param unknown $film_info
     * @return array
     */
    public function get_news_info($news_info)
    {
        $result = array('status'=>0);
        if(empty($news_info))
        {
            $result['message']='电影信息为空';
            return $result;
        }
        $get_info_result = $this->news_obj->get_news_info($news_info);
        if($get_info_result['status']<0)
        {
            $result['message']=$get_info_result['message'];
            return $result;
        }
        $result['status']=1;
        $result['data']=$get_info_result['data'];
        return $result;
    }

    public function get_news_list($condition)
    {
        $result = array('status'=>0);
//         if(empty($news_info))
//         {
//             $result['message']='电影信息为空';
//             return $result;
//         }
        $get_list_result = $this->news_obj->get_news_list($condition);
        if($get_list_result['status']<0)
        {
            $result['message']=$get_list_result['message'];
            return $result;
        }
        $result['status']=1;
        $result['data']=$get_list_result['data'];
        return $result;
    }
    public function search_film()
    {
    
    }
    
    public function add_to_Yocms(){
        
    }
    
    public function update_to_Yocms(){
        
    }
    
}
//示例代码
