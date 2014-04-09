<?php
    //Registers a new user.

    // configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    
        // everything is entered
        if (empty($_POST["username"]))
        {
            apologize("You must provide your username.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("You must provide your password.");
        }
        else if (empty($_POST["confirmation"]))
        {
            apologize("Make sure to fill in confirmation.");
        }
        
        // password is same as confirmation
        if ($_POST["password"] == $_POST["confirmation"])
        {
            //enter new user
            query("INSERT INTO users (username, hash, cash) VALUES(?, ?, 10000.00)", $_POST["username"], crypt($_POST["password"]));
            
            //check for success
            if ( query === false)
            {
                apologize("Unable to process the new information at this time.");
            }
            else
            {
                //login
                $rows = query("SELECT LAST_INSERT_ID() AS id");
                $_SESSION["id"] = $rows[0]["id"];
                redirect("/");
            }
               
        }
       
    }
    else
    {
        // else render form
        render("registerhtml.php", ["title" => "Register"]);
    }


?>

