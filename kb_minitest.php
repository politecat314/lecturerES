<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<?php

include_once 'connection.php';
include_once 'helper_functions.php';
echo "MINITEST<br>";
// $video_id = $_GET['video_id'];
// $title = getVideoInfo($video_id, 'title');
// $url = getVideoInfo($video_id, 'url');
// $id = getVideoId($url);

// mark watched as true
$conn = OpenCon();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT question_id,topic_id,correct FROM questions";

    $result = $conn->query($sql);
                                
    $watched_minitest_topic=array(1,1,1,1,1,1);
    $i=0;
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        // echo "id: " . $row["topic_id"]. " - Name: " . $row["topic_name"] . "<br>";
        echo "Question ID: " . $row["question_id"] ." - TOPIC ID: " . $row["topic_id"] . " - Answered: " .$row["correct"]."<br>";
        

        
        if($row["topic_id"]==$i+1){
            $watched_minitest_topic[$i] = $watched_minitest_topic[$i] & $row["correct"];
        }else{
            $i++;
            $watched_minitest_topic[$i] = $watched_minitest_topic[$i] & $row["correct"];
        }

        }
    } else {
        echo "0 results";
    }

    $all_minitest_watched=1;
    for($j=0;$j<sizeof($watched_minitest_topic);$j++){
        echo "Answered questions from topic ".($j+1)." is ".$watched_minitest_topic[$j]." <br> ";
        $all_minitest_watched=$all_minitest_watched & $watched_minitest_topic[$j];
    }
    
    if($all_minitest_watched==1)
     echo "All questions passed <br>";

    CloseCon($conn);

?>

</body>
</html>