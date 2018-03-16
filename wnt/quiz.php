<!DOCTYPE html>
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
		
		//Esconder botão Next
		$("#btn_ok").hide();
		
		//Carregar primeira questão:
		$("#startQuiz").click(function()
		{
			$.post("processa.php",
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

			//Esconder botão Next
			$("#btn_ok").hide();
			//Mostrar botão Answer
			$("#btn_resp").show();

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
						$("#btn_resp").hide();
						//Trocar nome para Play Again e recomeçar o quiz
						$("#btn_ok").html("Play Again");
						//Mostrar botão Play Again
						$("#btn_ok").show();
					}
					else
					{
						//Mostrar botão Answer
						$("#btn_resp").show();
						//Trocar nome para Next
						$("#btn_ok").html("Next");
						//Esconder botão Next
						$("#btn_ok").hide();
					}
				 }); //Fecha $.post()-----------------
		}); //Fecha btn_ok.click-----------------

		//Mostrar resposta certa
		$("#btn_resp").click(function(){
			//Para cada input, faça:
			$("input").each(function(){
				//Se input atual não for o hidden que armazena a resposta
				if(
					$(this).attr('id') != "resp" && $(this).attr('id') != "last")
				{
					//Se input tiver o valor da resposta correta.
					if($(this).val() == $("#resp").val())
					{
						$(this).parent().parent().addClass("alert alert-success");
					}
					//Se input não tiver o valor da resposta correta.
					else
					{
					    $(this).parent().parent().addClass("alert alert-danger");
					}
				}
			}); //Fecha $.each--------------
			//Esconder botão Answer
			$("#btn_resp").hide();
			//Mostrar botão Next
			$("#btn_ok").show();

		}); //Fecha btn_resp.click----------
	}); //Fecha document.ready--------------
</script>

</head>
	<body>
<?php

include("menualuno.php")

?>
	
	
	<div class="container">
	<div class="jumbotron">
		<!--QUIZ-->
		<div class="container" id="questao">
			<h1> Let's start! </h1><br>
			<button type="button" class="btn btn-success btn-lg" id="startQuiz">Start Quiz</button>
			<!--Form Questão-->
		</div>
		<div id="botoes">
			<button type="button" class="btn btn-success" id="btn_resp">Answer</button>
			<button type="button" class="btn btn-success" id="btn_ok">Next</button>
		</div>
	</div>
	</div>
</body>
</html>  
