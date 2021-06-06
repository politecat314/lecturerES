<?php
include 'connection.php';
include 'helper_functions.php';

if (!empty($_POST)) {
    echo "contents of POST: ";
    print_r($_POST);


    // if all clear
    if (array_key_exists("all", $_POST)) {
        $command = 0;
        if ($_POST["all"] === "1") { // reset everything
            $command = 1;
        } 
            
            $conn = OpenCon();

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT * FROM topic";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    changeTopic($row['topic_id'], $command);
                }
            } else {
                echo "0 results for vid_isWatched in knowledgebase.php";
            }

            CloseCon($conn);
        
    }


    // checking if a certain topic is inside post
    $conn = OpenCon();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM topic";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {

            if (array_key_exists($row['topic_id'], $_POST)) {
                $command_str = $_POST[$row['topic_id']];
                $topic_id = $row['topic_id'];
                $command = 0;
                if (str_ends_with($command_str, '1')) {
                    $command = 1;
                }
                if (str_starts_with($command_str, 'faq')) {
                    changeFaq($topic_id, $command);
                } else if (str_starts_with($command_str, 'notes')) {
                    changeLectNotes($topic_id, $command);
                } else if (str_starts_with($command_str, 'test')) {
                    changeQuestions($topic_id, $command);
                } else if (str_starts_with($command_str, 'videos')) {
                    changeVideos($topic_id, $command);
                } else { // delete all
                    changeTopic($topic_id, $command);
                }
            }

            break;
        }
    } else {
        echo "0 results for vid_isWatched in knowledgebase.php";
    }

    CloseCon($conn);
}
?>

<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
</head>


<body>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                Fun With Java ES
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="intro.php">Intro</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>
    <br>

    <div class="container fluid" style="border-style: dotted;">
        <div class="col">
            <div class="row">
                <div class="col-2">
                    <h4>Set to 0</h4>
                </div>
                <div class="col">
                    <form action="" method="post">
                        <button type="submit" name="all" value="0" class="btn btn-danger">Set all to 0</button>
                    </form>
                </div>
            </div>

            <?php
            // iterate through all the $topic_id
            $conn = OpenCon();

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT * FROM topic";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    $row['topic_id'];
                    $row['topic_name'];

                    echo '<div class="row">
                <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                        <form method="post">
                            <button name="' . $row['topic_id'] . '" value="faq0" type="submit" class="btn btn-secondary">FAQ</button>
                            <button name="' . $row['topic_id'] . '" value="notes0" type="submit" class="btn btn-secondary">Lecture notes</button>
                            <button name="' . $row['topic_id'] . '" value="test0" type="submit" class="btn btn-secondary">Test</button>
                            <button name="' . $row['topic_id'] . '" value="videos0" type="submit" class="btn btn-secondary">Videos</button>
                            <button name="' . $row['topic_id'] . '" value="all0" type="submit" class="btn btn-warning">Whole topic</button>
                        </form>
                    </div>
                    <div class="">
                        <h4>
                            ' . $row['topic_name'] . '
                        </h4>
                    </div>
                </div>
            </div>';
                }
            } else {
                echo "0 results for vid_isWatched in knowledgebase.php";
            }

            CloseCon($conn);
            ?>
        </div>

        <hr>
        <div class="col">
            <div class="row">
                <div class="col-2">
                    <h4>Set to 1</h4>
                </div>
                <div class="col">
                    <form action="" method="post">
                        <button type="submit" name="all" value="1" class="btn btn-danger">Set all to 1</button>
                    </form>
                </div>
            </div>

            <?php
            // iterate through all the $topic_id
            $conn = OpenCon();

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT * FROM topic";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    $row['topic_id'];
                    $row['topic_name'];

                    echo '<div class="row">
                <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                        <form method="post">
                            <button name="' . $row['topic_id'] . '" value="faq1" type="submit" class="btn btn-secondary">FAQ</button>
                            <button name="' . $row['topic_id'] . '" value="notes1" type="submit" class="btn btn-secondary">Lecture notes</button>
                            <button name="' . $row['topic_id'] . '" value="test1" type="submit" class="btn btn-secondary">Test</button>
                            <button name="' . $row['topic_id'] . '" value="videos1" type="submit" class="btn btn-secondary">Videos</button>
                            <button name="' . $row['topic_id'] . '" value="all1" type="submit" class="btn btn-warning">Whole topic</button>
                        </form>
                    </div>
                    <div class="">
                        <h4>
                            ' . $row['topic_name'] . '
                        </h4>
                    </div>
                </div>
            </div>';
                }
            } else {
                echo "0 results for vid_isWatched in knowledgebase.php";
            }

            CloseCon($conn);
            ?>

        </div>
    </div>
    <br>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>