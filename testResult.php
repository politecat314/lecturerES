<?php
// print_r($_GET);
?>

<?php
// include $_SERVER['DOCUMENT_ROOT'] . '/es/connection.php';
include 'connection.php';
?>

<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        #blockContainer {
            display: -webkit-box;
            display: -moz-box;
            display: box;

            -webkit-box-orient: vertical;
            -moz-box-orient: vertical;
            box-orient: vertical;
        }

        #blockA {
            -webkit-box-ordinal-group: 2;
            -moz-box-ordinal-group: 2;
            box-ordinal-group: 2;
        }
    </style>
</head>


<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">LOPES</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="topics.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Topics
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
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
                                    // echo "id: " . $row["topic_id"]. " - Name: " . $row["topic_name"] . "<br>";
                                    echo '<a class="dropdown-item" href="topicSelected.php?topic='.$row['topic_id'].'">'.$row['topic_name'].'</a>';
                                    }
                                } else {
                                    echo "0 results";
                                }
                                CloseCon($conn);
                            
                            ?>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="faq.php">FAQ</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="test.php">Test</a>
                    </li>

                    
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>


    <div class="container" id="blockContainer">
        


        <div id="blockA">

            <?php
            $results_info = array(); // question_id => (question_string, correct_answers, total_answers)


            $conn = OpenCon();
            // echo "Connected Successfully";
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT question_id, question, topic_id FROM questions";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                $i = 0;
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $question_id = $row['question_id'];
                    $question = $row['question'];
                    $topic_id = $row['topic_id'];

                    if (!array_key_exists($topic_id, $results_info)) {
                        $results_info[$topic_id] = array('correct'=>0, 'total'=>0);
                    }
                    
                    $results_info[$topic_id]['total'] += 1;
                    echo '<div>
                        <p><b>' . ++$i . '. ' . $question . ' </b></p>
                        <ul class="list-group">';

                    $sql2 = "SELECT * FROM answers WHERE question_id = $question_id";
                    $result2 = $conn->query($sql2);
                    
                    $answer_submitted = $_GET[$question_id];
                    // var_dump($result2);
                    if ($result2->num_rows > 0) {
                        // output data of each row
                        while ($row2 = $result2->fetch_assoc()) {
                            $ans_highlight = '';

                            


                            $correct = '';

                            if ($row2['correct_ans']) {
                                $correct = 'Correct answer';

                                if ($row2['answers_id'] === $answer_submitted) {
                                    $ans_highlight = 'list-group-item-success';
                                    $results_info[$topic_id]['correct'] += 1;
                                }
                            } else if ($row2['answers_id'] === $answer_submitted) { // is this the wrong answer which was submitted?
                                $ans_highlight = 'list-group-item-danger';
                            }

                            echo  '

                              <li class="list-group-item d-flex justify-content-between align-items-center ' . $ans_highlight . '">
                              ' . $row2['answer_string'] . '
                              <span class="badge badge-success badge pill">' . $correct . '</span>
                              </li>';
                        }

                        echo '</ul>
                    <br><br>
                </div>';
                    } else {
                        echo "0 results";
                    }
                }
            } else {
                echo "0 results";
            }
            CloseCon($conn);

            ?>

        </div>


        <div id="blockB">
        <br>
            <?php
            $total_questions = 0;
            $total_correct = 0;
            foreach($results_info as $value) {
                $total_questions += $value['total'];
                $total_correct += $value['correct'];
            }
            $heading_badge_color = 'badge-danger';
            $percentage = $total_questions/$total_correct;
            if ($percentage > 0.6) {
                $heading_badge_color = 'badge-success';
            }
            echo '<h2>You scored <span class="badge '.$heading_badge_color.'">'.$total_correct.'/'.$total_questions.'</span></h2>';
            ?>

        
        <br>


            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Topic</th>
                        <th scope="col">Marks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // print_r($results_info);
                        
                        $conn = OpenCon();
                        // echo "Connected Successfully";
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        
                        $sql = "SELECT topic_id, topic_name FROM topic";
                        $result = $conn->query($sql);
                        
                        if ($result->num_rows > 0) {

                            $i = 0;
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo '<tr>
                                <th scope="row">'.++$i.'</th>
                                <td>'.$row['topic_name'].'</td>
                                <td>'.$results_info[$row['topic_id']]['correct']."/".$results_info[$row['topic_id']]['total'].'</td>
                            </tr>';
                            }
                        } else {
                            echo "0 results";
                        }
                        CloseCon($conn);

                    ?>

                </tbody>
            </table>
            <br>
            <hr>


        </div>


    </div>


    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>