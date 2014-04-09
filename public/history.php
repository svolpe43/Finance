<?php

    // configuration
    require("../includes/config.php"); 
    
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //If post get requested user history
        $rows = query("SELECT * FROM history WHERE id = ?", $_POST["user"]);
        if ($rows === false)
        {
            apologize("Couldn't load your data.");
        }
    }
    else
    {
        //If link get current user history
        $rows = query("SELECT * FROM history WHERE id = ?", $_SESSION["id"]);
        if ($rows === false)
        {
            apologize("Couldn't load your data.");
        }
    }
    
    //Init table array
    $order = count($rows);
    $positions = [];
    foreach ($rows as $row)
    {
        $positions[] = [
            "order" => $order,
            "name" => $row["name"],
            "symbol" => $row["symbol"],
            "action" => $row["action"],
            "shares" => $row["shares"],
            "price" => $row["price"],
            "total" => $row["total"],
            "time" => $row["time"]
        ];
        $order--;
    }

    $positions = record_sort($positions, "order");

    //Render history page
    render("historytable.php", ["positions" => $positions, "title" => "History"]);
?>
