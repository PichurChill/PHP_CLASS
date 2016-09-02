<?php
/**
 * 抽象类
*/
abstract class Jres {

	const JSON = 'Json';
	const XML = 'Xml';
	const ARR = 'Array';
	
	/**
	* 工厂方法
	* @param [string] $type 返回数据类型
	*/
	public static function type($type = self::JSON) {
		$type = (isset($_GET['format'])&&!empty($_GET['format'])) ? $_GET['format'] : $type;
		$resultClass = ucwords(strtolower($type));
		require_once('./class/' . $type . '.php');
		return new $resultClass();
	}
	/**
	 * [数据返回方法]
	 * @param  [String or Integer] $code    [返回代码，根据需要int或string]
	 * @param  [String] $message [返回说明]
	 * @param  [Array] $data    [待转换数据]
	 * @return [JSON or XML]          [返回数据]
	 */
	abstract function response($code, $message, $data);
}