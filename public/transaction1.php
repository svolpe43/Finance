<?php

    // configuration
    require("../includes/config.php"); 

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        
        //dump($_SERVER["HTTP_REFERER"]);
        
        //Validate the submission
        if (empty($_POST["company"]))
        {
            apologize("Please enter a stock to sell.");
        }
        if (empty($_POST["shares"]))
        {
            apologize("Please enter an amount.");
        }
    
        //Extract parameters
        $company = $_POST["company"];
        $shares = $_POST["shares"];
        $action = $_POST["action"];

        //Sell stock
        if ($_POST["action"] == "sell")
        {
            sell($company, $shares);
        }
        //Buy stock
        else if ($_POST["action"] == "buy")
        {
            buy($company, $shares);
        }  
    }
?>
