<?php
// ServerInfo.php

class ServerInfo
{
    /**
     * Not available (N/A)
     * @return string
     */
    private function notAvailable()
    {
        return "<img src='assets/times.svg' alt='N/A' height='16' width='16' class='align-middle'>";
    }

    /**
     * Debian
     * @return string
     */
    private function debian()
    {
        if (exec('cat /etc/os-release')) {
            return exec('cat /etc/os-release | grep PRETTY_NAME | cut -d\" -f2 | cut -d" " -f1,3,4 | sed "s/ v/ /"');
        } else {
            return $this->notAvailable();
        }
    }

    /**
     * Apache
     * @return string
     */
    private function apache()
    {
        if  (exec('apache2 -v 2>/dev/null; echo $?') == 0) {
            return exec('apache2 -v 2>&1 | head -1 | cut -d/ -f2 | cut -d" " -f1');
        }
        elseif  (exec('httpd -v 2>/dev/null; echo $?') == 0) {
            return exec('httpd -v 2>&1 | head -1 | cut -d/ -f2 | cut -d" " -f1');
        }
        else {
            return $this->notAvailable();
        }
    }

    /**
     * Nginx
     * @return string
     */
    private function nginx()
    {
        if  (exec('nginx -v 2>/dev/null; echo $?') == 0) {
            return exec('nginx -v 2>&1 | cut -d/ -f2');
        } else {
            return $this->notAvailable();
        }
    }

    /**
     * SQLite
     * @return string
     */
    private function sqlite()
    {
        if (class_exists('SQLite3')) {
            $sql_db = new PDO('sqlite::memory:');
            return $sql_db->query('select sqlite_version()')->fetch()[0];
        } else {
            //throw new Exception('SQLite not installed');
            return $this->notAvailable();
        }
    }

    /**
     * Node.js
     * @return string
     */
    private function nodejs()
    {
        if (exec('nodejs -v 2>/dev/null')) {
            return exec('nodejs -v 2>/dev/null | cut -dv -f2');
        } else {
            return $this->notAvailable();
        }
    }

    /**
     * Ghostscript
     * @return string
     */
    private function ghostscript()
    {
        if (exec('gs --version 2>/dev/null')) {
            return exec('gs --version 2>/dev/null | head -1 | cut -d" " -f3');
        } else {
            return $this->notAvailable();
        }
    }

    /**
     * Xdebug
     * @return string
     */
    private function xdebug()
    {
        // php -v | grep -i xdebug | cut -dv -f2 | cut -d, -f1
        return phpversion('xdebug') ? phpversion('xdebug') : $this->notAvailable();
    }

    /**
     * Memcached
     * @return bool|string
     */
    function memcached()
    {
        if (class_exists('Memcache')) {
            $memcache = new Memcache;
            if ($memcache->getVersion() === false) {
                //throw new Exception('Please, verify the Memcache configuration');
                return $this->notAvailable();
            } else {
                return $memcache->getVersion();
            }
        } else {
            return $this->notAvailable();
        }
    }

    // msmtp | ssmtp | postfix
    //'version' => 'sendmail -V 2>&1 | awk \'{print $1" "$2}\'',
//'version' => '/usr/sbin/sendmail -V 2>&1 | cut -d" " -f1,2',

    /**
     * Sendmail
     * @return string
     */
    private function sendmail()
    {
        if  (exec('/usr/sbin/sendmail -V 2>/dev/null; echo $?') == 0) {
            return exec('/usr/sbin/sendmail -V 2>&1 | cut -d" " -f1,2');
        }
        elseif  (exec('ssmtp --version 2>/dev/null; echo $?') == 0) {
            return exec('ssmtp --version 2>&1 | head -1');
        }
        elseif  (exec('msmtp --version 2>/dev/null; echo $?') == 0) {
            return exec('msmtp --version 2>&1 | head -1 | cut -d" " -f1,3');
        }
        elseif  (exec('postfix --version 2>/dev/null; echo $?') == 0) {
            return exec('postconf mail_version | sed "s/mail_version = /Postfix /"');
        }
        else {
            return $this->notAvailable();
        }
    }

    function swVersion()
    {
        // Command, Filter, Alternative, Position, Delimiter
        $sofware = array(
            'Linux' => [
                'version' => 'lsb_release -d 2>&1 | cut -d: -f2 | cut -d" " -f1,3,4',
                'alternative' => $this->debian(),
            ],
            'Web server Apache' => [
                'alternative' => $this->apache(),
            ],
            'Web server Nginx' => [
                'alternative' => $this->nginx(),
            ],
            'Database SQLite' => [
                'version' => 'sqlite3 --version 2>/dev/null | cut -d" " -f1',
                'alternative' => $this->sqlite(),
            ],
            'Database MySQL' => [
                'version' => 'mysql -V 2>/dev/null | cut -d" " -f6 | cut -d, -f1',
            ],
            'Database PostgreSQL' => [
                'version' => 'psql -V 2>/dev/null | cut -d" " -f3',
            ],
            'Database MongoDB' => [
                'version' => 'mongod --version 2>/dev/null | head -1 | cut -d" " -f3 | cut -dv -f2',
            ],
            'PHP' => [
                'version' => 'php -v 2>&1 | head -1 | cut -d" " -f2 | cut -d- -f1',
            ],
            'ICU (php-intl)' => [
                'version' => 'php -i | grep "ICU version" | cut -d" " -f4',
            ],
            'Composer' => [
                'prefix' => putenv("COMPOSER_HOME=/home/vagrant/.composer"),
                'version' => 'composer --version 2>/dev/null | cut -d" " -f3',
            ],
            'Git' => [
                'version' => 'git --version 2>/dev/null | cut -d" " -f3',
            ],
            'SSH' => [
                'version' => '[ -f /usr/bin/ssh ] && ssh -V 2>&1 | cut -d" " -f1 | cut -d_ -f2 | cut -d, -f1',
            ],
            'Samba' => [
                'version' => 'smbd -V 2>/dev/null | cut -d" " -f2 | cut -d- -f1',
            ],
            'Node.js' => [
                'version' => 'node -v 2>/dev/null | cut -dv -f2',
                'alternative' => $this->nodejs(),
            ],
            'Yarn' => [
                'version' => 'yarn -v 2>/dev/null',
            ],
            'Image Magick' => [
                'version' => 'convert --version 2>/dev/null | head -1 | cut -d" " -f3',
            ],
            /*'OptiPNG' => [
                'version' => 'optipng --version 2>/dev/null | head -1 | cut -d" " -f3',
            ],*/
            /*'GIFsicle' => [
                'version' => 'gifsicle --version 2>/dev/null | head -1 | cut -d" " -f3',
            ],*/
            'Ghostscript' => [
                'version' => 'ghostscript --version 2>/dev/null',
                'alternative' => $this->ghostscript(),
            ],
            'Xdebug' => [
                'alternative' => $this->xdebug(),
            ],
            /*'Memcached' => [
                'version' => 'memcached -V | cut -d" " -f2',
                'alternative' => $this->memcached(),
            ],*/
            'Sendmail' => [
                'alternative' => $this->sendmail(),
            ],
        );
     $data = array();
        foreach ($sofware as $key => $value) {
            // Prefix
            if (isset($value['prefix']))
            {
                $value['prefix'];
            }

            // Version
            if (isset($value['version']) && exec($value['version']))
            {
                $version = exec($value['version']);
            }
            elseif (isset($value['alternative']))
            {
                $version = $value['alternative'];
            }
            else
            {
                $version = $this->notAvailable();
            }

            // Data
            $data += [$key => $version];
        }

        // Template
        extract($data);
        require ("template/software.phtml");
    }

    /**
     * PHP Extensions
     * @return string
     *
     * php -m|grep gd
     * php -m|grep imagick
     * php -m|grep mbstring
     */
    function phpExtension() {
        $php_extension = array(
            "Graphics Drawing (GD)" => "gd",
            "Image Magick" => "imagick",
            "Multibyte String" => "mbstring",
            "OPcache" => "Zend OPcache",
            "XML" => "xml",
            "cURL" => "curl",
            "Zip" => "zip",
            "APCu" => "apcu",
            "PECL upload progress" => "uploadprogress",
            "LDAP" => "ldap",
            "SQLite" => "sqlite3",
            "SQLite (PDO)" => "pdo_sqlite",
            "MySQL" => "mysqli",
            "MySQL (PDO)" => "pdo_mysql",
            "PostgreSQL" => "pgsql",
            "PostgreSQL (PDO)" => "pdo_pgsql",
            "MongoDB" => "mongodb",
            "Exif" => "exif",
            "BCMath" => "bcmath",
            "Intl" => "intl",
            "Xdebug" => "xdebug",
            //"Memcache" => "memcache",
            //"Memcached" => "memcached",
        );
        $data = array();
        foreach ($php_extension as $key => $value) {
            (extension_loaded($value) ? $img = ['file' => 'check.svg', 'alt' => 'OK'] : $img = [ 'file' => 'times.svg', 'alt' => 'N/A']);
            $state = '<img src="assets/' . $img['file'] . '" alt="' . $img['alt'] . '" height="16" width="16" class="align-middle">';
            $data += [$key => $state];
        }
        extract($data);
        require ("template/php-extension.phtml");
    }

    /**
     * External access
     *//*
    function externalAccess() {
        $_SERVER['SERVER_ADDR'] .' | '.
        gethostbyname($_SERVER['SERVER_NAME']) .' | '.
        $_SERVER['SERVER_NAME'] .' | '.
        gethostname() .' | '.
        gethostbyaddr($_SERVER['REMOTE_ADDR']);
    }*/
}