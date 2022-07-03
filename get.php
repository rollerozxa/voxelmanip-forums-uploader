<?php
// Only include the bare essentials
chdir('../');
require('conf/config.php');
include('lib/mysql.php');
chdir('uploader');
require('lib/formats.php');

$id = $_GET['id'] ?? null;

$entry = $sql->fetch("SELECT id, filename from uploader_files where id = ?", [$id]);

if (!$entry) die("Nothing specified.");

$path = 'files/'.$entry['id'].'_'.$entry['filename'];

if(!file_exists($path))
	die("No such file.");

$fsize = filesize($path);
$parts = pathinfo($path);
$ext = strtolower($parts["extension"]);

$ctype = extToMime($ext);

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);
header("Content-Type: ".$ctype);
header("Content-Disposition: filename=\"".$entry['filename']."\"");
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".$fsize);

readfile($path);
