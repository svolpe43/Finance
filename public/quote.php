<?php

    require("../includes/config.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //Validate the submission
        if (empty($_POST["symbol"]))
        {
            apologize("Please enter a symbol to look up.");
            
        }
        
        $stock = lookup($_POST["symbol"]);
        
        //Check if symbol was found
        if ($stock === false)
        {
            apologize("This symbol does not exist.");
        }
        
        //dump($stock);
        
        //redirect("/quotedisplay.php");
        
        //Also works but doens't open up new page. And Please get rid of the dumb double picture.
        render("quotedisplay.php", [
            "title" => "Quote", 
            "symbol" => $stock["symbol"],
            "name" => $stock["name"],
            "price" => number_format($stock["price"], 2, '.', ','),
            "date" => $stock["date"],
            "time" => $stock["time"]]);
    }
    else
    {
        render("quotehtml.php"); 
    }
    

?>
