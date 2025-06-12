<?php
    function gerarTokenCRSF(){
        if(empty($_SESSION['crsf_token'])){
            $_SESSION['crsf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['crsf_token'];
    }
    function validarTokenCRSF($token){
        return isset($_SESSION['crsf_token'])&& hash_equals($_SESSION['crsf_token'], $token);
    }