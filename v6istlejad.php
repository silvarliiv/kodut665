

<?php
  $yhendus=new mysqli("localhost", "silvarliiv", "GqzpIKkK", "silvarliiv");
  if(isSet($_REQUEST["uuenda"])){
     $kask=$yhendus->prepare(
	   "INSERT INTO v6istlejad (v6istleja, riigid_id , treenerid_id, kohtunikud_id, klubid_id) VALUES(?,?,?,?,?)");
     echo $yhendus->error;
	 $kask->bind_param("sssss", $_REQUEST["uuenda"], $_REQUEST["riigid_id"], $_REQUEST["treenerid_id"], $_REQUEST["kohtunikud_id"],
     $_REQUEST["klubid_id"] );
	 $kask->execute();
    echo $yhendus->error;
echo "lisatud";
  }
?>
<!doctype html>
<html>
  <head>
    <title>võistleja andmed</title>
<script >
			
		</script>
    <link href="style.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
  <header> 
	<nav>
    <ul>
    <li><a href="tootajalogin.php" class="current">Avaleht</a></li>
<h4> Nimi: Riik: kohtunik: treener: klubi: m: </h4>  

     <?php

  $kask=$yhendus->prepare("SELECT v6istleja , riigid_id ,klubid_id, treenerid_id, kohtunikud_id , riiginimi, treeneri_nimi , kohtuniku_nimi , klubinimi, v6istleja_id, v6istleja_tulemus
    FROM v6istlejad , riigid, Treenerid, kohtunikud , klubid , tulemused 
    WHERE v6istlejad.riigid_id=riigid.id AND v6istlejad.klubid_id=klubid.id AND v6istlejad.kohtunikud_id=kohtunikud.id AND v6istlejad.treenerid_id=Treenerid.id AND tulemused.v6istleja_id=v6istlejad.v6istleja");
    $kask->bind_result($v6istleja, $riigid_id, $klubid_id, $treenerid_id, $kohtunikud_id, $riiginimi, $treeneri_nimi, $klubinimi, $kohtuniku_nimi, $v6istleja_id, $v6istleja_tulemus);
    $kask->execute();
    while($kask->fetch()){
      echo "<p> $v6istleja ";
      echo " $riiginimi ";
      echo " $klubinimi ";
      echo " $treeneri_nimi ";
      echo " $kohtuniku_nimi ";
      echo " $v6istleja_tulemus ";
      


    }

    $kask->close();

    
    ?>


    </ul>
    </nav>
	</header>
	<div class="vealisamine">
	<p><strong>Lisa v6istleja.</strong></p>
    <table>   
			    <form action='?'>
				   <input type='text' name='uuenda' />


           <select name="riigid_id">
  <?php
     $kask=$yhendus->prepare("SELECT id, riiginimi FROM riigid");
     $kask->bind_result($id, $riiginimi);
     $kask->execute();
     while($kask->fetch()){
       echo "<option value='$id'>$riiginimi</option>";
     }
  ?>
</select>







           <select name="klubid_id">
  <?php
     $kask=$yhendus->prepare("SELECT id, klubinimi FROM klubid");
     $kask->bind_result($id, $klubinimi);
     $kask->execute();
     while($kask->fetch()){
       echo "<p> $klubinimi ";
       echo "<option value='$id'>$klubinimi</option>";
     }
  ?>
</select>


        <select name="kohtunikud_id">
  <?php
     $kask=$yhendus->prepare("SELECT id, kohtuniku_nimi FROM kohtunikud");
     $kask->bind_result($id, $kohtuniku_nimi);
     $kask->execute();
     while($kask->fetch()){
       echo "<option value='$id'>$kohtuniku_nimi</option>";
     }
  ?>
</select>



        <select name="treenerid_id">
  <?php
     $kask=$yhendus->prepare("SELECT id, treeneri_nimi FROM Treenerid");
     $kask->bind_result($id, $treeneri_nimi);
     $kask->execute();
     while($kask->fetch()){
       echo "<option value='$id'>$treeneri_nimi</option>";
     }
  ?>
</select>




 
				   <input type='submit' value='Lisa ' />
				</form>		
	</table>
	</div>
  </body>
</html>
<?php
  $yhendus->close();
?>