<?php 

include_once('createdb.php');

$db = new mysqli($server, $user, $password, $database);

$create ="CREATE TABLE TodoList (id int not null auto_increment primary key, Task varchar(8000), Status varchar(20), taskcreationdate timestamp)";

if (mysqli_query($db, $create)){

} 

?>