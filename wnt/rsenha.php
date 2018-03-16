<?php  
	include("logado.php");
	$login1 = $_SESSION['Login'];
	if(isset($_POST['Login']))
	{
		include 'conexao.php';
		
		
		$login2 = $_POST['Login'];
		$senha1 = md5($_POST['Senha_Ant']);
		$senha2 = md5($_POST['Senha_Nova']);
		$senha3 = md5($_POST['Senha_Rep']);
		
		if($login1 == $login2)
	{
		$sql = "select Senha from usuario where Login='$login1'";
		$resultado = mysqli_query($conexao, $sql);
		$linha = mysqli_fetch_object($resultado);
		$senha_ant = $linha->Senha;

		if($senha1 == $senha_ant)
		{
			if($senha2 == $senha3)
			{
				$sql = "update usuario set Senha='$senha2' where Login = '$login1'";
				
				
				$resultado = mysqli_query($conexao, $sql);
					if ($resultado == true)
				{
					echo"<script>alert('Senha redefinida com sucesso!');</script>";
				}
				else
				{
					echo"<script>alert('Erro: Senha não foi redefinida. Tente novamente.');</script>";
				}
			}
			else
				{
					echo"<script>alert('Erro: Senhas não coincidem.');</script>";
				}
		}
		else
		{
			echo"<script>alert('Senhas não coincidem.');</script>";
		}
	}
		else	
		{
			echo"<script>alert('Login incorreto.');</script>";
		}
				
		
		
}//fecha o if



?>
<html lang="pt">
<head>
<title>World News Today</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <!--topo 1 thai-->
	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<script src="./js/jquery-1.11.3.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css.css">

	<style>
	body{
		background-color:#CBE6B2;
	}
	
	</style>



</head>
	<body>	
	<?php
 include 'menualuno.php';

	
?>
<form action="rsenha.php" method="post" enctype="multipart/form-data" id="form2">

	<br><center><h3>Redefinição de Senha</h3></center><br>
	<br>
	Confirme o seu login*:<br>
	<input type="text" required class="form-control" name='Login' size="50">
	<br><br>
	Informe a senha anterior*:<br>
	<input type="password" class="form-control" name='Senha_Ant' size="50">
	<br><br>
	Informe a nova senha*:<br>
	<input type="password" class="form-control" name='Senha_Nova' size="50">
	<br><br>
	Confirme a nova senha*:<br>
	<input type="password" class="form-control" name='Senha_Rep' size="50">
	<br><br>
	
    <p class="help-block">* Campos obrigatórios</p>
	
 <br>
 <br>
 <div class="botao">
 
<input class="btn btn-default" type="submit" value="Enviar">
</div>
	</form>
	
<?php  
 include("logadof.php");
include 'rodape.html';
?>