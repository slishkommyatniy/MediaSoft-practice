<?php
$pdo = new PDO ('mysql:dbname=mybd;host=localhost:3306', 'root','root');
$selectQueryWords = 'SELECT * FROM `word` WHERE  `text_id` = ( SELECT max(`ID`) FROM `uploaded_text`)';
$selectQueryUploaded_text = 'SELECT * FROM `uploaded_text`  WHERE `ID`=( SELECT max(`ID`) FROM `uploaded_text`)';
$allRowWords = $pdo -> query($selectQueryWords) -> fetchAll(PDO::FETCH_ASSOC);
$allRowUploaded_text = $pdo -> query($selectQueryUploaded_text) -> fetchAll(PDO::FETCH_ASSOC);
$RowWords = $pdo -> query($selectQueryWords) -> fetch(PDO::FETCH_ASSOC);
$RowUploaded_text = $pdo -> query($selectQueryUploaded_text) -> fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang = "ru">
<head>
    <meta charset = "utf-8"/>
    <title>Details</title>
</head>
<body>

<form action="/mainpage.php" target="_blank">
    <button>На главную</button><br>
</form>

<form method="post" enctype="multipart/form-data">
    <table cellpadding="5" border="2" align="center" bordercolor="blue" >
        <?php foreach($allRowUploaded_text as $RowUploaded_text) {?>
            <tr>
                <td><?= $RowUploaded_text['content']?></td>
            </tr>

            <tr>
                <td>Всего слов : <?= $RowUploaded_text['words_count']?></td>
            </tr>
        <?php }?>
        <br>
    </table>
</form>

<form method="post" enctype="multipart/form-data">
    <table  cellpadding="5" border="2" align="center" bordercolor="blue">
        <thead bgcolor="#B0E0E6">
        <tr>
            <td>Word</td>
            <td>Count</td>
        </tr>
        </thead>

        <tbody>
        <?php foreach($allRowWords as $RowWords) {?>
            <tr>
                <td><?= $RowWords['word']?></td>
                <td><?= $RowWords['count']?></td>
            </tr>
        <?php }?>
        </tbody>
        <br>
    </table>
</form>

</body>

</html>

