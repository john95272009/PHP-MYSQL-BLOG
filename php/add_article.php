<?php
require_once 'db_con.php';
require_once 'function.php';

$title = $_POST['title'];
$category = $_POST['category'];
$content = $_POST['content'];
$publish = $_POST['publish'];
$result = add_article($title, $category, $content, $publish);
if($result)
{
 echo ('true');
}
?>
