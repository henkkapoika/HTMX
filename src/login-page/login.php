<?php

session_start();

require "db_conn.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = isset($_POST['email']) ? $_POST['email'] : null; // ternary operation
    $password = isset($_POST['password']) ? $_POST['password'] : null; // ternary operation

    $errors = [];

    if(!$email || strpos($email, '@') === false){
        $errors['email'] = "Please enter a valid email address.";
    }

    if(!$password || strlen($password < 8)){
        $password['password'] = "Password must be at least 8-characters long";
    }

    // generoidaan vastaus virheiden perusteella
    if(count($errors) > 0){
        // Lisätään virhekoodi: validation error 422
        http_response_code(422);

        echo "
            <div id='extra-information'>
                <ul id='form-errors'>
        ";
        foreach($errors as $error){
            echo "<li>{$error}</li>";
        }
        echo "
                </ul>
            </div>
        ";
    } elseif(1 === 2){ // Testataan virhe-tilannetta, jolloin tämä haara aktivoituu ennen alempaa haaraa
        //header("HX-Retarget: .control"); // korvattu response-targets lisäosalla
        header("HX-Reswap: beforebegin"); // voisi korvata myös käyttämällä uutta diviä index-sivulla
        // Lisätään virhekoodi: internal server error 500
        http_response_code(500);
        echo "<p class=\"error\">A server-side error occured. Please try again.</p>";
    }
    else {
        // Tehdään uudelleenohjaus

        // SQL-statement / query
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        $stmt->close();
        if($user["email"] === $email && password_verify($password, $user["password"])) {
            // Luodaan kirjautunut-sessio
            $_SESSION['email'] = $user["email"];

            header("HX-Redirect: authenticated.php");
        } else {
            // tunnukset väärin
            http_response_code(401);
            echo "<p class=\"error\">Incorrect login details!</p>";
        }
        

        //echo ""; // ei virheitä
    }

}

?>