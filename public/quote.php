<?php

    require("../includes/config.php");
    include '../wa_wrapper/WolframAlphaEngine.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    
        //Validate the submission
        if (empty($_POST["q"]))
        {
            apologize("Please enter a symbol to look up."); 
        }
        
        $sources = companydata($_POST["q"]);
        if($sources == false)
        {
            apologize("Couldn't find that stock.");
        }
        else 
        {
            render("quotedisplay.php", [
            "title" => "Quote",
            "sources" => $sources
            ]);
        }
    }
    else
    {
        render("quotehtml.php"); 
    }
?>
