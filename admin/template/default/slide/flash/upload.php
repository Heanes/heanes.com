<?php
$pic_id = time();//使用时间来模拟图片的ID.
$pic_path = './avatar_origin/'.$pic_id.'.jpg';
//上传后图片的绝对地址
$pic_abs_path = 'http://heanes.com/admin/template/default/slide/flash/avatar_origin/'.$pic_id.'.jpg';
//保存上传图片.
if(empty($_FILES['Filedata'])) {
	echo 'alert("对不起, 图片未上传成功, 请再试一下");';
	exit();
}

$file = $_FILES['Filedata']['tmp_name'];



if(!move_uploaded_file($_FILES['Filedata']['tmp_name'], $pic_path)) 
{
	echo 'alert("对不起, 上传失败");';
}

//写新上传照片的ID.
echo 'buildAvatarEditor("'.$pic_id.'","'.$pic_abs_path.'","photo");';
?>