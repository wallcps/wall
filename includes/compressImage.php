<?php
//Compress Image
function compressImage($ext,$uploadedfile,$upload_path,$actual_image_name,$newwidth,$prefix)
{
	if($ext=="jpg" || $ext=="jpeg" )
	{
	$src = imagecreatefromjpeg($uploadedfile);
	}
	else if($ext=="png")
	{
	$src = imagecreatefrompng($uploadedfile);
	}
	else if($ext=="gif")
	{
	$src = imagecreatefromgif($uploadedfile);
	}
	else
	{
	$src = imagecreatefrombmp($uploadedfile);
	}

	list($width,$height)=getimagesize($uploadedfile);
	$newheight=($height/$width)*$newwidth;
	$tmp=imagecreatetruecolor($newwidth,$newheight);
	imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
	$filename = $upload_path.$prefix.'_'.$actual_image_name;
	imagejpeg($tmp,$filename);
	imagedestroy($tmp);
	return $filename;
}
?>
