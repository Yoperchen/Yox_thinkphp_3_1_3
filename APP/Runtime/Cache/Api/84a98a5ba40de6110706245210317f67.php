<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js?v=1.7.2"></script>
<script type="text/javascript" src="__PUBLIC__/js/jquery.form.js"></script>
<script type="text/javascript">
	var JsonUti = {
            //定义换行符
            n: "\n",
            //定义制表符
            t: "\t",
            //转换String
            convertToString: function(obj) {
                return JsonUti.__writeObj(obj, 1);
            },
            //写对象
            __writeObj: function(obj    //对象
                    , level             //层次（基数为1）
                    , isInArray) {       //此对象是否在一个集合内
                //如果为空，直接输出null
                if (obj == null) {
                    return "null";
                }
                //为普通类型，直接输出值
                if (obj.constructor == Number || obj.constructor == Date || obj.constructor == String || obj.constructor == Boolean) {
                    var v = obj.toString();
                    var tab = isInArray ? JsonUti.__repeatStr(JsonUti.t, level - 1) : "";
                    if (obj.constructor == String || obj.constructor == Date) {
                        //时间格式化只是单纯输出字符串，而不是Date对象
                        return tab + ("\"" + v + "\"");
                    }
                    else if (obj.constructor == Boolean) {
                        return tab + v.toLowerCase();
                    }
                    else {
                        return tab + (v);
                    }
                }

                //写Json对象，缓存字符串
                var currentObjStrings = [];
                //遍历属性
                for (var name in obj) {
                    var temp = [];
                    //格式化Tab
                    var paddingTab = JsonUti.__repeatStr(JsonUti.t, level);
                    temp.push(paddingTab);
                    //写出属性名
                    temp.push(name + " : ");

                    var val = obj[name];
                    if (val == null) {
                        temp.push("null");
                    }
                    else {
                        var c = val.constructor;

                        if (c == Array) { //如果为集合，循环内部对象
                            temp.push(JsonUti.n + paddingTab + "[" + JsonUti.n);
                            var levelUp = level + 2;    //层级+2

                            var tempArrValue = [];      //集合元素相关字符串缓存片段
                            for (var i = 0; i < val.length; i++) {
                                //递归写对象                         
                                tempArrValue.push(JsonUti.__writeObj(val[i], levelUp, true));
                            }

                            temp.push(tempArrValue.join("," + JsonUti.n));
                            temp.push(JsonUti.n + paddingTab + "]");
                        }
                        else if (c == Function) {
                            temp.push("[Function]");
                        }
                        else {
                            //递归写对象
                            temp.push(JsonUti.__writeObj(val, level + 1));
                        }
                    }
                    //加入当前对象"属性"字符串
                    currentObjStrings.push(temp.join(""));
                }
                return (level > 1 && !isInArray ? JsonUti.n : "")                       //如果Json对象是内部，就要换行格式化
                    + JsonUti.__repeatStr(JsonUti.t, level - 1) + "{" + JsonUti.n     //加层次Tab格式化
                    + currentObjStrings.join("," + JsonUti.n)                       //串联所有属性值
                    + JsonUti.n + JsonUti.__repeatStr(JsonUti.t, level - 1) + "}";   //封闭对象
            },
            __isArray: function(obj) {
                if (obj) {
                    return obj.constructor == Array;
                }
                return false;
            },
            __repeatStr: function(str, times) {
                var newStr = [];
                if (times > 0) {
                    for (var i = 0; i < times; i++) {
                        newStr.push(str);
                    }
                }
                return newStr.join("");
            }
        };
		
$(document).ready(function(){
	var form_type='json';
	var form_obj = {
		beforeSubmit:  checkForm,  // pre-submit callback
		success:       complete,  // post-submit callback
		dataType: 'text'
	};
	
	$("#format_type").change(function(){		
		if($(this).val()!='json'){
			form_type='text';
		}else{
			form_type='json';
		}
	});
	
  $("#api_cate").change(function(){
	  var api_key = $(this).val();
  	$.post("<?php echo U('Api/Tool/get_apilist');?>",
  	{
   	 	'api_key':api_key,
  	},
  	function(data,status){
		var option_str = '<option value="0" selected="selected">请选择..</option>';
		$.each(data.data,function(index,content){
    		option_str+='<option value="'+index+'">'+index+' - '+content+'</option>';
  		});
  		$("#api").html(option_str);
		$("#paramform").html('');
  	},'json');
  });
  
  $("#api").change(function(){
	  var api_key = $(this).val();
  	$.post("<?php echo U('Api/Tool/get_form');?>",
  	{
   	 	'api_key':api_key,
  	},
  	function(data,status){
  		$("#paramform").html(data);
  	});
  });
  
  
	$('#apiform').ajaxForm(form_obj);
//	$('#apiform').ajaxForm(form_obj);
	function checkForm(){
		return true;
		//可以在此添加其它判断
	}
	function complete(data){
		//var json_value = JSON.stringify(data);
		//alert(json_value);
		//JsonUti.n = "<br />";
		if(form_type=='json'){
			data = JSON.parse(data);
			JsonUti.t = "   ";
			data = JsonUti.convertToString(data);
		}
		$('#resultbox').val(data);
	}
 
});
</script>
<title>接口调试工具</title>
</head>
<body style="margin: 0;">
<!--<span style="float:left;font-size:12px;">
	<a style="font-size:12px;" target="_blank" href="#">申请成为第三方开发者</a>
	<a style="font-size:12px;" target="_blank" href="#">成为开发者有什么好处</a>
</span>
<span style="float:left;font-size:12px;">&nbsp;|&nbsp;我的社区、圈子、社交、我的家、健康饮食、家用菜谱、附近的人在吃啥、附近的商家、订餐、买卖、文化、分享、娱乐、视频、团购、支付、科技、讨论、公告、休闲、乐趣、优惠、附近的便利店、对比附近的商店价格、附近的酒店、新生活</span>
-->
<table width="960" border="0" align="center" cellpadding="2" style="font-family:'微软雅黑', '幼圆'; font-size:13px;">
  <tr>
    <td colspan="2">
	<h2 align="center">第三方合作伙伴(应用)接口调试工具</h2>
	</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="510">&nbsp;</td>
    <td>返回结果：</td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <form name="apiform" id="apiform" method="post" enctype="multipart/form-data"  action="<?php echo U('Api/Page/index');?>">
    <div>
    <table width="500" border="0" cellpadding="2">
	<tr>
    <td width="100" align="right">语言：</td>
    <td>    
    <select name="language" id="language">
    <option value="Chinese" selected="selected">中文</option>
    <option value="English">English</option>
    </select>
    </td>
  </tr>
  <tr>
    <td width="100" align="right">返回格式：</td>
    <td>    
    <select name="format_type" id="format_type">
    <option value="json" selected="selected">json</option>
    <option value="xml">xml</option>
    </select>
    </td>
  </tr>
  <tr>
    <td align="right">Api类目：</td>
    <td>
    <select name="api_cate" id="api_cate">
    <option value="0" selected="selected">请选择..</option>
    <option value="user">用户</option>
	 <option value="store">商家</option>
	<option value="goods">商品</option>
	<option value="friend">好友/成员/消息/约会/群/群消息</option>
	<option value="payment">支付</option>
	<option value="article">文章</option>
	<option value="course">课程表</option>
	<option value="cuisine">烹饪</option>
	<option value="share">分享/收藏</option>
	<option value="tag">标签/广告</option>
	<option value="toll">用户收费缴费</option>
	<option value="rental">租车/拼车/租飞机/租房/租模特/租女友/租场地</option>
	<option value="address">地址</option>
	<!--<option value="group">圈子</option>-->
    <!--<option value="ent">娱乐</option>-->
    <!--<option value="event">活动</option>-->
    <!--<option value="friend">玩友</option>-->
    <!--<option value="active">动态</option>-->
    <!--<option value="search">搜索</option>-->
    <!--<option value="cms">CMS</option>-->
    <!--<option value="weibo">微博</option>-->
    <option value="push">推送</option>
	<!--<option value="alipay">支付宝</option>-->
	<!--<option value="star">明星</option>-->
	<!--<option value="task">任务</option>-->
	<!--<option value="statistics">统计</option>-->
	<!--<option value="cinema">影院</option>-->
	<option value="activity">活动</option>
	<option value="file">文件图片上传</option>
	<!--<option value="membership_card">会员卡</option>-->
	<option value="api_partner">第三方</option>
	<option value="analog_applications">模拟应用</option>
    </select>
    </td>
  </tr>
  <tr>
    <td align="right">Api：</td>
    <td>
    <select name="ma" id="api">
    <option value="0" selected="selected">请选择类目..</option>
    </select>
    </td>
  </tr>
  <tr>
    <td align="right">partner：</td>
    <td><input type="text" name="partner" id="partner" value="16080000008" /></td>
  </tr>
  <tr>
    <td align="right">partner_secret：</td>
    <td><input type="text" name="partner_secret" id="partner_secret" value="OTczNkQwcmxYZnNlOURvV0lSN0x4YkMvaC90V3FVdUVtSm1ENytneVpFWGlIaHpwVEhzNkJGZUJZMEYzZ1c0
" style="width:300px;" /></td>
  </tr>
  <tr>
    <td align="right">loginCode：</td>
    <td><input type="text" name="loginCode" id="loginCode" value="" style="width:300px;" /></td>
  </tr>
  <tr>
    <td align="right">sc：</td>
    <td><input type="text" name="sc" id="sc" value="" /> 版本号</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
</table>
</div>
<div id="paramform"></div>
<div style="text-align:center; margin-top:20px;"><input type="submit" name="submit" value="提 交" style="width:80px; height:30px; font-family:'微软雅黑', '幼圆'; font-size:14px; cursor:pointer;" /></div>
</form>
</td>
    <td><textarea name="resultbox" id="resultbox" rows="30" cols="55" style="width:450px; height:450px;"></textarea>
    <div id="result_box"></div>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<!--百度统计开始-->
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Ff61177041904ff8fbc5543333dd5a851' type='text/javascript'%3E%3C/script%3E"));
</script>
<!--百度统计结束-->
<br/><br/><br/><br/><br/><br/><br/><br/><br/>
免费获取合作伙伴帐号请联系 944975166@qq.com
<br>
<a title="零零糖购物网站首页" href="http://www.linglingtang.com">零零糖</a>
<a title="礼物" href="http://linglingtang.uz.taobao.com">礼物</a>
</body>
</html>