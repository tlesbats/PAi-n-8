<?php

class Reseau
{
  private $_id;
  private $_name;
  private $_etatBug;
  private $_localisation;
  private $_icone;

	public function hydrate(array $donnees)
  {
    foreach ($donnees as $key => $value)
    {
      $method = 'set'.ucfirst($key);

      if (method_exists($this, $method))
        $this->$method($value);
    }
  }

  public function getId()             {return $this->_id;}
  public function getName()           {return $this->_name;}
  public function getEtatBug()        {return $this->_etatBug;}
  public function getLocalisation()   {return $this->_localisation;}
  public function getIcone()          {return $this->_icone;}

  public function setId()
  {
    $id = (int) $id;

    if ($id > 0)
      $this->_id = $id;
  }

  public function setName($name)
  {
    if (is_string($name))
      $this->_name = $name;
  }

  public function setEtatBug($etatBug)
  {
    $etatBug = (int) $etatBug;

    if ($etatBug == 1 || $etatBug == 0)
      $this->_etatBug = $etatBug;
  }

  public function setLocalisation($localisation)
  {
    $this->_localisation = $localisation;
  }

  public function setIcone($icone)
  {
    if (is_string($icone))
    {
      $this->_icone = $icone;
    }
  }
}

class ReseauManager
{
  private $_db;

  public function __construct($db)
  {
    $this->_db = $db;
  }

  public function add(Reseau $reseau)
  {
    $request = $this->_db->prepare('INSERT INTO reseau(name, etatBug, localisation, icone)
      VALUES(:name, :etatBug, :localisation, :icone)');

    $request->bindValue(':name', $reseau->getName(), PDO::PARAM_STR);
    $request->bindValue(':etatBug', $reseau->getEtatBug(), PDO::PARAM_INT);
    $request->bindValue(':localisation', $reseau->getLocalisation(), PDO::PARAM_INT);
    $request->bindValue(':icone', $reseau->getIcone(), PDO::PARAM_STR);

    $request->execute();
  }

	public function delete(Reseau $reseau)
	{
		$request = $this->_bd->prepare('DELETE FROM reveil WHERE id = :id');

		$request->bindValue(':id', $reseau->getId(), PDO::PARAM_INT);

		$request->execute();
	}

	public function update(Reseau $reseau)
	{
		$request = $this->_bd->prepare('UPDATE reveil SET name = :name,
			etatBug = :etatBug, localisation = :localisation, icone = :icone WHERE id = :id');

		$request->bindValue(':name', $reseau->getName(), PDO::PARAM_STR);
    $request->bindValue(':etatBug', $reseau->getEtatBug(), PDO::PARAM_INT);
    $request->bindValue(':localisation', $reseau->getLocalisation(), PDO::PARAM_INT);
    $request->bindValue(':icone', $reseau->getIcone(), PDO::PARAM_STR);
		$request->bindValue(':id', $reseau->getId(), PDO::PARAM_INT);

		$request->execute();
	}

  public function get($id)
  {
    $request = $this->_db->prepare('SELECT * FROM reveil WHERE id = :id');

    $request->bindValue(':id', $id, PDO::PARAM_INT);
    $request->closeCursor();

    $request->execute();
  }

  public function getList()
  {
    $reseaux = [];

    $request = $this->_db->query('SELECT * FROM reseau');

    while ($donnees = $request->fetch(PDO::FETCH_ASSOC))
    {
      $reseaux[] = new Reseau($donnees);
    }

    return $reseaux;
  }
}
