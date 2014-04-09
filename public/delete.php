<?php

    // configuration
    require("../includes/config.php");    
    
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //Delete the submission   
        $delete = query("DELETE FROM talk WHERE ref = ?", $_POST["ref"]);
        if ($delete ===false)
        {
            apologize("Can't delete that now.");
        } 
    }
    
    redirect("talk.php");

?>
