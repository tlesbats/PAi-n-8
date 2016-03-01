<?php

class Cable
{
  private $_id;
  private $_name;
  private $_bug;//int
  private $_localisation;//int
  private $_icone;

	public function __construc($donnees)
	{
		$this->hydrate($donnees);
	}

  public function informe_historique(etatBug, localisation)
  {

  }

  public function hydrate(array $donnee)
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

  public function id() {return $this->_id;}
  public function name() {return $this->_name;}
  public function bug() {return $this->_bug;}
  public function localisation() {return $this->_localisation;}
  public function icone() {return $this->_icone;}

  public function setId($id) {$this->_id=(int) $id;}
  public function setName($name)
  {
      if (is_string($name)) {$this->_name = $name;}
  }
  public function setBug($bug)
  {
      if (is_string($bug)) {$this->_bug = $bug;}
  }
  public function setLocalisation($localisation)
  {
      if (is_int($localisation)) {$this->_localisation = $localisation;}
  }
  public function setLocalisation($icone)
  {
      if (is_int($icone)) {$this->_icone = $icone;}
  }
}


class CableManager
{
    private $_db;


    public function __construct($db)
    {
        $this->_db=$db;
    }

    public function add(Cable $cable)
    {
        $q = $this->_db->prepare('INSERT INTO cable SET nameCable = :name, etatBug = :bug, localisation = :localisation, icone = :icone');


        $q->bindValue(':cable', $cable->name());
        $q->bindValue(':bug', $cable->bug(), PDO::PARAM_INT);
        $q->bindValue(':localisation', $cable->localisation(), PDO::PARAM_INT);
        $q->bindValue(':icone',$cable->icone());

        $q->execute();
    }

    public function delete(Cable $cable)
    {
        $this->_db->exec('DELETE FROM cable WHERE id='.$cable->id());
    }

    public function get($id)
    {
        $id = (int) $id;

        $q = $this->_db->query('SELECT * FROM cable WHERE id = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        $q->closeCursor();

        return new Cable($donnees);
    }

    public function update(Cable $cable)
    {
        $q=$this->_db->prepare('UPDATE cable SET nameCable = :name, etatBug = :bug, localisation = :localisation, icone = :icone WHERE id = :id');

        $q->bindValue(':id', $cable->id());
        $q->bindValue(':cable', $cable->name());
        $q->bindValue(':bug', $cable->bug(), PDO::PARAM_INT);
        $q->bindValue(':localisation', $cable->localisation(), PDO::PARAM_INT);
        $q->bindValue(':icone',$cable->icone());

        $q->execute();
    }

    public function getList()
    {
      $rapports = [];

      $request = $this->_db->query('SELECT * FROM cable');

      while ($donnees = $request->fetch(PDO::FETCH_ASSOC))
      {
        $rapports[] = new Cable($donnees);
      }
      $request->closeCursor();

      return $rapports;
    }
}
