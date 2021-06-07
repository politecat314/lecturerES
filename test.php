<?php
// include $_SERVER['DOCUMENT_ROOT'].'/es/connection.php';
include 'connection.php';
include 'helper_functions.php';
?>

<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
</head>


<body>
    <style>
        body, html{
            /* background-image:linear-gradient(to bottom ,#38e4ae,#B7C0EE); */
            background-color: #f2f2f2;
            height:100%;
            font-family: 'Quicksand', sans-serif;
            background-attachment:fixed;
        }

    </style>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Fun With Java ES</a>
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
                    
                    <!-- <li class="nav-item dropdown">
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

                    <li class="nav-item active">
                        <a class="nav-link" href="#">Test</a>
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

        <h3>
        <?php
        if (empty($_GET)) {
            echo "Please answer all questions";
        } else {
            echo "Practice questions for ". getTopicName($_GET['topic_id']);
        }
        ?>
        </h3>
        <h5>Please select how confident you are for each answer. 1=very unsure. 4=very confident</h5>
        <br>

        <form action="testResult.php" method="get">

        <?php
        $conn = OpenCon();
        // echo "Connected Successfully";
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT question_id, question FROM questions";
        if (!empty($_GET)) {
            $sql = $sql . " WHERE topic_id=".$_GET['topic_id'];
        }
        
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {

            $i = 0;
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $question_id = $row['question_id'];
                $question = $row['question'];

                echo "<b>". ++$i .". $question </b><br>";

                $sql2 = "SELECT answers_id, answer_string FROM answers WHERE question_id = $question_id";
                $result2 = $conn->query($sql2);
                
                // var_dump($result2);
                if ($result2->num_rows > 0) {
                    // output data of each row
                    while ($row2 = $result2->fetch_assoc()) {
                        echo '<div class="form-check">
                                <input required class="form-check-input" type="radio" name="'.$question_id.'" id="'.$row2['answers_id'].'" value="'.$row2['answers_id'].'">
                                <label class="form-check-label" for="'.$row2['answers_id'].'">
                                    '.$row2['answer_string'].'
                                </label>
                              </div><br>';

                    }
                } else {
                    echo "0 results";
                }

                echo '<div class="form-check form-check-inline">Confidence level: </div>
                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="'.$question_id."c".'" id="'.$question_id."c1".'" value="1">
                <label class="form-check-label" for="'.$question_id."c1".'">1</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="'.$question_id."c".'" id="'.$question_id."c2".'" value="2">
                <label class="form-check-label" for="'.$question_id."c2".'">2</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="'.$question_id."c".'" id="'.$question_id."c3".'" value="3">
                <label class="form-check-label" for="'.$question_id."c3".'">3</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="'.$question_id."c".'" id="'.$question_id."c4".'" value="4">
                <label class="form-check-label" for="'.$question_id."c4".'">4</label>
              </div>
              
              <br><br>';
            }
        } else {
            echo "0 results";
        }
        CloseCon($conn);
        
        ?>

        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


    </div>


    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>