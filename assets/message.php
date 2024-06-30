<?php
// include_once("authentication.php");

if (isset($_SESSION['message'])) {
?>

    <style>
        .alert {
            background-color: #95a5a6;
            color: #333;
            display: flex;
            margin: 8px auto;
            flex-direction: row;
            justify-content: space-between;
            padding: 15px;
            border-radius: 5px;
        }

        #x {
            color: #333;
            padding-right: 3px;
            cursor: pointer;
        }
    </style>
    <div id="alert" class="alert" role="alert">
        <div><strong>Hey! </strong><?= $_SESSION['message']; ?></div>
        <a id="x">x</a>
    </div>
    <script>
        const btn_alert = document.getElementById('x');
        const div_alert = document.getElementById('alert');

        btn_alert.addEventListener('click', function() {
            div_alert.style.display = "none";
        });

        function myFunction() {
            div_alert.style.display = "none";
        }
        setTimeout(myFunction, 2500);
    </script>
<?php
    unset($_SESSION['message']);
}


?>