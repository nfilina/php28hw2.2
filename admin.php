<?php

if (isset($_POST) && isset($_FILES) && isset($_FILES['testfile'])) {
    $file_name = $_FILES['testfile']['name'];
    $tmp_file = $_FILES['testfile']['tmp_name'];
    $uploads_dir = 'db_tests/';
    $path_info = pathinfo($uploads_dir . $file_name);
        if ($path_info['extension'] === 'json') {
            move_uploaded_file($tmp_file, $uploads_dir . $file_name);
            echo 'Тест загружен';
        } else {
            echo 'Необходим файл с расширением .json';
            }
}

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Тест</title>
</head>
<body>

    
    
    <form enctype="multipart/form-data" action="test.php" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="30000">
<input name="userfile" type="file">
<input type="submit" value="Send File">
</form>



</body>
</html>