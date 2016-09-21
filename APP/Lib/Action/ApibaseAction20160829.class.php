<?php
class ApibaseAction extends ApiCommonAction{

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


	/**
	 * 防注入检查
	 */
	public function check_sql_filter(){
		//防注入检查 by soul
		foreach ( $_REQUEST as $key => $value ) {
			if (is_array ( $value )) {
				$value = implode ( $value );
			}
			if (preg_match ( "/" . $this->requestfilter . "/is", $value ) == 1) {
				$this->ajaxReturn('','操作失败',0);
			}
		}
	}

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

}