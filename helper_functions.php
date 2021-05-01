<?php
include_once 'connection.php';


function getTopicName($topic_id)
{
    $conn = OpenCon();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT topic_name FROM topic WHERE topic_id=" . $topic_id;

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        while ($row = $result->fetch_assoc()) {
            return $row['topic_name'];
        }
    } else {
        echo "0 results";
    }
    CloseCon($conn);
}
