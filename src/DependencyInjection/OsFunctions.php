<?php

namespace Fi\OsBundle\DependencyInjection;

class OsFunctions
{
    /**
     * La funzione restituisce dov'è installato php sulla macchina.
     */
    public static function getPHPExecutableFromPath()
    {
        if (self::isWindows()) {
            //In caso di windows
            $paths = explode(PATH_SEPARATOR, getenv('PATH'));
            foreach ($paths as $path) {
                $php_executable = $path.DIRECTORY_SEPARATOR.'php'.(isset($_SERVER['WINDIR']) || isset($_SERVER['windir']) ? '.exe' : '');
                if (file_exists($php_executable) && is_file($php_executable)) {
                    return $php_executable;
                }
            }
        } else {
            //In caso altri sistemi operativi (linux)
            $phpPath = exec('which php');
            if (file_exists($phpPath)) {
                return $phpPath;
            } elseif (file_exists('/usr/bin/php')) {
                return '/usr/bin/php';
            }
        }

        throw new \Exception('Php non trovato');
    }

    /**
     * La funzione restituisce se la macchina che ospita l'applicazione è windows true, altrimenti false (es. linux).
     */
    public static function isWindows()
    {
        if (PHP_OS == 'WINNT') {
            return true;
        } else {
            return false;
        }
    }

    public static function getSeparator()
    {
        if (self::isWindows()) {
            return '&';
        } else {
            return ';';
        }
    }

    public static function httpCurl($url, $fields = array())
    {
        $postvars = '';
        foreach ($fields as $key => $value) {
            $postvars .= $key.'='.$value;
        }
        $httpscall = curl_init();
        curl_setopt($httpscall, CURLOPT_URL, $url);
        curl_setopt($httpscall, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($httpscall, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($httpscall, CURLOPT_PROXY, null);
        curl_setopt($httpscall, CURLOPT_POST, count($fields));
        curl_setopt($httpscall, CURLOPT_POSTFIELDS, $postvars);
        curl_setopt($httpscall, CURLOPT_HEADER, 0);
        curl_setopt($httpscall, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)');
        curl_setopt($httpscall, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($httpscall);
        curl_close($httpscall);

        return $result;
    }

    public static function httpCurlResponse($url)
    {
        $httpscall = curl_init();
        curl_setopt($httpscall, CURLOPT_URL, $url);
        curl_setopt($httpscall, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($httpscall, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($httpscall, CURLOPT_PROXY, null);
        curl_setopt($httpscall, CURLOPT_HEADER, 0);
        curl_setopt($httpscall, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)');
        curl_setopt($httpscall, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($httpscall);
        curl_close($httpscall);

        return $result;
    }

    public static function delTree($dir)
    {
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
        }

        return rmdir($dir);
    }
}

/*
 * La funzione restituisce eccc
 *
 * @param $elem Oggetto da cercare
 * @param $array Array nel quale cercare
 * @param $key Nome della chiave nella quale cercare $elem
 * @return Mixed False se non trovato l'elemento, altrimenti l'indice in cui si è trovato il valore
 */
