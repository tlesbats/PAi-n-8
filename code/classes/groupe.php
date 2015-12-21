<?php

class Groupe
{
  private $_id;
  private $_name;
  private $_icone;

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
  public function icone() {return $this->_icone;}

  public function setId($id) {$this->_id=(int) $id;}
  public function setName($name)
  {
      if (is_string($name)) {$this->_name = $name;}
  }
  public function setIcone($icone)
  {
      if (is_string($icone)) {$this->_icone=$icone;}
  }

}


class managerGroupe
  {
    private $_db;

    public function __construct($db)
    {
        $this->_db=$db;
    }

    public function add(Groupe $groupe)
    {
        $q = $this->_db->prepare('INSERT INTO groupe SET nameGroupe=:name, icone=:icone');

        $q->bindValue(':name', $groupe->name());
        $q->bindValue(':icone', $groupe->icone());

        $q->execute();
    }

    public function delete(Groupe $groupe)
    {
        $this->_db->exec('DELETE FROM groupe WHERE id='.$groupe->id());
    }

    public function get($id)
    {
        $id = (int) $id;

        $q = $this->_db->query('SELECT * FROM groupe WHERE id = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);

        return new Groupe($donnees);
    }

    public function update(Groupe $groupe)
    {
        $q=$this->_db->prepare('UPDATE groupe SET nameGroupe=:name, icone=:icone WHERE id = :id');

        $q->bindValue(':name', $groupe->name());
        $q->bindValue(':icone', $groupe->icone());
        $q->bindValue(':id',$constitution_groupe->id(), PDO::PARAM_INT);

        $q->execute();
    }
}
