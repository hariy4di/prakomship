<?php
/**
 * Default adalah poll!
 */

require_once 'token.php';

define('BOT_TOKEN', $token); 

// versi official telegram bot
define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');
// versi 3rd party, biar bisa tanpa https / tanpa SSL.
// define('API_URL', 'https://api.pwrtelegram.xyz/bot'.BOT_TOKEN.'/');

define('myVERSI','0.1');
define('lastUPDATE', '1 Agustus 2018');

require_once 'database.php';

// aktifkan ini jika ingin menampilkan debugging poll
$debug = true;

function exec_curl_request($handle)
{
    $response = curl_exec($handle);
    
    if ($response === false) {
        $errno = curl_errno($handle);
        $error = curl_error($handle);
        error_log("Curl returned error $errno: $error\n");
        curl_close($handle);

        return false;
    }

    $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
    curl_close($handle);

    if ($http_code >= 500) {
        // do not wat to DDOS server if something goes wrong
        sleep(10);

        return false;
    }
    elseif ($http_code != 200) {
        $response = json_decode($response, true);
        error_log("Request has failed with error {$response['error_code']}: {$response['description']}\n");
        if ($http_code == 401) {
            throw new Exception('Invalid access token provided');
        }

        return false;
    }
    else {
        $response = json_decode($response, true);
        if (isset($response['description'])) {
            error_log("Request was successfull: {$response['description']}\n");
        }
        $response = $response['result'];
    }

    return $response;
}

function apiRequest($method, $parameters = null)
{
    if (!is_string($method)) {
        error_log("Method name must be a string\n");
        
        return false;
    }

    if (!$parameters) {
        $parameters = [];
    }
    elseif (!is_array($parameters)) {
        error_log("Parameters must be an array\n");
        
        return false;
    }

    foreach ($parameters as $key => &$val) {
        // encoding to JSON array parameters, for example reply_markup
        if (!is_numeric($val) && !is_string($val)) {
            $val = json_encode($val);
        }
    }
    $url = API_URL.$method.'?'.http_build_query($parameters);

    $handle = curl_init($url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($handle, CURLOPT_TIMEOUT, 60);
    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);

    return exec_curl_request($handle);
}

function apiRequestJson($method, $parameters)
{
    if (!is_string($method)) {
        error_log("Method name must be a string\n");

        return false;
    }

    if (!$parameters) {
        $parameters = [];
    }
    elseif (!is_array($parameters)) {
        error_log("Parameters must be an array\n");

        return false;
    }

    $parameters['method'] = $method;

    $handle = curl_init(API_URL);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($handle, CURLOPT_TIMEOUT, 60);
    curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($parameters));
    curl_setopt($handle, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    
    return exec_curl_request($handle);
}

// jebakan token, klo ga diisi akan mati
if (strlen(BOT_TOKEN) < 20) {
    die(PHP_EOL."-> -> Token BOT API nya mohon diisi dengan benar!\n");
}

function getUpdates($last_id = null)
{
    $params = [];
    if (!empty($last_id)) {
        $params = ['offset' => $last_id + 1, 'limit' => 1];
    }
    //echo print_r($params, true);
    return apiRequest('getUpdates', $params);
}

// matikan ini jika ingin bot berjalan
// die('baca dengan teliti!');

function sendMessage($idpesan, $idchat, $pesan)
{
    $data = [
        'chat_id'             => $idchat,
        'text'                => $pesan,
        'parse_mode'          => 'Markdown',
        'reply_to_message_id' => $idpesan,
    ];

    return apiRequest('sendMessage', $data);
}

function processMessage($message)
{
    global $database;
    if ($GLOBALS['debug']) {
        print_r($message);
    }

    if (isset($message['message'])) {
        $sumber = $message['message'];
        $idpesan = $sumber['message_id'];
        $idchat = $sumber['chat']['id'];

        $namamu = $sumber['from']['first_name'];
        $iduser = $sumber['from']['id'];

        if (isset($sumber['text'])) {
            $pesan = $sumber['text'];

            // print_r($pesan);
            $pecah = explode(' ', $pesan, 2);
            $katapertama = strtolower($pecah[0]);
            
            switch ($katapertama) {
                
                case '/start':
                    $text = "Hai `$namamu`.. Selamat datang!\n\nUntuk bantuan ketik: /help";
                    break;

                case '/help':
                    $text = '💁🏼 Ini adalah *Prakomship Bot* ver.`'.myVERSI."`\n";
                    $text .= "🎓 oleh _Kelompok Tiga_\n⌛️".lastUPDATE."\n\n";
                    $text .= "Berikut menu yang tersedia:\n";
                    $text .= "/id cek ID Telegram Anda\n";
                    $text .= "/time info waktu sekarang\n";
                    $text .= "/search`[spasi]``keyword` top5 pencarian peraturan\n\n";
                    $text .= "/help info bantuan\n";
                    $text .= '😎 *Ingin bertanya langsung?* Silakan hubungi Mas Boy';
                    break;

                case '/id':
                    $text = "$namamu, ID Anda adalah $iduser";
                    break;

                case '/time':
                    $text = "⌛️ Waktu sekarang :\n";
                    $text .= date('d-m-Y H:i:s');
                    break;

                case '/search':
                    $text = search($iduser,$pecah[1]);
                    if ($GLOBALS['debug']) {
                        print_r($text);
                    }
                    break;

                default:
                  $text = '😥 _perintah tidak terdefinisikan_';
                  break;
            }
        }
        else {
            $text = 'Tidak ada pesan..';
        }

        $hasil = sendMessage($idpesan, $idchat, $text);
        if ($GLOBALS['debug']) {
            // hanya nampak saat metode poll dan debug = true;
            echo 'Pesan yang dikirim: '.$text.PHP_EOL;
            print_r($hasil);
        }
    }
}

// pencetakan versi dan info waktu server, berfungsi jika test hook
echo 'Ver. '.myVERSI.' OK Start!'.PHP_EOL.date('Y-m-d H:i:s').PHP_EOL;

function printUpdates($result)
{
    foreach ($result as $obj) {
        // echo $obj['message']['text'].PHP_EOL;
        processMessage($obj);
        $last_id = $obj['update_id'];
    }

    return $last_id;
}

// AKTIFKAN INI jika menggunakan metode poll
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
$last_id = null;
while (true) {
    $result = getUpdates($last_id);
    if (!empty($result)) {
        echo '+';
        $last_id = printUpdates($result);
    } else {
        echo '-';
    }
    sleep(1);
}

// AKTIFKAN INI jika menggunakan metode webhook
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
/*$content = file_get_contents("php://input");
$update = json_decode($content, true);
if (!$update) {
  // ini jebakan jika ada yang iseng mengirim sesuatu ke hook
  // dan tidak sesuai format JSON harus ditolak!
  exit;
} else {
  // sesuai format JSON, proses pesannya
  processMessage($update);
}*/