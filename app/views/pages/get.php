<?php

function getMimeType( $filename ) {
        $realpath = realpath( $filename );
        if ( $realpath
                && function_exists( 'finfo_file' )
                && function_exists( 'finfo_open' )
                && defined( 'FILEINFO_MIME_TYPE' )
        ) {
                // Use the Fileinfo PECL extension (PHP 5.3+)
                return finfo_file( finfo_open( FILEINFO_MIME_TYPE ), $realpath );
        }
        if ( function_exists( 'mime_content_type' ) ) {
                // Deprecated in PHP 5.3
                return mime_content_type( $realpath );
        }
        return false;
}

function getFileMimeType($file) {
    if (function_exists('finfo_file')) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $type = finfo_file($finfo, $file);
        finfo_close($finfo);
    } else {
        require_once 'upgradephp/ext/mime.php';
        $type = mime_content_type($file);
    }

    if (!$type || in_array($type, array('application/octet-stream', 'text/plain'))) {
        $secondOpinion = exec('file -b --mime-type ' . escapeshellarg($file), $foo, $returnCode);
        if ($returnCode === 0 && $secondOpinion) {
            $type = $secondOpinion;
        }
    }

    if (!$type || in_array($type, array('application/octet-stream', 'text/plain'))) {
        require_once 'upgradephp/ext/mime.php';
        $exifImageType = exif_imagetype($file);
        if ($exifImageType !== false) {
            $type = image_type_to_mime_type($exifImageType);
        }
    }

    return $type;
}

if(!file_exists($filename)){
 echo "<h1>File not found.</h1>";
 echo "<p>$filename</p>";
 echo "<a href='/'>Click here to go home</a>";
exit();
die();
}

header('Pragma: public');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Cache-Control: private', false); // required for certain browsers 
// header('Content-Type: application/pdf');
header('Content-Type: '.getMimeType($filename));

// open in browser
header('Content-Disposition: inline; filename="'. urlencode(basename($filename)) . '";');

// header('Content-Disposition: attachment; filename="'. basename($filename) . '";');

header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($filename));

readfile($filename);

exit;