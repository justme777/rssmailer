<?php
include("functions.php");
$mng = new DataManager();
echo "<pre>";
$mng->getWidgets(1);
echo "</pre>";

/*
$json = '{
    "title": "JavaScript: The Definitive Guide",
    "author": "David Flanagan",
    "edition": 6
}';
$book = json_decode($json);
// access title of $book object
echo $book->title;*/


?>