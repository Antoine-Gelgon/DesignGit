<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>BoxonGit</title>
    <link href="styles/style.css" rel="stylesheet" type="text/css" media="print, screen" />
    <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/tree.js"></script>
  </head>
  <body>
    <div class="description">
      <h1> BoxonGit </h1>
      This is BoxonGit, a list of design works as Git repositories. All of these works are under a <a href="https://en.wikipedia.org/wiki/Copyleft" target="_blank"> Copyleft license</a>, feel free to use, study, modify and redistribute them as long as the license terms are respected.
    </div><br/>
    <?php

    # Debug
    ini_set('display_startup_errors', '1');
    ini_set('display_errors','1');

    require_once 'vendor/autoload.php';

    # Cache

    $client = new \Github\Client(
        new \Github\HttpClient\CachedHttpClient(array('cache_dir' => '/tmp/github-api-cache'))
    );

    // Or select directly which cache you want to use
    $client = new \Github\HttpClient\CachedHttpClient();
    $client->setCache(
        // Built in one, or any cache implementing this interface:
        // Github\HttpClient\Cache\CacheInterface
        new \Github\HttpClient\Cache\FilesystemCache('/tmp/github-api-cache')
    );

    $client = new \Github\Client($client);

    include ('templates/allRepos.php');

    ?>

  </body>
</html>
