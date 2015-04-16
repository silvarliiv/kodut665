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
  if(isSet($_REQUEST["tegemata_id"])){
     $kask=$yhendus->prepare("UPDATE tulemused SET valmis=1 WHERE id=?");
	 $kask->bind_param("i", $_REQUEST["tegemata_id"]);
	 $kask->execute();
	 }
	 if(isSet($_REQUEST["uue_kommentaari_id"])){
     $kask=$yhendus->prepare(
	   "UPDATE tulemused SET kommentaar=?  WHERE id=?");
	 $kommentaarilisa="\n".$_REQUEST["uus_kommentaar"].date(" m/d/Y  H:i")."\n";
	 $kask->bind_param("si", $kommentaarilisa, $_REQUEST["uue_kommentaari_id"]);
	 $kask->execute();
	 }

?>
<!doctype html>
<html>
  <head>
    <title>Tulemused:</title>
	<script language="javascript">
			$(document).ready(
				function (){
					$("#pikame").PikaChoose();
				});
		</script>
  </head>
  <body>
	<div class="kirjeldused">
      Tere, <?php echo $_SESSION["roll"]." ".$_SESSION["kasutajanimi"]; ?>
       <a style="color:#3399ff" href="tootajalogin.php?lahku=jah">lahku</a>
    <h1>tulemused:</h1>
    <table>
	  <?php
	     $kask=$yhendus->prepare("SELECT v6istleja_tulemus, v6istleja_id FROM tulemused ");
		 $kask->bind_result($v6istleja_tulemus, $v6istleja_id );
		 $kask->execute();
		 while($kask->fetch()){
				echo "$v6istleja_tulemus, $v6istleja_id";
			}
		 $kask->close();
	  ?>
	  <h1>Treeneri Nimi </h1>
	<?php
	?>
	 <?php
	     $kask=$yhendus->prepare("SELECT id, treeneri_nimi FROM Treenerid ");
		 $kask->bind_result($id, $treeneri_nimi );
		 $kask->execute();
		 while($kask->fetch()){
				echo "<option value=$id>$treeneri_nimi</option>";
			}
		 $kask->close();
	  ?>
	  <h1>Klubid</h1>
	<?php
	?>
	 <?php
	     $kask=$yhendus->prepare("SELECT  klubinimi FROM klubid ");
		 $kask->bind_result( $klubinimi );
		 $kask->execute();
		 while($kask->fetch()){
				echo " $klubinimi";
			}
		 $kask->close();
	  ?>
	  <h1>Riigid</h1>
	<?php
	?>
	 <?php
	     $kask=$yhendus->prepare("SELECT  riiginimi FROM riigid ");
		 $kask->bind_result( $riiginimi );
		 $kask->execute();
		 while($kask->fetch()){
				echo " $riiginimi ";
			}
		 $kask->close();
	  ?>
	  <h1>Kohtunikud</h1>
	<?php
	?>
	 <?php
	     $kask=$yhendus->prepare("SELECT  kohtuniku_nimi FROM kohtunikud ");
		 $kask->bind_result( $kohtuniku_nimi );
		 $kask->execute();
		 while($kask->fetch()){
				echo "  $kohtuniku_nimi ";
			}
		 $kask->close();
	  ?>
	  <h1>v6istlejad</h1>
	<?php
	?>
	 <?php
	     $kask=$yhendus->prepare("SELECT v6istleja FROM v6istlejad ");
		 $kask->bind_result($v6istleja);
		 $kask->execute();
		 while($kask->fetch()){
				echo "$v6istleja ";
			}
		 $kask->close();
	  ?>
	<?php
	?>

	</div>
  </body>
</html>
<?php
  $yhendus->close();
?>