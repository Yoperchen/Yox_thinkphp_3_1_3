<?php
class ApibaseAction extends Action{

	/**
	 * 返回数据格式: xml
	 */
	const RETURN_DATA_FORMAT_XML = 'xml';

	/**
	 * 返回数据格式: json
	 */
	const RETURN_DATA_FORMAT_JSON = 'json';

	/**
	 * 返回状态码: 成功
	 */
	const STATUS_CODE_OK = 1;

	/**
	 * 返回状态码: 参数错误
	 */
	const STATUS_CODE_INVALID_PARAM = 2;

	/**
	 * 返回状态码: 操作出错
	 */
	const STATUS_CODE_OPERATE_FAILURE = 3;

	/**
	 * 返回状态码: 无合法数据
	 */
	const STATUS_CODE_OPERATE_NO_DATA = 4;

	/**
	 * json 解码的最大层数
	 */
	const JSON_DECODE_MAX_DEPTH = 10;

	/**
	 * @var array 返回信息
	 * @access protected
	 */
	protected static $_status_info = array(
			self::STATUS_CODE_OK => 'Success',
			self::STATUS_CODE_INVALID_PARAM => 'Invalid param',
			self::STATUS_CODE_OPERATE_FAILURE => 'Operate error',
			self::STATUS_CODE_OPERATE_NO_DATA => 'No data'
	);

	public $api_array = array(
	    'user'=>array(
	        1000=>array(
	            'api'=>'Api/User/send_verify_to_email','title'=>'send_verify_to_email发送邮箱验证码','description'=>'send_verify_to_email(邮箱注册前发送邮箱验证码)',
	            'parameters'=>array(
	                array('name'=>'email','required'=>1,'description'=>'邮箱'),
	                array('name'=>'verify_type','options'=>array('verify_register_code'=>'注册','verify_forgot_password_code'=>'忘记密码'),'required'=>1,'description'=>'邮箱'),
	            ),
	        ),
	        1001=>array(
	            'api'=>'Api/User/login','title'=>'login(用户登陆)','description'=>'通过ID、邮箱、手机号登录',
	            'parameters'=>array(
	                array('name'=>'id','required'=>1,'description'=>'用户ID/邮箱'),
	                array('name'=>'password','required'=>1,'description'=>'密码'),
	            ),
	        ),
	        1002=>array(
	            'api'=>'Api/User/send_verify_to_mobile','title'=>'send_verify_to_mobile发送短信验证码','description'=>'send_verify_to_mobile(手机注册前发送短信验证码)',
	            'parameters'=>array(
	                array('name'=>'mobile','required'=>1,'description'=>'手机号'),
	                array('name'=>'verify_type','options'=>array('verify_register_code'=>'注册','verify_forgot_password_code'=>'忘记密码'),'required'=>1,'description'=>'手机号'),
	            ),
	            	
	        ),//更新用户基本信息
	        1003=>array(
	            'api'=>'Api/User/register','title'=>'register用户注册','description'=>'register(用户注册)',
	            'parameters'=>array(
	                array('name'=>'mobile','required'=>0,'description'=>'手机'),
	                array('name'=>'email','required'=>0,'description'=>'邮箱'),
	                array('name'=>'password','required'=>1,'description'=>'密码'),
	                array('name'=>'community_id','required'=>0,'description'=>'学校id|社区id'),
	            ),
	        ),				//用户注册
	        1004=>array(
	            'api'=>'Api/User/reset_password','title'=>'reset_password密码重置','description'=>'reset_password(密码重置)',
	            'parameters'=>array(
	                array('name'=>'mobile','required'=>0,'description'=>'手机'),
	                array('name'=>'user_id','required'=>0,'description'=>'用户id'),
	                array('name'=>'email','required'=>0,'description'=>'邮箱'),
	                array('name'=>'new_password','required'=>1,'description'=>'新密码'),
	                array('name'=>'old_password','required'=>0,'description'=>'旧密码'),
	                array('name'=>'is_forced','required'=>0,'description'=>'是否强制更新，1：强制更新(免旧密码)，0：非强制(需要旧密码)'),
	            ),
	        ),				//密码重置
	        1005=>array(
	            'api'=>'Api/User/check_mobile_exist','title'=>'check_mobile_exist检查手机是否存在','description'=>'check_mobile_exist(检查手机是否被注册)',
	            'parameters'=>array(
	                array('name'=>'mobile','required'=>1,'description'=>'手机'),
	            ),
	        ),		//检查手机是否存在
	        1006=>array(
	            'api'=>'Api/User/check_email_exist','title'=>'check_email_exist检查邮箱是否存在','description'=>'check_email_exist(检查邮箱是否注册过)',
	            'parameters'=>array(
	                array('name'=>'email','required'=>1,'description'=>'邮箱'),
	            ),
	        ),		//检查邮箱是否注册过
	        1007=>array(
	            'api'=>'Api/User/verify_code','title'=>'verify_code确认验证码','description'=>'verify_code(确认验证码)',
	            'parameters'=>array(
	                array('name'=>'verify_type','options'=>array('verify_register_code'=>'注册','verify_forgot_password_code'=>'忘记密码'),'required'=>1,'description'=>'验证类型'),
	                array('name'=>'Verify_code','required'=>1,'description'=>'验证码'),
	                array('name'=>'mobile','required'=>0,'description'=>'手机号'),
	                array('name'=>'email','required'=>0,'description'=>'邮箱'),
	                array('name'=>'user_id','required'=>0,'description'=>'用户id'),
	            ),
	        ),			//确认验证码
	        1008=>array(
	            'api'=>'Api/User/update_user_info_by_user_id','title'=>'update_user_info修改会员信息','description'=>'update_user_info_by_user_id(修改会员信息)',
	            'parameters'=>array(
	                array('name'=>'user_id','required'=>0,'description'=>'用户id'),
	                array('name'=>'mobile','required'=>0,'description'=>'手机号'),
	                array('name'=>'email','required'=>0,'description'=>'邮箱'),
	                array('name'=>'name','required'=>0,'description'=>'名字'),
	                array('name'=>'nick_name','required'=>0,'description'=>'昵称'),
	                array('name'=>'sex','options'=>array('1'=>'男','2'=>'女','3'=>'人妖','4'=>'物理男性爱男','5'=>'物理女性爱女','6'=>'物理双性爱男','7'=>'物理双性爱女','9'=>'保密'),'required'=>0,'description'=>'性别|男：1，女：2，保密：9'),
	                array('name'=>'birthday','required'=>0,'description'=>'生日，（如1990-01-01）'),
	                array('name'=>'lng','required'=>0,'description'=>'经度'),
	                array('name'=>'lat','required'=>0,'description'=>'纬度'),
	                array('name'=>'avatar','file'=>1,'required'=>0,'description'=>'头像(会被截图200*200，所以最好上传200*200,3M内)'),
	                array('name'=>'district_id','required'=>0,'description'=>'地区id'),
	                array('name'=>'community_id','required'=>0,'description'=>'社区id'),
	                array('name'=>'city_id','required'=>0,'description'=>'城市id'),
	            ),
	        ),
	        1009=>array(
	            'api'=>'Api/User/my_promotion','title'=>'my_promotion我的推广','description'=>'my_promotion(推广)',
	            'parameters'=>array(
	                array('name'=>'user_id','required'=>0,'description'=>'用户id'),
	                array('name'=>'op','options'=>array('get_promotion_url'=>'get_promotion_url(推广 url，加积分)','1'=>'暂无','2'=>'暂无'),'required'=>0,'description'=>'操作'),
	            ),
	        ),						//收信箱
	        1010=>array(
	            'api'=>'Api/User/get_user_info','title'=>'get_user_info获取用户信息','description'=>'get_user_info(获取用户信息)',
	            'parameters'=>array(
	                array('name'=>'user_id','required'=>0,'description'=>'用户user_id'),
	                array('name'=>'"mobile"','required'=>0,'description'=>'mobile'),
	                array('name'=>'email','required'=>0,'description'=>'email'),
	                array('name'=>'isdetail','options'=>array(0=>'0','1'=>'1'),'required'=>1,'description'=>'是否详细'),
	            ),
	        ),
	        1011=>array(
	            'api'=>'Api/User/get_user_list','title'=>'get_user_list获取用户列表、附近的人','description'=>'get_user_list(获取用户列表、附近的人)',
	            'parameters'=>array(
	                array('name'=>'api_partner_id','required'=>0,'description'=>'api_partner_id(合作伙伴ID)'),
	                array('name'=>'birthday','required'=>0,'description'=>'生日，时间戳'),
	                array('name'=>'lng','required'=>0,'description'=>'lng经度'),
    	            array('name'=>'lat','required'=>0,'description'=>'lat纬度'),
	                array('name'=>'sex','options'=>array('1'=>'男','2'=>'女','3'=>'人妖','4'=>'物理男性爱男','5'=>'物理女性爱女','6'=>'物理双性爱男','7'=>'物理双性爱女','9'=>'保密'),'required'=>0,'description'=>'性别|男：1，女：2，保密：9'),
    	            array('name'=>'community_id','required'=>0,'description'=>'community_id'),
    	            array('name'=>'city_id','required'=>0,'description'=>'城市id'),
    	            array('name'=>'district_id','required'=>0,'description'=>'district_id区id'),
    	            array('name'=>'is_mobile_verify','required'=>0,'description'=>'is_mobile_verify是否手机验证|0，1'),
    	            array('name'=>'is_email_verify','required'=>0,'description'=>'is_email_verify是否邮箱验证|0，1'),
    	            array('name'=>'up_user_id','required'=>0,'description'=>'上级用户'),
	            ),
	        ),			//获取用户列表、附近的人
	        // 					1017=>'getBasicInfoUser(2.5	获取用户资料)',				//获取用户基本信息
	            // 					1018=>'getUserActive(4.11	获取用户动态)',			//用户动态
	            // 					1019=>'getFriendsActive(4.12	好友动态)',		//好友动态
	            // 					1020=>'messageBox(2.9	消息通知盒子)',			//消息提醒
	            // 					1021=>'messageHome(1.2	交流主页) ',				//交流主页消息
	            // 					1022=>'oauthBindNewUser(2.29	第三方绑定新账户)',				//第三方登录，绑定新帐号
	            // 					1023=>'getDetailInfo(1.4	我的详细资料)',		//我的详细资料
	            // 					1024=>'getPrivacy(2.13	获取用户隐私设置)',				//获取隐私设置
	            // 					1025=>'updatePrivacy(2.14	更新用户隐私设置)',				//更新隐私设置
	            // 					1026=>'uploadMobileBook(2.33	上传手机通讯录)',			//上传手机通讯录
	            // 					1027=>'sendMessage(2.15	发送私信)',				//发送私信
	            // 					//1028=>'delMessage',				//删除私信
	            // 					1031=>'oauthBindLogin(登录后第三方绑定)',			//登录后第三方绑定
	            // 					1032=>'oauthLoginOneStep(微博一键登录)',			//微博一键登录
	            // 					1033=>'oauthLoginUser(2.28	第三方登录-已绑定帐号)',				//第三方登录，已绑定帐号
	            // 					1034=>'rejectNotify(2.25	拒绝邀请)',				//拒绝邀请
	            // 					1035=>'ignoreNotify(2.24	忽略通知)',				//忽略邀请
	            // 					1036=>'suggestionUser(2.32	用户建议)',				//用户建议
	            // 					//1037=>'getEduInfo',				//获取教育信息资料
	            // 					//1038=>'getWorkInfo',				//获取工作信息资料
	            // 					//1039=>'updatePass',				//修改密码
	            // 					1040=>'updateSetting(2.35	更新手机端用户设置)',				//修改手机端设置
	            // 					1041=>'getSetting(2.34	获取手机端用户设置)',				//获取手机端设置
	            // 					//1042=>'getContactList',			//获取私信联系人列表
	            // 					//1043=>'delContact',				//删除私信联系人
	            // 					1044=>'oauthBindExistUser(2.30	第三方绑定已存在账户)',			//绑定已存在账户
	            // 					//1045=>'share',						//用户分享
	            // 					//1046=>'outBox',					//发信箱
	            // 					//1047=>'showGroupInvite',			//圈子邀请信
	            // 					1048=>'getUserFaceUser(2.43	获取用户头像)',				//获取用户头像
	            // 					//1049=>'setNotifyIsRead',			//设置信息已读
	            // 					1050=>'setMessageIsRead(设置某个好友私信已读)',			//设置私信已读
	            // 					1051=>'getRelationInfo(获取用户与当前登录用户的关系)',			//获取用户与当前登陆用户的关系
	            // 					//1052=>'checkUserLogin',			//检查帐号密码
	            // 					1053=>'addPushToken(2.37	添加用户推送token)',			//IOS添加用户推送token
	            // 					1054=>'sendMobileVerify(2.40	发送手机验证码)',			//发送手机验证码
	            // 					1055=>'bindMobile(2.41	已注册用户绑定手机)',				//绑定手机
	            // 					//1056=>'registerMobile',			//手机注册
	            // 					1057=>'checkMobile(2.38	检查手机是否已被使用)',				//检查手机是否已被使用
	            // 					1058=>'hasbindMobile(2.39	检查用户是否已绑定手机)',				//检查用户是否已绑定手机
	            // 					1059=>'loginMobileCode(2.42	新手机用户注册)',				//手机登录已注册用户
	            // 					//1060=>'checkEmailBind',			//检查邮箱是否已绑定微博
	            // 					//1061=>'Api/User/addMobileBook',              //添加单条通讯录好友
	            // 					//1062=>'Api/User/deleteMobileBook',          //删除单条通讯录好友
	            // 					1063=>'getSkinList(获取个人主页背景图片列表)',					//获取背景图片列表
	            // 					1064=>'getPushMsgLast(获取用户最后一条推送信息)',            //获取用户最后一条推送信息
	            // 					1065=>'addAppAccessLog(添加APP使用用户数据)',            	//添加APP使用用户数据
	            // 					1066=>'updateTokenStatus(更新token状态)',			//更新token状态
	            // 					1067=>'getNotifyList(好友推荐+邀请列表)',				//好友推荐+邀请列表
	            // 					1068=>'loginPassword(帐号密码登录)',		//帐号密码登录
	            // 					1069=>'getBindStatus(获取第三方绑定状态)',			//获取第三方绑定状态
	            // 					1070=>'setSyncInfo(第三方同步设置-多值)',			//第三方同步设置
	            // 					1071=>'checkOauthVerify(验证检查)',				//验证检查
	            // 					1072=>'saveSkin(保存所选择的背景图片)',			//保存所选择的背景图片
	            // 					1073=>'setNotifyIsReadType(把消息批量修改为已读)',		//保存所选择的背景图片
	            // 					1074=>'setSyncItem(第三方同步设置-单值)',			//第三方同步设置(单值)
	            // 					1075=>'getSyncInfo(获取第三方同步设置)',				//获取第三方同步设置
	            // 					1076=>'getNotifyCount(获取未读消息数量)',			//获取未读消息数量
	            // 					1077=>'addFriendStep(第二步加好友)',				//第二步加好友
	            // 					1078=>'followStarStep(第三步追星)',				//第三步追星
	            // 					1079=>'getRegFriends(注册加好友列表)',				//注册加好友列表
	            // 					1080=>'LoginOneStep_New(新一键登录)',			//新一键登录
	            // 					1081=>'oauthBindLogin_New(新登录后第三方绑定)',		//新登录后第三方绑定
	            // 					1082=>'loginguest(昵称注册或登录)',			//昵称注册或登录
	            // 					//1083=>'mobilePwdResetVerify(密码重置手机验证码是否正确)',	//密码重置手机验证码是否正确
	            // 					1084=>'getOrder(获取某用户的订单列表)',
	            // 					1085=>'addFeedback(意见反馈,不是评论,非注册用户也可以)',	//添加意见反馈
	            // 					1086=>'getFeedbacList(意见反馈列表)'	,				//意见反馈列表
	            // 					1087=>'mobilePwdReset(重置密码,用1054发送)',			//重置密码,用1054发送
	            // 					1088=>'repayOrder(订单重新支付)',
	            // 					1089=>'cancelOrder(取消订单)'
	    ),
	    'goods'=>array(
	        2001=>array(
	            'api'=>'Api/Goods/list_goods','title'=>'list_goods获取商品列表','description'=>'list_goods(商品列表)',
	            'parameters'=>array(
	                array('name'=>'category_id','required'=>0,'description'=>'所属分类'),
	                array('name'=>'community_id','required'=>0,'description'=>'社区id'),
	                array('name'=>'city_id','required'=>0,'description'=>' 城市id|同城商品'),
	                array('name'=>'brand_id','required'=>0,'description'=>'品牌'),
	                array('name'=>'p','required'=>0,'description'=>'第几页'),
	                array('name'=>'page_size','required'=>1,'description'=>'每页几条'),
	            ),
	        ),				//圈子列表
	        2002=>array(
	            'api'=>'Api/Goods/get_good_by_id','title'=>'get_good_by_id根据id获取商品信息','description'=>'get_good_by_id(根据id获取商品信息)',
	            'parameters'=>array(
	                array('name'=>'goods_id','required'=>1,'description'=>'商品id'),
	            ),
	        ),			//推荐圈子列表
	        2003=>array(
	            'api'=>'Api/Goods/del_goods','title'=>'del_goods删除指定商品','description'=>'del_goods(删除指定商品)',	
	            'parameters'=>array(
	                array('name'=>'goods_id','required'=>1,'description'=>'商品id'),
	            ),
	        ),	//删除指定商品
	        2004=>array(
	            'api'=>'Api/Goods/add_good','title'=>'add_goods添加商品','description'=>'add_good(添加商品)',
	            'parameters'=>array(
	                array('name'=>'goods_name','required'=>1,'description'=>'商品名称'),
	                array('name'=>'category_id','required'=>0,'description'=>'商品分类'),
	                array('name'=>'brand_id','required'=>0,'description'=>'商品品牌'),
	                array('name'=>'quantity','required'=>0,'description'=>'商品数量'),
	                array('name'=>'user_id','required'=>0,'description'=>'用户id'),
	                array('name'=>'store_id','required'=>0,'description'=>'商家id'),
	                array('name'=>'price','required'=>1,'description'=>'商品价格'),
	                array('name'=>'desc','required'=>1,'description'=>'商品描述'),
	                array('name'=>'brief','required'=>1,'description'=>'商品描述'),
	                array('name'=>'status','required'=>1,'description'=>'商品状态(0,1)'),
	                array('name'=>'community_id','required'=>1,'description'=>'社区id'),
	                array('name'=>'city_id','required'=>1,'description'=>'城市id'),
	                array('name'=>'mobile','required'=>1,'description'=>'手机|联系电话|可能是帮别人上传的商品，故有电话'),
	                array('name'=>'sort','required'=>1,'description'=>'排序'),
	                array('name'=>'lng','required'=>1,'description'=>'经度'),
	                array('name'=>'lat','required'=>1,'description'=>'纬度'),
	                array('name'=>'img1','file'=>1,'required'=>1,'description'=>'图片'),
	                array('name'=>'img2','file'=>1,'required'=>1,'description'=>'图片'),
	                array('name'=>'img3','file'=>1,'required'=>1,'description'=>'图片'),
	                array('name'=>'img4','file'=>1,'required'=>1,'description'=>'图片'),
	                array('name'=>'img5','file'=>1,'required'=>1,'description'=>'图片'),
	            ),
	        ),					//添加商品
	        2005=>array(
	            'api'=>'Api/Goods/update_goodsById','title'=>'update_goodsById修改商品','description'=>'update_goodsById(修改)',	
	            'parameters'=>array(
	                array('name'=>'goods_name','required'=>1,'description'=>'商品名称'),
	                array('name'=>'category_id','required'=>0,'description'=>'商品分类'),
	                array('name'=>'brand_id','required'=>0,'description'=>'商品品牌'),
	                array('name'=>'quantity','required'=>0,'description'=>'商品数量'),
	                array('name'=>'user_id','required'=>0,'description'=>'用户id'),
	                array('name'=>'store_id','required'=>0,'description'=>'商家id'),
	                array('name'=>'price','required'=>1,'description'=>'商品价格'),
	                array('name'=>'desc','required'=>1,'description'=>'商品描述'),
	                array('name'=>'brief','required'=>1,'description'=>'商品描述'),
	                array('name'=>'status','required'=>1,'description'=>'商品状态(0,1)'),
	                array('name'=>'community_id','required'=>1,'description'=>'社区id'),
	                array('name'=>'city_id','required'=>1,'description'=>'城市id'),
	                array('name'=>'mobile','required'=>1,'description'=>'手机|联系电话|可能是帮别人上传的商品，故有电话'),
	                array('name'=>'sort','required'=>1,'description'=>'排序'),
	                array('name'=>'lng','required'=>1,'description'=>'经度'),
	                array('name'=>'lat','required'=>1,'description'=>'纬度'),
	                array('name'=>'img1','file'=>1,'required'=>1,'description'=>'图片'),
	                array('name'=>'img2','file'=>1,'required'=>1,'description'=>'图片'),
	                array('name'=>'img3','file'=>1,'required'=>1,'description'=>'图片'),
	                array('name'=>'img4','file'=>1,'required'=>1,'description'=>'图片'),
	                array('name'=>'img5','file'=>1,'required'=>1,'description'=>'图片'),
	           ),
	        ),				//修改商品
	        2006=>array(
	            'api'=>'Api/Goods/get_brand_list','title'=>'get_brand_list获取品牌列表','description'=>'get_brand_list(获取品牌列表)',
	            'parameters'=>array(
	                array('name'=>'page_size','required'=>1,'description'=>'每页几条'),
	                array('name'=>'p','required'=>1,'description'=>'第几页'),
	            ),
	        ),					//退出圈子
	        2007=>array(
	            'api'=>'Api/Goods/get_brand_by_id','title'=>'get_brand_by_id获取品牌信息','description'=>'get_brand_by_id(获取品牌信息)',
	            'parameters'=>array(
	                array('name'=>'brand_id','required'=>1,'description'=>'品牌id'),
	            ),
	        ),				//品牌
	        2008=>array(
	            'api'=>'Api/Goods/add_brand','title'=>'add_brand添加品牌','description'=>'add_brand(添加品牌)',
	            'parameters'=>array(
	            array('name'=>'store_id','required'=>0,'description'=>'品牌store_id'),
	            array('name'=>'name','required'=>1,'description'=>'品牌名称'),
	            array('name'=>'desc','required'=>0,'description'=>'品牌描述'),
	            array('name'=>'is_show','required'=>0,'description'=>'是否在网站、app前台显示'),
	            array('name'=>'sort','required'=>1,'description'=>'品牌排序'),
	            array('name'=>'img_50_50','required'=>0,'description'=>'品牌图片(50*50)'),
	            array('name'=>'img_200_200','required'=>0,'description'=>'品牌图片(200*200)'),
	            ),
	        ),					//将成员踢出圈子
	        2009=>array(
	            'api'=>'Api/Goods/set_goods_up','title'=>'set_goods_up赞','description'=>'set_goods_up(赞)',	
	            'parameters'=>array(
	                array('name'=>'goods_id','required'=>1,'description'=>'点赞的商品id'),
	            ),
	        ),				//赞
	        2010=>array(
	            'api'=>'Api/Goods/set_goods_down','title'=>'set_goods_down差','description'=>'set_goods_down(差)',
	            'parameters'=>array(
	                array('name'=>'goods_id','required'=>1,'description'=>'点赞的商品id'),
	            ),
	        ),			//差
	        2011=>array(
	            'api'=>'Api/Goods/set_goods_like','title'=>'set_goods_like喜欢','description'=>'set_goods_like(喜欢)',
	            'parameters'=>array(
	                array('name'=>'goods_id','required'=>1,'description'=>'喜欢的商品id'),
	            ),
	        ),		//喜欢
	        2012=>array(
	            'api'=>'Api/Goods/update_brand','title'=>'update_brand修改品牌','description'=>'update_brand(修改品牌)',
	            'parameters'=>array(
	                array('name'=>'brand_id','required'=>1,'description'=>'品牌id'),
	                array('name'=>'store_id','required'=>1,'description'=>'品牌store_id'),
	                array('name'=>'name','required'=>1,'description'=>'品牌名称'),
	                array('name'=>'desc','required'=>1,'description'=>'品牌描述'),
	                array('name'=>'is_show','required'=>1,'description'=>'是否在网站、app前台显示'),
	                array('name'=>'sort','required'=>1,'description'=>'品牌排序'),
	                array('name'=>'img_50_50','required'=>1,'description'=>'品牌图片(50*50)'),
	                array('name'=>'img_200_200','required'=>1,'description'=>'品牌图片(200*200)'),
	            ),
	        ),					//修改品牌
	        2013=>array(
	            'api'=>'Api/Goods/del_brand','title'=>'del_brand删除品牌','description'=>'del_brand(删除品牌)',
	            'parameters'=>array(
	                array('name'=>'brand_id','required'=>1,'description'=>'品牌id'),
	            ),
	        ),					//删除品牌
	        2014=>array(
	            'api'=>'Api/Goods/add_category','title'=>'add_category添加分类','description'=>'add_category(添加分类)',
	            'parameters'=>array(
	                array('name'=>'name','required'=>1,'description'=>'分类名称'),
	                array('name'=>'store_id','required'=>0,'description'=>'商家id'),
	                array('name'=>'pid','required'=>0,'description'=>'上级分类ID'),
	                array('name'=>'desc','required'=>0,'description'=>'商品分类描述'),
	                array('name'=>'keywords','required'=>0,'description'=>'关键词'),
	                array('name'=>'sort','required'=>0,'description'=>'排序'),
	            ),
	        ),				//添加分类
	        2015=>array(
	            'api'=>'Api/Goods/get_category_by_id','title'=>'get_category_by_id获取分类信息','description'=>'get_category_by_id(获取分类信息)',
	            'parameters'=>array(
	                array('name'=>'category_id','required'=>1,'description'=>'分类ID'),
	            ),
	        ),					//获取分类信息
	        2016=>array(
	            'api'=>'Api/Goods/update_category','title'=>'update_category修改分类信息','description'=>'update_category(修改分类信息)',
	            'parameters'=>array(
	                array('name'=>'category_id','required'=>1,'description'=>'分类ID'),
	                array('name'=>'store_id','required'=>0,'description'=>'商家id'),
	                array('name'=>'name','required'=>0,'description'=>'分类名称'),
	                array('name'=>'pid','required'=>0,'description'=>'上级分类ID'),
	                array('name'=>'desc','required'=>0,'description'=>'商品分类描述'),
	                array('name'=>'keywords','required'=>0,'description'=>'关键词'),
	                array('name'=>'sort','required'=>0,'description'=>'排序'),
	            ),
	            
	        ),//修改分类信息
	        2017=>array(
	            'api'=>'Api/Goods/get_category_list','title'=>'get_category_list分类列表','description'=>'get_category_list(分类列表)',
	            'parameters'=>array(
	                array('name'=>'store_id','required'=>1,'description'=>'商家id'),
	                array('name'=>'pid','required'=>1,'description'=>'上级分类ID'),
	            ),
	        ),				//分类列表
	        2018=>array(
	            'api'=>'Api/Goods/del_category','title'=>'del_category删除分类','description'=>'del_category(删除分类)',
	            'parameters'=>array(
	                array('name'=>'category_id','required'=>1,'description'=>'分类ID'),
	            ),
	        ),					//删除分类
	        // 					2019=>'photo',					//某个相册的相片
	    // 					2020=>'allPhoto',					//所有相片列表
	    // 					2021=>'updateLogo',				//更改圈子LOGO
	    // 					2022=>'doAgree',					//同意加入圈子
	    // 					2023=>'breakup',					//解散圈子
	    // 					2024=>'getStat',					//圈子统计信息
	    ),
	    'article'=>array(
	        3001=>array(
	            'api'=>'Api/Article/add_article','title'=>'add_article添加文章','description'=>'add_article(添加文章)',
	            'parameters'=>array(
	                array('name'=>'user_id','required'=>0,'description'=>'用户ID'),
	                array('name'=>'store_id','required'=>0,'description'=>'商家ID'),
	                array('name'=>'title','required'=>1,'description'=>'标题'),
	                array('name'=>'type','options'=>array('0'=>'请选择类型','1'=>'公告','2'=>'普通文章','3'=>'论坛贴','4'=>'日记','5'=>'说说(心情)',),'required'=>0,'description'=>'文章类型'),
	                array('name'=>'category_id','required'=>0,'description'=>'分类ID'),
	                array('name'=>'desc','required'=>0,'description'=>'描述'),
	                array('name'=>'content','required'=>1,'description'=>'内容'),
	                array('name'=>'img1','required'=>0,'description'=>'图片1(1500*1500以下)'),
	                array('name'=>'img2','required'=>0,'description'=>'图片1(1500*1500以下)'),
	                array('name'=>'img3','required'=>0,'description'=>'图片1(1500*1500以下)'),
	                array('name'=>'img4','required'=>0,'description'=>'图片1(1500*1500以下)'),
	                array('name'=>'img5','required'=>0,'description'=>'图片1(1500*1500以下)'),
	                array('name'=>'img6','required'=>0,'description'=>'图片1(1500*1500以下)'),
	                array('name'=>'img7','required'=>0,'description'=>'图片1(1500*1500以下)'),
	                array('name'=>'img8','required'=>0,'description'=>'图片1(1500*1500以下)'),
	            ),
	        ),						//添加文章
	        3002=>array(
	            'api'=>'Api/Article/get_article_list','title'=>'get_article_list获取文章列表','description'=>'get_article_list(获取文章列表)',
	            'parameters'=>array(
	                array('name'=>'user_id','required'=>0,'description'=>'用户ID'),
	                array('name'=>'store_id','required'=>0,'description'=>'商家ID'),
	                array('name'=>'title','required'=>1,'description'=>'标题'),
	                array('name'=>'type','options'=>array('0'=>'请选择类型','1'=>'公告','2'=>'普通文章','3'=>'论坛贴','4'=>'日记','5'=>'说说(心情)',),'required'=>0,'description'=>'文章类型'),
	                array('name'=>'category_id','required'=>0,'description'=>'分类ID'),
	            ),
	        ),						//玩友想看
	        3003=>array(
	            'api'=>'Api/Article/get_article_by_id','title'=>'get_article_by_id获取文章列表','description'=>'get_article_by_id(获取文章详细信息)',
	            'parameters'=>array(
	                array('name'=>'article_id','required'=>0,'description'=>'文章ID'),
	            ),
	        ),					//获取文章信息
	        3004=>array(
	            'api'=>'Api/Article/update_article','title'=>'update_article修改文章列表','description'=>'update_article(修改文章列表)',
	            'parameters'=>array(
	                array('name'=>'article_id','required'=>0,'description'=>'文章ID'),
	                array('name'=>'user_id','required'=>0,'description'=>'用户ID'),
	                array('name'=>'store_id','required'=>0,'description'=>'商家ID'),
	                array('name'=>'title','required'=>1,'description'=>'标题'),
	                array('name'=>'type','options'=>array('0'=>'请选择类型','1'=>'公告','2'=>'普通文章','3'=>'论坛贴','4'=>'日记','5'=>'说说(心情)',),'required'=>0,'description'=>'文章类型'),
	                array('name'=>'category_id','required'=>0,'description'=>'分类ID'),
	                array('name'=>'desc','required'=>0,'description'=>'描述'),
	                array('name'=>'content','required'=>1,'description'=>'内容'),
	                array('name'=>'img1','required'=>0,'description'=>'图片1(1500*1500以下)'),
	                array('name'=>'img2','required'=>0,'description'=>'图片1(1500*1500以下)'),
	                array('name'=>'img3','required'=>0,'description'=>'图片1(1500*1500以下)'),
	                array('name'=>'img4','required'=>0,'description'=>'图片1(1500*1500以下)'),
	                array('name'=>'img5','required'=>0,'description'=>'图片1(1500*1500以下)'),
	                array('name'=>'img6','required'=>0,'description'=>'图片1(1500*1500以下)'),
	                array('name'=>'img7','required'=>0,'description'=>'图片1(1500*1500以下)'),
	                array('name'=>'img8','required'=>0,'description'=>'图片1(1500*1500以下)'),
	            ),
	        ),					//修改文章
	        3005=>array(
	            'api'=>'Api/Article/del_article','title'=>'del_article删除文章','description'=>'del_article(删除文章)',
	            'parameters'=>array(
	                array('name'=>'article_id','required'=>0,'description'=>'文章ID'),
	            ),
	        ),				//删除文章
	        3006=>array(
	            'api'=>'Api/Article/get_article_comment_list','title'=>'get_article_comment_list文章评论列表','description'=>'get_article_comment_list(文章评论列表)',
	            'parameters'=>array(
	                array('name'=>'up_id','required'=>0,'description'=>'上级评论ID'),
	                array('name'=>'belong_user_id','required'=>0,'description'=>'谁评论的'),
	                array('name'=>'belong_store_id：','required'=>0,'description'=>'谁评论的'),
	                
	                array('name'=>'article_id','required'=>0,'description'=>'文章ID'),
	                array('name'=>'goods_id','required'=>0,'description'=>'商品ID'),
	                array('name'=>'user_id','required'=>0,'description'=>'用户ID'),
	                array('name'=>'store_id','required'=>0,'description'=>'商家ID'),
	                array('name'=>'share_id','required'=>0,'description'=>'分享ID'),
	                array('name'=>'file_id','required'=>0,'description'=>'文件ID'),
	                array('name'=>'rental_id','required'=>0,'description'=>'租赁ID'),
	                array('name'=>'cuisine_id','required'=>0,'description'=>'菜式ID'),
	                array('name'=>'course_id','required'=>0,'description'=>'课程ID'),
	                array('name'=>'order_id','required'=>0,'description'=>'订单ID'),
	                array('name'=>'mobile','required'=>0,'description'=>'手机'),
	                array('name'=>'email','required'=>0,'description'=>'邮箱'),
	                array('name'=>'community_id','required'=>0,'description'=>'社区ID'),
	                array('name'=>'page_size','required'=>0,'description'=>'每页多少条记录'),
	                array('name'=>'p','required'=>0,'description'=>'第几页'),
	            ),
	        ),
	        3007=>array(
	            'api'=>'Api/Article/add_comment','title'=>'add_comment添加评论','description'=>'add_comment(添加评论)',
	            'parameters'=>array(
	                array('name'=>'title','required'=>0,'description'=>'评论标题'),
	                array('name'=>'content','required'=>1,'description'=>'评论内容'),
	                array('name'=>'reply_content','required'=>0,'description'=>'回复评论内容'),
	                array('name'=>'up_id','required'=>0,'description'=>'上级评论id'),
	                array('name'=>'belong_user_id','required'=>0,'description'=>'谁评论的'),
	                array('name'=>'belong_store_id：','required'=>0,'description'=>'谁评论的'),
	                array('name'=>'email','required'=>0,'description'=>'谁评论的'),
	                array('name'=>'mobile','required'=>0,'description'=>'谁评论的'),
	                
	                array('name'=>'article_id','required'=>0,'description'=>'文章ID'),
	                array('name'=>'goods_id','required'=>0,'description'=>'商品ID'),
	                array('name'=>'user_id','required'=>0,'description'=>'用户ID'),
	                array('name'=>'store_id','required'=>0,'description'=>'商家ID'),
	                array('name'=>'share_id','required'=>0,'description'=>'分享ID'),
	                array('name'=>'file_id','required'=>0,'description'=>'文件ID'),
	                array('name'=>'rental_id','required'=>0,'description'=>'租赁ID'),
	                array('name'=>'cuisine_id','required'=>0,'description'=>'菜式ID'),
	                array('name'=>'course_id','required'=>0,'description'=>'课程ID'),
	                array('name'=>'order_id','required'=>0,'description'=>'订单ID'),
	                array('name'=>'community_id','required'=>0,'description'=>'社区ID'),
	            ),
	        ),
	        3008=>array(
	            'api'=>'Api/Article/del_comment','title'=>'del_comment删除评论','description'=>'del_comment(删除评论)',
	            'parameters'=>array(
	                array('name'=>'comment_id','required'=>0,'description'=>'评论ID'),
	                array('name'=>'up_id','required'=>0,'description'=>'上级评论id'),
	                array('name'=>'belong_user_id','required'=>0,'description'=>'谁评论的'),
	                array('name'=>'belong_store_id：','required'=>0,'description'=>'谁评论的'),
	                array('name'=>'email','required'=>0,'description'=>'谁评论的'),
	                array('name'=>'mobile','required'=>0,'description'=>'谁评论的'),
	                
	                array('name'=>'article_id','required'=>0,'description'=>'文章ID'),
	                array('name'=>'goods_id','required'=>0,'description'=>'商品ID'),
	                array('name'=>'user_id','required'=>0,'description'=>'用户ID'),
	                array('name'=>'store_id','required'=>0,'description'=>'商家ID'),
	                array('name'=>'share_id','required'=>0,'description'=>'分享ID'),
	                array('name'=>'file_id','required'=>0,'description'=>'文件ID'),
	                array('name'=>'rental_id','required'=>0,'description'=>'租赁ID'),
	                array('name'=>'cuisine_id','required'=>0,'description'=>'菜式ID'),
	                array('name'=>'course_id','required'=>0,'description'=>'课程ID'),
	                array('name'=>'order_id','required'=>0,'description'=>'订单ID'),
	                array('name'=>'community_id','required'=>0,'description'=>'社区ID'),
	            ),
	        ),
	        3009=>array(
	            'api'=>'Api/Article/get_comment_by_commentid','title'=>'get_comment_by_commentid获取单条评论信息','description'=>'get_comment_by_commentid(获取单条评论信息)',
	            'parameters'=>array(
	                array('name'=>'comment_id','required'=>0,'description'=>'评论ID'),
	                array('name'=>'title','required'=>0,'description'=>'评论标题'),
	                array('name'=>'content','required'=>1,'description'=>'评论内容'),
	                array('name'=>'reply_content','required'=>0,'description'=>'回复评论内容'),
	                array('name'=>'up_id','required'=>0,'description'=>'上级评论id'),
	                array('name'=>'belong_user_id','required'=>0,'description'=>'谁评论的'),
	                array('name'=>'belong_store_id：','required'=>0,'description'=>'谁评论的'),
	                array('name'=>'email','required'=>0,'description'=>'谁评论的'),
	                array('name'=>'mobile','required'=>0,'description'=>'谁评论的'),
	                 
	                array('name'=>'article_id','required'=>0,'description'=>'文章ID'),
	                array('name'=>'goods_id','required'=>0,'description'=>'商品ID'),
	                array('name'=>'user_id','required'=>0,'description'=>'用户ID'),
	                array('name'=>'store_id','required'=>0,'description'=>'商家ID'),
	                array('name'=>'share_id','required'=>0,'description'=>'分享ID'),
	                array('name'=>'file_id','required'=>0,'description'=>'文件ID'),
	                array('name'=>'rental_id','required'=>0,'description'=>'租赁ID'),
	                array('name'=>'cuisine_id','required'=>0,'description'=>'菜式ID'),
	                array('name'=>'course_id','required'=>0,'description'=>'课程ID'),
	                array('name'=>'order_id','required'=>0,'description'=>'订单ID'),
	                array('name'=>'community_id','required'=>0,'description'=>'社区ID'),
	            ),
	        ),
	        3010=>array(
	            'api'=>'Api/Article/update_comment','title'=>'update_comment修改评论信息','description'=>'update_comment(修改评论)',
	            'parameters'=>array(
	                array('name'=>'comment_id','required'=>0,'description'=>'评论ID'),
	                array('name'=>'title','required'=>0,'description'=>'评论标题'),
	                array('name'=>'content','required'=>1,'description'=>'评论内容'),
	                array('name'=>'reply_content','required'=>0,'description'=>'回复评论内容'),
	                array('name'=>'up_id','required'=>0,'description'=>'上级评论id'),
	                array('name'=>'belong_user_id','required'=>0,'description'=>'谁评论的'),
	                array('name'=>'belong_store_id：','required'=>0,'description'=>'谁评论的'),
	                array('name'=>'email','required'=>0,'description'=>'谁评论的'),
	                array('name'=>'mobile','required'=>0,'description'=>'谁评论的'),
	                 
	                array('name'=>'article_id','required'=>0,'description'=>'文章ID'),
	                array('name'=>'goods_id','required'=>0,'description'=>'商品ID'),
	                array('name'=>'user_id','required'=>0,'description'=>'用户ID'),
	                array('name'=>'store_id','required'=>0,'description'=>'商家ID'),
	                array('name'=>'share_id','required'=>0,'description'=>'分享ID'),
	                array('name'=>'file_id','required'=>0,'description'=>'文件ID'),
	                array('name'=>'rental_id','required'=>0,'description'=>'租赁ID'),
	                array('name'=>'cuisine_id','required'=>0,'description'=>'菜式ID'),
	                array('name'=>'course_id','required'=>0,'description'=>'课程ID'),
	                array('name'=>'order_id','required'=>0,'description'=>'订单ID'),
	                array('name'=>'community_id','required'=>0,'description'=>'社区ID'),
	            ),
	        ),					//修改
	        //3009=>'follow(7.21	添加追星)',						//追星
	        //3010=>'unfollow(7.22	取消追星)',					//取消追星
	    // 					3013=>'getBackground(获取启动页海报)',				//获取启动页海报
	    ),
	    'address'=>array(
	        4001=>array(
	            'api'=>'Api/Address/get_provinces_list','title'=>'get_provinces_list获取省份列表','description'=>'get_provinces_list(获取省份列表)',	
	            'parameters'=>array(
	                array('name'=>'id','options'=>array('0'=>'中国','1'=>'美国(暂无)','3'=>'泰国(暂无)','4'=>'马来西亚(暂无)',),'required'=>0,'description'=>'国家'),
	                array('name'=>'page_size','required'=>0,'description'=>'每页几条记录'),
	                array('name'=>'p','required'=>0,'description'=>'第几页'),
	            ),
	        ),	//省份列表
	        4002=>array(
	            'api'=>'Api/Address/get_city_list_by_provinces_id','title'=>'get_city_list_by_provinces_id获取城市列表','description'=>'get_city_list_by_provinces_id(获取城市列表)',
	            'parameters'=>array(
	                array('name'=>'district_id','options'=>array('1'=>'北京市','2'=>'天津市','3'=>'河北省','4'=>'山西省','5'=>'内蒙古自治区','6'=>'辽宁省','7'=>'吉林省','8'=>'黑龙江省','9'=>'上海市','10'=>'江苏省','11'=>'浙江省','12'=>'安徽省','13'=>'福建省','14'=>'江西省','15'=>'山东省','16'=>'河南省','17'=>'湖北省','18'=>'湖南省','19'=>'广东省','20'=>'广西壮族自治区','21'=>'海南省','22'=>'重庆市','23'=>'四川省','24'=>'贵州省','25'=>'云南省','26'=>'西藏自治区','27'=>'陕西省','28'=>'甘肃省','29'=>'青海省','30'=>'宁夏回族自治区','31'=>'新疆维吾尔自治区','32'=>'台湾省','33'=>'香港特别行政区','34'=>'澳门特别行政区',),'required'=>1,'description'=>'省份'),
	                array('name'=>'page_size','required'=>0,'description'=>'每页几条记录'),
	                array('name'=>'p','required'=>0,'description'=>'第几页'),
	            ),
	        ),//城市列表
	        4003=>array(
	            'api'=>'Api/Address/get_district_by_city_id','title'=>'get_district_by_city_id获取指定城市的区列表','description'=>'get_district_by_city_id(获取指定城市的区列表)',	
	            'parameters'=>array(
	                array('name'=>'district_id','required'=>0,'description'=>'城市id'),
	                array('name'=>'page_size','required'=>0,'description'=>'每页几条记录'),
	                array('name'=>'p','required'=>0,'description'=>'第几页'),
	            ),
	        ),  //区列表
	        4004=>array(
	            'api'=>'Api/Address/get_info_by_district_id','title'=>'get_info_by_district_id获取省、城市、区的信息','description'=>'get_info_by_district_id(获取省、城市、区的信息)',
	            'parameters'=>array(
	                array('name'=>'district_id','required'=>0,'description'=>'城市id'),
	            ),
	        ),	  //区列表
	        4005=>array(
	            'api'=>'Api/Address/get_city_list','title'=>'get_city_list根据字母、热门获取城市列表','description'=>'get_city_list(根据字母、热门获取城市列表)',	
	            'parameters'=>array(
	                array('name'=>'hot','required'=>0,'description'=>'是否热门，1为热门'),
	                array('name'=>'character','options'=>array('0'=>'请选择..','A'=>'A','B'=>'B','C'=>'C','D'=>'D','E'=>'E','F'=>'F','G'=>'G','H'=>'H','I'=>'I','J'=>'J','K'=>'K','L'=>'L','M'=>'M','N'=>'N','O'=>'O','P'=>'P','Q'=>'Q','R'=>'R','S'=>'S','T'=>'T','U'=>'U','V'=>'V','W'=>'W','X'=>'X','Y'=>'Y','Z'=>'Z',),'required'=>0,'description'=>'字母'),
	            ),
	        ),	//获取电影场次
	        4006=>array(
	            'api'=>'Api/Address/add_community','title'=>'add_community添加楼盘','description'=>'add_community(添加楼盘)',
	            'parameters'=>array(
	                array('name'=>'name','required'=>1,'description'=>'楼盘|小区|名称'),
	                array('name'=>'desc','required'=>1,'description'=>'小区描述'),
	                array('name'=>'is_school','options'=>array('0'=>'非学校','1'=>'学校','required'=>0,),'description'=>'是否只要学校'),
	                array('name'=>'city_id','required'=>1,'description'=>'城市id'),
	                array('name'=>'district_id','required'=>1,'description'=>'区id'),
	                array('name'=>'official','required'=>1,'description'=>'官方名称|万科、腾讯、国美'),
	                array('name'=>'longitude','required'=>1,'description'=>'经度'),
	                array('name'=>'latitude','required'=>1,'description'=>'纬度'),
	                array('name'=>'img1','required'=>0,'description'=>'社区名称'),
	                array('name'=>'img2','file'=>'1','required'=>0,'description'=>'50*50'),
	            ),
	        ),				//添加社区
	        4007=>array(
	            'api'=>'Api/Address/get_community_list','title'=>'get_community_list楼盘列表','description'=>'get_community_list(楼盘列表)',
	            'parameters'=>array(
	                array('name'=>'name','required'=>0,'description'=>'楼盘|小区|名称'),
	                array('name'=>'is_school','options'=>array('0'=>'非学校','1'=>'学校',),'required'=>0,'description'=>'是否只要学校'),
                    array('name'=>'city_id','required'=>0,'description'=>'城市id'),
                    array('name'=>'district_id','required'=>0,'description'=>'区id'),
                    array('name'=>'official','required'=>0,'description'=>'官方名称|万科、腾讯、国美'),
                    array('name'=>'p','required'=>1,'default_value'=>'1','description'=>'第几页'),
                    array('name'=>'page_size','required'=>1,'default_value'=>'20','description'=>'每页几条'),
	                ),
	        ),			//建圈子获取演出详细信息
	        4008=>array(
	            'api'=>'Api/Address/get_community_info','title'=>'get_community_info获取楼盘信息','description'=>'get_community_info(获取楼盘信息)',
	            'parameters'=>array(
	                array('name'=>'community_id','required'=>1,'default_value'=>'1','description'=>'楼盘ID'),
	            ),
	        ),				//获取社区信息
	        4009=>array(
	            'api'=>'Api/Address/get_address_by_id','title'=>'get_address_by_id收货地址信息','description'=>'get_address_by_id(收货地址信息)',
	            'parameters'=>array(
	                array('name'=>'address_id','required'=>1,'default_value'=>'1','description'=>'地址ID'),
	            ),
	        ),				//收货地址信息
	        4010=>array(
	            'api'=>'Api/Address/get_address_list','title'=>'get_address_list收货地址列表','description'=>'get_address_list(收货地址列表)',
	            'parameters'=>array(
	                array('name'=>'belong_user_id','required'=>0,'default_value'=>'1','description'=>'用户ID'),
	                array('name'=>'belong_store_id','required'=>0,'default_value'=>'1','description'=>'商家ID'),
	                array('name'=>'country_id','required'=>0,'default_value'=>'0','description'=>'所属国家'),
	                array('name'=>'province_id','required'=>0,'default_value'=>'1','description'=>'省份'),
	                array('name'=>'city_id','required'=>0,'default_value'=>'1','description'=>'城市'),
	                array('name'=>'district_id','required'=>0,'default_value'=>'1','description'=>'区|天河区'),
	                array('name'=>'default','required'=>0,'default_value'=>'1','description'=>'是否默认'),
	                array('name'=>'p','required'=>1,'default_value'=>'1','description'=>'第几页'),
	                array('name'=>'page_size','required'=>1,'default_value'=>'20','description'=>'每页几条'),
	            ),
	        ),				//收货地址列表
	        4011=>array(
	            'api'=>'Api/Address/add_address','title'=>'add_address添加收货地址','description'=>'add_address(添加收货地址)',
	            'parameters'=>array(
	                array('name'=>'belong_user_id','required'=>0,'default_value'=>'1','description'=>'用户ID'),
	                array('name'=>'belong_store_id','required'=>0,'default_value'=>'1','description'=>'商家ID'),
	                array('name'=>'country_id','required'=>0,'default_value'=>'0','description'=>'所属国家'),
	                array('name'=>'province_id','required'=>0,'default_value'=>'1','description'=>'省份'),
	                array('name'=>'city_id','required'=>0,'default_value'=>'1','description'=>'城市'),
	                array('name'=>'district_id','required'=>0,'default_value'=>'1','description'=>'区ID|天河区'),
	                array('name'=>'default','required'=>0,'default_value'=>'1','description'=>'是否默认'),
	            ),
	        ),				//添加收货地址
	        4012=>array(
	            'api'=>'Api/Address/update_address','title'=>'update_address修改收货地址','description'=>'update_address(修改收货地址)',
	            'parameters'=>array(
	                array('name'=>'address_id','required'=>1,'default_value'=>'1','description'=>'收货地址id'),
	                array('name'=>'belong_user_id','required'=>0,'default_value'=>'1','description'=>'用户ID'),
	                array('name'=>'belong_store_id','required'=>0,'default_value'=>'1','description'=>'商家ID'),
	                array('name'=>'country_id','required'=>0,'default_value'=>'0','description'=>'所属国家ID'),
	                array('name'=>'province_id','required'=>0,'default_value'=>'1','description'=>'省份ID'),
	                array('name'=>'city_id','required'=>0,'default_value'=>'1','description'=>'城市ID'),
	                array('name'=>'district_id','required'=>0,'default_value'=>'1','description'=>'区ID|天河区'),
	                array('name'=>'default','required'=>0,'default_value'=>'1','description'=>'是否默认'),
	            ),
	        ),				//修改收货地址
	        4013=>array(
	            'api'=>'Api/Address/del_address_by_id','title'=>'del_address_by_id删除收货地址','description'=>'del_address_by_id(删除收货地址)',
	            'parameters'=>array(
	                array('name'=>'address_id','required'=>1,'default_value'=>'1','description'=>'收货地址id'),
	           ),
	            
	        ),//删除收货地址
	        // 					4008=>'doSearch',					//搜索活动
	    // 					4009=>'getDetail',				//活动详情
	        4100=>array(
	            'api'=>'Api/Address/get_host','title'=>'get_host删除收货地址','description'=>'get_host(获取站点域名)',
	            'parameters'=>array(
	                array('name'=>'host','required'=>1,'options'=>array('Yo'=>'Yo系统站点','b2c'=>'b2c','c2c'=>'c2c','o2o'=>'o2o',),'default_value'=>'1','description'=>' 获取指定站点域名'),
	            ),
	        ),				//获取站点地址
	    ),
	    'payment'=>array(
	        5001=>array(
	            'api'=>'Api/Payment/set_order','title'=>'set_order设置通用订单','description'=>'set_order(设置通用订单)',
	            'parameters'=>array(
	                array('name'=>'pay_money_user_id','required'=>0,'default_value'=>'','description'=>'付款的用户id'),
	                array('name'=>'get_money_user_id','required'=>0,'default_value'=>'','description'=>'收款的用户id'),
	                array('name'=>'payment_method','required'=>1,'options'=>array('0'=>'余额支付','1'=>'积分支付','2'=>'优惠券支付','3'=>'以物易物','4'=>'支付宝(暂不支持)','5'=>'财付通(暂不支持)','6'=>'货到付款(暂不支持)','7'=>'信用卡(暂不支持)',),'default_value'=>'0','description'=>'支付方法'),
	                array('name'=>'goods_id','required'=>0,'default_value'=>'','description'=>'goods_id'),
	                array('name'=>'buy_quantity','required'=>0,'default_value'=>'','description'=>'购买数量'),
	                array('name'=>'pay_money_store_id','required'=>0,'default_value'=>'','description'=>'支付者商家id'),
	                array('name'=>'get_money_store_id','required'=>0,'default_value'=>'','description'=>'收款的商家id'),
	                array('name'=>'name','required'=>0,'default_value'=>'','description'=>'订单名称'),
	                array('name'=>'status','required'=>0,'options'=>array('0'=>'等待卖家付款','1'=>'支付成功','2'=>'支付失败','3'=>'取消'),'default_value'=>'0','description'=>'订单状态'),
	                array('name'=>'mobile','required'=>0,'default_value'=>'','description'=>'手机'),
	                array('name'=>'address','required'=>0,'default_value'=>'','description'=>'地址'),
	                array('name'=>'zip_code','required'=>0,'default_value'=>'','description'=>'邮编'),
	            ),
	        ),		//设置订单
	        5002=>array(
	            'api'=>'Api/Payment/set_order_success','title'=>'set_order_success设置订单已完成','description'=>'set_order_success(设置订单已完成)',
	            'parameters'=>array(
	                array('name'=>'order_id','required'=>1,'default_value'=>'','description'=>'订单id'),
	            ),
	        ),				//找玩友推荐玩友
	        5003=>array(
	            'api'=>'Api/Payment/get_order_list','title'=>'get_order_list获取订单列表','description'=>'get_order_list(获取订单列表)',
	            'parameters'=>array(
	                array('name'=>'pay_money_user_id','required'=>0,'default_value'=>'','description'=>'付款的用户id'),
	                array('name'=>'get_money_user_id','required'=>0,'default_value'=>'','description'=>'收款的用户id'),
	                array('name'=>'payment_method','required'=>1,'options'=>array('0'=>'余额支付','1'=>'积分支付','2'=>'优惠券支付','3'=>'以物易物','4'=>'支付宝(暂不支持)','5'=>'财付通(暂不支持)','6'=>'货到付款(暂不支持)','7'=>'信用卡(暂不支持)',),'default_value'=>'0','description'=>'支付方法'),
	                array('name'=>'goods_id','required'=>0,'default_value'=>'','description'=>'goods_id'),
	                array('name'=>'pay_money_store_id','required'=>0,'default_value'=>'','description'=>'支付者商家id'),
	                array('name'=>'get_money_store_id','required'=>0,'default_value'=>'','description'=>'收款的商家id'),
	                array('name'=>'name','required'=>0,'default_value'=>'','description'=>'订单名称'),
	                array('name'=>'status','required'=>0,'options'=>array('0'=>'等待卖家付款','1'=>'支付成功','2'=>'支付失败','3'=>'取消','9'=>'已完成'),'default_value'=>'0','description'=>'订单状态|0:等待买家付款，1支付成功，2支付失败，3取消,9已完成'),
	                array('name'=>'mobile','required'=>0,'default_value'=>'','description'=>'手机'),
	                array('name'=>'address','required'=>0,'default_value'=>'','description'=>'地址'),
	                array('name'=>'zip_code','required'=>0,'default_value'=>'','description'=>'邮编'),
	                array('name'=>'p','required'=>1,'default_value'=>'1','description'=>'第几页'),
	                array('name'=>'page_size','required'=>1,'default_value'=>'20','description'=>'每页几条'),
	            ),
	        ),				//我的玩友
	        5004=>array(
	            'api'=>'Api/Payment/pay_by_funds','title'=>'pay_by_funds余额支付','description'=>'pay_by_funds(余额支付)',
	            'parameters'=>array(
	                array('name'=>'order_id','required'=>1,'default_value'=>'','description'=>'订单id'),
	                array('name'=>'pay_user_id','required'=>1,'default_value'=>'','description'=>'用户id'),
	            ),
	        ),					//余额支付
	        5005=>array(
	            'api'=>'Api/Payment/pay_by_integral','title'=>'pay_by_integral积分支付','description'=>'pay_by_integral(积分支付)',
	            'parameters'=>array(
	                array('name'=>'order_id','required'=>1,'default_value'=>'','description'=>'订单id'),
	                array('name'=>'pay_user_id','required'=>1,'default_value'=>'','description'=>'用户id'),
	            ),
	        ),			//积分支付
	        5006=>array(
	            'api'=>'Api/Payment/pay_by_integral','title'=>'pay_by_integral以物换物、技能交换','description'=>'pay_by_barter(以物换物、技能交换)',
	            'parameters'=>array(
	                array('name'=>'order_id','required'=>1,'default_value'=>'','description'=>'订单id'),
	                array('name'=>'pay_user_id','required'=>1,'default_value'=>'','description'=>'支付的用户id'),
	                array('name'=>'pay_store_id','required'=>1,'default_value'=>'','description'=>'支付的商家id'),
	                array('name'=>'pay_goods_id','required'=>1,'default_value'=>'','description'=>'支付的商品id'),
	                array('name'=>'get_goods_id','required'=>1,'default_value'=>'','description'=>'要购买的商品id'),
	            ),
	        ),			//获取附近玩友
	        5007=>array(
	            'api'=>'Api/Payment/update_order','title'=>'update_order修改订单','description'=>'update_order(修改订单)',
	            'parameters'=>array(
	                array('name'=>'order_id','required'=>1,'default_value'=>'','description'=>'订单id'),
	                array('name'=>'mobile','required'=>0,'default_value'=>'','description'=>'手机'),
	                array('name'=>'address','required'=>0,'default_value'=>'','description'=>'地址'),
	                array('name'=>'zip_code','required'=>0,'default_value'=>'','description'=>'邮编'),
	            ),
	        ),
	    ),
	    'cuisine'=>array(
	        6001=>array(
	            'api'=>'Api/Payment/add_cuisine','title'=>'add_cuisine添加菜式','description'=>'add_cuisine（添加菜式）',
	            'parameters'=>array(
	                array('name'=>'store_id','required'=>1,'default_value'=>'','description'=>'所属商家'),
	                array('name'=>'user_id','required'=>1,'default_value'=>'','description'=>'所属用户'),
	                array('name'=>'category_id','required'=>0,'default_value'=>'','description'=>'分类'),
	                array('name'=>'name','required'=>1,'default_value'=>'','description'=>'标题'),
	                array('name'=>'keywords','required'=>0,'default_value'=>'','description'=>'关键字'),
	                array('name'=>'desc','required'=>0,'default_value'=>'','description'=>'描述'),
	                array('name'=>'body','required'=>0,'default_value'=>'','description'=>'内容'),
	                array('name'=>'ingredients','required'=>0,'default_value'=>'','description'=>'主料'),
	                array('name'=>'seasoning','required'=>0,'default_value'=>'','description'=>'配料'),
	                array('name'=>'kitchenware','required'=>0,'default_value'=>'','description'=>'厨具'),
	                array('name'=>'up','required'=>0,'default_value'=>'','description'=>'赞'),
	                array('name'=>'down','required'=>0,'default_value'=>'','description'=>'订单id'),
	                array('name'=>'like','required'=>0,'default_value'=>'','description'=>'喜欢'),
	                array('name'=>'img1','file'=>1,'required'=>0,'default_value'=>'','description'=>'图片1'),
	                array('name'=>'img2','file'=>1,'required'=>0,'default_value'=>'','description'=>'图片2'),
	                array('name'=>'img3','file'=>1,'required'=>0,'default_value'=>'','description'=>'图片2'),
	                array('name'=>'img4','file'=>1,'required'=>0,'default_value'=>'','description'=>'图片2'),
	                array('name'=>'img5','file'=>1,'required'=>0,'default_value'=>'','description'=>'图片2'),
	                
	            ),
	        ),			//添加菜式
	        6002=>'get_cuisine_list(获取列表)',		//获取列表			//说好
	        6003=>'get_cuisine_by_id(获取菜式信息)',		//获取菜式信息
	        6004=>'update_cuisine(修改菜式)',					//发布动态
	        6005=>'del_cuisine(删除菜式)',			//娱乐资讯动态
	    ),
	    'course'=>array(
	        7001=>'add_course(添加课程表)',				//添加课程表
	        7002=>'get_course_list(获取课程表列表)',		//获取课程表列表
	        7003=>'get_my_course(获取我的课程表)',		//获取我的课程表
	        7004=>'del_my_course(删除我的课程表、删除一个班的课程表)',//删除我的课程表、删除一个班的课程表
	        7005=>'getCourseById(获取一天的课程表)',      //获取一天的课程表
	        7006=>'update_course(修改一天的课程表)',      //修改一天的课程表
	        7007=>'del_course(删除用户一天的课程表)',      //删除用户一天的课程表
	        7008=>'get_class_list(班级列表)',      //班级列表
	    ),
	 	'store'=>array(
	 			    8001=>'get_store_list(获取商家列表)',		//获取商家列表
	 			),
	    'tag'=>array(//标签、广告
	        9001=>'add_tag(添加标签)',				//添加标签
	        9002=>'get_tag_list(获取标签列表)',		//获取标签列表
	        9003=>'get_tag_by_tag_id(获取标签详细)',	//获取标签详细
	        9004=>'update_tag(修改标签)',		//发微博
	        9005=>'del_tag (删除标签)',//删除标签
	        	
	        9006=>'add_ad (添加广告)',//添加广告
	        9007=>'get_ad_list (获取广告列表)',//获取广告列表
	        9008=>'getAdById (获取广告详细内容)',//获取广告详细内容
	        9009=>'update_ad (修改广告)',//修改广告
	        9010=>'del_ad (删除广告)',//删除广告
	    ),
	    'share'=>array(//分享、收藏
	        10000=>'add_share(添加站内分享)',			//添加分享
	        10001=>'get_share_list(站内分享列表)',		//获取分享列表
	        10002=>'get_share_by_share_id(获取指定分享)',//获取指定分享
	        10003=>'update_share(修改分享)',			//修改分享
	        10004=>'del_share(删除分享)',				//删除分享
	        	
	        10005=>'add_collect(添加收藏)',				//添加收藏
	        10006=>'get_collect_list(收藏列表)',				//收藏列表
	        10007=>'get_collect_by_collect_id(获取指定收藏信息)',	//收藏信息
	        10008=>'update_collect(修改收藏)',				//修改收藏
	        10009=>'del_collect(删除收藏)',				//删除收藏
	    ),
	    'rental'=>array(//租赁、拼车
	        11001=>array(
	            'api'=>'Api/Rental/get_rental_list','title'=>'get_rental_list获取租赁列表','description'=>'get_rental_list(获取租赁列表)',
	            'parameters'=>array(
	                array('name'=>'name','required'=>1,'default_value'=>'无名称','description'=>'*汽车名称、租用标题|例如：本田xxx，圣诞节只需390元一天'),
	                array('name'=>'category_id','required'=>0,'default_value'=>'','description'=>'分类'),
	                array('name'=>'owner_store_id','required'=>0,'default_value'=>'','description'=>'所有者商家ID(如果事商家的话),没有请留空'),
	                array('name'=>'owner_user_id','required'=>0,'default_value'=>'','description'=>'所有者用户ID(如果是用户的话),没有请留空'),
	                array('name'=>'owner_name','required'=>0,'default_value'=>'','description'=>'出租者显示名称，没有请留空|例如：陈先生、李小姐'),
	                array('name'=>'rental_price','required'=>1,'default_value'=>'','description'=>'出租单价|以time_unit的单位价格，如果time_unit是月，rental_price是1800，就是每月1800元'),
// 	                array('name'=>'time_unit','required'=>1,'default_value'=>'','description'=>'价格时间单位|月、日、周、年'),
	                array('name'=>'mini_rental_time_unit','required'=>0,'default_value'=>'','description'=>'最少出租时间单位'),
	                array('name'=>'max_rental_time_unit','required'=>0,'default_value'=>'','description'=>'最多出租时间'),
	                array('name'=>'earnest_money','required'=>0,'default_value'=>'0','description'=>'定金'),
// 	                array('name'=>'rental_begin_time','required'=>0,'default_value'=>'','description'=>'出租开始时间'),
// 	                array('name'=>'rental_end_time','required'=>0,'default_value'=>'','description'=>'出租结束时间'),
	                array('name'=>'stauts','required'=>0,'default_value'=>'1','description'=>'是否开放|1:正常'),
	                array('name'=>'production_time','required'=>0,'default_value'=>'','description'=>'生产日期'),
	                array('name'=>'start_use_time','required'=>0,'default_value'=>'','description'=>'房子|汽车|人|场地|飞机等开始使用时间'),
	            ),
	        ),
	        11002=>array(
	            'api'=>'Api/Rental/get_rental_info','title'=>'get_rental_info获取租赁详细信息','description'=>'get_rental_info(获取租赁详细信息)',
	            'parameters'=>array(
	                array('name'=>'rental_id','required'=>1,'default_value'=>'1','description'=>'rental_id'),
	                array('name'=>'isdetail','required'=>0,'default_value'=>'0','description'=>'是否详细'),
	            ),
	        ),
	        11003=>array(
	            'api'=>'Api/Rental/add_rental','title'=>'add_rental添加租赁信息(租车、租房、租飞机、主场地)','description'=>'add_rental(添加租赁信息(租车、租房、租飞机、主场地))',
	            'parameters'=>array(
	                array('name'=>'name','required'=>1,'default_value'=>'无名称','description'=>'*汽车名称、租用标题|例如：本田xxx，圣诞节只需390元一天'),
	                array('name'=>'category_id','required'=>0,'default_value'=>'','description'=>'分类'),
	                array('name'=>'owner_store_id','required'=>0,'default_value'=>'','description'=>'所有者商家ID(如果事商家的话),没有请留空'),
	                array('name'=>'owner_user_id','required'=>0,'default_value'=>'','description'=>'所有者用户ID(如果是用户的话),没有请留空'),
	                array('name'=>'owner_name','required'=>0,'default_value'=>'','description'=>'出租者显示名称，没有请留空|例如：陈先生、李小姐'),
	                array('name'=>'rental_price','required'=>1,'default_value'=>'','description'=>'出租单价|以time_unit的单位价格，如果time_unit是月，rental_price是1800，就是每月1800元'),
	                array('name'=>'time_unit','required'=>1,'default_value'=>'','description'=>'价格时间单位|月、日、周、年'),
	                array('name'=>'mini_rental_time_unit','required'=>0,'default_value'=>'','description'=>'最少出租时间单位'),
	                array('name'=>'max_rental_time_unit','required'=>0,'default_value'=>'','description'=>'最多出租时间'),
	                array('name'=>'earnest_money','required'=>0,'default_value'=>'0','description'=>'定金'),
	                // 	                array('name'=>'rental_begin_time','required'=>0,'default_value'=>'','description'=>'出租开始时间'),
	            // 	                array('name'=>'rental_end_time','required'=>0,'default_value'=>'','description'=>'出租结束时间'),
	                array('name'=>'stauts','required'=>0,'default_value'=>'1','description'=>'是否开放|1:正常'),
	                array('name'=>'production_time','required'=>0,'default_value'=>'','description'=>'生产日期'),
	                array('name'=>'start_use_time','required'=>0,'default_value'=>'','description'=>'房子|汽车|人|场地|飞机等开始使用时间'),
	                array('name'=>'image1','file'=>1,'required'=>0,'description'=>'图片1'),
	                array('name'=>'image2','file'=>1,'required'=>0,'description'=>'图片2'),
	                array('name'=>'image3','file'=>1,'required'=>0,'description'=>'图片3'),
	                array('name'=>'video1','file'=>1,'required'=>0,'description'=>'视频1'),
	            ),
	        ),
	        11004=>array(
	            'api'=>'Api/Rental/update_rental','title'=>'update_rental修改租赁信息(租车、租房、租飞机、主场地)','description'=>'update_rental(修改租赁信息)',
	            'parameters'=>array(
	                array('name'=>'rental_id','required'=>1,'default_value'=>'1','description'=>'rental_id'),
	                array('name'=>'name','required'=>1,'default_value'=>'无名称','description'=>'*汽车名称、租用标题|例如：本田xxx，圣诞节只需390元一天'),
	                array('name'=>'category_id','required'=>0,'default_value'=>'','description'=>'分类'),
	                array('name'=>'owner_store_id','required'=>0,'default_value'=>'','description'=>'所有者商家ID(如果事商家的话),没有请留空'),
	                array('name'=>'owner_user_id','required'=>0,'default_value'=>'','description'=>'所有者用户ID(如果是用户的话),没有请留空'),
	                array('name'=>'owner_name','required'=>0,'default_value'=>'','description'=>'出租者显示名称，没有请留空|例如：陈先生、李小姐'),
	                array('name'=>'rental_price','required'=>1,'default_value'=>'','description'=>'出租单价|以time_unit的单位价格，如果time_unit是月，rental_price是1800，就是每月1800元'),
	                array('name'=>'time_unit','required'=>1,'default_value'=>'','description'=>'价格时间单位|月、日、周、年'),
	                array('name'=>'mini_rental_time_unit','required'=>0,'default_value'=>'','description'=>'最少出租时间单位'),
	                array('name'=>'max_rental_time_unit','required'=>0,'default_value'=>'','description'=>'最多出租时间'),
	                array('name'=>'earnest_money','required'=>0,'default_value'=>'0','description'=>'定金'),
	                array('name'=>'stauts','required'=>0,'default_value'=>'1','description'=>'是否开放|1:正常'),
	                array('name'=>'production_time','required'=>0,'default_value'=>'','description'=>'生产日期'),
	                array('name'=>'start_use_time','required'=>0,'default_value'=>'','description'=>'房子|汽车|人|场地|飞机等开始使用时间'),
	                array('name'=>'image1','file'=>1,'required'=>0,'description'=>'图片1'),
	                array('name'=>'image2','file'=>1,'required'=>0,'description'=>'图片2'),
	                array('name'=>'image3','file'=>1,'required'=>0,'description'=>'图片3'),
	                array('name'=>'video1','file'=>1,'required'=>0,'description'=>'视频1'),
	            ),
	        ),
	        11005=>'get_carpool_list(获取拼车列表)',
	        11006=>'get_carpool_info(获取拼车详细信息)',
	        11007=>'add_carpool(添加拼车)',
	        11008=>'update_carpool(修改拼车详细信息)',
	        11009=>'join_carpool(加入拼车)',
	        11010=>'quit_carpool(退出拼车)',
	        11011=>array(
	            'api'=>'Api/Rental/rental','title'=>'rental租用(租车、租房、租飞机、主场地)','description'=>'rental(租用)',
	            'parameters'=>array(
	                array('name'=>'rental_id','required'=>1,'default_value'=>'1','description'=>'rental_id出租id'),
	                array('name'=>'user_id','required'=>1,'default_value'=>'1','description'=>'user_id用户id'),
	                array('name'=>'rental_begin_time','required'=>1,'default_value'=>'1','description'=>'租用开始时间'),
	                array('name'=>'rental_end_time','required'=>1,'default_value'=>'1','description'=>'租用结束时间'),
	            ),
	        ),//租了某个时间段
	        11013=>array(
	            'api'=>'Api/Rental/del_rental','title'=>'del_rental租用删除出租','description'=>'del_rental(删除出租)',
	            'parameters'=>array(
	                array('name'=>'rental_id','required'=>1,'default_value'=>'1','description'=>'rental_id出租id'),
	            ),
	        ),//删除出租
	        11014=>array(
	            'api'=>'Api/Rental/add_rental_category','title'=>'add_rental_category租赁分类|租车、租房、租飞机','description'=>'add_rental_category(租赁分类|租车、租房、租飞机)',
	            'parameters'=>array(
	                array('name'=>'user_id','required'=>0,'default_value'=>'0','description'=>'用户id'),
	                array('name'=>'store_id','required'=>0,'default_value'=>'0','description'=>'商家id'),
	                array('name'=>'name','required'=>1,'default_value'=>'','description'=>'分类名称|如租车、租飞机'),
	                array('name'=>'sort','required'=>1,'default_value'=>'','description'=>'分类排序'),
	                array('name'=>'status','required'=>0,'default_value'=>'1','description'=>'状态'),
	            ),
	        ),//添加出租分类
	        11014=>array(
	            'api'=>'Api/Rental/update_rental_category','title'=>'update_rental_category修改租赁分类|租车、租房、租飞机','description'=>'update_rental_category(修改租赁分类|租车、租房、租飞机)',
	            'parameters'=>array(
	                array('name'=>'category_id','required'=>1,'default_value'=>'0','description'=>'分类id'),
	                array('name'=>'user_id','required'=>0,'default_value'=>'','description'=>'用户id'),
	                array('name'=>'store_id','required'=>0,'default_value'=>'','description'=>'商家id'),
	                array('name'=>'name','required'=>1,'default_value'=>'','description'=>'分类名称|如租车、租飞机'),
	                array('name'=>'sort','required'=>1,'default_value'=>'','description'=>'分类排序'),
	                array('name'=>'status','required'=>0,'default_value'=>'1','description'=>'状态'),
	            ),
	        ),//修改出租分类
	        11015=>array(
	            'api'=>'Api/Rental/get_rental_category_list','title'=>'get_rental_category_list租赁分类列表|租车、租房、租飞机','description'=>'get_rental_category_list(租赁分类列表|租车、租房、租飞机)',
	            'parameters'=>array(
	                array('name'=>'user_id','required'=>0,'default_value'=>'0','description'=>'用户id'),
	                array('name'=>'store_id','required'=>0,'default_value'=>'0','description'=>'商家id'),
	                array('name'=>'name','required'=>1,'default_value'=>'','description'=>'分类名称|如租车、租飞机'),
	                array('name'=>'status','required'=>0,'default_value'=>'1','description'=>'状态'),
	            ),
	        ),//获取出租分类列表
	        11016=>array(
	            'api'=>'Api/Rental/del_rental_category','title'=>'del_rental_category删除出租分类','description'=>'del_rental_category(删除出租分类)',
	            'parameters'=>array(
	                array('name'=>'category_id','required'=>1,'default_value'=>'1','description'=>'分类id'),
	            ),
	        ),//删除出租分类
	        11017=>array(
	            'api'=>'Api/Rental/get_rental_category_info','title'=>'get_rental_category_info指定租赁分类详细信息','description'=>'get_rental_category_info(指定租赁分类详细信息)',
	            'parameters'=>array(
	                array('name'=>'category_id','required'=>1,'default_value'=>'1','description'=>'分类id'),
	            ),
	        ),//出租详细分类
	    ),
	    'building'=>array(
	        12020=>array(
	            'api'=>'Api/Building/get_building_house_type_info','title'=>'get_house_type_info获取户型','description'=>'get_house_type_info(获取户型信息)',
	            'parameters'=>array(
	                array('name'=>'building_house_type_id','required'=>1,'default_value'=>'0','description'=>'户型id'),
	            ),
	        ),
	        12021=>array(
	            'api'=>'Api/Building/add_building_house_type','title'=>'add_building_house_type添加户型','description'=>'add_building_house_type(添加户型)',
	            'parameters'=>array(
	                array('name'=>'name','required'=>1,'default_value'=>'1','description'=>'户型名称'),
	                array('name'=>'city_id','required'=>0,'default_value'=>'1','description'=>'城市ID'),
	                array('name'=>'price','required'=>0,'default_value'=>'0','description'=>'户型价格'),
	                array('name'=>'area','required'=>0,'default_value'=>'1','description'=>'面积'),
	                array('name'=>'toward','required'=>0,'options'=>array('1'=>'东','2'=>'西','3'=>'南','4'=>'北','5'=>'东北','6'=>'东南','7'=>'西北','8'=>'西南',),'default_value'=>'1','description'=>'户型朝向|1东、2西、3南、4北、5东北、6东南、7西北、8西南'),
	                array('name'=>'content','required'=>0,'default_value'=>'1','description'=>'户型介绍'),
	                array('name'=>'room_number','required'=>1,'default_value'=>'3','description'=>'房间数'),
	                array('name'=>'living_room_number','required'=>0,'default_value'=>'1','description'=>'客厅数'),
	                array('name'=>'toilet_number','required'=>0,'default_value'=>'1','description'=>'洗手间数'),
	                array('name'=>'is_decoration','required'=>0,'default_value'=>'0','description'=>'是否装修'),
	            ),
	        ),
            12022=>array(
                'api'=>'Api/Building/get_building_house_type_list','title'=>'get_building_house_type获取户型列表','description'=>'get_building_house_type(获取户型列表)',
                'parameters'=>array(
                    array('name'=>'city_id','required'=>0,'default_value'=>'1','description'=>'城市ID'),
                    array('name'=>'price','required'=>0,'default_value'=>'0','description'=>'户型价格'),
                    array('name'=>'area','required'=>0,'default_value'=>'1','description'=>'面积'),
                    array('name'=>'toward','required'=>0,'options'=>array('1'=>'东','2'=>'西','3'=>'南','4'=>'北','5'=>'东北','6'=>'东南','7'=>'西北','8'=>'西南',),'default_value'=>'1','description'=>'户型朝向|1东、2西、3南、4北、5东北、6东南、7西北、8西南'),
                    array('name'=>'room_number','required'=>1,'default_value'=>'3','description'=>'房间数'),
                    array('name'=>'living_room_number','required'=>0,'default_value'=>'1','description'=>'客厅数'),
                    array('name'=>'toilet_number','required'=>0,'default_value'=>'1','description'=>'洗手间数'),
                    array('name'=>'is_decoration','required'=>0,'default_value'=>'0','description'=>'是否装修'),
                ),
            ),
            12023=>array(
                'api'=>'Api/Building/update_building_house_type','title'=>'update_building_house_type修改户型','description'=>'update_building_house_type(修改户型)',
                'parameters'=>array(
                    array('name'=>'building_house_type_id','required'=>1,'default_value'=>'1','description'=>'户型id'),
                    array('name'=>'name','required'=>1,'default_value'=>'1','description'=>'户型名称'),
                    array('name'=>'city_id','required'=>0,'default_value'=>'1','description'=>'城市ID'),
                    array('name'=>'price','required'=>0,'default_value'=>'0','description'=>'户型价格'),
                    array('name'=>'area','required'=>0,'default_value'=>'1','description'=>'面积'),
                    array('name'=>'toward','required'=>0,'options'=>array('1'=>'东','2'=>'西','3'=>'南','4'=>'北','5'=>'东北','6'=>'东南','7'=>'西北','8'=>'西南',),'default_value'=>'1','description'=>'户型朝向|1东、2西、3南、4北、5东北、6东南、7西北、8西南'),
                    array('name'=>'content','required'=>0,'default_value'=>'1','description'=>'户型介绍'),
                    array('name'=>'room_number','required'=>1,'default_value'=>'3','description'=>'房间数'),
                    array('name'=>'living_room_number','required'=>0,'default_value'=>'1','description'=>'客厅数'),
                    array('name'=>'toilet_number','required'=>0,'default_value'=>'1','description'=>'洗手间数'),
                    array('name'=>'is_decoration','required'=>0,'default_value'=>'0','description'=>'是否装修'),
                ),
            ),
            12024=>array(
                'api'=>'Api/Building/delete_house_type','title'=>'delete_house_type删除户型','description'=>'delete_house_type(删除户型信息)',
                'parameters'=>array(
                    array('name'=>'building_house_type_id','required'=>1,'default_value'=>'0','description'=>'户型id'),
                ),
            ),
         ),
	    'api_partner'=>array(
	        18001=>array(
	            'api'=>'Api/Api_partner/add_partner','title'=>'add_partner添加合作伙伴','description'=>'add_partner(添加合作伙伴)',
    	        'parameters'=>array(
    	            array('name'=>'username','required'=>1,'default_value'=>'','description'=>'合作伙伴(1600开头,如16080000009)'),
    	            array('name'=>'password','required'=>1,'default_value'=>'','description'=>'登录密码'),
    	            array('name'=>'name','required'=>1,'default_value'=>'','description'=>'第三方名称'),
    	            array('name'=>'user_id','required'=>1,'default_value'=>'','description'=>'所属用户'),
    	            array('name'=>'type','required'=>1,'default_value'=>'','description'=>'类型'),
    	            array('name'=>'mobile','required'=>1,'default_value'=>'','description'=>'负责人电话'),
    	            array('name'=>'remark','required'=>1,'default_value'=>'','description'=>'备注'),
    	            array('name'=>'city_id','required'=>1,'default_value'=>'','description'=>'所在城市'),
    	            array('name'=>'status','required'=>1,'default_value'=>'','description'=>'状态|1正常,2禁止,3黑名单,4删除'),
    	        ),
	    ),
	        18002=>array(
	            'api'=>'Api/Api_partner/reset_password','title'=>'add_partner密码重置','description'=>'reset_password(密码重置)',
	            'parameters'=>array(
	                array('name'=>'username','required'=>1,'default_value'=>'','description'=>'合作伙伴(1600开头,如16080000009)'),
	                array('name'=>'new_password','required'=>1,'default_value'=>'','description'=>'新密码'),
	                array('name'=>'old_password','required'=>1,'default_value'=>'','description'=>'旧密码'),
	            ),
	        ),
	        18003=>array(
	            'api'=>'Api/Api_partner/check_partner','title'=>'check_partner添加合作伙伴','description'=>'check_partner(验证第三方合法性)',
	            'parameters'=>array(
	                array('name'=>'username','required'=>1,'default_value'=>'','description'=>'合作伙伴(1600开头,如16080000009)'),
	                array('name'=>'secret_code','required'=>1,'default_value'=>'','description'=>'secret_code'),
	                array('name'=>'password','required'=>1,'default_value'=>'','description'=>'password'),
	            )
	        ),
	        18004=>array(
	            'api'=>'Api/Api_partner/get_partner_list','title'=>'get_partner_list获取合作伙伴列表','description'=>'get_partner_list(获取合作伙伴列表)',
	            'parameters'=>array(
    	            array('name'=>'user_id','required'=>1,'default_value'=>'','description'=>'所属用户'),
    	            array('name'=>'type','required'=>0,'default_value'=>'','description'=>'类型'),
    	            array('name'=>'mobile','required'=>0,'default_value'=>'','description'=>'负责人电话'),
    	            array('name'=>'city_id','required'=>0,'default_value'=>'','description'=>'所在城市'),
    	            array('name'=>'status','required'=>0,'default_value'=>'','description'=>'状态|1正常,2禁止,3黑名单,4删除'),
	            ),
	        ),
	    ),
	    'toll'=>array(
	        19001=>array(
	            'api'=>'Api/Toll/add_toll','title'=>'add_toll添加缴费','description'=>'add_toll(添加缴费)',
	            'parameters'=>array(
	                array('name'=>'type','required'=>1,'options'=>array('0'=>'请选择类型','1'=>'水费1','2'=>'电费2','3'=>'房租费3','4'=>'伙食费4','5'=>'蔬菜5','6'=>'燃气6','7'=>'车位费7','8'=>'物业费8','100'=>'其他费用100',),'description'=>'缴费类型'),
	                array('name'=>'price_strategy','required'=>0,'default_value'=>'','description'=>'价格策略'),
	                array('name'=>'user_id','required'=>1,'default_value'=>'0','description'=>'要缴费的用户'),
	                array('name'=>'time_period','required'=>1,'default_value'=>'0','description'=>'时间段'),
	                array('name'=>'user_amount_or_number','required'=>1,'default_value'=>'','description'=>'使用量'),
	                array('name'=>'responsible_person','required'=>1,'default_value'=>'','description'=>'负责人，核对人，抄表员'),
	                array('name'=>'add_userid','required'=>1,'default_value'=>'','description'=>'添加者ID'),
	                array('name'=>'serial_number','required'=>0,'default_value'=>'','description'=>'编号|房间号、宿舍等，如：17-507'),
	            ),
	        ),
	        19002=>array(
	            'api'=>'Api/Toll/get_toll_list','title'=>'get_toll_list获取缴费列表','description'=>'get_toll_list(获取缴费列表)',
	            'parameters'=>array(
	                array('name'=>'type','required'=>1,'options'=>array('0'=>'请选择类型','1'=>'水费1','2'=>'电费2','3'=>'房租费3','4'=>'伙食费4','5'=>'蔬菜5','6'=>'燃气6','7'=>'车位费7','8'=>'物业费8','100'=>'其他费用100',),'description'=>'缴费类型'),
	                array('name'=>'price_strategy','required'=>0,'default_value'=>'','description'=>'价格策略'),
	                array('name'=>'user_id','required'=>1,'default_value'=>'0','description'=>'要缴费的用户'),
// 	                array('name'=>'time_period','required'=>1,'default_value'=>'0','description'=>'时间段'),
// 	                array('name'=>'user_amount_or_number','required'=>1,'default_value'=>'','description'=>'使用量'),
// 	                array('name'=>'responsible_person','required'=>1,'default_value'=>'','description'=>'负责人，核对人，抄表员'),
	                array('name'=>'add_userid','required'=>1,'default_value'=>'','description'=>'添加者ID'),
// 	                array('name'=>'serial_number','required'=>0,'default_value'=>'','description'=>'编号|房间号、宿舍等，如：17-507'),
	            ),
	        ),
	        19003=>array(
	            'api'=>'Api/Toll/get_toll_by_id','title'=>'get_toll_by_id获取缴费列表','description'=>'get_toll_by_id(获取缴费单详细信息)',
	            'parameters'=>array(
	                array('name'=>'toll_id','required'=>1,'default_value'=>'0','description'=>'ID'),
	            ),
	        ),
	        19004=>array(
	            'api'=>'Api/Toll/update_toll','title'=>'update_toll修改详细信息','description'=>'update_toll(修改详细信息)',
	            'parameters'=>array(
	                array('name'=>'toll_id','required'=>1,'default_value'=>'0','description'=>'ID'),
	                array('name'=>'type','required'=>0,'options'=>array('0'=>'请选择类型','1'=>'水费1','2'=>'电费2','3'=>'房租费3','4'=>'伙食费4','5'=>'蔬菜5','6'=>'燃气6','7'=>'车位费7','8'=>'物业费8','100'=>'其他费用100',),'description'=>'缴费类型'),
	                array('name'=>'price_strategy','required'=>0,'default_value'=>'','description'=>'价格策略'),
	                array('name'=>'user_id','required'=>0,'default_value'=>'0','description'=>'要缴费的用户'),
	                array('name'=>'time_period','required'=>0,'default_value'=>'0','description'=>'时间段'),
	                array('name'=>'user_amount_or_number','required'=>0,'default_value'=>'','description'=>'使用量'),
	                array('name'=>'responsible_person','required'=>0,'default_value'=>'','description'=>'负责人，核对人，抄表员'),
	                array('name'=>'add_userid','required'=>0,'default_value'=>'','description'=>'添加者ID'),
	                array('name'=>'serial_number','required'=>0,'default_value'=>'','description'=>'编号|房间号、宿舍等，如：17-507'),
	            ),
	        ),
	        19005=>array(
	            'api'=>'Api/Toll/add_price_strategy','title'=>'add_price_strategy添加价格策略','description'=>'add_price_strategy(添加价格策略)',
	            'parameters'=>array(
	                array('name'=>'user_id：','required'=>1,'default_value'=>'0','description'=>'所属用户'),
	                array('name'=>'name','required'=>1,'default_value'=>'0','description'=>'价格策略名称'),
	                array('name'=>'remark','required'=>1,'default_value'=>'0','description'=>'备注'),
	                array('name'=>'low_price','required'=>1,'default_value'=>'0','description'=>'最低价'),
	                array('name'=>'standard_price','required'=>1,'default_value'=>'0','description'=>'标准价'),
	                array('name'=>'up_settlement_price','required'=>1,'default_value'=>'0','description'=>'对上结算价'),
	                array('name'=>'down_settlement_price','required'=>1,'default_value'=>'0','description'=>'对下结算价'),
	                array('name'=>'discounts','required'=>1,'default_value'=>'0','description'=>'折扣|0.7，0.8'),
	                array('name'=>'formula','required'=>1,'options'=>array('0'=>'请选择价格策略','1'=>'最低价（low_price）1','2'=>'标准价（standard_price）2','3'=>'对上结算价（down_settlement_price）3','4'=>'对下结算价（up_settlement_price）4','5'=>'标准折扣价（standard_price*discounts ）5',),'description'=>'计算公式'),
	                array('name'=>'unit_price','required'=>1,'default_value'=>'0','description'=>'单价'),
	                array('name'=>'time_unit','required'=>1,'default_value'=>'0','description'=>'时间单位'),
	                array('name'=>'currency_unit','required'=>1,'default_value'=>'0','description'=>'货币单位'),
	                array('name'=>'number_unit','required'=>1,'default_value'=>'0','description'=>'数量单位|度，个，'),
	                array('name'=>'begin_time','required'=>1,'default_value'=>'0','description'=>'开始时间'),
	                array('name'=>'end_time','required'=>1,'default_value'=>'0','description'=>'结束时间'),
	            ),
	        ),
	        19006=>array(
	            'api'=>'Api/Toll/get_price_strategy_list','title'=>'get_price_strategy_list获取价格策略列表','description'=>'get_price_strategy_list(获取价格策略列表)',
	            'parameters'=>array(
	                array('name'=>'user_id','required'=>1,'default_value'=>'0','description'=>'所属用户'),
	                array('name'=>'name','required'=>1,'default_value'=>'0','description'=>'价格策略名称'),
// 	                array('name'=>'remark','required'=>1,'default_value'=>'0','description'=>'备注'),
// 	                array('name'=>'low_price','required'=>1,'default_value'=>'0','description'=>'最低价'),
// 	                array('name'=>'standard_price','required'=>1,'default_value'=>'0','description'=>'标准价'),
// 	                array('name'=>'up_settlement_price','required'=>1,'default_value'=>'0','description'=>'对上结算价'),
// 	                array('name'=>'down_settlement_price','required'=>1,'default_value'=>'0','description'=>'对下结算价'),
	                array('name'=>'discounts','required'=>1,'default_value'=>'0','description'=>'折扣|0.7，0.8'),
	                array('name'=>'formula','required'=>1,'options'=>array('0'=>'请选择价格策略','1'=>'最低价（low_price）1','2'=>'标准价（standard_price）2','3'=>'对上结算价（down_settlement_price）3','4'=>'对下结算价（up_settlement_price）4','5'=>'标准折扣价（standard_price*discounts ）5',),'description'=>'计算公式'),
	                array('name'=>'unit_price','required'=>1,'default_value'=>'0','description'=>'单价'),
// 	                array('name'=>'time_unit','required'=>1,'default_value'=>'0','description'=>'时间单位'),
// 	                array('name'=>'currency_unit','required'=>1,'default_value'=>'0','description'=>'货币单位'),
	                array('name'=>'number_unit','required'=>1,'default_value'=>'0','description'=>'数量单位|度，个，'),
	                array('name'=>'begin_time','required'=>1,'default_value'=>'0','description'=>'开始时间'),
	                array('name'=>'end_time','required'=>1,'default_value'=>'0','description'=>'结束时间'),
	            ),
	        ),
	        19007=>array(
	            'api'=>'Api/Toll/get_price_strategy_by_id','title'=>'get_price_strategy_by_id获取价格策略信息','description'=>'get_price_strategy_by_id(获取价格策略信息)',
	            'parameters'=>array(
	                array('name'=>'price_strategy_id','required'=>1,'default_value'=>'0','description'=>'ID'),
	            ),
	        ),
	        19008=>array(
	            'api'=>'Api/Toll/update_price_strategy','title'=>'update_price_strategy修改价格策略','description'=>'update_price_strategy(修改价格策略)',
	            'parameters'=>array(
	                array('name'=>'price_strategy_id','required'=>1,'default_value'=>'0','description'=>'ID'),
	                array('name'=>'user_id：','required'=>1,'default_value'=>'0','description'=>'所属用户'),
	                array('name'=>'name','required'=>1,'default_value'=>'0','description'=>'价格策略名称'),
	                array('name'=>'remark','required'=>1,'default_value'=>'0','description'=>'备注'),
	                array('name'=>'low_price','required'=>1,'default_value'=>'0','description'=>'最低价'),
	                array('name'=>'standard_price','required'=>1,'default_value'=>'0','description'=>'标准价'),
	                array('name'=>'up_settlement_price','required'=>1,'default_value'=>'0','description'=>'对上结算价'),
	                array('name'=>'down_settlement_price','required'=>1,'default_value'=>'0','description'=>'对下结算价'),
	                array('name'=>'discounts','required'=>1,'default_value'=>'0','description'=>'折扣|0.7，0.8'),
	                array('name'=>'formula','required'=>1,'options'=>array('0'=>'请选择价格策略','1'=>'最低价（low_price）1','2'=>'标准价（standard_price）2','3'=>'对上结算价（down_settlement_price）3','4'=>'对下结算价（up_settlement_price）4','5'=>'标准折扣价（standard_price*discounts ）5',),'description'=>'计算公式'),
	                array('name'=>'unit_price','required'=>1,'default_value'=>'0','description'=>'单价'),
	                array('name'=>'time_unit','required'=>1,'default_value'=>'0','description'=>'时间单位'),
	                array('name'=>'currency_unit','required'=>1,'default_value'=>'0','description'=>'货币单位'),
	                array('name'=>'number_unit','required'=>1,'default_value'=>'0','description'=>'数量单位|度，个，'),
	                array('name'=>'begin_time','required'=>1,'default_value'=>'0','description'=>'开始时间'),
	                array('name'=>'end_time','required'=>1,'default_value'=>'0','description'=>'结束时间'),
	            ),
	        ),
	
	    ),
	    'friend'=>array(
	        20000=>array(
	            'api'=>'Api/Friend/get_community_member','title'=>'get_community_member修改价格策略','description'=>'(好友)get_community_member(获取社区内的成员列表)',
	            'parameters'=>array(
	                array('name'=>'community_id','required'=>1,'default_value'=>'0','description'=>'社区ID'),
	                array('name'=>'city_id','required'=>1,'default_value'=>'0','description'=>'城市id|同城用户'),
	                array('name'=>'district_id','required'=>1,'default_value'=>'0','description'=>'对应district表的 行政区的id|如天河区'),
	            ),
	        ),
	        20001=>array(
	            'api'=>'Api/Friend/get_friends','title'=>'get_friends获取好友员列表','description'=>'(好友)get_friends(获取好友员列表)',
	            'parameters'=>array(
	                array('name'=>'user_id','required'=>1,'default_value'=>'0','description'=>'用户id'),
	                array('name'=>'friend_category_id','required'=>1,'default_value'=>'0','description'=>'分组id'),
	            ),
	        ),
	        20002=>array(
	            'api'=>'Api/Friend/get_system_friend_category_list','title'=>'get_system_friend_category_list获取好友员列表','description'=>'(好友)get_system_friend_category_list(获取系统分组列表)',
	            'parameters'=>array(
	                array('name'=>'user_id','required'=>1,'default_value'=>'0','description'=>'无需参数'),
	            ),
	        ),
	        20003=>array(
	            'api'=>'Api/Friend/get_friend_category_list','title'=>'get_friend_category_list获取好友分组列表(请先调用20002获取系统分组)','description'=>'(好友)get_friend_category_list(获取好友分组列表(请先调用20002获取系统分组))',
	            'parameters'=>array(
	                array('name'=>'user_id','required'=>1,'default_value'=>'0','description'=>'用户id'),
	            ),
	        ),
	        20004=>array(
	            'api'=>'Api/Friend/add_friend','title'=>'add_friend获(好友)add_friend(添加好友)','description'=>'(好友)add_friend(添加好友)',
	            'parameters'=>array(
	                array('name'=>'user_id','required'=>1,'default_value'=>'0','description'=>'用户id'),
	                array('name'=>'friend_user_id','required'=>1,'default_value'=>'0','description'=>'好友ID'),
	                array('name'=>'friend_category_id','required'=>0,'default_value'=>'0','description'=>'好友分类ID(20002,20003接口获取)'),
	                array('name'=>'friend_remark_name','required'=>0,'default_value'=>'0','description'=>'好友名称备注'),
	                array('name'=>'remark','required'=>0,'default_value'=>'0','description'=>'好友备注|如华联2015级动漫小师妹'),
	                array('name'=>'friend_user_sort','required'=>0,'default_value'=>'0','description'=>'排序'),
	                array('name'=>'friend_user_status','required'=>0,'default_value'=>'0','description'=>'好友状态|0：黑名单，1：正常'),
	            ),
	        ),
	        20005=>array(
	            'api'=>'Api/Friend/send_message','title'=>'send_message获发送消息','description'=>'(消息)send_message(发送消息)',
	            'parameters'=>array(
// 	                array('name'=>'from_site','required'=>1,'default_value'=>'0','description'=>'来自那个网站'),
// 	                array('name'=>'to_site','required'=>1,'default_value'=>'0','description'=>'发去哪个网站'),
// 	                array('name'=>'api_partner_id','required'=>0,'default_value'=>'0','description'=>'第三方合作伙伴'),
	                array('name'=>'from_user_id','required'=>0,'default_value'=>'0','description'=>'发送者id'),
	                array('name'=>'to_user_id','required'=>0,'default_value'=>'0','description'=>'接收者id'),
	                array('name'=>'title','required'=>0,'default_value'=>'0','description'=>'标题'),
	                array('name'=>'message_content','required'=>0,'default_value'=>'0','description'=>'消息内容'),
	                array('name'=>'is_read','required'=>0,'default_value'=>'0','description'=>'是否已读'),
	                array('name'=>'theme','required'=>0,'default_value'=>'0','description'=>'消息主题、气泡、外框'),
	            ),
	        ),
	        20006=>'(消息)get_message_list(获取消息列表)',
	        20007=>'(消息)del_message(删除消息)',
	        20008=>'(好友)add_blacklist(添加黑名单)',
	        20009=>'(好友)set_friend_user_status_delete(删除好友)',
	        	
	        20010=>'(约会)add_appointment(发布约会、预约)',
	        20011=>'(约会)get_appointment_list(约会、预约列表)',
	        20012=>'(约会)getAppointmentById(获取约会、预约详细信息)',
	        20013=>'(约会)update_appointment(修改约会、预约)',
	        20014=>'(约会)del_appointment(删除约会、预约)',
	        20015=>'(约会)apply_appointment(报名约会)',
	        	
	        20016=>'(群)add_group(创建群、组、班级、系)',
	        20017=>'(群)join_group(加群)',
	        20018=>'(群)exit_group(退群)',
	        20019=>'(群)get_group(群(组)详细信息)',
	        20020=>'(群)get_group_list(群(组)列表|搜索群)',
	        20021=>'(群)update_groupById(修改群信息)',
	        20022=>'(群)del_group(解散群)',
	        20023=>'(群)get_group_user(群成员列表)',
	        20024=>'(群消息)send_group_message(发送群消息)',
	        20025=>'(群消息)get_group_message_list(群消息列表)',
	        20026=>'(群消息)del_group_message(删除群消息)',
	
	        // 				20029=>'(记录)add_visit_log(添加访问记录)',
	        20030=>'(记录)get_visit_list(获取访问记录列表)',
	        // 				20031=>'(记录)get_visit_by_id(获取一个访问记录)',
	    // 				20032=>'(记录)update_visit_log(修改访问记录)',
	    // 				20033=>'(记录)del_visit_log(删除访问记录)',
	
	        20036=>'find_jba(找师妹、找师兄)',
	    ),
	    'file'=>array(
	        21001=>'upload_file(上传文件)',
	        21002=>'get_file_list(获取文件列表)',
	        21003=>'get_file_by_id(获取文件信息)',
	        21004=>'update_file(修改文件)',
	        21005=>'del_file(删除文件)',
	    ),
	    'yocms_widget'=>array(
	        22001=>'get_wdiget(获取小部件)',
	    ),
	    'analog_applications'=>array(//模拟应用
	        80000=>'Yo(大型综合应用)',
	        80001=>'Yo(社区、学校应用)',
	        80002=>'Yo(家常菜谱应用)',
	        80003=>'Yo(sns(社交)应用)',
	        80004=>'Yo(b2c应用)',
	        80005=>'Yo(租赁应用(租房、租车、租模特女友男友、借书、租场地、租.))',
	        80006=>'Yo(相片分享)',
	        80007=>'Yo(门户网站)',
	        80008=>'Yo(应用)',
	        81000=>'Yo仿糗事百科 www.qiushibaike.com',
	        81001=>'Yo仿饿了么http://v5.ele.me',
	        81002=>'Yo仿艾瑞网 www.iresearch.cn',
	        81003=>'Yo点评网站',
	        81004=>'Yo问答网站',
	        81005=>'仿猪八戒',
	        81006=>'YO果壳网(科学)',
	        81007=>'YO硬蛋网(硬件创意科学)',
	        81008=>'Yo网址导航(hao123.com)',
	        81009=>'Yo企业网站',
	        81010=>'Yo同学帮帮忙(校园应用)',
	        81011=>'下厨房(http://www.xiachufang.com)',
	    ),
	);
	
	/**
	 * 检查Appkey
	 *
	 * @param int $key
	 * @param string $secret
	 * @return boolean
	 */
	public function check_appkey($key, $secret) {
		if (empty ( $key ) && empty ( $secret )) {
			$this->ajaxReturn ( array (
					'error' => 'invalid_request',
					'code' => '1000',
					'msg' => '请求不合法'
			), '请求不合法', 0 );
		} else {
			$m_appkey = new AppkeyModel ();
			$keyinfo = $m_appkey->_getInfo ( $key, $secret );
			if ($keyinfo) {
				return true;
			} else {
				$this->ajaxReturn ( array (
						'error' => 'invalid_client',
						'code' => '1001',
						'msg' => 'key或secret参数无效'
				), '参数无效', 0 );
			}
		}
	}
	/**
	 * 检查接口请求合法性
	 * @return multitype:number string
	 */
	protected function check_sign()
	{
	    $result = array('status'=>0);
	    $api_language = I('param.api_language');//语言
	    $api_format_type = I('param.api_format_type');//返回数据格式
	    $api_category = I('param.api_category');//API分类|user/friend/goods
	    $api_key   = I('param.api_key');//接口编号
	    $api_partner = I('param.api_partner');//合作伙伴
	    $api_sign  = I('param.api_sign');//签名
	    $api_app_v = I('param.api_app_v');//app版本
	    $loginCode = I('param.loginCode');//登录code
	    
	    $Partner_api_model=D('Partner_api');
	    if(empty($api_language)||empty($api_format_type)||empty($api_category)||empty($api_key)||empty($api_partner)||empty($api_sign)||empty($api_app_v))
	    {
	        $result['message']="接口必要参数不能为空,{$api_language}:{$api_format_type}:{$api_category}:{$api_key}:{$api_partner}:{$api_sign}:{$api_app_v}";
	        return $result;
	    }

	    $parameters=$_REQUEST;
	    unset($parameters['_URL_']);
	    unset($parameters['api_sign']);
	    unset($parameters['submit']);
	    $check_result = $Partner_api_model->check_sign($parameters,$api_sign);
	    if($check_result['status']!=1)
	    {
	        $result['message']=$check_result['message'];
	        $result['data']=$check_result['data'];
	        return $result;
	    }
	    $result['status']=1;
	    $result['message']='验签成功';
	    return $result;
	}

}