<?php

class Rapport
{
  private $_id;
  private $_name;
  private $_date;
  private $_type;
  private $_idObjet;
  private $_idGroupe;
  private $_idReseau;
  private $_idCable;

  public function hydrate(array $donnees)
  {
    foreach ($donnees as $key => $value)
    {
      $method = 'set'.ucfirst($key);

      if (method_exists($this, $method))
        $this->$method($value);
    }
  }

  public function getId()         {return $this->_id;}
  public function getName()       {return $this->_name;}
  public function getDate()       {return $this->_date;}
  public function getType()       {return $this->_type;}
  public function getIdObjet()    {return $this->_idObjet;}
  public function getidGroupe()   {return $this->_idGroupe;}
  public function getIdReseau()   {return $this->_idReseau;}
  public function getIdCable()    {return $this->_idCable;}

  public function setId()
  {
    $id = (int) $id;

    if ($id > 0)
      $this->_id = $id;
  }

  public function getName($name)
  {
    if (is_array($name))
      $this->_name = $name;
  }

  public function setDate($date)
  {
    $this->_date = $date;
  }

  public function setType($type)
  {
    if (is_string($type))
      $this->_type = $type;
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

  public function setIdReseau($idReseau)
  {
    $idReseau = (int) $idReseau;

    if ($idReseau > 0)
      $this->_idReseau = $idReseau;
  }

  public function setIdCable($idCable)
  {
    $idCable = (int) $idCable;

    if ($idCable > 0)
      $this->_idCable = $idCable;
  }
}

class RapportManager
{
	private $_db;

	public function __construc($db)
	{
		$this->_db = $db;
	}

	public function add(Rapport $rapport)
	{
		$request = $this->_db->prepare('INSERT INTO rapport(name, date, type, idObjet,
			idGroupe, idReseau, idCable) VALUES (:name, :date, :type, :idObjet, :idGroupe,
			:idReseau, :idCable)');

		$request->bindValue(':name', $rapport->getName(), PDO::PARAM_STR);
		$request->bindValue(':date', $rapport->getDate(), PDO::PARAM_STR);
		$request->bindValue(':type', $rapport->getType(), PDO::PARAM_STR);
		$request->bindValue(':idObjet', $rapport->getIdObjet(), PDO::PARAM_INT);
		$request->bindValue(':idGroupe', $rapport->getIdGroupe(), PDO::PARAM_INT);
		$request->bindValue(':idReseau', $rapport->getIdReseau(), PDO::PARAM_INT);
		$request->bindValue(':idCable', $rapport->getIdCable(), PDO::PARAM_INT);

		$request->execute();
	}

	public function delete(Rapport $rapport)
	{
		$request = $this->_db->prepare('DELETE FROM rapport WHERE id = :id');

		$request->bindValue(':id', $rapport->getId(), PDO::PARAM_INT);

		$request->execute();
	}

  public function update(Rapport $rapport)
  {
    $request = $this->_db->prepare('UPDATE rapport SET name = :name, date = :date,
      type = :type, idObjet = :idObjet, idGroupe = :idGroupe, idReseau = :idResau,
      idCable = :idCable WHERE id = :id');

    $request->bindValue(':name', $rapport->getName(), PDO::PARAM_STR);
		$request->bindValue(':date', $rapport->getDate(), PDO::PARAM_STR);
		$request->bindValue(':type', $rapport->getType(), PDO::PARAM_STR);
		$request->bindValue(':idObjet', $rapport->getIdObjet(), PDO::PARAM_INT);
		$request->bindValue(':idGroupe', $rapport->getIdGroupe(), PDO::PARAM_INT);
		$request->bindValue(':idReseau', $rapport->getIdReseau(), PDO::PARAM_INT);
		$request->bindValue(':idCable', $rapport->getIdCable(), PDO::PARAM_INT);
    $request->bindValue(':id', $rapport->getId(), PDO::PARAM_INT);

    $request->execute();
  }

  public function get($id)
  {
    $request = $this->_db->prepare('SELECT * FROM rapport WHERE id = :id');

    $request->bindValue(':id', $id, PDO::PARAM_INT);
    $request->closeCursor();

    $request->execute();
  }

  public function getList()
  {
    $rapports = [];

    $request = $this->_db->query('SELECT * FROM rapport');

    while ($donnees = $request->fetch(PDO::FETCH_ASSOC))
    {
      $rapports[] = new Rapport($donnees);
    }

    return $rapports;
  }
}
