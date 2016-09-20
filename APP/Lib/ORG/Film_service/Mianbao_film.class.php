<?php
/**
* 电影API接口类
* 获取电影数据
* Copyright (c) 2014-2015 http://www.linglingtang.com, All rights reserved.
* Author: 陈永鹏Yoper <944975166@qq.com>
*/
class Mianbao_film implements Film_interface
{
    const   DOMAIN_NAME='http://www.mianbao99.com/';
    private $now_url = '';
    //电视剧
    private $url_0="http://www.mianbao99.com/mainland/";//内地
    private $url_1="http://www.mianbao99.com/tvb/";//港剧
    private $url_2="http://www.mianbao99.com/korea/";//韩剧
    private $url_3="http://www.mianbao99.com/occident/";//美剧
    private $url_4="http://www.mianbao99.com/taiwan/";//台剧
    private $url_5="http://www.mianbao99.com/japan/";//日剧
    private $url_6="http://www.mianbao99.com/singapore/";//泰剧
    private $url_7="http://www.mianbao99.com/overseas/";//海外
    
    //电影
    private $url_8="http://www.mianbao99.com/action/";//动作片
    private $url_9="http://www.mianbao99.com/drama/";//剧情片
    private $url_10="http://www.mianbao99.com/comedy/";//喜剧片
    private $url_11="http://www.mianbao99.com/romance/";//爱情片
    private $url_12="http://www.mianbao99.com/horror/";//恐怖片
    private $url_13="http://www.mianbao99.com/fiction/";//科幻片
    private $url_14="http://www.mianbao99.com/war/";//战争片
    private $url_15="http://www.mianbao99.com/cartoonmovie/";//动画片
    private $url_16="http://www.mianbao99.com/documentary/";//纪录片
    
    //电影
    private $film_info_fields=array(
        'name'=>'',
        'short_name'=>'',
        'content'=>'',
    );
    //明星
    private $film_starring   =array(
        
    );
    //电影播放源
    private $play_info_fields=array();
    
    /**
     * 根据电影名称获取电影信息
     * @see Film_interface::get_film_info()
     */
    public function get_film_info($film_info)
    {
        $result = array('status'=>0);
        if(empty($film_info['name']))
        {
            $result['message']='电影名称为空';
            return $result;
        }
        $film_arr_tmp =array();
        for($i=8;$i<=16;$i++)
        {
            $target_url = 'url_'.$i;
            $this->now_url = $this->$target_url;
        
            $curl_result = $this->curl($this->now_url);
            $pattern='/<dd><span>(.*)<\/span><a href=\"(.*)\">(.*)<\/a><\/dd>/iU';//正则
//             $pattern='/<dd><span>(.*)<\/span><a href=\"(.*)\">\s*'.$film_info['name'].'\s*<\/a><\/dd>/iU';//正则
            preg_match_all($pattern, $curl_result, $film_arr_tmp);//匹配内容到arr数组
//             $film_arr_tmp:
//     Array
//     (
//     [0] => Array
//         (
//             [0] => <dd><span>01.</span><a href="/action/anshajiaoshizhenrenban/">暗杀教室真人版</a></dd>
//             [1] => <dd><span>02.</span><a href="/action/anpojingjie/">安珀警戒</a></dd>
//          )
//     [1] => Array
//         (
//             [0] => 01.
//             [1] => 02.
//         )
//     [2] => Array
//         (
//             [0] => /action/anshajiaoshizhenrenban/
//             [1] => /action/anshajiaoshizhenrenban/
//         )
//         [3] => Array
//         (
//             [0] => 暗杀教室真人版
//             [1] => 安珀警戒
//         )
//     )
            foreach ($film_arr_tmp[3] as $key=>$film_info_tmp)
            {
                if(trim($film_info_tmp) == trim($film_info['name']))
                {
                    $film_detail_url = self::DOMAIN_NAME.$film_arr_tmp[2][$key];
                }
            }
        }
        if(empty($film_detail_url))
        {
            $result['message']='匹配不到该电影';
            return $result;
        }
        //电影详情页
        $curl_result = $this->curl($film_detail_url);
//         print_r($curl_result);die();
        $pattern_content = '/<div class=\"detail-desc-cnt\">([\w\W]*?)<\/div>/iU';//简介
        preg_match($pattern_content, $curl_result, $dom_film_content);
//         echo $pattern_content;
//         print_r($dom_film_content);
        //简介,去掉html标签
        $film_content=strip_tags($dom_film_content[1]);
        $this->film_info_fields['content']=$film_content;
//         echo $film_content;
        $pattern = '/<div class=\"info fn-clear\">(.*)<\/div>/iU';//正则
        preg_match($pattern, $curl_result, $dom_film_info_tmp);//匹配内容到arr数组
//         print_r($dom_film_info_tmp);
//         echo $film_detail_url;
        if(empty($dom_film_info_tmp))
        {
            $result['message']='匹配不到电影详情信息';
            return $result;
        }
        $dom_pattern_starring = '/<dl><dt>主演：<\/dt><dd>(.*)<\/dd><\/dl>/iU';//主演
        $dom_pattern_region   = '/<dl class=\"fn-right\"><dt>地区：<\/dt><dd>(.*)<\/dd><\/dl>/iU';//地区
        $dom_pattern_film_type= '/<dl class=\"fn-left\"><dt>类型：<\/dt><dd>(.*)<\/dd><\/dl>/iU';
        $dom_pattern_language = '/<dl class=\"fn-left\"><dt>语言：<\/dt><dd>(.*)<\/dd><\/dl>/iU';
//         $pattern = '/<dl><dt>状态：<\/dt><dd>(.*)<\/dd><\/dl>/iU';
        preg_match($dom_pattern_starring, $dom_film_info_tmp[1],$dom_starring);//主演|周星驰，
        preg_match($dom_pattern_region, $dom_film_info_tmp[1],$dom_region);//地区|大陆，香港
        preg_match($dom_pattern_film_type, $dom_film_info_tmp[1],$dom_type);//类型|动作片,冒险
        preg_match($dom_pattern_language, $dom_film_info_tmp[1],$dom_language);//类型|动作片,冒险
        print_r($dom_starring);print_r($dom_region);print_r($dom_type);print_r($dom_language);//语言|国语对白 中英字幕，
        echo '|';
        $pattern_starring  = '/<a href="(.*)" target=\"_blank\">(.*)<\/a>/iU';//主演|周星驰，
        $pattern_region    = '/<span>(.*)<\/span>/iU';//地区|大陆，香港
        $pattern_film_type = '/<a href=\"(.*)\">(.*)<\/a>/iU';//类型|动作片,冒险
        $pattern_language  = '/<span>(.*)<\/span>/iU';//语言|国语对白 中英字幕，
        preg_match_all($pattern_starring, $dom_starring[1],$starring_arr);
        preg_match_all($pattern_region, $dom_region[1],$region_arr);
        preg_match_all($pattern_film_type, $dom_type[1],$type_arr);
        preg_match_all($pattern_language, $dom_language[1],$language_arr);
        print_r($starring_arr);print_r($region_arr);print_r($type_arr);print_r($language_arr);die();
        
        $film_info=array();
        $film_info['name']=$film_info_tmp[0];
        $result['status']=1;
        $result['data']=$film_info;
        return $result;
//         $film_detail_url = $this->domain_name.$film_arr_tmp[1];
//         $this->get_play_by_film_url($film_detail_url);

    }
    /**
     * 根据电影详情页url获取播放链接
     * @param string $film_url
     * @return array
     */
    public function get_play_by_film_url($film_url)
    {
        $result = array('status'=>0);
        if(empty($film_url)|| !(filter_var($film_url, FILTER_VALIDATE_URL)))
        {
            $result['message']='url错误:'.$film_url;
            return $result;
        }
        $curl_result = $this->curl($film_url);
        $play_list_pattern = '/<p class=\"play-list\">(.*)<\/p>/iU';
        preg_match($play_list_pattern, $curl_result, $play_list_match);
//        $play_list_tmp:Array
//             (
//                 [0] => <p class="play-list"><a  target="_blank" href="/videos/68759vod-play-id-68759-sid-0-pid-1.html">BD</a><a  target="_blank" href="/videos/68759vod-play-id-68759-sid-0-pid-0.html">DVD</a></p>
//                 [1] => <a  target="_blank" href="/videos/68759vod-play-id-68759-sid-0-pid-1.html">BD</a><a  target="_blank" href="/videos/68759vod-play-id-68759-sid-0-pid-0.html">DVD</a>
//             )
        if(empty($play_list_match))
        {
            $result['message']='匹配不到 play-list节点';
            return $result;
        }
        $play_pattern = '/<a  target=\"_blank\" href=\"(.*)\">(.*)<\/a>/iU';
        //             echo $play_pattern.'|';
        //             echo $play_list_match[1];
        preg_match_all($play_pattern, $play_list_match[1], $play_list_tmp);
//             Array
//             (
//                 [0] => Array
//                 (
//                     [0] => <a  target="_blank" href="/videos/68759vod-play-id-68759-sid-0-pid-1.html">BD</a>
//                     [1] => <a  target="_blank" href="/videos/68759vod-play-id-68759-sid-0-pid-0.html">DVD</a>
//                 )

//                 [1] => Array
//                 (
//                     [0] => /videos/68759vod-play-id-68759-sid-0-pid-1.html
//                     [1] => /videos/68759vod-play-id-68759-sid-0-pid-0.html
//                 )

//                 [2] => Array
//                 (
//                     [0] => BD
//                     [1] => DVD
//                 )

//             )
        if(empty($play_list_tmp))
        {
            $result['message']='匹配不到 播放链接节点';
            return $result;
        }
        $play_list = array();
        foreach($play_list_tmp[1] as $key=>$play_url)
        {
            $play_list[$key]['url']=$this->domain_name.$play_url;
            $play_list[$key]['name']=$play_list_tmp[2][$key];
        }
        
        if(!empty($play_list))
        {
            $result['status']=1;
            $result['data']['list']=$play_list;
        }
        return $result;
    }
    public function get_film_comment()
    {
        
    }
    public function get_film_list($condition)
    {
    
    }
    public function search_film($condition) 
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