<?php

session_start();
if ($_SESSION['auth']) {
    $_SESSION['message'] = "Logout to access SIGNUP Page";
    header('location: ../index.php');
    exit(0);
}

use Random\BrokenRandomEngineError;

include_once("../classes/Crud.php");
include_once("../classes/Validation.php");

$crud = new Crud();
$validation = new Validation();

//////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////--------------------ACTION SECTION----------------------/////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////


if (isset($_POST['Submit'])) {
    $name = $crud->escape_string($_POST['name']);
    $email = $crud->escape_string($_POST['email']);
    $password = $crud->escape_string($_POST['password']);
    $encrypt_password = md5($password);

    $msg = $validation->check_empty($_POST, array('name', 'email', 'password'));
    $check_email = $validation->is_email_valid($_POST['email']);

    // checking empty fields
    if ($msg != null) {
        echo $msg;
        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
        // } elseif (!$check_age) {
        // 	echo 'Please provide proper age.';
    } elseif (!$check_email) {
        echo 'Please provide proper email.';
    } else {
        // if all the fields are filled (not empty) 
        $check = $crud->getData("SELECT email FROM auth WHERE email = '$email'");
        //insert data to database	
        if (mysqli_num_rows($check) == 0) {
            $result = $crud->execute("INSERT INTO auth(name, email, password) VALUES('$name', '$email', '$encrypt_password')");
            header('location: login.php');
            exit(0);
        } else {
            echo "error";
        }
        //display success message


    }
} else {
    // include_once("authentication.php");
}

//////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////--------------------END SECTION----------------------/////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////

?>




<html>

<head>
    <title>Add Data</title>
    <link rel="stylesheet" href="/crud-php-oop-simple/assets/font-awesome-4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />

    <script type="text/javascript">
        function validate() {
            if (document.form1.name.value == "") {
                alert("Please provide your name");
                document.form1.name.focus();
                return false;
            }
            if (document.form1.email.value == "") {
                alert("Please provide your email");
                document.form1.email.focus();
                return false;
            }
            return true;
        }
    </script>
    <style>
        .updateButton {
            background-color: #16863c;
            /* Green */
            border: none;
            color: white;
            padding: 10px 26px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 3px;
        }

        .DeleteButton {
            background-color: #af2b21;
            /* Green */
            border: none;
            color: white;
            padding: 10px 26px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 3px;
        }

        .addButton {
            background-color: #424a4b;
            /* Green */
            border: none;
            color: white;
            padding: 10px 26px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 3px;
        }

        body {
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-direction: column;
            background-color: #95a5a6;
            font-family: "Poppins", sans-serif;
            font-size: 18px;
            gap: 30px;
        }

        input [type="date"] {
            max-width: 400px;
        }

        /*  */

        /* Import Google font - Poppins */
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        ::selection {
            color: #fff;
            background: #0d6efd;
        }

        .wrapper {
            margin-top: 80px;
            width: 715px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.05);
        }

        .wrapper header {
            font-size: 22px;
            font-weight: 600;
            padding: 20px 30px;
            border-bottom: 1px solid #ccc;
        }

        .wrapper form {
            margin: 35px 30px;
        }

        .wrapper form.disabled {
            pointer-events: none;
            opacity: 0.7;
        }

        form .dbl-field {
            display: flex;
            margin-bottom: 25px;
            justify-content: space-between;
        }

        .dbl-field .field {
            height: 50px;
            display: flex;
            position: relative;
            width: 100%;
            margin: 0 30px 0 30px;
        }

        .wrapper form i {
            position: absolute;
            top: 50%;
            left: 18px;
            color: #ccc;
            font-size: 17px;
            pointer-events: none;
            transform: translateY(-50%);
        }

        form .field input,
        form .message textarea {
            width: 100%;
            height: 100%;
            outline: none;
            padding: 0 18px 0 48px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .field input::placeholder,
        .message textarea::placeholder {
            color: rgb(0, 0, 0);
        }

        .field input:focus,
        .message textarea:focus {
            padding-left: 47px;
            border: 2px solid #95a5a6;
        }

        .field input:focus~i,
        .message textarea:focus~i {
            color: #95a5a6;
        }

        form .message {
            position: relative;
        }

        form .message i {
            top: 30px;
            font-size: 20px;
        }

        form .message textarea {
            min-height: 130px;
            max-height: 230px;
            max-width: 100%;
            min-width: 100%;
            padding: 15px 20px 0 48px;
        }

        form .message textarea::-webkit-scrollbar {
            width: 0px;
        }

        .message textarea:focus {
            padding-top: 14px;
        }

        form .button-area {
            margin: 25px 0;
            display: flex;
            align-items: center;
        }

        /* .button-area button {
        color: #fff;
        border: none;
        outline: none;
        font-size: 18px;
        cursor: pointer;
        border-radius: 5px;
        padding: 13px 25px;
        background: #0d6efd;
        transition: background-color 0.3s ease;
      } */
        /* .button-area button:hover {
        background: #025ce3;
      } */
        .button-area span {
            font-size: 17px;
            margin-left: 30px;
            display: none;
        }

        @media (max-width: 600px) {
            .wrapper header {
                text-align: center;
            }

            .wrapper form {
                margin: 35px 20px;
            }

            form .dbl-field {
                flex-direction: column;
                margin-bottom: 0px;
            }

            form .dbl-field .field {
                width: 100%;
                height: 45px;
                margin-bottom: 20px;
            }

            form .message textarea {
                resize: none;
            }

            form .button-area {
                margin-top: 20px;
                flex-direction: column;
            }

            .button-area button {
                width: 100%;
                padding: 11px 0;
                font-size: 16px;
            }

            .button-area span {
                margin: 20px 0 0;
                text-align: center;
            }
        }

        button {
            background-color: #95a5a6;
            color: whitesmoke;
            padding: 10px 8px;
            border: none;
            margin: 15px;
            margin-top: 1px;
            margin-left: 14px;
            border-radius: 4px;
            font-size: 18px;
        }

        button:hover {
            background-color: #535657;
            cursor: pointer;
            transition: 0.3s;
        }
    </style>
</head>

<body>
    <!-- <a class="addButton" style="align-self: flex-start; margin: 10px 0 30px 10px" href="index.php">Home</a> -->

    <div class="wrapper">
        <header>SIGNUP</header>
        <form action="signup.php" method="post" name="form1">
            <div class="dbl-field">
                <div class="field">
                    <input type="text" name="name" required placeholder="Enter your name" />
                </div>
            </div>
            <div class="dbl-field">
                <div class="field">
                    <input type="email" name="email" required placeholder="Enter your email" />
                </div>
            </div>
            <div class="dbl-field">
                <div class="field">
                    <input type="password" name="password" placeholder="Enter your password" required />
                </div>


            </div>

            <div>
                <button style="margin-left: 30px" class="addButton" name="Submit" type="submit">
                    SIGNUP
                </button>
                <span></span>
            </div>
        </form>
    </div>
</body>

</html>