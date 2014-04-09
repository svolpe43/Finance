<?php

    // configuration
    require("../includes/config.php"); 

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //Validate the submission
        if (empty($_POST["stock"]))
        {
            apologize("Please enter a stock to buy.");
        }
        if (empty($_POST["amount"]))
        {
            apologize("Please enter an amount.");
        }
        
        //Store the POST
        $amount = $_POST["amount"];
        
        //Obtain all info needed
        $stock = lookup($_POST["stock"]);
        if ($stock === false)
        {
            apologize("I don't think that symbol exists.");
        }
        
        //Get the users cash.
        $userscash = query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
            
        //Calculate cash change
        $cashchange = $stock["price"] * $amount;
        
        //Check if the user has enough money for that.
        if ($amount > $userscash[0]["cash"])
        {
            apologize("You don't have enough money for that.");
        }
        //Add shares or inserts the new row for new company
        else
        {
            $result1 = query("INSERT INTO portfolio (id, symbol, shares) VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE shares = shares + ?", $_SESSION["id"], $stock["symbol"], $amount, $amount);
            if ($result1 === false)
            {
                apologize("Failed to change your portfolio.");
            } 
        }
        redirect("/");     
    }
    else
    {
        render("buyform.php");
    }
    
    
?>
