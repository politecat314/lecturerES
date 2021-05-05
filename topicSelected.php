<?php
// include $_SERVER['DOCUMENT_ROOT'].'/es/connection.php';
include 'connection.php';
include 'helper_functions.php';
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
                                while ($row = $result->fetch_assoc()) {
                                    // echo "id: " . $row["topic_id"]. " - Name: " . $row["topic_name"] . "<br>";
                                    echo '<a class="dropdown-item" href="topicSelected.php?topic=' . $row['topic_id'] . '">' . $row['topic_name'] . '</a>';
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


    <div class="container">
        <br>
        <?php
        $topic_id = $_GET['topic'];

        $conn = OpenCon();
        // echo "Connected Successfully";
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT topic_name, topic_id FROM topic WHERE topic_id = $topic_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                // echo "id: " . $row["topic_id"]. " - Name: " . $row["topic_name"] . "<br>";
                $topic_name = $row["topic_name"];
                $topic_id = $row['topic_id'];
            }
        } else {
            echo "0 results";
        }
        CloseCon($conn);

        echo "<h2 class='text-center'><b>" . $topic_name . "</b></h2><br>";

        ?>


        <div class="list-group">
        <!-- <a href="#" onclick="<?php //echo 'update(' . $topic_id . ')'; ?>">Hello World</a> -->
            <a href="<?php echo getLectureURL($topic_id); ?>" onclick="<?php echo 'update(' . $topic_id . ')'; ?>" class="list-group-item list-group-item-action">Lecture notes</a>
            <a href="videos.php?topic_id=<?php echo $topic_id ?>" class="list-group-item list-group-item-action">Watch lecture videos</a>
            <a href="faq.php?topic_id=<?php echo $topic_id ?>" class="list-group-item list-group-item-action">Have a look at frequently asked questions</a>
            <a href="test.php?topic_id=<?php echo $topic_id ?>" class="list-group-item list-group-item-action">Do test for this topic</a>
        </div>


        <!-- <form action="faq.php" method="get">
            <button type="submit" name="topic_id" value="1" class="btn btn-primary btn-lg">Large button</button>
        </form> -->

    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
    <script>
        function update(topic_id) {
            
            $.ajax({
                    type: "POST",
                    url: "update.php",
                    data: {
                        topic_id: topic_id
                    }
                })
                .done(function(msg) {
                    // alert("Data Saved: " + msg);
                });
        }
    </script>

</body>

</html>