<?php
/**
 * 按json方式
*/
class Json extends Jres {
	public function response($code, $message = '', $data = array()) {
		if(!(is_numeric($code))) {
			return '';
		}

		$result = array(
			'code' => $code,
			'message' => $message,
			'data' => $data
		);

		echo json_encode($result,JSON_UNESCAPED_UNICODE);
		exit;
	}
}