.. include:: /Includes.rst.txt
.. highlight:: php

================
Static File Edit
================

.. container::

   notice - This information is outdated

   .. container::

      The option *BE/staticFileEditPath* and associated settings have
      been removed in TYPO3 7.1 (see `63818: TYPO3 Core - Remove
      staticFileEditPath magic
      [Closed] <https://forge.typo3.org/issues/63818>`__).

**Static File Edit** AKA Static-file-write AKA static_file_edit

Makes Typo3 able to edit static HTML files with sections defined by
subpart marker strings. For instance in a file made with Dreamweaver, a
static file edit record can be configured to edit a limited portion of
content with the Rich Text Editor. Please study how the default table in
Typo3, to better understand static_file_edit. Creator: kasper (Kasper
Skaarhoj)

**DEMO/HOW TO:**

-  FIRST CHECK extension is installed AND localconf.php FOR SOMETHING
   LIKE THIS:

::

    $TYPO3_CONF_VARS["BE"]["staticFileEditPath"] = 'fileadmin/static/';

CREATE SYSFOLDER [say "Edit Static"]:

CREATE PLACE HOLDERS i.e. links with the exact file names in folder
fileadmin/static/ in the sysfolder

CREATE NEW DOCUMENT

::

   -- Type: "HTML-file editing"
   -- "File to be edited:" eg: static_file.html - should be a real file!
   -- "Alternative Subpart marker:" enter different marker (eg: ZaQ) tag if you want this to be a link to another section of a previously setup link/file.
    Note:
     - The names of these alt subpart marker links will be the same as the actual files so it might get confusing.
     - Better to set alt marker manually before hand in the HTML.

<!-- ###ZaQ### begin --><!-- ###ZaQ### end -->

::

   -- "Always reload content from file:" check if you don't want the db entry to take precedence

Any content between marker will now be edited from this placeholder OR
as I call it 'link'.

Link to view via web browser will be:
http://DOMAIN/fileadmin/static/static_file.html [outdated link]

**SOURCES:**

Inside TYPO3 https://docs.typo3.org/typo3cms/InsideTypo3Reference/

Static file editor demo http://pc-coburg.de/?id=222

Special Configuration Options
https://docs.typo3.org/typo3cms/CoreApiReference/

| 
| **TSCONFIG REF:**

static_write[f1|f2|f3|f4|f5]

f1 is the fieldname which contains the name of the file being edited.
This filename should be relative to the path configured in
$TYPO3_CONF_VARS["BE"]["staticFileEditPath"]. eg:
$TYPO3_CONF_VARS["BE"]["staticFileEditPath"] = 'fileadmin/static/';

f2 is the fieldname which will also recieve a copy of the content (in
the database). This should probably be the field name that carries this
configuration.

f3 is the fieldname containing the alternative subpart marker used to
identify the editable section in the file. The default marker is
###TYPO3_STATICFILE_EDIT### and may be encapsulated in HTML comments.
There must be two markers, one to identify the begining and one for the
end of the editable section. Optional.

f4 is the fieldname which which - if true - indicates that the content
should always be loaded into the form from the file and not from the
duplicate field in the database. Optional.

f5 is the fieldname which will recieve a status message as a short
textstring. Optional.

EG: STATIC_FILE_0 = privacy.htm 'STATIC_FILE_EDIT' => Array ( 'label' =>
'STATIC_FILE_EDIT: Text field', 'config' => Array ( 'type' => 'text', ),
'defaultExtras' => 'static_write[STATIC_FILE_0|STATIC_FILE_EDIT|||]'
