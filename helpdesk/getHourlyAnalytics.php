<?php 
//Will return array of data from file.
require_once('myFunctions.php');
    
$arrFile = fopen($_SERVER["DOCUMENT_ROOT"]."/stats/hourlyArray.txt", "r+");
$arrayContents = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/stats/hourlyArray.txt");
$array = json_decode($arrayContents);

if($arrayContent){
    
    
 
   
} else {
  echo json_encode($array);  
}




?>