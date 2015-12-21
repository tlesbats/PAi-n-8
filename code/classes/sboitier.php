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
        $id = (int) $id;

        $q = $this->_db->query('SELECT * FROM sboitier WHERE id = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);

        return new Sboitier($donnees);
    }
}
