<?php 
    include('config/constants.php');
?>

<html>
    <head>
        <title>Task Manager</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css" />
    </head>
    
    <body>
    
        <div class="wrapper">
        
        <div class="container">

            <div class="row">
            
                <div class="col-lg-2"></div>


            <div class="col-lg-8">

            <h1 class="text-center">Task Manager</h1>

                <a class="btn-secondary" href="<?php echo SITEURL; ?>">Home</a>

                <h3>Add Task Page</h3>

                <p>
                    <?php 
                    
                        if(isset($_SESSION['add_fail']))
                        {
                            echo $_SESSION['add_fail'];
                            unset($_SESSION['add_fail']);
                        }
                    
                    ?>
                </p>
               
                <form method="POST" action="">
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Task Name</label>
                      <input type="text" name="task_name" class="form-control" placeholder="Type your Task Name" required="required" /></td>
                    </div>

                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Task Description</label>
                      <textarea name="task_description" class="form-control" placeholder="Type Task Description"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="disabledSelect" class="form-label">Select List</label>
                      <select name="list_id" class="form-select" id="">
                        <?php 

                        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

                        $sql = "SELECT * FROM tbl_lists";
                        

                        $res = mysqli_query($conn, $sql);

                        if($res==true)
                        {
                            $count_rows = mysqli_num_rows($res);

                            if($count_rows>0)
                            {
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $list_id = $row['list_id'];
                                    $list_name = $row['list_name'];
                                    ?>
                                    <option value="<?php echo $list_id ?>"><?php echo $list_name; ?></option>
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                <option value="0">None</option>p
                                <?php
                            }
                            
                        }
                    ?>
                      </select>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Priority:</label>
                        <select name="priority" class="form-select" id="">
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                      </div>

                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Deadline</label>
                        <input type="date" class="form-control" name="deadline" />
                      </div>

                    <button type="submit" class="btn btn-secondary" name="submit">Add</button>
                </form>

            </div>

                <div class="col-lg-2"></div>
            
            
            </div>
        
        </div>
        
        </div>
    </body>
    
</html>


<?php 

    if(isset($_POST['submit']))
    {
        $task_name = $_POST['task_name'];
        $task_description = $_POST['task_description'];
        $list_id = $_POST['list_id'];
        $priority = $_POST['priority'];
        $deadline = $_POST['deadline'];

        $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

        $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());

        $sql2 = "INSERT INTO tbl_tasks SET 
            task_name = '$task_name',
            task_description = '$task_description',
            list_id = $list_id,
            priority = '$priority',
            deadline = '$deadline'
        ";

        $res2 = mysqli_query($conn2, $sql2);

        if($res2==true)
        {
            $_SESSION['add'] = "Task Added Successfully.";

            header('location:'.SITEURL);
            
        }
        else
        {
            $_SESSION['add_fail'] = "Failed to Add Task";
            header('location:'.SITEURL.'add-task.php');
        }
    }

?>




































