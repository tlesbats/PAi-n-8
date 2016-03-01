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
	
	public function hydrate(array $donnees)
		foreach ($donnees as $key => $value)
		{
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method))
				$this->$method($value);
		}
	}

	public function getId()				{return $this->_id;}
	public function getIdObjet()		{return $this->_idObjet;}
	public function getIdGroupe()		{return $this->_idGroupe;}

	public function setId($id)
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

