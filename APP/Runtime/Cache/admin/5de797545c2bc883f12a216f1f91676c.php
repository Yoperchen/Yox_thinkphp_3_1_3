<?php if (!defined('THINK_PATH')) exit();?><select name="store_id" class="chosen-select">
<option value="">请选择..</option>
<?php if(is_array($stores_list)): $i = 0; $__LIST__ = $stores_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$store): $mod = ($i % 2 );++$i;?><option <?php if(($store["id"]) == $select_id): ?>selected<?php endif; ?> value="<?php echo ($store['id']); ?>"><?php echo ($store['id']); ?>|<?php echo ($store['store_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
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