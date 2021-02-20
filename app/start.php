<?php
// Start framework
require 'libs/DotEnv.php';
require 'libs/EasyRouter.php';

use AmitKhare\DotEnv;
use AmitKhare\EasyTemplate;

$envFile = __DIR__ . '/../.env';
if(!file_exists($envFile)){
   echo ".env file does not found.";
   exit;
}
(new DotEnv($envFile))->load();
// include common.php
include_once("common.php");

$template = new EasyTemplate(__DIR__.'/', $data);

$cleanPages = ['get', 'thumbnail'];
if(in_array($p, $cleanPages)){
   echo $template->view('views/pages/'.$p);
   exit();
}

echo $template->view('template/header',['title'=> 'Learn']);
echo $template->view('views/pages/'.$p);
echo $template->view('template/footer');
