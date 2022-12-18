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
$message .= 'Objednávka

Vážený zákazníku, Vaši objednávku jsme v pořádku přijali.
Kód objednávky: 20010194 Datum: 3.5.2020

Obsah objednávky

Kód: 57
Položka: Dárkový balíček
Mn.: 1
Cena za kus: 100 Kč
Cena: 100 Kč

Kód: -
Položka: Doprava zdarma
Mn.: 1
Cena za kus: 0 Kč
Cena: 0 Kč

Kód: -
Položka: Platba - Online platba kartou
Mn.: 1
Cena za kus: 0 Kč
Cena: 0 Kč

CENA CELKEM: 100 Kč
Zaokrouhlení: 0 Kč

Fakturační údaje

Jméno: Fiktivní Osoba
Firma:
IČ:
DIČ:
Ulice: Víta Nejedlého
Město: Vyškov
Okres:
PSČ: 68201
Stát: Česká republika
Email: fiktivni@email.cz

Telefon: 420123456789
Poznámka:

Doručovací údaje

Jméno: Fiktivní Osoba
Firma:
Ulice: Víta Nejedlého
Město: Vyškov
PSČ: 68201
Stát: Česká republika

Děkujeme za objednávku.

S přátelskými pozdravy,
Development Team
tel.:  123456789
email: test@example.com

Příloha: Obchodní podmínky

E-mail odeslán z example.com
' . "\r\n";

// Message - HTML version
$message .="--Delimiter_" . $boundary . "\r\n";
$message .="Content-Type: text/html; charset=utf-8" . "\r\n";
$message .= "Content-Transfer-Encoding: 7bit" . "\r\n\r\n";
$message .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="content-language" content="cs" />
    <title>E-mail works!</title>
    <style>@import url(https://fonts.googleapis.com/css?family=Noto+Sans:400,700&subset=latin,latin-ext);</style>
    <style media="screen">
        html { width: 100%; }
        body { width: 100%; margin:0; padding:0; -webkit-font-smoothing: antialiased; color: #474747; line-height: 1.5; -ms-text-size-adjust: 200%; }
        h1, h2, h3, h4 { margin: 20px 0; padding: 0; }
        p { margin-top: 10px; margin-bottom: 0; padding: 0; }
        p.MsoNormal { mso-margin-top-alt: 0; mso-margin-bottom-alt: 0; }
        table { border: 0; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }
        img { margin: 0; }
        .imgfix { display: block; }

        /*------ font ------ */
        body, strong, table, div, a, p, h1, h2, h3, h4, span, .MsoNormal { font-family: "Noto Sans", Arial, sans-serif !important; }
        body,  h1, h2, h3, h4, .MsoNormal { font-weight: 400; }
        h1 { font-size: 18px !important; text-transform: uppercase; color: #000000; }
        h2 { font-size: 17px !important; color: #000000; }
        table, .MsoNormal { font-size: 13px !important; }
        a { text-decoration: none; color: #f5756c; }
        a:hover { text-decoration: underline; }
        span.small { font-size: 11px !important; }
        strong.highlight { color: #000000; }
        .info-text { color: #999; }

        /*----- logo -------*/
        .logo img { max-width: 560px !important; width: auto !important; max-width: none !important; height: auto; }

        /* ----------- container ----------- */
        .main-text { padding: 0 10px; }

        /* ----------- order content ----------- */
        .order-content th, .order-content td { padding: 5px; border-bottom: 1px solid #efefef; -ms-text-size-adjust: 100%; }
        .order-content tr th:first-child, .order-content tr td:first-child { padding: 5px 5px 5px 0; }
        .order-content tr th:last-child, .order-content tr td:last-child { padding: 5px 0 5px 5px; }
        .order-content img { vertical-align: middle; }

        /* ----------- responsivity ----------- */
        @media only screen and (max-width: 800px) {
            /*-------- container --------*/
            .container800, .container780, .container740, .main-content { width: 100% !important; }

            /*-------- envelope graphique ------------*/
            .envelope-top800 { width: 100% !important; }
            .envelope-top800 img { width: 100% !important; }

            .middle-envelope800 { width: 100% !important; }
            .middle-envelope800 .left, .middle-envelope800 .right { width: 35% !important; }
            .middle-envelope800 .left img, .middle-envelope800 .right img { width: 100% !important; }

            .bottom-envelope800 { width: 100% !important; }
            .bottom-envelope800 .left, .bottom-envelope800 .right { width: 20.5% !important; }
            .bottom-envelope800 .left img, .bottom-envelope800 .right img { width: 100% !important; }
            .sign-text { line-height: 20px !important; color: #acacac; }

            #email-template .imgfix-wrap, #email-template .imgfix { height: auto !important; }
        }

        @media only screen and (max-width: 640px) {
            /*----- global -------*/
            .hide-for-small { display: none; }
        }

        @media only screen and (max-width: 479px) {
            /*------ font ------ */
            .order-content { font-size: 11px !important; }

            /*----- logo -------*/
            .logo img { max-width: 260px !important; height: auto !important; }

            /* ----------- order content ----------- */
            .order-content th, .order-content td { padding: 0 2px; }

            /*-------- envelope graphique ------------*/
            .envelope-top800, .middle-envelope800, .bottom-envelope800 { width: 98% !important; }

            /*-------- footer ------------*/
            /*-------- envelope graphique ------------*/
            .sign-text { line-height: 20px !important; }
        }

        @media only screen and (max-width: 330px) {
            .envelope-top800, .middle-envelope800, .bottom-envelope800 { width: 97% !important; }
        }

        .hide-for-portrait {
            display: table-cell !important;
        }

        @media screen and (orientation: landscape) {
            .hide-for-portrait {
                display: table-cell !important;
            }
        }

        @media screen and (orientation: portrait) {
            .hide-for-portrait {
                display: none !important;
            }
        }

        .hide-for-landscape,
        .show-for-portrait {
            display: none !important;
        }

        @media screen and (orientation: landscape) {
            .hide-for-landscape,
            .show-for-portrait {
                display: none !important;
            }
        }

        @media screen and (orientation: portrait) {
            .hide-for-landscape,
            .show-for-portrait {
                display: table-cell !important;
            }
        }

    </style>
    <!--[if mso]>
    <style>
        body, strong, table, div, p, a, h1, h2, h3, h4, span, .MsoNormal { font-family: Arial, sans-serif !important; }
    </style>
    <![endif]-->
    <!--[if !mso]>
    <style media="print">
        * { background: none !important }
        body { width: 100%; margin:0; padding:0; -webkit-font-smoothing: antialiased; color: #474747; line-height: 1.15; -ms-text-size-adjust: 200%; }
        h1, h2, h3, h4 { margin: 7px 0; padding: 0; }
        h1 { margin-top: 0; }
        p { margin: 7px 0 0; padding: 0; }
        table { border: 0; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; padding: 0; }
        img { margin: 0; }

        /*------ font ------ */
        body, strong, table, div, a, p, h1, h2, h3, h4, span, .MsoNormal { font-family: Arial, sans-serif !important; font-weight: 400; }
        h1 { font-size: 16px !important; text-transform: uppercase; color: #000000; }
        h2 { font-size: 15px !important; color: #000000; }
        p, strong, table, .main-text, .MsoNormal { font-size: 11px !important; }
        a { text-decoration: none; color: #f5756c; }
        a:hover { text-decoration: underline; }
        strong.highlight { color: #000000; }

        .hide-for-print { display: none !important; }

        .container800, .container780, .container740, .main-content { width: 100%; }

    </style>
    <![endif]-->
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgcolor="efefef">


<table id="email-template" border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="efefef">

    <!----------- preheader ------------->
    <tr class="hide-for-print">
        <td height="40" class="preheader" style="color: #efefef; font-size: 1px; visibility: hidden;">
            Objednávka
            Vážený zákazníku, Vaši objednávku jsme v pořádku přijali.
            Kód objednávky: 20010194 Datum: 3.5.2020

            Obsah...
        </td>
    </tr>
    <!----------- end preheader ------------->

    <tr>
        <td align="center">
            <table width="800" cellpadding="0" align="center" cellspacing="0" border="0" class="container800">
                <tr>
                    <td class="hide-for-print" align="center" valign="top">
                        <img align="top" src="https://swo.vavyskov.cz/assets/email/page-shadow-left.png" style="display: block; width: 10px; height: 294px;" width="10" height="294" border="0" alt="" />
                    </td>

                    <td align="center" bgcolor="#ffffff">
                        <table border="0" align="center" width="780" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="container780">
                            <tr class="hide-for-print"><td height="1"></td></tr>
                            <tr>
                                <td>
                                    <table border="0" align="center" width="750" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="main-content">

                                        <tr class="hide-for-print"><td height="25"></td></tr>
                                        <!----------- logo ------------->
                                        <tr class="hide-for-print" mc:repeatable>
                                            <td>
                                                <table border="0" align="center" width="740" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="container740">

                                                    <tr>
                                                        <td align="center" class="logo" width="740">
                                                            <a href="https://swo.vavyskov.cz/" style="display: block; max-width: 100px; max-height: 100px; border-style: none !important; border: 0 !important;">
                                                                <img editable="true" mc:edit="logo" height="75" border="0" style="display: block; max-width: 75px; max-height: 75px" src="cid:0a7eefd8fbcdb27974c1561c910fcff3@phpmailer.0" alt=" " />
                                                            </a>
                                                        </td>
                                                    </tr>

                                                </table>
                                            </td>
                                        </tr>
                                        <tr class="hide-for-print" mc:repeatable><td height="40"></td></tr>
                                        <!----------- end logo ------------->

                                        <!----------- main text ------------->


                                        <tr mc:repeatable>
                                            <td align="center">
                                                <table border="0" width="740" align="center" cellpadding="0" cellspacing="0" class="container740">
                                                    <tr>
                                                        <td align="left" mc:edit="main-text" style="color: #474747; font-size: 13px;" class="main-text">
                                                            <h1>Objednávka</h1>
                                                            <p>Vážený zákazníku,<br /> Vaši objednávku jsme v pořádku přijali.</p>
                                                            <p>Kód objednávky: 20010194<br /> Datum: 3.5.2020</p>
                                                            <p></p>
                                                            <h2>Obsah objednávky</h2>
                                                            <p>    <table class="order-content" align="center" width="100%" style="color: #474747;">
                                                                <thead>
                                                                <tr>
                                                                    <th style="width: 40px">
                                                                        &nbsp;
                                                                    </th>
                                                                    <th class="hide-for-small" align="left" style="text-align: left;">
                                                                        Kód
                                                                    </th>
                                                                    <th align="left" style="text-align: left;">
                                                                        Položka
                                                                    </th>
                                                                    <th align="left" style="text-align: left;">
                                                                        Mn.
                                                                    </th>
                                                                    <th class="hide-for-small" align="right" style="text-align: right;">
                                                                        Cena za kus
                                                                    </th>
                                                                    <th align="right" style="text-align: right;">
                                                                        Cena
                                                                    </th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <img src="https://swo.vavyskov.cz/assets/email/order.png" alt=" "  />
                                                                    </td>
                                                                    <td class="hide-for-small">
                                                                        57
                                                                    </td>
                                                                    <td align="left" style="text-align: left;">
                                                                        <a href="https://swo.vavyskov.cz/" title="Dárkový balíček">Dárkový balíček</a>
                                                                    </td>
                                                                    <td align="left" style="text-align: left;">
                                                                        1
                                                                    </td>
                                                                    <td class="hide-for-small" align="right" style="text-align: right;" nowrap>
                                                                        100 Kč
                                                                    </td>
                                                                    <td align="right" style="text-align: right;" nowrap>
                                                                        100 Kč
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                    </td>
                                                                    <td class="hide-for-small">

                                                                    </td>
                                                                    <td align="left" style="text-align: left;">
                                                                        Doprava zdarma
                                                                    </td>
                                                                    <td align="left" style="text-align: left;">
                                                                        1
                                                                    </td>
                                                                    <td class="hide-for-small" align="right" style="text-align: right;" nowrap>
                                                                        0 Kč
                                                                    </td>
                                                                    <td align="right" style="text-align: right;" nowrap>
                                                                        0 Kč
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                    </td>
                                                                    <td class="hide-for-small">

                                                                    </td>
                                                                    <td align="left" style="text-align: left;">
                                                                        Platba
                                                                        - Online platba kartou
                                                                    </td>
                                                                    <td align="left" style="text-align: left;">
                                                                        1
                                                                    </td>
                                                                    <td class="hide-for-small" align="right" style="text-align: right;" nowrap>
                                                                        0 Kč
                                                                    </td>
                                                                    <td align="right" style="text-align: right;" nowrap>
                                                                        0 Kč
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>

                                                            <table width="100%">
                                                                <tr>
                                                                    <td align="right" style="text-align: right;">
                                                                        <br /><br />
                                                                        <strong class="highlight">
                                                                            CENA CELKEM: 100 Kč
                                                                        </strong>
                                                                        <br />
                                                                        <span class="small">
                                                                            Zaokrouhlení: 0 Kč<br />
                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                            </table>

                                                            <br />

                                                            </p>
                                                            <h2>Fakturační údaje</h2>
                                                            <p><table cellspacing="5">
                                                                <tr>
                                                                    <td>Jméno:</td>
                                                                    <td>Fiktivní Osoba</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Firma:</td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>IČ:</td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>DIČ:</td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Ulice:</td>
                                                                    <td>Víta Nejedlého</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Město:</td>
                                                                    <td>Vyškov</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Okres:</td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>PSČ:</td>
                                                                    <td>68201</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Stát:</td>
                                                                    <td>Česká republika</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Email:</td>
                                                                    <td>fiktivni@email.cz</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Telefon:</td>
                                                                    <td>+420123456789</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Poznámka:</td>
                                                                    <td></td>
                                                                </tr>
                                                            </table>
                                                            </p>
                                                            <h2>Doručovací údaje</h2>
                                                            <p><table cellspacing="5">
                                                            <tr>
                                                                <td>Jméno:</td>
                                                                    <td>Fiktivní Osoba</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Firma:</td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Ulice:</td>
                                                                    <td>Víta Nejedlého</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Město:</td>
                                                                    <td>Vyškov</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>PSČ:</td>
                                                                    <td>68201</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Stát:</td>
                                                                    <td>Česká republika</td>
                                                                </tr>                                                            
                                                            </table></br>
                                                            </p>
                                                            <p>Děkujeme za objednávku.</p>
                                                            <p><p>
                                                                S přátelskými pozdravy,<br />
                                                                Development Team<br />
                                                                tel.:  123456789<br />
                                                                email: test@example.com
                                                            </p>
                                                            </p>
                                                            <p>Příloha: Obchodní podmínky</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <!----------- end main text ------------->

                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>

                    <td class="hide-for-print" align="center" valign="top">
                        <img align="top" src="https://swo.vavyskov.cz/assets/email/page-shadow-right.png" style="display: block; width: 10px; height: 294px;" width="10" height="294" border="0" alt="" />
                    </td>

                </tr>
            </table>
        </td>
    </tr>

    <!-------------- footer ------------->
    <tr class="hide-for-print">
        <td align="center">
            <table width="800" cellpadding="0" align="center" cellspacing="0" border="0" class="envelope-top800">
                <tr>
                    <td class="imgfix-wrap" align="center" valign="top" height="16" style="line-height: 0; font-size: 6px; height: 16px;">
                        <img class="imgfix" editable="false" src="https://swo.vavyskov.cz/assets/email/envelope-top-back.png" style="display: block; width: 800px; height: 16px;" width="800" height="16" alt="" align="left" border="0" />
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr class="hide-for-print">
        <td align="center">
            <table width="800" cellpadding="0" align="center" cellspacing="0" border="0" class="envelope-top800">
                <tr>
                    <td class="imgfix-wrap" align="center" valign="top" height="84" style="line-height: 0; font-size: 6px; height: 84px;">
                        <img class="imgfix" editable="false" src="https://swo.vavyskov.cz/assets/email/envelope-top.png" style="display: block; width: 800px; height: 84px;" width="800" height="84" alt="" align="left" border="0" />
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr class="hide-for-print">
        <td align="center">
            <table width="800" cellpadding="0" align="center" cellspacing="0" border="0" class="middle-envelope800">
                <tr>
                    <td class="left imgfix-wrap" align="left" valign="top" height="69" bgcolor="f7f7f7" style="line-height: 0; font-size: 6px; height: 69px;">
                        <img class="imgfix" editable="false" src="https://swo.vavyskov.cz/assets/email/envelope-middle-left.png" style="display: block; width: 282px; height: 69px;" width="282" height="69" alt="" align="left" border="0" />
                    </td>
                    <td align="center" valign="top" bgcolor="f7f7f7" style="line-height: 0;">
                        <table width="30%" cellspacing="0" cellpadding="0" border="0" align="center" class="middle-envelope800-center">
                            <tr>
                                <td valign="middle" align="center">
                                    &nbsp;
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td class="right imgfix-wrap" align="right" valign="top" height="69" bgcolor="f7f7f7" style="line-height: 0; font-size: 6px; height: 69px;">
                        <img class="imgfix" editable="false" src="https://swo.vavyskov.cz/assets/email/envelope-middle-right.png" style="display: block; width: 282px; height: 69px; float: right;" width="282" height="69" alt="" align="right" border="0" />
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr class="hide-for-print">
        <td align="center">
            <table width="800" cellpadding="0" align="center" cellspacing="0" border="0" class="bottom-envelope800">
                <tr>
                    <td class="left imgfix-wrap" align="left" valign="top" height="105" bgcolor="f7f7f7" style="line-height: 0; font-size: 6px; height: 105px;">
                        <img class="imgfix" editable="false" src="https://swo.vavyskov.cz/assets/email/envelope-bottom-left.png" style="display: block; width: 166px; height: 105px;" width="166" height="105" alt="" align="left" border="0" />
                    </td>
                    <td align="center" valign="top" bgcolor="f7f7f7" style="line-height: 0;">
                        <table width="100%" cellpadding="0" align="center" cellspacing="0" border="0" bgcolor="f7f7f7" class="sign">
                            <tr>
                                <td align="center" mc:edit="title3" style="color: #474747; font-size: 11px;" class="sign-text">
                                    E-mail odeslán z <a href="https://www.example.com/" style="text-decoration: none; color: #f5756c;">example.com</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td class="right imgfix-wrap" align="right" valign="top" height="105" bgcolor="f7f7f7" style="line-height: 0; font-size: 6px; height: 105px;">
                        <img class="imgfix" editable="false" src="https://swo.vavyskov.cz/assets/email/envelope-bottom-right.png" style="display: block; width: 166px; height: 105px; float: right;" width="166" height="105" alt="" align="right" border="0" />
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr class="hide-for-print"><td height="50"></td></tr>
</table>

</body>
</html>
' . "\r\n\r\n";

// Inline
//$message .= "--Inline-1_" . $boundary;
$message .= "Content-Type: image/png; name='web.png'";
$message .= "Content-Transfer-Encoding: base64";
$message .= "Content-ID: <0a7eefd8fbcdb27974c1561c910fcff3@phpmailer.0>";
$message .= "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";
//$message .= "--Inline-1_" . $boundary . "--";

// Final delimiter
$message .= "--Delimiter_" . $boundary . "--";

// Attachment - https://base64.guru/converter/encode/pdf
//$message .= "--Attachment-1_" . $boundary;
$message .= "Content-Type: application/octet-stream; name='=?utf-8?Q?Obchodni-podminky.pdf?='";
$message .= "Content-Transfer-Encoding: base64";
$message .= "Content-Disposition: attachment; filename='=?utf-8?Q?Obchodni-podminky.pdf?='";
$message .= "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c291cmNlcyAxMSAwIFIvTWVkaWFCb3hbMCAwIDU5NS4yNzU1OTA1NTExODEgODQxLjg2MTQxNzMyMjgzNV0vR3JvdXA8PC9TL1RyYW5zcGFyZW5jeS9DUy9EZXZpY2VSR0IvSSB0cnVlPj4vQ29udGVudHMgMiAwIFI+PgplbmRvYmoKCjQgMCBvYmoKPDwvVHlwZS9QYWdlcwovUmVzb3VyY2VzIDExIDAgUgovTWVkaWFCb3hbIDAgMCA1OTUgODQxIF0KL0tpZHNbIDEgMCBSIF0KL0NvdW50IDE+PgplbmRvYmoKCjEyIDAgb2JqCjw8L1R5cGUvQ2F0YWxvZy9QYWdlcyA0IDAgUgovUGFnZUxheW91dC9Ud29Db2x1bW5SaWdodAovUGFnZU1vZGUvRnVsbFNjcmVlbgovT3BlbkFjdGlvblsxIDAgUiAvWFlaIG51bGwgbnVsbCAwXQovVmlld2VyUHJlZmVyZW5jZXM8PC9Ob25GdWxsU2NyZWVuUGFnZU1vZGUvVXNlTm9uZQo+PgovTGFuZyhjcy1DWikKPj4KZW5kb2JqCgoxMyAwIG9iago8PC9DcmVhdG9yPEZFRkYwMDU3MDA3MjAwNjkwMDc0MDA2NTAwNzI+Ci9Qcm9kdWNlcjxGRUZGMDA0QzAwNjkwMDYyMDA3MjAwNjUwMDRGMDA2NjAwNjYwMDY5MDA2MzAwNjUwMDIwMDAzNTAwMkUwMDM0PgovQ3JlYXRpb25EYXRlKEQ6MjAyMDA1MDQwOTE4MzgrMDInMDAnKT4+CmVuZG9iagoKeHJlZgowIDE0CjAwMDAwMDAwMDAgNjU1MzUgZiAKMDAwMDAwNzE2NCAwMDAwMCBuIAowMDAwMDAwMDE5IDAwMDAwIG4gCjAwMDAwMDAyMDkgMDAwMDAgbiAKMDAwMDAwNzMzMyAwMDAwMCBuIAowMDAwMDAwMjI5IDAwMDAwIG4gCjAwMDAwMDYyODggMDAwMDAgbiAKMDAwMDAwNjMwOSAwMDAwMCBuIAowMDAwMDA2NTEwIDAwMDAwIG4gCjAwMDAwMDY4NjEgMDAwMDAgbiAKMDAwMDAwNzA3NyAwMDAwMCBuIAowMDAwMDA3MTA5IDAwMDAwIG4gCjAwMDAwMDc0MzIgMDAwMDAgbiAKMDAwMDAwNzYzMSAwMDAwMCBuIAp0cmFpbGVyCjw8L1NpemUgMTQvUm9vdCAxMiAwIFIKL0luZm8gMTMgMCBSCi9JRCBbIDw0Nzg2QTdDMzA2QzIwQUU4RkUwOEMzMkRBRDNCMUNBRD4KPDQ3ODZBN0MzMDZDMjBBRThGRTA4QzMyREFEM0IxQ0FEPiBdCi9Eb2NDaGVja3N1bSAvNjYyQTc3MDY0QzdENDBGRDJFMUZCMDc2OUMwRjk2MUUKPj4Kc3RhcnR4cmVmCjc4MDYKJSVFT0YK";
//$message .= "--Attachment-1_" . $boundary . "--";

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
