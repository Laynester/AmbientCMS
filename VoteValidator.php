<?php
require_once 'includes/findretros/config.php';
require_once 'includes/findretros/findretros.php';

$findRetros = new FindRetros();

if(!$FindRetros->hasClientVoted()) {

     $FindRetros->redirectClientToVote();

}

?>
