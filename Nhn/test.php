<?php 
require_once('Nhn.php');
$Nhn=new Nhn();

$arrToCheck=array('p1','p2');
if($Nhn->check($arrToCheck,'GET')){
	echo "参数正确";
}else{
	echo $Nhn->getMsg();
}

 ?>