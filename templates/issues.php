<?php

  // Markdown lib
  spl_autoload_register(function($class){
    require preg_replace('{\\\\|_(?!.*\\\\)}', DIRECTORY_SEPARATOR, ltrim($class, '\\')).'.php';
  });
  use Michelf\Markdown;

  $issues = $client->api('issue')->all($repoOwner, $repoName, array('state' => 'open'));
  if (count($issues) > 1){
    echo ('<div class="issues">');
      echo ('<h1>Issues</h1>');
      foreach ($issues as $issue) {
        echo ('<div class="commit">');
          echo('Author: '.$issue['user']['login'].'<br/>');
          echo('date: '.$issue['created_at'].'<br/>');
          echo('title: '.$issue['title'].'<br/>');
          $html = Markdown::defaultTransform($issue['body']);
          echo('<p>'.$html.'</p>');
        echo ('</div><br/>');
      }
    echo ('</div>');
  }

?>
