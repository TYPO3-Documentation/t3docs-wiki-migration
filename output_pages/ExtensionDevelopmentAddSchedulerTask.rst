.. include:: /Includes.rst.txt
.. highlight:: php

=========================================
Extension Development, add Scheduler Task
=========================================

.. container::

   warning - No longer supported TYPO3 version

   .. container::

      This page contains information for older, no longer maintained
      TYPO3 versions. For information about TYPO3 versions, see
      `get.typo3.org <https://get.typo3.org>`__. For information about
      updating, see the `Installation & Upgrade
      Guide <https://docs.typo3.org/m/typo3/guide-installation/master/en-us/>`__

-  Register Scheduler Task in *ext_localconf.php*

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

        $TYPO3_CONF_VARS['SC_OPTIONS']['scheduler']['tasks']['tx_extkey_TaskName'] = array(
          'extension' => $_EXTKEY,
          'title' => 'LLL:EXT:' . $_EXTKEY . '/locallang.xlf:TaskName.name',
          'description' => 'LLL:EXT:' . $_EXTKEY . '/locallang.xlf:TaskName.description',
          // 'additionalFields' => 'tx_extkey_TaskName_AdditionalFieldProvider'
        );

-  

   -  Use »additionalFields« to add fields to the task configuration

-  Load classes in *ext_autoload.php*

   -  

.. container::

   PHP Script [outdated wiki link]

.. container::

   ::

        return array(
          'tx_extkey_TaskName' => t3lib_extMgm::extPath('extkey', 'tasks/class.tx_extkey_TaskName.php')
        );

-  Create your task class

   -  The class needs to extend *tx_scheduler_Task* and have a method
      *execute()* which may return TRUE or FALSE (task successful or
      not).
   -  Best example can be found in the scheduler extension itself → take
      a look at the example tasks in EXT:scheduler
      (https://typo3.org/api/typo3cms/_sleep_task_8php_source.html
      [outdated link] &
      https://typo3.org/api/typo3cms/_sleep_task_additional_field_provider_8php_source.html
      [outdated link])
