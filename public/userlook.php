<?php

    // configuration
    require("../includes/config.php"); 

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //Get user info
        $rows = query("SELECT * FROM portfolio WHERE id = ?", $_POST["ref"]);
        if ($rows === false)
        {
            apologize("Couldn't load that users data.");
        }
        
        //Make table
        $positions = [];
        foreach ($rows as $row)
        {
            $stock = lookup($row["symbol"]);
            if ($stock !== false)
            {
                $positions[] = [
                    "name" => $stock["name"],
                    "price" => $stock["price"],
                    "shares" => $row["shares"],
                    "symbol" => $row["symbol"],
                    "worth" => $stock["price"] * $row["shares"]
                ];
            }
        }

        // render portfolio
        render("userportfolio.php", ["positions" => $positions, "title" => "User Look Up"]);
    }
?>
