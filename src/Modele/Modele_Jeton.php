<?php

namespace App\Modele;

use App\Utilitaire\Singleton_ConnexionPDO;
use PDO;
class Modele_Jeton
{
    /***
     * @param $valeur
     * @param $idUtilisateur
     * @param $codeAction (1 pour renouveler MDP, )
     * @return Le jeton créé !
     */
    static function  Jeton_Creation($valeur, $idUtilisateur, $codeAction)
    {
        $date = new \DateTime();
        $date->add(new \DateInterval("PT900S"));
        $dateFin = $date->format("y-m-d h:i:s");
        $connexionPDO = Singleton_ConnexionPDO::getInstance();

        $requetePreparee = $connexionPDO->prepare(
            'INSERT INTO `token` (`id`, `valeur`, `codeAction`, `idUtilisateur`, `dateFin`)
VALUES (NULL, :valeur, :codeAction, :idUtilisateur, :dateFin);;');

        $requetePreparee->bindParam('valeur', $valeur);
        $requetePreparee->bindParam('codeAction', $codeAction);
        $requetePreparee->bindParam('idUtilisateur', $idUtilisateur);
        $requetePreparee->bindParam('dateFin', $dateFin);

        $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
        $idJeton = $connexionPDO->lastInsertId();

        return $idJeton;
    }

    static function Jeton_Rechercher_Par_Valeur($valeur)
    {
        $connexionPDO = Singleton_ConnexionPDO::getInstance();
        $requetePreparee = $connexionPDO->prepare('select * from `token` where valeur = :paramValeur');
        $requetePreparee->bindParam('paramValeur', $valeur);
        $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
        $jeton = $requetePreparee->fetch(PDO::FETCH_ASSOC);
        return $jeton;
    }

    static function Jeton_Delete_Par_ID($idJeton)
    {
        $connexionPDO = Singleton_ConnexionPDO::getInstance();

        $requetePreparee = $connexionPDO->prepare('delete token.* from `token` where id = :paramId');
        $requetePreparee->bindParam('paramId', $idJeton);
        $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
        return $reponse;
    }
}
