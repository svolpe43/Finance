<?php

    // configuration
    require("../includes/config.php");
    include '../wa_wrapper/WolframAlphaEngine.php'; 

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //Get user info
        $rows = query("SELECT * FROM portfolio WHERE id = ?", $_POST["userid"]);
        $username = query("SELECT username FROM users WHERE id = ?", $_POST["userid"]);
        if ($rows === false||$username === false) apologize("Couldn't load that users data.");
        
        //Make table
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
        
        //Check if there are company details to display
        $companies = [];
        if (!empty($rows))
        {
            $dummy = false;
            $count = 1;
            foreach($rows as $row)
            {
                $sources = companydata($row["symbol"]);
                $stock = lookup($row["symbol"]);
                $companies[] = [
                    "ref" => $count,
                    "name" => $stock["name"],
                    "data" => $sources
                ];
                $count++;
            }
        }
        else
        {
            apologize("That user doesn'y own any stock");
            //$dummy = true;
        }
    }
    
    $username = $username[0]["username"];
    $SessionId = false;
    require("../templates/header.php");
    require("../templates/portfolio.php");
    require("../templates/footer.php");
?>
