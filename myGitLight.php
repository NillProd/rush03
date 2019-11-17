<?php

class myGitLight
{
    public function protocole()
    {
        unset($cmd);    // Sert à unset lors d'un retour d'appel de fonction
        $z      = 0;
        if ($z == 0)    // boucle infini pour protocole() - l'utilisateur pourra réitérer ses commandes
        {
            echo "Bienvenue dans myGitLight v0.1: une version light et efficace\nQue souhaitez vous faire ?  (mgl --help pour voir toutes les commandes)\n<!> Attention les commandes sont sensibles à la casse <!>\n";
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
    /*  C   H   E   C   K   E   D  ___  M   E   T   H   O   D */
                elseif ($cmd == "exit" || $cmd == "close" || $cmd == "leave" || $cmd == "stop")
                {
                    exit("\nMerci d'avoir utilisé notre programme ! à bientôt");
                }
                elseif ($cmd == "je suis un noob")
                {
                    echo "Pas de chance : il faut travailler pour progresser";
                }
    /*  A   R   G   U   M   E   N   T   S   _______    M   E   T   H   O   D */
                $cmd = explode(" ",$cmd);       // conversion tableau pour arguments
                if ($cmd[1] == "rm")
                {
                    $this->protocole_rm_file($cmd);
                    self::protocole_rm_file();
                }
                elseif ($cmd[1] == "add")
                {
                    $this->protocole_add_file($cmd);
                    self::protocole_add_file();
                }
                else if ($cmd [1] == "")
                {
                    echo "le champ est vide";
                    self::protocole();
                }
                elseif
            }
            else
            {
                echo "La commande entré est invalide.";
                self::protocole();
            }             
        }
    }
/*  A   R   G   U   M   E   N   T   S   _______    M   E   T   H   O   D */


    public function protocole_init($path = null) // Ne Pas Toucher ! Ou Bug a Debug Ces Chiant !
    {
        $path = realpath($path[1]);
        if(!file_exists($path))
        {
        return "Could not access $path\n"; //Bug ici l'ancien echo s'executait tout le temps
        self::protocole();
        return 1;                         // que ce soit vrai ou faux.
        }
        else
        {
            {
            if(is_writable($path) && is_readable($path)){
                if(file_exists($path.'/.MyGitLight'))
                {
                echo "MyGitLight : This folder already has a myGitLight !\n";
                self::protocole();
                return 1;
                }
                else
                {
                mkdir($path.'/.MyGitLight', $mode = 0777, $recursive = true);
                mkdir($path.'/.MyGitLight/add/', $mode = 0777, $recursive = true); 
                copy('myGitLight.php',$path.'/.MyGitLight/myGitLight.php');
                echo "Congratulation ! Your Repository has been save in $path\n";
                }
            }
            else
            {
                echo "Could not access : Bad Permission\n";
                self::protocole();
                return 1;
            }
            }
        }
    }
    public function protocole_add_all()
    {
        $path = realpath($path);
        if(is_dir($path))
        {
          $dir = scandir($path);
          unset($dir[array_search('.', $dir, true)]);
          unset($dir[array_search('..', $dir, true)]);
          unset($dir[array_search('.MyGitLight', $dir, true)]);
          unset($dir[array_search('myGitLight.php', $dir, true)]);
          $dir = array_values($dir);
      
          foreach($dir as $arg => $value)
            {
                echo "je suis la\n";
                $exec = "cp $value $path/.MyGitLight/add/";
                echo $exec;
                shell_exec($exec);
            }
        }
    }
    public function protocole_add_file($cmd = null)
    {
        echo "êtes-vous sur de vouloir copier les fichiers/répertoires suivant :\n";
        unset($cmd[0]);
        unset($cmd[1]);
        $cmd = array_values($cmd);
        foreach($cmd as $key => $value)
        {
            echo $value . "\n";
        }
        echo "Entrez y pour valider : n pour revenir en arrière\n";
        $cmd2 = "";
        $path = realpath($path);
        $cmd2 = readline($cmd2);
        $cmd2 = trim($cmd2);
        if ($cmd2 == "y" || $cmd2 == "yes" || $cmd2 = "Y")
        {
            foreach($cmd as $key => $value)
            {
                $exec = "cp $value $path/.MyGitLight/add/";
                shell_exec($exec);
            }
        }
        else
        {
            exit();
        }
    }
    public function protocole_rm_all()
    {
        $cmd    = scandir('./');
        array_shift($cmd);
        array_shift($cmd);
        $key    = array_search(".myGitlight", $cmd); // dossier caché myLightGit
        $key2   = array_search("myGitLight.php", $cmd); // fichier principale .myGitLight
        unset($cmd[$key]);
        unset($cmd[$key2]);
        $cmd    = array_values($cmd); // reindex les clefs de manière croissante
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
                shell_exec('rm -rf ' . $cmd[$key]);
            }
            foreach ($cmd as $key => $value)
            {
                $value = $value . "";
                shell_exec('rm -rf ' . $cmd[$key]);
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
        print_r($cmd);
        exit("\nEND___");
    }
    public function protocole_rm_file($cmd = null)
    {
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
        $a      = 2;
        if ($cmd2 == "y" || $cmd2 == "yes")
        {
            while($cmd[$a] <= $cmd[$i])
            {
                unlink("./$cmd[$a]");
                $a++;
            }
            unlink("./$cmd[$a]");
        }
        else if ($cmd2 == "n" || $cmd2 == "no" || $cmd2 == "non")
        {
            self::protocole();
        }
        else
        {
            echo "Commande incorrecte : veuillez réessayer";
        }
    }
    public function protocole_commit($cmd = null)
    {

    }
    public function protocole_man()
    {
        echo "\n\n__________________________\n\n";
        echo "man de myGitLight :\n\n";
        echo "mgl add       (-A) | (--all) | (*)    : Copie le répertoire courant ainsi que tous les dossiers, sous dossiers.\n\n";
        echo "mgl commit    (\"yourCommitName\")      : Créer une archive tar de vos fichiers, dossiers et sous répertoires.\n\n";
        echo "mgl rm        (-A) | (--all) | (*)    : Supprime tous les fichiers du répertoire excepté .myGitLight\n\n";
        echo "mgl rm        (nameFile) (nameFile2)  : Supprime le/les fichier(s) spécifié(s)";
        echo "\n__________________________\n";
        echo "Souhaitez-vous continuer ?            (y/n)\n\n";
        exit();
    }
}

$foo = new myGitLight(); // en POO il est obligatoire de déclarer sa classe 
$foo->protocole();       // on peux ensuite EXECUTE une méthode (fonction) pour lancer le script dedans
/**
 * INTERDIT : 
 * - 
 */