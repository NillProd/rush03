<?php

class myGitLight
{
    public function protocole()
    {
        static $hello = 1;
        if ($hello == 1)
        {
            echo "Bienvenue dans myGitLight v0.1: une version light et efficace\nQue souhaitez vous faire ?  (mgl --help pour voir toutes les commandes)\n<!> Attention les commandes sont sensibles à la casse <!>\n";
            $hello--;
        }
        $z      = 0;
        if ($z == 0)
        {
            unset($cmd);
            $cmd    = readline();
            $cmd    = trim($cmd);

/*  C   H   E   C   K   E   D   _   M   E   T   H   O   D */
            if(isset($cmd) && is_string($cmd))
            {
                if ($cmd == "mgl --help"){
                    self::protocole_man();
                }
                elseif ($cmd == "mgl init" || $cmd == "mgl  init"){
                    self::protocole_init();
                }
                elseif ($cmd == "mgl add *" || $cmd == "mgl add -A" || $cmd == "mgl add --all") {
                    self::protocole_add_all();
                }
                elseif ($cmd == "mgl commit *" || $cmd == "mgl commit -A" || $cmd == "mgl commit --all"){
                    self::protocole_commit_all();
                }
                elseif ($cmd == "mgl rm *" || $cmd == "mgl rm -A" || $cmd == "mgl rm --all"){
                    self::protocole_rm_all();
                }
                elseif ($cmd == "mgl log")
                {
                    self::protocole_log();
                }
    /*  C   H   E   C   K   E   D  ___  M   E   T   H   O   D */
                elseif ($cmd == "exit" || $cmd == "close" || $cmd == "leave" || $cmd == "stop")
                {
                    exit("\nMerci d'avoir utilisé notre programme ! à bientôt\n");
                }
    /*  A   R   G   U   M   E   N   T   S   _______    M   E   T   H   O   D */
                
                elseif (strpos($cmd, " "))
                {
                    $cmd = explode(" ",$cmd);
                    if ($cmd[0] == "mgl" && $cmd[1] == "rm")
                    {
                        $this->protocole_rm_file($cmd);
                        self::protocole_rm_file();
                    }
                    elseif ($cmd[0] == "mgl" && $cmd[1] == "add")
                    {
                        $this->protocole_add_file($cmd);
                        self::protocole_add_file();
                    }
                    elseif ($cmd[0] == "mgl" && $cmd[1] == "commit")
                    {
                        $this->protocole_commit($cmd);
                        self::protocole_commit();
                    }
                    else
                    {
                        echo "La commande n'est pas reconnu. ( man de myGitLIght ==> mgl --help )\n";
                        self::protocole();   
                    }             
                }
                else
                {
                    echo "La commande n'est pas reconnu. ( man de myGitLIght ==> mgl --help )\n";
                    self::protocole();   
                }
            }
            else
            {
                echo "La saisi est invalide. ( man de myGitLIght ==> mgl --help )\n";
                self::protocole();
            }             
        }
    }
/*  A   R   G   U   M   E   N   T   S   _______    M   E   T   H   O   D */


    public function protocole_init($path = null)
    {
        $path = realpath("./");
        if(is_writable($path) && is_readable($path))
        {
            if(file_exists($path.'/.MyGitLight'))
            {
                echo "MyGitLight : This folder already has a .myGitLight folder !\n";
                self::protocole();
            }
            else
            {
                mkdir($path.'/.MyGitLight', $mode = 0777, $recursive = true);
                mkdir($path.'/.MyGitLight/add/', $mode = 0777, $recursive = true); 
                mkdir($path.'/.MyGitLight/commit/', $mode = 0777, $recursive = true);
                fopen(".MyGitLight/log",'a+');
                copy('myGitLight.php',$path.'/.MyGitLight/myGitLight.php');
                echo "Congratulation ! Your Repository has been save in $path\n\n";
                self::protocole();
            }
        }
        else
        {
            echo "Could not access : Bad Permission writing or/and writing\n";
            self::protocole();
        }
    }
    public function protocole_add_all()
    {
        $path = realpath("./");
        $dir = scandir($path);
        unset($dir[array_search('.', $dir, true)]);
        unset($dir[array_search('..', $dir, true)]);
        unset($dir[array_search('.MyGitLight', $dir, true)]);
        unset($dir[array_search('myGitLight.php', $dir, true)]);
        $dir = array_values($dir);
        if (is_writable($path) && is_readable($path))
        {
            foreach($dir as $arg => $value)
            {
                if (is_file("$path/$value"))
                {
                    $exec = "cp $value $path/.MyGitLight/add/";
                    shell_exec($exec);
                    echo "Your file has been added : $value\n";
                }
                elseif (is_dir("$path/$value"))
                {
                    $exec = "cp -r $value/ $path/.MyGitLight/add/";
                    shell_exec($exec);
                    echo "Your directory has been added : $value\n";
                }
                else
                {
                    exit("\nune erreur a été detectée. : copie corrompue\n");
                }
            }
        }
        else
        {
            exit("Impossible d'écrire dans le dossier.\n");
        }

        self::protocole();
    }
    public function protocole_add_file($cmd = null)
    {
        echo "êtes-vous sur de vouloir copier les fichiers/répertoires suivant :\n";
        unset($cmd[0]);
        unset($cmd[1]);
        foreach($cmd as $key => $value)
        {
            echo $value . "\n";
        }
        echo "Entrez y pour valider : n pour revenir en arrière\n";
        $cmd2       = "";
        $path       = realpath("./");
        $cmd2       = readline($cmd2);
        $cmd2       = trim($cmd2);
        if ($cmd2 == "y" || $cmd2 == "yes" || $cmd2 = "Y")
        {
            if (is_writable($path) && is_readable($path))
            {
                foreach($cmd as $key => $value)
                {
                    if (is_file("$path/$value"))
                    {
                        $exec = "cp $value $path/.MyGitLight/add/";
                        shell_exec($exec);                    
                    }
                    elseif (is_dir("$path/$value/"))
                    {
                        $exec = "cp -r $value/ $path/.MyGitLight/add/";
                        shell_exec($exec);                    
                    }
                    else
                    {
                        exit("Erreur lors de la copie");
                    }
                }                
            }
            else
            {
                exit("Impossible d'écrire dans le dossier.\n");
            }
        }
        elseif ($cmd2 == "n" || $cmd2 == "no" || $cmd2 == "non")
        {
            self::protocole();
        }
        else
        {
            echo "Je ne comprends pas...";
        }
        self::protocole();
    }
    public function protocole_rm_all()
    {
        $path = realpath("./");
        $cmd    = scandir('./');
        unset($cmd[0]);
        unset($cmd[1]);
        $key   = array_search("myGitLight.php", $cmd);
        unset($cmd[$key]);
        $cmd    = array_values($cmd);
        if (file_exists("$path/.MyGitLight/"))
        {
            $key    = array_search(".MyGitlight", $cmd);
            unset($cmd[$key]);            
        }
        echo "Vous êtes sur le point de supprimer tous les fichiers et dossier présent :\n";
        echo "Entrez y pour valider : n pour revenir en arrière\n";
        $cmd2   = "";
        $cmd2   = readline($cmd2);
        $cmd2   = trim($cmd2);
        $a      = 2;
        static $w = 1;
        if ($cmd2 == "y" || $cmd2 == "yes")
        { 
            if (is_writable($path) && is_readable($path))
            {
                foreach ($cmd as $key => $value)
                {
                    if (is_file("$path/$value") && file_exists("$path/$value"))
                    {
                        shell_exec('rm -rf ' . $cmd[$key]);
                    }
                    elseif (is_dir("$path/$value") && file_exists("$path/$value/"))
                    {
                        $value = $value . "/";
                        shell_exec('rm -rf ' . $cmd[$key]);
                    }
                    else
                    {
                        echo "Suppression de tous les fichiers impossible : fichier ou dossier peut-être manquant ou format incorrecte.\n";
                        $w--;
                    }
                }                
            }
            else
            {
                exit("Problème de droit d'accès dans le dossier");
            }
            if ($w == 1)
            {
                echo "Tous les fichiers ont été supprimés avec succès !\n";
                self::protocole();
            }
        }
        else if ($cmd2 == "n" || $cmd2 == "no" || $cmd2 == "non")
        {
            self::protocole();
        }
        else
        {
            echo "Je ne comprends pas";
        }
        self::protocole();
    }
    public function protocole_rm_file($cmd = null)
    {
        $path = "";
        $path = realpath($path);
        echo "êtes vous certains de vouloir supprimer les fichiers suivant :\n";
        unset($cmd[0]);
        unset($cmd[1]);
        $i     = 0;
        foreach ($cmd as $key => $value)
        {
            $i++;
            echo "$value\n";
        }
        echo "Entrez y pour valider : n pour revenir en arrière\n";
        $cmd2   = "";
        $cmd2   = readline($cmd2);
        $cmd2   = trim($cmd2);
        if ($cmd2 == "y" || $cmd2 == "yes")
        {
            foreach ($cmd as $key => $value)
            {
                if (is_file("$path/$value") && file_exists("$path/$value"))
                {
                    shell_exec('rm -rf ' . $cmd[$key]);
                }
                elseif (is_dir("$path/$value/") && file_exists("$path/$value/"))
                {
                    shell_exec('rm -rf ' . $cmd[$key] . "/");                    
                }
            }
        }
        else if ($cmd2 == "n" || $cmd2 == "no" || $cmd2 == "non")
        {
            self::protocole();
        }
        else
        {
            echo "Commande incorrecte : veuillez réessayer";
        }
        self::protocole();
    }
    public function protocole_commit_all($cmd = null)
    {
        $path = realpath("./");
        $cmd = scandir($path);
        unset($cmd[0]);
        unset($cmd[1]);
        unset($cmd[array_search('.MyGitLight', $cmd, true)]);
        unset($cmd[array_search('myGitLight.php', $cmd, true)]);
        $id = uniqid();
        $total = "";

        foreach($cmd as $key => $value)
        {
            if (is_file("$path/$value") && file_exists("$path/$value"))
            {
                $total = $total . " " . $value;
            }
            elseif (is_dir("$path/$value/") && file_exists("$path/$value/"))
            {
                $total = $total . " " . $value . "/";
            }
            else
            {
                exit("erreur de compilation");
            }
        }
        $total = trim($total);
        shell_exec("tar -cf .MyGitLight/commit/$id $total");
        if (file_exists("./.MyGitLight/log"))
        {
            $fp = fopen("./.MyGitLight/log", 'a+');
            echo "Entrez le message de commit\n";
            $msg = readline();
            fwrite($fp, "$id $msg\n");
            fclose($fp);
            echo "your commit has been commited to $path/.MyGitLight/$id\n";
        }
        self::protocole();
    }
/*     public function protocole_log($cmd = null)
    {
        echo ;
    } */

    public function protocole_man()
    {
        echo "\n\n__________________________\n\n";
        echo "man de myGitLight :\n\n";
        echo "mgl add       (-A) | (--all) | (*)    : Copie le répertoire courant ainsi que tous les dossiers, sous dossiers.\n\n";
        echo "mgl commit    \"yourCommitName\"      : Créer une archive tar de vos fichiers, dossiers et sous répertoires.\n\n";
        echo "mgl rm        (-A) | (--all) | (*)    : Supprime tous les fichiers du répertoire excepté .myGitLight\n\n";
        echo "mgl rm        \"nameFile\" \"nameFile2\"  : Supprime le/les fichier(s) spécifié(s)";
        echo "\n__________________________\n";
        echo "Souhaitez-vous continuer ?            (y/n)\n\n";
        self::protocole();
    }
}

$foo = new myGitLight();
$foo->protocole();