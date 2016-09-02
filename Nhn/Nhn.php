<?php 
	/**
	* 
	*/
class Nhn {
	private $code=0;	
	private $msg='';	
	private $errParam=array();	

	/**
    *检测参数是否完整
    *param 数组，存放需要检测的参数
    *type POST OR GET
    **/
    public function check(array $param,$type='GET'){
    	$type=strtolower($type);
    	$func=$type.'ParamCheck';
    	$this->$func($param);
        if(!empty($this->errParam)){
        	$this->code=-1;
        	$this->msg="参数".implode('、',$this->errParam)."：缺少或为空";
        	return false;
        }
        $this->code=1;
        $this->msg='参数正确';
        return true;
    }

    public function getMsg(){
    	return $this->msg;
    }
    private function getParamCheck($param){
		foreach ($param as $key => $value) {
			$a="_GET[{$value}]";
            if(!isset($_GET["{$value}"])||empty($_GET["{$value}"])){
            	$this->errParam[]=$value;
            }
        }
    }
    private function postParamCheck($param){
		foreach ($param as $key => $value) {
            if(!isset($_POST["{$value}"])||empty($_POST["{$value}"])){
                	$this->errParam[]=$value;
                }
            }
	}
}
?>