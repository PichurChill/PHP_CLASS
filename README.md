# PHP_CLASS
PHP_CLASS  --PHP类

自用PHP类

| 编号 | 名字 | 用途 | 版本 | TODO |
|------| ---- |------| -----|------|
|1|单/多文件上传类| 文件上传类 |V1.0 |--结果返回以参数形式选定--|

##1、单/多文件上传类
[参考慕课网教程](http://www.imooc.com/learn/219)

参考了慕课网教程改成的单/多文件上传类

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
