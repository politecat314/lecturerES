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


function changeTopic($topic_id, $value) {
    changeFaq($topic_id, $value);
    changeLectNotes($topic_id, $value);
    changeQuestions($topic_id, $value);
    changeVideos($topic_id, $value);
}


function changeFaq($topic_id, $value) { // set value to 0 or 1
    $conn = OpenCon();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE faq SET watched=$value WHERE topic_id=$topic_id";

    if ($conn->query($sql) === TRUE) {
        // echo "Record updated successfully";
      } else {
        echo "Error updating record: " . $conn->error;
      }

    CloseCon($conn);
}

function changeLectNotes($topic_id, $value) {
    $conn = OpenCon();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE lecture_notes SET watched=$value WHERE topic_id=$topic_id";

    if ($conn->query($sql) === TRUE) {
        // echo "Record updated successfully";
      } else {
        echo "Error updating record: " . $conn->error;
      }

    CloseCon($conn);
}

function changeQuestions($topic_id, $value) {
    $conn = OpenCon();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE questions SET correct=$value WHERE topic_id=$topic_id";

    if ($conn->query($sql) === TRUE) {
        // echo "Record updated successfully";
      } else {
        echo "Error updating record: " . $conn->error;
      }

    CloseCon($conn);
}

function changeVideos($topic_id, $value) {
    $conn = OpenCon();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE videos SET watched=$value WHERE topic_id=$topic_id";

    if ($conn->query($sql) === TRUE) {
        // echo "Record updated successfully";
      } else {
        echo "Error updating record: " . $conn->error;
      }

    CloseCon($conn);
}

function changeFinalExam($value) {
    // print_r("final will be changed to ".$value);
    $conn = OpenCon();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE exam SET taken=$value WHERE exam_id=0";

    if ($conn->query($sql) === TRUE) {
        // echo "Record updated successfully";
      } else {
        echo "Error updating record: " . $conn->error;
      }

    CloseCon($conn);
}


function countRows($tablename) {
    $length = 0;
    
    $conn = OpenCon();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT COUNT('1') FROM $tablename";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        while ($row = $result->fetch_assoc()) {
            // print_r($row);
            $length = $row["COUNT('1')"];
        }
    } else {
        echo "0 results";
    }

    CloseCon($conn);

    return $length;
}