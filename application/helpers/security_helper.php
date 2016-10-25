<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// HELPER Security

/**
 * Método que encripta una cadena con el algoritmo sha512
 * @autor 		: Jesús Díaz P.
 * @modified 	: 
 * @param 		: string $matricula Cadena a codificar
 * @param 		: string $contrasenia Cadena a codificar
 * @return 		: string Cadena codificada
 */
if (!function_exists('contrasenia_formato')) {

    function contrasenia_formato($matricula, $contrasenia) {
        return hash('sha512', $contrasenia . $matricula);
    }

}

/**
 * Método que codifica una cadena a base 64
 * @autor 		: Jesús Díaz P.
 * @modified 	: 
 * @param 		: string $string Cadena a codificar
 * @return 		: string Cadena codificada
 */
if(!function_exists('encrypt_base64')){
	function encrypt_base64($string){
		//return base64_encode($string); //convert_uuencode($string);
		//return strtr(base64_encode($string), '+/=', '-_*');
		return rtrim(strtr(base64_encode($string), '+/', '-_'), '=');
	}
}

/**
 * Método que decodifica una cadena en base 64
 * @autor 		: Jesús Díaz P.
 * @modified 	: 
 * @param 		: string $string Cadena a decodificar
 * @return 		: string Cadena decodificada
 */
if(!function_exists('decrypt_base64')){
	function decrypt_base64($string){
		//return base64_decode($string); //convert_uudecode($string);
		//return base64_decode(strtr($string, '-_*', '+/='));
		return base64_decode(str_pad(strtr($string, '-_', '+/'), strlen($string) % 4, '=', STR_PAD_RIGHT));
	}
}

/**
 * Método que genera un folio aleatorio
 * @autor 		: Pablo José D.J.
 * @modified 	: 
 * @param 		: string $limt longitud de caracteres
 * @param 		: bool   $activeSpecial activar caracteres especiales
 * @return 		: string folio generado
 */
if (!function_exists('random_code_generate')) {
	function random_code_generate($limit = 6, $activeSpecial=false)
    {
        $string_base =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; //Alfa
        $string_base .= '0123456789'; //Números
        if($activeSpecial)
        {
            $string_base .= '%&*_,.!'; //Caracteres especiales
        }

        $string_code = '';
        $limited = strlen($string_base) - 1;

        for($i=0; $i < $limit; $i++)
        {
            $string_code .= $string_base[rand(0, $limited)];
        }

        return $string_code;
    }
    
}
