<?php
  $yhendus=new mysqli("localhost", "silvarliiv", "GqzpIKkK", "silvarliiv");
  session_start();
  if(isSet($_REQUEST["kasutajanimi"])){
     $kask=$yhendus->prepare(
      "SELECT roll FROM kasutajad WHERE knimi=? AND paroolir2si=PASSWORD(?)");
     $knimiparool=$_REQUEST["kasutajanimi"]."_".$_REQUEST["parool"];
//     $kask->bind_param("ss", $_REQUEST["kasutajanimi"], $knimiparool);
     $kask->bind_param("ss", $_REQUEST["kasutajanimi"], $_REQUEST["parool"]);
     $kask->bind_result($roll);
     $kask->execute();
     if($kask->fetch()){
         $_SESSION["kasutajanimi"]=$_REQUEST["kasutajanimi"];
         $_SESSION["roll"]=$roll;
         $kask->close();
     }
  }
  if(isSet($_REQUEST["lahku"])){
     unset($_SESSION["kasutajanimi"]);
     unset($_SESSION["roll"]);
  }
  if(isSet($_SESSION["roll"]) and $_SESSION["roll"]=="treener"){
	Header("location: tehnikuleht.php");
  }
   if(isSet($_SESSION["roll"]) and $_SESSION["roll"]=="treener"){
	Header("location: tehnikuleht.php");
  }
?>
<!doctype html>
<html>
  <head>
     <title>Parandus</title>
<script language="javascript">
			$(document).ready(
				function (){
					$("#pikame").PikaChoose();
				});
		</script>
  </head>
  <body>
    <?php if(isSet($_SESSION["kasutajanimi"])): ?>
      Tere, <?php echo $_SESSION["roll"]." ".$_SESSION["kasutajanimi"]; ?>
      <a href="?lahku=jah">lahku</a>
      <ul>
        
        <?php if($_SESSION["roll"]=="haldur"): ?>
          <li><a href="kirjeldused.php">Haldamine</a></li>        
        <?php endif ?>
      </ul>
	   <ul>  
        <?php if($_SESSION["roll"]=="tehnik"): ?>
          <li><a href="tehnikuleht.php">Parandust vajavad tooted</a></li>        
        <?php endif ?>
      </ul>
    <?php else: ?>
	
	<header>
	<nav>
    <ul>
    
	<li><a href="tootajalogin.php" class="current">Logimine</a></li>
    </ul>
    </nav>
	</header>

   <div class="login">
   <form action="?" method="post">
      <dl>
        <dt>Kasutajanimi:</dt>
        <dd><input type="text" name="kasutajanimi" /></dd>
        <dt>Parool:</dt>
        <dd><input type="password" name="parool" /></dd>
        <dd><input type="submit" value="Sisesta" href="tehnikuleht.php"/></dd>
      </dl>
     </form>
   </div>
 
    <?php endif ?>
  
  </body>
</html>
<?php
  $yhendus->close();
?>
