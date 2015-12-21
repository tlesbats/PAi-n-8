<?php

class Pilotage_reveil_objet
{
  private $_id
  private $_idReveil
  private $_idObjet
  private $_idGroupe

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

	public function getId()				{return $this->_id;}
	public function getIdReveil()		{return $this->_idReveil;}
	public function getIdObjet()		{return $this->_idObjet;}
	public function getIdGroupe()		{return $this->_idGroupe;}

	public function setId()
	{
		$id = (int) $id;

		if ($id > 0)
			$this->_id = $id;
	}

	public function setIdReveil()
	{
		$idReveil = (int) $idReveil;

		if ($idReveil > 0)
			$this->_idReveil = $idReveil;
	}

	public function setIdObjet()
	{
		$idObjet = (int) $idObjet;

		if ($idObjet > 0)
			$this->_idObjet = $idObjet;
	}

	public function setIdGroupe()
	{
		$idGroupe = (int) $idGroupe;

		if ($idGroupe > 0)
			$this->_idGroupe = $idGroupe;
	}
}

class Pilotage_reveil_objetManager
{
	private $_db;

	public function __construc($db)
	{
		$this->_db = $db;
	}

	public function add(Pilotage_reveil_objet $pilotage)
	{
		$request = $this->_db->prepare('INSERT INTO pilotage_reveil_objet(idReveil, idObjet,
			idGroupe) VALUES(:idReveil, :idObjet, :idGroupe)');

		$request->bindValue(':idReveil', $pilotage->getIdReveil(), PDO::PARAM_INT);
		$request->bindValue('idObjet', $pilotage->getIdObjet(), PDO::PARAM_INT);
		$request->bindValue(':idGroupe', $pilotage->getIdGroupe(), PDO::PARAM_INT);

		$request->execute();
	}

	public function delete(Pilotage_reveil_objet $pilotage)
	{
		$request = $this->_db->prepare('DELETE FROM rapport WHERE id = :id');

		$request->bindValue(':id', $pilotage->getId(), PDO::PARAM_INT);

		$request->execute();
	}

	public function update(Pilotage_reveil_objet $pilotage)
	{
		$request = $this->_db->prepare('UPDATE pilotage_reveil_objet SET idReveil = :idReveil,
			idObjet = :idObjet, idGroupe = :idGroupe WHERE id = :id');

		$request->bindValue(':idReveil', $pilotage->getIdReveil(), PDO::PARAM_INT);
		$request->bindValue('idObjet', $pilotage->getIdObjet(), PDO::PARAM_INT);
		$request->bindValue(':idGroupe', $pilotage->getIdGroupe(), PDO::PARAM_INT);
		$request->bindValue(':id', $pilotage->getId(), PDO::PARAM_INT);

		$request->execute();
	}

	public function get($id)
	{
		$request = $this->_db->prepare('SELECT * FROM pilotage_reveil_objet WHERE id = :id');

		$request->bindValue(':id', $id, PDO::PARAM_INT);
		$request->execute();

    	$donnees = $request->fetch(PDO::FETCH_ASSOC);
    	$request->closeCursor();

    	return new Pilotage_reveil_objet($donnees);
	}

	public function getList()
	{
		$pilotages = [];

		$request = $this->_db->query('SELECT * FROM pilotage_reveil_objet');

		while ($donnees = $request->fetch(PDO::FETCH_ASSOC))
		{
			$pilotages[] = new Pilotage_reveil_objet($donnees);
		}

		return $pilotages;
	}
}
