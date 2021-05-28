<?php
    include('config/constants.php');
?>

<html>

    <head>

        <title>Task Manager Darbas</title>
        <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    </head>

    <body>

    <div class="wrapper">

    <h1 class="text-center">Task Manager</h1>

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">

            <a href="<?php echo SITEURL; ?>" style="text-decoration: none;"><button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><b>Home</b></button></a>

            <?php

                $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

                $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());

                $sql2 = "SELECT * FROM tbl_lists";

                $res2 = mysqli_query($conn2, $sql2);

                if($res2==true)
                {
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $list_id = $row2['list_id'];
                        $list_name = $row2['list_name'];
                        ?>

                        <a href="<?php echo SITEURL; ?>list-task.php?list_id=<?php echo $list_id; ?>" style="text-decoration: none;"><button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><b><?php echo $list_name; ?></b></button></a>

                        <?php

                    }
                }

            ?>



            <a href="<?php echo SITEURL; ?>manage-list.php" style="text-decoration: none;"><button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><b>Manage Lists</b></button></a>
        </div>
    </nav>

    <p>
        <?php

            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }


            if(isset($_SESSION['delete_fail']))
            {
                echo $_SESSION['delete_fail'];
                unset($_SESSION['delete_fail']);
            }

        ?>
    </p>

    <div class="all-tasks">

        <a href="<?php echo SITEURL; ?>add-task.php"><button class="btn btn-dark">Add Task</button></a>

        <table class="tbl-full table table-condensed table-hover">

            <tr>
                <th>S.N.</th>
                <th>Task Name</th>
                <th>Priority</th>
                <th>Deadline</th>
                <th>Actions</th>
            </tr>

            <?php

                $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

                $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

                $sql = "SELECT * FROM tbl_tasks";

                $res = mysqli_query($conn, $sql);

                if($res==true)
                {
                    $count_rows = mysqli_num_rows($res);

                    $sn=1;

                    if($count_rows>0)
                    {
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $task_id = $row['task_id'];
                            $task_name = $row['task_name'];
                            $priority = $row['priority'];
                            $deadline = $row['deadline'];
                            ?>

                            <tr>
                                <td><?php echo $sn++; ?>. </td>
                                <td><?php echo $task_name; ?></td>
                                <td><?php echo $priority; ?></td>
                                <td><?php echo $deadline; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>update-task.php?task_id=<?php echo $task_id; ?>"><button class="btn btn-success btn-sm">Update</button></a>

                                    <a href="<?php echo SITEURL; ?>delete-task.php?task_id=<?php echo $task_id; ?>"><button class="btn btn-danger btn-sm">Remove</button></a>

                                </td>
                            </tr>

                            <?php
                        }
                    }
                    else
                    {
                        ?>

                        <tr>
                            <td colspan="5">No Task Added Yet.</td>
                        </tr>

                        <?php
                    }
                }

            ?>



        </table>

    </div>

    </div>
    </body>

</html>