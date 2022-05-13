<?php

$filename = '..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'dropship-seller'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR . explode('&', $_SERVER['QUERY_STRING'])[0];

if (file_exists($filename)) {

	$quality = isset($_GET['qlt']) ? $_GET['qlt'] : 0;
	$ext = pathinfo($filename)['extension'];
	$mime_content_type = 'image/' . $ext;

	header('Content-type: ' . $mime_content_type);
	echo file_get_contents($filename);
	
} else {

	$resource = '../dopamine/images/illustration/no-photo.png';
	$mime_content_type = 'image/png';
	
	header('Content-type: ' . $mime_content_type);
	echo file_get_contents($resource);

}


?>