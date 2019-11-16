<?php

$tableau = $argv;
$parametre = $argc;

function init() {
  global $tableau;
  global $parametre;
  if ($parametre > 2) { //Debug ici, Problème au niveau du paramètre 1.
    if(!file_exists($tableau[2])) {
      echo "could not access $tableau[2]\n";
      return 1;
    } else {
      if (is_writable($tableau[2]) && is_readable($tableau[2])) {
        if(file_exists($tableau[2].'./.MyGitLight')) { //debug ici le path n'avait pas été donné en argument.
          echo ".myGitLight : this folder has already a myGitLight\n";
          return 1;
        } else {
          mkdir($tableau[2].'/.MyGitLight', $mode = 0777, $recursive = true);
          mkdir($tableau[2].'/.MyGitLight/add', $mode = 0777, $recursive = true);
          mkdir($tableau[2].'/.MyGitLight/commit', $mode = 0777, $recursive = true);
          mkdir($tableau[2].'/.MyGitLight/log', $mode = 0777, $recursive = true);
          copy('MyGitLight.php',$tableau[2].'/.MyGitLight/MyGitLight.php');
          return 0;
        }
      } else {
        echo "Could not access folder : Bad Permission\n";
        return 1;
      }
    }
  } else {
    echo "A folder is needed\n";
    return 1;
  }
}
function add_all() {

}
function add() {}
