<?php 
//Will return array of data from file.
require_once('myFunctions.php');
    
$arrFile = fopen($_SERVER["DOCUMENT_ROOT"]."/stats/dailySolve.txt", "r+");
$arrayContents = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/stats/dailySolve.txt");
$array = json_decode($arrayContents);
echo json_encode($array);  





?>