<?php
session_start();

  
  if(isset($_POST['Login']))
  {
    $login = $_POST['Login'];
	$senha = md5($_POST['Senha']);
	
    include("conexao.php");
	
	$SQL = "select Nome, Senha, Situacao  from  usuario
			where Login='$login'";
	
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
	   $Nome_user = $linha->Nome;
	   $Senha_user = $linha->Senha;
	   $acesso = $linha->Situacao;
	   
	   if($senha == $Senha_user)
	   {
	     $_SESSION['Logado'] = 'S';
		 $_SESSION['Nome'] = $Nome_user;
		 $_SESSION['Login'] = $login;
		 
			if($acesso == 'Ativo')
			{
				//redirecionar o usuario para a pagina restrita 

				header("Location:wntaluno.php");
			}
			else
			{	
				echo"<script  charset='utf-8'>alert ('ATENÇÃO: Você ainda não tem permissão para acessar esta página. Cadastra-se ou aguarde para que seu cadastro seja autorizado pelo Teacher Ewerton!');
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
		include "topo1.html";
		include "menu.php";
	?>


	
	<style>

		#moldura
		{
			border-radius:10px;
			width:400px;
			min-height:250px;
			margin-left: 35%;
			background-color:#ffffff;
			border: 1px solid #d1d1d1;
			margin-top: 50px;
			padding: 25px;
			float: left;
		
		}
		
		body{
			
			background-color: #922A41;
			color: #f2e2cc;
		}
		
		#esquerda, #direita
	  {
		 padding:10px;
		 width:50%;
		 min-width:600px;
		 min-height:600px;
		 height:auto;
		 float:left;
		 
		
		 
	  }
	  
	  #formulario
	  {
		
		margin-left: 40px;		  
			  
	  }
	  
	  #direita
	  {
		border-left:3px solid  #f2e2cc;
		width:50%;
		min-width:400px; 


	  }

	</style>
	
	</head>
	
	<body>
	<div id="topo">
	</div>
	<div id="esquerda">
	
	<form action="login.php" method="post" role="form" >
	<div class="col-md-10" id="formulario">
		<center><h1>Identificação do Aluno</h1></center>
		<center><h3>Faça seu login se você já é cadastrado</h3></center>
	
		
		<div class="form-group">
		
    <label for="login">Login:</label>
    <input type="text" name="Login" class="form-control" id="email">
  </div>


  <div class="form-group">
    <label for="pwd">Senha:</label>
	
    <input type="password" name="Senha" class="form-control" id="pwd">
  </div>
  
  <button type="submit" class="btn btn-default">Enviar</button>
  </div>
		</form>
		
	</div> 
	
	<div id="direita">
	
	<form action="cad_aluno.php" method="post" role="form" >
	<div class="col-md-10" id="formulario">
		<center><h1>Cadastro de Aluno</h1></center>
		<center><h3></h3></center>
	
		
		<div class="form-group">		
			<label for="nome">Nome:</label>
			<input type="text" name="Nome" class="form-control" id="nome" required>
		</div>
		
		<div class="form-group">		
			<label for="email">E-mail:</label>
			<input type="text" name="Email" class="form-control" id="email" required>
		</div>
		
		<div class="form-group">		
			<label for="login">Login:</label>
			<input type="text" name="Login" class="form-control" id="login" required>
		</div>


		<div class="form-group">
			<label for="pwd">Senha:</label>	
			<input type="password" name="Senha" class="form-control" id="pwd" required>
		</div>
		
		<div class="form-group">		
			<label for="escola">Escola:</label>
				<select name="Escola" class="form-control">
				<?php
					include 'conexao.php';
					$sql = "select * from escola where Ativo = 'Ativo'";
					$resultado = mysqli_query($conexao, $sql);
					while ($linha = mysqli_fetch_object($resultado))
					{
						echo "<option value='$linha->Id_escola'>";
						echo $linha->Escola;
						echo "</option>";
					}
				?>
				 </select>
		</div>
  <button type="submit" class="btn btn-default">Enviar</button>
  </div>
		</form>
		
	</div> 
	
	</body>
</html>
<?php
}
?>