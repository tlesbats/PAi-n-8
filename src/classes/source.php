<?php

class Source extends Objet
{
  private $_prix;
	private $_couleur;

  public function __construc($donnees)
  {
    $this->hydrate($donnees);
  }

  public function hydrate(array $donnees)
  {
    foreach ($donnees as $key => $value)
    {
      $method = 'set'.ucfirst($key);

      if (method_exists($this, $method))
        $this->$method($value);
    }
  }

  public function getPrix() {return $this->_prix;}
	public function getCouleur() {return $this->_couleur;}

  public function setPrix($prix)
  {
    $this->_prix = $prix;
  }
	public function setCouleur($couleur)
	{
		$this->_couleur = $couleur;
	}
}

class SourceManager extends ObjetManager
{
  private $_db;

  public function __construct($db)
  {
    $this->_db = $db;
  }

  public function add(Source $source)
  {
    $request = $this->_bd->prepare('INSERT INTO source(id, prix, couleur) VALUES (:id, :prix, :couleur)');

    $request->bindValue(':id', $source->getId(), PDO::PARAM_INT);
    $request->bindValue(':prix', $source->getPrix(), PDO::PARAM_STR);
    $request->bindValue(':couleur', $source->getCouleur(), PDO::PARAM_STR);

    $request->execute();
  }

  public function delete(Source $source)
  {
    $request = $this->_db->prepare('DELETE FROM source WHERE id = :id');

    $request->bindValue(':id', $source->getId(), PDO::PARAM_INT);

    $request->execute();
  }

  public function update(Source $source)
  {
    $request = $this->_db->prepare('UPDATE source SET prix = :prix, couleur = :couleur WHERE id = :id');

    $request->bindValue(':prix', $source->getPrix(), PDO::PARAM_STR);
    $request->bindValue(':id', $source->getId(), PDO::PARAM_INT);
    $request->bindValue(':couleur', $source->getCouleur(), PDO::PARAM_STR);

    $request->execute();
  }

  public function get($id)
  {
    $request = $this->_db->prepare('SELECT * FROM source WHERE id = :id');

    $request->bindValue(':id', $id, PDO::PARAM_INT);
		$request->execute();

		$donnees = $request->fetch(PDO::FETCH_ASSOC);
    $request->closeCursor();

    return new Source($donnees);
  }

  public function getList()
 {
   $sources = [];

   $request = $this->_db->query('SELECT * FROM source');

   while ($donnees = $request->fetch(PDO::FETCH_ASSOC))
   {
     $sources[] = new Source($donnees);
   }

   return $sources;
 }
}
