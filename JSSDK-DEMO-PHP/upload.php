<?php
namespace app\models\Jssdk;
use Yii;
use yii\base\Model;
/**
* 
*/
class Upload extends Model
{
	private $media_id;

	public function __construct($media_id) {
	    $this->media_id = $media_id;
	}
	public  function uploadVoice(){
		$data = json_decode($this->get_php_file("../models/Jssdk/access_token.php"));
		$access_token = $data->access_token;
		// $media_id='6AJLCDFGad9nZoZClCZ6L9XrXQX_GOpUFQEx-C6sb34fuNaKR-8RZ0X3A-YG3uV1';
		$url = "https://api.weixin.qq.com/cgi-bin/media/get?access_token=".$access_token."&media_id=".$this->media_id."";

		$return_content = $this->http_get_data($url); 
		$pathName=date('Y-m-d');
        $this->checkUploadPath('audio'.'/'.$pathName);
		$filename = md5(uniqid(microtime(true),true)).".amr";
		// $filename = md5(uniqid(microtime(true),true)).".wmv";

		$fp= @fopen("audio/".$pathName.'/'.$filename,"a"); //将文件绑定到流
		
		$fw=fwrite($fp,$return_content); //写入文件 
		fclose($fp);  //关闭文件流
		if($fw){
			$rp="audio/".$pathName.'/'.$filename;
			return $rp;
		}else{
			return false;
		}
	}
    
	private function http_get_data($url) {  
		  
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
	private function get_php_file($filename) {
    // return trim(substr(file_get_contents($filename), 15));
    	return trim(file_get_contents($filename));
	}
	private  function checkUploadPath($uploadPath){
        if(!file_exists($uploadPath)){
            mkdir($uploadPath,0777,true);
        }
    }

}

?>