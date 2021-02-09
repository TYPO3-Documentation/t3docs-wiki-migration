.. include:: /Includes.rst.txt

.. _reset-admin-password:

========================
FAQ/Reset admin password
========================

.. container::

   **Content Type:** `FAQ <https://wiki.typo3.org/Category:FAQ>`__
   [deprecated wiki link].

<< Back to `FAQ <faq>`__

.. container::

   notice - This information is outdated

   .. container::

      Current TYPO3-Version uses other hashing algorithms. See
      https://docs.typo3.org/m/typo3/reference-coreapi/master/en-us/ApiOverview/PasswordHashing/Index.htmlFor
      [not available anymore] 9 LTS you can use tools like
      `this <http://antelle.net/argon2-browser/>`__ to generate a new
      password hash. (Be aware to type real passwords in foreign pages!)

.. container::

   warning - No longer supported TYPO3 version

   .. container::

      This page contains information for older, no longer maintained
      TYPO3 versions. For information about TYPO3 versions, see
      `get.typo3.org <https://get.typo3.org>`__. For information about
      updating, see the `Installation & Upgrade
      Guide <https://docs.typo3.org/m/typo3/guide-installation/master/en-us/>`__

.. _reset-admin-password-1:

Reset admin password
====================

If you lost your admin username and/or password for the backend, you can
reset it this way:

Using the Install tool
----------------------

-  Open the Install tool by going to ``[your_site]/typo3/install/``
   This brings up the install option. (The installer tool password can
   also be reset, see below).
-  Open the 'Database Analyzer' and towards the bottom you will see
   'Create Admin User'. This lets you create a new admin user (though if
   you were using 'Admin' you will have to choose something else for the
   user name as 'Admin' already exists).
-  Once you created the new admin user, you should be able to log in
   with the new user name and password you entered. You can then reset
   the password of the user of which you actually forgot the password.

Editing the database directly
-----------------------------

You can also edit the database directly:

.. container::

   `SQL <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_SQL>`__
   [deprecated wiki link]

.. container::

   ::

      UPDATE be_users SET password=md5('your_new_password') WHERE username = 'admin';

This will reset the password for 'admin' to 'your_new_password'

Reset Install tool password
===========================

If you have forgotten the Install tool password, you can reset it by
modifying ``[your_site]/typo3conf/LocalConfiguration.php`` on the Typo3
server. Replace the ``$TYPO3_CONF_VARS['BE']['installToolPassword']``
row with the following:

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

       $TYPO3_CONF_VARS['BE']['installToolPassword'] = 'bacb98acf97e0b6112b1d1b650b84971';

This will give you the default password ("joh316") back again.
