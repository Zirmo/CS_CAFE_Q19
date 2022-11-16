<?php

/***
 * Fonction qui génère la valeur CSRF pour cette page
 * @return string
 * @throws Exception
 */
function genereCSRF(): string
{
    if (!isset($_SESSION["CSRF"])) {
        $_SESSION["CSRF"]=[];
    }
    $nb = count($_SESSION["CSRF"]);
    if(!isset ($_SESSION["CSRF"][$nb-1]["ValCsrf"])){
        $_SESSION["CSRF"][$nb-1]["ValCsrf"]=random_int(0, 999999999);
    }
    return $_SESSION["CSRF"];
}

/**
 * Fonction qui génère un champ CSRF pour formulaire
 * @return string
 * @throws Exception
 */
function genereChampHiddenCSRF(): string
{
    return '<input type="hidden" name="CSRF" value= "' . genereCSRF() . '" />';
}

function genereVarHrefCSRF(): string
{
    return '&CSRF=' . genereCSRF();
}

/**
 * Fonction qui consomme un jeton CSRF.
 * Elle vérifie si la valeur CSRF proposée correspondant à la valeur attendue,
 * puis détruit le jeton
 * @param $valeurCSRFProposée
 * @return bool
 */
function verifierCSRF($valeurCSRFProposée): bool
{
    if(isset($_SESSION["CSRF"])) {
        if ($valeurCSRFProposée == $_SESSION["CSRF"]) {    // On est bien !
            unset($_SESSION["CSRF"]);
            return true;
        } else {

            return false;
        }

    }
    echo "session inconnue";
    return true;
}
