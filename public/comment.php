<?php

    // configuration
    require("../includes/config.php");    
    
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["comment"]))
        {
            apologize("You have to enter a comment first!");
        }
        
        $userinfo = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
        if ($userinfo ===false)
        {
            apologize("Couldn't get your user info.");
        }
        
        $result1 = query("INSERT INTO talk (username, comment, time) VALUES(?, ?, CURRENT_TIMESTAMP)", $userinfo[0]["username"], $_POST["comment"]);
        
    }

    $rows = query("SELECT * FROM talk ORDER BY time DESC");
    if ($rows === false)
    {
        apologize("Couldn't load the comment data.");
    }
    
    $positions = [];
    foreach ($rows as $row)
    {
        $positions[] = [
            "username" => $row["username"],
            "comment" => $row["comment"],
            "time" => $row["time"],
            "ref" => $row["ref"]
        ];
    }
    
    render("comments.php", ["positions" => $positions, "title" => "Comments"]);

?>
