<?php
class Pilotage_iv_charge extends Pilotage_ip_objet
{
	private $_idIv;

	public function getIdIv() {return $this->_idIv;}
	public function setIdIv()
	{
	$idIv = (int) $idIv;

	if ($idIv > 0)
		$this->_idIv = $idIv;
	}
}

class Pilotage_iv_chargeManager
{
	private $_db;

    public function __construct($db)
    {
        $this->_db=$db;
    }

    public function add(Pilotage_iv_charge $pilotage_iv_charge)
    {
        $q = $this->_db->prepare('INSERT INTO pilotage_iv_charge SET IDIv=:idIv, C_IDObjet=:idObjet, IDGroupe=:idGroupe, IDIp=:idIp');


        $q->bindValue(':idIp', $pilotage_ip_objet->getIdIp(),PDO::PARAM_INT);
		$q->bindValue(':idObjet', $pilotage_ip_objet->getIdObjet(),PDO::PARAM_INT);
		$q->bindValue(':idGroupe', $pilotage_ip_objet->getIdGroupe(), PDO::PARAM_INT);
		$q->bindValue(':idIv',$pilotage_iv_charge->getIdIv(),PDO::PARAM_INT);

        $q->execute();
    }

    public function delete(Pilotage_iv_charge $pilotage_iv_charge)
    {
        $this->_db->exec('DELETE FROM pilotage_iv_charge WHERE id='.$pilotage_iv_charge->getId());
    }

    public function get($id)
    {
        $id = (int) $id;

        $q = $this->_db->query('SELECT * FROM pilotage_iv_charge WHERE id = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
		$q->closeCursor();

        return new Pilotage_iv_charge($donnees);
    }

    public function update(Pilotage_iv_charge $pilotage_iv_charge)
    {
        $q=$this->_db->prepare('UPDATE pilotage_iv_charge SET IDIv=:idIv, C_IDObjet=:idObjet, IDGroupe=:idGroupe, IDIp=:idIp WHERE id = :id');

        $q->bindValue(':id', $panne->getId(), PDO::PARAM_INT);
		$q->bindValue(':idIp', $pilotage_ip_objet->getIdIp(),PDO::PARAM_INT);
		$q->bindValue(':idObjet', $pilotage_ip_objet->getIdObjet(),PDO::PARAM_INT);
		$q->bindValue(':idGroupe', $pilotage_ip_objet->getIdGroupe(), PDO::PARAM_INT);
		$q->bindValue(':idIv',$pilotage_iv_charge->getIdIv(),PDO::PARAM_INT);

        $q->execute();
    }

	public function getList()
    {
      $rapports = [];

      $request = $this->_db->query('SELECT * FROM pilotage_iv_charge');

      while ($donnees = $request->fetch(PDO::FETCH_ASSOC))
      {
        $rapports[] = new Pilotage_iv_charge($donnees);
      }
      $request->closeCursor();

      return $rapports;
    }
}
