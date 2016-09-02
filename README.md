# PHP_CLASS

**自用PHP类**

| 编号 | 名字 | 用途 | 版本 | TODO |
|------| ---- |------| -----|------|
|1|[multiple_upload_class](#1multiple_upload_class)| 单/多文件上传类 |V1.0 |结果返回以参数形式选定|
|2|[JSSDK-DEMO-PHP](#2jssdk-demo-php)|微信JSSDK DEMO|V1.0 |token存取方式更改|
|3|[Jres](#3jres)|数据通信分装类|V1.0 ||
|4|[Nhn](#4nhn)|没有名字类|V0.1 |根据以后需要完善|

##1、multiple_upload_class
###单/多文件上传类
[参考慕课网教程](http://www.imooc.com/learn/219)

参考了慕课网教程改成的单/多文件上传类
#####使用方式：
前端：
```HTML
<form action="doActionfinal.php" method="post" enctype="multipart/form-data">
    请选择要上传的文件
    <br>
    多选框：
    <input type="file" name="myfile[]" multiple="multiples" ><br>
	  单选框：
    <input type="file" name="myfile[]" ><br>
    <input type="submit" value="上传文件">
</form>
```
后台类调用
```PHP
require_once 'upload.class.php';
$upload=new upload('myfile','jin');//参数1为上传框字段名，参数2为图片存放地址文件夹名
$result=$upload->uploadFile();
```


##2、JSSDK-DEMO-PHP
###微信JSSDK DEMO

（Yii2）主要还是来自[微信官方的代码]( https://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html#.E9.99.84.E5.BD.956-DEMO.E9.A1.B5.E9.9D.A2.E5.92.8C.E7.A4.BA.E4.BE.8B.E4.BB.A3.E7.A0.81)，结合网上修改了部分地方，如curl那里以及token的存取。

##3、Jres
###数据通信分装类

同样是学习的慕课网上的课程封装的类，比较有可扩展性。
#####使用方式：
方式1、
$type :不区分大小写，默认JSON，可选：JSON、 XML
```php
require_once('Jres.php');
Jres::type($type)->response(1,'成功',$arr);
```
方式2、
由前端指定
带上参数format，不区分大小写：JSON、 XML
```php
http://the/request/path/test.php?format=json
```

##4、Nhn
###没有名字类(Not Have a Name)

暂且只是用来作为检测GET或POST方式参数是否传过来了，原本只是在开发的时候写了个简陋的方法，暂时封装类，待以后有其他检测项以后再添加、再取名字。
#####使用方式：
```php
require_once('Nhn.php');
//http://the/request/path/test.php/test.php?p1=1&p2=2
$arrToCheck=array('p1','p2');

$Nhn=new Nhn();
if($Nhn->check($arrToCheck,'GET')){
    echo "参数正确";
}else{
    echo $Nhn->getMsg();
}
```
