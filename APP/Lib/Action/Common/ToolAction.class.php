<?php
/**
 * 工具
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class ToolAction extends Action {
    public function index(){
		$this->display();
    }
    public function nvxinganquanqizice()
    {
        Yocms_is_mobile()?$this->assign('template','Nvxinganquanqizice_wap'):$this->assign('template','Nvxinganquanqizice');
        $this->display();
    }
    /**
     * 元素周期表
     */
    public function yuansuzhouqibiao()
    {
        Yocms_is_mobile()?$this->assign('template','Yuansuzhouqibiao'):$this->assign('template','Yuansuzhouqibiao');
        $this->display();
    }

}