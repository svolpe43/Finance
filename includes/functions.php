<?php

    /**
     * functions.php
     * Helper functions.
     */

    require_once("constants.php");

    /**
     * Makes the array of data for a company
     */
     function buy($company, $shares)
     {
        $action = "Buy";
        
        //look up the stock
        $stock = lookup($company);
        if ($stock === false) apologize("I don't think that symbol exists.");
        
        //Get the users cash
        $userscash = query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
        if ($userscash === false) apoogize("Could not get your cash.");
        
        $cashchange = -$stock["price"] * $shares;
            
        //Check cash restriction
        if ($cashchange > $userscash[0]["cash"]) apologize("You don't have enough money for that.");
        
        //Add shares or inserts the new row for new company
        else
        {
            $result1 = query("INSERT INTO portfolio (id, symbol, shares, buyprice) VALUES(?, ?, ?, ?) 
                ON DUPLICATE KEY UPDATE shares = shares + ?, buyprice = ?", $_SESSION["id"], $stock["symbol"], $shares, $stock["price"], $shares, $stock["price"]);
            if ($result1 === false) apologize("Failed to change your portfolio.");
        }
            
        //Update current cash
        $result2 = query("UPDATE users SET cash = cash + ? WHERE id = ?", $cashchange, $_SESSION["id"]);
        if ($result2 === false) apologize("Failed to change your portfolio.");
        
        //Add the entry to the history.
        $result4 = query("INSERT INTO history (id, name, symbol, action, shares, price, total, time) VALUES(?, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)",
                $_SESSION["id"], $stock["name"], $stock["symbol"], $_POST["action"], $shares, $stock["price"], $cashchange);
        if ($result4 === false) apologize("Failed to enter into user history.");

        redirect("/public/index.php?action=".$action."&shares=".$shares."&name=".$stock['name']."&price=".$stock['price']."&change=".$cashchange);
        
     }
     
     /**
     * Makes the array of data for a company
     */
    function sell($company, $shares)
    {
        $action = "Sell";
        
        $stock = lookup($_POST["company"]);
        if ($stock === false) apologize("I don't think that symbol exists.");
        
        //Get the users cash.
        $usercash = query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
        $usershares = query("SELECT shares FROM portfolio WHERE id = ? AND symbol = ?", $_SESSION["id"], $stock["symbol"]);
        if ($usercash === false || $usershares === false) apoogize("Could not get your cash.");
        
        //Calculate cash change
        $cashchange = $stock["price"] * $shares;
        
        //Check shares restriction
        if ($shares > $usershares[0]["shares"]) apologize("You don't have that many shares.");
        //Delete row if he sold everything
        else if ($shares == $usershares[0]["shares"])
        {
            $result1 = query("DELETE FROM portfolio WHERE id = ? AND symbol = ?", $_SESSION["id"], $stock["symbol"]);
            if ($result1 === false) apologize("Couldn't sell you stock.");
        }
        //Change cash and shares
        else
        {
            $result2 = query("UPDATE portfolio SET shares = shares - ? WHERE id = ? AND symbol = ?", $shares , $_SESSION["id"], $stock["symbol"]);
            if ($result2 === false) apoogize("Could not make the query.");
        }
        
        //dump($cashchange);
        //Change user cash value TODO
        $result3 = query("UPDATE users SET cash = cash + ? WHERE id = ?", $cashchange, $_SESSION["id"]);
        if ($result3 === false) apoogize("Could not make the query.");
        
        //Add the entry to the history.
        $result4 = query("INSERT INTO history (id, name, symbol, action, shares, price, total, time) VALUES(?, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)",
                $_SESSION["id"], $stock["name"], $stock["symbol"], $_POST["action"], $shares, $stock["price"], $cashchange);
        if ($result4 === false) apologize("Failed to enter into user history.");

        redirect("/public/index.php?action=".$action."&shares=".$shares."&name=".$stock['name']."&price=".$stock['price']."&change=".$cashchange);
        
    }
    
    function companydata($q)
    {
        $input = $q." stock";
        $appID = 'XRP57G-QYEVTWGTLL';

        // instantiate an engine object with your app id
        $engine = new WolframAlphaEngine( $appID );
        $response = $engine->getResults( $input );

        // we can check if there was an error from the response object
        if ( $response->isError() == true )
        {
            apologize("There was an error in the request");
            die();
        }

        //check if there is content
        if ( count($response->getPods()) == 0 )
        {
            apologize("Nothing was found for that company.");
        }
        
        //Create the company profile
        $sources = [];
        foreach ( $response->getPods() as $pod )
        {
            foreach ($pod->getSubpods() as $subpod )
            {
                $sources[] = [
                "img" => $subpod->image->attributes['src'],
                "title" => $pod->attributes['title']
                ];
            }
        }
        return $sources;
    }

    /**
     * Sorts an array by a certain index
     */
     
     function record_sort($records, $field, $reverse=false)
    {
        $hash = array();
        
        foreach($records as $record)
        {
            $hash[$record[$field]] = $record;
        }
        
        ($reverse)? krsort($hash) : ksort($hash);
        
        $records = array();
        
        foreach($hash as $record)
        {
            $records []= $record;
        }
        
        return $records;
    }
    
    /**
     * Apologizes to user with message.
     */
     
    function apologize($message)
    {
        render("apology.php", ["message" => $message]);
        exit;
    }

    /**
     * Facilitates debugging by dumping contents of variable
     * to browser.
     */
    function dump($variable)
    {
        require("../templates/dump.php");
        exit;
    }

    /**
     * Logs out current user, if any.  Based on Example #1 at
     * http://us.php.net/manual/en/function.session-destroy.php.
     */
    function logout()
    {
        // unset any session variables
        $_SESSION = [];

        // expire cookie
        if (!empty($_COOKIE[session_name()]))
        {
            setcookie(session_name(), "", time() - 42000);
        }

        // destroy session
        session_destroy();
    }

    /**
     * Returns a stock by symbol (case-insensitively) else false if not found.
     */
    function lookup($symbol)
    {
        // reject symbols that start with ^
        if (preg_match("/^\^/", $symbol))
        {
            return false;
        }

        // reject symbols that contain commas
        if (preg_match("/,/", $symbol))
        {
            return false;
        }

        // open connection to Yahoo
        $handle = @fopen("http://download.finance.yahoo.com/d/quotes.csv?f=snl1d1t1&s=$symbol", "r");
        if ($handle === false)
        {
            // trigger (big, orange) error
            trigger_error("Could not connect to Yahoo!", E_USER_ERROR);
            exit;
        }

        // download first line of CSV file
        $data = fgetcsv($handle);
        if ($data === false || count($data) == 1)
        {
            return false;
        }

        // close connection to Yahoo
        fclose($handle);

        // ensure symbol was found
        if ($data[2] === "0.00")
        {
            return false;
        }
        
        //dump($data);

        // return stock as an associative array
        return [
            "symbol" => $data[0],
            "name" => $data[1],
            "price" => $data[2],
            "date" => $data[3],
            "time" => $data[4]
        ];
    }

    /**
     * Executes SQL statement, possibly with parameters, returning
     * an array of all rows in result set or false on (non-fatal) error.
     */
    function query(/* $sql [, ... ] */)
    {
        // SQL statement
        $sql = func_get_arg(0);

        // parameters, if any
        $parameters = array_slice(func_get_args(), 1);

        // try to connect to database
        static $handle;
        if (!isset($handle))
        {
            try
            {
                // connect to database
                $handle = new PDO("mysql:dbname=" . DATABASE . ";host=" . SERVER, USERNAME, PASSWORD);

                // ensure that PDO::prepare returns false when passed invalid SQL
                $handle->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
            }
            catch (Exception $e)
            {
                // trigger (big, orange) error
                trigger_error($e->getMessage(), E_USER_ERROR);
                exit;
            }
        }

        // prepare SQL statement
        $statement = $handle->prepare($sql);
        if ($statement === false)
        {
            // trigger (big, orange) error
            trigger_error($handle->errorInfo()[2], E_USER_ERROR);
            exit;
        }

        // execute SQL statement
        $results = $statement->execute($parameters);

        // return result set's rows, if any
        if ($results !== false)
        {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            return false;
        }
    }

    /**
     * Redirects user to destination, which can be
     * a URL or a relative path on the local host.
     *
     * Because this function outputs an HTTP header, it
     * must be called before caller outputs any HTML.
     */
    function redirect($destination)
    {
        // handle URL
        if (preg_match("/^https?:\/\//", $destination))
        {
            header("Location: " . $destination);
        }

        // handle absolute path
        else if (preg_match("/^\//", $destination))
        {
            $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
            $host = $_SERVER["HTTP_HOST"];
            header("Location: $protocol://$host$destination");
        }

        // handle relative path
        else
        {
            // adapted from http://www.php.net/header
            $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
            $host = $_SERVER["HTTP_HOST"];
            $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
            header("Location: $protocol://$host$path/$destination");
        }

        // exit immediately since we're redirecting anyway
        exit;
    }

    /**
     * Renders template, passing in values.
     */
    function render($template, $values = [])
    {
        // if template exists, render it
        if (file_exists("../templates/$template"))
        {
            // extract variables into local scope
            extract($values);

            // render header
            require("../templates/header.php");

            // render template
            require("../templates/$template");

            // render footer
            require("../templates/footer.php");
        }

        // else err
        else
        {
            trigger_error("Invalid template: $template", E_USER_ERROR);
        }
    }

?>
