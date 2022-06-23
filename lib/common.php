<?php
chdir('../');
require_once('lib/common.php');

chdir('uploader/');
foreach (glob("lib/*.php") as $filename)
	require_once($filename);

// config
$uconf['maxsize'] = 1*1024*1024;
$uconf['badextensions'] = [
	"html", "htm", "shtm", "shtml", "php", "php5", "htaccess", "htpasswd", "js", "aspx", "cgi",	// Exts that potentially could cause vulns on the server.
	"py", "exe", "com", "bat", "pif", "cmd", "lnk", "vbs", "msc", "stm", "htc",					// General scripting/program extensions that execute on Windows, bad idea to allow them.
	'bmp', 'avi',		// Wasteful media formats, hinder their usage.
];
$uconf['disclaimer'] = 'By uploading files to the uploader, you agree that you will only upload files that you own the copyright to and/or have the permission to upload.'
	.'<br>You should neither upload files that are malicious or any other type of objectionable content.'
	.'<br>Usage of this uploader is only intended to host files related to the Voxelmanip Forums, it is not a general-purpose file host.'
	.'<br>We reserve the right to remove any files uploaded.';

function _pageheader($pagetitle = '') {
	global $sql, $log, $loguser, $boardtitle, $boardlogo, $theme, $boarddesc;

	if ($pagetitle) $pagetitle .= " - ";

	?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
		<title><?=$pagetitle.$boardtitle?> Uploader</title>
		<?php if (isset($boarddesc)) { ?><meta name="description" content="<?=$boarddesc?>"><?php } ?>
		<link rel="stylesheet" href="../theme/common.css">
		<link rel="stylesheet" href="../theme/<?=$theme?>/<?=$theme?>.css">
		<style>
.logo {
	position: relative;
	display: inline-block;
}
.logo .subtitle {
	position: absolute;
	bottom: 0;
	left: 0;
	display: inline-block;
	background: #080808;
	color: #4cf;
	font-size: 175%;
	border: 2px solid #4cf;
	padding: 3px 2px;
	margin: 6px;
}
		</style>
	</head>
	<body>
		<table class="c1">
			<tr class="nt n2 center"><td class="b n1 center" colspan="3">
				<div class="logo">
					<a href="./"><img src="../<?=$boardlogo?>"></a>
					<span class="subtitle">Uploader</span>
				</div>
			</td></tr>
			<tr class="n2">
				<td class="nb headermenu">
					<a href="../">Back to forum</a>
				</td>
				<td class="nb headermenu_right"><?php
	if ($log)
		printf('<span class="menulink">'.userlink($loguser).'</span> ');

	$userlinks = [];

	if (!$log)
		$userlinks[] = ['url' => "login.php", 'title' => 'Login'];
	else
		$userlinks[] = ['url' => "javascript:document.logout.submit()", 'title' => 'Logout'];

	foreach ($userlinks as $v)
		echo "<a class=\"menulink\" href=\"{$v['url']}\">{$v['title']}</a> ";

	echo '</td></table><br>';
}

function _pagefooter() {
	global $start, $uconf;
	$time = microtime(true) - $start;
	?><br>
	<table class="c1">
		<tr><td class="b n2 sfont center">
			<em>Disclaimer: <?=$uconf['disclaimer']?></em>
			<br><br><?=sprintf("Page rendered in %1.3f seconds. (%dKB of memory used)", $time, memory_get_usage(false) / 1024); ?>
		</td></tr>
	</table><?php
}

