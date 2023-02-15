<?php
    define('UPLOADED_FILE', '/tmp/log_to_check.log');
if (empty($_FILES) || !isset($_FILES['log']['tmp_name'])) { ?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data" target="_blank">
	Log file: <input type="file" name="log" /><br>
	<input type="submit" />
</form>
</body>
</html><?php } else {
    move_uploaded_file($_FILES['log']['tmp_name'], UPLOADED_FILE);
    if(mime_content_type(UPLOADED_FILE) != 'text/plain') die('Error: Wrong file type.');
    if(filesize(UPLOADED_FILE) > 84000) die('Error: file too big');
    exec('php /opt/logchecker.phar analyze /tmp/log_to_check.log', $result);
    echo implode('<br>', $result);
    die(); }
?>