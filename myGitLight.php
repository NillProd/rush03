<?php

class myGitLight
{
    public function protocole()
    {
        unset($cmd);
        $z = 0;
        if ($z == 0)
        {
            echo "Bienvenue dans myGitLight v0.1: une version light et efficace\nQue souhaitez vous faire ?  (mgl --help pour voir toutes les commandes)\n";
            $cmd = readline();
            $cmd = trim($cmd);

/*  C   H   E   C   K   E   D   _   M   E   T   H   O   D */
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


/*  S   P   E   C   I   A   L_______M   E   T   H   O   D */
            $cmd = explode(" ",$cmd);
            if($cmd[1] == "rm")
            {
                $this->protocole_rm_file($cmd);
                self::protocole_rm_file();
            }
        }
    }
/*  S   P   E   C   I   A   L_______M   E   T   H   O   D */


    public function protocole_init($cmd = null)
    {
    }
    public function protocole_add_all($cmd = null)
    {
        
    }
    public function protocole_add_file($cmd = null)
    {

    }
    public function protocole_rm_all($cmd = null)
    {
        scandir('./');
    }
    public function protocole_rm_file($cmd = null)
    {
        echo "êtes vous certains de vouloir supprimer les fichiers suivant :\n";
        unset($cmd[0]);
        unset($cmd[1]);
        $i = 0;
        foreach ($cmd as $key => $value)
        {
            $i++;
            echo "$value\n";
        }
        echo "Entrez y pour valider : n pour revenir en arrière\n";
        $cmd2 = "";
        $cmd2 = readline($cmd2);
        $cmd2 = trim($cmd2);
        $a = 2;
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

        }
    }
    public function protocole_commit($cmd = null)
    {

    }
    public function protocole_man()
    {
        echo "\n\n__________________________\n\n";
        echo "man de myGitLight :\n\n";
        echo "mgl add -A, --all, * | Ajouter tous les fichiers pour le pré-versionning\nmgl add namefile namefile2 | for focusing file\n\n";
        echo "mgl commit \"commitName\" | updating your log file and update status\n\n";
        echo "mgl rm -A, --all, * | Supprime tous les fichiers du répertoire excepté .myGitLight\n\n";
        echo "mgl rm nameFile nameFile2 | supprime le/les fichier(s) spécifié(s)";
        echo "\n__________________________\n";
        echo "Souhaitez-vous continuer ? (y/n)\n\n";
        exit();
    }
}

$foo = new myGitLight();
$foo->protocole();
/**
 * INTERDIT : 
 * - 
 */