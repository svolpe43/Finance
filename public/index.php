<?php

    // configuration
    require("../includes/config.php");
    include '../wa_wrapper/WolframAlphaEngine.php';

    //Get portfolio and username
    $dummy = false;
    $rows = query("SELECT * FROM portfolio WHERE id = ?", $_SESSION["id"]);
    if(count($rows) == 0) $dummy = true;
    else
    {
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
    }
    
    //Get cash
    $user = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
    if ($rows === false || $user === false) apologize("Couldn't load your data");
    
    //Check if there are company details to display
    $companies = [];
    if (!empty($rows))
    {
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
    
    $SessionId = true;
    $username = $user[0]["username"];
    
    //Create the page
    require("../templates/header.php");
    if ($dummy == true)
    {
        require("../templates/default.php");
        require("../templates/portfolio.php");
    }
    else
    {
        require("../templates/portfolio.php");
    }
    require("../templates/footer.php");
?>
