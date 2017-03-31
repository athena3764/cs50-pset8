<?php

    require(__DIR__ . "/../includes/config.php");

    // numerically indexed array of places
    $places = [];

    // TODO: search database for places matching $_GET["geo"], store in $places
   
    $rows = CS50::query("SELECT * FROM places WHERE MATCH(postal_code, place_name, admin_name1) AGAINST (?)", $_GET["geo"]);
    
    foreach($rows as $row){
     $places[]=[
            "postal_code" => $row["postal_code"],
            "place_name" => $row["place_name"],
            "admin_name1" => $row["admin_name1"]
           ];
   }
   
    // output places as JSON (pretty-printed for debugging convenience)
    header("Content-type: application/json");
    print(json_encode($places, JSON_PRETTY_PRINT));

?>
