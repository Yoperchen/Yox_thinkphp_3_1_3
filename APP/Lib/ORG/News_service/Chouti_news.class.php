<?php
/**
* 新闻API接口类
* 获取新闻数据
* Copyright (c) 2014-2015 http://www.linglingtang.com, All rights reserved.
* Author: 陈永鹏Yoper <944975166@qq.com>
*/
class Chouti_news implements News_interface
{
    const DOMAIN_NAME='http://dig.chouti.com';
    //http://dig.chouti.com/all/hot/recent/1
    private $now_url = '';
    
    private $article_info_fields=array();//文章
    private $share_info_fields=array();//分享
    private $comment_info_fields=array();//评论
    
    /**
     * 根据新闻名称获取新闻信息
     * @see Film_interface::get_film_info()
     */
    public function get_news_info($news_condition)
    {
        $result = array('status'=>0);
        if(empty($news_condition['name']))
        {
            $result['message']='新闻名称为空';
            return $result;
        }
//         $this->now_url=self::DOMAIN_NAME.'all/hot/recent/1';
//         $curl_result = $this->curl($this->now_url);

    }
    public function get_news_list($news_condition)
    {
        $result = array('status'=>0);
        
        for ($i=1;$i<=1;$i++)
        {
            $url = self::DOMAIN_NAME.'/all/hot/recent/'.$i;
            $curl_result = $this->curl($url);
            $pattern='/<div class=\"part1\">([\s\S]*)<\/div>/iU';//正则
            preg_match_all($pattern, $curl_result, $news_arr_tmp);//匹配内容到arr数组
            print_r($news_arr_tmp);die();
        }
        $news_list=array();
        foreach ($news_arr_tmp[1] as $dom_news_detail)
        {
//             echo $dom_news_detail;die();
            $pattern='/<a href=\"(.*)\" class=\"show-content\" target=\"_blank\" onMouseDown=\"linksClickStat\((.*)\);\">([\s\S]*)<\/a>/iU';//
            preg_match($pattern,$dom_news_detail,$new_detail);
            print_r($new_detail);
            $url_info = parse_url($new_detail[1]);
//             Array
//             (
//                 [scheme] => http
//                 [host] => dig.chouti.com
//                 [path] => /pic/show
//                 [query] => nid=4008170684727898&lid=8536819
//             )
            $news_info['title']=trim($new_detail[3]);
            $news_info['from_url']=$url_info['scheme']?$new_detail[1]:self::DOMAIN_NAME.$new_detail[1];
            $news_list[]=$news_info;
        }
        
//         die($new_detail);
    }
    public function get_news_comment()
    {
        
    }
    public function search_news($condition) 
    {

    }
    /**
     * curl
     * @param array $data
     * @return array
     */
    private function curl($url,$data,$method='GET')
    {
        $headers=array();
        $header[] = "Accept: application/json";
        $header[] = "Accept-Encoding: gzip";
        $data['t']=rand(1000, 9999);
        //         $data= http_build_query($data);
        //         echo $data;
        //	echo $data.'<br/>';
        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL,$url);
        if($method!='GET'){
            curl_setopt ( $ch, CURLOPT_POST, 1 );
        }
        else{
           curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        }
        //输出头信息
        curl_setopt ($ch, CURLOPT_HTTPHEADER , $headers );
        //递归访问location跳转的链接，直到返回200OK
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt ($ch, CURLOPT_REFERER, $url);//构造来路
        curl_setopt ($ch, CURLOPT_HEADER, 1 );
        //将结果以文件流的方式返回，不是直接输出
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ($ch, CURLOPT_POSTFIELDS, $data );
        //设置连接超时时间
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,15);
        //设置访问超时
        curl_setopt($ch,CURLOPT_TIMEOUT,20);
        //设置User-agent
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/20.0.1132.47 Safari/536.11');
        $result = curl_exec ( $ch );
        curl_close ( $ch );
        return $result;
    }
}
//示例代码
// $areaid=@$_REQUEST['areaid']?$_REQUEST['areaid']:0;
// $weather_obj = new weather();
//print_r($weather_obj->get_weather_info($areaid));
//echo '<br/><br/>城市ID列表：<br/>';
//foreach($weather_obj->areaids_arr as $key=>$areaid){
//	echo $areaid['AREAID'].' '.$areaid['NAMECN'].'<br/>';
//}