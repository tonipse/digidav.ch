<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Titel der Seite</title>
<style type="text/css">
body, input {
	font-family: Calibri, Helvetica, sans-serif;
	font-size: 1rem;
}
#formularbox{
	border:2px solid #ccc;
	width:90%;
	padding:1rem;	
}
	</style>
	
<!-- Dasselbe Stylesheet wie bei der Website anhängen!-->
<!-- Nach kurzer Wartezeit Sprung auf die Übersichtsseite zurück...-->
<!--meta http-equiv="refresh" content="4;URL=formular.htm"-->
</head>
<body>

<?php
// ****** START DES PHP-SCRIPTS *********************************************
// ****** Achtung: Diese Datei muss auf einem PHP-fähigen Server liegen!!!
// ****** Seit PHP 5.x muss man vorher gesendeten Variablen hier übergeben und "abholen"
// ****** Achtung: Auf Gross- und Kleinschreibung achten, genau gleich wie im Formular!

$Anrede			=	$_REQUEST["Anrede"];
$Name			=	$_REQUEST["Name"];
$Vorname		=	$_REQUEST["Vorname"];
$Strasse		=	$_REQUEST["Strasse"];
$PLZ			=	$_REQUEST["PLZ"];
$Ort			=	$_REQUEST["Ort"];
$Telefon		=	$_REQUEST["Telefon"];
$Email			=	$_REQUEST["Mail"];
$infoschreiben_gastronomie	=	$_REQUEST["infoschreiben-gastronomie"];
$infoschreiben_logistik		=	$_REQUEST["infoschreiben-logistik"];
$infoschreiben_auf_dem_bau	=	$_REQUEST["infoschreiben-auf-dem-bau"];
$Bemerkungen	=	$_REQUEST["Bemerkungen"];
// ****** Hier endet die Übergabe der Variablen. Sind alle vorhanden und richtig benannt??
// ****** Alle Felder aus dem Formular werden mit deren Namen (Achtung auf Gross- & Kleinschreibung!) hier aufgelistet...

 $body=""; // Start des E-Mail Inhaltes (mit .= wird angefügt)
	
 $body.="<font face='Verdana,Arial' size='2'>";
	$body.="<b>Guten Tag ".$Vorname." ".$Name."!</b> <br> <br>";
 $body.="<b>Danke für dein Mail. Ein Mitarbeiter wird sich bald mit Ihnen in Verbindung setzen </b> <br> <br>"; 
	
	
 $body.="<b>Anrede:</b> ";
 if($Name!=""): 	$body.=$Anrede; else: $body.="keine Angabe"; endif;
 $body.="<br>";
	
 $body.="<b>Name:</b> ";
 if($Name!=""): 	$body.=$Name; else: $body.="keine Angabe"; endif;
 $body.="<br>";

 $body.="<b>Vorname:</b> ";
 if($Vorname!=""): 	$body.=$Vorname; else: $body.="keine Angabe"; endif;
 $body.="<br>";
	
 $body.="<b>Strasse:</b> ";
 if($Strasse!=""): 	$body.=$Strasse; else: $body.="keine Angabe"; endif;
 $body.="<br>";

 $body.="<b>Ort:</b> ";
 if($$PLZ!=""): 	$body.=$PLZ; else: $body.="keine Angabe"; endif;
 $body.="<br>";
	 
	 
 $body.="<b>E-Mail:</b><br>";
 if($Email!=""): 	$body.="<a href='mailto:".$Email."'>".$Email."</a>"; else: $body.="keine Angabe"; endif;
 $body.="<br><br>";
	
 $body.="<b>Telefon:</b> ";
 if($Telefon!=""): 	$body.=$Telefon; else: $body.="keine Angabe"; endif;
 $body.="<br>";
	
	
 $body.="<b>Bemerkungen:</b> ";
 if($Bemerkungen!=""): 	$body.=$Bemerkungen; else: $body.="keine Angabe"; endif;
 $body.="<br>";	
 
// ******  Hier den Mail-Empfänger eingeben (auch mehrere sind möglich)! ***********
$empfaenger1="david_basler@gmx.net";
	
// ******  Hier den Absender (E-Mail) eingeben! ***********
$absender="info@digidav.ch"; // Ansonsten kommt das E-mail von "gothicus@metanet.ch"

// ******  MIME-Type Definition ***********
$kopf="MIME-VERSION:1.0\n";
$kopf.="CONTENT-TYPE:text/html; charset=\"UTF-8\"\n";
$kopf.="FROM:Formularanfrage von $Vorname $Name <$absender>\n";
$kopf.="Reply-To: ".$Email." \r\n";


// ******  Versendenfunktion ******
/*if($Name!=""){ 
	// kleiner Spamschutz, damit keine leeren Formulare ankommen...
	// wenn mehrere Empfänger Zeile duplizieren
	@mail($empfaenger1," Anfrage auf Website ",$body, $kopf);
	@mail($empfaenger2," CC Anfrage auf Website ",$body, $kopf); 
}*/
	
	
	
// ******   ENDE DES PHP-SCRIPTS *********************************************

function multi_attach_mail($to, $subject, $message, $senderEmail, $senderName, $files = array()){ 
 
    $from = $senderName." <".$senderEmail.">";  
    $headers = "From: $from"; 
 
    // Boundary  
    $semi_rand = md5(time());  
    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  
 
    // Headers for attachment  
    $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";  
 
    // Multipart boundary  
    $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
    "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n";  
 
    // Preparing attachment 
    if(!empty($files)){ 
        for($i=0;$i<count($files);$i++){ 
            if(is_file($files[$i])){ 
                $file_name = basename($files[$i]); 
                $file_size = filesize($files[$i]); 
                 
                $message .= "--{$mime_boundary}\n"; 
                $fp =    @fopen($files[$i], "rb"); 
                $data =  @fread($fp, $file_size); 
                @fclose($fp); 
                $data = chunk_split(base64_encode($data)); 
                $message .= "Content-Type: application/octet-stream; name=\"".$file_name."\"\n" .  
                "Content-Description: ".$file_name."\n" . 
                "Content-Disposition: attachment;\n" . " filename=\"".$file_name."\"; size=".$file_size.";\n" .  
                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"; 
            } 
        } 
    } 
     
    $message .= "--{$mime_boundary}--"; 
    $returnpath = "-f" . $senderEmail; 
     
    // Send email 
    $mail = @mail($to, $subject, $message, $headers, $returnpath);  
     
    // Return true, if email sent, otherwise return false 
    if($mail){ 
        return true; 
    }else{ 
        return false; 
    } 
}


if($infoschreiben_gastronomie == 'Gastronomie'){
    $files[] = 'pdf/Gastronomie-Infoletter.pdf';
}
if($infoschreiben_logistik == 'Logistik'){
    $files[] = 'pdf/Logistik-Infoletter.pdf';
}
if($infoschreiben_auf_dem_bau == 'Auf-dem-Bau'){
    $files[] = 'pdf/Auf-dem-Bau-Infoletter.pdf';
}

//echo "<pre>";print_r($_REQUEST);echo $body;echo "</br>";print_r($files);print_r($files1);exit;
$fromName = $Name;
$from = $Email;
$subject = 'Anfrage auf Website';
$to = 'smrutiranjan1988@gmail.com,david_basler@gmx.net';
$sendEmail = multi_attach_mail($to, $subject, $body, $from, $fromName,$files); 
if($sendEmail){ 
    echo 'The email has sent successfully.'; 
}else{ 
    echo 'Mail sending failed!'; 
}
echo '<p>Vielen Dank <b> '.$Vorname.' '.$Name.' für Ihre Anfrage </p>';	
	
?>

	
	

</body>
</html>
