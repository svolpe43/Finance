<?php

    // configuration
    require("../includes/config.php"); 

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
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
            if ($result1 !== false)
            {
                apologize("Delted the row.");
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
        
        redirect("/");
              
    }
    else
    {
        render("sellform.php");
    }
    
    
?>
