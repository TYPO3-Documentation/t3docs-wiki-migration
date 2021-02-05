.. include:: /Includes.rst.txt
.. highlight:: php

====================
Introduction Package
====================

Description
===========

**TYPO3** is a content management system written in PHP and using a
supporting database management system. A typical TYPO3 download package
consists of a core and a few extensions, with a large number of
additional extensions available for installation on demand. For more
information about TYPO3, visit https://typo3.org/ .

The **TYPO3 Introduction Package** is a TYPO3 extension meant for
first-time administrators and users who would install and operate their
own TYPO3 site. It is designed to quickly install a TYPO3 site, where
the user can then browse the front end website to see some TYPO3
capabilities, and where the user can also access the back end to explore
editing and administration of the site.

For more information about the TYPO3 Introduction Package, visit the
download page at https://typo3.org/download/ ; the news page at
https://typo3.org/news/article/typo3-version-44-easier-than-ever-before/ ;
and the project page at
https://forge.typo3.org/projects/extension-introduction [outdated link]
. Also, the TYPO3 Introduction Package is the basis for the TYPO3
Getting Started Tutorial at
https://docs.typo3.org/typo3cms/GettingStartedTutorial .

Preparation
===========

The TYPO3 Introduction Package relies on some preparatory actions to be
done before installation. For a first-time user, these preparatory
actions are not plainly stated among the instructions in the expected
"Read me" and "Install" documents in the download package.

The Introduction Package uses the previously written (and already
included) TYPO3 1-2-3 Install Tool to guide the user through
installation steps. In its internal workings, though, the 1-2-3 Install
Tool requests directories from the web server, and assumes the web
server knows it wants the "index.php" file in those directories. Your
preparatory action here is to configure your web server to serve
"index.php" files automatically. If you are using the Apache HTTP
Server, edit its "httpd.conf" file (in its "Apache2.2/conf/" directory):
change its "DirectoryIndex index.html" line to read "DirectoryIndex
index.html index.php".

The Introduction Package uses another TYPO3 extension called RealURL.
RealURL requires the web server be configured to allow rewriting of the
package's virtual URLs into URLs that explicitly give name-value
parameters used internally in TYPO3. (The RealURL extension in the
Introduction Package will perform the actual rewriting: it just must be
permitted to do so.) If you are using the Apache HTTP Server, edit its
"httpd.conf" file: Uncomment (by removing the leading # character) the
"#LoadModule rewrite_module modules/mod_rewrite.so" line if set.

(Once you have extracted files and subdirectories for the package's
installation, you can find the RealURL manual at
"typo3conf/ext/realurl/doc/manual.sxw" , or you can find it online at
https://docs.typo3.org/typo3cms/extensions/realurl/ . If you don't have
permissions to edit "httpd.conf", you may want to create or edit a
".htaccess" file in the Apache Document Root folder of you domain. You
may also want to read http://wiki.apache.org/httpd/Htaccess or
https://httpd.apache.org/docs/2.4/howto/htaccess.html or
https://httpd.apache.org/docs/current/rewrite/ .)

TYPO3 relies on GraphicsMagick or ImageMagick to perform image
manipulation. (The TYPO3 program prefers GraphicsMagick, but
documentation often discusses ImageMagick by itself. Which program you
actually use is your choice.) GraphicsMagick and ImageMagick are
separate programs the user must choose, download and install
independently. If the user does so properly and before installing the
TYPO3 Introduction Package, the TYPO3 installation process should find
GraphicsMagick or ImageMagick automatically. To download and install
GraphicsMagick or ImageMagick, search the Internet with "TYPO3", either
"GraphicsMagick" or "ImageMagick", and your operating system included in
your search terms.

Installation
============

The TYPO3 Introduction Package is available for download at
https://typo3.org/download/ . Download the package to your local
workstation, then extract all its files and subdirectories to your local
web server's document root directory (which may be "htdocs/",
"public_html/", "www/", or a similar name).

Launch your web browser, and visit http://localhost/ [outdated link] .
You should see the first page of the TYPO3 1-2-3 Install Tool, which
says, "Welcome to the TYPO3 Install Tool," and presents a "continue"
button. You can click on the "continue" button to proceed to the next
installation step (page).

You can return to the 1-2-3 Installation at a later time by adding the
parameters "mode=123&step=1" to the install tool's url. Or enter
"http://localhost/typo3/install/index.php?mode=123&step=1&password=joh316
[outdated link]" into the web browser.

The next step is "Connect to your database host." Here, pick your
database management system (DBMS) driver; enter the username and
password you want to use to connect to the DBMS from TYPO3; and pick
your database host. (Your DBMS may require you to grant the username and
password separately from within the DBMS, before completing this step.)

The next step is "Select database." Here, either enter a name of a
database to create (recommended), or select an existing database.

The next step is "Choose a package." You can pick either "Introduction
package" (recommended) or "blank system".

The process now shows "Installation now in progress..." It may spend
several minutes showing this notice, then it will proceed to the next
step.

The next step is "Introduction package." Here, you enter a password used
for access during operation, and you may change a color scheme for the
website.

The next step says, "Congratulations, TYPO3 has been successfully
installed on your system!" You have completed the installation process.
You can click on a "go to your website" button to go to your new website
at http://localhost/ [outdated link] .

Subdirectory
------------

You can also use a subdirectory or your Apache Document Root to install
the Introduction Package. In this example the Document Root is
"/var/www/html/". Replace this if you have another Document Root on your
computer. You unzip all the files into the folder (subdirectory)
"/var/www/html/introductionpackage-4.6.6". This example is for the file
"introductionpackage-4.6.6.tar.gz". In this case you must follow these
steps.

-  Edit the file .htaccess in "/var/www/html/introductionpackage-4.6.6".
-  Modify the line 84 containing "#RewriteBase /" at the beginning and
   change it to "RewriteBase /introductionpackage-4.6.6"
-  Edit the file
   "/var/www/html/introductionpackage-4.6.6/typo3conf/settings/introduction.ts"
-  Set "domain = localhost".
-  Set "absRefPrefix = http://localhost/introductionpackage-4.6.6
   [outdated link]"

Removal
-------

If you encounter a problem during installation and want to start over,
here are steps to remove (or "uninstall") TYPO3.

-  Stop your web server if it is running. (If you leave it running, you
   may receive a cryptic "file in use" error message while deleting
   files.)
-  Delete all TYPO3 files and subdirectories from the web server's
   document root directory.
-  Start your web server, if you just stopped it.
-  Check your database management system, and delete or drop the
   database you just created if you reached that step during
   installation.

Operation
=========

The home page of the new Introduction Package website is
http://localhost/index.php [outdated link] . The home page is, in fact,
a program that will serve content pages, beginning with the "get
started" page that says, "Congratulations, you have successfully
installed TYPO3. So--what's next?" There are a number of links on the
page that point to both internal pages in the website and external pages
on the Internet. If you click on an internal page link (such as to
"About TYPO3" or "Features") and receive a "404 Not found" error
message, you probably have not configured the web server to rewrite the
virtual URLs being used, here. See the Preparation section, above.

The Introduction Package home page shows a primary navigation menu
across the upper part of the page, with a search bar on the left
followed by the internal links: "get started", "about TYPO3",
"features", "customizing TYPO3", "resources", "examples", and
"feedback". In the upper right corner is a "customer login" link meant
for front end user login, to reach restricted portions of the website.
In the middle of the page is a "log into TYPO3" link meant for back end
user login, to edit content and administer the site. At the bottom of
the page are a number of external links to pages at typo3.org and to
other sites with TYPO3 information.

Some of the internal pages in the website have secondary navigation
menus in the left column, leading to further internal pages. The
internal pages also have "breadcrumb navigation", just under the primary
menu.

Browsing the website yields explanations of various TYPO3
characteristics, and examples of a few TYPO3 capabilities. Viewing the
HTML source code for pages in the website gives further illustration of
what can be done, and leads to the CSS, JavaScript, GIF, and JPEG files
associated with the pages.

If you visit internal pages in which images are not behaving as
expected, you probably have not installed the GraphicsMagick or
ImageMagick program, at least not so TYPO3 could find it. See the tips
in the Problems section, below.

You can log in to the back end via the "log into TYPO3" link on the "get
started" page, or by visiting http://localhost/typo3/index.php [outdated
link] directly. Refer to the right column, "How do I log in," on the
"get started" page for username-password combinations.

In the back end (also spelled backend), you will see a menu of modules
in the left column, and a description of those modules in the middle of
the page when you first log in. (You can find these descriptions by
clicking on "About modules" in the left column, anytime.) If you click
on "Page" under "Web" in the left column, you will see a middle column
that shows a "page tree" (a hierarchical website page listing), at first
collapsed into a few lines with some right-pointing triangles. Click on
one of the triangles to expand the listing. Then click the name of a
page to show an area in which you can manipulate the page's contents.
Click on the triangle next to "TypoScript Templates" to expand its
listing; then click on one of the folder names underneath (such as
"system_configuration"); then click on "List" under "Web" in the left
column. To the right of the page tree, you will see a listing of the
TypoScript templates in that folder. To leave the back end, click on
"logout" in the upper right corner.

For further information about the TYPO3 back end, visit typo3.org
documentation pages or purchase one of the books written about TYPO3.

Problems
========

After you launch your web browser and visit http://localhost/ [outdated
link] , if you see a simple directory listing, you probably haven't
configured your web server to serve "index.php" files automatically.
(Or, you may not have restarted your web server so that it can read your
edits of its configuration files.) See the Preparation section, above.

During installation, you may find yourself suddenly in the classic TYPO3
Installation Tool, which was written before the 1-2-3 Install Tool and
is a more general approach to TYPO3 installation. The classic
Installation Tool has a menu containing items such as: "Basic
Configuration"; "All Configuration"; "Database Analyzer"; "Clean up";
"Backend admin"; "Logout from Install Tool". If you did not intend to
use the classic Installation Tool, you should exit it, then remove TYPO3
and start over with installation.

If you are taking time during installation, you may suddenly find you
are out of time. The TYPO3 installation process creates a temporary file
(named ENABLE_INSTALL_TOOL) and checks it periodically. Once the file is
an hour old, TYPO3 deletes the file. Since the next check doesn't find
the file, the installation process terminates. You may wish to solve
this problem manually, or remove TYPO3 and start over with installation.

If you experience a problem not described in this article, whether
during installation or operation of the TYPO3 Introduction Package, here
are a few tips.

-  Document your problem carefully. Copy any error messages, if they
   appear.
-  Search the Internet, including "TYPO3" as one of your search terms.
   If you have any error messages, copy them into your search terms,
   too.
-  Visit the project's "issues" page at
   https://forge.typo3.org/projects/extension-introduction/issues
   [outdated link] . That issues page lists and tracks bugs and features
   related to the Introduction Package.
-  If you can't find your exact problem and a solution, read TYPO3
   documentation. Visit the docs.typo3.org at
   https://docs.typo3.org/typo3cms/ [outdated link] . Search the
   Internet for "TYPO3 books". Visit the TYPO3 Wiki at
   https://wiki.typo3.org/ [outdated wiki link] . Browse TYPO3 mailing
   list archives, beginning at https://typo3.org/support/mailing-lists/
   [outdated link] . There is a LOT of documentation about TYPO3.
-  If, after searching and reading doesn't help, post a question on an
   appropriate, active TYPO3 mailing list.
-  If you have found an actual unreported bug in the program, post a bug
   report on the appropriate bug tracker site. See
   https://typo3.org/documentation/report-bugs/ [outdated link] and
   https://forge.typo3.org/ .
