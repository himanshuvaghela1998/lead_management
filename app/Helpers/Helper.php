<?php

/* Encryption Id */
function getEncrypted($id){
    $encrypted_string=openssl_encrypt($id,config('services.encryption.type'),config('services.encryption.secret'));
    return base64_encode($encrypted_string);
}
/* Decryption Id */
function getDecrypted($id){
    $string=openssl_decrypt(base64_decode($id),config('services.encryption.type'),config('services.encryption.secret'));
    return $string;
}
