

<?php
  $yhendus=new mysqli("localhost", "silvarliiv", "GqzpIKkK", "silvarliiv");
  if(isSet($_REQUEST["uuenda"])){
     $kask=$yhendus->prepare(
	   "INSERT INTO klubid ( klubinimi) VALUES(?)");
     echo $yhendus->error;
	 $kask->bind_param("s", $_REQUEST["uuenda"]);
	 $kask->execute();
    echo $yhendus->error;
echo "lisatud";
  }
?>
<!doctype html>
<html>
  <head>
    <title>KLUBID</title>
<script language="javascript">
			$(document).ready(
				function (){
					$("#pikame").PikaChoose();
				});
		</script>

    <div class="wrapper"> 
    <link href="style.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
  <header> 
	<nav>
    <ul>
    <li><a href="tootajalogin.php" class="current">Avaleht</a></li>
     <?php
if(isset($_REQUEST['uuenda'])) {
  $kask=$yhendus->prepare("SELECT id, klubinimi FROM klubid");
    $kask->bind_result($id, $klubinimi);
    $kask->execute();
    while($kask->fetch()){
      echo "<p> $klubinimi ";

    }

    $kask->close();
}
    
    ?>
    </ul>
    </nav>
    <div class="wrapper">
  <p><strong>Lisa KLUBI.</strong></p>
	</header>
	
    <table>   
			    <form action='?'>
				   <input type='text' name='uuenda' />
				   <input type='submit' value='Lisa ' />
				</form>		
	</table>
	</div>
  </body>
</html>
<?php
  $yhendus->close();
?>