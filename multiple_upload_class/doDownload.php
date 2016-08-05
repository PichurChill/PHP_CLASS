<?php
if(isset($_GET['filename'])&&!empty($_GET['filename'])){
	$filename=$_GET['filename'];
	//会把路径带上，所以加basename
	header('content-disposition:attachment;filename=jin_'.basename($filename));
	header('content-length:'.filesize($filename));
	readfile($filename);
}
