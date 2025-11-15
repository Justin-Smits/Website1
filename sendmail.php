<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam      = strip_tags($_POST["naam"] ?? '');
    $email     = strip_tags($_POST["email"] ?? '');
    $telefoon  = strip_tags($_POST["telefoon"] ?? '');
    $onderwerp = strip_tags($_POST["onderwerp"] ?? '');
    $boot      = strip_tags($_POST["boot"] ?? '');
    $bericht   = strip_tags($_POST["bericht"] ?? '');

    $to      = "info@vdzwaardjachtwerf.nl";
    $subject = "Nieuw bericht via het contactformulier";
    
    $body  = "Naam: $naam\n";
    $body .= "Email: $email\n";
    $body .= "Telefoon: $telefoon\n";
    $body .= "Onderwerp: $onderwerp\n";
    $body .= "Boot: $boot\n\n";
    $body .= "Bericht:\n$bericht\n";

    $headers  = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // 👇 Check of je lokaal draait (XAMPP)
    $isLocal = in_array($_SERVER['SERVER_NAME'], ['localhost', '127.0.0.1']);

    if ($isLocal) {
        // LOKAAL: niet echt mailen, alleen "OK" teruggeven
        echo "OK";
        exit;
    }

    // ONLINE / OP SERVER: echt mail versturen
    if (mail($to, $subject, $body, $headers)) {
        echo "OK";
    } else {
        echo "MAIL_FAILED";
    }
}
?>
