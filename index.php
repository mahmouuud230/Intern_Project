<?php
include_once("auth/authentication.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Professional Dashboard</title>
	<style>
		body {
			font-family: 'Arial', sans-serif;
		}

		.dashboard {
			display: flex;
			justify-content: space-around;
			align-items: center;
			padding: 20px;
			align-items: center;


		}

		.menu {
			width: 20%;
			background-color: #f4f4f4;
			padding: 15px;

		}

		.content {
			width: 75%;
		}

		.menu-item {
			display: block;
			padding: 10px;
			margin-bottom: 5px;
			background-color: #ddd;
			cursor: pointer;
			color: #333;
			text-decoration: none;
		}

		.menu-item:hover {
			background-color: #ccc;
		}

		.active {
			background-color: #bbb;
		}
	</style>
</head>

<body>
	<div class="dashboard">
		<div class="menu">
			<a class="menu-item active" href="contact.php?code=0">Contacts</a>
			<a class="menu-item" href="product.php?code=0">Products</a>
			<a class="menu-item" href="nationality.php?code=0">Nationality</a>
			<form style="align-self: flex-end; margin:0;" action="auth/logout.php" method="post">
				<button class="menu-item" name="logout_btn">LOGOUT</button>


			</form>
		</div>
	</div>
</body>

</html>