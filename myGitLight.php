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
                elseif($cmd == "clear")
                {
                  @system('clear');
                }
    /*  C   H   E   C   K   E   D  ___  M   E   T   H   O   D */
                elseif ($cmd == "exit" || $cmd == "close" || $cmd == "leave" || $cmd == "stop")
                {
                    exit("\nMerci d'avoir utilisé notre programme ! à bientôt !\n");
                }
                elseif ($cmd == "je suis un noob")
                {
                    echo "\nPas de chance : il faut travailler pour progresser !\n";
                }
    /*  A   R   G   U   M   E   N   T   S   _______    M   E   T   H   O   D */
                $cmd = explode(" ",$cmd);       // conversion tableau pour arguments
                if (array_search('rm',$cmd) == "rm")
                {
                    $this->protocole_rm_file($cmd);
                    self::protocole_rm_file();
                }
                elseif (array_search('add',$cmd) == "add")
                {
                    $this->protocole_add_file($cmd);
                    self::protocole_add_file();
                }
                elseif (array_search('commit',$cmd) == "commit")
                {
                    $this->protocole_commit($cmd);
                    self::protocole_commit();
                }
            }
            else
            {
                echo "La saisi est invalide. ( man de myGitLIght ==> mgl --help )";
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
                mkdir($path.'/.MyGitLight/log/', $mode = 0777, $recursive = true);
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
    public function protocole_add_all($path = null)
    {
        $path = realpath($path[1]);
        $dir = scandir($path);
        unset($dir[array_search('.', $dir, true)]);
        unset($dir[array_search('..', $dir, true)]);
        unset($dir[array_search('.MyGitLight', $dir, true)]);
        unset($dir[array_search('myGitLight.php', $dir, true)]);
        $dir = array_values($dir);
        foreach($dir as $arg => $value)
        {
            if (is_file("$path/$value"))
            {
                $exec = "cp $value $path/.MyGitLight/add/";
                shell_exec($exec);
                echo "Congratulation ! Your file : $value is added to .MyGitLight/add/\n";
            }
            elseif (is_dir("$path/$value"))
            {
                $exec = "cp -r $value/ $path/.MyGitLight/add/";
                shell_exec($exec);
                echo "Congratulation ! Your file : $value is added to .MyGitLight/add/\n";
            }
            else
            {
                echo "\nune erreur a été detectée. : copie corrompue\n";
            }
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
            foreach($cmd as $key => $value)
            {
                if (is_file("$path/$value"))
                {
                    $exec = "cp $value $path/.MyGitLight/add/";
                    shell_exec($exec);
                }
                elseif (is_dir("$path/$value"))
                {
                    $exec = "cp -r $value/ $path/.MyGitLight/add/";
                    shell_exec($exec);
                }
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
        array_shift($cmd);
        array_shift($cmd);
        $key    = array_search(".MyGitlight", $cmd);
        $key2   = array_search("myGitLight.php", $cmd);
        unset($cmd[$key]);
        unset($cmd[$key2]);
        $cmd    = array_values($cmd);
        echo "êtes vous certains de vouloir supprimer les fichiers suivant :\n";
        foreach ($cmd as $key => $value)
        {
            echo $value . "\n";
        }
        echo "Entrez y pour valider : n pour revenir en arrière\n";
        $cmd2   = "";
        $cmd2   = readline($cmd2);
        $cmd2   = trim($cmd2);
        $a      = 2;
        if ($cmd2 == "y" || $cmd2 == "yes")
        {
            foreach ($cmd as $key => $value)
            {
                if (is_file("$path/$value"))
                {
                    shell_exec('rm -rf ' . "./.MyGitLight".$cmd[$key]);
                }
                elseif (is_dir("$path/$value"))
                {
                    $value = $value . "/";
                    shell_exec('rm -rf ' . "./.MyGitLight".$cmd[$key]);
                }
            }
            echo "Tous les fichiers ont été supprimés avec succès !";
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
        exit("\nEND___");
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
                if (is_file("$path/$value"))
                {
                    shell_exec('rm -rf ' . $cmd[$key]);
                    echo "Your file : $cmd[$key] has been deleted !\n";
                }
                elseif (is_dir("$path/$value"))
                {
                    $value = $value . "/";
                    shell_exec('rm -rf ' . $cmd[$key]);
                    echo "Your file : $cmd[$key] has been deleted !\n";
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
    public function protocole_commit_all($parametre = null,$path = null, $tableau = null)
    {
      $path =  realpath($path);
      var_dump($tableau = scandir($path));
      unset($tableau[array_search('myGitLight.php',$tableau,true)]);
      
      if(true)
      {
        echo "je suis ici !\n";
        $compress = new PharData("./.MyGitLight/commit".basename($tableau[2]).".tar");
        $compress->buildFromDirectory(".MyGitLight/add");
        $file = fopen("./.MyGitLight/log","w");
        fwrite($file, md5($tableau." ".$tableau."\n"));
        self::protocole();
      }
      else
      {
        echo "je suis la dans le else !\n";
      }
    }
    public function protocole_man()
    {
        echo "\n\n__________________________\n\n";
        echo "man de myGitLight :\n\n";
        echo "mgl add       (-A) | (--all) | (*)    : Copie le répertoire courant ainsi que tous les dossiers, sous dossiers.\n\n";
        echo "mgl commit    \"yourCommitName\"      : Créer une archive tar de vos fichiers, dossiers et sous répertoires.\n\n";
        echo "mgl rm        (-A) | (--all) | (*)    : Supprime tous les fichiers du répertoire excepté .myGitLight\n\n";
        echo "mgl rm        \"nameFile\" \"nameFile2\"  : Supprime le/les fichier(s) spécifié(s)\n\n";
        echo "clear__________________________________:nettoie toute les instruction afficher a l'écran\n\n";
        echo "\n__________________________\n";
        //echo "Souhaitez-vous continuer ?            (y/n)\n\n";
        self::protocole();
    }
}
$foo = new myGitLight(); // en POO il est obligatoire de déclarer sa classe
$foo->protocole();       // on peux ensuite EXECUTE une méthode (fonction) pour lancer le script dedans
/**
 * INTERDIT :
 * -
 */
