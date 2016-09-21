<?php
class ToolAction extends ApiCommonAction {

	public $ma_array = array(
			'user'=>array(
					1001=>'login(用户登陆)',
					1002=>'send_verify_to_mobile(手机注册前发送短信验证码)',			//更新用户基本信息
					1003=>'register(用户注册)',				//用户注册
					1004=>'reset_password(密码重置)',				//密码重置
					1005=>'check_mobile_exist(检查手机是否被注册)',		//检查手机是否存在
					1006=>'check_email_exist(检查邮箱是否注册过)',		//检查邮箱是否注册过
					1007=>'verify_code(确认验证码)',			//确认验证码
					1008=>'update_user_info_by_user_id(修改会员信息)',
					1009=>'my_promotion(推广)',						//收信箱
					1010=>'get_user_info(获取用户信息)',
					1011=>'get_user_list(获取用户列表、附近的人)',			//获取用户列表、附近的人
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
					2001=>'list_goods(商品列表)',				//圈子列表
					2002=>'get_good_by_id(根据id获取商品信息)',			//推荐圈子列表
					2003=>'del_good(删除指定商品)',		//删除指定商品
					2004=>'add_good(添加商品)',					//添加商品
					2005=>'update_goodById(修改)',					//修改商品
					2006=>'get_brand_list(获取品牌列表)',					//退出圈子
					2007=>'get_brand_by_id(获取品牌信息)',				//品牌
					2008=>'add_brand(添加品牌)',					//将成员踢出圈子
					2009=>'set_good_up(赞)',					//赞
					2010=>'set_good_down(差)',			//差
					2011=>'set_good_like(喜欢)',		//喜欢
					2012=>'update_brand(修改品牌)',					//修改品牌
					2013=>'del_brand(删除品牌)',					//删除品牌
					2014=>'add_category(添加分类)',				//添加分类
					2015=>'get_category_by_id(获取分类信息)',					//获取分类信息
					2016=>'update_category(修改分类信息)',					//修改分类信息
					2017=>'get_category_list(分类列表)',				//分类列表
					2018=>'del_category(删除分类)',					//删除分类
// 					2019=>'photo',					//某个相册的相片
// 					2020=>'allPhoto',					//所有相片列表
// 					2021=>'updateLogo',				//更改圈子LOGO
// 					2022=>'doAgree',					//同意加入圈子
// 					2023=>'breakup',					//解散圈子
// 					2024=>'getStat',					//圈子统计信息
					), 
			'article'=>array(
					3001=>'add_article(添加文章)',						//添加文章
					3002=>'get_article_list(获取文章列表)',						//玩友想看
					3003=>'get_article_by_id(获取文章详细信息)',					//获取文章信息
					3004=>'update_article(修改)',					//修改文章
					3005=>'del_article(删除文章)',				//删除文章
					3006=>'get_article_comment_list(文章评论列表)',
					3007=>'add_comment(添加评论|商品或文章)',
					3008=>'del_comment(删除评论)',
					3009=>'get_comment_by_commentid(获取单条评论信息)',
					3010=>'update_comment(修改)',					//修改
					//3009=>'follow(7.21	添加追星)',						//追星
					//3010=>'unfollow(7.22	取消追星)',					//取消追星
// 					3013=>'getBackground(获取启动页海报)',				//获取启动页海报
					),
			'address'=>array(
					4001=>'get_provinces_list(获取省份列表)',		//省份列表
					4002=>'get_city_list_by_provinces_id(获取城市列表)',//城市列表
					4003=>'get_district_by_city_id(获取指定城市的区列表)',	  //区列表
					4004=>'get_info_by_district_id(获取省、城市、区的信息)',	  //区列表
					4005=>'get_city_list(根据字母、热门获取城市列表)',		//获取电影场次
					4006=>'add_community(添加社区)',				//添加社区
					4007=>'get_community_list(社区列表)',			//建圈子获取演出详细信息
					4008=>'get_community_info(获取社区信息)',				//获取社区信息
					4009=>'get_address_by_id(收货地址信息)',				//收货地址信息
					4010=>'get_address_list(收货地址列表)',				//收货地址列表
					4011=>'add_address(添加收货地址)',				//添加收货地址
					4012=>'update_address(修改收货地址)',				//修改收货地址
					4013=>'del_address_by_id(删除收货地址)',				//删除收货地址
// 					4008=>'doSearch',					//搜索活动
// 					4009=>'getDetail',				//活动详情
					4100=>'get_host(获取站点域名)',				//获取站点地址
					), 
			'payment'=>array(
					5001=>'set_order(设置通用订单)',		//设置订单
					5002=>'set_order_success(设置订单已完成)',				//找玩友推荐玩友
				    	5003=>'get_order_list(获取订单列表)',				//我的玩友
 					5004=>'pay_by_funds(余额支付)',					//余额支付
					5005=>'pay_by_integral(积分支付)',			//积分支付
					5006=>'pay_by_barter(以物换物、技能交换)',			//获取附近玩友
					5007=>'update_order(修改订单)',		//获取通讯录好友的集合（未成为好友）
// 					5008=>'getMobileFriendList_beFriended(3.14 通讯录-ipiao已成为好友)',		//获取通讯录好友的集合（已成为好友）
// 					5009=>'getMobileFriendList_unBind(3.12 通讯录-未注册ipiao)',			//获取通讯录好友的集合（未绑定本地账号）
// 					5010=>'getMobileFriendList_bind(3.13 通讯录-ipiao玩友)',			//获取通讯录好友的集合（ipiao玩友）
// 					//5011=>'getOauthFriendList_unFriended',		//获取第三方好友的集合（未成为好友）
// 					//5012=>'getOauthFriendList_beFriended',		//获取第三方好友的集合（已添加好友）
// 					5013=>'getOauthFriendList_unBind(3.11 第三方-未有ipiao账号)',			//获取第三方好友的集合（未有本地账号）
// 					5014=>'getOauthFriendList_bind(3.9 第三方-已绑定ipiao帐号)',				//获取第三方玩友的集合（已绑定玩友）
// 					5015=>'getOauthFriendList_unFriended_bind(3.10	第三方-已绑定未成为好友)',	//获取第三方好友的集合（已绑定，未成为好友）
// 					5016=>'searchUserByName(3.3	通过姓名搜索用户)',			//根据姓名搜索玩友
// 					5017=>'searchByCompany(3.5 通过公司搜索用户)',			//根据公司搜索玩友
// 					5018=>'searchBySchool(3.4 通过学校搜索用户)',			//根据学校搜索玩友
// 					//5019=>'emailInvite',				//邮件邀请
// 					5020=>'getRecFriendList(3.16  获取微博+通信录推荐玩友)',		//获取通讯录和微博推荐好友集合
// 					5021=>'getOauthFriend_New(获取微博玩友)',		//获取微博玩友
					),
			'cuisine'=>array(
					6001=>'add_cuisine（添加菜式）',			//添加菜式
 				        6002=>'get_cuisine_list(获取列表)',		//获取列表			//说好
 					6003=>'get_cuisine_by_id(获取菜式信息)',		//获取菜式信息
					6004=>'update_cuisine(修改菜式)',					//发布动态
					6005=>'del_cuisine(删除菜式)',			//娱乐资讯动态
// 					6006=>'getCommentList(动态评论列表)',			//获取微博评论列表
// 					//6007=>'weiboAddGood',			//微博好+1 （顶）
// 					//6008=>'commentAddGood',			//回复 好+1
// 					//6009=>'iconCount',				//电影、演出或者娱乐的想看和说好统计
// 					6010=>'getSayGoodList(4.7 某电影的喜欢列表)',			//获取某电影或者八卦的说好玩友列表
// 					6011=>'getWannaPlayList(4.6	某电影的想看列表)',		//获取某电影或者八卦的想看玩友列表
// 					6012=>'replyWeibo(回复动态)',				//评论动态
// 					6014=>'updateMobileSet',
// 					6015=>'deleteWeibo(删除动态)',
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
// 					8002=>'getWaterfall_film(7.7	获取电影数据瀑布流)',			//电影瀑布流
// 					8003=>'getWaterfall_show_city(7.8	获取演出数据瀑布流)',		//演出瀑布流
// 					8004=>'getWaterfall_ent(7.9	八卦数据瀑布流)',			//八卦瀑布流
// 					8005=>'getShowInfo(7.11	演出详情)',				//演出详情
// 					8006=>'getEntInfo(7.12	八卦详情)',					//八卦详情
// 					8007=>'getarcInfo(1.8	电影、演出、八卦简单页)',				//电影、演出简略页
// 					8008=>'filmInfo(1.9	电影详情)',			//电影详情页
// 					8009=>'getCityList(7.13	获取城市列表)',				//电影城市列表
// 					8010=>'getCinemaList(7.15	获取某影片某城市的影院列表)',				//电影影院列表
// 					8011=>'getFilmListPlaying(7.2	选择娱乐电影-正在上映)',			//活动选择电影列表
// 					8012=>'getShowList(7.1	选择娱乐演出)',				//演出列表
// 					8013=>'getFilmInfo(7.10	电影详情)',				//电影详情
// 					//8014=>'getDistrictList',			//获取 某城市的 地区
// 					8015=>'getCinemaInfo(电影院详细信息)',				//获取电影院详细信息
// 					8016=>'getFilmListWill',			//获取即将上映的电影列表
// 					8017=>'getShowCity(7.27	获取演出城市)',				//获取演出城市
// 					//8018=>'getShowingList',				//获取电影场次
// 					8019=>'clickAdvert(点击增加广告次数)',				//获取演出城市
// 					8020=>'getTvInfo(电视详情)',					//电视详情
// 					8021=>'getWaterfall_tv(电视瀑布流)',			//电视瀑布流
// 					8022=>'getArchiveStar(获取文章关联明星)',		//获取文章关联明星
// 					8023=>'getWaterfall_star_all(某个明星的瀑布流)',//某个明星的瀑布流
// 					8024=>'getWaterfall_list(首页传统列表)',       //首页传统列表
// 					8025=>'getBanner(获取banner)',       //获取banner
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
					11001=>'get_rental_list(获取租赁列表)',
					11002=>'get_rental_info(获取租赁详细信息)',
					11003=>'add_rental(添加租赁信息(租车、租房、租飞机、主场地))',
					11004=>'update_rental(修改租赁信息)',
					11005=>'get_carpool_list(获取拼车列表)',
					11006=>'get_carpool_info(获取拼车详细信息)',
					11007=>'add_carpool(添加拼车)',
					11008=>'update_carpool(修改拼车详细信息)',
					11009=>'join_carpool(加入拼车)',
					11010=>'quit_carpool(退出拼车)',
					11011=>'rental(租用)',//租了某个时间段
					11012=>'rental_next(租用下一段时间)',//一共有三段出租时间段
					11013=>'del_rental(删除出租)',//删除出租
					11014=>'add_rental_category(租赁分类|租车、租房、租飞机)',//添加出租分类
					11014=>'update_rental_category(修改租赁分类|租车、租房、租飞机)',//修改出租分类
					11015=>'get_rental_category_list(租赁分类列表|租车、租房、租飞机)',//获取出租分类列表
					11016=>'del_rental_category(删除出租分类)',//删除出租分类
					11017=>'get_rental_category_info(指定租赁分类详细信息)',//出租详细分类
			),
// 			'star'=>array(
// 					12000=>'getStarInfo(新获取明星信息)',
// 					12001=>'getStarEntList(获取明星关联文章列表)',
// 					12002=>'getStarList(明星列表)',				//明星列表
// 					12003=>'seekStar(追星列表)',			//追星列表
// 					12004=>'follow(追星)',					//追星
// 					12005=>'unfollow(取消追星)',			//取消追星
// 					12006=>'followStarActive(我追星的动态)'			//我追星的动态
// 			),
// 			'task'=>array(
// 					13001=>'CheckIn(签到)',			//签到
// 					13002=>'getCheckStatus(获取签到状态)'			//获取签到状态
// 					),
// 			'statistics'=>array(
// 					14001=>'addBehavior(添加用户行为)'			//添加用户行为
// 			),
// 			'cinema'=>array(
// 					15001=>'getApplist(推荐app应用)',
// 					15010=>'getCinemaList(获取影院列表)',
// 					15002=>'getCinemaInfo(获取影院详情)',
// 					15003=>'getShowingList(获取电影场次)',
// 					15004=>'getSeat(获取电影场次的座位图)',
// 					15005=>'lockSeat(锁位)',
// 					15006=>'addFilmFeedback(添加评论 )',
// 					15007=>'getFilmFeedbackLsit(获取电影评论列表 )',
// 					15008=>'getShowing(获取某影院的电影场次)',
// 					15009=>'unlockSeat(解锁)',
// 					15010=>'getShowingFilms(根据影院获取播放电影列表)',
// 					15011=>'getCinemaHallList(获取某个影院的影厅列表)',
// 					15012=>'getHallSeats(获取某个影厅的座位图)',
// 					15013=>'getValidation_codeByOrderId(获取取票码)',
// 					),
// 			'activity'=>array(
// 					16001=>'getBanner(获取Banner列表)',
// 					16002=>'getActivityList(获取活动列表)'
// 			),
// 			'membership_card'=>array(
// 					17001=>'bind(绑定会员卡)',
// 					17002=>'getDetail(获取会员卡详细信息,先调用17001)',
// 					17003=>'getRechargeLog(会员卡充值记录,先调用17001)',
// 					17004=>'recharge(会员卡充值)',
// 					17005=>'cardOrderPayment(会员卡支付)',
// 			),
			'api_partner'=>array(
					18001=>'add_partner(添加合作伙伴)',
					18002=>'reset_password(密码重置)',
					18003=>'check_partner(验证第三方合法性)',
					18004=>'get_partner_list(获取合作伙伴列表)',
			),
			'toll'=>array(
					19001=>'add_toll(添加缴费)',
					19002=>'get_toll_list(获取缴费列表)',
					19003=>'get_toll_by_id(获取缴费单详细信息)',
					19004=>'update_toll(修改详细信息)',
					19005=>'add_price_strategy(添加价格策略)',
					19006=>'get_price_strategy_list(获取价格策略列表)',
					19007=>'get_price_strategy_by_id(获取价格策略信息)',
					19008=>'update_price_strategy(修改价格策略)',
				
			),
			'friend'=>array(
				20000=>'(好友)get_community_member(获取社区内的成员列表)',
				20001=>'(好友)get_friends(获取好友员列表)',
				20002=>'(好友)get_system_friend_category_list(获取系统分组列表)',
				20003=>'(好友)get_friend_category_list(获取好友分组列表(请先调用20002获取系统分组))',
				20004=>'(好友)add_friend(添加好友)',
				20005=>'(消息)send_message(发送消息)',
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

	public function index() {
		//$this->assign('apilist',$this->ma_array['user']);
		$this->display();
	}

	public function get_form() {
		$api_key = trim($_POST['api_key']);
		if(in_array($api_key, array_keys($this->ma_array['analog_applications'])))
		{
			//此处限制是否显示模拟应用详情
			echo 'linglingtang:无权限浏览应用详情';die();
		}
		$this->display($api_key);
	}

	public function get_apilist(){
		$api_key = trim($_POST['api_key']);
		$this->ajaxReturn($this->ma_array[$api_key],'success',1);
	}

}