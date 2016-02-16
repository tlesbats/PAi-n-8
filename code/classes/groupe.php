<?php

class Groupe
{
  private $id;
  private $name;
  private $icone;
	private $salle;

  public function __construc($donnees)
  {
    $this->hydrate($donnees);
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

  public function id() {return $this->id;}
  public function name() {return $this->name;}
  public function icone() {return $this->icone;}
	public function salle() {return $this->salle;}

  public function setId($id) {$this->id=(int) $id;}
  public function setName($name)
  {
      if (is_string($name)) {$this->name = $name;}
  }
  public function setIcone($icone)
  {
      if (is_string($icone)) {$this->icone=$icone;}
  }
	public function setSalle($salle)
	{
		if ($salle === 0 || $salle === 1) {$this->salle = $salle;}
	}
}


class GroupeManager
  {
    private $db;

    public function __construct($db)
    {
        $this->db=$db;
    }

    public function add(Groupe $groupe)
    {
        $q = $this->db->prepare('INSERT INTO groupe SET nameGroupe=:name, icone=:icone, salle=:salle');

        $q->bindValue(':name', $groupe->name());
        $q->bindValue(':icone', $groupe->icone());
				$q->bindValue(':salle', $groupe->salle());

        $q->execute();
    }

    public function delete(Groupe $groupe)
    {
        $this->db->exec('DELETE FROM groupe WHERE id='.$groupe->id());
    }

    public function get($id)
    {
        $id = (int) $id;

        $q = $this->db->query('SELECT * FROM groupe WHERE id = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        $q->closeCursor();

        return new Groupe($donnees);
    }

    public function update(Groupe $groupe)
    {
        $q=$this->_db->prepare('UPDATE groupe SET nameGroupe=:name, icone=:icone, salle=:salle WHERE id = :id');

        $q->bindValue(':name', $groupe->name());
        $q->bindValue(':icone', $groupe->icone());
        $q->bindValue(':id',$groupe->id(), PDO::PARAM_INT);
				$q->bindValue(':salle', $groupe->salle());

        $q->execute();
    }

    public function getList()
    {
      $rapports = [];

      $request = $this->db->query('SELECT * FROM groupe');

      while ($donnees = $request->fetch(PDO::FETCH_ASSOC))
      {
        $rapports[] = new Groupe($donnees);
      }
      $request->closeCursor();

      return $rapports;
    }
}
