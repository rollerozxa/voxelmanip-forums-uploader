<?php
// Only include the bare essentials
chdir('../');
require('conf/config.php');
include('lib/mysql.php');
chdir('uploader');

$id = $_GET['id'] ?? null;

$entry = $sql->fetch("SELECT id, filename from uploader_files where id = ?", [$id]);

if (!$entry) die("Nothing specified.");

$path = 'files/'.$entry['id'].'_'.$entry['filename'];

if(!file_exists($path))
	die("No such file.");

$fsize = filesize($path);
$parts = pathinfo($path);
$ext = strtolower($parts["extension"]);

$ctype = match ($ext) {
	'gif' => 'image/gif',
	'apng', 'png' => 'image/png',
	'jpeg', 'jpg' => 'image/jpg',
	'css' => 'text/css',
	'txt' => 'text/plain',
	'pdf' => 'application/pdf',
	//'ogg', 'oga' => 'audio/ogg',
	default => 'application/octet-stream'};

$download = match ($ext) {
	'gif', 'apng', 'png', 'jpeg', 'jpg', 'css', 'txt', 'pdf' => false,
	default => true};

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);
header("Content-Type: ".$ctype);
header("Content-Disposition: filename=\"".$entry['filename']."\"");
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".$fsize);

readfile($path);
