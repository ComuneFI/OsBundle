<?php

namespace Fi\OsBundle\DependencyInjection;

class OsFunctions {

    /**
     * La funzione restituisce dov'è installato php sulla macchina
     */
    static function getPHPExecutableFromPath() {
        if (self::isWindows()) {
            //In caso di windows
            $paths = explode(PATH_SEPARATOR, getenv('PATH'));
            foreach ($paths as $path) {
                $php_executable = $path . DIRECTORY_SEPARATOR . "php" . (isset($_SERVER["WINDIR"]) ? ".exe" : "");
                if (file_exists($php_executable) && is_file($php_executable)) {
                    return $php_executable;
                }
            }
        } else {
            //In caso altri sistemi operativi (linux)
            $phpPath = exec("which php");
            if (file_exists($phpPath)) {
                return $phpPath;
            } elseif (file_exists("/usr/bin/php")) {
                return "/usr/bin/php";
            }
        }
        
        throw new Exception("Php non trovato");
    }

    /**
     * La funzione restituisce se la macchina che ospita l'applicazione è windows true, altrimenti false (es. linux)
     */
    static function isWindows() {
        if (PHP_OS == "WINNT") {
            return true;
        } else {
            return false;
        }
    }

}

/**
 * La funzione restituisce eccc
 *
 * @param $elem Oggetto da cercare
 * @param $array Array nel quale cercare
 * @param $key Nome della chiave nella quale cercare $elem
 * @return Mixed False se non trovato l'elemento, altrimenti l'indice in cui si è trovato il valore
 */
?>
