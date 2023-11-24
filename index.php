<?php
$title = "HAHA WEB";
include "backend/database_con.php";
include "head.php";
if (isset($_POST['login'])){
    include 'system/loginSystem.php';
}


?>

<form action="" method="POST">

<div>
    
				<label>Username:</label>
				<input type="text" name="username" id="username" />
			</div>
			<div>
				<label>Password:</label>
				<input type="password" name="password" id="password" />
			</div>			
			<div>
				<input type="submit" value="Login" name="login" class="tombol">
			</div>

</form>