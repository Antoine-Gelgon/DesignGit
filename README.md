DesignGit
=========

Design adapted Git web interface using [php-github-api](https://github.com/KnpLabs/php-github-api).

Usage
=====

This version is developped for [BoxonGit](http://boxon.info). To use you own gits, open `allRepos.php`, set the number of users you want to browse to the `getRepos` function arguments and the variables below then change the line `getRepos($client, 'Antoine-Gelgon', 'XavierKlein', 'baladurzgate', 'EtienneOz', 'ivangrozny', 'Boxon-');` to the usernames you want.

In order to increase the [rate limit](https://developer.github.com/v3/#rate-limiting) fixed by GitHub, you'll need to authenticate. Open `index.php` and paste your auth key at the `$authKey` variable.

License
=======
DesignGit is under the [GNU/GPL V2](https://www.gnu.org/licenses/gpl-2.0.txt) license!
