.. include:: /Includes.rst.txt
.. highlight:: php

=====================
Links in same windows
=====================

.. container::

   **Content Type:** FAQ [outdated wiki link].

.. container::

   notice - This information is outdated

   .. container::

      The content on this page may be partly outdated and apply to older
      versions of TYPO3

The window a link opens in is called it's target. There are various
TypoScript constants which control what target frame is used for new
pages. For example internal links, external links, search results, mail
form acknowledgment pages, site map links. Different constants apply if
you are not using "CSS Styled Content," but these are constants to
include in the constants section of your template:

::

   # sitemap links should open in the same window .. (CSS)
   # see also https://forge.typo3.org/issues/14878
   content.pageFrameObj = _self

   # makes search results and mailform "thank you" open in same window (CSS)
   PAGE_TARGET =

   # This is how you force Typo3 to stop opening internal links and external links
   # in new windows (as default) and instead open them in the same window:
   config.intTarget = _self         # Internal links in the same window
   config.extTarget = _blank        # External links in new window

For some reason, people have had problems with CSS Styled Content thats
sets:

::

   styles.content.links.target = {$PAGE_TARGET}

but it could be fixed by adding this line to the template:

::

   styles.content.links.target = _self

.. container::

   Todo:
   Add some more information to which TYPO3 version this applies and
   what are the prerequisites (e.g. css_styled_content?). Add categories
   for TYPO3 versions. Possibly add links to information for newer
   versions.

   .. container::

   *Please remove "{{Todo}}" when the problem is solved. See all todos
   [outdated wiki link].*
