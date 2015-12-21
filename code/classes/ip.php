
<?php
class Ip
{
  private $_id;
  private $_nameIp;
  private $_localisation;



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

   public function id()
  {

      return $this->_id;
  }
 public function nameIp()
  {
      return $this->_nameIp;
  }
  public function localisation()
  {
     return $this->_localisation;
  }




  public function setId($id)
  {

      $this->_id =(int) $id
  }
  public function setName($name)
  {
	if (is_string($name) && strlen($name) <= 30)
	{
		$this->_nameIp = $name;
	}
  }
  public function setLocalisation($localisation)
  {
	  if (is_int($localisation))

    if ($localisation>= 0 && $localisation<= 99)
    {
      $this->_localisation = $localisation;
  }
}



class IpManager
{
  private $_db;

  public function __construct($db)
  {
    $this->_db = $db;
  }

  public function add(Ip $ip)
  {
    $q = $this->_db->prepare('INSERT INTO ip SET nameIp=:nameIp, localisation=:localisation');

    $q->bindValue(':nameIp', $ip->nameIp());
    $q->bindValue(':localisation', $ip->localisation(), PDO::PARAM_INT);

    $q->execute();
  }

  public function delete(Ip $ip)
  {
    $this->_db->exec('DELETE FROM ip WHERE id = '.$ip->id());
  }

  public function get($id)
  {
    $id = (int) $id;

    $q = $this->_db->query('SELECT * FROM ip WHERE id = '.$id);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    $q->closeCursor();

    return new Ip($donnees);
  }


  public function update(Ip $ip)
  {
    $q = $this->_db->prepare('UPDATE Ip SET   nameIp=:nameIp, localisation=:localisation  WHERE id = :id');

    $q->bindValue(':id', $ip->id(), PDO::PARAM_INT);
    $q->bindValue(':nameIp', $ip->nameIp());
    $q->bindValue(':localisation', $ip->localisation(), PDO::PARAM_INT);

    $q->execute();
  }

  public function getList()
  {
    $rapports = [];

    $request = $this->_db->query('SELECT * FROM ip');

    while ($donnees = $request->fetch(PDO::FETCH_ASSOC))
    {
      $rapports[] = new Ip($donnees);
    }
    $request->closeCursor();

    return $rapports;
  }
}
