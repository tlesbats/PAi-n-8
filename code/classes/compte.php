<?php

class Compte
{
  private $_id;
  private $_username;
  private $_password;
  private $_type;

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
  public function username() {return $this->_username;}
  public function password() {return $this->_password;}
  public function type() {return $this->_type;}

  public function setId($id) {$this->_id=(int) $id;}
  public function setUsername($username)
  {
      if (is_string($username)) {$this->_username = $username;}
  }
  public function setPassword($password)
  {
      if (is_string($password)) {$this->_password = $password;}
  }
  public function setType($type)
  {
      if (is_string($type)) {$this->_type = $type;}
  }
}

//<-------------- fin de la journée dimanche 20/12------------------------->

class managerCompte
  {
    private $_db;


    public function __construct($db)
    {
        $this->_db=$db;
    }

    public function add(Charge $charge)
    {
        $q = $this->_db->prepare('INSERT INTO compte SET username =:username, password :=password, typeCompte =:type');


        $q->bindValue(':username', $username->username());
        $q->bindValue(':password', $password->password());
        $q->bindValue(':type', $type->type());

        $q->execute();
    }

    public function delete(Compte $compte)
    {
        $this->_db->exec('DELETE FROM compte WHERE id='.$compte->id());
    }

    public function get($id)
    {
        $id = (int) $id;

        $q = $this->_db->query('SELECT * FROM compte WHERE id = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);

        return new compte($donnees);
    }

    public function update(Compte $compte)
    {
        $q=$this->_db->prepare('UPDATE compte SET username =:username, password=:password, typeCompte=:type WHERE id = :id');

        $q->bindValue(':id',$compte->id(), PDO::PARAM_INT);
        $q->bindValue(':username', $compte->username());
        $q->bindValue(':password', $compte->password());
        $q->bindValue(':type', $compte->type());

        $q->execute();
    }
}
