.. include:: /Includes.rst.txt

=======================================
How to build GraphicsMagick RPM package
=======================================

.. container::

   **Content Type:** `HowTo <https://wiki.typo3.org/Category:HowTo>`__
   [deprecated wiki link].

How to build GraphicsMagick RPM package (--enable-magick-compat)
================================================================

This is help for a `RedHat <https://wiki.typo3.org/Category:RedHat>`__
[deprecated wiki link]-`Linux <https://wiki.typo3.org/Category:Linux>`__
[deprecated wiki link]-Server and is an
`installation <https://wiki.typo3.org/Category:Installation>`__
[deprecated wiki link]-help for GraphicsMagick/ImageMagick.

Making workspace directories
----------------------------

::

   $ cd
   $ mkdir RPM
   $ cd RPM
   $ mkdir BUILD
   $ mkdir -p RPMS/i386
   $ mkdir -p RPMS/noarch
   $ mkdir SOURCES
   $ mkdir SPECS
   $ mkdir SRPMS

Making a configuration file for rpm macros to specify the workspace directories
-------------------------------------------------------------------------------

::

   $ echo "%_topdir /home/(user name for working)/RPM" > ~/.rpmmacros

Downloading and extracting a source package
-------------------------------------------

::

   wget http://downloads.sourceforge.net/graphicsmagick/GraphicsMagick-1.1.7-1.src.rpm -P ~/RPM/SOURCES/
   rpm -ihv  ~/RPM/SOURCES/GraphicsMagick-1.1.7-1.src.rpm

(This makes the file GraphicsMagick-1.1.7.tar.bz2 in the directory
~/RPM/SOURCES.)

Modifying the spec file
-----------------------

(When you use this code indeed, you need to remove those comments on the
right. Spec file does not support such a way to comment.)

::

   %{!?quant:%define quant 16}                        # Chage 8 to 16 if you want higher quality.

::

   %configure --enable-shared --disable-static \
       --with-modules --enable-lzw \
       --with-frozenpaths --enable-magick-compat \         # Add --enable-magick-compat

::

   # Remove unpackaged files.
   %if %{perlm}
   rm -f `find $RPM_BUILD_ROOT%{_libdir}/perl*/ -name perllocal.pod -type f`
   rm -f `find $RPM_BUILD_ROOT%{_libdir}/perl*/ -name .packlist -type f`
   %endif
   rm -f `find $RPM_BUILD_ROOT%{_bindir}/ -type l`             # Add this line to remove the unnecessary symbolic links.

::

   %files
   %defattr(644, root, root, 755)
   %doc ChangeLog Copyright.txt README.txt NEWS
   %doc %{_datadir}/%{name}-%{base_version}
   %{_libdir}/lib%{name}.so.*
   %{_libdir}/lib%{name}Wand.so.*
   %dir %{_libdir}/%{name}-%{base_version}
   %{_libdir}/%{name}-%{base_version}/config/*.mgk
   %dir %{_libdir}/%{name}-%{base_version}/modules-Q%{quant}
   %{_libdir}/%{name}-%{base_version}/modules-Q%{quant}/*/*.so
   %{_libdir}/%{name}-%{base_version}/modules-Q%{quant}/*/*.la     # Immigrate this line from the devel package.
   %attr(755, root, root) %{_bindir}/gm
   %attr(644, root, man) %{_mandir}/man1/gm.1.gz
   %attr(644, root, man) %{_mandir}/man4/*gz
   %attr(644, root, man) %{_mandir}/man5/*gz

::

   %files devel
   %defattr(644, root, root, 755)
   %dir %{_includedir}/%{name}/wand
   %{_includedir}/%{name}/wand/*
   %dir %{_includedir}/%{name}/magick
   %{_includedir}/%{name}/magick/*
   %{_libdir}/lib%{name}Wand.*a
   %{_libdir}/lib%{name}Wand.so                        # Add the missing line.
   %{_libdir}/lib%{name}.*a
   %{_libdir}/lib%{name}.so
   # %%dir %%{_libdir}/%%{name}-%%{base_version}/modules-Q%%{quant}    # Remove this line for the directory to be empty.
   # %%{_libdir}/%%{name}-%%{base_version}/modules-Q%%{quant}/*/*.la   # Emmigrate this line to the normal package.
   %{_libdir}/pkgconfig/%{name}.pc
   %{_libdir}/pkgconfig/%{name}Wand.pc
   # %%{_bindir}/%%{name}-config                       # Remove this line for the redundancy.
   %attr(755, root, root) %{_bindir}/%{name}-config
   # %%{_bindir}/%%{name}Wand-config                   # Remove this line for the redundancy.
   %attr(755, root, root) %{_bindir}/%{name}Wand-config
   %attr(644, root, man) %{_mandir}/man1/%{name}-config.1.gz
   %attr(644, root, man) %{_mandir}/man1/%{name}Wand-config.1.gz

::

   # %%{_bindir}/%%{name}++-config                        # Remove this line for the redundancy.

Building the rpm package
------------------------

::

   rpmbuild -bb ~/RPM/SPECS/GraphicsMagick.spec

Installing the package
----------------------

Chage to "root" user and

::

   rpm -ihv /home/(user name for working)/RPM/RPMS/i386/GraphicsMagick-1.1.7-1.i386.rpm
   (Or rpm -ihv /home/(user name for working)/RPM/RPMS/i386/GraphicsMagick*)

Excluding the package of automatic yum update
---------------------------------------------

::

   vi /etc/yum.conf
   exclude=GraphicsMagick.i386
   (Or exclude=GraphicsMagick*)

--------------
