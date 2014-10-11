<?php

  // Api method
//  $readme = $client->api('repo')->contents()->readme($repoOwner, $repoName, $reference);

  // Markdown lib
  spl_autoload_register(function($class){
    require preg_replace('{\\\\|_(?!.*\\\\)}', DIRECTORY_SEPARATOR, ltrim($class, '\\')).'.php';
  });
  use Michelf\Markdown;

  // Second method, seem more flexible but need conditionnals for non standard
  // repo (like README.txt)

  $txt = 'https://raw.githubusercontent.com/' .$repoOwner. '/' .$repoName. '/master/README.txt';
  $md = 'https://raw.githubusercontent.com/' .$repoOwner. '/' .$repoName. '/master/README.md';

  $array = get_headers($txt);
  $string = $array[0];
  if(strpos($string,"200")) {
    $readMe = file_get_contents($txt);
  } else {
    $readMe = file_get_contents($md);
  }

  $html = Markdown::defaultTransform($readMe);

  echo '<div class="readMe">';
    echo $html;
  echo '</div>';

?>
