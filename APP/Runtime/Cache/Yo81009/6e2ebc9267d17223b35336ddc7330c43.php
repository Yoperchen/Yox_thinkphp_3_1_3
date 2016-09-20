<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<title>[!--pagetitle--] - [!--class.name--] - <?=$public_r[sitename]?></title>
<meta name="description" content="[!--pagedes--]" />
<meta name="keywords" content="[!--pagekey--]" />


</head>


<body>
<input type="text" name="id" value="<?php echo ($result['data']['id']); ?>"><br/>
<input type="text" name="title" value="<?php echo ($result['data']['title']); ?>"><br/>
<input type="text" name="author" value="<?php echo ($result['data']['author']); ?>"><br/>
<textarera name="content"><?php echo ($result['data']['content']); ?><textarea><br/>
</body>
</html>