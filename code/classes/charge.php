<?php

class Charge extends Objet
{
  private $_idSource;
  private $_priorite;
  private $_calibre;
  private $_etatBase;
  private $_etatCommande;
  private $_pilotable;

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
  public function idSource() {return $this->_idSource;}
  public function priorite() {return $this->_priorite;}
  public function calibre() {return $this->_calibre;}
  public function etatBase() {return $this->_etatBase;}
  public function etatCommande() {return $this->_etatCommande;}
  public function pilotable() {return $this->_pilotable;}

  public function setId($id) {$this->_id=(int) $id;}
  public function setIdSource($idSource)
  {
      if (is_int($idSource)) {$this->_idSource = $idSource;}
  }
  public function setPriorite($priorite)
  {
      if (is_int($priorite)) {$this->_priorite = $priorite;}
  }
  public function setCalibre($calibre)
  {
      if (is_int($calibre)) {$this->_calibre = $calibre;}
  }
  public function setEtatBase($etatBase)
  {
      if (is_int($etatBase)) {$this->_etatBase = $etatBase;}
  }
  public function setEtatCommande($etatCommande)
  {
      if (is_int($etatCommande)) {$this->_etatCommande = $etatCommande;}
  }
  public function setPilotable($pilotable)
  {
      if (is_int($pilotable)) {$this->_pilotable = $$pilotable;}
  }
}


  class managerCable
  {
    private $_db;


    public function __construct($db)
    {
        $this->_db=$db;
    }

    public function add(Charge $charge)
    {
        $q = $this->_db->prepare('INSERT INTO charge SET id=:id, idSource =:idSource, priorite=:priorite, calibre=:calibre, etatBase=:etatBase, etatCommande=:etatCommande, pilotable=:pilotable');

        $q->bindValue(':id',$charge->id(),PDO::PARAM_INT)
        $q->bindValue(':idSource', $charge->idSource(), PDO::PARAM_INT);
        $q->bindValue(':priorite', $charge->priorite(), PDO::PARAM_INT);
        $q->bindValue(':calibre', $charge->calibre(), PDO::PARAM_INT);
        $q->bindValue(':etatBase',$charge->etatBase(), PDO::PARAM_INT);
        $q->bindValue(':etatCommande',$charge->etatCommande(), PDO::PARAM_INT);
        $q->bindValue(':pilotable',$charge->pilotable(), PDO::PARAM_INT);

        $q->execute();
    }

    public function delete(Charge $charge)
    {
        $this->_db->exec('DELETE FROM charge WHERE id='.$charge->id());
    }

    public function get($id)
    {
        $id = (int) $id;

        $q = $this->_db->query('SELECT * FROM charge WHERE id = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);

        return new Charge($donnees);
    }

    public function update(Charge $charge)
    {
        $q=$this->_db->prepare('UPDATE cable SET idSource =:idSource, priorite=:priorite, calibre=:calibre, etatBase=:etatBase, etatCommande=:etatCommande, pilotable=:pilotable WHERE id = :id');

        $q->bindValue(':id',$charge->id(), PDO::PARAM_INT);
        $q->bindValue(':idSource', $charge->idSource(), PDO::PARAM_INT);
        $q->bindValue(':priorite', $charge->priorite(), PDO::PARAM_INT);
        $q->bindValue(':calibre', $charge->calibre(), PDO::PARAM_INT);
        $q->bindValue(':etatBase',$charge->etatBase(), PDO::PARAM_INT);
        $q->bindValue(':etatCommande',$charge->etatCommande(), PDO::PARAM_INT);
        $q->bindValue(':pilotable',$charge->pilotable(), PDO::PARAM_INT);

        $q->execute();
    }
  }
