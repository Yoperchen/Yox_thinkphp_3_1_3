<?php
class ApiCommonAction extends Action{
	//方法索引数组
	public $ma_array = array(
			1001=>'Api/User/login',						//登录前开始页
			1002=>'Api/User/send_verify_to_mobile',		//手机注册前发送短信验证码
			1003=>'Api/User/register',						//用户注册
			1004=>'Api/User/reset_password',				//密码重置
			1005=>'Api/User/check_mobile_exist',			//手机是否注册过
			1006=>'Api/User/check_email_exist',			//邮箱是否注册过
			1007=>'Api/User/verify_code',					//确认验证码
			1008=>'Api/User/update_user_info_by_user_id',	//修改会员信息
			1009=>'Api/User/my_promotion',				//推广积分，增加积分
			1010=>'Api/User/get_user_info',				//获取用户信息
			1011=>'Api/User/get_user_list',				//获取用户列表|附近的人等
			1012=>'Android/Userctrl/getInfoStat',		//获取用户基本信息
			1013=>'Api/User/calender',					//玩友活动日历
			1014=>'Api/User/showMessageDetail',			//显示好友间的私信对话
			1015=>'Api/User/inBox',						//收信箱
			1016=>'Api/User/showFriendInvite',			//好友邀请信
			1017=>'Api/User/getBasicInfo',				//获取用户基本信息
			1018=>'Api/Active/getUserActive',			//用户动态
			1019=>'Api/Active/getFriendsActive',		//好友动态
			1020=>'Api/User/messageBox',				//消息提醒
			1021=>'Android/Userctrl/messageHome',		//交流主页消息
			1022=>'Api/User/oauthBindNew',				//第三方登录，绑定新帐号
			1023=>'Android/Userctrl/getDetailInfo',		//我的详细资料
			1024=>'Api/User/getPrivacy',				//获取隐私设置
			1025=>'Api/User/updatePrivacy',				//更新隐私设置
			1026=>'Api/User/uploadMobileBook',			//上传手机通讯录
			1027=>'Api/User/sendMessage',				//发送私信
			1028=>'Api/User/delMessage',				//删除私信
			1031=>'Api/User/oauthBindLogin',			//登录后第三方绑定
			1032=>'Api/User/oauthLoginOneStep',			//微博一键登录
			1033=>'Api/User/oauthLogin',				//第三方登录，已绑定帐号
			1034=>'Api/User/rejectNotify',				//拒绝邀请
			1035=>'Api/User/ignoreNotify',				//忽略邀请
			1036=>'Api/User/suggestion',				//用户建议
			1037=>'Api/User/getEduInfo',				//获取教育信息资料
			1038=>'Api/User/getWorkInfo',				//获取工作信息资料
			1039=>'Api/User/updatePass',				//修改密码
			1040=>'Api/User/updateSetting',				//修改手机端设置
			1041=>'Api/User/getSetting',				//获取手机端设置
			1042=>'Api/User/getContactList',			//获取私信联系人列表
			1043=>'Api/User/delContact',				//删除私信联系人
			1044=>'Api/User/oauthBindExist',			//绑定已存在账户
			1045=>'Api/User/share',						//用户分享
			1046=>'Api/User/outBox',					//发信箱
			1047=>'Api/User/showGroupInvite',			//圈子邀请信
			1048=>'Api/User/getUserFace',				//获取用户头像
			1049=>'Api/User/setNotifyIsRead',			//设置信息已读
			1050=>'Api/User/setMessageIsRead',			//设置好友私信已读
			1051=>'Api/User/getRelationInfo',			//获取用户与当前登陆用户的关系
			1052=>'Api/User/checkUserLogin',			//检查帐号密码
			1053=>'Api/User/addPushToken',				//IOS添加用户推送token
			1054=>'Api/User/sendMobileVerify',			//发送手机验证码
			1055=>'Api/User/bindMobile',				//绑定手机
			1056=>'Api/User/registerMobile',			//手机注册
			1057=>'Api/User/checkMobile',				//检查手机是否已被使用
			1058=>'Api/User/hasbindMobile',				//检查用户是否已绑定手机
			1059=>'Api/User/loginMobileCode',			//手机和验证码登录已注册用户
			1060=>'Api/User/checkEmailBind',			//检查邮箱是否已绑定微博
			1061=>'Api/User/addMobileBook',              //添加单条通讯录好友
			1062=>'Api/User/deleteMobileBook',          //删除单条通讯录好友
			1063=>'Api/User/getSkinList',               //获取背景图片列表
			1064=>'Api/User/getPushMsgLast',            //获取用户最后一条推送信息
			1065=>'Api/User/addAppAccessLog',           //添加APP使用用户数据
			1066=>'Api/User/updateTokenStatus',			//更新token状态
			1067=>'Api/User/getNotifyList',				//好友推荐+邀请列表
			1068=>'Api/User/loginMobilePassword',		//手机加密码登录
			1069=>'Api/User/getBindStatus',				//获取第三方绑定状态
			1070=>'Api/User/setSyncInfo',				//第三方同步设置(多值)
			1071=>'Api/User/checkOauthVerify',			//验证检查
			1072=>'Api/User/saveSkin',				    //保存所选择的背景图片
			1073=>'Api/User/setNotifyIsReadType',		//根据消息的类型和uid把消息设为已度
			1074=>'Api/User/setSyncItem',				//第三方同步设置(单值)
			1075=>'Api/User/getSyncInfo',				//获取第三方同步设置
			1076=>'Api/User/getNotifyCount',			//获取未读消息数量
			1077=>'Api/User/addFriendStep',				//第二步加好友
			1078=>'Api/User/followStarStep',			//第三步追星
			1079=>'Api/User/getRegFriends',				//注册加好友列表
			1080=>'Api/User/LoginOneStep_New',			//新一键登录
			1081=>'Api/User/oauthBindLogin_New',		//新登录后第三方绑定
			1082=>'Api/User/loginguest',				//昵称注册或登录
			1083=>'Api/User/mobilePwdResetVerify',		//验证重置密码的手机验证码是否存正确,先使用1054发送再来此验证
			1084=>'Api/User/getOrder',					// 获取某用户的订单列表
			1085=>'Api/User/addFeedback',				//添加意见反馈tc_feedback
			1086=>'Api/User/getFeedbacList',			//获取意见反馈列表tc_feedback
			1087=>'Api/User/mobilePwdReset',			//重置密码,用1054发送
			1088=>'Api/User/repayOrder',				// 重新支付订单
			1089=>'Api/User/cancelOrder',				// 取消订单
			2001=>'Api/Goods/list_goods',				//商品列表
			2002=>'Api/Goods/get_good_by_id',			//根据商品id获取商品信息
			2003=>'Api/Goods/del_good',					//删除指定商品
			2004=>'Api/Goods/add_good',					//添加商品
			2005=>'Api/Goods/update_goodById',			//修改商品
			2006=>'Api/Goods/get_brand_list',			//品牌列表
			2007=>'Api/Goods/get_brand_by_id',			//获取品牌信息
			2008=>'Api/Goods/add_brand',				//添加品牌
			2009=>'Api/Goods/set_good_up',				//赞
			2010=>'Api/Goods/set_good_down',			//差
			2011=>'Api/Goods/set_good_like',			//喜欢
			2012=>'Api/Goods/update_brand',			    //修改品牌
			2013=>'Api/Goods/del_brand',			    //删除品牌
			2014=>'Api/Goods/add_category',			//添加分类
			2015=>'Api/Goods/get_category_by_id',	//获取分类信息
			2016=>'Api/Goods/update_category',			//修改分类
			2017=>'Api/Goods/get_category_list',			//分类列表
			2018=>'Api/Goods/del_category',			//删除分类
// 			2012=>'Api/Group/create',					//创建圈子
// 			2013=>'Api/Group/doInvite',					//邀请加入圈子
// 			2014=>'Api/Group/promotion',				//将普通成员升级为管理员
// 			2015=>'Api/Group/demotion',					//将管理员降级为普通成员
// 			2016=>'Api/Group/update',					//更新圈子信息
// 			2017=>'Api/Group/getMyGroup',				//更新圈子信息
// 			2018=>'Api/Group/album',					//圈子相册列表
			2019=>'Api/Group/photo',					//某个相册的相片
			2020=>'Api/Group/allPhoto',					//所有相片列表
			2021=>'Api/Group/updateLogo',				//更改圈子LOGO
			2022=>'Api/Group/doAgree',					//同意加入圈子
			2023=>'Api/Group/breakup',					//解散圈子
			2024=>'Api/Group/getStat',					//圈子统计信息
			3001=>'Api/Article/add_article',			//发表文章
			3002=>'Api/Article/get_article_list',		//获取文章列表
			3003=>'Api/Article/get_article_by_id',		//获取文章信息
			3004=>'Api/Article/update_article',			//修改文章
			3005=>'Api/Article/del_article',			//删除文章
			3006=>'Api/Article/get_article_comment_list',//文章评论列表
			3007=>'Api/Article/add_comment',			//添加评论
			3008=>'Api/Article/del_comment',			//删除评论
			3009=>'Api/Article/get_comment_by_commentid',//获取评论信息
	        3010=>'Api/Article/update_comment',//修改
			4001=>'Api/Address/get_provinces_list',		//省份列表
			4002=>'Api/Address/get_city_list_by_provinces_id',//省份下的城市列表
			4003=>'Api/Address/get_district_by_city_id',	  //城市下的区
			4004=>'Api/Address/get_info_by_district_id',		//获取省、城市、区信息
			4005=>'Api/Address/get_city_list',			//根据字母、热门获取城市列表
			4006=>'Api/Address/add_community',				//更改活动LOGO
			4007=>'Api/Address/get_community_list',			//社区列表
			4008=>'Api/Address/get_community_info',				//活动详情
			4009=>'Api/Address/get_address_by_id',				//收货地址详情
			4010=>'Api/Address/get_address_list',				//收货地址列表
			4011=>'Api/Address/add_address',				//添加收货地址
			4012=>'Api/Address/update_address',				//修改收货地址
			4013=>'Api/Address/del_address_by_id',			//删除收货地址
			4100=>'Api/Address/get_host',					//获取站点地址
			5001=>'Api/Payment/set_order',		//通用订单
			5002=>'Api/Payment/set_order_success',				//设置订单成功完成
			5003=>'Api/Payment/get_order_list',				//获取订单列表
			5004=>'Api/Payment/pay_by_funds',				//余额支付
			5005=>'Api/Payment/pay_by_integral',			//积分支付
			5006=>'Api/Payment/pay_by_barter',			//以物换物、技能交换
			5007=>'Api/Payment/update_order',		//修改订单
			5008=>'Api/Friend/getMobileFriendList_beFriended',		//获取通讯录好友的集合（已成为好友）
			5009=>'Api/Friend/getMobileFriendList_unBind',			//获取通讯录好友的集合（未绑定本地账号）
			5010=>'Api/Friend/getMobileFriendList_bind',			//获取通讯录好友的集合（ipiao玩友）
			5011=>'Api/Friend/getOauthFriendList_unFriended',		//获取第三方好友的集合（未成为好友）
			5012=>'Api/Friend/getOauthFriendList_beFriended',		//获取第三方好友的集合（已添加好友）
			5013=>'Api/Friend/getOauthFriendList_unBind',			//获取第三方好友的集合（未有本地账号）
			5014=>'Api/Friend/getOauthFriendList_bind',				//获取第三方玩友的集合（已绑定玩友）
			5015=>'Api/Friend/getOauthFriendList_unFriended_bind',	//获取第三方好友的集合（已绑定，未成为好友）
			5016=>'Api/Friend/searchByName',			//根据姓名搜索玩友
			5017=>'Api/Friend/searchByCompany',			//根据公司搜索玩友
			5018=>'Api/Friend/searchBySchool',			//根据学校搜索玩友
			5019=>'Api/Friend/emailInvite',				//邮件邀请
			5020=>'Api/Friend/getRecFriendList',		//获取通讯录和微博推荐好友集合
			5021=>'Api/Friend/getOauthFriend_New',		//获取微博玩友
			6001=>'Api/Cuisine/add_cuisine',			//菜式
			6002=>'Api/Cuisine/get_cuisine_list',			//获取菜式列表
			6003=>'Api/Cuisine/get_cuisine_by_id',				//想看
			6004=>'Api/Cuisine/update_cuisine',					//修改菜式
			6005=>'Api/Cuisine/del_cuisine',			//娱乐资讯动态
			6006=>'Api/Active/getCommentList',			//获取微博评论列表
			6007=>'Api/Active/weiboAddGood',			//微博好+1 （顶）
			6008=>'Api/Active/commentAddGood',			//回复 好+1
			6009=>'Api/Active/iconCount',				//电影、演出或者娱乐的想看和说好统计
			6010=>'Api/Active/getSayGoodList',			//获取某电影或者八卦的说好玩友列表
			6011=>'Api/Active/getWannaPlayList',		//获取某电影或者八卦的想看玩友列表
			6012=>'Api/Active/replyWeibo',				//评论动态
			6013=>'Api/Active/getWeiboInfo',             //获取单条微博
			6014=>'Api/Active/updateMobileSet',
			6015=>'Api/Active/delete',					//删除动态
			7001=>'Api/Course/add_course',				//添加课程表
			7002=>'Api/Course/get_course_list',				//获取课程表列表
			7003=>'Api/Course/get_my_course',			//获取我的课程表
			7004=>'Api/Course/del_my_course',			//删除我的课程表、删除一个班的课程表
			7005=>'Api/Course/getCourseById',   //获取一天的课程表
			7006=>'Api/Course/update_course',//修改一天的课程表
			7007=>'Api/Course/del_course',//删除用户一天的课程表
			7008=>'Api/Course/get_class_list',//班级列表
			8001=>'Api/Stores/get_store_list',			//获取商家列表
			8002=>'Api/Cms/getWaterfall_film',			//电影瀑布流
			8003=>'Api/Cms/getWaterfall_show_city',		//演出瀑布流
			8004=>'Api/Cms/getWaterfall_ent',			//八卦瀑布流
			8005=>'Api/Cms/getShowInfo',				//演出详情
			8006=>'Api/Cms/getEntInfo',					//八卦详情
			8007=>'Android/Cmsctrl/getarc',				//电影、演出简略页
			8008=>'Android/Cmsctrl/filmInfo',			//电影详情页
			8009=>'Api/Cms/getCityList',				//电影城市列表
			8010=>'Api/Cms/getCinemaList',				//电影影院列表
			8011=>'Api/Cms/getFilmListPlaying',			//活动选择电影列表
			8012=>'Api/Cms/getShowList',				//演出列表
			8013=>'Api/Cms/getFilmInfo',				//电影详情
			8014=>'Api/Cms/getDistrictList',			//获取 某城市的 地区
			8015=>'Api/Cms/getCinemaInfo',				//获取电影院详细信息
			8016=>'Api/Cms/getFilmListWill',			//获取即将上映的电影列表
			8017=>'Api/Cms/getShowCity',				//获取演出城市
			8018=>'Api/Cms/getShowingList',				//获取电影场次
			8019=>'Api/Cms/clickAdvert',				//点击广告增加点击次数
			8020=>'Api/Cms/getTvInfo',					//电视详情
			8021=>'Api/Cms/getWaterfall_tv',			//电视瀑布流
			8023=>'Api/Cms/getWaterfall_star_all',		//明星的瀑布流
			8022=>'Api/Cms/getArchiveStar',			//获取文章关联明星
			8024=>'Api/Cms/getWaterfall_list',		//首页传统列表
			8025=>'Api/Cms/getBanner',		        //获取banner
			9001=>'Api/Tag/add_tag',					//添加标签
			9002=>'Api/Tag/get_tag_list',				//获取标签列表
			9003=>'Api/Tag/get_tag_by_tag_id',					//获取标签信息
			9004=>'Api/Tag/update_tag',				//修改标签
			9005=>'Api/Tag/del_tag',				//删除标签
			
			9006=>'Api/Ad/add_ad',				//添加广告
			9007=>'Api/Ad/get_ad_list',		//获取广告列表
			9008=>'Api/Ad/getAdById',			//获取广告详细内容
			9009=>'Api/Ad/update_ad',			//修改广告
			9010=>'Api/Ad/del_ad',				//删除广告
			//10000=>'Api/User/updateMobile',
			10000=>'Api/Share/add_share',				//添加分享
			10001=>'Api/Share/get_share_list',					//获取分享列表
			10002=>'Api/Share/get_share_by_share_id',			//获取指定分享
			10003=>'Api/Share/update_share',//修改分享
			10004=>'Api/Share/del_share',	//删除分享
			10005=>'Api/Share/add_collect',				//添加收藏
			10006=>'Api/Share/get_collect_list',		//收藏列表
			10007=>'Api/Share/get_collect_by_collect_id',//收藏详细信息
			10008=>'Api/Share/update_collect',			//修改收藏
			10009=>'Api/Share/del_collect',				//删除收藏
			11001=>'Api/Rental/get_rental_list',          //出租列表
			11002=>'Api/Rental/get_rental_info',          //出租详细信息
			11003=>'Api/Rental/add_rental',          //添加出租
			11004=>'Api/Rental/update_rental',          //修改出租
			11005=>'Api/Rental/get_carpool_list',          //拼车列表
			11006=>'Api/Rental/get_carpool_info',				// 获取拼车信息
			11007=>'Api/Rental/add_carpool',			// 添加拼车
			11008=>'Api/Rental/update_carpool',				//修改拼车信息
			11009=>'Api/Rental/join_carpool',				//加入拼车
			11010=>'Api/Rental/quit_carpool',				//退出拼车
			11011=>'Api/Rental/rental',				//租用|租车、租场地、租飞机、租广告、租男友、租女友
			11012=>'Api/Rental/rental_next',				//租用下一段时间
			11013=>'Api/Rental/del_rental',				//删除出租信息
			11014=>'Api/Rental/add_rental_category',				//删除出租信息
			11015=>'Api/Rental/update_rental_category',				//删除出租信息
			11016=>'Api/Rental/get_rental_category_list',				//删除出租信息
			11017=>'Api/Rental/del_rental_category',				//删除出租信息
			11018=>'Api/Rental/get_rental_category_info',			//指定租赁分类详细信息
// 			12001=>'Api/Star/getStarEntList',			//获取明星关联文章列表
// 			12002=>'Api/Star/getStarList',				//明星列表
// 			12003=>'Api/Star/seekStar',					//追星列表
// 			12004=>'Api/Star/follow',					//追星
// 			12005=>'Api/Star/unfollow',					//取消追星
			12006=>'Api/Star/followStarActive',			//我追星的动态
			13001=>'Api/Task/CheckIn',			//签到
			13002=>'Api/Task/getCheckStatus',			//获取签到状态
			14001=>'Api/Statistics/addBehavior',			//添加用户行为
			15001=>'Api/Payment/set_order',			//添加订单
			15002=>'Api/Payment/set_order_success',			//设置订单成功
			15003=>'Api/Cinema/getShowingList',			//获取电影场次
			15004=>'Api/Cinema/getSeat',					// 获取电影场次的座位图
			15005=>'Api/Cinema/lockSeat',					// 锁位
			15006=>'Api/Cinema/addFilmFeedback',		// 添加评论
			15007=>'Api/Cinema/getFilmFeedbackLsit',	// 获取电影评论列表
			15008=>'Api/Cinema/getShowing',				// 获取某影院的电影场次
			15009=>'Api/Cinema/unlockSeat',				// 解锁
			15010=>'Api/Cinema/getShowingFilms',		//根据cinema获取播放电影
			15011=>'Api/Cinema/getCinemaHallList',		// 获取某个影院的影厅列表
			15012=>'Api/Cinema/getHallSeats',				// 获取某个影厅的座位图
			15013=>'Api/Cinema/getValidation_codeByOrderId',// 根据订单id获取取票码
			16001=>'Api/Activity/getBanner',				//获取Banner列表
			16002=>'Api/Activity/getActivityList',		//获取活动列表
			17001=>'Api/Membership_card/bind',		    //会员卡绑定
			17002=>'Api/Membership_card/getDetail',		//会员卡详细信息获取
			17003=>'Api/Membership_card/getRechargeLog',//会员卡充值记录获取
			17004=>'Api/Membership_card/recharge',       //会员卡充值
			17005=>'Api/Membership_card/cardOrderPayment',//会员卡支付(下订单)
			18001=>'Api/Partner/add_partner',			  //添加第三方
			18002=>'Api/Partner/reset_password',		  //重置密码
			18003=>'Api/Partner/check_partner',		     //验证第三方合法性
			18004=>'Api/Partner/get_partner_list',		  //获取第三方列表
			19001=>'Api/Toll/add_toll',							//添加缴费
			19002=>'Api/Toll/get_toll_list',					//获取缴费信息列表
			19003=>'Api/Toll/get_toll_by_id',				//获取缴费信息
			19004=>'Api/Toll/update_toll',						//修改缴费信息
			19005=>'Api/Toll/add_price_strategy',		//添加价格策略
			19006=>'Api/Toll/get_price_strategy_list',//获取价格策略列表
			19007=>'Api/Toll/get_price_strategy_by_id',//获取指定价格策略
			19008=>'Api/Toll/update_price_strategy',//修改价格策略
			20000=>'Api/Friend/get_community_member',//获取社区内的成员列表
			20001=>'Api/Friend/get_friends',//获取好友列表
			20002=>'Api/Friend/get_system_friend_category_list',//获取系统好友分组列表
			20003=>'Api/Friend/get_friend_category_list',//获取好友分组列表
			20004=>'Api/Friend/add_friend',//添加好友
			20005=>'Api/Friend/send_message',//发送消息
			20006=>'Api/Friend/get_message_list',//获取消息列表
			20007=>'Api/Friend/del_message',//删除消息
			20008=>'Api/Friend/add_blacklist',//黑名单
			20009=>'Api/Friend/set_friend_user_status_delete',//删除好友、假删除、可用于找回好友，将friend_user_status字段设置为0
			20010=>'Api/Appointment/add_appointment',//发布约会、预约
			20011=>'Api/Appointment/get_appointment_list',//约会、预约列表
			20012=>'Api/Appointment/getAppointmentById',//获取约会、预约详细信息
			20013=>'Api/Appointment/update_appointment',//修改约会、预约
			20014=>'Api/Appointment/del_appointment',//删除约会、预约
			20015=>'Api/Appointment/apply_appointment',//报名约会
			20016=>'Api/Friend/add_group',//(创建群、组、班级、系)
			20017=>'Api/Friend/join_group',//(加群)
			20018=>'Api/Friend/exit_group',//(退群)
			20019=>'Api/Friend/get_group',//(群(组)详细信息)
			20020=>'Api/Friend/get_group_list',//(群(组)列表|搜索群)
			20021=>'Api/Friend/update_groupById',//(修改群信息)
			20022=>'Api/Friend/del_group',//(解散群)
			20023=>'Api/Friend/get_group_user',//群成员列表
			20024=>'Api/Friend/send_group_message',//发送群消息
			20025=>'Api/Friend/get_group_message_list',//群消息列表
			20026=>'Api/Friend/del_group_message',//删除群消息
			//20029=>'Api/Visit_log/add_visit_log',//添加访问记录
			20030=>'Api/Visit_log/get_visit_list',//获取访问记录列表
			//20031=>'Api/Visit_log/get_visit_by_id',//访问记录
			//20032=>'Api/Visit_log/update_visit_log',//修改访问记录
			//20033=>'Api/Visit_log/del_visit_log',//删除访问记录
			
			20036=>'Api/Appointment/find_jba',//找师妹、找师兄
			21001=>'Api/Files/upload_file',//上传文件
			21002=>'Api/Files/get_file_list',//获取文件列表
			21003=>'Api/Files/get_file_by_id',//获取文件信息
			21004=>'Api/Files/update_file',//修改文件
			21005=>'Api/Files/del_file',//删除文件
			
			22001=>'Api/Yocms_widget/get_widget',//获取小部件
			/*80000=>'Api/Analog_applications/Yo_80000',
			80001=>'Api/Analog_applications/Yo_80001',
			80002=>'Api/Analog_applications/Yo_80002',
			80003=>'Api/Analog_applications/Yo_80003',
			80004=>'Api/Analog_applications/Yo_80004',
			80005=>'Api/Analog_applications/Yo_80005',
			80006=>'Api/Analog_applications/Yo_80006',
			80007=>'Api/Analog_applications/Yo_80007',
			80008=>'Api/Analog_applications/Yo_80008',
			81000=>'Api/Analog_applications/Yo_81000',
			81001=>'Api/Analog_applications/Yo_81001',
			81002=>'Api/Analog_applications/Yo_81002',
			81003=>'Api/Analog_applications/Yo_81003',
			81004=>'Api/Analog_applications/Yo_81004',
			81005=>'Api/Analog_applications/Yo_81005',
			81006=>'Api/Analog_applications/Yo_81006',
			81007=>'Api/Analog_applications/Yo_81007',
			81008=>'Api/Analog_applications/Yo_81008',
			81009=>'Api/Analog_applications/Yo_81009',
			*/
		);


	/**
	 * CURL获取url内容
	 * @param string $url
	 * @return mixed
	 */
	public function curl_get($url){
		$ch = curl_init();
		// 2. 设置选项，包括URL
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		// 3. 执行并获取HTML文档内容
		$output = curl_exec($ch);
		// 4. 释放curl句柄
		curl_close($ch);
		return $output;
	}


	public function get_client_type(){
		if(strpos (trim($_REQUEST['sc']), 'android')!==false){
			$type = 'android';
		}else{
			$type = 'iphone';
		}
		return $type;
	}

}