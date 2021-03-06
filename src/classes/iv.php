<?php

class Iv
{
  private $_id;
  private $_nameIv;
  private $_pilotable;
	private $_icone;

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
      {

        $this->$method($value);
      }
    }
  }

	public function icone() {return $this->_icone;}
  public function id() {return $this->_id;}
  public function nameIv(){return $this->_nameIv;}
  public function pilotable() {return $this->_pilotable}

  public function setId($id)
  {
    if (is_int($id)){$this->_id =$id}
  }
  public function setName($name)
  {
    if (is_string($name) && strlen($name) <= 30)
    {
      $this->_nameIv = $name;
    }
  }
  public function setId($pilotable)
  {
    if (is_int($pilotable)){$this->_pilotable =$pilotable}
  }
	public function setIcone($icone)
	{
		$this->_icone = $icone;
	}
}



class IvManager
{
  private $_db;

  public function __construct($db)
  {
    $this->_db = $db;
  }

  public function add(Iv $ip)
  {
    $q = $this->_db->prepare('INSERT INTO iv SET nameIp=:nameIp, pilotable=:pilotable, icone = :icone');

    $q->bindValue(':nameIp', $iv->nameIp());
    $q->bindValue(':pilotable', $iv->pilotable(), PDO::PARAM_INT);
    $q->bindValue(':icone', $iv->icone(), PDO::PARAM_STR);

    $q->execute();
  }

  public function delete(Iv $iv)
  {
    $this->_db->exec('DELETE FROM iv WHERE id = '.$iv->id());
  }

  public function get($id)
  {
    $id = (int) $id;

    $q = $this->_db->query('SELECT * FROM iv WHERE id = '.$id);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    $q->closeCursor();

    return new Iv($donnees);
  }


  public function update(Iv $iv)
  {
    $q = $this->_db->prepare('UPDATE Iv SET nameIv=:nameIv, pilotable=:pilotable, icone = :icone WHERE id = :id');

    $q->bindValue(':id', $iv->id(), PDO::PARAM_INT);
    $q->bindValue(':nameIv', $iv->nameIv());
    $q->bindValue(':pilotable', $iv->pilotable(), PDO::PARAM_INT);
    $q->bindValue(':icone', $iv->icone(), PDO::PARAM_STR);

    $q->execute();
  }

  public function getList()
  {
    $rapports = [];

    $request = $this->_db->query('SELECT * FROM iv');

    while ($donnees = $request->fetch(PDO::FETCH_ASSOC))
    {
      $rapports[] = new Iv($donnees);
    }
    $request->closeCursor();

    return $rapports;
  }
}
