<?php 
    include('config/constants.php');

    if(isset($_GET['task_id']))
    {
        $task_id = $_GET['task_id'];

        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

        $sql = "SELECT * FROM tbl_tasks WHERE task_id=$task_id";

        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $row = mysqli_fetch_assoc($res);

            $task_name = $row['task_name'];
            $task_description = $row['task_description'];
            $list_id = $row['list_id'];
            $priority = $row['priority'];
            $deadline = $row['deadline'];
        }
    }
    else
    {
        header('location:'.SITEURL);
    }
?>

<html>
    <head>
        <title>Task Manager</title>
        <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    </head>
    
    <body>
        
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>

                <div class="col-lg-6">
                <h1 class="text-center">Task Manager</h1>

                <p>
                    <a class="btn-secondary" href="<?php echo SITEURL; ?>">Home</a>
                </p>

                <h3>Update Task Page</h3>
        
                <p>
                    <?php 
                        if(isset($_SESSION['update_fail']))
                        {
                            echo $_SESSION['update_fail'];
                            unset($_SESSION['update_fail']);
                        }
                    ?>
                </p>

                <form method="POST" action="">
                <div class="mb-3">
                    <label for="example" class="form-label">Task Name:</label>
                    <input type="text" name="task_name" class="form-control" value="<?php echo $task_name; ?>" required="required" />
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Task Description</label>
                    <textarea name="task_description" class="form-control">
                        <?php echo $task_description; ?>
                        </textarea>
                </div>

                <div class="mb-3">
                    <label for="ascc" class="form-label">Select List:</label>
                    <select name="list_id" class="form-select" id="">
                <?php
                                $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

                                $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());

                                $sql2 = "SELECT * FROM tbl_lists";

                                $res2 = mysqli_query($conn2, $sql2);

                                if($res2==true)
                                {
                                    $count_rows2 = mysqli_num_rows($res2);

                                    if($count_rows2>0)
                                    {
                                        while($row2=mysqli_fetch_assoc($res2))
                                        {
                                            $list_id_db = $row2['list_id'];
                                            $list_name = $row2['list_name'];
                                            ?>
                                            
                                            <option <?php if($list_id_db==$list_id){echo "selected='selected'";} ?> value="<?php echo $list_id_db; ?>"><?php echo $list_name; ?></option>
                                            
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <option <?php if($list_id=0){echo "selected='selected'";} ?> value="0">None</option>p
                                        <?php
                                    }
                                }
                            ?>
                </select>
                </div>

                <div class="mb-3">
                    <label for="example" class="form-label">Priority</label>
                    <select name="priority" class="form-select" id="">
                    <option <?php if($priority=="High"){echo "selected='selected'";} ?> value="High">High</option>
                            <option <?php if($priority=="Medium"){echo "selected='selected'";} ?> value="Medium">Medium</option>
                            <option <?php if($priority=="Low"){echo "selected='selected'";} ?> value="Low">Low</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="example" class="form-label">Deadline:</label>
                    <input type="date" name="deadline" class="form-control" value="<?php echo $deadline; ?>" />
                </div>


                <button type="submit" class="btn btn-primary" name="submit">Make Changes</button>
                </form>
                </div>

                <div class="col-lg-3"></div>
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

        $conn3 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

        $db_select3 = mysqli_select_db($conn3, DB_NAME) or die(mysqli_error());

        $sql3 = "UPDATE tbl_tasks SET 
        task_name = '$task_name',
        task_description = '$task_description',
        list_id = '$list_id',
        priority = '$priority',
        deadline = '$deadline'
        WHERE 
        task_id = $task_id
        ";

        $res3 = mysqli_query($conn3, $sql3);

        if($res3==true)
        {
            $_SESSION['update'] = "Task Updated Successfully.";

            header('location:'.SITEURL);
        }
        else
        {
            $_SESSION['update_fail'] = "Failed to Update Task";
            header('location:'.SITEURL.'update-task.php?task_id='.$task_id);
        }

    }

?>









































