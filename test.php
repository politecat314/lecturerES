<?php
include $_SERVER['DOCUMENT_ROOT'].'/es/connection.php';
?>

<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


</head>


<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Disabled</a>
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
        <h3>Please answer all questions</h3>
        <br>

        <form action="testResult.php" method="get">

        <?php
        $conn = OpenCon();
        // echo "Connected Successfully";
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT question_id, question FROM questions";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {

            $i = 0;
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $question_id = $row['question_id'];
                $question = $row['question'];

                echo "<b> $question_id $question </b><br>";

                $sql2 = "SELECT answers_id, answer_string FROM answers WHERE question_id = $question_id";
                $result2 = $conn->query($sql2);
                
                // var_dump($result2);
                if ($result2->num_rows > 0) {
                    // output data of each row
                    while ($row2 = $result2->fetch_assoc()) {
                        print_r($row2);
                        echo "<br><br>";
                    }
                } else {
                    echo "0 results";
                }


            }
        } else {
            echo "0 results";
        }
        CloseCon($conn);
        
        ?>


        <p><b>1. This is question 1</b>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
            <label class="form-check-label" for="exampleRadios1">
                Default radio
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
            <label class="form-check-label" for="exampleRadios2">
                Second default radio
            </label>
        </div>
        <br>
        </p>

        <p><b>2. This is question 1</b>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadiosb" id="exampleRadios3" value="option1" checked>
            <label class="form-check-label" for="exampleRadios3">
                Default radio
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadiosb" id="exampleRadios4" value="option2">
            <label class="form-check-label" for="exampleRadios4">
                Second default radio
            </label>
        </div>
        <br>
        </p>

        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


    </div>


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
</body>

</html>