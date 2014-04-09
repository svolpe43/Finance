<?php

    require("../includes/config.php"); 
    require("PHPMailer/class.phpmailer.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["email"]))
        {
            apologize("You have to enter a password.");  
        }
        else
        {
            $mail =new PHPMailer();
        
            $mail->IsSMTP();
            $mail->Host = "smpt.fas.harvard.edu";
            $mail->SetFrom("jharvard@cs50.net");
            $mail->AddAddress($_POST["email"]);
            $mail->Subject = "Forgot password";
            $mail->Body = "Go to the following link to reset your password.\n\n www.bytecontrol.net/resetpassword.php";
            if ($mail->Send() == false)
            {
                //This die thing ain't working.
                //die($mail->ErrInfo);
                render("sentlink.php");
            }
            else
            {
                render("sentlink.php");
            }
        }
    }
    else
    {
        render("forgotform.php", ["title" => "Forgot"]);
    }
?>
