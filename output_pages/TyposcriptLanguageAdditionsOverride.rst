.. include:: /Includes.rst.txt
.. highlight:: php

=======================================
TypoScript language additions, override
=======================================

add your own language variables or override standard ones
=========================================================

**add this to your TS Setup for your plugin:**

::

   plugin.[PluginName]._LOCAL_LANG.[language:default|de|fr|...] {
     varName = varWert
   }

Example for News
================

::

   plugin.tt_news._LOCAL_LANG.de {
       latestHeader = Aktuelles:
       textCatLatest = Kat:
       textCat = Kategorie:
       textNewsAge = Alter:
       more = [mehr]
       preAuthor = Von:
       backToList = <- Zur?ck zu: %s
       goToArchive = zum Archiv ->
       archiveHeader = Nachrichten Archiv:
       archiveItems = Eintr?ge
       archiveEmptyMsg = Leider keine Eintr?ge im Archiv vorhanden.
       noResultsMsg = Keine Ergebnisse
       searchEmptyMsg = Bitte geben Sie einen Suchbegriff ein.
       noNewsToListMsg = Keine News in dieser Ansicht.
       textRelated = In Verbindung stehende News:
       textLinks = Links:
       textFiles = Dateien:
       pi_list_browseresults_prev = < zur?ck
       pi_list_browseresults_page = Seite
       pi_list_browseresults_next = vor >
       noNewsIdMsg = Keine news_id ?bergeben.
       searchButtonLabel = Suchen
       altTextCatSelector = Nur diese Kategorie anzeigen:
       altTextCatShortcut = Gehe zu
   }

Access your Variables in your Extension
=======================================

tslib/class.tslib_pibase.php

Localization, locallang functions function
pi_getLL($key,$alt=\ *,$htmlspecialchars=false)* function pi_loadLL()

::

   $this->pi_loadLL();
   $sprachVariabelnText1 = $this->pi_getLL('varName','this text is shown, if there is no translation in the <br />locallang.php');
   echo $sprachVariabelnText1
   # results in 
   this text is shown, if there is no translation in the <br /> locallang.php

   $sprachVariabelnText2 = $this->pi_getLL('varName','this text is shown, if there is no translation in the <br />locallang.php', true);
   # results in
   this text is shown, if there is no translation in the &lt;br /&gt;locallang.php
