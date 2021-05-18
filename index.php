<?php
include 'connection.php';

?>

<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
    a { color:black; }
a:hover { color:black;
text-decoration: none; }
.nav a { color:black; }
    
    </style>
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



                    <!-- <li class="nav-item">
                        <a class="nav-link disabled" href="#">Disabled</a>
                    </li> -->
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>


    <div class="container">
        <br>
        <?php
        // $dayofweek = date("w");
    
        // $today="";
        // switch ($dayofweek){
        //     case 0: $today="Sunday"; break;
        //     case 1: $today="Monday"; break;
        //     case 2: $today="Tuesday"; break;
        //     case 3: $today="Wednesday"; break;
        //     case 4: $today="Thursday"; break;
        //     case 5: $today="Friday"; break;
        //     case 6: $today="Saturday"; break;
        // }
        // $times = (date("g")+6).":".date("i").":".date("s");
        // echo "<p>Today is $today $times </p>";

        $currenttime = date("G")+6;
        
        $timezone="";
        if($currenttime>=5 && $currenttime<12)
            $timezone="morning";
        else if($currenttime>=12 && $currenttime<17)
            $timezone="afternoon";
        else 
            $timezone="evening";
        echo "<h3>Good $timezone and welcome to FOP!</h3>";
        ?>
        
        <h3>My name is Dr. Unaizah and I will be your FOP lecturer. Select one of the options below and start learning!</h3>
        
        <br>
        <!-- <a class="btn btn-success btn-lg btn-block" href="topics.php">Begin Learning</a>
        <a class="btn btn-primary btn-lg btn-block" href="faq.php">FAQ</a>
        <a class="btn btn-secondary btn-lg btn-block" href="test.php">Take a test</a> -->


        <div class="card-deck">
            <!-- <div class="card"> -->

            <?php
                $courseLearningOutcomeLookedAt = true;

                echo '<a class="card" href="intro.php">
                    <img class="card-img-top" src="https://drive.google.com/uc?export=view&id=1hsc0CBaqr4JOlwxX9RJ99mDTGG8bC7rd" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Introduction to FOP</h5>
                        <p class="card-text">Read about the synopsis and learning outcomes of this course.</p>
                    </div>
                    </a>';

                if ($courseLearningOutcomeLookedAt) {
                    echo '<a class="card" href="topics.php">
                    <img class="card-img-top" src="https://drive.google.com/uc?export=view&id=1KUwNiXYEw1F2rHezbtbRj84cVt1k9jx2" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Begin learning</h5>
                        <p class="card-text">Take your first step to learn and understand more about Java programming language.</p>
                    </div>
                    </a>';
                }
            
            ?>
            
                <!-- <a class="card" href="faq.php">
                <img class="card-img-top" src="https://drive.google.com/uc?export=view&id=19jV5mk0pyH1YImVx0KUnKT-_Z4KToawH" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">View frequently asked questions</h5>
                    <p class="card-text">Questions that might help you to code Java like a pro.</p>
                </div>
                </a>
            
                <a class="card" href="test.php">
                <img class="card-img-top" src="https://drive.google.com/uc?export=view&id=1q0qd-uhp_WOaPPMaeg01pkUemQU-9Rru" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Take a test</h5>
                    <p class="card-text">Test your knowledge about Java programming language with our sets of questions based on what you learnt.</p>
                </div>
                </a> -->
            
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>