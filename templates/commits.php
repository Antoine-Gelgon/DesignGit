<?php

$commits = $client->api('repo')->commits()->all($repoOwner, $repoName, array('sha' => 'master'));

  echo ('<div class="commits">');
    echo ('<h1>Commits</h1>');
    foreach ($commits as $commit) {
      echo ('<div class="commit">');
        echo('Author: '.$commit['commit']['author']['name'].'<br/>');
        echo('date: '.$commit['commit']['author']['date'].'<br/>');
        echo('content: '.$commit['commit']['message'].'<br/>');
      echo ('</div><br/>');
    }
  echo ('</div>');

?>
