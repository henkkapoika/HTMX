<?php
if($_SERVER["REQUEST_METHOD"] = "POST") {
    if(isset($_POST["note"])) {
        echo "Toimi";
        //$_POST["note"] = $note;
        header("Location: index.php");
        exit();
    } else{
        echo "No 'note' in POST";
    }
}else {
    echo "Not a POST request method!";
}
?>