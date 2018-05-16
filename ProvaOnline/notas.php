<?php
  include("head.php");
  include("logado.php");
  include("menuprof.php");
?>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main " style="margin-left:300px;">

  <!-- Header -->
  <header id="prova">
    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <div class="w3-container">
    <h1 class=" w3-text-teal"><b>Notas</b></h1>
    <div class="w3-section w3-bottombar w3-padding-16">
    </div>
    </div>
  </header>
  <div class="table">
     <table class="w3-table w3-card-2 w3-bordered  w3-white  w3-hoverable"> 
        <tr class="w3-teal"> 
          <th>Aluno</th> 
          <th>Nota</th> 
          <th>Data realiada</th> 
        </tr> 
        <?php
          //session_start();
          $pro_id = $_SESSION['pro_id'];
    
          include('conexao.php');
                  
                      
          $SQL = "SELECT * FROM `prova_realizada` inner join alunos on prova_realizada.alunos_alu_id = alunos.alu_id INNER JOIN dadospes on alunos.dadospes_id = dadospes.dadospes_id WHERE prova_realizada.prova_pro_id = $pro_id";
          
          $resultado = $conexao->query($SQL);
          
          while($linha = $resultado->fetch_object())
          { 
          
            echo"
                  <tbody> 
                    <tr> 
                      <td>$linha->dadospes_nome</td> 
                      <td>$linha->prea_nota</td> 
                      <td>$linha->prea_dat_hor</td> 
                    </tr> 
                  </tbody> 
                </table> 
              ";
          }
        ?>
  </div>
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