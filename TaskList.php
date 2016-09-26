<?php
include 'sqlconfig.php';

function TaskAdd($TaskAddData)
{
	$obj = json_decode($TaskAddData);
	
	$sql=mysql_query("SELECT Task_Id FROM todo_list WHERE Task_Subject ='" . $obj->{'Task_Subject'} . "'");
	if(mysql_num_rows($sql) != NULL)
	{
		echo "Error add note";
		
	}else
	{
		
		if(mysql_query("INSERT INTO todo_list(Task_Subject,Task_Detail,Task_Status) VALUES('" . $obj->{'Task_Subject'} . "','" . $obj->{'Task_Detail'} . "','" . $obj->{'Task_Status'} . "')"))
		{
			echo "successfull add note";
		}else
		{
			echo "Error add note";
		}
		
	}
	
	//$obj->{'Task_Subject'};
}

function TaskDelect($id)
{
	
	$sql=mysql_query("SELECT Task_Subject FROM todo_list WHERE Task_Id ='" . $id . "'");
	if(mysql_num_rows($sql) != NULL)
	{
		$sql1="DELETE FROM todo_list WHERE Task_Id = '" . $id . "'";
		if(mysql_query($sql1))
		{
			
		}
		
	}
	
}

function TaskEdit($TaskEditData)
{
	
	$obj = json_decode($TaskEditData);
	$id = $obj->{'Task_Id'};
	$Subject_S = "";
	$Detail_S = "";
	$Status_S = "";
	
	$sql=mysql_query("SELECT Task_Subject,Task_Detail,Task_Status FROM todo_list WHERE Task_Id ='" . $id . "'");
	if(mysql_num_rows($sql) != NULL)
	{
		while($row = mysql_fetch_array($sql))
		{
			$Subject_S = $row['Task_Subject'];
			$Detail_S = $row['Task_Detail'];
			$Status_S = $row['Task_Status'];
		}
		
	}
	
	if($obj->{'Task_Subject'} != $Subject_S)
	{
		$sql1="update todo_list set Task_Subject ='" . $obj->{'Task_Subject'} . "'  where Task_Id = '" . $id . "'";
		if(mysql_query($sql1))
		{	
				
		}
	}
	
	if($obj->{'Task_Detail'} != $Detail_S)
	{
		$sql1="update todo_list set Task_Detail ='" . $obj->{'Task_Detail'} . "'  where Task_Id = '" . $id . "'";
		if(mysql_query($sql1))
		{	
				
		}
	}
	
	if($obj->{'Task_Status'} != $Status_S)
	{
		$sql1="update todo_list set Task_Status ='" . $obj->{'Task_Status'} . "'  where Task_Id = '" . $id . "'";
		if(mysql_query($sql1))
		{	
				
		}
	}
	
	echo $obj->{'Task_Subject'} . " = " . $obj->{'Task_Detail'} . " = " . $obj->{'Task_Status'};
}

function TaskShow($id)
{
	$todoEdit;
	$sql=mysql_query("Select Task_Subject,Task_Detail,Task_Status FROM todo_list WHERE Task_Id ='" . $id . "'");
	if(mysql_num_rows($sql) != NULL)
	{
		while($row = mysql_fetch_array($sql))
		{
			$todoEdit = array("Task_Subject" => $row['Task_Subject'],"Task_Detail" => $row['Task_Detail'],"Task_Status" => $row['Task_Status']);
		}
		
	}
	
	return json_encode($todoEdit);
	
}

function TaskList()
{
	$todolist = array();
	$sql=mysql_query("SELECT Task_Id,Task_Subject,Task_Detail,CASE  WHEN Task_Status=0 THEN 'Pending' WHEN Task_Status=1 THEN 'Done'  END AS Status_S FROM todo_list");
	if(mysql_num_rows($sql) != NULL)
	{
		$i = 0;
		while($row = mysql_fetch_array($sql))
		{
			$todolist[$i] = array("Task_Id" => $row['Task_Id'],"Task_Subject" => $row['Task_Subject'],"Task_Detail" => $row['Task_Detail'],"Task_Status" => $row['Status_S']);
			$i++;
		}
		
	}
	//echo "Test = " . $todolist[0]['Task_Subject'];
	return json_encode($todolist);
}
?>