<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="title" content="" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="language" content="chinese" />
<title>七爷租车-中国最大私家车共享平台 </title>
<link rel="stylesheet" href="../Public/style.css" type="text/css" media="all"/>
<script type="text/javascript" src="__Public__/js/jquery.min.js"></script>
</head>
<body>
	<!--header-->
<div id="top">
  <div class="wrapper">
    <div class="logo"><img src="../Public/image/logo.png" width="299" height="90" /></div>
    <div class="logo_txt"><img src="../Public/image/logo_txt.png" width="527" height="42" /></div>
  </div>
</div>
<div id="menu">
  <div class="wrapper">
    <div class="nav">
        <ul>
        <li  ><a href="<?php echo U('Index/index');?>">首页</a></li>
        <li class="current"><a href="<?php echo U('Car/car_list');?>">我要租车</a></li>
        <!--<li ><a href="<?php echo U('Aircraft/aircraft_list');?>">租飞机</a></li>
		<li ><a href="<?php echo U('Cruises/cruises_list');?>">租游轮</a></li>
        <li ><a href="<?php echo U('Hotels/hotels_list');?>">酒店</a></li>-->
        <li ><a href="<?php echo U('Index/violation');?>">租车流程</a></li>
        <li ><a href="<?php echo U('Index/process');?>">相关协议</a></li>
        <li ><a href="<?php echo U('News/index');?>">新闻资讯</a></li>
        <li ><a href="<?php echo U('Index/about');?>">关于我们</a></li>
        <li ><a href="<?php echo U('Index/contact');?>">联系我们</a></li>
         
        </ul>
    </div>
   <div class="login">
    	     	<ul>
    	<li class="signup"><a href="<?php echo U('Reg/index');?>">注册</a></li>
        <li class="login"><a href="<?php echo U('Login/index');?>">登录</a></li>
        </ul>    </div>
  </div>
</div>
<!--content-->
<div class="w100">
    <div class="carlist_so">
        <div class="wrapper">
            <form action="" method="get">
                <!--<div class="carlistso_date color_gray">选择提车日期<span class="carlistso_date_down float_right"><a href=""><img src="/qiyezuche/Tpl/Home/default_theme/Public/images/icon_carlistso_date.png"></a></span></div>
            <div class="carlistso_date">2014-01-01<span class="carlistso_date_down float_right"><a href=""><img src="/qiyezuche/Tpl/Home/default_theme/Public/images/icon_carlistso_date.png"></a></span></div>
            <div class="carlistso_down_bg">价格
            <span class="carlistso_down float_right"><a href=""><img src="/qiyezuche/Tpl/Home/default_theme/Public/images/img_carlistso_down.jpg"></a></span>
            </div>-->
                <div class="carlistso_date">
                    <input type="text" placeholder="请输入车名" size="18"  style="color:#CCCCCC;padding:0px;width:100px;"  class="csinput" name="carname" value=''>
                </div>
                <div class="carlist_soadd">
                    <label class="cslabel">地址</label>
                    <input type="text" placeholder="请输入搜索地址" size="28"  style="color:#CCCCCC;" class="csinput" name="address" value=''>
                </div>
                <div class="carlist_sobt">
                    <input name="submit" type="submit" value="搜索">
                </div>
            </form>
        </div>
    </div>
    <div class="carlist_filter">
        <ul class="wrapper">
            <li><a href="/index.php/car/car_list"  
                class="current"                >全部</a></li>
            <li class="icon_carlist_up"><a href="/index.php/car/car_list/flag/dayprice" 
                                >价格</a></li>
            <!--<li class="icon_carlist_up"><a href="">距离</a></li>-->
        </ul>
    </div>
</div>
<div class="wrapper mb50">
    <div class="carlist">
        <ul>
            <li>
                    <div class="carlist_left">
                        <div class="carlist_img"> <a href="/index.php/car/Car_detail/id/36.html"><img src="/Public/qiyezuche/user/36/5487ba220e9ac.jpg" width="218" height="149"/></a> </div>
                        <div class="carlist_txt"> <span class="carlist_title"><a href="/index.php/car/Car_detail/id/36.html">海马family</a></span> <span class="carlist_ct">车型：跑车<br />
                            变速箱：自动挡</span> <span class="carlist_add"></span> <span class="carlist_bt"><a href="/index.php/car/Car_detail/id/36.html" class="carlist_vmap">查看地图</a> <a href="javascript:void(0)" class="carlist_fav" data="36">收藏此车</a></span> </div>
                    </div>
                    <div class="carlist_right">
                        <div class="cl_p_day"><b>200.00元</b>/天</div>
                        <div class="cl_bt_show"><a href="/index.php/car/Car_detail/id/36.html">详情</a></div>
                    </div>
                </li><li>
                    <div class="carlist_left">
                        <div class="carlist_img"> <a href="/index.php/car/Car_detail/id/32.html"><img src="/Public/qiyezuche/user/32/548162914e6df.jpg" width="218" height="149"/></a> </div>
                        <div class="carlist_txt"> <span class="carlist_title"><a href="/index.php/car/Car_detail/id/32.html">宝马3201</a></span> <span class="carlist_ct">车型：跑车<br />
                            变速箱：自动挡</span> <span class="carlist_add">猎德花园艺园楼</span> <span class="carlist_bt"><a href="/index.php/car/Car_detail/id/32.html" class="carlist_vmap">查看地图</a> <a href="javascript:void(0)" class="carlist_fav" data="32">收藏此车</a></span> </div>
                    </div>
                    <div class="carlist_right">
                        <div class="cl_p_day"><b>0.00元</b>/天</div>
                        <div class="cl_bt_show"><a href="/index.php/car/Car_detail/id/32.html">详情</a></div>
                    </div>
                </li><li>
                    <div class="carlist_left">
                        <div class="carlist_img"> <a href="/index.php/car/Car_detail/id/27.html"><img src="/Public/qiyezuche/admin/5434af03f1de1.jpg" width="218" height="149"/></a> </div>
                        <div class="carlist_txt"> <span class="carlist_title"><a href="/index.php/car/Car_detail/id/27.html">广汽本田</a></span> <span class="carlist_ct">车型：跑车<br />
                            变速箱：自动挡</span> <span class="carlist_add">天河</span> <span class="carlist_bt"><a href="/index.php/car/Car_detail/id/27.html" class="carlist_vmap">查看地图</a> <a href="javascript:void(0)" class="carlist_fav" data="27">收藏此车</a></span> </div>
                    </div>
                    <div class="carlist_right">
                        <div class="cl_p_day"><b>200.00元</b>/天</div>
                        <div class="cl_bt_show"><a href="/index.php/car/Car_detail/id/27.html">详情</a></div>
                    </div>
                </li><li>
                    <div class="carlist_left">
                        <div class="carlist_img"> <a href="/index.php/car/Car_detail/id/26.html"><img src="/Public/qiyezuche/admin/5434ae068d365.jpg" width="218" height="149"/></a> </div>
                        <div class="carlist_txt"> <span class="carlist_title"><a href="/index.php/car/Car_detail/id/26.html">广汽本田</a></span> <span class="carlist_ct">车型：跑车<br />
                            变速箱：自动挡</span> <span class="carlist_add">天河</span> <span class="carlist_bt"><a href="/index.php/car/Car_detail/id/26.html" class="carlist_vmap">查看地图</a> <a href="javascript:void(0)" class="carlist_fav" data="26">收藏此车</a></span> </div>
                    </div>
                    <div class="carlist_right">
                        <div class="cl_p_day"><b>250.00元</b>/天</div>
                        <div class="cl_bt_show"><a href="/index.php/car/Car_detail/id/26.html">详情</a></div>
                    </div>
                </li><li>
                    <div class="carlist_left">
                        <div class="carlist_img"> <a href="/index.php/car/Car_detail/id/25.html"><img src="/Public/qiyezuche/admin/5434ad521e312.jpg" width="218" height="149"/></a> </div>
                        <div class="carlist_txt"> <span class="carlist_title"><a href="/index.php/car/Car_detail/id/25.html">福特 </a></span> <span class="carlist_ct">车型：跑车<br />
                            变速箱：自动挡</span> <span class="carlist_add">天河</span> <span class="carlist_bt"><a href="/index.php/car/Car_detail/id/25.html" class="carlist_vmap">查看地图</a> <a href="javascript:void(0)" class="carlist_fav" data="25">收藏此车</a></span> </div>
                    </div>
                    <div class="carlist_right">
                        <div class="cl_p_day"><b>250.00元</b>/天</div>
                        <div class="cl_bt_show"><a href="/index.php/car/Car_detail/id/25.html">详情</a></div>
                    </div>
                </li><li>
                    <div class="carlist_left">
                        <div class="carlist_img"> <a href="/index.php/car/Car_detail/id/24.html"><img src="/Public/qiyezuche/admin/5434ab8fa1a14.jpg" width="218" height="149"/></a> </div>
                        <div class="carlist_txt"> <span class="carlist_title"><a href="/index.php/car/Car_detail/id/24.html">北京现代</a></span> <span class="carlist_ct">车型：跑车<br />
                            变速箱：自动挡</span> <span class="carlist_add">天河</span> <span class="carlist_bt"><a href="/index.php/car/Car_detail/id/24.html" class="carlist_vmap">查看地图</a> <a href="javascript:void(0)" class="carlist_fav" data="24">收藏此车</a></span> </div>
                    </div>
                    <div class="carlist_right">
                        <div class="cl_p_day"><b>300.00元</b>/天</div>
                        <div class="cl_bt_show"><a href="/index.php/car/Car_detail/id/24.html">详情</a></div>
                    </div>
                </li><li>
                    <div class="carlist_left">
                        <div class="carlist_img"> <a href="/index.php/car/Car_detail/id/23.html"><img src="/Public/qiyezuche/admin/5434aa9a176be.jpg" width="218" height="149"/></a> </div>
                        <div class="carlist_txt"> <span class="carlist_title"><a href="/index.php/car/Car_detail/id/23.html">丰田</a></span> <span class="carlist_ct">车型：跑车<br />
                            变速箱：自动挡</span> <span class="carlist_add">天河</span> <span class="carlist_bt"><a href="/index.php/car/Car_detail/id/23.html" class="carlist_vmap">查看地图</a> <a href="javascript:void(0)" class="carlist_fav" data="23">收藏此车</a></span> </div>
                    </div>
                    <div class="carlist_right">
                        <div class="cl_p_day"><b>200.00元</b>/天</div>
                        <div class="cl_bt_show"><a href="/index.php/car/Car_detail/id/23.html">详情</a></div>
                    </div>
                </li><li>
                    <div class="carlist_left">
                        <div class="carlist_img"> <a href="/index.php/car/Car_detail/id/22.html"><img src="/Public/qiyezuche/admin/5434a9eb30bb8.jpg" width="218" height="149"/></a> </div>
                        <div class="carlist_txt"> <span class="carlist_title"><a href="/index.php/car/Car_detail/id/22.html">日产轩逸</a></span> <span class="carlist_ct">车型：跑车<br />
                            变速箱：自动挡</span> <span class="carlist_add">天河</span> <span class="carlist_bt"><a href="/index.php/car/Car_detail/id/22.html" class="carlist_vmap">查看地图</a> <a href="javascript:void(0)" class="carlist_fav" data="22">收藏此车</a></span> </div>
                    </div>
                    <div class="carlist_right">
                        <div class="cl_p_day"><b>300.00元</b>/天</div>
                        <div class="cl_bt_show"><a href="/index.php/car/Car_detail/id/22.html">详情</a></div>
                    </div>
                </li><li>
                    <div class="carlist_left">
                        <div class="carlist_img"> <a href="/index.php/car/Car_detail/id/21.html"><img src="" width="218" height="149"/></a> </div>
                        <div class="carlist_txt"> <span class="carlist_title"><a href="/index.php/car/Car_detail/id/21.html">全球鹰</a></span> <span class="carlist_ct">车型：跑车<br />
                            变速箱：自动挡</span> <span class="carlist_add">天河</span> <span class="carlist_bt"><a href="/index.php/car/Car_detail/id/21.html" class="carlist_vmap">查看地图</a> <a href="javascript:void(0)" class="carlist_fav" data="21">收藏此车</a></span> </div>
                    </div>
                    <div class="carlist_right">
                        <div class="cl_p_day"><b>300.00元</b>/天</div>
                        <div class="cl_bt_show"><a href="/index.php/car/Car_detail/id/21.html">详情</a></div>
                    </div>
                </li><li>
                    <div class="carlist_left">
                        <div class="carlist_img"> <a href="/index.php/car/Car_detail/id/20.html"><img src="/Public/qiyezuche/admin/5434a85e2e417.jpg" width="218" height="149"/></a> </div>
                        <div class="carlist_txt"> <span class="carlist_title"><a href="/index.php/car/Car_detail/id/20.html">丰田</a></span> <span class="carlist_ct">车型：跑车<br />
                            变速箱：自动挡</span> <span class="carlist_add">天河</span> <span class="carlist_bt"><a href="/index.php/car/Car_detail/id/20.html" class="carlist_vmap">查看地图</a> <a href="javascript:void(0)" class="carlist_fav" data="20">收藏此车</a></span> </div>
                    </div>
                    <div class="carlist_right">
                        <div class="cl_p_day"><b>250.00元</b>/天</div>
                        <div class="cl_bt_show"><a href="/index.php/car/Car_detail/id/20.html">详情..</a></div>
                    </div>
                </li>
			<?php if(is_array($result['data']['list'])): foreach($result['data']['list'] as $key=>$vo): ?><li>
                    <div class="carlist_left">
                        <div class="carlist_img"> <a href="/index.php/car/Car_detail/id/20.html"><img src="/Public/qiyezuche/admin/5434a85e2e417.jpg" width="218" height="149"/></a> </div>
                        <div class="carlist_txt"> <span class="carlist_title"><a href="/index.php/car/Car_detail/id/20.html"><?php echo ($vo["name"]); ?></a></span> <span class="carlist_ct">车型：跑车<br />
                            变速箱：自动挡</span> <span class="carlist_add">天河123</span> <span class="carlist_bt"><a href="/index.php/car/Car_detail/id/20.html" class="carlist_vmap">查看地图</a> <a href="javascript:void(0)" class="carlist_fav" data="20">收藏此车</a></span> </div>
                    </div>
                    <div class="carlist_right">
                        <div class="cl_p_day"><b><?php echo ($vo["rental_price"]); ?>元</b>/<?php echo ($vo["time_unit"]); ?></div>
                        <div class="cl_bt_show"><a href="/index.php/car/Car_detail/id/20.html">详情</a></div>
                    </div>
                </li><?php endforeach; endif; ?>
				 </ul>
    </div>
    
    <!-- <div class="news_pages">
     <ul class="pagelist">
        <li><a href="">上一页</a></li>
        <li class="thisclass">1</li>
        <li><a href="">2</a></li>
        <li><a href="">3</a></li>
        <li><a href="">4</a></li>
        <li><a href="">5</a></li>
        <li><span class="pageinfo"><b>...</b></span></li>
        <li><a href="">9</a></li>
        <li><a href="">下一页</a></li>
	</ul>
    </div>-->
    <div class="news_pages">
        <ul class="pagelist">
              <li><a class='down' href="<?php echo U('Yo80005/Car/car_list',array('p'=>$result['data']['page']['page']+1));?>">下一页</a></li>   &nbsp;<li><span class='current'>1</span></li>&nbsp;<li><a href='/index.php/car/car_list/p/2.html'>&nbsp;2&nbsp;</a></li>&nbsp;<li><a href='/index.php/car/car_list/p/3.html'>&nbsp;3&nbsp;</a></li>           </ul>
    </div>
</div>
</div>
<!--footer-->
<div id="footer">
  <div class="copy_black">粤ICP备11017824号-4 / 粤ICP证130164号
  <br />广州市公安局天河分局备案编号:110105000501
  <br />Copyright &copy;  2012-2016
   <a href="http://www.linglingtang.com">零零糖</a>|
   <a href="http://linglingtang.uz.taobao.com">礼物</a>
  </div>
</div>

</body>
</html>