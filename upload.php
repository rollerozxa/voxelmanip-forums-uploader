<?php
require('lib/common.php');

$action = $_POST['action'] ?? null;
$cat = $_POST['cat'] ?? null;
$file = $_FILES['uploadedfile'] ?? null;
$description = $_POST['description'] ?? null;

if (!$log || $action != "Upload" || !$cat || !$file) redirect('./');

$category = $sql->fetch("SELECT * FROM uploader_categories WHERE id = ?", [$cat]);

$error = '';

$fname = $file['name'];
$temp = $file['tmp_name'];
$filesize = $file['size'];
$smd = explode(".", $fname);
$extension = strtolower(end($smd));

if (!isset($filesize) || $filesize == 0)
	$error = 'No file given.';
elseif ($filesize > $uconf['maxsize'])
	$error = 'The file you uploaded is larger than the maximum allowed ('.sizeunit($uconf['maxsize']).'). '.
		'<br><br>If this is an image you could try to downscale it in an image editor such as GIMP.';
elseif (in_array($extension, $uconf['badextensions']))
	$error = 'Uploaded file uses an extension that is not allowed.';

$topbot = [
	'breadcrumb' => [[ 'href' => 'files.php?id='.$cat, 'title' => $category['name'] ]],
	'title' => 'Upload'
];

if ($error == '') {
	$description = htmlspecialchars($description);

	$nextId = $sql->result("SELECT MAX(id) FROM uploader_files") +1;

	$returnCode = move_uploaded_file($temp, "files/".$nextId.'_'.$fname);

	if ($returnCode) {
		$sql->query("INSERT INTO uploader_files (id, cat, filename, description, user, date) values (?,?,?,?,?,?)",
			[$nextId, $cat, $fname, $description, $loguser['id'], time()]);

		$sql->query("UPDATE uploader_categories SET files = files + 1 WHERE cat = ?", [$cat]);

		_pageheader('Uploaded successfully');

		noticemsg('Your file has been successfully uploaded. It can be viewed or downloaded <a href="get.php?id='.$nextId.'">here</a>.', 'Uploaded successfully');
		_pagefooter();
	} else {
		$error = 'An unknown error happened while trying to upload the file. Try again later or contact a staff member to let them know about it.';
	}
} else {
	_pageheader('Error');
	_RenderPageBar($topbot);
	echo '<br>';
	noticemsg($error);
	_pagefooter();
}
