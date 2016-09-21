<?php
/**
 * 测试
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class TestAction extends Action {
    public function index(){
		R('Admin/Test/test');
    }
    public function test()
    {
    	print_r($_SESSION);
    	die();
    	$this->display();
    }
    /**
     * 采集网址|名称，域名
     */
    public function get_link_by_url()
    {
        if($_GET['url']){
            //http://www.linglingtang.com/index.php?s=/Index/caijing.html
            $contents = file_get_contents($_GET['url']);//获取页面内容
             
            $pattern="/<span><a href=\"(.*)\" target=\"_blank\" class=\"yd-\">(.*)<\/a><\/span>/iUs";//正则
            preg_match_all($pattern, $contents, $arr);//匹配内容到arr数组
//             print_r($arr);die;
            $Website_model = D('Website');
            foreach ($arr[1] as $key => $value) 
            {
                //二维数组[2]对应id和[1]刚好一样,利用起key
                $url=$value;
                $name=$arr[2][$key];
                $data['name']=$name;
                $data['short_name']=$name;
                $data['url']=$url;
                $data['category_id']='34';
//                 print_r($data);die;
                $Website_model->add_website($data);
        
                //echo "<a href='content.php?url=http://www.93moli.com/$url'>$value</a>"."<br/>";
            }
            echo "正在采集$name...请稍后...";
            echo "<script>window.location='".U('Test/get_link_by_url@admin',array('url'=>''))."'</script>";
        
        }else{
            echo "采集数据结束。";
        }
    }
    /**
     * 采集影片(http://www.mianbao99.com/)
     */
    public function get_film_from_mianbao99()
    {
//         $url_arr[]='http://www.mianbao99.com/action/';//动作片
//         $url_arr[]='http://www.mianbao99.com/drama/';//剧情片
//         $url_arr[]='http://www.mianbao99.com/comedy/';//喜剧片
//         $url_arr[]='http://www.mianbao99.com/romance/';//爱情片
//         $url_arr[]='http://www.mianbao99.com/horror/';//恐怖片
//         $url_arr[]='http://www.mianbao99.com/fiction/';//科幻片
        $url_arr[]='http://www.mianbao99.com/war/';//战争片
        $url_arr[]='http://www.mianbao99.com/cartoonmovie/';//动画片
        $url_arr[]='http://www.mianbao99.com/documentary/';//纪录片
        if($url_arr){
            $Film_model = D('Film');//电影
            $Tag_model = D('Tags');//标签
            $Url_model = D('Url');//网址
            $Film_play_source_model = D('Film_play_source');//播放源
            foreach($url_arr as $key1=>$url)
            {
                
                $contents = file_get_contents($url);//获取页面内容
                $pattern="/<a href=\"(.*)\">(.*)<\/a>/iUs";//正则
                preg_match_all($pattern, $contents, $arr);//匹配内容到arr数组
//                 print_r($arr);die;
                
                foreach ($arr[1] as $key2 => $value)
                {
                    //二维数组[2]对应id和[1]刚好一样,利用起key
                    $film_url='http://www.mianbao99.com'.$value;
                    $film_name=$arr[2][$key2];
                    $film_data['name']=$film_name;
                    $film_data['short_name']=$film_name;
                    $film_data['status']=1;
//                     $data['url']=$url;
//                     $data['category_id']='34';
//                     print_r($film_data);die;
                    
                    $film_info=$Film_model->add_film($film_data);
                    if(!empty($film_info))
                    {
                        $url_data=array();
                        $url_data['url']=$film_url;
                        $url_info = $Url_model->add_url( $url_data);
                    }
                    if(!empty($url_info))
                    {
                        $source_data=array();
                        $source_data['url_id']=$url_info['data']['id'];
                        $source_data['film_id']=$film_info['data']['id'];
                        $source_data['status']=1;
                        $source_info =$Film_play_source_model->add_play_source( $source_data);
                    }
                    if(!empty($film_info))
                    {
                        $tag_arr=array('动作片','剧情片','喜剧片','爱情片','恐怖片','科幻片','战争片','动画片','纪录片');
                        $tag_data=array();
                        $tag_data['tag']=$tag_arr[$key1];
                        $tag_data['film_id']=$film_info['data']['id'];
                        $tag_data['url_id']=$url_info['data']['id'];
                        $tag_info=$Tag_model->add_tag( $tag_data);
                    }
//                 print_r($film_info);
//                 print_r($url_info);
//                 print_r($source_info);
//                 print_r($tag_info);die();
                    //echo "<a href='content.php?url=http://www.93moli.com/$url'>$value</a>"."<br/>";
                }
            }
            echo "正在采集$name...请稍后...";
            echo "<script>window.location='".U('Test/get_link_by_url@admin',array('url'=>''))."'</script>";
        }
    }
    public function mianbao_get_film_info()
    {
        import('ORG.Film_service.Film_service',LIB_PATH);// 导入统一电影类
        $Film_service_obj = new Film_service('Mianbao_film');
        $film_info['name']='绝地逃亡';
        $get_film_result = $Film_service_obj->get_film_info($film_info);
        //print_r($get_film_result);
    }
    public function mianbao_get_play_by_film_url()
    {
        import('ORG.Film_service.Film_service',LIB_PATH);// 导入统一电影类
        $film_url='http://www.mianbao99.com/action/jueditaowang/';
        $Film_service_obj = new Film_service();
        $get_play_result = $Film_service_obj->get_play_by_film_url($film_url);
        print_r($get_play_result);
    }
    public function mianbao_get_film_comment()
    {
        import('ORG.Film_service.Film_service',LIB_PATH);// 导入天气类
        $Film_service_obj = new Film_service('Mianbao_film');
        $film_info['name']='暗杀教室真人版';
        $get_film_comment_result = $Film_service_obj->get_film_comment($film_info);
    }
    public function chouti_get_news_list()
    {
        import('ORG.News_service.News_service',LIB_PATH);// 导入新闻类
        $News_service_obj = new News_service('Chouti_news');
//         $condition['name']='暗杀教室真人版';
        $get_news_list_result = $News_service_obj->get_news_list($condition);
        print_r($get_news_list_result);die();
    }
    /**
     * 中国天气网城市ID
     */
    public function get_weather_areaid_to_district() 
    {
		die();
        import('ORG.Weather',LIB_PATH);// 导入天气类
        $Weather_obj = new Weather();
        $areaids_arr=$Weather_obj->areaids_arr;
        $District_model = D('District');
//         $District_model->get_district_list($condition,'*',$page_size=100000);
        $i=0;
        foreach ($areaids_arr as $area)
        {
            $get_condition=array();
            $get_condition['level']=2;
            $get_condition['name']=array('like',$area['NAMECN'].'%');
            $data=array('weather_area_id'=>$area['AREAID']);
//             $info = $District_model->where($get_condition)->find();
            $District_model->where($get_condition)->data($data)->save();
//             echo 'name:'.$info['name'].' NAMECN:'.$area['NAMECN'].' AREAID:'.$area['AREAID'].'<br>';
//             if($i>30)
//             {
//                 die();
//             }
//             $i++;
//             sleep(1);
        }
    }
    public function get_weather_by_city_id()
    {
    	import('ORG.Weather_service.Weather_service',LIB_PATH);// 导入天气类
    	$Weather_service_obj = new Weather_service('Sina_weather');
    	$city_info['id']=1;
    	$city_info['short_name']='北京';
//     	$result = $Weather_service_obj->get_weather_info7($city_info);
    	$result=$Weather_service_obj->get_weather_by_date($city_info,'2016-7-20');
    	print_r($result);die();
    }
}