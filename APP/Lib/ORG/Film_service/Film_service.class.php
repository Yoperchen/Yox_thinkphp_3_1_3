<?php
/**
* 电影服务类
* 获取电影数据,根据传参不同，调用不同的类
* Copyright (c) 2014-2015 http://www.linglingtang.com, All rights reserved.
* Author: 陈永鹏Yoper <944975166@qq.com>
*/
class Film_service
{
    private $film_obj='';
    
    function __construct($film_obj_name)
    {
        if(empty($film_obj_name))
        {
            $film_obj_name='Mianbao_film';
        }
        require "Film_interface.class.php";
        require "$film_obj_name.class.php";
        if(!class_exists($film_obj_name))
        {
            die($film_obj_name.' 类不存在');
        }
        $this->film_obj = new $film_obj_name();
    }
    /**
     * 根据电影相关信息(如电影名称)获取更多电影信息
     * @param unknown $film_info
     * @return array
     */
    public function get_film_info($film_info)
    {
        $result = array('status'=>0);
        if(empty($film_info))
        {
            $result['message']='电影信息为空';
            return $result;
        }
        $get_info_result = $this->film_obj->get_film_info($film_info);
        if($get_info_result['status']<0)
        {
            $result['message']=$get_info_result['message'];
            return $result;
        }
        $result['status']=1;
        $result['data']=$get_info_result['data'];
        return $result;
    }
    /**
     * 根据电影详情页url获取播放链接
     * @param url $film_url
     * @return array 
     */
    public function get_play_by_film_url($film_url)
    {
        $result = array('status'=>0);
        if(empty($film_url))
        {
            $result['message']='电影详情url 为空';
            return $result;
        }
        $get_play_result = $this->film_obj->get_play_by_film_url($film_url);
        if($get_play_result['status']<1)
        {
            $result['message']=$get_play_result['message'];
            return $result;
        }
        $result['status']=1;
        $result['data']=$get_play_result['data'];
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
