<?php 
require_once('Jres.php');
$arr=['list'=>[
		["name"=>"u1","age"=>14],
		["name"=>"u2","age"=>15],
		["name"=>"u3","age"=>16],
		["name"=>"u4","age"=>17],
		["name"=>"u5","age"=>18]
	],'type'=>2
];
echo Jres::type()->response(1,'成功',$arr);//JSON
// echo Jres::dataType('json')->response(1,'成功',$arr);//JSON
// echo Jres::dataType('xml')->response(1,'成功',$arr);//XML
?>