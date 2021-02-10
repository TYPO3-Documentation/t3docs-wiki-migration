.. include:: /Includes.rst.txt

===========
Line breaks
===========

In edit mode, when the Enter key is pressed:

::

    Internet Explorer inserts: <p> </p>
    Mozilla/Firefox inserts: <br />

When shift-Enter is pressed:

::

    both Internet Explorer and Mozilla/Firefox insert: <br />

**htmlArea** is trying to compensate for these different behaviors:

::

    htmlArea intercepts the Mozilla/Firefox Enter key event
    htmlArea wraps the br tag in a pair of p tags: <p><br /></p>
    on submit or on toggle to textmode, htmlArea strips the br tag.

**htmlArea** then inserts a non-breaking space in any empty text node or
one that contains only spaces.

::

    When the text node is edited, the non-breaking space is replaced by a normal space.

The net result is the same in both Mozilla/Firefox and Internet
Explorer.
