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
echo "FAQs<br>";
// $video_id = $_GET['video_id'];
// $title = getVideoInfo($video_id, 'title');
// $url = getVideoInfo($video_id, 'url');
// $id = getVideoId($url);

// mark watched as true
$conn = OpenCon();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT topic_id,watched  FROM faq";

    $result = $conn->query($sql);
                                
    $watched_faq_topic=array(1,1,1,1,1,1);
    $i=0;
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        // echo "id: " . $row["topic_id"]. " - Name: " . $row["topic_name"] . "<br>";
        echo "TOPIC ID: " . $row["topic_id"] . " - Watched: " .$row["watched"]."<br>";
        

        
        if($row["topic_id"]==$i+1){
            $watched_faq_topic[$i] = $watched_faq_topic[$i] & $row["watched"];
        }else{
            $i++;
            $watched_faq_topic[$i] = $watched_faq_topic[$i] & $row["watched"];
        }

        }
    } else {
        echo "0 results";
    }

    $all_faq_watched=1;
    for($j=0;$j<sizeof($watched_faq_topic);$j++){
        echo "Watched topic ".($j+1)." is ".$watched_faq_topic[$j]." <br> ";
        $all_faq_watched=$all_faq_watched & $watched_faq_topic[$j];
    }
    
    if($all_faq_watched==1)
     echo "All FAQ watched <br>";

    CloseCon($conn);

?>

</body>
</html>