<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="__PUBLIC__/Widget/Header/Yocms_header_2/Yocms_header_2_<?php echo (($css)?($css):'w1200_gray'); ?>.css">
<div class="Yocms_header2">
	<div id="hd">
	            <!-- logo -->
	            <a class="logo" href="<?php echo (($site_info['site_url'])?($site_info['site_url']):'http://www.linglingtang.com/'); ?>" title="<?php echo (($site_info['site_name'])?($site_info['site_name']):'零零糖'); ?>" onclick="" target="_blank">
				<img src="<?php echo (($site_info['logo'])?($site_info['logo']):'__PUBLIC__/Widget/Header/Yocms_header_2/logo.png'); ?>">
				</a>
	            <!-- 日历 -->
	<div id="middle1">
	    <p class="date" curdate="1399951259983">
	        <span>逛逛街</span>
	        <span>&nbsp;</span>
	        <span class="time">买东西</span>
	    </p>
	            <p class="qa">
	        <a href="http://union.click.jd.com/jdc?e=&p=AyIEZRhaFgAaB1YdXCUBEwRXE1sWBBs3EUQDS10iXhBeGh4cDFsFRgYKWUcYB0UHC1pNUgFSRxwKEA5RBAJQXk83HWcfEXF0BQl7KE11blQxUz9nXVJZJRdXJQMiBFEZWxYCEgdRK2t0cCJGOxJTFwsW&t=W1dCFBBFC15CWggEAEAdQFkJBQNKV0ZOSRJTFwsWGAxeB0g%3D" onclick="" target="_blank">天天特价精选<!--Yoper--></a>
	    </p>
	    </div>  
		<div class="middle2">
			<div class="left">
		  <span id="month_day" style="margin-top: 0px;padding-bottom: 10px;display: block;color: #999;">6月27日(五)</span>

		  <span style="margin-top: 10px;padding-bottom: 10px;    display: block;color: #999;"><!--农历五月十二--></span>
		  </div>
		  <div class="left">
		  <span id="city_namecn" style="color: #999;"></span><a onclick="get_district_list(this)" style="color:#999" href="javascript:;">(切换)</a>
		  <span id="weather_phenomenon" style="color: #999;"></span>
		  <span id="temperature" style="color: #999;"></span>
		  <span id="wind_power" style="color: #999; display: block;"></span>
		    </div>
		</div>
				<!-- 广告 -->
	            <div id="adao">
				<!--京东推广-->
				<a title="女生主题" onclick="set_theme_color($(this).attr('data-theme-color'))" href="javascript:;" data-theme-color="pink"><img height="100%" src="__PUBLIC__/Uploads/default_avatar/face_luoxiaohei/luo_1.gif"></a>
				<a title="男生主题" onclick="set_theme_color($(this).attr('data-theme-color'))" href="javascript:;" data-theme-color="dark"><img height="100%" src="__PUBLIC__/Uploads/default_avatar/face_luoxiaohei/luo_2.png"></a>
				<a title="白色主题" onclick="set_theme_color($(this).attr('data-theme-color'))" href="javascript:;" data-theme-color="white"><img height="100%" src="__PUBLIC__/Uploads/default_avatar/face_luoxiaohei/luo_3.png"></a>
				<a title="主题待开发" onclick="set_theme_color($(this).attr('data-theme-color'))" href="javascript:;" data-theme-color="dark"><img height="100%" src="__PUBLIC__/Uploads/default_avatar/face_luoxiaohei/luo_4.png"></a>
				<a title="主题待开发" onclick="set_theme_color($(this).attr('data-theme-color'))" href="javascript:;" data-theme-color="pink"><img height="100%" src="__PUBLIC__/Uploads/default_avatar/face_luoxiaohei/luo_5.png"></a>
				<a title="主题待开发" onclick="set_theme_color($(this).attr('data-theme-color'))" href="javascript:;" data-theme-color="white"><img height="100%" src="__PUBLIC__/Uploads/default_avatar/face_luoxiaohei/luo_6.png"></a>
				<!--京东推广-->
				</div>
	</div>
</div>
<script>
require(['jquery'], function($){
	if(typeof(Yocms_header_2_is_load)=="undefined"){
		$("body").append('<script src="__PUBLIC__/Widget/Header/Yocms_header_2/Yocms_header_2.js" type="text/javascript"><\/script>');
	}
});
</script>