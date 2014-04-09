<?php

    // configuration
    require("../includes/config.php"); 
    
    //Get your required data
    $rows = query("SELECT * FROM history WHERE id = ?", $_SESSION["id"]);
    
    if ($rows === false)
    {
        apologize("Couldn't load your data.");
    }
    
    $positions = [];
    foreach ($rows as $row)
    {
        $positions[] = [
            "name" => $row["name"],
            "symbol" => $row["symbol"],
            "action" => $row["action"],
            "shares" => $row["shares"],
            "price" => $row["price"],
            "time" => $row["time"]
        ];
    }

    //Render history
    render("historytable.php", ["positions" => $positions, "title" => "History"]);
?>
