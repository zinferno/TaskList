<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

</head>

<body>
<?php
include 'TaskList.php';

?>

<form id="user-data-form" role="form" action='index.php' method="post" class="form-horizontal" align="center" autocomplete="off">
		<input type="hidden" id="Function_Switcher" name="Function_Switcher" 
        <?php
        if(isset($_POST['Task_Id']))
		{
			echo "value='2'";
		}else
		{
			echo "value='4'";
		}
        ?>/>
        <input type="hidden" id="Task_Id" name="Task_Id" value='<?php
        if(isset($_POST['Task_Id']))
		{
			echo $_POST['Task_Id'];
		}
        ?>' />
        <fieldset class="user-fieldset">

            <div class="user-form">
                <label class="form-title" style="color: #F8741B; font-size: 22px;font-weight: bold; text-decoration:none">To Do List</label>
            </div>
            <br/>
            <table align="center" cellspacing="20">
                <tr>
                    <td align="left">
                        <div class="user-form" id="firstName_field_label">
                            <div class="controls col-xs-offset-3 col-xs-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                    <strong>Subject</strong> :
                                </div>
                            </div>
                        </div>
                    </td>
                    <td align="center">
                        <div class="user-form" id="firstName_field_value">
                            <div class="controls col-xs-offset-3 col-xs-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                    <input type="text" id="subject" name="subject"
									<?php 
									if(isset($_POST['Task_Id']))
									{
										$obj = json_decode(TaskShow($_POST['Task_Id']));
										echo "value='" . $obj->{'Task_Subject'} . "'";
									}else
									{
										echo "value=''";
									}
									?> placeholder="subject" class="form-control input-lg" required>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        <div class="user-form" id="lastName_field_label">
                            <div class="controls col-xs-offset-3 col-xs-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                    <strong>Detail</strong> :
                                </div>
                            </div>
                        </div>
                    </td>
                    <td align="center">
                        <div class="user-form" id="lastName_field_value">
                            <div class="controls col-xs-offset-3 col-xs-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                    <?php 
									if(isset($_POST['Task_Id']))
									{
										$obj = json_decode(TaskShow($_POST['Task_Id']));
										echo "<textarea id=\"Detail\" name=\"Detail\" placeholder=\"Detail\">" . $obj->{'Task_Detail'} . "</textarea>";
									}else
									{
										echo "<textarea id=\"Detail\" name=\"Detail\" placeholder=\"Detail\"></textarea>";
									}
									?>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        <div class="user-form" id="mobile_field_label">
                            <div class="controls col-xs-offset-3 col-xs-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                    <strong>Status</strong> :
                                </div>
                            </div>
                        </div>
                    </td>
                    <td align="center">
                        <div class="user-form" id="mobile_field_value">
                            <div class="controls col-xs-offset-3 col-xs-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                    <input type="radio" name="status" value="0" checked> Pending <input type="radio" name="status" value="1"
                                    <?php 
									if(isset($_POST['Task_Id']))
									{
										$obj = json_decode(TaskShow($_POST['Task_Id']));
										if($obj->{'Task_Status'} == 1)
										{
											echo "checked";
										}
										
									}else
									{
										echo "";
									}
									?>
                                    > Done
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                
            </table>
            <?php

Function_Switcher($_POST['Function_Switcher']);
function Function_Switcher($switcher = 0)
{
	if($switcher == 0)
	{
		TaskList();
		
		
	}elseif($switcher == 1)
	{
		TaskShow($_POST['Task_Id']);
	}elseif($switcher == 2)
	{
		$TaskEditAry = array("Task_Id" => $_POST['Task_Id'],"Task_Subject" => $_POST['subject'],"Task_Detail" => $_POST['Detail'],"Task_Status" => $_POST['status']);
		TaskEdit(json_encode($TaskEditAry));
		
	}elseif($switcher == 3)
	{
		TaskDelect($_POST['Task_Id']);
		
	}elseif($switcher == 4)
	{
		
		if(isset($_POST['subject']) && $_POST['subject'] != "")
		{
			$TaskAddAry = array("Task_Subject" => $_POST['subject'],"Task_Detail" => $_POST['Detail'],"Task_Status" => $_POST['status']);
			TaskAdd(json_encode($TaskAddAry));
			
		}else
		{
			
			echo "No subject";
			
		}
		
	}
	
}
    
?>
            <br/>
            <br/>
            <div class="form-actions controls ynt-btn-xlarge">
                <button type="submit" class="btn btn-primary ynt-btn-orange">Add</button>
                <!--<INPUT TYPE="button" onClick="history.go(0)" VALUE="Clear">-->
                
            </div>
            <div class="form-actions controls ynt-btn-xlarge">
				
            </div>
        </fieldset>
        
    </form>


    <div class="user-display" >
        <fieldset>
            <legend align="center"><h3>Registered Users</h3></legend>
            <table cellspacing="20">
                <tr>
                    <th>Subject</th>
                    <th>Detail</th>
                    <th>Status</th>
                    
                </tr>
                <script type="text/javascript">
				var task_List = JSON.parse( '<?php echo TaskList() ?>' );
				for(i=0;i<task_List.length;i++){
					
					document.write("<tr><td><p style='font-size:12px'>",task_List[i].Task_Subject,"</p></td><td><p style='font-size:12px'>",task_List[i].Task_Detail,"</p></td><td><p style='font-size:12px'>",task_List[i].Task_Status,"</p></td><td><form id='Show' action='index.php' method='post' align='center'><input type='hidden' id='Function_Switcher' name='Function_Switcher' value='1' /><input type='hidden' id='Task_Id' name='Task_Id' value='", task_List[i].Task_Id ,"' /><button type='submit'>Show</button></form></td><td><form id='Edit' action='index.php' method='post' align='center'><input type='hidden' id='Function_Switcher' name='Function_Switcher' value='2' /><input type='hidden' id='Task_Id' name='Task_Id' value='", task_List[i].Task_Id ,"' /><button type='submit'>Edit</button></form></td><td><form id='Delete' action='index.php' method='post' align='center'><input type='hidden' id='Function_Switcher' name='Function_Switcher' value='3' /><input type='hidden' id='Task_Id' name='Task_Id' value='", task_List[i].Task_Id ,"' /><button type='submit'>Delete</button></form></td></tr>");
					
				}
				
				</script>
                <!--task_List[0].Task_Subject
                @for(user <- users){
                    <tr>
                        <td>@user.id</td>
                        <td>@user.subject</td>
                        <td>@user.Detail</td>
                        <td>@user.Status</td>
                        <td><a href="@routes.ApplicationController.deleteUser(user.id)">delete</a></td>
                    </tr>
                }-->
            </table>
        </fieldset>
    </div>

</body>
</html>