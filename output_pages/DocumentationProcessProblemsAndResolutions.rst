.. include:: /Includes.rst.txt
.. highlight:: php

================================================
Documentation Process - Problems and Resolutions
================================================

| << Back to Documentation Team [outdated wiki link]   (edit [outdated
  wiki link])
| DocTeam [outdated wiki link] More details are being filled in as time
  permits. Please feel free to add or comment, but please be aware that
  this is not being posted as "complete" as there are more details
  already created, but waiting to be entered. Suggestions should be made
  by utilizing one of the "Talk" pages at the end of this document.
  Thanks.

.. container::

   notice - Draft

   .. container::

      Change the **{{draft}}** marker to **{{review}}** when you need a
      reviewer for text and TypoScript. info [outdated wiki link]

Introduction
============

There are various cliches about how hard it is to get things done by
committee. In fact others have made repeated statments which give a clue
to the very side-effects of trying to operate in this manner... that it
is okay to *talk* about things, but at some point we need to start
*doing*. In my humble opinion, I don't think a free-for-all will
accomplish anything, at least not quickly and/or efficiently. There
needs to be a *system* or *"rules of order"* in discussing, adopting,
and implementing changes. There are many advantages to things that are
free-form and "open"-- but unfortunately also there are also many
disadvantages.

It is some of those disadvantages that affect TYPO3 as an application,
and now even the documentation process as well. Below are some parallel
examples, which I mention as a way to help better define the problem.
Below is a summary of the problems, and finally followed by some
suggestions.

Parallel Examples
=================

The Application
---------------

TYPO3 has a tremendous amount of documentation, extensions, power, and
flexibility — but for someone who comes in at the later stages of it's
life (for example 3.6.1) it is much harder to understand and follow,
than if you were involved with TYPO3 from the beginning or at least much
earlier stages. It is often this way, especially with technology...
often if you have seen the natural progression, you see how things have
been built-upon and improved... and sometimes if an improvement doesn't
work... you know the old way, and so can either work around it or spot
the problem... the new features don't seem difficult, because you have
past experience to draw upon.

For a new person exploring TYPO3, they have no past TYPO3 experience to
depend on, and consequently most work with "what is", and not "what used
to be". Unfortunately, it has become so huge and complex, that it is
much harder to grasp because your only source is the documentation...
which currently exists in it's own world outside of the application, and
is not in-synch with the code.

The Existing Documentation
--------------------------

There is so much documentation... and for the sake of this discussion,
let's call the sources a "knowledge base". These sources include the SXW
documents in the Document Matrix. SXW documents attached to the
extensions, PDF Documents, many Newsgroup postings, Bug Database,
Wiki(s), and the many other TYPO3 websites with their own documentation,
tutorials and other TYPO3 material.

If you were involved in the early documentation process, then it may
seem like a natural progression... you know what items are old, new,
useful and not useful. You know what was built on top of what. You have
seen things that have worked and things that have failed. In short, you
know where to go for what you need... The earlier you were exposed to
all of these sources, presumably, the more "knowledge" you acquired.

The only way for a new person to truly advance to the same level, would
be to go back to the beginning and and read all the sources. In fact,
newbies are strongly encouraged to search the list archives, FAQs and so
on before posting their questions (sometimes scolded if they don't).
This is seen as a necessity because nobody wants to read the same
question over and over again. However, I think what many TYPO3 veterans
fail to realized is that what we are asking is almost unfair to a new
person. There are so many sources to check, all of which exist in their
own world. There is no reasonable way for a person with limited
knowledge of what is "correct", reconcile and understand the
relationship between these sources... in concept or in chronology.

The New Documentation Team Process
----------------------------------

While much newer than than TYPO3 and the Existing Documentation, already
this process is beginning to see the same effects as the application and
existing documentation. In other words, it is starting - even in its
infancy to emulate the very same structure as the above two items:

It is hard for new people to efficiently contribute to the documentation
team, because what they lack is the history of the group and what has
already been discussed. This problem can be even further compounded if
it is someone new to TYPO3 (me for example) where lack of application
history adds to the inability to easily contribute -- even though that
person may be able to contribute in some meaningful way.

Just like the application and the existing documentation... the Document
Team Server, Newsgroup postings (this one and others), Wiki, and private
e-mails are all part of a growing "knowledge base" related to resolving
the documentation process. This knowledge base includes past discussions
on things like: the best way to use the Wiki, how to collaborate on
documents, what the CSS code should be for the Wiki, and on-and-on.

This knowledge base is growing, just like the application, because it is
"open". However, just like the application it represents a great
opportunity - but one that is wrought with complexity and can quickly
become overwhelming. And again, it is only in its infancy stage. Can you
imagine one year from now what the hurdle will be like for a new person
wanting to contribute to the documentation team? At the rate things are
currently being "decided" can you even picture how much (or little) work
will be done in that time? And how will the rate of the documentation
compare to the rate that new code is developed?

Stating the Problems
====================

Separation between Code and Documentation
-----------------------------------------

Automotive Analogy
^^^^^^^^^^^^^^^^^^

Imagine if you walked into a bookstore to purchase a book that would
help you repair a problem with your car (this of course assumes you are
bypassing the option of paying someone else to repair it for you.) How
granular would you want that book to be? Would you want just a general
book that talked about things like tool safety, dealing with hazardous
waste, and basic automotive theory? Those things are certainly useful -
and serve their place, but most likely will not be the most efficient at
resolving your particular problem... they may help you isolate where the
problem is, but will not give you specifics about your vehicle.

So again, how granular? Well, you will most likely want to purchase a
book that deals with your particular vehicle manufacturer make, model,
and year. Can you imagine if the document were only for your
manufacturer? What about if it was even your make and model - but was
only for the current year? If the book was for the 2004 model, and you
have the 2003 model the book may or may not help you in your situation.
Some items will have undergone major changes, others minor, and still
others not at all. In fact, unless you were privy to all of the
engineer's conversations (in their newsgroup :-) ) that took place over
the span of the year since the last model release- you most likely will
not know what items have changed.

So what are your options? Well... you could buy the latest version of
the car. In fact, what if that is what the manufacturer required before
they would support you? You could attempt to resolve your problem using
the 2004 manual and just assume (or hope) it is correct and that the
procedures listed will not be different for your model. For argument's
sake let's explore that approach. You have tried to fix the problem, you
followed the steps exactly (at least as you understood them) but the
problem still remained? Now, if you have been a mechanic for a long time
or it comes naturally to you - you may be able to resolve it still and
infer the subtle differences. But what if you were new to repairing this
manufacturer or model car? Even if you were, say gifted, with the
knowledge of a different manufacturer you may still be perplexed by the
problem. Would you know if it was your understanding of the directions?
What if somehow the procedure was modified to reflect changes that had
been made - which work perfectly on the 2004 model, but not on the older
model? And what if went to the support site of the manufacturer and
there was a sign that said, "Read all of the engineer's discussions
before asking your question!"... or "Consider paying someone else to do
it for you!".

Relating the Automotive Example to TYPO3
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Hopefully the automotive analogy was enough for you to apply this to
TYPO3. But for the sake of completeness, let me expound further.

#. It can not, and should not be assumed that everyone has the latest
   version of the CMS or extensions. Especially with the complexity of
   the application, and the currently difficulty in finding solutions to
   fix problems when they occur - I believe there are many who are
   sticking with what works. As a consultant who will be offering TYPO3
   websites, I think it would be a Best Practices [outdated link] idea
   to install only stable extensions, and even give new patches - no
   matter how seemingly minor (e.g., 3.6.2) time to be released,
   debugged, documented and repaired before installing them on a live
   production machine used for income.
#. I applaud those who have the vision of a living document (e.g.,
   Wiki-ized); but without proper provisioning for being able to clearly
   identify what version a particular step applies (or does not apply)
   to then the document may be rendered useless - and worse still,
   someone new to TYPO3 may not know that it is useless. Instead, they
   may spend countless hours searching for a solution to problem that
   may or may not exist.
#. There are an overwhemling number of Knowledge Base sources. This
   presents a difficult challenge for the newcomer who is trying to be
   self-sufficient and research a particular problem. There are so many
   sources that are not reconciled to a particular version -- let alone
   to each other, that this task can prove frustrating. And to further
   complicate matters, the solution may be their but they may be looking
   in the wrong place, or may not recognize how one person's problem
   that seems unrelated to theirs is actually the very solution they
   need-- but they are just too new to see it.

Can you name any other successful application that has this problem?
MySQL? PHP? No. Microsoft? Linux? Having documentation that is directly
tied to a specific version is essential. Can you imagine trying to
administer PHP version 4.2.2 with a manual that only dealt with 4.3.8,
and left out any reference to what has changed? Or administer RedHat
Linux 9 with a manual for RedHat Linux 7, and trying to read through
newsgroups to see what has changed? Of course not... we purchase books
that help us with the version of application that we are using. And if
it covers a new version, but references or annotates changes for older
versions than that is acceptable as well.

TYPO3 has the potential to become as ubiquitous as PHP and MySQL (it
appears to be almost that way in Europe, but not yet in the United
States) if the application and the documentation can make better
strides. Of course, that is, if the community as a whole even desires to
obtain that level.

False Assumptions about Current Documentation
---------------------------------------------

All document formats are the same version
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This may not be the perception by experienced TYPO3 users or members of
the Documentation Team, but despite the initial disclaimer at the bottom
of the main Documentation page of http://www.typo3.org/documentation
which indicates that the SXW documents are considered to be the "Source"
documents, I don't think that it is obvious to some that the SXW is not
necessarily the same as the PDF; and of course the PDF does not have the
user comments that have been added to the HTML version. Especially since
PDF is much more of a document standard on the Web than is SXW. Many
others may also not wish to download OpenOffice, the fact that it is
free should not make it a requirement for someone to install it on their
computer to learn TYPO3 when other formats are more readily available.
In addtion, the documents that are downloaded as part of installing
extensions through the Extension Manager can also vary from what is in
the Documentation Matrix.

Older documentation is more "Stable"
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

There seems to be a prevaling thought (though most likely not by the
Documentation Team) that the older documents are more stable. For
example, people often point Newbies in the direction of the various
tutorials - such as GoLive Template Integration, Modern Template
Building Part1 [outdated link], and Part 2 & 3. However, for example,
the MTB Part I tutorial was last modified in December of 2003. And
clearly there has been some major code changes since then. This creates
problems, especially for the newbies who are trying to learn TYPO3. When
the new person then tries to seek help with the tutorial in the
newsgroups, their request is often overlooked because it assumed (as
stated above) that the document, which was written by a knowledgeable
TYPO3 person (e.g., Kasper) so it must be a problem with

When someone is trying to newly learn TYPO3, and they try out a tutorial
and it doesn't work, the natural tendency would be to spend time
figuring out what they did wrong. The natural tendency would also be to
make the assumption that the document is correct - because it is not
likely that if the document has been around for a long time that any
bugs would most likely have been found with it fairly quickly.

Tutorials equals teaching concept
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Step-by-step tutorials may help to accomplish a task, and some may help
with understanding application. While tutorials are certainly neccessary
and a great way to learn, they do not replace more conceptual learning
that is missing from some of the tutorials and/or documentation. For
example, key TS code elements are used, but with no explanation or just
a general reference to TSref. Upon turning to TSref, many of those
elements are used in a code snippet example, but the underlying
principal is not necessarily imparted to the reader. Summarized this
way: there is an assumption that listing a code example give the reader
the ability to apply practical application.

Miscellaneous Documentation Issues
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

-  Innaccurate Table of Content page numbering (e.g., PDF Version of
   TSref)
-  Items discussed in newsgroups, bug database, or other source equals
   documentation

Culture is hard to change
-------------------------

No lengthy analogy here; the TYPO3 culture is continuing in the same way
it always has, as evidenced by the repeating of the same patterns
mentioned above in the Parallel Examples. If the TYPO3 community wants
to continue to keep the same problems it has now, then it should keep
doing the same things. But if it desires to change and improve- then
there is no way around, it must change. I'm sure we have all heard the
saying that the definition of "insanity" is to keep doing the same thing
over-and-over again, and expecting different results.

Easiest Course of Action
^^^^^^^^^^^^^^^^^^^^^^^^

Part of the culture is what I would call the "engineer mentality"
culture. I have managed programmers in software development, and often
times there is a tendency to do what is easiest either from a coding
perspective, or a GUI perspective. After all, if it makes sense to them
- it should make sense to everyone else right? Fortunately this does not
affect TYPO3 very much as an application. It does however seem to be
prevalent when it comes to Documentation, Bug Reporting, etc. There is a
focus on what is easiest-- coding, and not in working on documentation.
This isn't any one's fault -- it is the (digital) age-old question of
balancing new production versus reporting current status.

For example this affects IT help desk departments. Sometimes when there
are major problems, managers and employees want to know exactly what the
status is: when will it be fixed?, where are we at with it now?, etc.
But the technicians working on the problem, want to continue to do so --
not stop and update a company website or voice mail message explaining
the problem, who is or is not affected, what they are doing about it,
and anticipated time frame. For the technician it is much easier to work
on the problem, than it is to stop and document the problem. And if you
are affected by the problem - do you want the technician working on it,
or telling you what he is doing? In reality - we want both. So there
must be some way to acheieve balance in matters such as these. And when
it comes to TYPO3, sometimes the "bugs" in the documentation are just as
critical as the bugs in the code.

Many corporations though have this problem, they view documentation as
something developed after software is released - and not developed as
part of the software. You show me a company with good documentation, I
will show you a company that is most likely implementing some sort of
version control, change management, and integrating technical writers as
part of the software development team... and the earlier the better the
documentation. The question is, what quality does the TYPO3 community
desire for it's documentation? Some would say that the current
documentation is better than a lot of other software applications... to
which I whole heartedly agree. But does that mean there isn't room for
improvement?

Natural Resitance to Change
^^^^^^^^^^^^^^^^^^^^^^^^^^^

And last but not least, is the "human" aspect. It is always much easier
to live in the status quo - rather than to change. An object in motion,
tends to stay in motion... it's not just a guideline... it's a law! :-)
There is just a fundamental in-born resistance to change. And the more
comfortable you are with way things are... the more likely you will be
resitant to change.

Setting a New Path
==================

**Please see the author's note at the very top of this page. The items
below have planned content, but due to a problem of saving, and problems
with the wiki server, I was not able to complete the document; I have
planned content to in the sections below; I am hoping for some courtesy
in giving me time to fill it before it gets filled... this may be
anti-wiki, but I want the opportunity to post my ideas and thoughts in
their entirety. But please feel free to add if you must, and my
preference is that contributions at this point be made on one of the
"Talk" pages, or directly to me at Coby Pachmayr [outdated wiki link]**

Coding and Documentation Release Protocols
------------------------------------------

::

    The bullet items below are a work in progress that will ultimately include specific details
    on implementing these policies,including tools, workflow, etc.

Basic Fundamental Guidelines
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

-  A programmer decides to write new code: This code relates to the CMS,
   to an existing extension, or the creation of a new extension.

-  The code may contain fixes, feature changes, new features, and/or
   feature elimination. These are reflected within the Code
   Specification page.

-  The code will have various stages: planned, pre-release, alpha, beta,
   release candidate, and final.

-  Changes to the code plans constitute a Code Specification Update.
   Updates should be made to the Code Specification Page, and done in
   such a way as to make it clear what update was made. This can be
   accomplished in an Update section, or within the document itself, or
   both. Clarity and logging are the primary issue.

-  Each stage should follow appropriate versioning protocols for new
   releases, minor and major updates; as well as be associated with the
   appropriate stage.

-  The Code Specification Page also indicates all dependencies for the
   CMS and/or extensions and their appropriate versions.

-  Documentation begins with the release of a Code Specification page,
   modified with any Code Specification Updates, and is versioned in
   step with the status and versioning of the code itself.

-  Authority, responsibility and functionality of the documentation are
   equal to the authority, responsibility and functionality of the code.
   The documentation is a functional part of the code, not a separate
   entity. In this respect, either the documentation works or it does
   not work – in much the same was as the code either works or does not
   work. It also means that the programmer has the ultimate authority,
   responsibility to ensure that both the code and documentation are
   functional.

-  When reporting bugs, Code Specification Pages and Updates determine
   whether reported bugs are in fact included as part of the intended
   functionality. This indicates whether a bug is an error in
   documentation or with the code, since it can only be one of the
   following:

   -  The code was never designed to operate in the manner reported
   -  The Code Specification Page or Update indicates that the
      functionality should exist
   -  The code itself works, but the information in the documentation is
      incorrect
   -  The code itself works, but breaks the functionality of one of its
      dependencies, in which case the same process is undertaken with
      the dependent code and documentation

Proposed Workflow Diagram
^^^^^^^^^^^^^^^^^^^^^^^^^

Document Team Overview
----------------------

Current Policy and Procedures
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Proppsed Policy and Procedures
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. _proposed-workflow-diagram-1:

Proposed Workflow Diagram
^^^^^^^^^^^^^^^^^^^^^^^^^

Knowledge Base Implementation
-----------------------------

Definition of Knowledge Base Items
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Care and Feeding of the Knowledge Base
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Knowledge Base Diagram
^^^^^^^^^^^^^^^^^^^^^^

Summary
-------
