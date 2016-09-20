<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<title>[!--pagetitle--] - [!--class.name--] - <?=$public_r[sitename]?></title>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/plugins/ueditor1_4_3/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="__PUBLIC__/plugins/ueditor1_4_3/editor_api.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js"></script>
    <style>
        table{margin-bottom:10px;border-collapse:collapse;display:table;border:1px dashed #ddd}
        #test td{padding:5px;border: 1px solid #DDD;}
    </style>


</head>


<body>
<h1>添加文章</h1>
<form action="<?php echo U('Yo81009/Admin/add_article');?>" method="post">
<table id="test">
	<tr>
	<td>标题：</td>
	<td><input type="text" name="title"></td>
	<td>分类：</td>
	<td><select name="category_id">
	<?php if(is_array($article_category_result["data"]["list"])): foreach($article_category_result["data"]["list"] as $key=>$vo): ?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['name']); ?></option><?php endforeach; endif; ?>
		<!--<option value="2">零食|薯片|巧克力</option>
		<option value="3">科技</option>
		<option value="4">男装裤子</option>
		<option value="5">说说母婴用品</option>-->
	</select></td>
	<td style="font-size:12px;">类型:</td>
	<td><select name="type">
		<option value="1">公告</option>
		<option value="2">普通文章</option>
		<option value="3">论坛贴</option>
		<option value="4">日志</option>
		<option value="5">说说</option>
	</select></td>
	<td>排序：</td>
	<td><input style="width:50px; " type="number" value="50" name="sort"></td>
	</tr>
    <tr>
        <td width="10%">
            描述
        </td>
        <td class="content" id="desc" colspan="7">
		<script id="editor1" type="text/plain" style="width:1024px;height:200px;">编辑 描述</script></td>
    </tr>
    <tr>
        <td>
            正文
        </td>
        <td class="content" id="content" colspan="7">编辑 正文</td>
    </tr>
 
</table>
<input type="submit" value="添加">
</form>

<script type="text/javascript">
    var ue = UE.getEditor('editor1');
    ue.ready(function(){
        //阻止工具栏的点击向上冒泡
        $(this.container).click(function(e){
            e.stopPropagation()
        })
    });
    $('.content').click(function(e){
        var $target = $(this);
        var content = $target.html();
        var currentParnet = ue.container.parentNode.parentNode;
        var currentContent = ue.getContent();
        $target.html('');
        $target.append(ue.container.parentNode);
        ue.reset();
        setTimeout(function(){
            ue.setContent(content);
        },200)
        $(currentParnet).html(currentContent);
    })
</script>

</body>
</html>