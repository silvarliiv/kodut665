<?php
SESSION_START();
  if(!isSet($_SESSION["kasutajanimi"])){
    header("Location: tootajalogin.php");
    exit();
  }
  $yhendus=new mysqli("localhost", "silvarliiv", "GqzpIKkK", "silvarliiv");
  if(isSet($_REQUEST["tehtud_id"])){
     $kask=$yhendus->prepare("UPDATE tulemused SET valmis=0 WHERE id=?");
	 $kask->bind_param("i", $_REQUEST["tehtud_id"]);
	 $kask->execute();
  }
 

?>
<!doctype html>
<html>
  <head>
    <title>E&S võistlused:</title>
	<script language="javascript">
			
		</script>
    <style >

      
    </style>
    <div class="wrapper"> 
    <link href="style.css" rel="stylesheet" type="text/css" />
  </head>

  <body>
  	

      Tere, <?php echo $_SESSION["roll"]." ".$_SESSION["kasutajanimi"]; ?>
       <a style="color:#3399ff" href="tootajalogin.php?lahku=jah">lahku</a>
       
   
    
	  <p>
	
	<?php
	?> 

<div class="wrapper"> 

  <h1>Kettaheite esimene etapp </h1> 

  
  <a href="v6istlejad.php" class="current"><h2>Täida võistleja andmed</h2></a>
  <p>   </p>
  <a href="tulemused.php" class="current"><h3>tulemuste lisamine</h3></a></li>
  <td><a href="riigid.php" class="current"><h3>Riikide lisamine</h3></a></td>
  <td><a href="klubid.php" class="current"><h3>Klubide lisamine</h3></a></td>
  <td><a href="treenerid.php" class="current"><h3>Treenerite lisamine</h3></a></td>
  <td><a href="kohtunikud.php" class="current"><h3>kohtunike lisamine</h3></a></td>



	<div class="kirjeldused">
	</div>
  </body>
</html>
<?php
  $yhendus->close();
?>