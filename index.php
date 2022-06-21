<?php
require('lib/common.php');

_pageheader();

$categs = $sql->query("SELECT * FROM uploader_categories ORDER BY sort,id");
echo '<table class="c1"><tr class="h"><td class="b h">Category</td><td class="b h">Files</td></tr>';
while ($c = $categs->fetch()) {
	printf(
	'<tr class="n1">
		<td class="b" style="padding:5px">
			<a href="files.php?id=%d">%s</a>
			<br><span class="sfont">%s</span>
		</td>
		<td class="center b">%d</td>
	</tr>', $c['id'], $c['name'], $c['description'], $c['files']);
}
echo '</table>';

_pagefooter();