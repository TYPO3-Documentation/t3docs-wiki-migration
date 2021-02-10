.. include:: /Includes.rst.txt

==============
GraphicsMagick
==============

<< Back to `Administrators <overview-administrator-manuals>`__ page

`[edit] <https://wiki.typo3.org/wiki/index.php?title=GraphicsMagick&action=edit&section=0>`__
[deprecated wiki link]

.. container::

   notice - This information is outdated

   .. container::

GraphicsMagick is originally derived from **ImageMagick 5.5.2**.

Since the branch from **ImageMagick**, many improvements have been made
by many authors using an open development model. GraphicsMagick is
available for free, may be used to support both open and proprietary
applications, and may be redistributed without fee.

This document helps you to correctly install
`GraphicsMagick <http://www.graphicsmagick.org/>`__ and use this instead
of ImageMagick. GraphicsMagick is an alternative to ImageMagick!

Finding
=======

   Download the latest version from the `GraphicsMagick FTP
   server <https://wiki.typo3.org/ftp://ftp.graphicsmagick.org/pub/GraphicsMagick/>`__
   [not available anymore]. Then extract it in the cgi-bin folder, e.g.
   at /var/www/vhosts/story-castle.net/httpdocs/cgi-bin Or simply
   install it as a rpm file for your LINUX distribution and skip the
   following installation steps.

::

   tar xvfpz GraphicsMagick-1.1.7.tar.gz 
   chown -R myusername:psacln GraphicsMagick-1.1.7

Installing
==========

   Read the infos in the file INSTALL-os.txt where 'os' stands for
   'unix', 'vms' or 'windows'.

..

   If you do also have an ImageMagick
   `installation <https://wiki.typo3.org/Category:Installation>`__
   [deprecated wiki link] then you cannot use the option
   '--enable-magick-compat' in the configure command.

::

   cd GraphicsMagick-1.1.7
   ./configure --enable-magick-compat

..

   After the configuration you build and install the files to the
   /usr/local/bin directory.

::

   make
   make install

..

   Now you shall verify if everything has been built correctly.

::

   cd /usr/local/bin
   ls -l
   total 8925
   drwxr-xr-x   2 root root    1024 Feb 11 10:57 .
   drwxr-xr-x  12 root root    1024 Jan 14 11:46 ..
   -rwxr-xr-x   1 root root    1223 Feb 11 10:57 GraphicsMagick++-config
   -rwxr-xr-x   1 root root    1266 Feb 11 10:57 GraphicsMagick-config
   -rwxr-xr-x   1 root root    1250 Feb 11 10:57 GraphicsMagickWand-config
   -rwxr-xr-x   1 root root 5209711 Feb 11 10:57 PerlMagick
   lrwxrwxrwx   1 root root       2 Feb 11 10:57 animate -> gm
   lrwxrwxrwx   1 root root       2 Feb 11 10:57 composite -> gm
   lrwxrwxrwx   1 root root       2 Feb 11 10:57 conjure -> gm
   lrwxrwxrwx   1 root root       2 Feb 11 10:57 convert -> gm
   lrwxrwxrwx   1 root root       2 Feb 11 10:57 display -> gm
   -rwxr-xr-x   1 root root 3891115 Feb 11 10:57 gm
   lrwxrwxrwx   1 root root       2 Feb 11 10:57 identify -> gm
   lrwxrwxrwx   1 root root       2 Feb 11 10:57 import -> gm
   lrwxrwxrwx   1 root root       2 Feb 11 10:57 mogrify -> gm
   lrwxrwxrwx   1 root root       2 Feb 11 10:57 montage -> gm

..

   If you want to allow only executable files from /usr/local/php/bin
   for PHP applications, then you have to copy the files from /usr/bin
   or /usr/local/bin (see result of 'rpm -qa GraphicksMagick') into
   /usr/local/php/bin. Otherwise you skip the following 2 steps.

````

````

::

   /usr/local # mkdir php
   /usr/local # cd php
   /usr/local/php # mkir bin
   /usr/local/php # cd bin
   /usr/local/php/bin # cp /usr/bin/animate .
   /usr/local/php/bin # cp /usr/bin/compare .
   ...
   /usr/local/php/bin # cp /usr/bin/xtp .

````

````

PHP Configuration
=================

   Edit the php.ini file for the allowed include and executable file
   directories outside of the apache document root folder.

````

````

::

   safe_mode_include_dir = /usr/local/php/bin
   safe_mode_exec_dir = /usr/local/php/bin

````

````

Settings for TYPO3
==================

You can use the following settings in the GFX section of
LocalConfiguration.php: ````

````

::

       'GFX' => [
          'colorspace' => 'RGB',
          'gdlib_png' => '1',
          'gif_compress' => '0',
          'im' => 1,
          'im_mask_temp_ext_gif' => 1,
          'im_noScaleUp' => '1',
          'im_path' => '/usr/local/bin/',
          'im_path_lzw' => '/usr/local/bin/',
          'im_v5effects' => -1,
          'im_version_5' => 'gm',
          'image_processing' => 1,
          'imagefile_ext' => 'gif,jpg,jpeg,tif,tiff,bmp,pcx,tga,png,pdf,ai',
          'png_truecolor' => '1',
      ],

````

````
