<?php
/**
 * Yocms rsa加密解密类,php需要开启openssl模块
 * @author Yoper 944975166@qq.com
 * http://www.lingligntang.com
 */
class Yocms_rsa
{
	/**
	 * 私钥
	 */
	private $private_key = '-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQC3//sR2tXw0wrC2DySx8vNGlqt3Y7ldU9+LBLI6e1KS5lfc5jl
TGF7KBTSkCHBM3ouEHWqp1ZJ85iJe59aF5gIB2klBd6h4wrbbHA2XE1sq21ykja/
Gqx7/IRia3zQfxGv/qEkyGOx+XALVoOlZqDwh76o2n1vP1D+tD3amHsK7QIDAQAB
AoGBAKH14bMitESqD4PYwODWmy7rrrvyFPEnJJTECLjvKB7IkrVxVDkp1XiJnGKH
2h5syHQ5qslPSGYJ1M/XkDnGINwaLVHVD3BoKKgKg1bZn7ao5pXT+herqxaVwWs6
ga63yVSIC8jcODxiuvxJnUMQRLaqoF6aUb/2VWc2T5MDmxLhAkEA3pwGpvXgLiWL
3h7QLYZLrLrbFRuRN4CYl4UYaAKokkAvZly04Glle8ycgOc2DzL4eiL4l/+x/gaq
deJU/cHLRQJBANOZY0mEoVkwhU4bScSdnfM6usQowYBEwHYYh/OTv1a3SqcCE1f+
qbAclCqeNiHajCcDmgYJ53LfIgyv0wCS54kCQAXaPkaHclRkQlAdqUV5IWYyJ25f
oiq+Y8SgCCs73qixrU1YpJy9yKA/meG9smsl4Oh9IOIGI+zUygh9YdSmEq0CQQC2
4G3IP2G3lNDRdZIm5NZ7PfnmyRabxk/UgVUWdk47IwTZHFkdhxKfC8QepUhBsAHL
QjifGXY4eJKUBm3FpDGJAkAFwUxYssiJjvrHwnHFbg0rFkvvY63OSmnRxiL4X6EY
yI9lblCsyfpl25l7l5zmJrAHn45zAiOoBrWqpM5edu7c
-----END RSA PRIVATE KEY-----';
	/**
	 * 公钥
	 */
	private $public_key = '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC3//sR2tXw0wrC2DySx8vNGlqt
3Y7ldU9+LBLI6e1KS5lfc5jlTGF7KBTSkCHBM3ouEHWqp1ZJ85iJe59aF5gIB2kl
Bd6h4wrbbHA2XE1sq21ykja/Gqx7/IRia3zQfxGv/qEkyGOx+XALVoOlZqDwh76o
2n1vP1D+tD3amHsK7QIDAQAB
-----END PUBLIC KEY-----';
	/**
	 * 加密后的数据
	 */
	private $encrypted = ""; 
	/**
	 * 解密后的数据
	 */
	private $decrypted = ""; 
	
	/**
	 * 构造函数
	 */
	public function __construct()
	{
	    if(!function_exists('openssl_private_encrypt'))
	    {
	        return array('status'=>0,'message'=>'openssl没有开启,请先开启','data'=>'');
	    }
	}
	/**
	 * 私钥加密
	 *@param string $string_data
	 */
	public function Yocms_private_key_encrypt($string_data='')
	{
		$result = array('status'=>0,'message'=>'error','data'=>'');

		$pi_key =  openssl_pkey_get_private($this->private_key);//这个函数可用来判断私钥是否是可用的，可用返回资源id Resource id
		openssl_private_encrypt($string_data,$this->encrypted,$pi_key);//私钥加密
		$this->encrypted = base64_encode($this->encrypted);//加密后的内容通常含有特殊字符，需要编码转换下，在网络间通过url传输时要注意base64编码是否是url安全的
		$result = array('status'=>1,'message'=>'私钥加密成功','data'=>$this->encrypted);
		return $result;
	}
	/**
	 * 公钥解密
	 * @param string $encrypted
     */
	public function Yocms_public_key_decrypt($encrypted_string)
	{
		$result = array('status'=>0,'message'=>'error','data'=>'');
		$pu_key = openssl_pkey_get_public($this->public_key);//这个函数可用来判断公钥是否是可用的
		
		$this->encrypted = $encrypted_string;
		openssl_public_decrypt(base64_decode($this->encrypted),$this->decrypted,$pu_key);//私钥加密的内容通过公钥可用解密出来
		$result = array('status'=>1,'message'=>'公钥解密成功','data'=>$this->decrypted);
		return $result;
	}
	/**
	 * 公钥加密
	 * @param string $string_data
	 */
	public function Yocms_public_key_encrypt($string_data='')
	{
		$pu_key = openssl_pkey_get_public($this->public_key);//这个函数可用来判断公钥是否是可用的

		openssl_public_encrypt($string_data,$this->encrypted,$pu_key);//公钥加密
		$this->encrypted = base64_encode($this->encrypted);
		echo $encrypted;
	}
	/**
	 * 私钥解密
	 * @param string $encrypted_string
	 */
	public function Yocms_private_key_decrypt($encrypted_string)
	{
		$this->encrypted = $encrypted_string;
		openssl_private_decrypt(base64_decode($this->encrypted),$this->decrypted,$pi_key);//私钥解密
		echo $this->decrypted;
	}
}
    //示例代码
    $Yocms_rsa = new Yocms_rsa();
    //
    $string_data='我AA我AAAAAAA我你他';
    echo '<br/>私钥加密:';
    $encrypted_result = $Yocms_rsa->Yocms_private_key_encrypt($string_data);//私钥加密
    echo '<br/>加密后的数据:';
    print_r($encrypted_result);
    $decrypt_data = $Yocms_rsa->Yocms_public_key_decrypt($encrypted_result['data']);//公钥解密
    echo '<br/>解密后的数据:';
    print_r($decrypt_data);