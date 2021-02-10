.. include:: /Includes.rst.txt

=============
Unique fields
=============

.. container::

   notice - This information is outdated

   .. container::

      This page was written for the obsolete TYPO3 version 3.8.1.

Fields are marked as unique in the $TCA array:

$TCA[table]['columns'][column]['config']['eval'] = 'unique';

You may not set the field in the database unique because with versioning
field values may repeat. When selecting based on a unique field value,
include pid >= 0 in the condition. Other versions of a record have pid
set to -1.

Note that Typo3 doesn't give you an error message when you add a record
with a repeated unique field, it will just silently append 0. So when
you have one record with AN7644 and create another one with AN7644, the
second one will be AN76440 actually, and a third one will end up as
AN76441. Be careful.

When you restrict your field length to i.e. 10 and try to insert a
duplicate value of length 10, Typo3 can't append a 0 to make it unique.
You will get this error message in this case:

102: These fields are not properly updated in database: (number)
Probably value mismatch with fieldtype. [Continue]

When you press continue all the data you entered in the record is lost.
