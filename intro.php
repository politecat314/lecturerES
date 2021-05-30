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
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
</head>


<body>
    <style>
        body, html{
            background-image:linear-gradient(to bottom ,#38e4ae,#B7C0EE);
            height:100%;
            font-family: 'Quicksand', sans-serif;
            background-attachment:fixed;
        }

    </style>

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
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item active">
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



                    <!-- <li class="nav-item">
                        <a class="nav-link disabled" href="#">Disabled</a>
                    </li> -->
                </ul>
                <!-- <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
                </form> -->
            </div>
        </div>
    </nav>


    <div class="container">
        <br>
        <h3>Synopsis of This Course🐱‍💻:</h3>
        <br>
            <h5>
                This course covers problem solving and the
                fundamental of programming. These include problem
                solving techniques, the basic structure of computer
                program, the fundamental concepts of objectoriented programming, data types and operations,
                selection control structures i.e. if and switch,
                repetition control structures i.e. for, while, do-while,
                function, array, string, and programming
                practice.
            </h5>

        <br>
        <h3>Course Learning Outcomes (CLO)🎯:</h3>
        <br>
        <h5>
        <ul>
            <li> Define the steps of problem solving in programming</li>
            <li> Rewrite programs that contain errors.</li>
            <li> Develop programs based on principles of object-oriented.</li>
        </ul>
        </h5>
        <br>

        
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>