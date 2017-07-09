<?php
require_once 'core/init.php';

$str = Input::get('q');
$book = new Book();
$books = $book->getBookByStr($str);
echo json_encode($books);