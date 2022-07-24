<?php

function _RenderPageBar($pagebar) {
	if (empty($pagebar)) return;

	echo '<div class="breadcrumb"><a href="./">Uploader</a> &raquo; ';
	if (!empty($pagebar['breadcrumb'])) {
		foreach ($pagebar['breadcrumb'] as $url => $title)
			printf('<a href=%s>%s</a> &raquo; ', '"'.esc($url).'"', $title);
	}
	echo $pagebar['title'].'<div class="actions">';
	if (!empty($pagebar['actions']))
		renderActions($pagebar['actions']);
	echo "</div></div>";
}

function sizeunit($bytes, $precision = 2) {
	$units = ['B', 'kB', 'MB', 'GB', 'TB'];
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= (1 << (10 * $pow));
	return round($bytes, $precision).' '.$units[$pow];
}

function _userlink($user, $u = '') {
	return '<a href="../profile.php?id='.$user[$u.'id'].'">'.userdisp($user, $u).'</a>';
}
