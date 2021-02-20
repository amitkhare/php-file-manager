<?php
header('Content-Type: image/jpg');
$im = new imagick();

// check if thumbnail exists
$thumbnail = $thumbnailDirectory.$nameWithoutExtension.'.png';

// show image from thumbnails if exists
if(file_exists($thumbnail)){
  $content = file_get_contents($thumbnail);
  echo $content;
  exit();
}

// show image from icons if exists
if(file_exists($thumbnailIconsDir.$nameWithoutExtension.'.png')){
  $content = file_get_contents($thumbnailIconsDir.$nameWithoutExtension.'.png');
  echo $content;
  exit();
}

// check if target file exists
if(!file_exists($filename)){
    // file not found 
    // show generic thumbnail
    $im = new imagick($thumbnailIconsDir."default.png");
    echo $im;
    exit;
} else {
  try {
    $im->readImage($filename . '[0]');
    $im->setImageFormat('png');
  } catch (Exception $e) {
    $im = new imagick($thumbnailIconsDir."default.png");
    echo $im;
    exit;
  }
  
}

// chrop and resize image
$imageprops = $im->getImageGeometry();
$width = $imageprops['width'];
$height = $imageprops['height'];
if($width > $height){
    $newHeight = 256;
    $newWidth = (256 / $height) * $width;
}else{
    $newWidth = 256;
    $newHeight = (256 / $width) * $height;
}
$im->resizeImage($newWidth,$newHeight, imagick::FILTER_LANCZOS, 0.9, true);
$im->cropImage (256,256,0,0);

// save to disk
$im->writeImage( $thumbnail );

// return image;
echo $im;
exit;
