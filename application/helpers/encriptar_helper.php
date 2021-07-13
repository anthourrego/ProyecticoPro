<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('ENCRIPTAR')) {
	
	function ENCRIPTAR($plain_text){
        $salt = openssl_random_pseudo_bytes(256);
        $iv = openssl_random_pseudo_bytes(16);
        $secretoPeticion = 'csoftprosofdesarrollo';
        $iterations = 999;
        $key = hash_pbkdf2("sha512", $secretoPeticion, $salt, $iterations, 64);
        $encrypted_data = openssl_encrypt($plain_text, 'aes-256-cbc', hex2bin($key), OPENSSL_RAW_DATA, $iv);
        $data = array("ciphertext" => base64_encode($encrypted_data), "iv" => bin2hex($iv), "salt" => bin2hex($salt));
        return $data;
    }
}

?>