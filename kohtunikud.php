

<?php
  $yhendus=new mysqli("localhost", "silvarliiv", "GqzpIKkK", "silvarliiv");
  if(isSet($_REQUEST["uuenda"])){
     $kask=$yhendus->prepare(
	   "INSERT INTO kohtunikud ( kohtuniku_nimi) VALUES(?)");
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
    <title>kohtunikud</title>
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
  $kask=$yhendus->prepare("SELECT id, kohtuniku_nimi FROM kohtunikud");
    $kask->bind_result($id, $kohtuniku_nimi);
    $kask->execute();
    while($kask->fetch()){
      echo "<p> $kohtuniku_nimi ";

    }

    $kask->close();
}
    
    ?>
    </ul>
    </nav>
	</header>
	<div class="vealisamine">
	<p><strong>Lisa kohtunikud.</strong></p>
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