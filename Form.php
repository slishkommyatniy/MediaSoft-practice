<?php
//Открытие и создание копии файла
$new_file = $_FILES['text']['name']; // для файлов
$new_description = $_POST['description']; // для текстового поля

if (copy($_FILES['text']['tmp_name'], $new_file)) {
    echo "Файл загружен". PHP_EOL;
} else if (!empty($new_description)){
    echo "Текст прочитан" . PHP_EOL;
}
else  {
    echo "Ошибка при загрузке файла" . PHP_EOL;
    }


function file_csv($new_file) // Функция для файлов
{
    $text = file_get_contents($new_file); // Чтения файла
    $text_lower = mb_strtolower($text, 'UTF-8'); //Нижний регистр
    $text_delete_symbols = str_replace(["\r\n", "\r", "\n", ".", ","], "", $text_lower); //Удаление знаков припинания и переноса строки
    $NoSpaces = explode(" ", $text_delete_symbols);  // Разделение слов по пробелу
    $WordCount = count($NoSpaces); //Суммарное число слов
    $result = array_count_values($NoSpaces);
    $EntryWords = print_r($result, true); //Подсчёт вхождений слов

    touch("file.csv"); //Создание файла
    $fp = fopen(__DIR__ . DIRECTORY_SEPARATOR .'file.csv', 'w'); // Открытие этого файла
    //Запись в файл
    foreach ($result as $word => $count) {
        fputcsv($fp, [$word, $count], ',');
    }
    fclose($fp);

    //Перемещение файла
    mkdir("texts"); // новая папка
    if (rename('file.csv', 'texts/file.csv')) {
        echo "Файл успешно перемещен!" . PHP_EOL;
    }else{
        echo "Файл не удалось переместить!" . PHP_EOL;
    }
    unlink($new_file); //удаление копии файла
}

function textarea_csv($new_description)
{
    $text_lower = mb_strtolower($new_description, 'UTF-8'); //Нижний регистр
    $text_delete_symbols = str_replace(["\r\n", "\r", "\n", ".", ","], "", $text_lower); //Удаление знаков припинания и переноса строки
    $NoSpaces = explode(" ", $text_delete_symbols);  // Разделение слов по пробелу
    $WordCount = count($NoSpaces); //Суммарное число слов
    $result = array_count_values($NoSpaces);
    $EntryWords = print_r($result, true); //Подсчёт вхождений слов

    touch("textarea.csv"); //Создание файла
    $fp = fopen(__DIR__ . DIRECTORY_SEPARATOR .'textarea.csv', 'w'); // Открытие этого файла
    //Запись в файл
    foreach ($result as $word => $count) {
        fputcsv($fp, [$word, $count], ',');
    }
    fclose($fp);

    //Перемещение файла
    mkdir("texts"); // новая папка
    if (rename('textarea.csv', 'texts/textarea.csv')) {
        echo "Файл успешно перемещен!" . PHP_EOL;
    }else{
        echo "Файл не удалось переместить!" . PHP_EOL;
    }
}
 //Проверки
if (!empty($new_file) && !empty($new_description))
{
    textarea_csv($new_description);
    file_csv($new_file);

} else if (!empty($new_file) && empty($new_description)){
    file_csv($new_file);
}
else if (!empty($new_description) && empty($new_file)){
    textarea_csv($new_description);
} else
    echo "Текст не найден" . PHP_EOL;
?>
