<?php

class Batterie extends Source
{
  private $_stockage;

  public function id() {return $this->_id;}
  public function stockage() {return $this->_stockage;}

  public function setId($id) {$this->_id=(int) $id;}
  public function setStockage($stockage) {$this->_stockage=$stockage;}
}


class BatterieManager
{
    private $_db;

    public function __construct($db)
    {
        $this->_db=$db;
    }

    public function add(Batterie $batterie)
    {
        $q = $this->_db->prepare('INSERT INTO batterie SET id=:id, stockage=:stockage');

        $q->bindValue(':id',$batterie->id(),PDO::PARAM_INT)
        $q->bindValue(':stockage', $batterie->stockage());

        $q->execute();
    }

    public function delete(Batterie $batterie)
    {
        $this->_db->exec('DELETE FROM batterie WHERE id='.$batterie->id());
    }

    public function get($id)
    {
        $id = (int) $id;

        $q = $this->_db->query('SELECT * FROM batterie WHERE id = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        $q->closeCursor();

        return new Batterie($donnees);
    }

    public function update(Batterie $batterie)
    {
        $q=$this->_db->prepare('UPDATE batterie SET stockage=:stockage WHERE id = :id');

        $q->bindValue(':id', $batterie->id());
        $q->bindValue(':stockage',$batterie->stockage());

        $q->execute();
    }

    public function getList()
    {
      $rapports = [];

      $request = $this->_db->query('SELECT * FROM batterie');

      while ($donnees = $request->fetch(PDO::FETCH_ASSOC))
      {
        $rapports[] = new Batterie($donnees);
      }
      $request->closeCursor();

      return $rapports;
    }
}
