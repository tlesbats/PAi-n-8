<?php
class Pboitier extends Objet{
	public function id() {return $this->_id;}
	public function setId($id)
	{
		if(is_int($id)){$this->_id=$id;}
	}
}
class PboitierManager extends ObjetManager
{
	private $_db;

    public function __construct($db)
    {
        $this->_db=$db;
    }

    public function add(Pboitier $pboitier)
    {
        $q = $this->_db->prepare('INSERT INTO pboitier SET id=:id');

		$q->bindValue(':id',$pboitier->id());

        $q->execute();
    }

    public function delete(Pboitier $pboitier)
    {
        $this->_db->exec('DELETE FROM pboitier WHERE id='.$pboitier->id());
    }

    public function get($id)
    {
        $id = (int) $id;

        $q = $this->_db->query('SELECT * FROM pboitier WHERE id = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);

        return new Pboitier($donnees);
    }

}
