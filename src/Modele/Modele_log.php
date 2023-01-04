<?php

namespace App\Modele;

use App\Utilitaire\Singleton_ConnexionPDO;
use App\Utilitaire\Singleton_ConnexionPDO_log;
use PDO;
class Modele_log
{
    static function  Realiser_ajouter($idUtilisateur,$idTypeAction,$date,$idObjet){
        $connexionPDO = Singleton_ConnexionPDO_log::getInstance();

        $requetePreparee = $connexionPDO->prepare(' 
        insert into `realiser` ( idUtilisateur, idTypeAction, date, idObjet) 
        VALUE ( :idUtilisateur, :idTypeAction, :date, :idObjet)');
        $requetePreparee->bindParam('idUtilisateur', $idUtilisateur);
        $requetePreparee->bindParam('idTypeAction', $idTypeAction);
        $requetePreparee->bindParam('date', $date->format("Y-m-s H:i:s"));
        $requetePreparee->bindParam('idObjet', $idObjet);

        $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête

        return $reponse;
    }
}
