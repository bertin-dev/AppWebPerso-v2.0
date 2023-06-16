<?php

//------------1ERE METHODE

require '../../App/Config/Config_Server.php';
session_start();
$connexion = App::getDB();

// 2EME METHODE

function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}


// Select all the rows in the markers table
$result = $connexion->getTabAssociatif('SELECT * FROM all_visitor WHERE 1');
if (!$result) {
  echo ('Requête invalide: ');
  exit();
}



header("Content-type: text/xml");

// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";
echo '<markers>';
$ind=0;
// Iterate through the rows, printing XML nodes for each
while($row = $result->fetch(PDO::FETCH_ASSOC)){
  // Add to XML document node

  echo '<marker ';
  echo 'id_visitor="' . $row['id_visitor'] . '" ';
  echo 'ip_visitor="' . parseToXML($row['ip_visitor']) . '" ';
  echo 'continent="' . parseToXML($row['continent']) . '" ';
  echo 'pays="' . parseToXML($row['pays']) . '" ';
  //echo 'ville="' . parseToXML($row['ville']) . '" ';
  echo 'region="' . parseToXML($row['region']) . '" ';
  echo 'region_name="' . parseToXML($row['region_name']) . '" ';
  echo 'time_zone="' . parseToXML($row['time_zone']) . '" ';
  echo 'symbole="' . parseToXML($row['symbole']) . '" ';
  echo 'statut_visitor="' . parseToXML($row['statut_visitor']) . '" ';
  echo 'heure_arrive_visitor="' . $row['heure_arrive_visitor'] . '" ';
  echo 'heure_depart="' . $row['heure_depart'] . '" ';
  echo 'duree="' . $row['duree'] . '" ';
  echo 'latitude="' . $row['latitude'] . '" ';
  echo 'longitude="' . $row['longitude'] . '" ';
  echo 'convert_money_in_fcfa="' . parseToXML($row['convert_money_in_fcfa']) . '" ';
  echo '/>';
  $ind = $ind + 1;
}

// End XML file
echo '</markers>';


// Start XML file, create parent node
/*
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a MySQL server

// Select all the rows in the markers table
$result = $connexion->getTabAssociatif('SELECT * FROM all_visitor WHERE 1');
if (!$result) {
    echo ('Requête invalide: ');
    exit();
}


header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

while ($row = $result->fetch(PDO::FETCH_ASSOC)){
    // Add to XML document node
    $node = $dom->createElement("marker");
    $newnode = $parnode->appendChild($node);
    $newnode->setAttribute("id_visitor",$row['id_visitor']);
    $newnode->setAttribute("ip_visitor",$row['ip_visitor']);
    $newnode->setAttribute("continent", $row['continent']);
    $newnode->setAttribute("pays", $row['pays']);
    $newnode->setAttribute("ville", $row['ville']);
    $newnode->setAttribute("region", $row['region']);
    $newnode->setAttribute("region_name", $row['region_name']);
    $newnode->setAttribute("time_zone", $row['time_zone']);
    $newnode->setAttribute("symbole", $row['symbole']);
    $newnode->setAttribute("statut_visitor", $row['statut_visitor']);
    $newnode->setAttribute("heure_arrive_visitor", $row['heure_arrive_visitor']);
    $newnode->setAttribute("heure_depart", $row['heure_depart']);
    $newnode->setAttribute("duree", $row['duree']);
    $newnode->setAttribute("lat", $row['latitude']);
    $newnode->setAttribute("lng", $row['longitude']);
}

echo $dom->saveXML();

*/