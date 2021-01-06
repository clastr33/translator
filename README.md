Vergleich.tagesspiegel.de ![Logo](https://vergleich.tagesspiegel.de/tagesspiegel-logo.png)]
=========

The most desirable products in comparison
Compare products quickly and easily with our practical guides. From suitable articles for everyday life to clever solutions in financial planning and much more.

--------------------

**Production site:** https://vergleich.tagesspiegel.de

**Stage site:** https://ts-vgl.stage.knopp-media.de

**Repository:** https://github.com/tedyme/vgl-tsp

--------------------


Setup of servers
---------
Some configuration files are not included into the repository.

#### wp-config.php on Stage and Production servers

Add to the end of file:

define('PROJECT_DOMAIN_NAME', 'vergleich.tagesspiegel.de');
define('PROJECT_PROXY_NAME', 'ts-proxy.knopp-media.de');

define('PROJECT_PROTOCOL', 'https://');

define('PROJECT_DOMAIN_URL', PROJECT_PROTOCOL . PROJECT_DOMAIN_NAME);
define('PROJECT_PROXY_URL', PROJECT_PROTOCOL . PROJECT_PROXY_NAME);

define('PROJECT_PATH', '/var/www/tagesspiegel.de/vergleich');


---------
#### wp-config.php on Local server

Add to the end of file, for example:

define('PROJECT_DOMAIN_NAME', 'vergleich.dev');
define('PROJECT_PROXY_NAME', 'vergleich.dev');

define('PROJECT_PROTOCOL', 'http://');

define('PROJECT_DOMAIN_URL', PROJECT_PROTOCOL . PROJECT_DOMAIN_NAME);
define('PROJECT_PROXY_URL', PROJECT_PROTOCOL . PROJECT_PROXY_NAME);

define('PROJECT_PATH', 'd://openserver536basic/domains/vergleich.dev');
