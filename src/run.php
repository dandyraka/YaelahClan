<?php
require __DIR__.'/../vendor/autoload.php';

$c = new Colors\Color();

echo $c("== Yaelah Clan ==")->yellow()->center() . PHP_EOL;
echo $c("check social media username availability")->yellow()->center() . PHP_EOL;
echo "Your name : ";
$nama = strtolower(trim(fgets(STDIN)));

if(preg_match('/\s/', $nama)){
    echo $c("[!] Please enter a nickname, not a full name")->red();
    exit();
}

function status($username, $social){
    if($social == "Instagram"){
        $domain = "www.instagram.com";
    } else if($social == "Twitter"){
        $domain = "twitter.com";
    } else {
        exit();
    }
    
    $client = new \GuzzleHttp\Client([
        'verify'        => false,
        'http_errors'   => false
    ]);
    $response = $client->request('GET', 'https://' . $domain . '/' . $username . '/');
    return $response->getStatusCode();
}

$jumlah     = strlen($nama);
$part       = array();
$part[]     = substr($nama, 0, 2);
$part[]     = substr($nama, 0, 3);
$part[]     = substr($nama, $jumlah - 2, 2);
$part[]     = substr($nama, $jumlah - 3, 3);

echo "\n";
echo $c("[ Checking Instagram Username ]")->yellow()->center() . PHP_EOL;
foreach($part as $parts){
    $username = "yaelah".$parts;
    echo "[?] Checking username : ".$username."\n";
    $check = status($username, "Instagram");
    if($check != 200){
        echo $c("[+] ".$username." is available\n")->green();
    } else {
        echo $c("[-] ".$username." is not available\n")->red();
    }
    sleep(3);
}

echo "\n";
echo $c("[ Checking Twitter Username ]")->yellow()->center() . PHP_EOL;
foreach($part as $parts){
    $username = "yaelah".$parts;
    echo "[?] Checking username : ".$username."\n";
    $check = status($username, "Twitter");
    if($check != 200){
        echo $c("[+] ".$username." is available\n")->green();
    } else {
        echo $c("[-] ".$username." is not available\n")->red();
    }
    sleep(3);
}

echo $c("== DONE ==")->yellow()->center() . PHP_EOL;