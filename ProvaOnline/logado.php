<?php
if (!isset($_SESSION)) {
	session_start();
}
$email = $_SESSION['email'];
$usu_perfil = $_SESSION['perfil'];
$usu_id = $_SESSION['id'];
if(isset($_SESSION['Logado']))
if($_SESSION['Logado'] !='S')
{
  header("Location:login.php");
}
?>