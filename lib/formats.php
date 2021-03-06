<?php

function extToMime($ext) {
	match ($ext) {
		'aac'	=> 'audio/aac',
		'avif'	=> 'image/avif',
		'bmp'	=> 'image/bmp',
		'bz'	=> 'application/x-bzip',
		'bz2'	=> 'application/x-bzip2',
		'css'	=> 'text/css',
		'csv'	=> 'text/csv',
		'doc'	=> 'application/msword',
		'docx'	=> 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
		'epub'	=> 'application/epub+zip',
		'gz'	=> 'application/gzip',
		'gif'	=> 'image/gif',
		'jpeg',
		'jpg'	=> 'image/jpeg',
		'json'	=> 'application/json',
		'mid',
		'midi'	=> 'audio/midi',
		'mp3'	=> 'audio/mpeg',
		'mp4'	=> 'video/mp4',
		'odp'	=> 'application/vnd.oasis.opendocument.presentation',
		'ods'	=> 'application/vnd.oasis.opendocument.spreadsheet',
		'odt'	=> 'application/vnd.oasis.opendocument.text',
		'oga',
		'ogg'	=> 'audio/ogg',
		'ogv'	=> 'video/ogg',
		'opus'	=> 'audio/opus',
		'png'	=> 'image/png',
		'pdf'	=> 'application/pdf',
		'ppt'	=> 'application/vnd.ms-powerpoint',
		'pptx'	=> 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
		'rar'	=> 'application/vnd.rar',
		'rtf'	=> 'application/rtf',
		'svg'	=> 'image/svg+xml',
		'swf'	=> 'application/x-shockwave-flash',
		'tar'	=> 'application/x-tar',
		'tif',
		'tiff'	=> 'image/tiff',
		'ttf'	=> 'font/ttf',
		'txt'	=> 'text/plain',
		'webm'	=> 'video/webm',
		'webp'	=> 'image/webp',
		'woff'	=> 'font/woff',
		'woff2'	=> 'font/woff2',
		'xls'	=> 'application/vnd.ms-excel',
		'xlsx'	=> 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
		'xml'	=> 'application/xml',
		'zip'	=> 'application/zip',
		'3gp'	=> 'video/3gpp',
		'7z'	=> 'application/x-7z-compressed',

		// Misc. files that should be plain text
		'lua'	=> 'text/plain',

		default => 'application/octet-stream'
	};
}