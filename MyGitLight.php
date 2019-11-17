<?php
/*
*Projt rush 3 My Git Light.
*Contribution au Projet Rush 3 :
*Judikaël Bellance (Chef de projet).
*Axel Nzue.
*Thomas Skenazi.
*Samsung Campus Promo 2021.
*/
Class MyGit {
  private $argv;
  private $argc;
  private $dir;
  private $file_search;

  public function __construct() {
      $this->argv = $tableau;
      $this->argc = $parametre;
      $this->dir = $dir;
      $this->file_search = $file_search;
  }
  public function init () //Etape 1.
  {
  //on vérifie que l'utilisateur ne nous prends pas pour un pigeons :)
  //ici on vérifie que l'utilisateur a bien rentré le paramètre
  //d'initialisation.
  if($parametre > 2)
  {   //Ici on vérifie que les fichier existe pas.
      if(!file_exists($tableau[2]))
      {
        echo "Could not access : ".$tableau.".\n";
        echo "Create them or restart this script\n";
        return 1;
      }
      else
      {
        //Si les fichie   r existe on vérifie les droits écriture et lecture.
        if(is_writable($tableau[2] && is_readable($tableau[2])))
        {
          //Si les permission sont ok, on peux alors vérifié si il n'y a pas
          //un fichier .myGitLight.
          if(file_exists($tableau[2].'/.MyGitLight'))
          {
            echo "This folder already has a myGitLigth\n";
            return 1;
          }
          else {
            {
              //Si le MyGitLight n'existe pas on peux créér les fichier
              //dont on a besoin, puis intégré le code source au passage.
              //on créér dans le path donné en argument les dossier dont
              //l'utilisateur a besoin pour gérer son repo.
              //on donne les droits pour ne pas avoir d'erreur, puis on utilise
              //la récursivité de mkdir pour parcourir tous les dossiers
              //Merci PHP !
              mkdir($tableau[2].'/.MyGitLight', 0777, true);
              mkdir($tableau[2].'/.MyGitLight/add', 0777, true);
              mkdir($tableau[2].'/.MyGitLight/commit', 077, true);
              mkdir($tableau[2].'/.MyGitLight/log', 0777, true);
              copy('MyGitLight.php',$tableau[2].'/.MyGitLight/MyGitLight.php');
              return 0;
            }
          }
        }
        else
        {
          echo "Could not access folder : Bad Permission\n";
          return 1;
        }
      }
  }
  else
  {
    echo "A folder is needed.\n";
    return 1;
  }
}

/*public function add($dir) //Etape 2.
{
  //On vérifie que que le fichier entrer est bien un dossier.
  if(is_dir($dir))
  {
    //On supprime les ancienne valeur que l'on vas ensuite remplacer,
    //Ici on utilise le tableau (La seul façon que l'on a trouver pour effectué
    //ceci),puis on vérifie que les les fichier sont identique a ceux qui y sont présent.
    $file_search = scandir($dir);
    unset($file_search[array_search('.',$file_search,true)]);
    unset($file_search[array_search('..',$file_search,true)]);
    unset($file_search[array_search('.',$file_search,true)]);
    copy('MyGitLight.php' $tableau[2].'/.MyGitLight/MyGitLight.php');
  }
  else
  {
    //on ajoute ici les nouvelles valeurs du add dans le dossier spécifique a add.
    copy("$dir", ".MyGitLight/add/".$dir);
    //Ici on créér de la récursivité en parcourant un tableau
    foreach($file_search as $recursivity)
    {

    }
  }
}
  public function commit ()
  {

  }

  public function rm ()
  {

  }

  public function log ()
  {

  }
*/
}
$foo = new MyGit();
$foo->init();
