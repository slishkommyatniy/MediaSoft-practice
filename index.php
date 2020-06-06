<?php
$new_file = $_FILES['file']['name'];
$new_description = $_POST['description'];

$pdo = new PDO ('mysql:dbname=mybd;host=localhost:3306', 'root','root');

$selectQueryWords = 'SELECT * FROM `word`';
$oneRow = $pdo -> query($selectQueryWords) -> fetch(PDO::FETCH_ASSOC);
$allRow = $pdo -> query($selectQueryWords) -> fetchAll(PDO::FETCH_ASSOC);
$insertQueryWords = 'INSERT INTO 
`word`(`text_id`,`word`,`count`) 
VALUES (?,?,?)';
$insertQueryUploaded_Text = 'INSERT INTO 
`uploaded_text`(`content`,`date`,`words_count`)
VALUES (?,NOW(),?)';
$insertQueryWordsDB = $pdo -> prepare($insertQueryWords);
$insertQueryUploaded_TextDB = $pdo -> prepare($insertQueryUploaded_Text);
$new_file = $_FILES['file']['name'];



function conversion($a){
    $text_lower = mb_strtolower($a); //В нижний регистр
    $text_delete_symbols = str_replace(["\r\n", "\r", "\n", ".", ",","?","!"], "", $text_lower); //Удаление точек,запятых,переноса строк и тд
    $Spaces = explode(" ", $text_delete_symbols);  // Разделение слов по пробелу
    return ($Spaces);
}


function file_csv($new_file, $insertQueryWordsDB, $insertQueryUploaded_TextDB,$pdo)  //Записывает слова, а так же значения с формы файла в file.csv
{
    $file = file_get_contents($new_file);
    $text = count( explode(' ', $file) );
    $insertQueryUploaded_TextDB ->execute([$file,$text]);
    $Spaces = conversion($file);
    $result = array_count_values($Spaces);
    $WordCount = count($Spaces); //Суммарное число слов

    $text_id = $pdo -> lastInsertId();

    foreach ($result as $word => $count) {
        $insertQueryWordsDB->execute([$text_id,$word, $count]);
    }

}

function textarea_csv($new_description, $insertQueryWordsDB, $insertQueryUploaded_TextDB)  //Записывает слова, а так же значения с формы textarea в textarea.csv
{
    $text = count( explode(' ', $new_description) );
    $insertQueryUploaded_TextDB ->execute([$new_description,$text]);
    $Spaces = conversion($new_description);
    $result = array_count_values($Spaces);
    $WordCount = count($Spaces); //Суммарное число слов


    foreach ($result as $word => $count) {
        $insertQueryWordsDB->execute([$word, $count]);
    }
    $insertQueryWordsDB ->execute(["Сумарное число слов",$WordCount]);

}

//Проверки
if (!empty($new_file)) {
    file_csv($new_file, $insertQueryWordsDB, $insertQueryUploaded_TextDB,$pdo);
}
if (!empty($new_description)) {
    textarea_csv($new_description, $insertQueryWordsDB, $insertQueryUploaded_TextDB);
}
?>
<!DOCTYPE html>
<html lang = "ru">
<head>
    <meta charset = "utf-8"/>
    <title>Страница Загрузки</title>
</head>
<body>
<form action="/mainpage.php" target="_blank">
    <button>Главная</button>
</form>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="file" > <br>
    <textarea name="description"></textarea>
    <input type="submit">
</form>
</body>