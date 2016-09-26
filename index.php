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
		
        
        <fieldset class="user-fieldset">

            <div class="user-form">
                <label class="form-title" style="color: #F8741B; font-size: 22px;font-weight: bold; text-decoration:none">Add Task</label>
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
                                    <input type="text" id="subject" name="subject" placeholder="subject" class="form-control input-lg" required>
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
                                    <textarea id="Detail" name="Detail" placeholder="Detail"></textarea>
                                    
                                    
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
                                    <input type="radio" name="status" value="0" checked> Pending <input type="radio" name="status" value="1"> Done
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                
            </table>
<?php
if(isset($_POST['subject']) && $_POST['subject'] != "")
{
	$TaskAddAry = array("Task_Subject" => $_POST['subject'],"Task_Detail" => $_POST['Detail'],"Task_Status" => $_POST['status']);
	TaskAdd(json_encode($TaskAddAry));
			
}else
{
			
	
			
}
?>
            <br/>
            <br/>
            <div class="form-actions controls ynt-btn-xlarge">
            <button type="submit" class="btn btn-primary ynt-btn-orange">Add</button>
                
                <!--<button type="submit" class="btn btn-primary ynt-btn-orange">Add</button><INPUT TYPE="button" onClick="history.go(0)" VALUE="Clear">-->
                
            </div>
            <div class="form-actions controls ynt-btn-xlarge">
				
            </div>
        </fieldset>
        
    </form>


    <div class="user-display" >
        <fieldset>
            <legend align="center"><h3>To Do List</h3></legend>
            <table cellspacing="20">
                <tr>
                    <th>Subject</th>
                    <th>Detail</th>
                    <th>Status</th>
                    
                </tr>
                <script type="text/javascript">
				var task_List = JSON.parse( '<?php echo TaskList() ?>' );
				for(i=0;i<task_List.length;i++){
					
					document.write("<tr><td><p style='font-size:12px'>",task_List[i].Task_Subject,"</p></td><td><p style='font-size:12px'>",task_List[i].Task_Detail,"</p></td><td><p style='font-size:12px'>",task_List[i].Task_Status,"</p></td><td><form id='Show' action='ShowList.php' method='post' align='center'><input type='hidden' id='Task_Id' name='Task_Id' value='", task_List[i].Task_Id ,"' /><button type='submit'>Show</button></form></td><td><form id='Edit' action='EditList.php' method='post' align='center'><input type='hidden' id='Task_Id' name='Task_Id' value='", task_List[i].Task_Id ,"' /><button type='submit'>Edit</button></form></td><td><form id='Delete' action='DeleteList.php' method='post' align='center'>	<input type='hidden' id='Task_Id' name='Task_Id' value='", task_List[i].Task_Id ,"' /><button type='submit'>Delete</button></form></td></tr>");
					
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