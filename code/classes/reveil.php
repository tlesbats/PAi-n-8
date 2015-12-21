<?php

class reveil
{
  private $_id;
  private $_name;
  private $_activation;
  private $_weekly;
  private $_date;

  public function hydrate(array $donnees)
  {
    foreach ($donnees as $key => $value)
    {
      $method = 'set'.ucfirst($key);

      if (method_exists($this, $method))
        $this->$method($value);
    }
  }

  public function getId()         {return $this->_id;}
  public function getName()       {return $this->_name;}
  public function getActivation() {return $this->_activation;}
  public function getWeekly()     {return $this->_weekly;}
  public function getDate()       {return $this->_date;}

  public function setId()
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

  public function setActivation($activation)
  {
    $activation = (int) $activation;

    if ($activation == 0 || $activation == 1)
      $this->_activation = $activation;
  }

  public function setWeekly($weekly)
  {
    $weekly = (int) $weekly;

    if ($weekly == 0 || $weekly == 1)
      $this->_weekly = $weekly;
  }

  public function setDate($date)
  {
    $this->_date = $date;
  }
}

class ReveilManager
{
  private $_db;

  public function __construct($db)
  {
    $this->_db = $db;
  }

  public function add(Reveil $reveil)
  {
    $request = $this->_bd->prepapre('INSERT INTO reveil(name, activation, weekly, date)
      VALUES(:name, :activation, :weekly, :date)');

    $request->bindValue(':name', $reveil->getName(), PDO::PARAM_STR);
    $request->bindValue(':activation', $reveil->getActivation(), PDO::PARAM_INT);
    $request->bindValue(':weekly', $reveil->getWeekly(), PDO::PARAM_INT);
    $request->bindValue(':date', $reveil->getDate(), PDO::PARAM_STR);

    $request->execute();
  }

  public function delete(Reveil $reveil)
  {
    $request = $this->_bd->prepare('DELETE FROM reveil WHERE id = :id');

    $request->bindValue(':id', $reveil->getId(), PDO::PARAM_INT);

    $request->execute();
  }

  public function update(Reveil $reveil)
  {
    $request = $this->_bd->prepare('UPDATE reveil SET name = :name,
      activation = :activation, weekly = :weekly, date = :date WHERE id = :id');

    $request->bindValue(':name', $reveil->getName(), PDO::PARAM_STR);
    $request->bindValue(':activation', $reveil->getActivation(), PDO::PARAM_INT);
    $request->bindValue(':weekly', $reveil->getWeekly(), PDO::PARAM_INT);
    $request->bindValue(':date', $reveil->getDate(), PDO::PARAM_STR);
    $request->bindValue(':id', $reveil->getId(), PDO::PARAM_INT);

    $request->execute();
  }

  public function get($id)
  {
    $request = $this->_bd->prepare('SELECT * FROM reveil WHERE id = :id');

    $request->bindValue(':id', $id, PDO::PARAM_INT);

    $request->execute();
  }

  public function getList()
  {
    $reveils = [];

    $request = $this->_db->query('SELECT * FROM reveil');

    while ($donnees = $request->fetch(PDO::FETCH_ASSOC))
    {
      $reveils[] = new Reveil($donnees);
    }

    return $reveils;
  }
}
