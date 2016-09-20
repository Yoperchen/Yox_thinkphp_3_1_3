<?php
/**
 * Yocms 客户端接口工具
 * @author Yoper 944975166@qq.com
 * http://www.lingligntang.com
 */
class Yocms_client{
	//api地址
	private  $api_url = "http://api.linglingtang.me/index.php?s=/Page/index.html";
	//语言
	private $language = 'Chinese';
	//返回数据类型json/xml,目前只有json
	private $format_type = 'json';
	//第三方id，Yocms提供
	private $partner_id='';
	//第三方名称，Yocms提供
	private $partner='16080000008';
	//第三方secret，Yocms提供,请勿泄漏
	private $partner_secret='OTczNkQwcmxYZnNlOURvV0lSN0x4YkMvaC90V3FVdUVtSm1ENytneVpFWGlIaHpwVEhzNkJGZUJZMEYzZ1c0';
	//站点
	public $site_id='';
	private $ma='0';//接口编号
	
	function __construct(){
		
	}
	/**
	 * 通用获取数据方法
	 * @param int $ma 接口编号
	 * @param array $data 其他数据
	 * @param string $method get|post
	 */
	public function get_common_info($ma='',$data,$method='get'){
		$this->ma=$ma;
		if(empty($this->ma)){
			return array('status'=>0,'message'=>'ma为空','data'=>0);
		}
		$data['language']=$this->language;
		$data['format_type']=$this->format_type;
		if(!empty($this->partner_id))$data['partner_id']=$this->partner_id;
		$data['partner']=$this->partner;
		$data['partner_secret']=$this->partner_secret;
		$data['ma']=$this->ma;
		if(!empty($this->site_id))$data['site_id']=$this->site_id;
		$result = $this->client_curl($data,$method);
		$result = json_decode($result,true);
		//print_r($result);
		return $result;
	}
	/**
	 * curl
	 * @param array $data
	 * @return array
	 */
	private function client_curl($data,$method='get'){
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL,$this->api_url );
		if($method!='get'){
			curl_setopt ( $ch, CURLOPT_POST, 1 );
		}
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
		$result = curl_exec ( $ch );
		curl_close ( $ch );
		return $result;
	}
	
}
//示例
import('ORG.Yocms_client',LIB_PATH);
$Yocms_api = new Yocms_client();
$data['id']=1;
$data['password']=123456;
print_r($Yocms_api->get_common_info(1001,$data,'post'));

$data['mobile']=1;
$data['password']=123456;
$data['community_id']=1;
print_r($Yocms_api->get_common_info(1003,$data,'post'));




