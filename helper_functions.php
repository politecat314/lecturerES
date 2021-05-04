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


function getVideoInfo($video_id, $column) {
    $conn = OpenCon();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM videos WHERE video_id=" . $video_id;

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        while ($row = $result->fetch_assoc()) {
            return $row[$column];
        }
    } else {
        echo "0 results";
    }
    CloseCon($conn);
}

function getLectureURL($topic_id) {
    $conn = OpenCon();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM lecture_notes WHERE topic_id=" . $topic_id;

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        while ($row = $result->fetch_assoc()) {
            return $row['url'];
        }
    } else {
        echo "0 results";
    }
    CloseCon($conn);
}


function getVideoId($url) {
    parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
    return $my_array_of_vars['v'];
}


function getThumbnailsrc($url) {
    $video_id = getVideoId($url);

    return "http://i3.ytimg.com/vi/$video_id/hq3.jpg";
}


function updateWatchedFAQ($faq_id) {
    $conn = OpenCon();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE faq SET watched=1 WHERE faq_id=$faq_id";

    if ($conn->query($sql) === TRUE) {
        // echo "Record updated successfully";
      } else {
        echo "Error updating record: " . $conn->error;
      }

    CloseCon($conn);
    
}


function updateQuestionCorrectness($question_id, $value) {
    $conn = OpenCon();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE questions SET correct=$value WHERE question_id=$question_id";

    if ($conn->query($sql) === TRUE) {
        // echo "Record updated successfully";
      } else {
        echo "Error updating record: " . $conn->error;
      }

    CloseCon($conn);
}