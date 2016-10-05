<?php
namespace Org\Util;
class Wx
{
    public $appid='wx120309fa40fc6024';//测试:wxf119cce73a3e0aab
    public $appsecret='5317ff7bfe2323621787d386f571d8b8';//测试:0b9c42d16927ec7bdbdd16a73b4908d0
	/**
	 * 绑定url、token信息
	 */
	public function valid()
	{
        $echoStr = $_GET["echostr"];
        if ($this->checkSignature()) {
 			echo $echoStr;
        }
 		exit();
    }
    /**
     * 检查签名，确保请求是从微信发过来的
     */
	private function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
		$token = "test123";//与在微信配置的token一致，不可泄露
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}

    /**
     * 接收消息，并自动发送响应信息
     */
    public function responseMsg(){
    	
    	//验证签名
    	if ($this->checkSignature()){
	    	$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
			$this->log_request_info();
	
	      	//提取post数据
			if (!empty($postStr)){
	              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
	                $fromUsername = $postObj->FromUserName;//发送人
	                $toUsername = $postObj->ToUserName;//接收人
	                $MsgType = $postObj->MsgType;//消息类型
	                $MsgId = $postObj->MsgId;//消息id
	                $time = time();//当前时间做为回复时间
	                
	                //如果是文本消息（表情属于文本信息）
	                if($MsgType == 'text'){
		                $content = trim($postObj->Content);//消息内容
						if(!empty( $content )){
							
							//如果文本内容是图文，则回复图文信息，否则回复文本信息
		                	if($content == "图文"){
			                	
			                	//回复图文消息,ArticleCount图文消息个数,多条图文消息信息，默认第一个item为大图
			                	$ArticleCount = 2; 
			                	$newsTpl = "<xml>
								<ToUserName><![CDATA[%s]]></ToUserName>
								<FromUserName><![CDATA[%s]]></FromUserName>
								<CreateTime>%s</CreateTime>
								<MsgType><![CDATA[%s]]></MsgType>
								<ArticleCount>%s</ArticleCount>
								<Articles>
								<item>
								<Title><![CDATA[%s]]></Title> 
								<Description><![CDATA[%s]]></Description>
								<PicUrl><![CDATA[%s]]></PicUrl>
								<Url><![CDATA[%s]]></Url>
								</item>
								<item>
								<Title><![CDATA[%s]]></Title>
								<Description><![CDATA[%s]]></Description>
								<PicUrl><![CDATA[%s]]></PicUrl>
								<Url><![CDATA[%s]]></Url>
								</item>
								</Articles>
								</xml>";
			                	$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, 'news', 
			                				$ArticleCount,'我是图文信息','我是描述信息','http://www.test.com/DocCenterService/image?photo_id=236',
			                				'http://www.test.com','爱城市网正式开通上线','描述2','http://jn.test.com/ac/skins/img/upload/img/20131116/48171384568991509.png',
			                				'http://www.test.com');
				                echo $resultStr;
			                 	$this->log($resultStr);
		                	}else{
		                		//回复文本信息
				                $textTpl = "<xml>
											<ToUserName><![CDATA[%s]]></ToUserName>
											<FromUserName><![CDATA[%s]]></FromUserName>
											<CreateTime>%s</CreateTime>
											<MsgType><![CDATA[%s]]></MsgType>
											<Content><![CDATA[%s]]></Content>
											<FuncFlag>0</FuncFlag>
											</xml>";             
			                	$contentStr = '你发送的信息是：接收人：'.$toUsername.',发送人:'.$fromUsername.',消息类型：'.$MsgType.',消息内容：'.$content.' www.xx.com';
			                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, 'text', $contentStr);
			                	echo $resultStr;
			                	$this->log($resultStr);
		                	}
		                }else{
		                	echo "Input something...";
		                	$this->log($resultStr);
		                }
	                	
		              //如果是图片消息
	                }elseif ($MsgType == 'image'){
			            $MediaId = $postObj->MediaId;//图片消息媒体id，可以调用多媒体文件下载接口拉取数据。
			            $imageTpl = "<xml>
									<ToUserName><![CDATA[%s]]></ToUserName>
									<FromUserName><![CDATA[%s]]></FromUserName>
									<CreateTime>%s</CreateTime>
									<MsgType><![CDATA[%s]]></MsgType>
									<Image>
									<MediaId><![CDATA[%s]]></MediaId>
									</Image>
									</xml>";
	                	$resultStr = sprintf($imageTpl, $fromUsername, $toUsername, $time, $MsgType, $MediaId);
	                	echo $resultStr;
			            $this->log("自动响应图片信息");
	                	$this->log($resultStr);
	                	
	                //如果是视频
	                }else if($MsgType == 'video'){
	                	$MediaId = $postObj->MediaId;//视频消息媒体id，可以调用多媒体文件下载接口拉取数据。
	                	$ThumbMediaId = $postObj->ThumbMediaId;//视频消息缩略图的媒体id，可以调用多媒体文件下载接口拉取数据。 
						$videoTpl = "<xml>
									<ToUserName><![CDATA[%s]]></ToUserName>
									<FromUserName><![CDATA[%s]]></FromUserName>
									<CreateTime>%s</CreateTime>
									<MsgType><![CDATA[%s]]></MsgType>
									<Video>
									<MediaId><![CDATA[%s]]></MediaId>
									<ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
									<Title><![CDATA[%s]]></Title>
									<Description><![CDATA[%s]]></Description>
									</Video> 
									</xml>";
						$resultStr = sprintf($videoTpl, $fromUsername, $toUsername, $time, $MsgType, $MediaId,$ThumbMediaId,'我是标题','我是描述');
	                	echo $resultStr;
			            $this->log("自动响应视频信息".$ThumbMediaId);
	                	$this->log($resultStr);
	                	
	                //如果是地理位置
	                }else if($MsgType == 'location'){
	                	$Location_X = $postObj->Location_X;//维度
	                	$Location_Y = $postObj->Location_Y;//经度
	                	$Scale = $postObj->Scale;//地图缩放大小
	                	$Label = $postObj->Label;//地里位置信息
	                	
	                	//回复文本信息
		                $textTpl = "<xml>
									<ToUserName><![CDATA[%s]]></ToUserName>
									<FromUserName><![CDATA[%s]]></FromUserName>
									<CreateTime>%s</CreateTime>
									<MsgType><![CDATA[%s]]></MsgType>
									<Content><![CDATA[%s]]></Content>
									<FuncFlag>0</FuncFlag>
									</xml>";             
	              		$msgType = "text";
	                	$contentStr = '经度：'.$Location_Y.'，维度：'.$Location_X.'，地图缩放大小'.$Scale.'，地理位置信息：'.$Label;
	                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
	                	echo $resultStr;
	                	$this->log($resultStr);
	                	
	                //如果是事件
	                }else if($MsgType == 'event'){
	                	
	                	$Event = $postObj->Event;
	                	
	                	//subscribe(关注，也叫订阅)
	                	if($Event == 'subscribe'){
	                		
	                		$EventKey = $postObj->EventKey;//事件KEY值，qrscene_为前缀，后面为二维码的参数值
	                		
	                		//未关注时，扫描二维码
	                		if(!empty($EventKey)){
	                			$Ticket = $postObj->Ticket;//二维码的ticket，可用来换取二维码图片
		                		$this->log($fromUsername.'扫描二维码关注！EventKey='.$EventKey.',Ticket='.$Ticket);
	                		}else{
	                			$this->log($fromUsername.'关注我了！');
	                		}
	                		
	                	//unsubscribe(取消关注)
	                	}elseif ($Event == 'unsubscribe'){
	                		$this->log($fromUsername.'取消关注我了！');
	                		
	                	//已关注时，扫描二维码事件
	                	}elseif($Event == 'SCAN' || $Event == 'scan'){
	                		$EventKey = $postObj->EventKey;//事件KEY值，是一个32位无符号整数，即创建二维码时的二维码scene_id
                			$Ticket = $postObj->Ticket;//二维码的ticket，可用来换取二维码图片
	                		$this->log($fromUsername.'关注我了！EventKey='.$EventKey.',Ticket='.$Ticket);
	                	
	                	//菜单点击事件
	                	}elseif($Event == 'CLICK'){
	                		$EventKey = $postObj->EventKey;//事件KEY值，与自定义菜单接口中KEY值对应
	                		//回复文本信息
			                $textTpl = "<xml>
										<ToUserName><![CDATA[%s]]></ToUserName>
										<FromUserName><![CDATA[%s]]></FromUserName>
										<CreateTime>%s</CreateTime>
										<MsgType><![CDATA[%s]]></MsgType>
										<Content><![CDATA[%s]]></Content>
										<FuncFlag>0</FuncFlag>
										</xml>";             
		                	$contentStr = '你点击了菜单，菜单项key='.$EventKey;
		                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, 'text', $contentStr);
		                	echo $resultStr;
		                	$this->log($resultStr);

		                //其他事件类型
	                	}else{
	                		$this->log('事件类型：'.$Event);
	                	}
	                	
	                //其他消息类型，链接、语音等
	                }else{
	                	//回复文本信息
		                $textTpl = "<xml>
									<ToUserName><![CDATA[%s]]></ToUserName>
									<FromUserName><![CDATA[%s]]></FromUserName>
									<CreateTime>%s</CreateTime>
									<MsgType><![CDATA[%s]]></MsgType>
									<Content><![CDATA[%s]]></Content>
									<FuncFlag>0</FuncFlag>
									</xml>";             
	                	$contentStr = '消息类型：'.$MsgType.'我们还没做处理。。。。【】';
	                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, 'text', $contentStr);
	                	echo $resultStr;
	                	$this->log($resultStr);
	                }
	
	        }else {
	        	echo "";
	        	exit;
	        }
    	}else{
			    $this->log("验证签名未通过！");		
    	}
    }
    /**
     * 根据code获取token
     * @return mixed
     */
    public function get_token()
    {
        $this->log_request_info();
        $code = $_GET['code'];
        if (isset($code)){
            $appid = $this->appid;
            $appsecret = $this->appsecret;
//             $redirect_url="http://wxpay.dev.ipiao.com/wx_get_oauth.php";
            //微信中请求此url回跳回来获取code
//          $url ="https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=http://wxpay.dev.ipiao.com/wx_get_oauth.php&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect";
            $oauth_token="https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
            $out=file_get_contents($oauth_token);
            $token=json_decode($out,true);
            return $token;
//             $access_token=$token['access_token'];
//             $openid=$token['openid'];
//             $userinfo_url= "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";
//             $userinfo=file_get_contents($userinfo_url);
//             $userinfo=json_decode($userinfo,true);
//             return $userinfo;
//             var_dump($openid);
//             var_dump($userinfo);
        }
        else{
            return false;
//             echo"empty oauth  fail";exit;
        }
    }
    /**
     * 根据$token获取用户头像性别等信息
     * $this->get_token方法获取
     * @param array $token
     * @return mixed
     */
    public function get_user_info($token)
    {
        $userinfo_url= "https://api.weixin.qq.com/sns/userinfo?access_token=".$token['access_token']."&openid=".$token['openid']."&lang=zh_CN";
        $userinfo=file_get_contents($userinfo_url);
        $userinfo=json_decode($userinfo,true);
        return $userinfo;
    }
    /**
     * 记录请求信息
     */
    function log_request_info() {
    	$post = '';
    	foreach($_POST   as   $key   =>   $value)   { 
			$post = $post.$key.' : '.$value.' , '; 
		} 
		$get = '';
    	foreach($_GET   as   $key   =>   $value)   { 
			$get = $get.$key.' : '.$value.' , '; 
		} 
		$this->log("get信息：".$get);
		$this->log("post信息：".$post);
    }
    /**
     * 记录日志
     * @param $str
     * @param $mode
     */
    function log($str){
    	$mode='a';//追加方式写
    	$file = "log.txt";
	    $oldmask = @umask(0);
	    $fp = @fopen($file,$mode);
	    @flock($fp, 3);
	    if(!$fp)
	    {
	        Return false;
	    }
	    else
	    {
	        @fwrite($fp,$str);
	        @fclose($fp);
	        @umask($oldmask);
	        Return true;
	    }
	} 
	public function test(){
		echo 'test';
	}
}