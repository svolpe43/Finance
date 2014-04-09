<?php

    // configuration
    require("../includes/config.php"); 

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        
        //dump($_SERVER["HTTP_REFERER"]);
        
        //Validate the submission
        if (empty($_POST["stock"]))
        {
            apologize("Please enter a stock to sell.");
        }
        if (empty($_POST["amount"]))
        {
            apologize("Please enter an amount.");
        }
        
        //Store the POST
        $amount = $_POST["amount"];
        
        //Obtain stock info
        $stock = lookup($_POST["stock"]);
        if ($stock === false)
        {
            apologize("I don't think that symbol exists.");
        }
        
        //Get the users cash.
        $userscash = query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
        if ($userscash === false)
        {
            apoogize("Could not get your cash.");
        }
        
        if ($_POST["action"] == "sell")
        {
            $usershares = query("SELECT shares FROM portfolio WHERE id = ? AND symbol = ?", $_SESSION["id"], $stock["symbol"]);
            
            //Calculate cash change
            $cashchange = $stock["price"] * $amount;
            
            //Check if the user has enough shares to sell
            if ($amount > $usershares[0]["shares"])
            {
                apologize("You don't have that many shares.");
            }
            //Delete row if he sold everything
            else if ($amount == $usershares[0]["shares"])
            {
                $result1 = query("DELETE FROM portfolio WHERE id = ? AND symbol = ?", $_SESSION["id"], $stock["symbol"]);
                if ($result1 === false)
                {
                    apologize("Couldn't sell you stock.");
                } 
            }
            //Change shares and 
            else
            {
                $result2 = query("UPDATE users SET cash = cash + ? WHERE id = ?", $cashchange, $_SESSION["id"]);
                $result3 = query("UPDATE portfolio SET shares = shares - ? WHERE id = ? AND symbol = ?", $amount , $_SESSION["id"], $stock["symbol"]);
                if ($result2 === false || $result3 === false)
                {
                    apoogize("Could not make the query.");
                } 
            }
            
            //Update the current cash
            $currentcash = $userscash[0]["cash"] + $cashchange;
        }
        else if ($_POST["action"] == "buy")
        {
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
                $result1 = query("INSERT INTO portfolio (id, symbol, shares, buyprice) VALUES(?, ?, ?, ?) 
                    ON DUPLICATE KEY UPDATE shares = shares + ?, buyprice = ?", $_SESSION["id"], $stock["symbol"], $amount, $stock["price"], $amount, $stock["price"]);
                
                $result2 = query("UPDATE users SET cash = cash - ? WHERE id = ?", $cashchange, $_SESSION["id"]);
                if ($result1 === false || $result2 === false)
                {
                    apologize("Failed to change your portfolio.");
                } 
            }
            
            //Update current cash
            $currentcash = $userscash[0]["cash"] - $cashchange;
        }
        
        //Add the entry to the history.
        $result4 = query("INSERT INTO history (id, name, symbol, action, shares, price, time) VALUES(?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)", $_SESSION["id"], $stock["name"], $stock["symbol"], $_POST["action"], $amount, $stock["price"]);
        if ($result4 === false)
        {
            apologize("Failed to enter into user history.");
        }
        
        //Render the buy or sell done pages.
        if ($_POST["action"] == "sell")
        {
            render("selldone.php", [
                "amount" => $amount,
                "name" => $stock["name"],
                "price" => $stock["price"],
                "cashchange" => $cashchange,
                "cash" => $currentcash,
                "title" => "Sold!"]);
        }
        else if ($_POST["action"] == "buy")
        {
            render("buydone.php", [
                "amount" => $amount, 
                "name" => $stock["name"],
                "price" => $stock["price"],
                "cashchange" => $cashchange,
                "cash" => $currentcash,
                "title" => "Bought!"]);
        }
        //redirect("/");
        
    }
?>
