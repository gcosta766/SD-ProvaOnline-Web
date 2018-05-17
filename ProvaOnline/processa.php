<?php	
session_start();
include("conexao.php");
include("logado.php");
if(isset($_GET['id'])){
	$pro_id = $_GET['id'];
}

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
			$SQL = "SELECT questao.ques_id FROM questao INNER JOIN prova_has_questao ON questao.ques_id = prova_has_questao.ques_id WHERE prova_has_questao.pro_id = $pro_id ";
			$resultado = $conexao->query($SQL);
			$_SESSION['QtdQuestoes'] = $resultado->num_rows;
			while($linha = $resultado->fetch_object())
			{
				array_push($_SESSION['Questoes'], $linha->ques_id);
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
			$SQL = "SELECT ques_res FROM questao WHERE ques_id = ".$_POST['NumQ'];
			$resultado = $conexao->query($SQL);
			$linha = $resultado->fetch_object();
			//echo "Respota certa: $linha->Resposta";
			if($linha->ques_res == $AlternResp)
			{
				$_SESSION['Corretas'] += 1;
			}
			else
			{
				$_SESSION['Erradas'] += 1;
			}
		}	

		//Número de questões, fim do quiz
		if($_SESSION['NumQuestao'] >= $_SESSION['QtdQuestoes'])
		{
			date_default_timezone_set('America/Sao_Paulo');
			$date = date('Y-m-d H:i');

			//informaçoes pegas no login
			$dadospes_nome = $_SESSION['dadospes_nome']; 
			$alu_num_mat =	$_SESSION['alu_num_mat']; 
			
			$alu_id =	$_SESSION['alu_id'];
			$nota = $_SESSION['Corretas'];
			$pro_id =$_SESSION['pro_id'];
			
			$SQL = "INSERT INTO prova_realizada (`alunos_alu_id`, `prova_pro_id`, `prea_dat_hor`, `prea_nota`) VALUES ($alu_id, $pro_id, '$date', $nota)";
			$resultado = $conexao->query($SQL);
			
			if($resultado){
				
				echo"
				<h1> Fim da prova </h1>
				<p><strong>Data e Hora :</strong> ".$date."</p>
				<p><strong>RM do aluno:</strong> ".$alu_num_mat."</p>
				<p><strong>Nome do aluno:</strong> ".$dadospes_nome."</p>
				<p><strong>Quantidade de perguntas:</strong> ".$_SESSION['QtdQuestoes']."</p>
				<p><strong>Nota:</strong> ".$_SESSION['Corretas']."</p>
				<input type=\"hidden\" value=\"last\" id=\"last\">
				";
				//session_destroy();
				unset($_SESSION['Corretas']);
				unset($_SESSION['pro_id']);
				unset($_SESSION['Erradas']);
				unset($_SESSION['Questoes']);
				unset($_SESSION['Status']);
				unset($_SESSION['NumQuestao']);	

			}
			else{
				echo $resultado->error;
			}
		}
		else
		{
			$_SESSION['Status'] = 'online';
			//Montar próxima questão:
			$SQL = "SELECT * FROM questao WHERE ques_id = '".$_SESSION['Questoes'][($_SESSION['NumQuestao'])]."'";
			
			$resultado = $conexao->query($SQL);
			$linha = $resultado->fetch_object();
			$QuestaoAtual = $_SESSION['NumQuestao'];
			echo utf8_encode("
			<form role=\"form\">
				<h4><strong>".($QuestaoAtual + 1)." - </strong>".$linha->ques_enun."</h4>
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
				<input type=\"hidden\" id=\"resp\" value=\"$linha->ques_res\" name=\"$linha->ques_id\">
			</form>
			");

			$_SESSION['NumQuestao'] += 1;
		}
	}
	catch(Exception $erro)
	{
		exit();
	}
?>