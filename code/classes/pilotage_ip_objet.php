<?php
class Pilotage_ip_objet
{
	private $_id;
	private $_idIp;
	private $_idObjet;
	private $_idGroupe;

	public function __construc($donnees)
	{
		$this->hydrate($donnees);
	}
	
	public function hydrate(array $donnees)	{
		foreach ($donnees as $key => $value)
		{
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method))
				$this->$method($value);
		}
	}

	public function getId()				{return $this->_id;}	public function getIdIp()			{return $this->_idIp;}
	public function getIdObjet()		{return $this->_idObjet;}
	public function getIdGroupe()		{return $this->_idGroupe;}

	public function setId($id)	{
		$id = (int) $id;
		if ($id > 0)
			$this->_id = $id;
	}
	public function setIdIp($idIp)
	{
		$idIp = (int) $idIp;
		if ($idIp > 0)
			$this->_idIp = $idIp;
	}
	public function setIdObjet($idObjet)
	{
		$idObjet = (int) $idObjet;
		if ($idObjet > 0)
			$this->_idObjet = $idObjet;
	}
	public function setIdGroupe($idGroupe)
	{
		$idGroupe = (int) $idGroupe;
		if ($idGroupe > 0)
			$this->_idGroupe = $idGroupe;
	}
}

class Pilotage_ip_objetManager{	private $_db;    public function __construct($db)    {        $this->_db=$db;    }    public function add(Pilotage_ip_objet $pilotage_ip_objet)    {        $q = $this->_db->prepare('INSERT INTO pilotage_ip_objet SET IDIp =:idIp, C_IDObjet=:idObjet, IDGroupe=:idGroupe');        $q->bindValue(':idIp', $pilotage_ip_objet->getIdIp(),PDO::PARAM_INT);		$q->bindValue(':idObjet', $pilotage_ip_objet->getIdObjet(),PDO::PARAM_INT);		$q->bindValue(':idGroupe', $pilotage_ip_objet->getIdGroupe(), PDO::PARAM_INT);        $q->execute();    }    public function delete(Pilotage_ip_objet $pilotage_ip_objet)    {        $this->_db->exec('DELETE FROM pilotage_ip_objet WHERE id='.$pilotage_ip_objet->getId());    }    public function get($id)    {        $id = (int) $id;        $q = $this->_db->query('SELECT * FROM pilotage_ip_objet WHERE id = '.$id);        $donnees = $q->fetch(PDO::FETCH_ASSOC);		$q->closeCursor();        return new Pilotage_ip_objet($donnees);    }    public function update(Pilotage_ip_objet $pilotage_ip_objet)    {        $q=$this->_db->prepare('UPDATE pilotage_ip_objet SET IDIp =:idIp, C_IDObjet=:idObjet, IDGroupe=:idGroupe WHERE id = :id');        $q->bindValue(':id', $panne->getId(), PDO::PARAM_INT);        $q->bindValue(':idIp', $pilotage_ip_objet->getIdIp(),PDO::PARAM_INT);		$q->bindValue('idObjet', $pilotage_ip_objet->getIdObjet(),PDO::PARAM_INT);		$q->bindValue('idGroupe', $pilotage_ip_objet->getIdGroupe(), PDO::PARAM_INT);        $q->execute();    }	public function getList()    {      $rapports = [];      $request = $this->_db->query('SELECT * FROM pilotage_ip_objet');      while ($donnees = $request->fetch(PDO::FETCH_ASSOC))      {        $rapports[] = new Pilotage_ip_objet($donnees);      }      $request->closeCursor();      return $rapports;    }}