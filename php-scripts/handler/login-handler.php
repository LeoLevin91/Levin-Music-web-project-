<?php
    if(isset($_POST['loginButton'])){
        $username = $_POST['loginUserName'];
        $password = $_POST['passwordUser'];

        // Login functions
        $result = $account->login($username, $password);

        if($result == true){
            $_SESSION['userLoggedIn'] = $username;
            header("Location: index.php");
    }
}
?>