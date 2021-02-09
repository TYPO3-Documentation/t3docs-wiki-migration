.. include:: /Includes.rst.txt

====================================================================
How to use the Fluid Standalone view to render template based emails
====================================================================

.. container::

   notice - Newer documentation available

   .. container::

      The Mail API and handling of Fluid bases emails has changed
      considerably since TYPO3 10. Please see `TYPO3 Explained: Mail
      API <https://docs.typo3.org/m/typo3/reference-coreapi/master/en-us/ApiOverview/Mail/Index.html>`__
      for newer documentation

| 
| Find the Code for TYPO3 versions below:

-  `TYPO3 version
   6 <https://wiki.typo3.org/How_to_use_the_Fluid_Standalone_view_to_render_template_based_emails#Usage_in_TYPO3_6.0_and_higher>`__
   [deprecated wiki link]
-  `TYPO3 version
   7.6 <https://wiki.typo3.org/How_to_use_the_Fluid_Standalone_view_to_render_template_based_emails#Usage_in_TYPO3_7.6_and_higher>`__
   [deprecated wiki link]
-  `TYPO3 version
   8.7 <https://wiki.typo3.org/How_to_use_the_Fluid_Standalone_view_to_render_template_based_emails#Usage_in_TYPO3_8.7>`__
   [deprecated wiki link]

Add the following function to your controller (or preferably to a common
abstract base controller).

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      /**
      * @param array $recipient recipient of the email in the format array('recipient@domain.tld' => 'Recipient Name')
      * @param array $sender sender of the email in the format array('sender@domain.tld' => 'Sender Name')
      * @param string $subject subject of the email
      * @param string $templateName template name (UpperCamelCase)
      * @param array $variables variables to be passed to the Fluid view
      * @return boolean TRUE on success, otherwise false
      */
      protected function sendTemplateEmail(array $recipient, array $sender, $subject, $templateName, array $variables = array()) {
          $emailView = $this->objectManager->create('Tx_Fluid_View_StandaloneView');
          $emailView->setFormat('html');
          $extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
          $templateRootPath = t3lib_div::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath']);
          $templatePathAndFilename = $templateRootPath . 'Email/' . $templateName . '.html';
          $emailView->setTemplatePathAndFilename($templatePathAndFilename);
          $emailView->assignMultiple($variables);
          $emailBody = $emailView->render();

          $message = t3lib_div::makeInstance('t3lib_mail_Message');
          $message->setTo($recipient)
                ->setFrom($sender)
                ->setSubject($subject);

          // Possible attachments here
          //foreach ($attachments as $attachment) {
          //   $message->attach($attachment);
          //}

          // Plain text example
          $message->setBody($emailBody, 'text/plain');

          // HTML Email
          #$message->setBody($emailBody, 'text/html');

          $message->send();
          return $message->isSent();
      }

Usage
=====

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $this->sendTemplateEmail(array('recipient@domain.tld' => 'Recipient Name'), array('sender@domain.tld' => 'Sender Name'), 'Email Subject', 'TemplateName', array('someVariable' => 'Foo Bar'));

In this example, the Email templates are expected in
*Templates/Email/[TemplateName].html*. But this can be changed by
modifying line 14.

Localized emails
================

If you want to use **translated** content in your email template, you'll
have to pass the current extension name to the standalone view like to
make the *f:translate* view helper work as expected:

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $extensionName = $this->request->getControllerExtensionName();
      $emailView->getRequest()->setControllerExtensionName($extensionName);

Alternatively you can specify the complete path to your locallang file
in the fluid template: <HTML> <f:translate
key="LLL:EXT:yourExtensionKey/Resources/Private/Language/locallang.xml:someLanguageKey"
/> </HTML>

Update
------

if you call another Action with $this->forward($nextActionName) after
sending the Email you need replace in line 10:

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $emailView = $this->objectManager->create('Tx_Fluid_View_StandaloneView', $this->configurationManager->getContentObject());

instead of:

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $emailView = $this->objectManager->create('Tx_Fluid_View_StandaloneView');

Multiple formats
================

Calling setTemplate(...) Fluid defaults to using the html-format. Even
if you provide for example 'Invite.txt' it will try to read the file
'Invite.html' since the file-extension gets stripped and the ending
based on the format is added. To render, for example, an email in both
html and text use setFormat to switch the template-fileending used.

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $emailView->setTemplate('Invite');
      $emailView->assignMultiple($variables);

      $emailView->setFormat('html'); // will render Invite.html
      $emailBodyHtml = $emailView->render();

      $emailView->setFormat('txt'); // will render Invite.txt
      $emailBodyText = $emailView->render();

Usage in TYPO3 6.0 and higher
=============================

Due to the namespacing and the removal of some code deprecated earlier,
some slight changes appear on the 6.x Code. The functionality of the
snippet has not changed.

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      /**
      * @param array $recipient recipient of the email in the format array('recipient@domain.tld' => 'Recipient Name')
      * @param array $sender sender of the email in the format array('sender@domain.tld' => 'Sender Name')
      * @param string $subject subject of the email
      * @param string $templateName template name (UpperCamelCase)
      * @param array $variables variables to be passed to the Fluid view
      * @return boolean TRUE on success, otherwise false
      */
      protected function sendTemplateEmail(array $recipient, array $sender, $subject, $templateName, array $variables = array()) {
          /** @var \TYPO3\CMS\Fluid\View\StandaloneView $emailView */
          $emailView = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');

          $extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
          $templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath']);
          $templatePathAndFilename = $templateRootPath . 'Email/' . $templateName . '.html';
          $emailView->setTemplatePathAndFilename($templatePathAndFilename);
          $emailView->assignMultiple($variables);
          $emailBody = $emailView->render();

              // if you have an additional html Template //
              // $templatePathAndFilename = $templateRootPath . 'Email/' . $templateName . 'Html.html';
          // $emailView->setTemplatePathAndFilename($templatePathAndFilename);
              // $emailHtmlBody = $emailView->render();
          
              // if you want to use german or other UTF-8 chars in subject enable next line 
              // $subject =  '=?utf-8?B?'. base64_encode( subject  ) .'?=' ;

               /** @var $message \TYPO3\CMS\Core\Mail\MailMessage */
          $message = $this->objectManager->get('TYPO3\\CMS\\Core\\Mail\\MailMessage');
          $message->setTo($recipient)
                ->setFrom($sender)
                ->setSubject($subject);

          // Possible attachments here
          //foreach ($attachments as $attachment) {
          //   $message->attach(\Swift_Attachment::fromPath($attachment));
          //}

          // Plain text example
          $message->setBody($emailBody, 'text/plain');

          // HTML Email
          // $message->addPart($emailHtmlBody, 'text/html');

          $message->send();
          return $message->isSent();
      }

Usage in TYPO3 7.6 and higher
=============================

In LTS7 you have to use the following line to get the absolute filepath:

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPaths']['10']);

Usage in TYPO3 8.7
==================

In LTS8 if you get an error like "the fluid template files could not be
loaded" please add the following lines before calling method
"setTemplatePathAndFilename":

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      // in case you get an error like: The Fluid template files "" could not be loaded.
      $layoutRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['layoutRootPath']);
      $partialRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['partialRootPath']);
      $emailView->setLayoutRootPaths(array($layoutRootPath));
      $emailView->setPartialRootPaths(array($partialRootPath));

Extension Builder
-----------------

I found this solution to work on an extension which is based on the
Extension Builder (ver.8.7 from git):

.. container::

   `PHP
   Script <https://wiki.typo3.org/wiki/Help:Contents#Syntax-Highlighting_for_PHP-Code>`__
   [deprecated wiki link]

.. container::

   ::

      $extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
      $emailView->setTemplateRootPaths($extbaseFrameworkConfiguration['view']['templateRootPaths']);
      $emailView->setLayoutRootPaths($extbaseFrameworkConfiguration['view']['layoutRootPaths']);
      $emailView->setPartialRootPaths($extbaseFrameworkConfiguration['view']['layoutRootPaths']);
      $emailView->setTemplate('Email/' . $templateName . '.html');

.. container::

   Todo:
   Please check if this can be migrated to
   https://docs.typo3.org/m/typo3/reference-coreapi/master/en-us/ApiOverview/Mail/Index.html

   .. container::

   *Please remove "{{Todo}}" when the problem is solved. See*\ `all
   todos <https://wiki.typo3.org/Category:Wiki-Todo>`__\ *[deprecated
   wiki link].*
