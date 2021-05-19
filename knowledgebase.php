<?php

include_once 'connection.php';
include_once 'helper_functions.php';


function all_topicvid_isWatched($topic){ //check all videos in 1 topic

    $conn = OpenCon();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT *  FROM videos WHERE topic_id=$topic AND watched=0";

    $result = $conn->query($sql);


    $allvidwatched=$result->num_rows == 0;
    
    CloseCon($conn);
    if($allvidwatched!=true){
        print_r(vid_isWatched($topic));
        return false;
    }
    else{
        return $allvidwatched;
    }
}

function vid_isWatched($topic){ // find which videos u haven't watched and return array
    $unwatchedvids = array();
    $conn = OpenCon();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    $sql = "SELECT *  FROM videos WHERE topic_id=$topic AND watched=0";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
        array_push($unwatchedvids,$row["video_id"]);
        }
    } else {
        echo "0 results";
    }

    CloseCon($conn);
    return $unwatchedvids;
}

function faq_isWatched($topic){ // check if FAQ topic is watched and return boolean
    $conn = OpenCon();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    $sql = "SELECT *  FROM faq WHERE topic_id=$topic AND watched=0";
    $result = $conn->query($sql);



    $allfaqwatched=$result->num_rows > 0;

    CloseCon($conn);
    
    return !$allfaqwatched; 
}

function notes_isWatched($topic){ // check if FAQ topic is watched and return boolean
    $conn = OpenCon();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    $sql = "SELECT *  FROM lecture_notes WHERE topic_id=$topic AND watched=0";
    $result = $conn->query($sql);



    $allnoteswatched=$result->num_rows > 0;

    CloseCon($conn);
    
    return !$allnoteswatched; 
}

function minitest_isPassed($topic){ // check if FAQ topic is watched and return boolean
    $conn = OpenCon();
    $pass=true;
    $totalquestions=3;
    $totalcorrect=0;
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    $sql = "SELECT *  FROM questions WHERE topic_id=$topic AND correct=1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        $totalcorrect++;
        }
    } else {
        echo "0 results";
    }

    

    CloseCon($conn);
    
    if(($totalcorrect/$totalquestions)>=0.6)
        return $pass;
    else
        return !$pass;
}

function isTopicDone($topic){ //check 1 topic if all task done
    return (all_topicvid_isWatched($topic) || notes_isWatched($topic)) && faq_isWatched($topic)  && minitest_isPassed($topic);
}
var_dump(isTopicDone(6));
?>