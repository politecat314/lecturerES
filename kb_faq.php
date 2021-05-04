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

include 'connection.php';
include 'helper_functions.php';

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
                                
    $watchedtopic=array(1,1,1,1,1,1);
    $i=0;
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        // echo "id: " . $row["topic_id"]. " - Name: " . $row["topic_name"] . "<br>";
        echo "TOPIC ID: " . $row["topic_id"] . " - Watched: " .$row["watched"]."<br>";
        

        
        if($row["topic_id"]==$i+1){
            $watchedtopic[$i] = $watchedtopic[$i] & $row["watched"];
        }else{
            $i++;
            $watchedtopic[$i] = $watchedtopic[$i] & $row["watched"];
        }

        }
    } else {
        echo "0 results";
    }

    $allwatched=1;
    for($j=0;$j<sizeof($watchedtopic);$j++){
        echo "Watched topic ".$j." is ".$watchedtopic[$j]." <br> ";
        $allwatched=$allwatched & $watchedtopic[$j];
    }
    
    if($allwatched==1)
     echo "All FAQ watched";

    CloseCon($conn);

?>

</body>
</html>