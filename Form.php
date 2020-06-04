<?php
//Открытие и создание копии файла
$new_file = $_FILES['text']['name']; // Для файлов
$new_description = $_POST['description']; // Для текстового поля

if (copy($_FILES['text']['tmp_name'], $new_file)) {
    echo "Файл загружен". PHP_EOL;
} else if (!empty($new_description)){
    echo "Текст прочитан" . PHP_EOL;
}
else  {
    echo "Ошибка при загрузке файла" . PHP_EOL;
    }

function conversion($text){
    $text_lower = mb_strtolower($text); //В нижний регистр
    $text_delete_symbols = str_replace(["\r\n", "\r", "\n", ".", ","], "", $text_lower); //Удаление точек,запятых,переноса строк и тд
    $Spaces = explode(" ", $text_delete_symbols);  // Разделение слов по пробелу
    return ($Spaces);
}

function file_csv($new_file) {
    $text = file_get_contents($new_file); // Чтение файла
    $Spaces = conversion($text); //Преобразование
    $result =array_count_values($Spaces); // Число вхождений каждого слова
    $WordCount = count($Spaces); //Суммарное число слов

    //Создание файла
    mkdir("texts"); // новая папка
    $filename = date_create_from_format('U.u', microtime(true))->format('Y-m-d_H-i-s_u');;
    $extension = 'csv';
    $fp = fopen ( "texts". "/" . $filename . "." . $extension,"w"); //Создание файла csv в папке texts,его открытие и последующая запись

    //Запись в файл
    foreach ($result as $word => $count) {
        fputcsv($fp, [$word, $count], ',');
    }
    fputcsv($fp,["Сумарное число слов",$WordCount],",");
    fclose($fp);


    unlink($new_file); //удаление копии файла
}
function textarea_csv($new_description){
    $Spaces = conversion($new_description);
    $result =array_count_values($Spaces);
    $WordCount = count($Spaces); //Суммарное число слов

    //Создание файла
    mkdir("texts"); // новая папка
    $filename = date_create_from_format('U.u', microtime(true))->format('Y-m-d_H-i-s_u');;
    $extension = 'csv';
    $fp = fopen ( "texts". "/" . $filename . "." . $extension,"w"); //Создание файла csv в папке texts,его открытие и последующая запись

    //Запись в файл
    foreach ($result as $word => $count) {
        fputcsv($fp, [$word, $count], ',');
    }
    fputcsv($fp,["Сумарное число слов",$WordCount],",");
    fclose($fp);
}
 //Проверки
if (!empty($new_file)) {
    file_csv($new_file);
}
if (!empty($new_description)) {
    textarea_csv($new_description);
}
?>