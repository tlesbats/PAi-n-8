<?php

class Alerte extends Rapport
{
    private $_name;
    private $_description;
    private $_priorite;

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
    public function description() {return $this->_description;}
    public function priorite() {return $this->_priorite;}

    public function setId($id) {$this->_id=(int) $id;}
    public function setName($name)
    {
        if (is_string($name)) {$this->_name = $name;}
    }
    public function setDescription($descrition)
    {
        if (is_string($description)) {$this->_description = $description;}
    }
    public function setPriorite($priorite)
    {
        if (is_int($priorite)) {$this->_priorite = $priorite;}
    }

    private function signaler_Alerte(name)
    {

    }
}

class AlerteManager
{
    private $_db;


    public function __construct($db)
    {
        $this->_db=$db;
    }

    public function add(Alerte $alerte)
    {
        $q = $this->_db->prepare('INSERT INTO alerte SET id=:id, nameAlerte = :alerte, description = :description, priorite = :priorite');

        $q->bindValue(':id',$alerte->id()PDO,PARAM_INT);
        $q->bindValue(':alerte', $alerte->name());
        $q->bindValue(':description', $alerte->description());
        $q->bindValue(':priorite', $alerte->priorite(), PDO::PARAM_INT);

        $q->execute();
    }

    public function delete(Alerte $alerte)
    {
        $this->_db->exec('DELETE FROM alerte WHERE id='.$alerte->id());
    }

    public function get($id)
    {
        $id = (int) $id;

        $q = $this->_db->query('SELECT * FROM alerte WHERE id = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        $q->closeCursor();

        return new Alerte($donnees);
    }

    public function update(Alerte $alerte)
    {
        $q=$this->_db->prepare('UPDATE alerte SET nameAlerte = :alerte, description = :description, priorite = :priorite WHERE id = :id');

        $q->bindValue(':id', $alerte->id());
        $q->bindValue(':alerte', $alerte->name());
        $q->bindValue(':description', $alerte->description());
        $q->bindValue(':priorite', $alerte->priorite(), PDO::PARAM_INT);

        $q->execute();

    }

    public function getList()
    {
      $rapports = [];

      $request = $this->_db->query('SELECT * FROM alerte');

      while ($donnees = $request->fetch(PDO::FETCH_ASSOC))
      {
        $rapports[] = new Alerte($donnees);
      }
      $request->closeCursor();

      return $rapports;
    }
}
