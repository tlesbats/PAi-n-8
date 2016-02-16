<?php
//lien BDD
$bdd = new PDO('mysql:host=localhost;dbname=edison_ways', 'root', '');
$bdd->query('SET NAMES utf8');
//id, nom, icone, danger(0/1)
$liste_salle =[];
$nbgroupe=0;

$request=$bdd->query('SELECT g.id, g.nom, g.icone FROM groupe g
     INNER JOIN constitution_groupe gc ON gc.idSousGroupe=g.id
     WHERE g.salle=0 AND gc.IDGroupe='.$_POST['salle']);
while ($donnees = $request->fetch(PDO::FETCH_ASSOC))
{
      $liste_salle[] = $donnees;
      $nbgroupe++;
}
$request->closeCursor();

$danger=[];
for ($i=0;$i<$nbgroupe;$i++){
    $request=$bdd->query('SELECT o.etatBug FROM constitution_groupe cg
        INNER JOIN objet o ON o.id=cg.IDObjet
        WHERE cg.IDGroupe='.$liste_salle[$i]["id"]);
    while ($donnees = $request->fetch(PDO::FETCH_ASSOC))
    {
        if($donnees){
            $danger[]=1;
            break;
        }
        else {
            $danger[]=0;
        }
    }
}
$request->closeCursor();

for($i=0;$i<$nbgroupe;$i++){
    $liste_salle[$i]["danger"]=$danger[$i];
}

echo json_encode($liste_salle);
 ?>
