<?php
	session_start();
  include('conexao.php');
  if(isset($_GET['id'])){
		$pro_id = $_GET['id'];
		$_SESSION['pro_id'] = $pro_id;
	}
  $alu_id = $_SESSION['alu_id'];    
	$SQL = "SELECT * FROM `prova_realizada` WHERE `alunos_alu_id` = $alu_id  and `prova_pro_id`= $pro_id";
	// echo $SQL;
  $resultado = $conexao->query($SQL);
  if ($resultado->num_rows > 0){
		$linha = $resultado->fetch_object();
  //   echo"
  //   <div class='w3-third w3-container prova-margin'>
  //     <div class='w3-container w3-white'>
  //       <p><b>Realizada</b></p>
  //       <p><b>Nota:$linha->prea_nota</b></p>
  //       <p>Realizda dia: $linha->prea_dat_hor </p>
  //     </div>
  //   </div>
  // ";
  }else{
		header("Location: quiz.php?id=$pro_id");
		// die();
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
			window.location.replace("painel.php");
		}); //Fecha btn_sair.click-----------------
	}); //Fecha document.ready--------------
</script>
</head>
	<body>	
		<div class="container">
			<div class="jumbotron">
				<!--QUIZ-->
				<div class="container" id="questao">
					<h1>Realizada</h1><br>
          <p><b>Nota: <?php echo $linha->prea_nota ?></b></p>
          <p>Realizda dia: <?php echo$linha->prea_dat_hor ?></p>
					<!--Form Questão-->
				</div>
				<div id="botoes">
					<button type="button" class="btn btn-success" id="btn_sair">Sair</button>
				</div>
			</div>
		</div>
  </body>
</html>  