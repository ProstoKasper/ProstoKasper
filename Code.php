<?php

function MaxWordFile($a)  //Вычисляет количество вхождений каждого слова в тексте
{

    $replace = str_replace([".", ",", "?", "!"],"",$a);
    $replace1 = str_replace([ "\r\n","\r","\n","  "], ' ', $replace);

    $replace2 = explode(' ', $replace1);
    $check1 = array_count_values($replace2);
    print_r($check1);

    $fp = fopen('ResultFile.csv', 'w');
    foreach ($check1 as $word => $count)
    {
        fputcsv($fp, [$word, $count], ',');
    }
    fclose($fp);
}

function MaxWordTextArea($a)  //Вычисляет количество вхождений каждого слова в тексте
{

    $replace = str_replace([".", ",", "?", "!"],"",$a);
    $replace1 = str_replace([ "\r\n","\r","\n","  "], ' ', $replace);

    $replace2 = explode(' ', $replace1);
    $check1 = array_count_values($replace2);
    print_r($check1);

    $fp = fopen('ResultTextArea.csv', 'w');
    foreach ($check1 as $word => $count)
    {
        fputcsv($fp, [$word, $count], ',');
    }
    fclose($fp);
}

$file = file_get_contents($_FILES['file']['name'],'$file_tmp');

$textarea = $_POST['mystr'];

$words = count(explode(' ', $file));

echo "Всего слов : ", $words . PHP_EOL;
if (!empty($file) && empty($textarea))
{
    MaxWordFile($file);
}
elseif (empty($file) && !empty($textarea))
{
    MaxWordTextArea($textarea);
}
elseif (!empty($file) && !empty($textarea))
{
    MaxWordFile($file);
    MaxWordTextArea($textarea);
}



?>
