<?php
	session_start();
  if(isset($_GET['id'])){
		$pro_id = $_GET['id'];
		$_SESSION['pro_id'] = $pro_id;
	}
?>
<html lang="pt">
<head>
  <title>Prova online</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<script src="./js/jquery-1.11.3.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<style>
	
	#btn_resp, #btn_ok
	{
		float: right;
		margin-left: 15px;
	}
	.altert
	{
		//padding-left: 10px;
	}
	.container{
		padding:5% 0 0 0;
	}
	</style>
  <script>
	$(document).ready(function(){
		//BOTAO SAIR
		$("#btn_sair").click(function(){
			window.location.replace("painelprof.php");
		}); //Fecha btn_sair.click-----------------
    $("#btn_prova").click(function(){
			window.location.replace("viquiz.php");
		});
    $("#btn_nota").click(function(){
			window.location.replace("painel.php");
		});
	}); //Fecha document.ready--------------
</script>
</head>
	<body>	
		<div class="container">
			<div class="jumbotron">
				<!--QUIZ-->
				<div class="container" id="questao">
					<h1>O que você deseja visualizar</h1><br>
          <button type="button" class="btn btn-success" id="btn_nota">Notas</button>
          <button type="button" class="btn btn-success" id="btn_prova">Prova</button>
          <button type="button" class="btn btn-success" id="btn_sair">Sair</button>
					<!--Form Questão-->
				</div>
			</div>
		</div>
  </body>
</html> 