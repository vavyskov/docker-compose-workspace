<?php
//error_reporting(-1);
//ini_set("display_errors", 1);

// Text encoding
//mb_internal_encoding("utf-8");

// Email address
$from = "Development Team <devel@example.com>";
$to = "Test <test@example.com>";

// Subject
$subject = "PHP email test";

// Delimiter - the unique string, witch will serve as the boundary for the different parts of the email
// https://www.w3.org/Protocols/rfc1341/7_2_Multipart.html
$boundary=md5(uniqid(rand()));

// Header
$header = "MIME-Version: 1.0" . "\r\n";
$header .= "From: " . $from . "\r\n";
$header .= "Reply-To: " . $to . "\r\n";
$header .= "Content-type: multipart/alternative; boundary=Delimiter_" . $boundary ."\r\n";

// Message - info
$message = "This is multipart message in MIME format" . "\r\n\r\n";

// Message - TEXT version
$message .= "--Delimiter_" . $boundary . "\r\n";
$message .= "Content-Type: text/plain; charset=utf-8" . "\r\n";
$message .= "Content-Transfer-Encoding: 8bit" . "\r\n\r\n";
$message .= 'E-mail works!

This is the "text/plain" email version.

Regards,
Development Team
' . "\r\n";

// Message - HTML version
$message .="--Delimiter_" . $boundary . "\r\n";
$message .="Content-Type: text/html; charset=utf-8" . "\r\n";
$message .= "Content-Transfer-Encoding: 7bit" . "\r\n\r\n";
$message .= '<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>E-mail works!</title>
    <style>
        html {
            height: 100%;
        }
        body {
            margin: 0; 
            background-image: linear-gradient(to bottom right, #ffffff, #62d1e2); 
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }
        .container {
            max-width: 50em; 
            margin-left: auto; 
            margin-right: auto; 
            padding-left: 15px; 
            padding-right: 15px
        }
        header {
            background-color: #343a40; 
            color: #fff; 
            padding-top: 1em; 
            padding-bottom: 1em;
        }
        main {
        
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <table>
                <tr>
                    <td>                        
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" height="96" width="96" style="margin-left: -15px">
                            <path style="fill:#ffffff" d="M272 428v28c0 10.449-6.68 19.334-16 22.629V488c0 13.255-10.745 24-24 24h-80c-13.255 0-24-10.745-24-24v-9.371c-9.32-3.295-16-12.18-16-22.629v-28c0-6.627 5.373-12 12-12h136c6.627 0 12 5.373 12 12zM128 176c0-35.29 28.71-64 64-64 8.837 0 16-7.164 16-16s-7.163-16-16-16c-52.935 0-96 43.065-96 96 0 8.836 7.164 16 16 16s16-7.164 16-16zm64-128c70.734 0 128 57.254 128 128 0 77.602-37.383 60.477-80.98 160h-94.04C101.318 236.33 64 253.869 64 176c0-70.735 57.254-128 128-128m0-48C94.805 0 16 78.803 16 176c0 101.731 51.697 91.541 90.516 192.674 3.55 9.249 12.47 15.326 22.376 15.326h126.215c9.906 0 18.826-6.078 22.376-15.326C316.303 267.541 368 277.731 368 176 368 78.803 289.195 0 192 0z"/>
                        </svg>
                        <!--
                        Font Awesome Free 5.2.0 by @fontawesome - https://fontawesome.com
                        License - https://fontawesome.com/license (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License)
                        style="margin-left: -15px;"
                        -->
                    </td>
                    <td>
                        <h1>E-mail works!</h1>
                    </td>
                </tr>
            </table>
        </div>
    </header>
    <main class="container">
        <p>This is the <strong>HTML</strong> email version.</p>
        <p><em>Regards,<br>Development Team</em></p>
    </main>
</body>
</html>
' . "\r\n\r\n";

// Final delimiter
$message .= "--Delimiter_" . $boundary . "--";

// In case any of our lines are larger than 70 characters, we should use wordwrap()
//$message = wordwrap($message, 70, "\r\n");

// Send email
try {
    echo("\r\n");
    if (!mail($to, $subject, $message, $header))
        throw new Exception("The email can not be sent!");
    echo("The email was sent. Has the email arrived in the mailbox?" . "\r\n\r\n");
}
catch (Exception $e) {
    echo("Error: ". $e->getMessage() . "\r\n\r\n");
}
