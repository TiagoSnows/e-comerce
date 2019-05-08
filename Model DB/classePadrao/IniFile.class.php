<?php
namespace EcommerceConection;

use Exception;

//error_reporting(0);

abstract Class IniFile
{
    static function readIniFile ($pathToIni)
    {
        // Interpreta com as seções
        if ( ($array_config = parse_ini_file($pathToIni, true)) == false )
            throw new Exception('Não foi possível carregar os dados.');
            
        return $array_config;
    }

}
