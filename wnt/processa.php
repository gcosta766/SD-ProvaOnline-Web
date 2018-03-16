<?php	
session_start();
include("conexao.php");
	try
	{
		//Contador das questões
		//Se sessões não foram iniciadas(Após session_detroy();)
		if((!isset($_SESSION['Corretas']) && !isset($_SESSION['Erradas']) && !isset($_SESSION['Questoes'])) || isset($_POST['Start']))
		{
			@$_SESSION['Status'] = $_POST['Start'];
			//Restaurar div de botões da página
			echo "
			<script>
				$('#botoes').show();
			</script>
			";
	
			$_SESSION['Corretas'] = 0;
			$_SESSION['Erradas'] = 0;
			
			$_SESSION['NumQuestao'] = 0; //Contador quetão
			$_SESSION['Questoes'] = array(); //Códigos das questões 
			
			//Pegar todas as questões cadastradas no banco de dados			
			$SQL = "SELECT questao_idprova  FROM prova_has_questao";
			$resultado = $conexao->query($SQL);
			while($linha = $resultado->fetch_object())
			{
				array_push($_SESSION['Questoes'], $linha->questao_idprova );
			}
			
			//Embaralhar questões
			shuffle($_SESSION['Questoes']);	
		}
		
		//Resposta do usuário
		if(isset($_POST['Alternativa']) && isset($_POST['NumQ']))
		{
			$AlternResp = $_POST['Alternativa'];
			//echo "Alternativa Resposta: ".$AlternResp;
			//Verificando se a resposta está correta
			//echo"<script>alert('$AlternResp')</script>";
			$SQL = "SELECT respostaprova FROM questao WHERE idprova = ".$_POST['NumQ'];
			$resultado = $conexao->query($SQL);
			$linha = $resultado->fetch_object();
			//echo "Respota certa: $linha->Resposta";
			if($linha->Resposta == $AlternResp)
			{
				$_SESSION['Corretas'] += 1;
			}
			else
			{
				$_SESSION['Erradas'] += 1;
			}
		}	

		//Número de questões, fim do quiz
		if($_SESSION['NumQuestao'] >= 5)
		{
			echo"
			<h1> End of the quiz </h1>
			<p><strong>Number of hits :</strong> ".$_SESSION['Corretas']."</p>
			<p><strong>Number of errors :</strong> ".$_SESSION['Erradas']."</p>
			<input type=\"hidden\" value=\"last\" id=\"last\">
			";
			//session_destroy();
			unset($_SESSION['Corretas']);
			unset($_SESSION['Erradas']);
			unset($_SESSION['Questoes']);
			unset($_SESSION['Status']);
			unset($_SESSION['NumQuestao']);	
		}
		else
		{
			$_SESSION['Status'] = 'online';
			//Montar próxima questão:
			$SQL = "SELECT * FROM questao WHERE idprova = '".$_SESSION['Questoes'][($_SESSION['NumQuestao'])]."'";
			
			$resultado = $conexao->query($SQL);
			$linha = $resultado->fetch_object();
			$QuestaoAtual = $_SESSION['NumQuestao'];
			echo "
			<form role=\"form\">
				<h4><strong>".($QuestaoAtual + 1)." - </strong>".$linha->Questao."</h4>
				<span>
					<div class=\"radio\">
						<label><input type=\"radio\" name=\"alternativa\" value=\"A\" checked><strong>A- </strong>".$linha->A."</label>
					</div>
				</span>
					<span>
					<div class=\"radio\">
						<label><input type=\"radio\" name=\"alternativa\" value=\"B\"><strong>B- </strong>".$linha->B."</label>
					</div>
				</span>
				<span>
					<div class=\"radio\">
						<label><input type=\"radio\" name=\"alternativa\" value=\"C\"><strong>C- </strong>".$linha->C."</label>
					</div>
				</span>
				<span>
					<div class=\"radio\">
						<label><input type=\"radio\" name=\"alternativa\" value=\"D\"><strong>D- </strong>".$linha->D."</label>
					</div>
				</span>
					<span>
					<div class=\"radio\">
						<label><input type=\"radio\" name=\"alternativa\" value=\"E\"><strong>E- </strong>".$linha->E."</label>
					</div>
				</span>
				<input type=\"hidden\" id=\"resp\" value=\"$linha->respostaprova\" name=\"$linha->idprova\">
			</form>
			";

			$_SESSION['NumQuestao'] += 1;
		}
	}
	catch(Exception $erro)
	{
		exit();
	}
?>