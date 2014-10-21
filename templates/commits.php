<?php

$commits = $client->api('repo')->commits()->all($repoOwner, $repoName, array('sha' => 'master'));

// Markdown lib
spl_autoload_register(function($class){
  require preg_replace('{\\\\|_(?!.*\\\\)}', DIRECTORY_SEPARATOR, ltrim($class, '\\')).'.php';
});
use Michelf\Markdown;

  echo ('<div class="commits">');
    echo ('<h1>Commits</h1>');
    foreach ($commits as $commit) {
      echo ('<div class="commit">');
        echo('Author: '.$commit['commit']['author']['name'].'<br/>');
        echo('date: '.$commit['commit']['author']['date'].'<br/>');
        $html = Markdown::defaultTransform($commit['commit']['message']);
        echo '<p class="content">' .$html. '</p>';
      echo ('</div><br/>');
    }
  echo ('</div>');

?>
