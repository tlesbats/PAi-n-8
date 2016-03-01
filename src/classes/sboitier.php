<?php

class Sboitier extends Objet
{
    public function id() {return $this->_id;}
	public function setId($id)
	{
		if(is_int($id)){$this->_id=$id;}
	}
}

class SboitierManager extends ObjetManager
{
    private $_db;

    public function __construct($db)
    {
        $this->_db=$db;
    }

    public function add(Sboitier $sboitier)
    {
        $q = $this->_db->prepare('INSERT INTO sboitier SET id=:id');

		$q->bindValue(':id',$sboitier->id());

        $q->execute();
    }

    public function delete(Sboitier $sboitier)
    {
        $this->_db->exec('DELETE FROM sboitier WHERE id='.$sboitier->id());
    }

    public function get($id)
    {
		$request = $this->_db->prepare('SELECT * FROM sboitier WHERE id = :id');

    	$request->bindValue(':id', $id, PDO::PARAM_INT);
		$request->execute();

		$donnees = $request->fetch(PDO::FETCH_ASSOC);
    	$request->closeCursor();

    	return new Sboitier($donnees);
    }

    public function getList()
    {
      $rapports = [];

      $request = $this->_db->query('SELECT * FROM sboitier');

      while ($donnees = $request->fetch(PDO::FETCH_ASSOC))
      {
        $rapports[] = new Sboitier($donnees);
      }
      $request->closeCursor();

      return $rapports;
    }
}
