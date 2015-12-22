<?php

class Constitution_groupe
{
  private $_id;
  private $_idObjet;
  private $_idGroupe;

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

  public function id() {return $this->_id;}
  public function idGroupe() {return $this->_idGroupe;}
  public function idObjet() {return $this->_idObjet;}

  public function setId($id) {$this->_id=(int) $id;}
  public function setIdObjet($idObjet)
  {
      if (is_int($idObjet)) {$this->_idObjet = $idObjet;}
  }
  public function setIdGroupe($idGroupe)
  {
      if (is_int($idGroupe)) {$this->_idGroupe=$isGroupe;}
  }

}


class Constitution_groupeManager
  {
    private $_db;

    public function __construct($db)
    {
        $this->_db=$db;
    }

    public function add(Constitution_groupe $constitution_groupe)
    {
        $q = $this->_db->prepare('INSERT INTO constitution_groupe SET idObjet=:idObjet, idGroupe=:idGroupe');

        $q->bindValue(':idObjet', $constitution_groupe->idObjet(),PDO::PARAM_INT);
        $q->bindValue(':idGroupe', $constitution_groupe->idGroupe(),PDO::PARAM_INT);

        $q->execute();
    }

    public function delete(Constitution_groupe $constitution_groupe)
    {
        $this->_db->exec('DELETE FROM constitution_groupe WHERE id='.$constitution_groupe->id());
    }

    public function get($id)
    {
        $id = (int) $id;

        $q = $this->_db->query('SELECT * FROM constitution_groupe WHERE id = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        $q->closeCursor();

        return new Consommation($donnees);
    }

    public function update(Consommation $consommation)
    {
        $q=$this->_db->prepare('UPDATE constitution_groupe SET idObjet=:idObjet, idGroupe=:idGroupe WHERE id = :id');

        $q->bindValue(':idObjet', $constitution_groupe->idObjet(), PDO::PARAM_INT);
        $q->bindValue(':idGroupe', $constitution_groupe->idGroupe(), PDO::PARAM_INT);
        $q->bindValue(':id',$constitution_groupe->id(), PDO::PARAM_INT);

        $q->execute();
    }

    public function getList()
    {
      $rapports = [];

      $request = $this->_db->query('SELECT * FROM constitution_groupe');

      while ($donnees = $request->fetch(PDO::FETCH_ASSOC))
      {
        $rapports[] = new Constitution_groupe($donnees);
      }
      $request->closeCursor();

      return $rapports;
    }
}
