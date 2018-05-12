<?php
  include("head.php");
  include("logado.php");
?>
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey w3-content" style="max-width:1600px">

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container">
    <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
      <i class="fa fa-remove"></i>
    </a>
    <h4><b><?php echo($dadospes_nome);?></b></h4>
    <h6><b><?php echo($email);?></b></ho>
  </div>
  <div class="w3-bar-block">
    <a href="#portfolio" onclick="w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>PROVAS</a> 
    <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw w3-margin-right"></i>PERFIL</a> 
    <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-area-chart fa-fw w3-margin-right"></i>RELATORIOS</a>
    <a href="logout.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="	fa fa-ban fa-fw w3-margin-right"></i>LOGOUT</a>
  </div>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

  <!-- Header -->
  <header id="prova">
    <a href="#"><img src="/w3images/avatar_g2.jpg" style="width:65px;" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity"></a>
    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <div class="w3-container">
    <h1><b>PROVAS</b></h1>
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
       
        echo"
        <a href='quiz.php?id=$linha->pro_id'>
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
			<h1><b>Perfil</b></h1>
			<div class="w3-section w3-bottombar w3-padding-16">
			</div>
		</div>
		<form class="w3-container  w3-padding-16">
			<p>
			<label>First Name</label>
			<input class="w3-input" type="text"></p>
			<p>
			<label>Last Name</label>
			<input class="w3-input" type="text"></p>
			<p>
			<label>Email</label>
			<input class="w3-input" type="text"></p>
			<button class="w3-btn w3-block w3-teal">Salvar alteração</button>
		</form>
	</div>
  
  <!-- relatorios Section -->
  <div class="w3-container w3-padding-large">
		<div class="w3-container">
			<h1><b>Relatorio</b></h1>
			<div class="w3-section w3-bottombar w3-padding-16">
			</div>
		</div>
		<table class="w3-table w3-bordered  w3-border w3-white test w3-hoverable">
			<tr class="w3-teal">
				<th>First Name</th>
				<th>Last Name</th>
				<th>Points</th>
			</tr>
			<tbody>
			<tr>
				<td>Jill</td>
				<td>Smith</td>
				<td>50</td>
			</tr>
			<tr>
				<td>Eve</td>
				<td>Jackson</td>
				<td>94</td>
			</tr>
			<tr>
				<td>Adam</td>
				<td>Johnson</td>
				<td>67</td>
			</tr>
			<tr>
				<td>Bo</td>
				<td>Nilsson</td>
				<td>50</td>
			</tr>
			<tr>
				<td>Mike</td>
				<td>Ross</td>
				<td>35</td>
			</tr>
			</tbody>
		</table>
		<hr>
  </div>

  <!-- Footer -->
  <footer class="w3-container w3-padding-32 w3-dark-grey">
  <div class="w3-row-padding">
    <div class="w3-third">
      <h3>FOOTER</h3>
      <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
      <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
    </div>
  
    <div class="w3-third">
      <h3>BLOG POSTS</h3>
      <ul class="w3-ul w3-hoverable">
        <li class="w3-padding-16">
          <img src="/w3images/workshop.jpg" class="w3-left w3-margin-right" style="width:50px">
          <span class="w3-large">Lorem</span><br>
          <span>Sed mattis nunc</span>
        </li>
        <li class="w3-padding-16">
          <img src="/w3images/gondol.jpg" class="w3-left w3-margin-right" style="width:50px">
          <span class="w3-large">Ipsum</span><br>
          <span>Praes tinci sed</span>
        </li> 
      </ul>
    </div>

    <div class="w3-third">
      <h3>POPULAR TAGS</h3>
      <p>
        <span class="w3-tag w3-black w3-margin-bottom">Travel</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">New York</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">London</span>
        <span class="w3-tag w3-grey w3-small w3-margin-bottom">IKEA</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">NORWAY</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">DIY</span>
        <span class="w3-tag w3-grey w3-small w3-margin-bottom">Ideas</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Baby</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Family</span>
        <span class="w3-tag w3-grey w3-small w3-margin-bottom">News</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Clothing</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Shopping</span>
        <span class="w3-tag w3-grey w3-small w3-margin-bottom">Sports</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Games</span>
      </p>
    </div>

  </div>
  </footer>
  
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