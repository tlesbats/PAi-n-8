<?php

class Source extends Objet
{
  private $_prix;

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

  public function setPrix($prix)
  {
    $this->_prix = $prix;
  }
}

class SourceManager
{
  private $_db;

  public function __construct($db)
  {
    $this->_db = $db;
  }

  public function add(Source $source)
  {
    $request = $this->_bd->prepapre('INSERT INTO source(id, prix) VALUES (:id, :prix)');

    $request->bindValue(':id', $source->getId(), PDO::PARAM_INT);
    $request->bindValue(':prix', $source->getPrix(), PDO::PARAM_STR);

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
    $request = $this->_db->prepapre('UPDATE source SET prix = :prix WHERE id = :id');

    $request->bindValue(':prix', $source->getPrix(), PDO::PARAM_STR);
    $request->bindValue(':id', $source->getId(), PDO::PARAM_INT);

    $request->execute();
  }

  public function get($id)
  {
    $request = $this->_db->prepare('SELECT * FROM source WHERE id = :id');

    $request->bindValue(':id', $id, PDO::PARAM_INT);

    $request->execute();
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
