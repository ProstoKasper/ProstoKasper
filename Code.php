<?php

$pdo = new PDO ('mysql:dbname=data_base;host=localhost:3306', 'root','root');

$selectQuery = 'SELECT * FROM word';
$oneRow = $pdo->query($selectQuery)->fetch(PDO::FETCH_ASSOC);
$allRow = $pdo->query($selectQuery)->fetchAll(PDO::FETCH_ASSOC);

$insertQueryUploaded_text = 'INSERT INTO
`uploaded_text`(`content`,`date`,`words_count`)
VALUE (?,NOW(),?)';

$insertQueryWord = 'INSERT INTO 
`word`(`text_id`,`word`,`word_count`) 
VALUES (?,?,?)';

$insertQueryUploaded_text1 = $pdo->prepare($insertQueryUploaded_text);
$insertQueryWord1 = $pdo->prepare($insertQueryWord);

function MaxWordTextArea($a,$pdo,$insertQueryWord1,$insertQueryUploaded_text1)
{
    $replace = str_replace([".", ",", "?", "!"],"",$a);
    $replace1 = str_replace([ "\r\n","\r","\n","  "], ' ', $replace);

    $replace1 = mb_strtolower($replace1);

    $words = count(explode(' ', $a));

    $replace2 = explode(' ', $replace1);
    $check1 = array_count_values($replace2);

    $insertQueryUploaded_text1->execute([$a, $words]);
    $text_id = $pdo -> lastInsertId();

    foreach ($check1 as $word => $count)
    {
        $insertQueryWord1->execute([$text_id,$word,$count]);
    }


}


$file = file_get_contents($_FILES['docs']['name'],'$file_tmp'); //Переменная принимает значения файла
$textarea = $_POST['mystr']; //Переменная принимает значения текста


if (!empty($file) && empty($textarea))
{
    MaxWordTextArea($file,$pdo,$insertQueryWord1,$insertQueryUploaded_text1);
}
elseif (empty($file) && !empty($textarea))
{
    MaxWordTextArea($textarea,$pdo,$insertQueryWord1,$insertQueryUploaded_text1);
}
elseif (!empty($file) && !empty($textarea))
{
    MaxWordTextArea($file,$pdo,$insertQueryWord1,$insertQueryUploaded_text1);
    MaxWordTextArea($textarea,$pdo,$insertQueryWord1,$insertQueryUploaded_text1);
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>Обработка завершена</h3><br>
<form action="main.php" method="post" enctype="multipart/form-data">
    <button>Далее</button>
</form>
</body>
</html>