<?php
require('lib/common.php');

$id = $_GET['id'] ?? 0;
$page = $_GET['page'] ?? 1;

$fpp = 50;

$category = $sql->fetch("SELECT * FROM uploader_categories WHERE id = ?", [$id]);

$ufields = userfields('u', 'u');
$files = $sql->query("SELECT f.*, $ufields FROM uploader_files f JOIN users u ON u.id = f.user WHERE f.cat = ? ORDER BY date DESC LIMIT ?,?",
	[$id, ($page - 1) * $fpp, $fpp]);

_pageheader($category['name']);

$topbot = [
	'title' => $category['name']
];

_RenderPageBar($topbot);

if ($log && $loguser['powerlevel'] > 0) {
	?><br><form action="upload.php" method="post" enctype="multipart/form-data"><table class="c1" style="width:auto;margin:auto">
		<input type="hidden" name="cat" value="<?=$id?>">
		<tr class="h"><td class="b h" colspan="2">Upload</td></tr>
		<tr>
			<td class="b n1 center" width="150">File:</td>
			<td class="b n2"><input type="file" name="uploadedfile" size="40"></td>
		</tr><tr>
			<td class="b n1 center">Description:</td>
			<td class="b n2"><input type="text" name="description" size="45" maxlength="512"></td>
		</tr><tr>
			<td class="b n1 center"></td>
			<td class="b n2 sfont"><?=$uconf['disclaimer']?></td>
		</tr><tr>
			<td class="b n1 center"></td>
			<td class="b n2"><input type="submit" name="action" value="Upload"></td>
		</tr>
	</table></form><?php
}

?><br><table class="c1">
	<tr class="h">
		<td class="b h" width="270">File</td>
		<td class="b h">Description</td>
		<td class="b h" width="230">Uploaded by</td>
		<td class="b h" width="180">Date</td>
		<td class="b h" width="120">Size</td>
		<!--<td class="b h" width="100">Downloads</td>-->
	</tr><?php

$zebra = 1;
while ($file = $files->fetch()) {
	$zebra = ($zebra == 1 ? 2 : 1);

	?><tr class="n<?=$zebra?>">
		<td class="b"><a href="get.php?id=<?=$file['id']?>"><?=$file['filename']?></a></td>
		<td class="b"><?=$file['description']?></td>
		<td class="center b"><?=_userlink($file, 'u')?></td>
		<td class="center b"><?=date('Y-m-d H:i', $file['date'])?></td>
		<td class="center b"><?=sizeunit(filesize('files/'.$file['id'].'_'.$file['filename']))?></td>
		<!--<td class="center b"><?=$file['downloads']?></td>-->
	</tr><?php
}
if_empty_query($category['files']+1, "No files uploaded.", 5);

echo '</table>'.pagelist($category['files'], $fpp, "files.php?id=".$id, $page);

_pagefooter();
