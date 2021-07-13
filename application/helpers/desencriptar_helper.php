<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('DESENCRIPTAR')) {
	
	function DESENCRIPTAR($jsonString){	
        $jsondata = json_decode($jsonString, true);
        try {
            $salt = hex2bin($jsondata["salt"]);
            $iv  = hex2bin($jsondata["iv"]);          
        } catch(Exception $e) { return null; }
        $secretoPeticion = 'csoftprosofdesarrollo';
        $iterations = 999;
        $ciphertext = base64_decode($jsondata["ciphertext"]);
        $key = hash_pbkdf2("sha512", $secretoPeticion, $salt, $iterations, 64);
        $decrypted= openssl_decrypt($ciphertext , 'aes-256-cbc', hex2bin($key), OPENSSL_RAW_DATA, $iv);
        return $decrypted;
    }
}

?>