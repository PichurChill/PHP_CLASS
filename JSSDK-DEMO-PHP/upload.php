<?php
/**
请开启PHP的扩展
extension=php_curl.dll
extension=php_openssl.dll

access_token 是公众号的全局唯一票据，公众号调用各接口时都需使用access_token。开发者需要进行妥善保存。access_token的存储至少要保留512个字符空间。access_token的有效期目前为2个小时，需定时刷新，重复获取将导致上次获取的access_token失效。

media_id 来自微信内页传过来的自定义参数

**/
$media_id = $_GET['media_id'];
$data = json_decode(get_php_file("access_token.php"));
$access_token = $data->access_token;
// $media_id='6AJLCDFGad9nZoZClCZ6L9XrXQX_GOpUFQEx-C6sb34fuNaKR-8RZ0X3A-YG3uV1';
$url = "https://api.weixin.qq.com/cgi-bin/media/get?access_token=".$access_token."&media_id=".$media_id."";


print_r($return_content);
$filename = date("Ymdhis").".amr";
$fp= @fopen($filename,"a"); //将文件绑定到流
fwrite($fp,$return_content); //写入文件  
fclose($fp);  //关闭文件流


function get_php_file($filename) {
    return trim(file_get_contents($filename));
}
 function http_get_data($url) {  
	  
	$ch = curl_init ();  
	curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );  
	curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );  
	curl_setopt ( $ch, CURLOPT_URL, $url );  
	ob_start ();  
	curl_exec ( $ch );  
	$return_content = ob_get_contents ();  
	ob_end_clean ();  
	  
	$return_code = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );  
	return $return_content;  
}
?>