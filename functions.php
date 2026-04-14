<?php

function NettoyerDonnee($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


function GetInfoPage($id_page){
    global $bdd;
    $page_exist = "";
    $req_page = $bdd->prepare('SELECT * FROM page WHERE id = :id_page');
    $req_page->execute(array(':id_page' => $id_page));
    if($req_page->rowCount() == 0){
        $page_exist = false;
        header('location:../../');
    }else{
        $page_exist = true;
    }
    if($page_exist){
        $info_page = $req_page->fetch();
        return $info_page;
    }
}

function est_insulte_phrase($phrase) {
    $insultes = array("abruti", "salope", "idiot", "fou", "folle", "putain", "impoli", "mal éduqué", "absurde", "enculé", "con", "pute", "merde", "pd", "connard", "aller niquer sa mère", "aller se faire enculer", "aller se faire endauffer", "aller se faire foutre", "aller se faire mettre", "andouille", "appareilleuse", "assimilé", "astèque", "avorton", "bande d’abrutis", "bâtard", "bellicole", "bête", "bête à pleurer", "bête comme ses pieds", "bête comme un chou", "bête comme un cochon", "biatch", "bic", "bicot", "bite", "bitembois", "Bitembois", "bordille", "boudin", "bouffon", "bougnoul", "bougnoule", "Bougnoulie", "bougnoulisation", "bougnouliser", "bougre", "boukak", "boulet", "bounioul", "bourdille", "branleur", "brigand", "brise-burnes", "cacou", "cafre", "cageot", "caldoche", "casse-bonbon", "casse-couille", "casse-couilles", "cave", "chachar", "chagasse", "charlot de vogue", "bite", "fesse", "pénis", "vagin", "sein", "chauffard", "chien de chrétien", "chiennasse", "chienne", "chier", "chinetoc", "chinetoque", "chintok", "chleuh" , "chnoque", "citrouille", "coche", "colon", "con", "con comme la lune", "con comme la Lune", "con comme ses pieds", "con comme un balai", "con comme un manche", "con comme une chaise", "con comme une valise sans poignée", "conasse", "conchier", "connard", "connarde", "connasse", "counifle", "courtaud", "crétin", "crevure", "cricri", "crotté", "crouillat", "crouille", "croûton", "débile", "doryphore", "doxosophe", "doxosophie", "drouille", "du schnoc", "ducon", "duconnot", "dugenoux", "dugland", "duschnock", "emmanché", "emmerder", "emmerdeur", "emmerdeuse", "empafé", "empapaouté", "enculé", "enculé de ta race", "enculer", "enfant de putain", "enfant de pute", "enfant de salaud", "enflure", "enfoiré", "envaselineur", "épais", "espèce de", "espingoin", "étron", "face de chien", "face de pet", "face de rat", "FDP", "fell", "fils de bâtard", "fils de chien", "fils de chienne", "fils de garce", "fils de putain", "fils de pute", "fils de ta race", "fiotte", "folle", "fouteur", "fripouille", "frisé", "fritz", "Fritz", "fumier", "garage à bite", "garce", "gaupe", "GDM", "gland", "glandeur", "glandeuse", "glandouillou", "glandu", "gnoul", "gnoule", "Godon", "gogol", "goï", "gouilland", "gouine", "gourde", "gourgandine", "grognasse", "gueniche", "guide de merde", "guindoule", "habitant", "halouf", "imbécile", "incapable", "islamo-gauchisme", "jean-foutre", "jeannette", "journalope", "Khmer rouge", "Khmer vert", "kikoo", "kikou", "Kraut", "lâche", "lâcheux", "lavette", "lopette", "magot", "makoumé", "mal blanchi", "manche", "mange-merde", "mangeux de marde", "marchandot", "margouilliste", "marsouin", "mauviette", "melon", "merdaille", "merdaillon", "merde", "merdeux", "merdouillard", "michto", "minable", "minus", "misérable", "moinaille", "moins-que-rien", "monacaille", "mongol");

    $mots_phrase = explode(" ", strtolower($phrase));
    
    foreach($insultes as $insulte) {
        foreach($mots_phrase as $mot) {
            if($mot == $insulte) {
                return true;
            }
        }
    }
    
    return false;
}
function SupprimerProduitFromPanier($client_id, $id_produit){
    global $bdd;
    $delete_produit_panier = $bdd->prepare("DELETE FROM panier WHERE id_client = :id_client AND id_produit = :id_produit");
    $delete_produit_panier->execute(array(':id_client' => $client_id, ':id_produit' => $id_produit));
  }
  
?>
