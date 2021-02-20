<?php

$siteTitle          = (getenv('SITE_TITLE')) ? getenv('SITE_TITLE')                               : "File Manager";
$siteURL            = (getenv('SITE_URL')) ? getenv('SITE_URL')                                   : "https://khare.co.in";
$baseDirectory      = (getenv('BASE_DIRECTORY')) ? getenv('BASE_DIRECTORY')                       : __DIR__.'/../files/';
$thumbnailDirectory = (getenv('THUMBNAIL_DIRECTORY')) ? getenv('THUMBNAIL_DIRECTORY')             : __DIR__."/../thumbnails/";
$thumbnailIconsDir  = (getenv('THUMBNAIL_ICONS_DIRECTORY')) ? getenv('THUMBNAIL_ICONS_DIRECTORY') : __DIR__."/assets/icons/";
$bannerURL          = (getenv('BANNER_URL')) ? getenv('BANNER_URL')                               : "banner.jpg";

$hiddenEntries = ['.', '..', 'index.html', 'index.php', '.cache', '.c9', 'node_modules', 'EMPTY','empty', '.git', '.gitignore', '.gitkeep'];
$hiddenExtensions = ['php','html','cgi','py','bin', 'exe'];


$d = ($_GET['d'] ? $_GET['d']. "/" : "");
$d = str_replace('../', '', $d);
$f = ($_GET['f'] ? $_GET['f']. "" : "");
$f = str_replace('../', '', $f);
$p = ($_GET['p'] ? $_GET['p']. "" : "home");
$p = str_replace('../', '', $p);

$levels = explode('/', $d);

// make $breadcrumb links
$breadcrumbPath = '';
$breadcrumb = "";
for ($i = 0; $i < count($levels); $i++) {
  $item = $levels[$i];
  if($i < (count($levels)-2) ) {
    $breadcrumb .= '<li class="breadcrumb-item"><a href="?p='.$p.'&d='.urlencode($breadcrumbPath.$item).'">'.$item.'</a></li>';
  } else {
    $breadcrumb .= '<li class="breadcrumb-item active">'.$item.'</li>';
  }
  $breadcrumbPath  .= $item.'/';
}

$currDirectory = $baseDirectory.$d;
// full file name with path
$filename = $currDirectory.$f;

$pi = pathinfo($filename);
$nameWithoutExtension = $pi['filename'];
$extension            = $pi['extension'];

// list Contents of directory

$entries = [];
if ($handle = opendir($currDirectory))
{ 
  while (false !== ($entry = readdir($handle))) { 
    if (!in_array($entry, $hiddenEntries) && !in_array(pathinfo($entry)['extension'], $hiddenExtensions)) {
      $entries[] = $entry;
    }  
  }
closedir($handle);
}



// set data to be avaiable in all child pages
$data = [
  "d" => $d,
  "f" => $f,
  "p" => $p,
  "APP_DIR" => __DIR__.'/',
  "baseDirectory" => $baseDirectory,
  "currDirectory" => $currDirectory,
  "thumbnailDirectory" => $thumbnailDirectory,
  "thumbnailIconsDir" => $thumbnailIconsDir,
  "filename" => $filename,
  "nameWithoutExtension" => $nameWithoutExtension,
  "extension" => $extension,
  "levels" => $levels,
  "breadcrumb" => $breadcrumb,
  "entries" => $entries,
  "siteTitle"=> $siteTitle,
  "bannerURL" => $bannerURL
];

