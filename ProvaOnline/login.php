<?php
//head

include("head.php");

session_start();

  
  if(isset($_POST['Login']))
  {
    $login = $_POST['Login'];
		$senha = $_POST['Senha'];
	
    include("conexao.php");
	
		$SQL = "select usu_id, usu_email, usu_senha, usu_perfil, usu_ativo  from  usuario
				where usu_email='$login'";
		
		$resultado = mysqli_query($conexao, $SQL);
		
		if(mysqli_num_rows($resultado) == 0)
		{
			echo"<script>alert ('Login ou senha incorreto(a)!');
					window.location.href='login.php';</script>";
		} 
		else
		{
			/*Se chegou nesse ponto do codigo ,indica q o login esta correto, devemos verificar se a senha esta correta
			*/
			
			$linha=mysqli_fetch_object($resultado);
			$usu_id = $linha->usu_id;
			$usu_email = $linha->usu_email;
			$usu_senha = $linha->usu_senha;
			$usu_perfil = $linha->usu_perfil;
			$usu_ativo = $linha->usu_ativo;
			
			if($senha == $usu_senha)
			{
				$_SESSION['Logado'] = 'S';
				$_SESSION['email'] = $usu_email;
				$_SESSION['id'] = $usu_id;
				$_SESSION['perfil'] = $usu_perfil;

				


				if($usu_ativo == 'S' && $usu_perfil == 'alu')
				{
					// pegar dados de infetificação relevantes para outras paginas (Quiz, painel)
					//infomaçoes de dados pessoais 
					$usu_id = $_SESSION['id'];
					$SQL = "select * from dadospes WHERE usu_id ='$usu_id'";
					$resultado = mysqli_query($conexao, $SQL);
					$linha=mysqli_fetch_object($resultado);
					$_SESSION['dadospes_id'] = $linha->dadospes_id;
					$_SESSION['dadospes_nome'] = $linha->dadospes_nome;
					$_SESSION['dadospes_cpf'] = $linha->dadospes_cpf;
					$_SESSION['end_id'] = $linha->end_id;
					$_SESSION['esc_id'] = $linha->esc_id;
					//infomaçoes do aluno
					$dadospes_id =	$_SESSION['dadospes_id'];
					$SQL = "select * from alunos WHERE dadospes_id='$dadospes_id'";
					$resultado = mysqli_query($conexao, $SQL);
					$linha=mysqli_fetch_object($resultado);
					$_SESSION['alu_id'] = $linha->alu_id;
					$_SESSION['alu_num_mat'] = $linha->alu_num_mat;
					$_SESSION['turma_tur_id'] = $linha->turma_tur_id;
					//infomação da turma 
					$tur_id =	$_SESSION['turma_tur_id'];
					$SQL = "select * from turma WHERE tur_id='$tur_id'";
					$resultado = mysqli_query($conexao, $SQL);
					$linha=mysqli_fetch_object($resultado);
					$_SESSION['tur_nom'] = $linha->tur_nom;
					//infomaçoes da escola 
					$esc_id =	$_SESSION['esc_id'];
					$SQL = "select * from escola WHERE 	esc_id='$esc_id'";
					$resultado = mysqli_query($conexao, $SQL);
					$linha=mysqli_fetch_object($resultado);
					$_SESSION['esc_nome'] = $linha->esc_nome;
					$_SESSION['esc_status'] = $linha->esc_status;
					$_SESSION['end_id'] = $linha->end_id;
					//redirecionar o usuario para a pagina restrita 
					header("Location:painel.php");
				}
				elseif($usu_ativo == 'S' && $usu_perfil == 'pro'){
					// pegar dados de infetificação relevantes para outras paginas (Quiz, painel)
					//infomaçoes de dados pessoais 
					$usu_id = $_SESSION['id'];
					$SQL = "select * from dadospes WHERE usu_id ='$usu_id'";
					$resultado = mysqli_query($conexao, $SQL);
					$linha=mysqli_fetch_object($resultado);
					$_SESSION['dadospes_id'] = $linha->dadospes_id;
					$_SESSION['dadospes_nome'] = $linha->dadospes_nome;
					$_SESSION['dadospes_cpf'] = $linha->dadospes_cpf;
					$_SESSION['end_id'] = $linha->end_id;
					$_SESSION['esc_id'] = $linha->esc_id;
					//infomaçoes do professor
					$dadospes_id =	$_SESSION['dadospes_id'];
					$SQL = "select * from professor WHERE dadospes_id='$dadospes_id'";
					$resultado = mysqli_query($conexao, $SQL);
					$linha=mysqli_fetch_object($resultado);
					$_SESSION['prof_id'] = $linha->prof_id;
					$_SESSION['prof_re'] = $linha->prof_re;
					$_SESSION['turma_tur_id'] = $linha->turma_tur_id;
					//infomaçoes da escola 
					$esc_id =	$_SESSION['esc_id'];
					$SQL = "select * from escola WHERE 	esc_id='$esc_id'";
					$resultado = mysqli_query($conexao, $SQL);
					$linha=mysqli_fetch_object($resultado);
					$_SESSION['esc_nome'] = $linha->esc_nome;
					$_SESSION['esc_status'] = $linha->esc_status;
					$_SESSION['end_id'] = $linha->end_id;

					//redirecionar o usuario para a pagina restrita 
					header("Location:painelprof.php");
				}	
				elseif($usu_ativo == 'S' && $usu_perfil == 'adm'){
					// pegar dados de infetificação relevantes para outras paginas (Quiz, painel)
					//infomaçoes de dados pessoais 
					$usu_id = $_SESSION['id'];
					$SQL = "select * from dadospes WHERE usu_id ='$usu_id'";
					$resultado = mysqli_query($conexao, $SQL);
					$linha=mysqli_fetch_object($resultado);
					$_SESSION['dadospes_id'] = $linha->dadospes_id;
					$_SESSION['dadospes_nome'] = $linha->dadospes_nome;
					$_SESSION['dadospes_cpf'] = $linha->dadospes_cpf;
					$_SESSION['end_id'] = $linha->end_id;
					$_SESSION['esc_id'] = $linha->esc_id;
					//redirecionar o usuario para a pagina restrita 
					header("Location:painel.php");
				}
				else
				{	
					echo"<script  charset='utf-8'>alert ('ATENÇÃO: Você ainda não tem permissão para acessar esta página.');
					window.location.href='login.php';</script>";
				}
				}
			else
			{
				
				echo"<script>alert('Login ou senha incorreto(a)!');
					window.location.href='login.php';</script>";
			}	  
		}
	}	
	else
	{

	?>

	
	</head>
	
	<body class="login-fundo">
		<div class="w3-container w3-margin-top">		
			<div class="w3-card-4 login-center login-card w3-white">
				<div class="w3-container w3-teal">
					<h2>Login</h2>
				</div>

				<form class="w3-container" method="POST" action="login.php"  >
					<p>
					<label>E-mail</label></p>
					<input class="w3-input" type="text" name="Login" id="email">
					<p>    
					<label>Senha</label></p> 
					<input class="w3-input" type="password" name="Senha" id="pwd">
					<p><button type="submit" class="w3-btn w3-block w3-teal">Enviar</button></p>
				</form>
			</div>
		</div>
	</body>
</html>
<?php
}
?>