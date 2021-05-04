<?php
include 'connection.php';

// update the lecture notes watched

if(isset($_POST['topic_id'])) {
    $topic_id = $_POST['topic_id'];

    // $sql = "update yourTable set date ='".$_POST['date']."' where name= '".$_POST['name']."'";
    //Rest of the code to execute query

    $conn = OpenCon();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE lecture_notes SET watched=1 WHERE topic_id=$topic_id";

    if ($conn->query($sql) === TRUE) {
        // echo "Record updated successfully";
      } else {
        echo "Error updating record: " . $conn->error;
      }

    CloseCon($conn);
    }
    else{
        echo "AJAX call failed to send post variables";
    }


?>