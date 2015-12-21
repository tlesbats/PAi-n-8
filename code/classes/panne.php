<?php
class Panne{
	private $_name;
	private $_description;
	private $_priorite;
	private $_date;
	private $_idCompte;

	public function hydrate(array $donnees)	{		foreach ($donnees as $key => $value)		{			$method = 'set'.ucfirst($key);			if (method_exists($this, $method))				$this->$method($value);
		}
	}

	public function getId()				{return $this->_id;}	public function getName()			{return $this->_name;}
	public function getDescription()	{return $this->_description;}
	public function getPriorite()		{return $this->_priorite;}
	public function getDate()			{return $this->_date;}
	public function getIdCompte()		{return $this->_idCompte;}

	public function setId($id)	{
		$idRapport = (int) $idRapport;
		if ($idRapport > 0)
			$this->_idRapport = $idRapport;
	}

	public function setName($name)
	{
		if (is_string($name))
			$this->_name = $name;
	}

	public function setDescription($description)
	{
		if (is_string($description))
			$this->_description = $description;
	}

	public function setPriorite($priorite)	{
		$priorite = (int) $priorite;
		$this->_priorite = $priorite;
	}

	public function setDate($date)	{
		this->_date = $date;
	}

	public function setIdCompte($idCompte)	{
		$idCompte = (int) $idCompte;
		if ($idCompte > 0)
			this->_idCompte = $idCompte;
	}
}

class PanneManager
{
	private $_db;

    public function __construct($db)
    {
        $this->_db=$db;
    }

    public function add(Panne $panne)
    {
        $q = $this->_db->prepare('INSERT INTO panne SET namePanne=:name, description=:descrition, priorite=:priorite, date=:date, idCompte=:idCompte');


        $q->bindValue(':name', $panne->getName());
		$q->bindValue(':description', $panne->getDescription());
		$q->bindValue(':priorite', $panne->getPriorite(), PDO::PARAM_INT);
        $q->bindValue(':date', $panne->getDate());
		$q->bindValue(':idCompte', $panne->getIdCompte(),PDO::PARAM_INT);

        $q->execute();
    }

    public function delete(Panne $panne)
    {
        $this->_db->exec('DELETE FROM panne WHERE id='.$panne->id());
    }

    public function get($id)
    {
        $id = (int) $id;

        $q = $this->_db->query('SELECT * FROM panne WHERE id = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);

        return new Panne($donnees);
    }

    public function update(Panne $panne)
    {
        $q=$this->_db->prepare('UPDATE panne SET namePanne = :name, description = :description, priorite = :priorite, date=:date, A_IDCompte=:idCompte WHERE id = :id');

        $q->bindValue(':id', $panne->getId());
        $q->bindValue(':name', $panne->getName());
        $q->bindValue(':description', $panne->getDescription());
        $q->bindValue(':priorite', $panne->getPriorite(), PDO::PARAM_INT);
		$q->bindValue(':date', $panne->getDate());
		$q->bindValue(':idCompte',$panne->getIdCompte());

        $q->execute();
    }
}
