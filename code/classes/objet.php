<?php

class Objet
{
  private $_id;
  private $_name;
  private $_localisation;
  private $_etatBug;
  private $_etatEffectif;
  private $_consommation;
  private $_icone;

  public function hydrate(array $donnees)
  {
    foreach ($donnees as $key => $value)
    {
      $method = 'set'.ucfirst($key);

      if (method_exists($this, $method))
        $this->$method($value);
    }
  }

  public function getId()             {return $this->_id;}
  public function getName()           {return $this->_name;}
  public function getLocalisation()   {return $this->_localisation;}
  public function getEtatBug()        {return $this->_etatBug;}
  public function getEtatEffectif()   {return $this->_etatEffectif;}
  public function getConsommation()   {return $this->_consommation;}
  public function getIcone()          {return $this->_icone;}

  public function setId($id)
	{
		$id = (int) $id;

		if ($id > 0)
			$this->_id = $id;
	}

  public function setName($name)
  {
    if (is_string($name))
      $this->_name = $name;
  }

  public function setLocalisation($localisation)
  {
    $localisation = (int) $localisation;

    $this->_localisation = $localisation;
  }

  public function setEtatBug($etatBug)
  {
    $etatBug = (int) $etatBug;

    if($etatBug == 0 || $etatBug == 1)
      $this->_etatBug = $etatBug;
  }

  public function setEtatEffectif($etatEffectif)
  {
    $etatEffectif = (int) $etatEffectif;

    if ($etatEffectif == 0 || $etatEffectif == 1)
      $this->_etatEffectif = $etatEffectif;
  }

  public function setConsommation($consommation)
  {
    $this->_consommation = $consommation;
  }

  public function setIcone($icone)
  {
    if (is_array($icone))
      $this->_icone = $icone;
  }
}

class ObjetManager
{
    private $_db;


    public function __construct($db)
    {
        $this->_db=$db;
    }

    public function add(Objet $objet)
    {
        $q = $this->_db->prepare('INSERT INTO objet SET nameObject =:name, localisation=:localisation, etatBug=:bug, etatEffectif=:etat, consommation=:consommation, icone=:icone');

        $q->bindValue(':name', $objet->getName());
        $q->bindValue(':localisation', $objet->getLocalisation(),PDO::PARAM_INT);
        $q->bindValue(':bug',$objet->getEtatBug());
        $q->bindValue(':etat',$objet->getEtatEffectif());
        $q->bindValue(':consommation',$objet->getConsommation());
        $q->bindValue(':icone',$objet->getIcone());

        $q->execute();
    }

    public function delete(Objet $objet)
    {
        $this->_db->exec('DELETE FROM objet WHERE id='.$objet->getId());
    }

    public function get($id)
    {
        $id = (int) $id;

        $q = $this->_db->query('SELECT * FROM objet WHERE id = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        $q->closeCursor();

        return new Objet($donnees);
    }

    public function update(Objet $objet)
    {
        $q=$this->_db->prepare('UPDATE objet SET nameObject =:name, localisation=:localisation, etatBug=:bug, etatEffectif=:etat, consommation=:consommation, icone=:icone WHERE id = :id');

        $q->bindValue(':id', $objet->getId());
        $q->bindValue(':name', $objet->getName());
        $q->bindValue(':localisation', $objet->getLocalisation(),PDO::PARAM_INT);
        $q->bindValue(':bug',$objet->getEtatBug());
        $q->bindValue(':etat',$objet->getEtatEffectif());
        $q->bindValue(':consommation',$objet->getConsommation());
        $q->bindValue(':icone',$objet->getIcone());

        $q->execute();
    }

    public function getList()
    {
      $rapports = [];

      $request = $this->_db->query('SELECT * FROM objet');

      while ($donnees = $request->fetch(PDO::FETCH_ASSOC))
      {
        $rapports[] = new Objet($donnees);
      }
      $request->closeCursor();

      return $rapports;
    }
}
