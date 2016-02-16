<?php
//lien BDD
$bdd = new PDO('mysql:host=localhost;dbname=edison_ways', 'root', ''); 
$bdd->query('SET NAMES utf8'); 
//id, nom, icone, couleur, danger(1/0), consommation, nom de la source, pilotable, etat, delesté(1/0)
$table_liste_charge =[];
$nbcharge=0;

$request=$bdd->query('SELECT oc.id, oc.nom AS nom, oc.icone, s.couleur, oc.etatBug 
  AS danger, oc.consommation, os.nom AS source, c.pilotable, oc.etatEffectif 
  AS etat, c.etatCommande AS commande FROM objet oc INNER JOIN charge c 
  ON oc.id = c.id INNER JOIN source s ON c.IDSource = s.id INNER JOIN objet os ON c.IDSource = os.id INNER JOIN constitution_groupe gc ON gc.IDObjet = oc.id INNER JOIN groupe g ON gc.IDGroupe=g.id WHERE g.id='.$_POST['groupe']);

$deleste=[];

while ($donnees = $request->fetch(PDO::FETCH_ASSOC))
{
      $table_liste_charge[] = $donnees;
      $nbcharge++;
      //si l'etat effectif est le même que l'etat commandé, ce n'est pas délesté, sinon si
      if ($donnees["etat"]=$donnees["commande"]) {
          $deleste[]=0;
      }
      else {
          $deleste[]=1;
      }

}
//on supprime toute la colonne etatCommande
unset($table_liste_charge['etatCommande']);

//on ajoute à $table l'array $deleste
for($i=0;$i<$nbcharge;$i++){
    $liste_salle[$i]["deleste"]=$deleste[$i];
}

$request->closeCursor();
echo json_encode($table_liste_charge);
 ?>
