<?php
include_once("auth/authentication.php");
include_once("classes/Crud.php");
include_once("classes/Validation.php");

//VIEW
if ($_GET['code'] == 0) {

    $_SESSION['nationality-switch'] = 0;

    //ADD    
} elseif ($_GET['code'] == 1) {

    $_SESSION['nationality-switch'] = 1;

    //EDIT    
} elseif ($_GET['code'] == 2) {
    $_SESSION['nationality-switch'] = 2;

    //DELETE    
} elseif ($_GET['code'] == 3) {
    $_SESSION['nationality-switch'] = 3;

    //DELETE    
} elseif ($_GET['code'] == 4) {
    $id = $_GET['id'];
    $_SESSION['nationality-switch'] = 4;
}

//////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////--------------------VIEW SECTION----------------------///////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////



if ($_SESSION['nationality-switch'] == 0) {

    $crud = new Crud();
    $validation = new Validation();

    $auth_id = $_SESSION['auth_user']['id'];

    $query = "SELECT * FROM nationality ORDER BY nationality_name ASC";

    $result = $crud->getData($query);

    // -- Search Query --
    if (isset($_POST['SEARCH'])) {
        $search = $crud->escape_string($_POST['search']);
        // print_r("aaa" . $search);

        $msg = $validation->check_empty($_POST, array('search'));
        // print_r($msg);

        // checking empty fields
        if (isset($msg)) {
            $_SESSION['message'] = "Enter name to search";
        } else {

            $query = "SELECT * FROM nationality WHERE nationality_name LIKE '$search%' ORDER BY nationality_name ASC";
            $result = $crud->getData($query);
        }
    }
?>
    <html>

    <head>
        <title>Homepage</title>
        <link rel="stylesheet" href="assets/table.css">
    </head>
    <style>
        .search_input {
            /* width: 100%; */
            height: 90%;
            width: 200px;
            outline: none;
            padding: 0 18px 0 18px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-left: 10px;
            margin-right: 10px;
            align-self: center;
        }

        form {
            margin: 0;
            display: flex;
            flex-direction: row;
        }
    </style>

    <body>

        <div class="container">
            <ul style="list-style-type: none;" class="responsive-table">
                <?php include('assets/message.php'); ?>
                <div style="display: flex; flex-direction: row; justify-content: space-between;  ">

                    <div style="display: flex; flex-direction: row; justify-content: space-between;">

                        <a style="align-self: center;" class="addButton" href="nationality.php?code=3&form=<?= "add" ?>" id="executeButton">ADD nationality</a>
                        <form action="nationality.php?code=0" method="post" name="formx">
                            <input class="search_input" type="text" name="search">
                            <input style="align-self: center;" class="addButton" value="Search" type="submit" name="SEARCH">
                        </form>

                    </div>

                    <a class="addButton" href="index.php" name="logout_btn">Dashboard</a>




                </div><br>

                <li class="table-header">
                    <div class="col col-1">ID</div>
                    <div class="col col-2">Name</div>
                    <div class="col col-4">Update</div>
                    <div class="col col-4">Delete</div>
                </li>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $res) {
                ?>
                        <li class="table-row">
                            <div class="col col-1"><?= $res['nationality_id'] ?></div>
                            <div class="col col-2"><?= $res['nationality_name'] ?></div>
                            <div class="col col-4"><a class="updateButton" href="nationality.php?code=3&id=<?= $res['nationality_id'] ?>&form=<?= "update" ?>">Edit</a></div>
                            <div class=" col col-4"><a class="DeleteButton" href="nationality.php?code=4&id=<?= $res['nationality_id'] ?>&name=<?= $res['nationality_name'] ?>" onClick=" return confirm('Are you sure you want to delete?')">Delete</a></div>
                        </li>
                    <?php
                    }
                } else {
                    ?> <li class="table-row">
                        <div class="col col-1">No nationality</div>

                    </li>



                <?php } ?>

            </ul>
        </div>
    </body>

    </html>
<?php }
//////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////--------------------ADD SECTION----------------------////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['nationality-switch'] == 1) {

    $crud = new Crud();
    $validation = new Validation();

    if (isset($_POST['submit'])) {


        $name = $crud->escape_string($_POST['name']);

        $msg = $validation->check_empty($_POST, array('name'));


        // checking empty fields
        if (isset($msg)) {

            echo $msg;
            //link to the previous page
            echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
        } else {

            //insert data to database	
            $result = $crud->execute("INSERT INTO nationality(nationality_name) VALUES('$name')");

            if ($result) {
                $_SESSION['message'] = "$name has been added to your nationality";
                header("Location: nationality.php?code=0");
                exit;
            }
        }
    }
}
//////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////--------------------EDIT SECTION----------------------///////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['nationality-switch'] == 2) {
    $crud = new Crud();
    $validation = new Validation();


    if (isset($_POST['submit'])) {
        $id = $crud->escape_string($_POST['submit']);

        $name = $crud->escape_string($_POST['name']);

        $msg = $validation->check_empty($_POST, array('name'));

        // checking empty fields
        if ($msg) {
            echo $msg;
            //link to the previous page
            echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
        } else {
            //updating the table
            $result = $crud->execute("UPDATE nationality SET nationality_name='$name' WHERE nationality_id=$id");

            if ($result) {
                $_SESSION['message'] = "$name has been updated";
                header("location: nationality.php?code=0");
                exit;
            }
            //redirectig to the display page. In our case, it is index.php
        }
    }
}

//////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////--------------------FORM SECTION----------------------///////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////


if ($_SESSION['nationality-switch'] == 3) {
    $crud = new Crud();
    //getting id from url

    if (isset($_GET['id'])) {

        $id = $crud->escape_string($_GET['id']);

        //selecting data associated with this particular id
        $result = $crud->getData("SELECT * FROM nationality WHERE nationality_id=$id");

        foreach ($result as $res) {

            $name = $res['nationality_name'];
        }
    }

?>
    <html>

    <head>
        <title>Update nationality</title>
        <link rel="stylesheet" href="/crud-php-oop-simple/assets/font-awesome-4.7.0/css/font-awesome.css" />

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
                width: calc(100% / 2 - 13px);
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
                color: black;
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
        <a class="addButton" style="align-self: flex-start; margin: 10px 0 30px 10px" href="nationality.php?code=0"><i class="fa fa-arrow-left" aria-hidden="true"></i> Home</a>


        <div class="wrapper">
            <header><?php echo isset($_GET['form']) && $_GET['form'] == "update" ? "UPDATE" : "ADD"; ?> Nationality</header>
            <form action="nationality.php?code=<?php echo isset($_GET['form']) && $_GET['form'] == "update" ? "2" : "1"; ?>" method="post" name="form1">
                <div class="dbl-field">
                    <div class="field">
                        <input type="text" value="<?php echo isset($name) ? $name : ""; ?>" name="name" required placeholder="Enter your name" />
                        <i class="fas fa-user"></i>
                    </div>
                </div>
                <div class="button-area">
                    <button style="margin:0;" class="addButton" value="<?php echo isset($id) ? $id : ""; ?>" name="submit"><?php echo isset($_GET['form']) && $_GET['form'] == "update" ? "UPDATE" : "ADD"; ?></button>
                    <span></span>
                </div>
            </form>
        </div>

    </body>

    </html>






<?php }

//////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////--------------------DELETE SECTION----------------------/////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['nationality-switch'] == 4) {

    $crud = new Crud();

    //getting id of the data from url
    $id = $crud->escape_string($_GET['id']);
    $name = $crud->escape_string($_GET['name']);

    $result = $crud->delete($id, 'nationality');

    if ($result) {

        $_SESSION['message'] = "$name has been deleted";

        //redirecting to the display page (index.php in our case)
        header("Location: nationality.php?code=0");
        exit;
    }

?>

<?php } ?>