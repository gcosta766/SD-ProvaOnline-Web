<?php  
	include("logado.php");
	$login1 = $_SESSION['email'];
	if(isset($_POST['Login']))
	{
		include 'conexao.php';
		
		
		$login2 = $_POST['Login'];
		$senha1 = $_POST['Senha_Ant'];
		$senha2 = $_POST['Senha_Nova'];
		$senha3 = $_POST['Senha_Rep'];
		
		if($login1 == $login2)
	{
		$sql = "select usu_senha from usuario where usu_email='$login1'";
		$resultado = mysqli_query($conexao, $sql);
		$linha = mysqli_fetch_object($resultado);
		@$senha_ant = $linha->Senha;

		if($senha1 == $senha_ant)
		{
			// if($senha2 == $senha3)
			// {
				$sql = "update usuario set usu_senha='$senha2' where usu_email= '$login1'";
				
				
				$resultado = mysqli_query($conexao, $sql);
				if ($resultado == true)
				{
					echo"<script>alert('Senha redefinida com sucesso!');</script>";
				}
				else
				{
					echo"<script>alert('Erro: Senha não foi redefinida. Tente novamente.');</script>";
				}
			// }
			// else
			// 	{
			// 		echo"<script>alert('Erro: Senhas não coincidem.');</script>";
			// 	}
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

<?php
	include("head.php");
  include("menualu.php");

	
?>
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

  <!-- Header -->
  <header id="prova">
    <a href="#"><img src="/w3images/avatar_g2.jpg" style="width:65px;" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity"></a>
    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <div class="w3-container">
    <h1 class=" w3-text-teal"><b>Redefinição de Senha</b></h1>
    <div class="w3-section w3-bottombar w3-padding-16">
    </div>
    </div>
	</header>
	<div class="w3-row-padding">
		<div class="w3-card-4 w3-white table">
			<form action="rsenha.php" method="post" enctype="multipart/form-data" id="form2">
				
				<label>	Confirme o seu login*:</label>
				<input type="text" required class="w3-input" name='Login' size="50">
				<br>
				<label>Informe a senha anterior*:</label>
				<input type="password" class="w3-input" name='Senha_Ant' size="50">
				<br>
				<label>Informe a nova senha*:</label>
				<input type="password" class="w3-input" name='Senha_Nova' size="50">
				<br>
				<label>Confirme a nova senha*:</label>
				<input type="password" class="w3-input" name='Senha_Rep' size="50">
				<br><br>

					<p class="help-block">* Campos obrigatórios</p>

				<br>
				<br>
				<div class="botao">

				<input class="w3-btn w3-block w3-teal" type="submit" value="Enviar">
				</div>
			</form>
		</div>
	</div>
</div>
<?php  
 include("logadof.php");
?>
