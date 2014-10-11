<?php

  $branch = $client->api('repo')->branches($repoOwner, $repoName, 'master');
  print_r ($branch);
?>
