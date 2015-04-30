

<?php
  $yhendus=new mysqli("localhost", "silvarliiv", "GqzpIKkK", "silvarliiv");
  if(isSet($_REQUEST["uuenda"])){
     $kask=$yhendus->prepare(
	   "INSERT INTO tulemused ( v6istleja_tulemus, v6istleja_id) VALUES(?,?)");
     echo $yhendus->error;
	 $kask->bind_param("ss", $_REQUEST["uuenda"],$_REQUEST["v6istleja"]);
	 $kask->execute();
    echo $yhendus->error;
echo "lisatud";
  }
?>
<!doctype html>
<html>
  <head>
    <title>Tulemused</title>
<script language="javascript">
			$(document).ready(
				function (){
					$("#pikame").PikaChoose();
				});
		</script>
    <link href="style.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
  <header> 
	<nav>
    <ul>
    <li><a href="tootajalogin.php" class="current">Avaleht</a></li>
     <?php
if(isset($_REQUEST['uuenda'])) {
  $kask=$yhendus->prepare("SELECT v6istleja_tulemus, v6istleja_id, id FROM tulemused");
    $kask->bind_result($v6istleja_tulemus, $v6istleja_id, $id);
    $kask->execute();
    while($kask->fetch()){
      echo "<p> $v6istleja_tulemus, $v6istleja_id ";

    }

    $kask->close();
}
    
    ?>
    </ul>
    </nav>
	</header>

    <form action='?'>
   <select name="v6istleja">
  <?php
     $kask=$yhendus->prepare("SELECT v6istleja FROM v6istlejad");
     $kask->bind_result($v6istleja);
     $kask->execute();
     while($kask->fetch()){
       echo "<option >$v6istleja</option>";
     }
  ?>
</select>
	<div class="vealisamine">
	<p><strong>Lisa tulemused.</strong></p>
     
			    
				   <input type='text' name='uuenda' />



				   <input type='submit' value=' meetrit ' />
				</form>		
	
	</div>
  </body>
</html>
<?php
  $yhendus->close();
?>