<?php
  include("head.php");
  include("logado.php");
  include("menualu.php")
?>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

  <!-- Header -->
  <header id="prova">
    <a href="#"><img src="/w3images/avatar_g2.jpg" style="width:65px;" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity"></a>
    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <div class="w3-container">
    <h1 class=" w3-text-teal"><b>PROVAS</b></h1>
    <div class="w3-section w3-bottombar w3-padding-16">
    </div>
    </div>
  </header>
  
  <!-- First  Grid-->
  <div class="w3-row-padding">
    <?php
      include('conexao.php');
              
                  
      $SQL = "SELECT prova.pro_id, prova.pro_data, materia.mat_nome FROM prova INNER JOIN materia ON prova.mat_id = materia.mat_id WHERE prova.mat_id IN (SELECT turma_has_materia.mat_id FROM turma_has_materia WHERE tur_id = (SELECT alunos.turma_tur_id FROM alunos INNER JOIN dadospes ON alunos.dadospes_id = dadospes.dadospes_id WHERE dadospes.usu_id = $usu_id))";
      
      $resultado = $conexao->query($SQL);
       
      while($linha = $resultado->fetch_object())
			{ 
        $data = $linha->pro_data; 
        $arr_data = explode("-", $data);
        $_SESSION['pro_id'] = $linha->pro_id;
        echo"
            <a href='provaRealizada.php?id=$linha->pro_id'>
              <div class='w3-third w3-container prova-margin'>
                <div class='w3-container w3-white'>
                  <p><b>$linha->mat_nome</b></p>
                  <p>Data: $arr_data[2]/$arr_data[1]/$arr_data[0]</p>
                </div>
              </div>
            </a>
           ";
      }
    ?>

	</div>
  <!-- perfil Section -->
	<div class="w3-container w3-white" style="padding:50px 13px" id="perfil">
		<div class="w3-container">
			<h1 class=" w3-text-teal"><b>Dados Pessoais</b></h1>
			<div class="w3-section w3-bottombar w3-padding-16">
			</div>
		</div>
    <div class=" center" style="width:95%">
      <header class="w3-container w3-light-grey">
        <h3>Nome: <?php echo($dadospes_nome);?></h3>
      </header>
      <div class="w3-container">
        <p><b>CPF:</b> <?php echo($_SESSION['dadospes_cpf']);?></p>
        <hr>
        <p><b>RM:</b> <?php echo($_SESSION['alu_num_mat']);?></p>
        <hr>
        <p><b>Escola:</b> <?php echo($_SESSION['esc_nome']);?></p>
        <hr>
        <p><b>Turma:</b> <?php echo($_SESSION['tur_nom']);?></p>
        <hr>
      </div>
    </div>
	</div>

  
  <div class="w3-black w3-center w3-padding-24">Powered by Leticia Gabriel  Heloa </div>

<!-- End page content -->
</div>

<script>
// Script to open and close sidebar
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}
</script>

</body>
</html>

<?php
  include("logadof.php");
?>