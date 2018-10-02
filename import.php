<?php

	session_start();
    ini_set('max_execution_time', 300); // sets maximume time in seconds a script allowed to run before it is terminated
    include('database/connection.php');
    $output = '';

    $sql = "SELECT * FROM students";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if(isset($_POST['btn_import']))
    {
        $filename = $_FILES['file']['tmp_name'];

        if($_FILES['file']['size'] > 0)
        {
                        
                $file = fopen($filename, 'r');

                while(($data = fgetcsv($file, 1000, ",")) !== FALSE)    {
                    $csv_query = "INSERT INTO students(IDNumber, Name, Course, Year)
                    VALUES('".$data[0]."', '".$data[1]."', '".$data[2]."', '".$data[3]."')";
                    $csv_res = mysqli_query($conn, $csv_query);
                }
                if(isset($csv_res)){
                    echo "<script>
                        alert('Import Sucessfull');
                    </script>
                    <meta http-equiv='refresh' content='0; url=dashboard.php'>
                    ";
                }
                else 
                {
                    echo "<script>
                    alert('Failure in importing');
                    </script>";
                }
        }
    }

    //Export data from HTML Table
    if (isset($_POST['export'])) {

        $sql = "SELECT *  FROM students WHERE Status = 'Logout' ORDER BY Date ASC";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if ($count > 0) {
                
            $output .= '<table class="table table-border">
                        <tr>
                            <th>ID Number</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Year</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>';
                        while ($row = mysqli_fetch_array($res)) {
                            
                            $output .= '
                            <tr>
                                <td>'.htmlspecialchars($row['IDNumber']).'</td>
                                <td>'.htmlspecialchars($row['Name']).'</td>
                                <td>'.htmlspecialchars($row['Course']).'</td>
                                <td>'.htmlspecialchars($row['Year']).'</td>
                                <td>'.htmlspecialchars($row['Status']).'</td>
                                <td>'.htmlspecialchars($row['Date']).'</td>
                            </tr>';
                        }

                        $output .= '</table>';
                        header("Content-Type: application/xls");
                        header("Content-Disposition: attachment; filename=registered_students.xls");
                        echo $output;
            }
        }

    //Unregistered All students
    if (isset($_POST['unreg_all'])) {
        $unreg_all_sql = mysqli_query($conn, "UPDATE students SET Status = 'Unregistered', Date = '' WHERE ID");

        if ($unreg_all_sql) {
            echo "<script>
                alert('Unregistered successfully');
            </script>
            <meta http-equiv='refresh' content='0; url=dashboard.php'>";
        } else {
            echo "<script>
                alert('Failed');
            </script>";
        }
    }
?>