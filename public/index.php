<?php

    // configuration
    require("../includes/config.php"); 

    $rows = query("SELECT * FROM portfolio WHERE id = ?", $_SESSION["id"]);
    $cash = query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
    if ($rows === false || $cash === false)
    {
        apologize("Couldn't load your data");
    }
    
    $positions = [];
    foreach ($rows as $row)
    {
        $stock = lookup($row["symbol"]);
        if ($stock !== false)
        {
            $positions[] = [
                "name" => $stock["name"],
                "currentprice" => $stock["price"],
                "buyprice" => $row["buyprice"],
                "shares" => $row["shares"],
                "symbol" => $row["symbol"],
                "worth" => $stock["price"] * $row["shares"]
            ];
        }
    }

    // render portfolio
    render("portfolio.php", ["positions" => $positions, "cash" => $cash[0]["cash"], "title" => "Portfolio"]);
?>
