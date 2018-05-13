<?php
if (!isset($_SESSION)) {
	session_start();
}
  //passar para variavel 
  //infomaçoes de login
  $email = $_SESSION['email'];
  $usu_perfil = $_SESSION['perfil'];
  $usu_id = $_SESSION['id'];
  $dadospes_nome = $_SESSION['dadospes_nome'];

if(isset($_SESSION['Logado']))
if($_SESSION['Logado'] !='S')
{
  header("Location:login.php");
}
?>