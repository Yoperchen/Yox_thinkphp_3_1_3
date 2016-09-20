<?php if (!defined('THINK_PATH')) exit();?><script src="__PUBLIC__/js/jquery.min.js" type="text/javascript"></script>
    <div class="Yocms_navigation_200">
        <div class="navmain">
            <ul id="nav_all">
                <?php if(is_array($list)): foreach($list as $key=>$navigation): ?><li><a href="<?php echo ($navigation['url']); ?>"><?php echo ($navigation['name']); ?></a>
                    <ul style="display: none;">
                    <?php if($navigation['children']): if(is_array($navigation["children"])): foreach($navigation["children"] as $key=>$children1): ?><li><a title="<?php echo (($children1['description'])?($children1['description']):$children1['name']); ?>" href="<?php echo ($children1['url']); ?>"><?php echo ($children1['name']); ?></a></li><?php endforeach; endif; ?>
                       <?php else: ?>
                       <li><a><?php echo ($navigation['description']); ?></a></li><?php endif; ?>
                    </ul>
                  </li><?php endforeach; endif; ?>
            </ul>
        </div>
    </div>
<style type="text/css">
.Yocms_navigation_200 div, ul, li { margin: 0; padding: 0; border: 0; }
.Yocms_navigation_200 ul, li { list-style-type: none; text-transform: capitalize; }
.Yocms_navigation_200 { font-size: 12px; width: 100%; margin: 10px auto 0; border: #E6E6E6 solid 1px; border-bottom: #639ACA solid 1px; height: 42px; line-height: 42px; position: relative; z-index: 1; }
.Yocms_navigation_200 a { text-decoration: none; }
.Yocms_navigation_200 .navmain { height: 42px; padding: 0 5px; background: #FFF url(__PUBLIC__/Widget/Navigation/Yocms_navigation_200/nav-bg.png) repeat-x 0 top; position: relative; }
.Yocms_navigation_200 #nav_all { height: 42px; float: left; line-height: 42px; position: relative; z-index: 222; }
.Yocms_navigation_200 #nav_all li { text-align: center; float: left; }
.Yocms_navigation_200 #nav_all li a { color: #639ACA; display: inline-block; font-size: 14px; font-weight: bold; cursor: pointer; padding: 0 11px 0 12px; _padding: 0 8px; height: 42px; line-height: 42px; white-space: nowrap; }
.Yocms_navigation_200 #nav_all li a:hover { background: url(__PUBLIC__/Widget/Navigation/Yocms_navigation_200/bird.png) center 33px no-repeat; height: 38px; line-height: 38px; border-top: 4px solid #639ACA; overflow: hidden; }
.Yocms_navigation_200 #nav_all li ul { display: none; position: absolute; z-index: 99; width: 980px; left: -6px; top: 43px; }
.Yocms_navigation_200 #nav_all ul li { background-image: none; line-height: 32px; height: 32px; padding-top: 0px; padding: 0; }
.Yocms_navigation_200 #nav_all ul li a { background-image: none; padding: 0px 10px; margin: 0px; height: 32px; line-height: 32px; color: #fff; font-weight: normal; background: #639ACA; border: none; }
.Yocms_navigation_200 #nav_all ul li a:hover { background-image: none; padding: 0px 10px; margin: 0px auto; height: 32px; line-height: 32px; color: #FFF; background: #639ACA; border-top: none; }
</style>
<script>
$(function () {
    var st = 180;
    $('.Yocms_navigation_200 #nav_all>li').mouseenter(function () {
		$(this).find('ul').css('margin-left',$(this).position().left+'px');
        $(this).find('ul').stop(false, true).slideDown(st);
    }).mouseleave(function () {
        $(this).find('ul').stop(false, true).slideUp(st);
    });
});
</script>