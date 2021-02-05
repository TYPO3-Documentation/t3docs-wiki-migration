.. include:: /Includes.rst.txt
.. highlight:: php

=================
Protect from spam
=================

--------------

.. container::

   notice - Newer documentation available

   .. container::

      `TypoScript Reference »
      spamProtectEmailAddresses <https://docs.typo3.org/m/typo3/reference-typoscript/master/en-us/Setup/Config/Index.html#spamprotectemailaddresses>`__

Tip 1
=====

.. container::

   Todo:
   Format code as code for better readability

   .. container::

   *Please remove "{{Todo}}" when the problem is solved. See all todos
   [outdated wiki link].*

To protect your email against spam, add the following to the 'Setup'
field of your template:

| config.spamProtectEmailAddresses = 2
| config.spamProtectEmailAddresses_atSubst = (at)

This encryptes your email address and substitutes the **@** with
**(at)**. The bad thing is, that javascript is needed to decrypt the
email address.

Tip 2
=====

The second way to avoid spam crawlers scanning your web site for email
addresses is to let Typo3 encode these. The result is a link similar to
this: javascript:linkTo_UnCryptMailto('pdlowr=urehuwCw|sr61ruj');

To use this kind of protection, add the following line to your
TypoScript Setup:

config.spamProtectEmailAddresses = 1

This instructs Typo3 to create JavaScript links as in the above
mentioned examples. The disadvantage is obviously that the FE user must
have JavaScript enabled in his browser.
