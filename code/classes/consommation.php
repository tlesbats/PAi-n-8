<?php

class Consommation extends Rapport
{
  private $_consommation;

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
  public function consommation() {return $this->_consommation;}

  public function setId($id) {$this->_id=(int) $id;}
  public function setConsommation($consommation)
  {
      if (is_double($consommation)) {$this->_consommation = $consommation;}
  }

}


class ConsommationManager
  {
    private $_db;

    public function __construct($db)
    {
        $this->_db=$db;
    }

    public function add(Consommation $consommation)
    {
        $q = $this->_db->prepare('INSERT INTO consommation SET id=:id, consommation:=consommation');

        $q->bindValue(':id',$consommation->id());
        $q->bindValue(':consommation', $consommation->consommation());

        $q->execute();
    }

    public function delete(Consommation $consommation)
    {
        $this->_db->exec('DELETE FROM consommation WHERE id='.$consommation->id());
    }

    public function get($id)
    {
        $id = (int) $id;

        $q = $this->_db->query('SELECT * FROM consommation WHERE id = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);

        return new Consommation($donnees);
    }

    public function update(Consommation $consommation)
    {
        $q=$this->_db->prepare('UPDATE consommation SET consommation=:consommation WHERE id = :id');

        $q->bindValue(':id', $cable->id());
        $q->bindValue(':consommation',$consommation->consommation());

        $q->execute();
    }
}
