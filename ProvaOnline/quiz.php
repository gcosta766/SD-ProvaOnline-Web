<!DOCTYPE html>
<?php
	 $pro_id = $_GET['id'];

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
		
		//Esconder div de botões ao carregar a página e esperar pelo começo do quiz
		$("#botoes").hide();
		
		//Esconder botão Sair
		$("#btn_sair").hide();

		$("#Fim").hide();
		
		//Carregar primeira questão:
		$("#startQuiz").click(function()
		{
			$.post("processa.php?id=0",
			{
				Start: 'ok'
			},
			function(Resposta, status){
				$("#questao").html(Resposta);
			});
		});
		
		//BOTAO NEXT
		//Confirmar resposta
		$("#btn_ok").click(function(){
			//Pegar alternativa marcada
			var resp = $(":checked").val();
			//Pegar número da quetão do campo hidden
			var questao = $("#resp").attr("name");

			//Enviar respostas e carregar a próxima questão
			$.post("processa.php",
				{
					Alternativa:resp,
					NumQ: questao
				},
				function(Resposta)
				{
					//Carregar próxima questão na div
					$("#questao").html(Resposta);

					//Verificar questão:
					if($("#last").val() == "last")
					{
						//Esconder botão Answer
						$("#btn_ok").hide();
						//Mostrar botão Play Again
						$("#btn_sair").show();
					}
				 }); //Fecha $.post()-----------------
		}); //Fecha btn_ok.click-----------------

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
					<h1> Clique no botão para iniciar! </h1><br>
					<button type="button" class="btn btn-success btn-lg" id="startQuiz">Iniciar Prova</button>
					<!--Form Questão-->
				</div>
				<div id="botoes">
					<button type="button" class="btn btn-success" id="btn_sair">Sair</button>
					<button type="button" class="btn btn-success" id="btn_ok">Responder</button>
				</div>
			</div>
		</div>
</body>
</html>  
