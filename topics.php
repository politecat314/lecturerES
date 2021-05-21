<?php
// include $_SERVER['DOCUMENT_ROOT'].'/es/connection.php';
include 'connection.php';
include 'knowledgebase.php';

?>

<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


</head>


<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Fun With Java ES</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="intro.php">Intro</a>
                    </li>

                    <!-- <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="topics.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Topics
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                                // $conn = OpenCon();
                                // // echo "Connected Successfully";
                                // if ($conn->connect_error) {
                                //     die("Connection failed: " . $conn->connect_error);
                                // }
                                
                                // $sql = "SELECT topic_id, topic_name FROM topic";
                                // $result = $conn->query($sql);
                                
                                // if ($result->num_rows > 0) {
                                //     // output data of each row
                                //     while($row = $result->fetch_assoc()) {
                                //     // echo "id: " . $row["topic_id"]. " - Name: " . $row["topic_name"] . "<br>";
                                //     echo '<a class="dropdown-item" href="topicSelected.php?topic='.$row['topic_id'].'">'.$row['topic_name'].'</a>';
                                //     }
                                // } else {
                                //     echo "0 results";
                                // }
                                // CloseCon($conn);
                            
                            ?>
                        </div>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="faq.php">FAQ</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="test.php">Test</a>
                    </li> -->


                    

                </ul>
                <!-- <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form> -->
            </div>
        </div>
    </nav>


    <div class="container">
    <br>
    
    <?php
        if (oneTopicNotStudiedYet()) {
            echo '<h3>Dr. Unaizah recommends studying the following topic</h3>
    
            <form method="get" action="topicSelected.php">
            <div class="list-group">';

            $conn = OpenCon();
            // echo "Connected Successfully";
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            $sql = "SELECT topic_id, topic_name FROM topic";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $topic_id = $row["topic_id"];

                    if (!isTopicDone($topic_id)) { // show only if topic is not compeleted
                        echo '<button name="topic" value="'. $topic_id .'" type="submit" class="list-group-item list-group-item-action">'.$row["topic_name"].'</button>';
                        break;
                    }

                    
                }
            } else {
                echo "0 results";
            }
            CloseCon($conn);

            echo '</div>
            </form>';
        } else {
            //TODO code for taking the final exam
            echo '<h3>Dr. Unaizah believes you are ready for the final exam! Click here to <a href="test.php">begin</a> the exam.</h3>';
        }
    
    
    ?>


    <hr>

    <?php
    if (oneTopicStudied()) {
        echo '<h4>Or select a topic to start revising</h4>
        <form method="get" action="topicSelected.php">
        <div class="list-group">';

        $conn = OpenCon();
            // echo "Connected Successfully";
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            $sql = "SELECT topic_id, topic_name FROM topic";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $topic_id = $row["topic_id"];

                    if (isTopicDone($topic_id)) { // show only if topic is not compeleted
                        echo '<button name="topic" value="'. $topic_id .'" type="submit" class="list-group-item list-group-item-action">'.$row["topic_name"].'</button>';
                    }

                    
                }
            } else {
                echo "0 results";
            }
        CloseCon($conn);

    echo '</div>
    </form>';
    }
    
    
    ?>

    
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</body>

</html>