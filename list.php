<?php

$allFiles = glob('db_tests/*.json');

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список тестов</title>
</head>
<body>

    <!-- Цикл, который выводит список всех загруженных файлов -->
    <?php if (!empty($allFiles)): ?>
        <?php foreach ($allFiles as $file): ?>

            <div class="file-block">
                <h1><?php echo str_replace('db_tests/', '', $file); ?></h1><br>
                <em>Загружен: <?php echo date("d-m-Y H:i", filemtime($file)) ?></em><br>
                <a href="test.php?number=<?php echo array_search($file, $allFiles); ?>">Перейти на страницу с тестом ></a>
            </div>
            <hr>

        <?php endforeach; ?>
    <?php endif; ?>
    <?php if (empty($allFiles)) echo 'Пока не загружено ни одного теста';?>
    

</body>
</html>
