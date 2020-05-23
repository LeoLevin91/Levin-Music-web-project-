<?php
    class Account {

        private $con;
        private $errorArray;

        public function __construct($con){
            $this->con = $con;
            $this->errorArray = array(); 
        }

        public function register($un, $fn, $ln, $em1, $em2, $password, $password2){
            $this->validateUsername($un);
            $this->validateFirstname($fn);
            $this->validateLastname($ln);
            $this->validateEmail($em1, $em2);
            $this->validatePasswords($password, $password2);

            if(empty($this->errorArray) == true){
                //Insert into DataBase
                return $this->insertUserDetals($un, $fn, $ln, $em1, $password);
            } else {
                return false;
            }
        }

        public function getError($error){
            if(!in_array($error, $this->errorArray)){
                $error = "";        
            }
            return "<span class='errorMassage'>$error</span>";
        }

        private function insertUserDetals($un, $fn, $ln, $em1, $password){
            $encryptedPw = md5($password); // password -> asdfjasdfwe4343k3nwer23r1d
            $profilePic =  "../../assets/images/profile-pics/head_emerald.png";
            $date = date("Y-m-d");

            $result = mysqli_query($this->con, "INSERT INTO users VALUES ('', '$un', '$fn', '$ln', '$em1', '$encryptedPw', '$date', '$profilePic')");

            return $result;
        }

         // Валидация полей
        private function validateUsername($un){
            if(strlen($un) > 25 || strlen($un) < 5){
                array_push($this->errorArray, "Your username must be between 5 and 25 characters");
                return;
            }

            // TODO: check if username exists in database
            $checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username='$un'");
            if(mysqli_num_rows($checkUsernameQuery) != 0){
                array_push($this->errorArray, Constans::$usernameTaken);
                return;
            }
        }

        private function validateFirstname($fn){
            if(strlen($fn) > 25 || strlen($fn) < 2){
                array_push($this->errorArray, "Your firstname must be between 2 and 25 characters");
                return;
            }
        }

        private function validateLastname($ln){
            if(strlen($ln) > 25 || strlen($ln) < 2){
                array_push($this->errorArray, "Your lastname must be between 2 and 25 characters");
                return;
            }
        }

        private function validateEmail($em, $em2){
            if($em != $em2){
                array_push($this->errorArray, "Your emails don't match");
                return;
            }
            if(!filter_var($em, FILTER_VALIDATE_EMAIL)){
                array_push($this->errorArray, "Email address is not correct");
                return;
            }

            // TODO check that email hasn`t already been in DATABASE
            $checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email='$em'");
            if(mysqli_num_rows($checkEmailQuery) != 0){
                array_push($this->errorArray, Constans::$emailTaken);
                return;
            }

        }

        public function login($un, $password){
            $pw = md5($password);
            $query = mysqli_query($this->con, "SELECT * FROM users WHERE username='$un' AND password='$pw'");

            if(mysqli_num_rows($query) == 1){
                return true;
            } else {
                array_push($this->errorArray, Constans::$loginFailed);
                return false;
            }
        }

        private function validatePasswords($password, $password2){
            if($password != $password2){
                array_push($this->errorArray, "Your passwords don't match");
                return;
            }
            
            //regular exception
            if(preg_match('/[^A-Za-z0-9]/', $password)){
                array_push($this->errorArray, "Your password can only contain numbers and letters");
                return;
            }

            if(strlen($password) > 30 || strlen($password) < 7){
                array_push($this->errorArray, "Your password must be between 7 and 30 characters");
                return;
            }
        }

    }



?>