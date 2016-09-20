<?php
// +----------------------------------------------------------------------
// | Yocms [ WE CAN DO IT JUST THINK IT TOO ]
// +----------------------------------------------------------------------
// | Copyright (c) 2010-2016 http://linglingtang.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Yoper <944975166@qq.com>
// +----------------------------------------------------------------------

defined('THINK_PATH') or exit();
/**
 * Yocms行为扩展：检查主题颜色
 * @category   Yocms
 * @package  Think
 * @subpackage  Behavior
 * @author   Yoper <944975166@qq.com>
 */
class SetThemeColorBehavior extends Behavior {
    protected $options   =  array(
            'YOCMS_SET_THEME_COLOR_ON'     =>  true,
            'YOCMS_DEFAULT_THEME_COLOR'          => 'pink',//pink|dark|white
        );

    // 行为扩展的执行入口必须是run
    public function run(&$params){
        // 开启静态缓存
        if(C('YOCMS_SET_THEME_COLOR_ON'))  {
	    if(I('theme_color'))
 	    {
	    $theme_color=I('theme_color');
            $this->setThemeColor($theme_color);
	    }
	    if(!cookie('theme_color')){
	    $this->setThemeColor(C('YOCMS_DEFAULT_THEME_COLOR'));
	    }
        }
    }

    // 判断是否设置主题颜色
    static private function setThemeColor($theme_color) {
        cookie('theme_color',$theme_color,array('expire'=>3600*24*365));
    }

}