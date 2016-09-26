<?php
include 'TaskList.php';

if(isset($_POST['Task_Id']))
{
	TaskDelect($_POST['Task_Id']);
	header("Location: http://localhost/ToDoList/index.php");
}
?>
