.. include:: /Includes.rst.txt

====
Iis7
====

Just my two cents and four pennies while setting up a TYPO3 site under
Windows Server 2008 and IIS7

PHP
===

I'm using the FastCGI implementation that is shipped with IIS7. For best
performance and stability use the non-thread safe version of PHP. To
make TYPO3 run somewhat usable, you should set up a PHP opcode cache
extension. There are several different implementations out there
(google: APC, XCache, eaccelerator). Right now i'm testing XCache, as
it's the only one that comes in a non-thread safe (nts) version.

Installation instructions for PHP can be found at
`iis.net <http://learn.iis.net/page.aspx/246/using-fastcgi-to-host-php-applications-on-iis-70/>`__

IIS7 Caching
============

IIS7 supports two caching mechanism: Usermode & Kernel cache. Enable
Usermode cache for \*.php files, set the time intervall to something
reasonable and make sure to store different version for each query
string.

URL Rewriting
=============

To get proper URL rewriting for iIS7, download
http://www.iis.net/downloads/default.aspx?tabid=34&g=6&i=1691 The IIS7
extension comes with a nice GUI for setting up side-wide or per
directory rewriting.

Conversion from Apache's mod_rewrite it straight forward. I simply added
the rules. The first two stop rewriting for TYPO3 directories and the
showpic PHP script. Last rule passes everything to index.php under two
conditions (request is not a file or directory):

::

          <rewrite>
              <rules>
                  <clear />
                  <rule name="T3 Static Files & Dirs" stopProcessing="true">
                      <match url="^/(typo3|typo3temp|typo3conf|t3lib|tslib|fileadmin|uploads|showpic\.php)$" />
                  </rule>
                  <rule name="T3 Static Files & Dirs (Child requests)" stopProcessing="true">
                      <match url="^/(typo3|typo3temp|typo3conf|t3lib|tslib|fileadmin|uploads|showpic\.php)/.*$" />
                  </rule>
                  <rule name="Rewrite Rule & Condition">
                      <match url="(.*)" />
                      <action type="Rewrite" url="index.php" />
                      <conditions>
                          <add input="{REQUEST_FILENAME}" matchType="IsFile" negate="true" />
                          <add input="{REQUEST_FILENAME}" matchType="IsDirectory" negate="true" />
                      </conditions>
                  </rule>
              </rules>
          </rewrite>

IIS7 uses XML config files. If you use the GUI it will be written to
web.config for sites & directories. If your TYPO3 root directory already
has a web.config file, simply paste it into the <system.webserver />
section

For CoolURI i had to add

::

   $TYPO3_CONF_VARS['SYS']['requestURIvar'] = '_SERVER|HTTP_X_ORIGINAL_URL';

to my /typo3conf/LocalConfiguration.php
