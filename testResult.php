<?php
// print_r($_GET);
?>

<?php
// include $_SERVER['DOCUMENT_ROOT'] . '/es/connection.php';
include 'connection.php';
include 'helper_functions.php';
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
                            //     while ($row = $result->fetch_assoc()) {
                            //         // echo "id: " . $row["topic_id"]. " - Name: " . $row["topic_name"] . "<br>";
                            //         echo '<a class="dropdown-item" href="topicSelected.php?topic=' . $row['topic_id'] . '">' . $row['topic_name'] . '</a>';
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

                    if (!array_key_exists($question_id, $_GET)) {
                        continue;
                    }

                    if (!array_key_exists($topic_id, $results_info)) {
                        $results_info[$topic_id] = array('correct' => 0, 'total' => 0);
                    }

                    $results_info[$topic_id]['total'] += 1;
                    echo '<div>
                        <p><b>' . ++$i . '. ' . $question . ' </b><span class="badge badge-primary pill">'.getTopicName($topic_id).'</span></p>
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
                                    updateQuestionCorrectness($question_id, 1);
                                }
                            } else if ($row2['answers_id'] === $answer_submitted) { // is this the wrong answer which was submitted?
                                $ans_highlight = 'list-group-item-danger';
                                updateQuestionCorrectness($question_id, 0);
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
            foreach ($results_info as $value) {
                $total_questions += $value['total'];
                $total_correct += $value['correct'];
            }
            $heading_badge_color = 'badge-danger';

            $percentage = 0;

            if ($total_correct !== 0) {
                $percentage = $total_correct / $total_questions;
            }
            $pass = 'failed';

            $final_exam_pass = false;
            if ($percentage >= 0.6) { // greater than 60% in all of the questions mean you have passed the final exam
                $final_exam_pass = true;
            }

            if ($final_exam_pass) {
                $heading_badge_color = 'badge-success';
                $pass = 'passed';
            }
            echo '<h2>You scored <span class="badge ' . $heading_badge_color . '">' . $total_correct . '/' . $total_questions . '</span></h2>';
            echo '<h4>You ' . $pass . ' this test with ' . number_format($percentage * 100, 1) . '%</h4>';



            // the expert system recommendation

            if ($final_exam_pass) {
                echo "<h4>Dr. Unaizah thinks you have a good understanding of this topic!<h4>";
                echo '<button onclick="displayPass()" class="btn btn-outline-info">Why does Dr. Unaizah think I have a good understanding?</button>';
            } else {
                echo "<h5>Dr. Unaizah recommends revising the following topics: <h5>";
                echo "<ol>";
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
                    while ($row = $result->fetch_assoc()) {

                        if (!array_key_exists($row['topic_id'], $results_info)) {
                            continue;
                        }
                        $this_topic_name = $row['topic_name'];
                        $correct_this_topic = $results_info[$row['topic_id']]['correct'];
                        $total_this_topic = $results_info[$row['topic_id']]['total'];

                        if ($correct_this_topic / $total_this_topic < 0.6) { // failing in this topic
                            echo "<li>$this_topic_name</li>";
                        }
                    }
                } else {
                    echo "0 results";
                }
                CloseCon($conn);
                echo "</ol>";

                echo '<a class="btn btn-outline-primary" href="topics.php">Start revision</a>
                <button onclick="displayTable()" class="btn btn-outline-info">Why does Dr. Unaizah recommend revising these topics?</button>
                <br>';
            }
            ?>

            <div id="display-pass" style="display:none;">
            <p>
            <h5>Because you have finished studying all topics and scored above 60% in the final exam!</h5>
            </p>
            
                
            </div>
            

            
            <div id="table-div" style="display:none;">
            <br>
                <table class="table table-striped">

                    <h5>You scored less than 60% in questions related to those topic(s), as shown in the table below</h5>
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
                            while ($row = $result->fetch_assoc()) {

                                if (!array_key_exists($row['topic_id'], $results_info)) {
                                    continue;
                                }

                                if ($results_info[$row['topic_id']]['correct'] / $results_info[$row['topic_id']]['total'] >= 0.6) { // if passed from that topic, don't include in the table
                                    continue;
                                }
                                echo '<tr>
                                <th scope="row">' . ++$i . '</th>
                                <td>' . $row['topic_name'] . '</td>
                                <td>' . $results_info[$row['topic_id']]['correct'] . "/" . $results_info[$row['topic_id']]['total'] . '</td>
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
            </div>




            <hr>


        </div>


    </div>


    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        function displayTable() {
            // console.log("button pressed")
            var x = document.getElementById("table-div");
            
            x.style.display = "block";
        }


        function displayPass() {
            var y = document.getElementById("display-pass");

            y.style.display = "block";
        }
    </script>


</body>

</html>