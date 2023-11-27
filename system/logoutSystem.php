<?php

session_destroy();
unset($_SESSION['username']);
header("Location: ../index.php");
exit();