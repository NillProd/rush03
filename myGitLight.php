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
            if ($cmd == "mgl --help"){
                self::protocole_man();
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
        }
    }
    public function protocole_add_all()
    {
        
    }
    public function protocole_add_file()
    {

    }
    public function protocole_rm_all()
    {

    }
    public function protocole_rm_file()
    {

    }
    public function protocole_commit()
    {

    }
    public function protocole_man()
    {
        echo "\n\n__________________________\n\n";
        echo "man de myGitLight :\n\n";
        echo "mgl add -A, --all, * | Ajouter tous les fichiers pour le pré-versionning\nmgl add namefile namefile2 | for focusing file\n\n";
        echo "mgl commit \"commitName\" | updating your log file and update status\n\n";
        echo "mgl rm -A, --all, * | Supprime tous les fichiers du répertoire excepté .myGitLight\n";
        echo "mgl rm nameFile nameFile2 | supprime le/les fichier(s) spécifié(s)\n\n";
        echo "Souhaitez-vous continuer ? (y/n)";
        
        exit();
    }
}

$foo = new myGitLight();
$foo->protocole();
/**
 * INTERDIT : 
 * - 
 */