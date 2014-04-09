<?php

    // configuration
    require("../includes/config.php"); 
    
    $userinfos = query("SELECT * FROM users ORDER BY cash DESC");
    if ($userinfos === false)
    {
        apologize("Couldn't load your data.");
    }
    
    $positions = [];
    $rank = 1;
    
    //Cycle through each user
    foreach ($userinfos as $userinfo)
    {
        $stocktotal = 0;
        $total = 0;

        $portfolios = query("SELECT * FROM portfolio WHERE id = ?", $userinfo["id"]);
        
        if ($portfolios !== false)
        {
            //Cycle through each stock
            foreach ($portfolios as $portfolio)
            {
                $thisstock = 0;
                $stock = lookup($portfolio["symbol"]);
                $thisstock = $stock["price"] * $portfolio["shares"];
                $stocktotal += $thisstock;
            } 
        }
        
        $total = $userinfo["cash"] + $stocktotal;
        
        //Set values to give to html
        $positions[] = [
            "rank" => $rank,
            "name" => $userinfo["username"],
            "cash" => $userinfo["cash"],
            "stocktotal" => $stocktotal,
            "total" => $total,
            "userid" => $userinfo["id"]
        ];
        $rank++;
    }
    
    
    //Render history
    render("leaderboard.php", ["positions" => $positions, "title" => "Leaderboard"]);
?>
