<?php 
class upload{
	protected $filename;
	protected $maxSize;
	protected $allowMime;
	protected $allowExt;
	protected $uploadPath;
	protected $imgFlag;
	protected $fileInfo;
	protected $error;
	protected $ext;
	/**
	 * [__construct description]
	 * @param string  $filename   [description]
	 * @param string  $uploadPath [description]
	 * @param boolean $imgFlag    [description]
	 * @param integer $maxSize    [description]
	 * @param array   $allowExt   [description]
	 * @param array   $allowMime  [description]
	 */
	public function __construct($filename='myfile',$uploadPath='./upload',$imgFlag=true,$maxSize=3145728,$allowExt=array('jpeg','jpg','png','gif'),$allowMime=array('image/jpeg','image/png','image/gif')){
		$this->filename=$filename;
		$this->maxSize=$maxSize;
		$this->allowMime=$allowMime;
		$this->allowExt=$allowExt;
		$this->uploadPath=$uploadPath;
		$this->imgFlag=$imgFlag;
		$this->fileInfo=array();
		// $this->fileInfo=$_FILES[$this->filename];
		$i=0;
		foreach ($_FILES as $file) {
			if (is_string($file['name'])) {
				$this->fileInfo[$i]=$file;
				$i++;
			}elseif(is_array($file['name'])){
				foreach ($file['name'] as $key => $value) {
					$this->fileInfo[$i]['name']=$file['name'][$key];
					$this->fileInfo[$i]['type']=$file['type'][$key];
					$this->fileInfo[$i]['tmp_name']=$file['tmp_name'][$key];
					$this->fileInfo[$i]['error']=$file['error'][$key];
					$this->fileInfo[$i]['size']=$file['size'][$key];
					$i++;
				}
			}
		}
		$this->imgNum=$i;
		// return $fileInfo;
	}

	/**
	 * 检测上传文件是否有出错
	 * @return bool
	 */
	protected function checkError($i){
		if(!is_null($this->fileInfo[$i])) {
			if ($this->fileInfo[$i]['error'] > 0) {
				switch ($this->fileInfo[$i]['error']) {
					case 1:
						$this->error = '超过了PHP配置文件中upload_max_filesize选项的值';
						break;
					case 2:
						$this->error = '超过了表单中MAX_FILE_SIZE设置的值';
						break;
					case 3:
						$this->error = '文件部分被上传';
						break;
					case 4:
						$this->error = '没有选择上传文件';
						break;
					case 6:
						$this->error = '没有找到临时目录';
						break;
					case 7:
						$this->error = '文件不可写';
						break;
					case 8:
						$this->error = '由于PHP的扩展程序中断文件上传';
						break;

				}
				return false;
			} else {
				return true;
			}
		}else{
			$this->error='文件上传出错';
			return false;
		}

	}

	/**
	 * 检测上传文件的大小
	 * @return bool
	 */
	protected function checkSize($i){
		if($this->fileInfo[$i]['size']>$this->maxSize){
			$this->error='上传文件过大';
			return false;
		}
			return true;
	}

	/**
	 * 检测扩展名
	 * @return bool
	 */
	protected function checkExt($i){
		$this->ext=strtolower(pathinfo($this->fileInfo[$i]['name'],PATHINFO_EXTENSION));
		if(!in_array($this->ext,$this->allowExt)){
			$this->error='不允许的扩展名';
			return false;
		}
		return true;
	}

	/**
	 * 检测文件类型
	 * @return bool
	 */
	protected function  checkMime($i){
		if(!in_array($this->fileInfo[$i]['type'],$this->allowMime)){
			$this->error='不允许的文件类型';
			return false;
		}
		return true;
	}

	/**
	 * 检测是否是真实图片
	 * @return bool
	 */
	protected function checkTrueImg($i){
		if($this->imgFlag){
			if(!@getimagesize($this->fileInfo[$i]['tmp_name'])){
				$this->error='不是真实的图片';
				return false;
			}
			return true;
		}
	}

	/**
	 * 检测是否通过http post方式上传的
	 * @return bool
	 */
	protected  function checkHTTPPost($i){
		if(!is_uploaded_file($this->fileInfo[$i]['tmp_name'])){
			$this->error='该文件不是通过http post方式上传的';
			return false;
		}
		return true;
	}

	/**
	 * 显示错误
	 */
	protected function showError(){
		if(!empty($this->errorInfo)){
			foreach ($this->errorInfo as $key => $value) {
				echo $value;//输出错误 可以按照需求改错误提示形式
			}
		}
	}

	/**
	 * 检测目录不存在 则创建
	 */
	protected  function checkUploadPath(){
		if(!file_exists($this->uploadPath)){
			mkdir($this->uploadPath,0777,true);
		}
	}

	/**
	 * 产生唯一字符串
	 * @return string
	 */
	protected function getUniName(){
		return md5(uniqid(microtime(true),true));
	}

	/**
	 * 上传文件
	 *  @return string
	 */
	protected function toDoUpload($i){
		if($this->checkError($i)&&$this->checkSize($i)&&$this->checkExt($i)&&$this->checkMime($i)&&$this->checkTrueImg($i)&&$this->checkHTTPPost($i)){
			$this->checkUploadPath();
			$this->uniName=$this->getUniName();
			$this->destination=$this->uploadPath.'/'.$this->uniName.'.'.$this->ext;
			if(move_uploaded_file($this->fileInfo[$i]['tmp_name'],$this->destination)){
				return $this->destination;
			}else{
				$this->error='文件移动失败';
			}
		}else{
			$this->errorInfo[$i]="第{$i}个文件：".$this->error."<br>";
		}
	}
	/**
	 * 上传文件
	 * @return string
	 */
	public function uploadFile(){
		for($i=0;$i<$this->imgNum;$i++){
			$this->toDoUpload($i);
		}
		$this->showError();

	}
}