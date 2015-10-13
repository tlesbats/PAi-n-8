#Vitoh le caca !
<?php
  require 'connexion1.php';
($id = $_GET['id'] )|| die('No ID');
$r = $dbh->query("SELECT * FROM sommets WHERE ID=$id");
$a = $r->fetch(PDO::FETCH_ASSOC);
?>

<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title><?php echo $a['Nom']; ?></title>
  <link rel="stylesheet" type="text/css" href="style.css">
 </head>
 <body>
<div class="detail">

  <?php include'header.php';?>
  <h2><?php echo  "Plus d'info sur ". $a['Nom']; ?></h2>
  <!-- on fait un jointure pour avoir les tags-->
  <dt></dt>
    <div class="image">
    <dd id="image"><img src="<?php echo $a['Image'] ?>"></dd>
    </div>


  <dl>
    <dt>Theme</dt>
    <dd>
<?php
  $r1 = $dbh->query("SELECT tags.tag_sport AS tag FROM sommets,liaison,tags where sommets.ID=liaison.id_sommet AND liaison.id_tag=tags.ID_tag AND sommets.ID=$id");
foreach ($r1 as $a1 ) {echo $a1['tag'].'<br>';}
?>
</dd>

</dl>

  <dl>

    
    <dt>Altitude</dt>
    <dd><?php echo $a['Altitude'] ?></dd>
    <dt>Massif</dt>
    <dd><?php echo $a['Massif'] ?></dd>
    <dt>Pays</dt>
    <dd><?php echo $a['Pays'] ?></dd>
    <dt>Region</dt>
    <dd><?php echo $a['Region'] ?></dd>
    <dt>Date de 1<sup>ere</sup> acension</dt>
    <dd><?php echo $a['Date'] ?></dd>
    <dt>1<sup>ere</sup> Grimpeur</dt>
    <dd><?php echo $a['Grimpeur'] ?></dd>
    <dt>Commentaire</dt>
    <dd><?php echo $a['Commentaire'] ?></dd>
    <dt>Evaluation</dt>
    <dd><?php echo $a['Evaluation'] ?></dd> 
  </dl>
          <div class= "carte_google">
            <h3>googlemap</h3>

          <?php 
            require('GoogleMapAPIv3.class.php');
            $gmap = new GoogleMapAPI();
            $gmap->setDivId('test1');
            $gmap->setDirectionDivId('satellite');
            $gmap->setCenter($a['Nom']);
            $gmap->setEnableWindowZoom(true);
            $gmap->setEnableAutomaticCenterZoom(false); 
            $gmap->setSize('600px','600px');
            $gmap->setZoom(3);
            $gmap->setLang('fr');
            $gmap->setDefaultHideMarker(false);

            $coordtab = array();
            $coordtab []= array($a['Nom'],'<strong>Sommet '.$a['Nom'].'</strong>');
            $gmap->addArrayMarkerByAddress($coordtab,'cat3');
            $gmap->generate();

            echo $gmap->getGoogleMap();
          ?>
        </div>
</div>
<div>
  <?php include'footer.php';?>
 </div>
 </body>
</html>
