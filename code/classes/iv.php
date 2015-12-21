<?php

class Iv
{
  private $_idIv;
  private $_nameIv;

  public function hydrate(array $donnees)
  {
    foreach ($donnees as $key => $value)
    {
      $method = 'set'.ucfirst($key);

      if (method_exists($this, $method))
        $this->$method($value);
    }
  }

  public function id()
  {
    return $this->_id;
  }
  public function nameIv()
  {
    return $this->_nameIv;
  }


  public function setId($id)
  {

    $this->_id =(int) $id
  }
  public function setName($name)
  {
    if (is_string($name) && strlen($name) <= 30)
    {
      $this->_nameIv = $name;
    }
  }

}



class managerIv
{
  private $_db;

  public function __construct($db)
  {
    $this->_db = $db;
  }

  public function add(Iv $ip)
  {
    $q = $this->_db->prepare('INSERT INTO iv SET nameIp=:nameIp');

    $q->bindValue(':nameIp', $ip->nameIp());
    $q->bindValue('localisation', $ip->localisation(), PDO::PARAM_INT);

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

    return new Iv($donnees);
  }


  public function update(Iv $iv)
  {
    $q = $this->_db->prepare('UPDATE Iv SET nameIv = :nameIv WHERE id = :id');

    $q->bindValue(':id', $ip->id(), PDO::PARAM_INT);
    $q->bindValue(':nameIv', $iv->nameIv(), PDO::PARAM_INT);

    $q->execute();
  }
}
?>
