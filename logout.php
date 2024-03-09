<?php
session_start();
//Hapus data session user
unset($_SESSION["user"]);
//Redirect ke halaman login
header("Location: login.php");
