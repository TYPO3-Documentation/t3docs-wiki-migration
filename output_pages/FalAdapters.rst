.. include:: /Includes.rst.txt
.. highlight:: php

============
FAL Adapters
============

This is just a list of possible FAL implementations.

Adapters
========

+-------------+-------------+-------------+-------------+-------------+
| Product     | Type        | More        | Interested  | Status      |
|             |             | Information |             |             |
+-------------+-------------+-------------+-------------+-------------+
| WebDAV      | Cloud space | `TER <      | Andreas     | Current git |
|             |             | https://ext | Wolf        | version     |
|             |             | ensions.typ |             | works with  |
|             |             | o3.org/exte |             | 7.1+        |
|             |             | nsion/fal_w |             |             |
|             |             | ebdav/>`__, |             |             |
|             |             | forg        |             |             |
|             |             | e.typo3.org |             |             |
|             |             | [outdated   |             |             |
|             |             | link],      |             |             |
|             |             | `Git <https |             |             |
|             |             | ://git.typo |             |             |
|             |             | 3.org/TYPO3 |             |             |
|             |             | CMS/Extensi |             |             |
|             |             | ons/fal_web |             |             |
|             |             | dav.git>`__ |             |             |
+-------------+-------------+-------------+-------------+-------------+
| FTP         | Cloud space | `TE         | Arno Dudek  | available   |
|             |             | R <https:// |             | in two      |
|             |             | extensions. |             | versions    |
|             |             | typo3.org/e |             | for TYPO3   |
|             |             | xtension/fa |             | CMS 6.1 and |
|             |             | l_ftp/>`__, |             | 6.2         |
|             |             | forg        |             |             |
|             |             | e.typo3.org |             |             |
|             |             | [outdated   |             |             |
|             |             | link] and   |             |             |
|             |             | `Git        |             |             |
|             |             | Hub <https: |             |             |
|             |             | //github.co |             |             |
|             |             | m/adgrafik/ |             |             |
|             |             | fal_ftp>`__ |             |             |
+-------------+-------------+-------------+-------------+-------------+
| Amazon S3   | Cloud space | htt         | Benjamin    | started     |
|             |             | ps://git.ty | Mack        |             |
|             |             | po3.org/TYP |             |             |
|             |             | O3CMS/Exten |             |             |
|             |             | sions/fal_a |             |             |
|             |             | mazons3.git |             |             |
+-------------+-------------+-------------+-------------+-------------+
| Amazon S3   | Cloud space | `TER        | Anders und  | Works with  |
|             |             | <https://ex | Sehr        | 6, 7, 8     |
|             |             | tensions.ty |             |             |
|             |             | po3.org/ext |             |             |
|             |             | ension/aus_ |             |             |
|             |             | driver_amaz |             |             |
|             |             | on_s3/>`__, |             |             |
|             |             | `GitHub <ht |             |             |
|             |             | tps://githu |             |             |
|             |             | b.com/ander |             |             |
|             |             | sundsehr/au |             |             |
|             |             | s_driver_am |             |             |
|             |             | azon_s3>`__ |             |             |
+-------------+-------------+-------------+-------------+-------------+
| Dropbox     | Cloud space | https:      | Philipp     | Started.    |
|             |             | //github.co | Gampe /     | Current     |
|             |             | m/froemken/ | Stefan      | features:   |
|             |             | fal_dropbox | Frömken     | surfing     |
|             |             |             |             | through     |
|             |             |             |             | fi          |
|             |             |             |             | les/folder. |
|             |             |             |             | Create      |
|             |             |             |             | folder.     |
|             |             |             |             | Upload file |
+-------------+-------------+-------------+-------------+-------------+
| SFTP        | Cloud space | `pa         | Oliver      | Nearly full |
|             |             | ckagist.org | Eglseder    | support,    |
|             |             |  <https://p |             | required    |
|             |             | ackagist.or |             | ext-ssh2 or |
|             |             | g/packages/ |             | phpseclib   |
|             |             | vertexvaar/ |             | as SSH2     |
|             |             | falsftp>`__ |             | Adapter     |
|             |             | and         |             |             |
|             |             | `GitHu      |             |             |
|             |             | b <https:// |             |             |
|             |             | github.com/ |             |             |
|             |             | vertexvaar/ |             |             |
|             |             | falsftp>`__ |             |             |
+-------------+-------------+-------------+-------------+-------------+
| Microsoft   | Cloud space | https://    | Benjamin    | Works with  |
| Azure Blob  |             | github.com/ | Hirsch      | TYPO3 7.x - |
| Storage     |             | benjaminhir |             | 8.x         |
|             |             | sch/typo3-a |             |             |
|             |             | zurestorage |             |             |
+-------------+-------------+-------------+-------------+-------------+

Ideas for adapters
==================

+-------------+-------------+-------------+-------------+-------------+
| Google      | Cloud space | A           |             |             |
| Drive       |             | PI/Examples |             |             |
|             |             | for PHP at  |             |             |
|             |             | http        |             |             |
|             |             | s://develop |             |             |
|             |             | ers.google. |             |             |
|             |             | com/drive/e |             |             |
|             |             | xamples/php |             |             |
+-------------+-------------+-------------+-------------+-------------+
| Windows     | Cloud space | http:       | Susanne     | imp         |
| Azure       |             | //www.windo | Moog        | lementation |
|             |             | wsazure.com |             | 90%         |
+-------------+-------------+-------------+-------------+-------------+
| Evernote    | Cloud space | A           |             |             |
|             |             | PI/Examples |             |             |
|             |             | at          |             |             |
|             |             | http://d    |             |             |
|             |             | ev.evernote |             |             |
|             |             | .com/docume |             |             |
|             |             | ntation/clo |             |             |
|             |             | ud/samples/ |             |             |
+-------------+-------------+-------------+-------------+-------------+
| Celum       | DAM         | ht          | Georg       |             |
|             |             | tp://www.ce | Ringer      |             |
|             |             | lum.com/de/ | (           |             |
|             |             |             | Ideaholder, |             |
|             |             |             | Possible    |             |
|             |             |             | impl        |             |
|             |             |             | ementation) |             |
+-------------+-------------+-------------+-------------+-------------+
| Cumulus     | DAM         | http://www  | Georg       | Imp         |
|             |             | .canto.com/ | Ringer      | lementation |
|             |             |             | (           | 80%         |
|             |             |             | Ideaholder, |             |
|             |             |             | Possible    |             |
|             |             |             | impl        |             |
|             |             |             | ementation) |             |
+-------------+-------------+-------------+-------------+-------------+
| Alfresco    | DAM         | http://w    | Olivier     |             |
|             |             | ww.alfresco | Dobberkau   |             |
|             |             | .com/produc | (           |             |
|             |             | ts/platform | Ideaholder) |             |
+-------------+-------------+-------------+-------------+-------------+
| Sharepoint  | DAM         | h           | Olivier     |             |
|             |             | ttp://share | Dobberkau   |             |
|             |             | point.micro | (I          |             |
|             |             | soft.com/en | deaholder), |             |
|             |             | -us/Pages/d | Julian      |             |
|             |             | efault.aspx | Kleinhans   |             |
|             |             |             | (Possible   |             |
|             |             |             | impl        |             |
|             |             |             | ementation) |             |
+-------------+-------------+-------------+-------------+-------------+
| Openstack   | Cloud space | http        | Olivier     |             |
|             |             | ://openstac | Dobberkau   |             |
|             |             | k.org/softw | (           |             |
|             |             | are/opensta | Ideaholder) |             |
|             |             | ck-storage/ |             |             |
+-------------+-------------+-------------+-------------+-------------+
| Hoop –      | Cloud space | http://ww   | Olivier     |             |
| Hadoop HDFS |             | w.cloudera. | Dobberkau   |             |
| over HTTP   |             | com/blog/20 | (           |             |
|             |             | 11/07/hoop- | Ideaholder) |             |
|             |             | hadoop-hdfs |             |             |
|             |             | -over-http/ |             |             |
+-------------+-------------+-------------+-------------+-------------+
| GridFS      | Cloud space | http://ww   | Olivier     |             |
|             |             | w.mongodb.o | Dobberkau   |             |
|             |             | rg/display/ | (           |             |
|             |             | DOCS/GridFS | Ideaholder) |             |
+-------------+-------------+-------------+-------------+-------------+
| Riak        | Cloud space | http://b    | Olivier     |             |
|             |             | asho.com/te | Dobberkau   |             |
|             |             | chnology/wh | (           |             |
|             |             | y-use-riak/ | Ideaholder) |             |
|             |             | [outdated   |             |             |
|             |             | link]       |             |             |
+-------------+-------------+-------------+-------------+-------------+
| Gallery     | DAM         | http:/      |             |             |
|             |             | /gallery.me |             |             |
|             |             | nalto.com/, |             |             |
|             |             | `API        |             |             |
|             |             |  <http://co |             |             |
|             |             | dex.gallery |             |             |
|             |             | 2.org/Galle |             |             |
|             |             | ry3:API>`__ |             |             |
+-------------+-------------+-------------+-------------+-------------+
