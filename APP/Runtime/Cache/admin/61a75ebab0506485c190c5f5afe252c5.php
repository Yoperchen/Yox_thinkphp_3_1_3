<?php if (!defined('THINK_PATH')) exit();?><!-- 站点列表 -->
<select name="site_id" class="chosen-select">
<option value="">请选择..</option>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$site): $mod = ($i % 2 );++$i;?><option value="<?php echo ($site['id']); ?>" <?php if(($site["id"]) == $select_id): ?>selected<?php endif; ?>><?php echo ($site['id']); ?>|<?php echo ($site['site_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
</select>
<link rel="stylesheet" href="__PUBLIC__/plugins/chosen_1_4_2/chosen.css">
<script src="__PUBLIC__/plugins/chosen_1_4_2/chosen.jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>