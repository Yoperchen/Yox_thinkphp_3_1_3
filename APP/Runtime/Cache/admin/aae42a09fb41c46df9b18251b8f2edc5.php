<?php if (!defined('THINK_PATH')) exit();?>﻿<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
<ul class="Yocms_navigation_201">
    <li class="mainlevel"><span class="note"><a href="#">首页</a></span></li> 
   <?php if(is_array($list)): foreach($list as $key=>$navigation): ?><!-- 顶级分类 -->
    <li class="mainlevel" id="mainlevel_01"><a title="<?php echo (($navigation['description'])?($navigation['description']):$navigation['name']); ?>" href="<?php echo ($navigation['url']); ?>"><?php echo ($navigation['name']); ?></a>
    <!-- 子类 -->
    <?php if($navigation['children']): ?><ul class="sub_nav_01">
    <span class="Triangle_con"></span>
    <?php if(is_array($navigation["children"])): foreach($navigation["children"] as $key=>$children1): ?><li><a title="<?php echo (($children1['description'])?($children1['description']):$children1['name']); ?>" href="<?php echo ($children1['url']); ?>"><?php echo ($children1['name']); ?></a></li><?php endforeach; endif; ?>
    <!-- 
    <li><a href="#">chrome</a></li>
    <li><a href="#">opera</a></li>
    <li><a href="#">IE</a></li>
    <li><a href="#">Netscape</a></li> 
    -->
    </ul><?php endif; ?>
    </li><?php endforeach; endif; ?>
    <!--  
    <li class="mainlevel" id="mainlevel_02"><a href="#">html</a>
    <ul class="sub_nav_01">
    <span class="Triangle_con"></span>
    <li><a href="#">html</a></li>
    <li><a href="#">xhtml</a></li>
    <li><a href="#">html5</a></li>
    <li><a href="#">css</a></li>
    <li><a href="#">TCP/IP</a></li>
    </ul>
    </li> 
       
    <li class="mainlevel"><a href="#">xml</a>
    <ul class="sub_nav_01">
    <span class="Triangle_con"></span>
    <li><a href="#">XSL</a></li>
    <li><a href="#">XSLT</a></li>
    <li><a href="#">XSL-FO</a></li>
    <li><a href="#">XPath</a></li>
    <li><a href="#">XQuery</a></li>
    <li><a href="#">XLink</a></li>
    <li><a href="#">XPointer</a></li>
    <li><a href="#">DTD</a></li>
    <li><a href="#">Schema</a></li>
    <li><a href="#">XForms</a></li>
    </ul>
    </li>
        
    <li class="mainlevel"><a href="#">browsers<em></em>scripting</a>
    <ul class="sub_nav_01">
    <span class="Triangle_con"></span>
    <li><a href="#">JavaScript</a></li>
    <li><a href="#">DHTML</a></li>
    <li><a href="#">VBScript</a></li>
    <li><a href="#">AJAX</a></li>
    <li><a href="#">jQuery</a></li>
    <li><a href="#">E4X</a></li>
    <li><a href="#">WMLScript</a></li>
    </ul>
    </li>
    
    <li class="mainlevel"><a href="#">server<em></em>scripting</a>
    <ul class="sub_nav_01">
    <span class="Triangle_con"></span>
    <li><a href="#">SQL</a></li>
    <li><a href="#">ASP</a></li>
    <li><a href="#">ADO</a></li>
    <li><a href="#">PHP</a></li>
    </ul>
    </li>
    
    <li class="mainlevel"><a href="#">dot<em></em>net</a></li> 
       
    <li class="mainlevel"><a href="#">multimedia</a>
    <ul class="sub_nav_01">
    <span class="Triangle_con"></span>
    <li><a href="#">Media</a></li>
    <li><a href="#">SMIL</a></li>
    <li><a href="http://www.lanrentuku.com/" target="_blank">LEO</a></li>
    </ul>
    </li>
    -->
</ul>

<style type="text/css">
/*menu*/
/*#menu {margin:1px auto; display:block; width:1000px; height:34px;}*/
.Yocms_navigation_201 {padding:0px;display:block;font:12px/normal Verdana, Arial, Helvetica, sans-serif;width: 100%;height: 35px;}
.Yocms_navigation_201 .mainlevel {float:left; background:#3f240e; text-align:center; display:block;}
.Yocms_navigation_201 .mainlevel a {color:#fff; text-decoration:none; line-height:34px; height:34px; text-align:center; padding:0 20px; display:block; _width:48px;}
.Yocms_navigation_201 .mainlevel a:hover {color:#3f240e; text-decoration:none; background:#678900 url(__PUBLIC__/Navigation/Yocms_navigation_201/slide-pannel_14.png) 0 0 repeat-x;}
.Yocms_navigation_201 .mainlevel ul {position:absolute; display:none; *width:2000px;/*IE is great need, width>=li.length*/}
.Yocms_navigation_201 .mainlevel li {float:left; background:#3f240e;}
.Yocms_navigation_201 .mainlevel li a {padding:0 12px; line-height:24px; height:24px; display:block; _padding-bottom:6px;/*IE6 only*/}
.Yocms_navigation_201 .mainlevel li a:hover {color:#3f240e; text-decoration:none; background:#678900 url(__PUBLIC__/Widget/Navigation/Yocms_navigation_201/slide-pannel_14.png) 0 0 repeat-x;}
.Yocms_navigation_201 li a em/*input an em tag as a space*/ {padding:0 3px;}
.Yocms_navigation_201 .note {color:#3f240e; border-right:1px solid #fff; background:#678900 url(__PUBLIC__/Widget/Navigation/Yocms_navigation_201/slide-pannel_14.png) 0 0 repeat-x; display:block; line-height:34px; padding:0 3em;}
.Yocms_navigation_201 .Triangle_con {height:9px; background:url(__PUBLIC__/Widget/Navigation/Yocms_navigation_201/bird.png) 36px 0 no-repeat; display:block; _margin-bottom:-6px;/*IE6 only*/}
.Yocms_navigation_201 .log {margin:100px auto; width:1000px; text-transform:capitalize; line-height:200%;}
</style>
<script>
//menu
$(document).ready(function(){
  $('.Yocms_navigation_201 li.mainlevel').mousemove(function(){
  $(this).find('ul').slideDown("1000");//you can give it a speed
  });
  $('.Yocms_navigation_201 li.mainlevel').mouseleave(function(){
  $(this).find('ul').slideUp("fast");
  });
});
</script>