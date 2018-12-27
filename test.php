<?php

$allTests = glob('db_tests/*.json');
$number = $_GET['number'];
$test = file_get_contents($allTests[$number]);
$test = json_decode($test, true);

// Если была нажата кнопка проверки теста, то проверить и вывести результат
if (isset($_POST['check-test'])) {
    function checkTest($testFile) {
        foreach ($testFile as $key => $item) {
            if (!isset($_POST['answer' . $key])) {
                echo 'Должны быть решены все задания!';
                exit;
            }
        }

        $i = 0;
        $questions = 0;
        foreach ($testFile as $key => $item) {
            $questions++;
            // Здесь идет определение названия класса для блока с вопросом и ответом, чтобы выводить красный/зеленый фон для удобства
            // А также прибавляется 1 к переменной $i, если ответ правильный
            if ($item['correct_answer'] === $_POST['answer' . $key]) {
                $i++;
                $infoStyle = 'correct';
            } else {
                $infoStyle = 'incorrect';
            }

            // Вывод блока с вопросом и ответом
            echo "<div>";
            echo 'Вопрос: ' . $item['question'] . '<br>';
            echo 'Ваш ответ: ' . $item['answers'][$_POST['answer' . $key]] . '<br>';
            echo 'Правильный ответ: ' . $item['answers'][$item['correct_answer']] . '<br>';
            echo '</div>';
            echo '<hr>';
        }
        echo '<p style="font-weight: bold;">Итого правильных ответов: ' . $i . ' из ' . $questions . '</p>';
    }
}


?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Тест: <?= $question ?></title>
</head>
<body>

 <!-- Если пользователь находиться на тесте, ссылка введет на страницу с тестами -->

    <a href="<?php echo isset($_POST['check-test']) ? $_SERVER['HTTP_REFERER'] : 'list.php' ?>"><div><b>На страницу со списком тестов</b>>></div></a><br>

    <hr>
    

<form method="POST">

    <h1><?php echo basename($allTests[$number]); ?></h1>
            <?php foreach($test as $key => $item): ?>       

    <fieldset>
        <legend><?php echo $item['question'] ?></legend>
        
            <label><input type="radio" name="answer<?php echo $key ?>" value="0"><?php echo $item['answers'][0]?></label>
            <label><input type="radio" name="answer<?php echo $key ?>" value="1"><?php echo $item['answers'][1]?></label>
            <label><input type="radio" name="answer<?php echo $key ?>" value="2"><?php echo $item['answers'][2]?></label>
            <label><input type="radio" name="answer<?php echo $key ?>" value="3"><?php echo $item['answers'][3]?></label>
        
    </fieldset>

    <?php endforeach; ?>
    <input type="submit" name="check-test" value="Проверить">
</form>



    <!-- Нажал на кнопку проверки теста -  вывели ему результаты -->

    <div class="check-test">
        <?php if (isset($_POST['check-test'])) echo checkTest($test); ?>
    </div>

</body>
</html>
