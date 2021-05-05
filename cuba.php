<?php
 include 'kb_faq.php';
 include 'kb_vid.php';
 include 'kb_notes.php';
 include 'kb_minitest.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aman Maldives</title>
</head>
<body>
    
<h1>
    <?php
    // All videos have been watched OR lecture notes have been read AND
    // Frequently Asked Question is read by the student AND
    // Test for each topic done and passed
    if(($all_vid_watched || $all_notes_watched) and $all_faq_watched and $all_minitest_watched)
        echo "You are ready to take the final test! <br>";
    else{
        echo "You are not ready to take the final test because <br>";
        if($all_vid_watched!=1)
            echo "You haven't watched all videos <br>";
        if($all_notes_watched!=1)
            echo "You haven't read all lecture notes <br>";
        if($all_faq_watched!=1)
            echo "You haven't read all FAQ yet <br>";
        if($all_minitest_watched!=1)
            echo "You haven't done all minitest yet <br>";
        
    }
    ?>
</h1>


</body>
</html>
