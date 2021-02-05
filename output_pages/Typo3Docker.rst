.. include:: /Includes.rst.txt
.. highlight:: php

============
TYPO3-Docker
============

TYPO3 Development system using docker
=====================================

Docker is a virtualization system which allows easy setup of
process-level virtualization / process isolation. In the docker world
there are "images" and "containers". An image is a predefined set of
files containing a "Dockerfile". The Dockerfile specifies any ancestors
of the current image and any actions which should get performed upon
starting a container. The container itself could get seen as an image
which has been started.

There are quite a bunch of TYPO3 images available on the docker hub
website: `Docker TYPO3
images <https://hub.docker.com/search/?isAutomated=0&q=typo3>`__

In this example we will use the
"`dkdde/docker-typo3 <https://hub.docker.com/r/dkdde/typo3/>`__" docker
image.

An alternate docker image is
"`thinkopenat/typo3-git-master <https://hub.docker.com/r/thinkopenat/typo3-git-master/>`__".
This one fetches the current TYPO3 master from git.typo3.org and allows
to do review work.

For installing docker see the appropriate instructions on the docker
website or use apt-get, yast or whatever package management your OS
brings along.

The following 2 lines of shell script will completely set up a new
container running TYPO3 on your system:

::

      docker run -d -e MYSQL_PASS="<your_password>" --name db-1 tutum/mysql:5.5
      docker run -d --link db-1:db -e DB_PASS="<your_password>" --name "typo3" -p 8080:80 dkdde/typo3

The first line will pull and run the "tutum/mysql" image, this could
also get achieved with the line "docker pull tutum/mysql:5.5". The
second line will pull and run the "dkdde/typo3" image. The option
"--name" allows to name a container. If the option is left away a random
name will get generated. The option "--link db-1:db" links the
previously started container "db-1" into the "typo3" container using
"db" as alias inside the "typo3" container.

Notice: It is important to use "db" as alias for the "--link" parameter
(option after the semicolon). When a link to another container is used
the exposed ports are made available to the container via environment
variables. The alias (option after semicolon) defines the prefix of the
environment variables

After executing the second line you will be able to access a fresh TYPO3
7.6.[latest] by accessing "http://localhost:8080/typo3/ [outdated link]"
in your browser.

Making changes in the docker container
======================================

For making any custom changes, running unit test, etc. you will have to
"enter" the running container. In fact what you want is to have a
bash/csh/your-favorite-shell getting connected to your terminal. You can
do this by executing a shell in the container, not moving it into
background (stay interactive) and allocating a pty (pseudo terminal)
inside the container for the executed command. Knowing about pty's,
terminals and detached processes is not a required skill if you just
want to use docker:

::

     docker exec -t -i typo3 /bin/bash

This command will start the binary "/bin/bash" inside a previously
started container named "typo3". The "-i -t" switches take care of the
interactive/pty stuff mentioned above.
