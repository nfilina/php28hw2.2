<?php

// Если был получен POST-запрос с файлом, то проверяем, подходит ли он
if (isset($_POST['upload'])) {
    // Определяем массив со всеми файлами из папки с тестами
    if (!empty(glob('db_tests/*.json'))) {
        $allFiles = glob('db_tests/*.json');
    } else {
        $allFiles = [0];
    }
    
// Определяем загружаемый файл
    $uploadfile = 'db_tests/' . basename($_FILES['testfile']['name']);
   
}

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Тест</title>
</head>
<body>

<!-- Если файл был отправлен, то выводить информацию о файле и уведомление об успешной загрузке/ошибке -->

<?php if (isset($_POST['upload'])): ?>
    <a href="<?php $_SERVER['HTTP_REFERER'] ?>"><div><<< Назад</div></a>
       
<?php endif; ?>


<!-- Пока файл или форма теста не была отправлена, выводить форму загрузки и форму создания теста -->

<?php if (!isset($_POST['create']) && !isset($_POST['upload'])): ?>

    <form method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Загрузите свой тест в формате json</legend>
            <input type="file" name="testfile" id="uploadfile" required>
            <input type="submit" value="Добавить в базу" id="submit-upload" name="upload">
        </fieldset>
    </form><br>

    <div class="all-tests">
        <fieldset>
            <a href="list.php">Посмотреть все тесты >></a>
        </fieldset>
    </div>

<?php endif; ?>
       
   
</body>
</html>
