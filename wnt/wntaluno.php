<?php  
 include("logado.php");

?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>World News Today</title>
	
   

	<link rel="stylesheet" type="text/css" href="../jquery.fullPage.css" />
	<link rel="stylesheet" type="text/css" href="examples.css" />


	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
	
	<script type="text/javascript" src="../vendors/jquery.slimscroll.min.js"></script>

	<script type="text/javascript" src="../jquery.fullPage.js"></script>
	<script type="text/javascript" src="examples.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#fullpage').fullpage({
				scrollOverflow: true,
				slidesNavigation: true,
				sectionsColor: ['#1bbc9b', '#EAE1C0', '#CBE6B2'],
				anchors: ['firstPage', 'secondPage', '3rdPage'],
				menu: '#menu',
				
				//equivalent to jQuery `easeOutBack` extracted from http://matthewlein.com/ceaser/
				easingcss3: 'cubic-bezier(0.175, 0.885, 0.320, 1.275)',
                afterLoad: function(anchorLink, index){

					//section 1
					if(index == 1){
										
						$('#section0').find('h1').fadeIn(1800, function(){
							$('#section0').find('p').fadeIn(1500);
							$('#section1').find('p').fadeIn(1000);
							$('#section2').find('p').fadeIn(1000);
						});
					}
				}
			});
		
			
			
		});
		
		

		
	</script>
	<style>
	
		
	    #section0{
		
		background-image: url(imgs/logo3.jpg) ;
		background-size:100% 100%;
		padding:8% 0 0 0;
	     }
		#section0 h1,p{
		  color:rgba(6, 9, 9,0.8);
		  display:none;
		  }
		 
		#section1 h1 { 
		font-size: 1000%; 

		 padding:2% 0 0 0;
	     }
	     
		 
		 
	
		 .quiz
		 {
			float:right;
			float:left;
			margin-left:3%;
			margin-right:;
			width:300px;
			height:168px;
			box-shadow:5px 8px 12px #333333;
			color: white;
			text-align: center;
			margin-top:5%;
			 
		 }
		
		 
		 
		 
		 

		 
	</style>

</head>
<body>
<?php

include("menualuno.php")

?>




<div id="fullpage">
	<div class="section " id="section0">
		<h1 >World News Today </h1>
		<p >Connecting you to the world </p>
		
	</div>
	<div class="section" id="section1">
		<a href="quiz.php">
		<div id="intro" class="intro">
		
		
			<h1>Quiz</h1>
			<p> play now</p>
	
			
		</div></a>
	</div>
	<div class="section" id="section2">
	    <a href="ex.php">
		<div id="intro" class="intro">
		
	
				<h1>Exercise </h1>
				     <p>practice now</p>
		
		</div></a>
   </div>
   
   
   
   </div>

</body>
</html>
<?php  
 include("logadof.php");

?>