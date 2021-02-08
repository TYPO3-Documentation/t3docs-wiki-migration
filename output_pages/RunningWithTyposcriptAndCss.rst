.. include:: /Includes.rst.txt
.. highlight:: php

===============================
Running with TypoScript and CSS
===============================

The idea with this approach is to control most of the layout through an
HTML/CSS template. A small set of TypoScript [outdated wiki link] in the
TYPO3 Template indicates what portions TYPO3 should replace with Typo3
content and menu items.

I manage several websites within one installation of TYPO3, so I like to
keep things modular. I'm still learning and this helps me make sure
improvements to my code are implemented across all of my sites, but
still lets me tailor the details of each website without losing track.

HTML/CSS Template
=================

Once again we need to design an HTML file in advance, to serve as our
template.

-  `TS/CSS: HTML Template <css-html-template>`__

By way of example, I am using a very, very simple HTML layout. But
complexity can be added in the HTML and/or through CSS. I'm assuming
you'll know how to do that yourself.

The "CSS Styled Content" Extension
==================================

The "CSS Styled Content" extension needs to be installed through the
Extension Repository.

The Typo3 Template Record
=========================

Now we're ready to setup a Typo3 template record for our website. Here's
how it goes step by step...

-  `TS/CSS: Typo3 Template Setup <css-typo3-template-setup>`__
-  `TS/CSS: Typo3 TypoScript
   Constants <css-typo3-typoscript-constants>`__
-  `TS/CSS: Typo3 TypoScript Setup <css-typo3-typoscript-setup>`__

That's it!

Back to: `My first TYPO3 site <my-first-typo3-site>`__
======================================================

Some relevant reference material
--------------------------------

Go Live Tutorial https://docs.typo3.org/typo3cms/extensions/doc_tut_n1/

Templates, TypoScript & beyond
https://docs.typo3.org/typo3cms/extensions/doc_tut_frontend/

Xris: Tutorial https://wiki.typo3.org/Xris:Tutorial [outdated wiki link]

TSref https://docs.typo3.org/typo3cms/TyposcriptReference/

What initially helped me get this concept was a simplified example
buried in the following thread from the mailing list: "My experience
with TYPO3" thread [outdated link].
