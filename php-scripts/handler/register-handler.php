<?php
    // Отчистка полей
    function sanitizeFromUsername($inputText){
        // Удаляяем html из строки
        $inputText = strip_tags($inputText);
        // Заменяем на пустойю строку
        $inputText = str_replace(" ", "", $inputText);
        return $inputText;
    }

    function sanitizeFromString($inputText){
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ", "", $inputText);
        $inputText = ucfirst(strtolower($inputText));
        return $inputText;
    }

    function sanitizeFromPassword($inputText){
        $inputText = strip_tags($inputText);
        return $inputText;
    }


    if(isset($_POST['registerButton'])){
        $username = sanitizeFromUsername($_POST['userName']);
        $firstname = sanitizeFromString($_POST['firstName']);
        $lastname = sanitizeFromString($_POST['lastName']);
        $email = sanitizeFromString($_POST['email']);
        $confemail = sanitizeFromString($_POST['confEmail']);
        $password = sanitizeFromPassword($_POST['password']);
        $password2 = sanitizeFromPassword($_POST['password2']);


        $wasSuccesful = $account->register($username, $firstname, $lastname, $email, $confemail, $password, $password2);
        
        if($wasSuccesful == true) {
            $_SESSION['userLoggedIn'] = $username;
            header("Location: index.php");
        }


    }

?>