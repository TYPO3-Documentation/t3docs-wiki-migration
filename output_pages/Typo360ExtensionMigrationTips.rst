.. include:: /Includes.rst.txt
.. highlight:: php

.. _typo360-extension-migration-tips:

==================================
TYPO3 6.0 Extension Migration Tips
==================================

Static calls
============

+----------------------------------+----------------------------------+
| Call                             | Migration tip                    |
+----------------------------------+----------------------------------+
| tx                               | deprecated since TYPO3 4.5.1,    |
| _em_Tools::getArrayFromLocallang | will be removed in TYPO3 4.7 -   |
|                                  | use                              |
|                                  | pageRender                       |
|                                  | er->addInlineLanguageLabelFile() |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| t3lib_BEfunc::searchQuery        | deprecated since TYPO3 3.6, this |
|                                  | function will be removed in      |
|                                  | TYPO3 4.6, use                   |
|                                  | $GL                              |
|                                  | OBALS['TYPO3_DB']->searchQuery() |
|                                  | directly!                        |
+----------------------------------+----------------------------------+
| t3lib_BEfunc::listQuery          | deprecated since TYPO3 3.6, this |
|                                  | function will be removed in      |
|                                  | TYPO3 4.6, use                   |
|                                  | $                                |
|                                  | GLOBALS['TYPO3_DB']->listQuery() |
|                                  | directly!                        |
+----------------------------------+----------------------------------+
| t3lib_BEfunc::mm_query           | deprecated since TYPO3 3.6, this |
|                                  | function will be removed in      |
|                                  | TYPO3 4.6, use                   |
|                                  | $GLOBALS['TY                     |
|                                  | PO3_DB']->exec_SELECT_mm_query() |
|                                  | instead since that will return   |
|                                  | the result pointer while this    |
|                                  | returns the query. Using this    |
|                                  | function may make your           |
|                                  | application less fitted for DBAL |
|                                  | later.                           |
+----------------------------------+----------------------------------+
| t3lib_BEfunc::DBcompileInsert    | deprecated since TYPO3 3.6, this |
|                                  | function will be removed in      |
|                                  | TYPO3 4.6, use                   |
|                                  | $GLOBALS                         |
|                                  | ['TYPO3_DB']->exec_INSERTquery() |
|                                  | directly!                        |
+----------------------------------+----------------------------------+
| t3lib_BEfunc::DBcompileUpdate    | deprecated since TYPO3 3.6, this |
|                                  | function will be removed in      |
|                                  | TYPO3 4.6, use                   |
|                                  | $GLOBALS                         |
|                                  | ['TYPO3_DB']->exec_UPDATEquery() |
|                                  | directly!                        |
+----------------------------------+----------------------------------+
| t3lib_BEfunc::titleAttrib        | deprecated since TYPO3 3.6, this |
|                                  | function will be removed in      |
|                                  | TYPO3 4.6 - The idea made sense  |
|                                  | with older browsers, but now all |
|                                  | browsers should support the      |
|                                  | title" attribute - so just       |
|                                  | hardcode the title attribute     |
|                                  | instead!"                        |
+----------------------------------+----------------------------------+
| t3lib_BEfunc::getSetUpdateSignal | deprecated since TYPO3 4.2, this |
|                                  | function will be removed in      |
|                                  | TYPO3 4.6, use the               |
|                                  | setUpdateSignal function         |
|                                  | instead, as it allows you to add |
|                                  | more parameters                  |
+----------------------------------+----------------------------------+
| t3lib_BEfunc::typo3PrintError    | deprecated since TYPO3 4.5, will |
|                                  | be removed in TYPO3 4.7 - use    |
|                                  | RuntimeException from now on     |
+----------------------------------+----------------------------------+
| t3lib                            | deprecated since TYPO3 3.6, this |
| _BEfunc::getListOfBackendModules | function will be removed in      |
|                                  | TYPO3 4.6.                       |
+----------------------------------+----------------------------------+
| t3lib_div::GPvar                 | deprecated since TYPO3 3.6, will |
|                                  | be removed in TYPO3 4.6 - Use    |
|                                  | t3lib_div::_GP instead (ALWAYS   |
|                                  | delivers a value with un-escaped |
|                                  | values!)                         |
+----------------------------------+----------------------------------+
| t3lib_div::GParrayMerged         | deprecated since TYPO3 3.7, will |
|                                  | be removed in TYPO3 4.6 - Use    |
|                                  | t3lib_div::_GPmerged instead     |
+----------------------------------+----------------------------------+
| t3lib_div::fixed_lgd             | deprecated since TYPO3 4.1, will |
|                                  | be removed in TYPO3 4.6 - Works  |
|                                  | ONLY for single-byte charsets!   |
|                                  | Use t3lib_div::fixed_lgd_cs()    |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| t3lib_div::fixed_lgd_pre         | deprecated since TYPO3 4.1, will |
|                                  | be removed in TYPO3 4.6 - Use    |
|                                  | t3lib_div::fixed_lgd_cs()        |
|                                  | instead (with negative input     |
|                                  | value for $chars)                |
+----------------------------------+----------------------------------+
| t3lib_div::breakTextForEmail     | deprecated since TYPO3 4.1, will |
|                                  | be removed in TYPO3 4.6 - Use    |
|                                  | PHP function wordwrap()          |
+----------------------------------+----------------------------------+
| t3lib_div::rm_endcomma           | deprecated since TYPO3 4.5, will |
|                                  | be removed in TYPO3 4.7 - Use    |
|                                  | rtrim() directly                 |
+----------------------------------+----------------------------------+
| t3lib_div::danish_strtoupper     | deprecated since TYPO3 3.5, will |
|                                  | be removed in TYPO3 4.6 - Use    |
|                                  | t3lib_cs::conv_case() instead or |
|                                  | for HTML output, wrap your       |
|                                  | content in ...)"                 |
+----------------------------------+----------------------------------+
| t3lib_div::convUmlauts           | deprecated since TYPO3 4.1, will |
|                                  | be removed in TYPO3 4.6 - Works  |
|                                  | only for western europe          |
|                                  | single-byte charsets! Use        |
|                                  | t3lib_cs::specCharsToASCII()     |
|                                  | instead!                         |
+----------------------------------+----------------------------------+
| t3lib_div::uniqueArray           | deprecated since TYPO3 3.5, will |
|                                  | be removed in TYPO3 4.6 - Use    |
|                                  | the PHP function array_unique    |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| t3lib_div::array2json            | deprecated since TYPO3 4.3, will |
|                                  | be removed in TYPO3 4.6 - use    |
|                                  | PHP native function              |
|                                  | json_encode() instead, will be   |
|                                  | removed in TYPO3 4.5             |
+----------------------------------+----------------------------------+
| t3lib_div::implodeParams         | deprecated since TYPO3 3.7, will |
|                                  | be removed in TYPO3 4.6 - Name   |
|                                  | was changed into                 |
|                                  | implodeAttributes                |
+----------------------------------+----------------------------------+
| t3lib_div::debug_ordvalue        | deprecated since TYPO3 4.5 - Use |
|                                  | t                                |
|                                  | 3lib_utility_Debug::ordinalValue |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| t3lib_div::view_array            | deprecated since TYPO3 4.5 - Use |
|                                  | t3lib_utility_Debug::viewArray   |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| t3lib_div::print_array           | deprecated since TYPO3 4.5 - Use |
|                                  | t3lib_utility_Debug::printArray  |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| t3lib_div::debug                 | deprecated since TYPO3 4.5 - Use |
|                                  | t3lib_utility_Debug::debug       |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| t3lib_div::debug_trail           | deprecated since TYPO3 4.5 - Use |
|                                  | t3lib_utility_Debug::debugTrail  |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| t3lib_div::debugRows             | deprecated since TYPO3 4.5 - Use |
|                                  | t3lib_utility_Debug::debugRows   |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| t3lib_div::makeInstanceClassName | deprecated since TYPO3 4.3, will |
|                                  | be removed in TYPO3 4.6 - Use    |
|                                  | t3                               |
|                                  | lib_div::makeInstance('myClass', |
|                                  | $arg1, $arg2, ..., $argN)        |
+----------------------------------+----------------------------------+
| t3l                              | deprecated since TYPO3 4.6, will |
| ib_BEfunc::compilePreviewKeyword | be removed in TYPO3 4.8,         |
|                                  | functionality is now in          |
|                                  | Tx_Version_Preview               |
+----------------------------------+----------------------------------+
| t3lib_div::breakLinesForEmail    | deprecated since TYPO3 4.6, will |
|                                  | be removed in TYPO3 4.8 - Use    |
|                                  | t3lib_ut                         |
|                                  | ility_Mail::breakLinesForEmail() |
+----------------------------------+----------------------------------+
| t3lib_div::intInRange            | deprecated since TYPO3 4.6, will |
|                                  | be removed in TYPO3 4.8 - Use    |
|                                  | t3lib_uti                        |
|                                  | lity_Math::forceIntegerInRange() |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| t3lib_div::intval_positive       | deprecated since TYPO3 4.6, will |
|                                  | be removed in TYPO3 4.8 - Use    |
|                                  | t3lib_utility_                   |
|                                  | Math::convertToPositiveInteger() |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| t3lib_div::int_from_ver          | deprecated since TYPO3 4.6, will |
|                                  | be removed in TYPO3 4.9 - Use    |
|                                  | t3lib_utility_VersionNumber:     |
|                                  | :convertVersionNumberToInteger() |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| t3lib_div::testInt               | deprecated since TYPO3 4.6, will |
|                                  | be removed in TYPO3 4.8 - Use    |
|                                  | t3lib_utility_M                  |
|                                  | ath::canBeInterpretedAsInteger() |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| t3lib_div::calcPriority          | deprecated since TYPO3 4.6, will |
|                                  | be removed in TYPO3 4.8 - Use    |
|                                  | t3l                              |
|                                  | ib_utility_Math::calculateWithPr |
|                                  | iorityToAdditionAndSubtraction() |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| t3lib_div::calcParenthesis       | deprecated since TYPO3 4.6, will |
|                                  | be removed in TYPO3 4.8 - Use    |
|                                  | t3lib_utility_                   |
|                                  | Math::calculateWithParentheses() |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| t3lib_div::cHashParams           | deprecated since TYPO3 4.7 -     |
|                                  | will be removed in TYPO3 4.9 -   |
|                                  | use t3lib_cacheHash instead      |
+----------------------------------+----------------------------------+
| t3lib_div::generateCHash         | deprecated since TYPO3 4.7 -     |
|                                  | will be removed in TYPO3 4.9 -   |
|                                  | use t3lib_cacheHash instead      |
+----------------------------------+----------------------------------+
| t3lib_div::calculateCHash        | deprecated since TYPO3 4.7 -     |
|                                  | will be removed in TYPO3 4.9 -   |
|                                  | use t3lib_cacheHash instead      |
+----------------------------------+----------------------------------+
| t3lib_div::readLLPHPfile         | deprecated since TYPO3 4.6, will |
|                                  | be removed in TYPO3 4.8 - use    |
|                                  | t3lib_l1                         |
|                                  | 0n_parser_Llphp::getParsedData() |
|                                  | from now on                      |
+----------------------------------+----------------------------------+
| t3lib_div::readLLXMLfile         | deprecated since TYPO3 4.6, will |
|                                  | be removed in TYPO3 4.8 - use    |
|                                  | t3lib_l1                         |
|                                  | 0n_parser_Llxml::getParsedData() |
|                                  | from now on                      |
+----------------------------------+----------------------------------+
| t3lib_cache::initPageCache       | deprecated since TYPO3 4.6, will |
|                                  | be removed in 4.8 -              |
|                                  | cacheManager->getCache() now     |
|                                  | initializes caches automatically |
+----------------------------------+----------------------------------+
| t                                | deprecated since TYPO3 4.6, will |
| 3lib_cache::initPageSectionCache | be removed in 4.8 -              |
|                                  | cacheManager->getCache() now     |
|                                  | initializes caches automatically |
+----------------------------------+----------------------------------+
| t                                | deprecated since TYPO3 4.6, will |
| 3lib_cache::initContentHashCache | be removed in 4.8 -              |
|                                  | cacheManager->getCache() now     |
|                                  | initializes caches automatically |
+----------------------------------+----------------------------------+
| t3l                              | deprecated since 4.6, will be    |
| ib_cache::enableCachingFramework | removed in 4.8: The caching      |
|                                  | framework is enabled by default  |
+----------------------------------+----------------------------------+

Non static calls
----------------

+----------------------------------+----------------------------------+
| Call                             | Migration tip                    |
+----------------------------------+----------------------------------+
| tslib_content_PhpScript::__call  | deprecated since 4.5, will be    |
|                                  | removed in 4.7. Use              |
|                                  | $this->cObj-><method>() instead  |
+----------------------------------+----------------------------------+
| t                                | deprecated since TYPO3 4.3, will |
| 3lib_matchCondition::__construct | be removed in TYPO3 4.6 - The    |
|                                  | functionality was moved to       |
|                                  | t3lib_matchCondition_frontend    |
+----------------------------------+----------------------------------+
| tslib_content_PhpScript::__get   | deprecated since 4.5, will be    |
|                                  | removed in 4.7. Use              |
|                                  | $this->cObj-><property> instead. |
+----------------------------------+----------------------------------+
| Tx_Extbase_V                     | deprecated since Extbase 1.4.0,  |
| alidation_Validator_GenericObjec | will be removed in Extbase 6.0   |
| tValidator::addErrorsForProperty |                                  |
+----------------------------------+----------------------------------+
| tx_coreupdates                   | deprecated since TYPO3 4.5, will |
| _installnewsysexts::addExtToList | be removed in TYPO3 4.7 - Should |
|                                  | not be needed anymore.           |
|                                  | Extensions should be installed   |
|                                  | directly by calling              |
|                                  | Tx_Install_U                     |
|                                  | pdates_Base::installExtensions() |
+----------------------------------+----------------------------------+
| tx_coreupda                      | deprecated since TYPO3 4.5, will |
| tes_installsysexts::addExtToList | be removed in TYPO3 4.7 - Should |
|                                  | not be needed anymore.           |
|                                  | Extensions should be installed   |
|                                  | directly by calling              |
|                                  | Tx_Install_U                     |
|                                  | pdates_Base::installExtensions() |
+----------------------------------+----------------------------------+
| tslib_fe::ADMCMD_preview         | deprecated since TYPO3 4.6,      |
|                                  | should be removed in TYPO3 4.8,  |
|                                  | this is now in Tx_Version        |
+----------------------------------+----------------------------------+
| t                                | deprecated since TYPO3 4.6,      |
| slib_fe::ADMCMD_preview_postInit | should be removed in TYPO3 4.8,  |
|                                  | this is now in Tx_Version        |
+----------------------------------+----------------------------------+
| t3lib_                           | deprecated Since TYPO3 4.6, will |
| install::assembleFieldDefinition | be removed in 4.8, use method    |
|                                  | from t3lib_install_Sql instead   |
+----------------------------------+----------------------------------+
| t3lib_mat                        | deprecated since TYPO3 4.3, will |
| chCondition::browserInfo_version | be removed in TYPO3 4.6 - use    |
|                                  | t3                               |
|                                  | lib_utility_Client::getVersion() |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| Tx_Extbase_Utility_Extension::bu | deprecated since Extbase 1.4.0;  |
| ildAutoloadRegistryForSinglePath | will be removed in Extbase 6.0   |
+----------------------------------+----------------------------------+
| tx_r                             | deprecated since TYPO3 4.8, will |
| tehtmlarea_base::buildStyleSheet | be removed in TYPO3 4.10         |
+----------------------------------+----------------------------------+
| tslib_cObj::bytes                | deprecated since TYPO3 3.6, will |
|                                  | be removed in TYPO3 4.6 - Use    |
|                                  | t3lib_div::formatSize() instead  |
+----------------------------------+----------------------------------+
| tslib_fe::cHashParams            | deprecated since TYPO3 4.7 -     |
|                                  | will be removed in TYPO3 4.9 -   |
|                                  | use t3lib_cacheHash instead      |
+----------------------------------+----------------------------------+
| tslib_cObj::checkEmail           | deprecated since TYPO3 3.6, will |
|                                  | be removed in TYPO3 4.6 - Use    |
|                                  | t3lib_div::validEmail() instead  |
+----------------------------------+----------------------------------+
| t3lib_TStemplate::checkFile      | deprecated since TYPO3 3.6, this |
|                                  | function will be removed in      |
|                                  | TYPO3 4.6.                       |
+----------------------------------+----------------------------------+
| Tx_Extbase_MVC_Controller_Ac     | deprecated since Extbase 1.4.0,  |
| tionController::checkRequestHash | will be removed in Extbase 6.0   |
+----------------------------------+----------------------------------+
| template::clearCacheMenu         | deprecated since TYPO3 4.6, will |
|                                  | be removed in TYPO3 4.8          |
+----------------------------------+----------------------------------+
| wslib::CLI_main                  | deprecated since TYPO3 4.5, will |
|                                  | be removed in TYPO3 4.7 - This   |
|                                  | was meant for an obsolete CLI    |
|                                  | script. You shouldn't be calling |
|                                  | this.                            |
+----------------------------------+----------------------------------+
| tslib_fe::connectToMySQL         | deprecated since TYPO3 3.8, this |
|                                  | function will be removed in      |
|                                  | TYPO3 4.6, use connectToDB()     |
|                                  | instead!                         |
+----------------------------------+----------------------------------+
| Tx_E                             | deprecated since Extbase 1.3.0;  |
| xtbase_Utility_Extension::conver | will be removed in Extbase 1.5.0 |
| tCamelCaseToLowerCaseUnderscored |                                  |
+----------------------------------+----------------------------------+
| Tx_E                             | deprecated since Extbase 1.3.0;  |
| xtbase_Utility_Extension::conver | will be removed in Extbase 1.5.0 |
| tCamelCaseToLowerCaseUnderscored |                                  |
+----------------------------------+----------------------------------+
| Tx_Extbase_Configura             | deprecated since Extbase 1.4;    |
| tion_FrontendConfigurationManage | will be removed in Extbase 6.0   |
| r::convertFlexformContentToArray |                                  |
+----------------------------------+----------------------------------+
| Tx_E                             | deprecated since Extbase 1.3.0;  |
| xtbase_Utility_Extension::conver | will be removed in Extbase 1.5.0 |
| tLowerUnderscoreToUpperCamelCase |                                  |
+----------------------------------+----------------------------------+
| Tx_E                             | deprecated since Extbase 1.3.0;  |
| xtbase_Utility_Extension::conver | will be removed in Extbase 1.5.0 |
| tLowerUnderscoreToUpperCamelCase |                                  |
+----------------------------------+----------------------------------+
| t                                | deprecated since TYPO3 4.3, this |
| 3lib_timeTrack::convertMicrotime | function will be removed in      |
|                                  | TYPO3 4.6, use getMilliseconds() |
|                                  | instead that expects microtime   |
|                                  | as float instead of a string     |
+----------------------------------+----------------------------------+
| t3lib_htmlmail::convertName      | deprecated since TYPO3 4.0, will |
|                                  | be removed in TYPO3 4.6          |
+----------------------------------+----------------------------------+
| T                                | deprecated since Extbase 1.4.0;  |
| x_Extbase_Utility_TypoScript::co | will be removed in Extbase 6.0 - |
| nvertPlainArrayToTypoScriptArray | Use                              |
|                                  | Tx_E                             |
|                                  | xtbase_Service_TypoScriptService |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| t3lib_l                          | deprecated since TYPO3 4.6       |
| 10n_Locales::convertToTerLocales |                                  |
+----------------------------------+----------------------------------+
| T                                | deprecated since Extbase 1.4.0;  |
| x_Extbase_Utility_TypoScript::co | will be removed in Extbase 6.0 - |
| nvertTypoScriptArrayToPlainArray | Use                              |
|                                  | Tx_E                             |
|                                  | xtbase_Service_TypoScriptService |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| Tx_Extbase_Utility_Extension::co | deprecated since Extbase 1.3.0;  |
| nvertUnderscoredToLowerCamelCase | will be removed in Extbase 1.5.0 |
+----------------------------------+----------------------------------+
| Tx_Extbase_Utility_Extension::co | deprecated since Extbase 1.3.0;  |
| nvertUnderscoredToLowerCamelCase | will be removed in Extbase 1.5.0 |
+----------------------------------+----------------------------------+
| Tx_                              | deprecated since Extbase 1.3.0;  |
| Extbase_Persistence_Query::count | was removed in FLOW3; will be    |
|                                  | removed in Extbase 1.5.0; use    |
|                                  | Query::execute()::count()        |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| Tx_                              | deprecated since Extbase 1.3.0;  |
| Extbase_Persistence_Query::count | was removed in FLOW3; will be    |
|                                  | removed in Extbase 1.4.0; use    |
|                                  | Query::execute()::count()        |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| Tx_Extbase_Utility_Extension::cr | deprecated since Extbase 1.4.0;  |
| eateAutoloadRegistryForExtension | will be removed in Extbase 6.0   |
+----------------------------------+----------------------------------+
| clickMenu::DB_editPageHeader     | deprecated since TYPO3 4.0, will |
|                                  | be removed in TYPO3 4.6 - Use    |
|                                  | DB_editPageProperties instead    |
+----------------------------------+----------------------------------+
| t3lib_                           | deprecated since TYPO3 4.5, will |
| timeTrack::debug_typo3PrintError | be removed in TYPO3 4.7 - use    |
|                                  | RuntimeException from now on     |
+----------------------------------+----------------------------------+
| adoSchema::Destroy               | deprecated adoSchema now cleans  |
|                                  | up automatically.                |
+----------------------------------+----------------------------------+
| adoSchema::Destroy               | deprecated adoSchema now cleans  |
|                                  | up automatically.                |
+----------------------------------+----------------------------------+
| adoSchema::Destroy               | deprecated adoSchema now cleans  |
|                                  | up automatically.                |
+----------------------------------+----------------------------------+
| adoSchema::Destroy               | deprecated adoSchema now cleans  |
|                                  | up automatically.                |
+----------------------------------+----------------------------------+
| Tx_Extbase_Util                  | deprecated since Extbase 1.4.0;  |
| ity_Extension::extractClassNames | will be removed in Extbase 6.0   |
+----------------------------------+----------------------------------+
| tx_indexed                       | deprecated since TYPO3 4.3, this |
| search_indexer::fe_headerNoCache | function will be removed in      |
|                                  | TYPO3 4.6, the method was        |
|                                  | extracted to                     |
|                                  | hooks/class.tx                   |
|                                  | _indexedsearch_tslib_fe_hook.php |
+----------------------------------+----------------------------------+
| fileli                           | deprecated since TYPO3 4.6 and   |
| stFolderTree::filelistFolderTree | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| tslib_fe::fileNameASCIIPrefix    | deprecated since TYPO3, 4.3,     |
|                                  | will be removed in TYPO3 4.6,    |
|                                  | please use the simulatestatic"   |
|                                  | sysext directly"                 |
+----------------------------------+----------------------------------+
| Tx_Extb                          | deprecated since Extbase 1.4.0;  |
| ase_Utility_Extension::findToken | will be removed in Extbase 6.0   |
+----------------------------------+----------------------------------+
| t3lib_cache_fronte               | deprecated since 4.6, will be    |
| nd_AbstractFrontend::flushByTags | removed in 4.8                   |
+----------------------------------+----------------------------------+
| t3li                             | deprecated since at least TYPO3  |
| b_basicFileFunctions::formatSize | 4.2, will be removed in TYPO3    |
|                                  | 4.6 - Use                        |
|                                  | t3lib_div::formatSize() instead  |
+----------------------------------+----------------------------------+
| gzip_encode::freebsd_loadavg     | deprecated since TYPO3 4.3, this |
|                                  | function will be removed in      |
|                                  | TYPO3 4.6, we're using the       |
|                                  | ob_gzhandler" for compression    |
|                                  | now."                            |
+----------------------------------+----------------------------------+
| Tx_Extbase_Utility_Extens        | deprecated since Extbase 1.4.0;  |
| ion::generateAutoloadPhpFileData | will be removed in Extbase 6.0   |
+----------------------------------+----------------------------------+
| gzip_encode::get_complevel       | deprecated since TYPO3 4.3, this |
|                                  | function will be removed in      |
|                                  | TYPO3 4.6, we're using the       |
|                                  | ob_gzhandler" for compression    |
|                                  | now."                            |
+----------------------------------+----------------------------------+
| Tx_Extbase_Reflection_Objec      | deprecated since Extbase 1.3.0;  |
| tAccess::getAccessibleProperties | will be removed in Extbase       |
|                                  | 1.5.0. Please use                |
|                                  | getGettableProperties() instead  |
+----------------------------------+----------------------------------+
| Tx_Extbase_Reflection_Objec      | deprecated since Extbase 1.3.0;  |
| tAccess::getAccessibleProperties | will be removed in Extbase       |
|                                  | 1.5.0. Please use                |
|                                  | getGettableProperties() instead  |
+----------------------------------+----------------------------------+
| Tx_Extbase_Reflection_ObjectAc   | deprecated since Extbase 1.3.0;  |
| cess::getAccessiblePropertyNames | will be removed in Extbase       |
|                                  | 1.5.0. Please use                |
|                                  | getGettablePropertyNames()       |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| Tx_Extbase_Reflection_ObjectAc   | deprecated since Extbase 1.3.0;  |
| cess::getAccessiblePropertyNames | will be removed in Extbase       |
|                                  | 1.5.0. Please use                |
|                                  | getGettablePropertyNames()       |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| Tx_Extbase_MVC_                  | deprecated since Extbase 1.3.0;  |
| Controller_FlashMessages::getAll | will be removed in Extbase       |
|                                  | 1.5.0. Use Use getAllMessages()  |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| Tx_Extbase_MVC_                  | deprecated since Extbase 1.3.0;  |
| Controller_FlashMessages::getAll | will be removed in Extbase       |
|                                  | 1.5.0. Use Use getAllMessages()  |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| Tx_Extbase_MVC_Controll          | deprecated since Extbase 1.3.0;  |
| er_FlashMessages::getAllAndFlush | will be removed in Extbase       |
|                                  | 1.5.0. Use                       |
|                                  | getAllMessagesAndFlush() instead |
+----------------------------------+----------------------------------+
| Tx_Extbase_MVC_Controll          | deprecated since Extbase 1.3.0;  |
| er_FlashMessages::getAllAndFlush | will be removed in Extbase       |
|                                  | 1.5.0. Use                       |
|                                  | getAllMessagesAndFlush() instead |
+----------------------------------+----------------------------------+
| Tx_Extb                          | deprecated since Extbase 1.4.0,  |
| ase_MVC_Controller_ControllerCon | will be removed in Extbase 6.0   |
| text::getArgumentsMappingResults |                                  |
+----------------------------------+----------------------------------+
| Tx_Extbase                       | deprecated since Extbase 1.4.0,  |
| _Persistence_Manager::getBackend | will be removed in Extbase 6.0   |
+----------------------------------+----------------------------------+
| t3lib_cache_fronte               | deprecated since TYPO3 4.6 - Use |
| nd_AbstractFrontend::getClassTag | t3                               |
|                                  | lib_cache_Manager::getClassTag() |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| t3lib                            | deprecated Since TYPO3 4.6, will |
| _install::getCollationForCharset | be removed in 4.8, use method    |
|                                  | from t3lib_install_Sql instead   |
+----------------------------------+----------------------------------+
| Tx_Extbase_Dis                   | deprecated since Extbase 1.3.0;  |
| patcher::getConfigurationManager | will be removed in Extbase 1.5.0 |
+----------------------------------+----------------------------------+
| Tx_Extbase_Dis                   | deprecated since Extbase 1.3.0;  |
| patcher::getConfigurationManager | will be removed in Extbase 1.5.0 |
+----------------------------------+----------------------------------+
| Tx_Extbase_MVC_W                 | deprecated since Extbase 1.3.0;  |
| eb_Request::getContentObjectData | will be removed in Extbase       |
|                                  | 1.5.0. Use the                   |
|                                  | ConfigurationManager to retrieve |
|                                  | the current ContentObject        |
+----------------------------------+----------------------------------+
| Tx_Extbase_MVC_W                 | deprecated since Extbase 1.3.0;  |
| eb_Request::getContentObjectData | will be removed in Extbase       |
|                                  | 1.5.0. Use the                   |
|                                  | ConfigurationManager to retrieve |
|                                  | the current ContentObject        |
+----------------------------------+----------------------------------+
| SC_mod_w                         | deprecated since TYPO3 4.2.0,    |
| eb_ts_index::getCountCacheTables | will be removed in TYPO3 4.6     |
+----------------------------------+----------------------------------+
| t3lib_install::getCreateTables   | deprecated Since TYPO3 4.6, will |
|                                  | be removed in 4.8, use method    |
|                                  | from t3lib_install_Sql instead   |
+----------------------------------+----------------------------------+
| Tx_About_Controller_A            | deprecated Since 4.7; will be    |
| boutController::getCustomContent | removed together with the call   |
|                                  | in indexAction and the fluid     |
|                                  | partial in 4.9                   |
+----------------------------------+----------------------------------+
| t3lib_install::getDatabaseExtra  | deprecated Since TYPO3 4.6, will |
|                                  | be removed in 4.8, use method    |
|                                  | from t3lib_install_Sql instead   |
+----------------------------------+----------------------------------+
| template::getDynTabMenuJScode    | deprecated since TYPO3 4.5, as   |
|                                  | the getDynTabMenu() function     |
|                                  | includes the function            |
|                                  | automatically since TYPO3 4.3    |
+----------------------------------+----------------------------------+
| T                                | deprecated since Extbase 1.4.0,  |
| x_Extbase_MVC_Request::getErrors | will be removed with Extbase 6.0 |
+----------------------------------+----------------------------------+
| Tx_Ex                            | deprecated since Extbase 1.4.0,  |
| tbase_Validation_Validator_Abstr | will be removed in Extbase 6.0   |
| actCompositeValidator::getErrors |                                  |
+----------------------------------+----------------------------------+
| Tx_Extbase_Validation_Valida     | deprecated since Extbase 1.4.0,  |
| tor_AbstractValidator::getErrors | will be removed in Extbase 6.0.  |
|                                  | use validate() instead.          |
+----------------------------------+----------------------------------+
| Tx_Extbase_Validation_V          | deprecated since Extbase 1.4.0,  |
| alidator_RawValidator::getErrors | will be removed in Extbase 6.0   |
+----------------------------------+----------------------------------+
| Tx_Fluid_Vi                      | deprecated since Extbase 1.4.0,  |
| ewHelpers_Form_AbstractFormField | will be removed in Extbase       |
| ViewHelper::getErrorsForProperty | 1.6.0.                           |
+----------------------------------+----------------------------------+
| Tx_Extbase_Dispatcher::          | deprecated since Extbase 1.3.0;  |
| getExtbaseFrameworkConfiguration | will be removed in Extbase 1.5.0 |
+----------------------------------+----------------------------------+
| Tx_Extbase_Dispatcher::          | deprecated since Extbase 1.3.0;  |
| getExtbaseFrameworkConfiguration | will be removed in Extbase 1.5.0 |
+----------------------------------+----------------------------------+
| tsl                              | deprecated since 4.6, will be    |
| ib_AdminPanel::getExtPublishList | removed in 4.8                   |
+----------------------------------+----------------------------------+
| t3lib_insta                      | deprecated Since TYPO3 4.6, will |
| ll::getFieldDefinitions_database | be removed in 4.8, use method    |
|                                  | from t3lib_install_Sql instead   |
+----------------------------------+----------------------------------+
| t3lib_install:                   | deprecated Since TYPO3 4.6, will |
| :getFieldDefinitions_fileContent | be removed in 4.8, use method    |
|                                  | from t3lib_install_Sql instead   |
+----------------------------------+----------------------------------+
| t3lib_install                    | deprecated since TYPO3 4.2, this |
| ::getFieldDefinitions_sqlContent | function will be removed in      |
|                                  | TYPO3 4.6, use                   |
|                                  | ->g                              |
|                                  | etFieldDefinitions_fileContent() |
|                                  | instead!                         |
+----------------------------------+----------------------------------+
| t3lib_install::getFieldD         | deprecated Since TYPO3 4.6, will |
| efinitions_sqlContent_parseTypes | be removed in 4.8                |
+----------------------------------+----------------------------------+
| Tx_Extbase_MVC_Controller_Con    | deprecated since Extbase 1.1;    |
| trollerContext::getFlashMessages | will be removed in Extbase 6.0   |
+----------------------------------+----------------------------------+
| Tx_Extbase_MVC_Controller_Con    | deprecated                       |
| trollerContext::getFlashMessages |                                  |
+----------------------------------+----------------------------------+
| SC_index::getHiddenFields        | deprecated since TYPO3 4.3, will |
|                                  | be removed in TYPO3 4.6 - all    |
|                                  | the functionality was put in     |
|                                  | $this->startForm() and           |
|                                  | $this->addFields_hidden          |
+----------------------------------+----------------------------------+
| SC_mod_user_setup                | deprecated since TYPO3 4.6 -     |
| _index::getInstallToolFileExists | will be removed with TYPO3 4.8 - |
|                                  | use                              |
|                                  | Tx_Install_Service_BasicService  |
+----------------------------------+----------------------------------+
| SC_mod_user_set                  | deprecated since TYPO3 4.6 -     |
| up_index::getInstallToolFileKeep | will be removed with TYPO3 4.8 - |
|                                  | use                              |
|                                  | Tx_Install_Service_BasicService  |
+----------------------------------+----------------------------------+
| t3lib_TCEforms_inline::getJSON   | deprecated Since TYPO3 4.2:      |
|                                  | Moved to t3lib_div::array2json,  |
|                                  | will be removed in TYPO3 4.6     |
+----------------------------------+----------------------------------+
| t3lib_install::getListOfTables   | deprecated Since TYPO3 4.6, will |
|                                  | be removed in 4.8, use method    |
|                                  | from t3lib_install_Sql instead   |
+----------------------------------+----------------------------------+
| Tx_Workspace                     | deprecated since TYPO3 4.6 - use |
| s_Service_Befunc::getLivePageUid | Tx_Workspaces_Serv               |
|                                  | ice_Workspaces::getLivePageUid() |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| t3lib_l10n_Locales::getLocales   | deprecated since TYPO3 4.6, will |
|                                  | be removed in TYPO3 4.8          |
+----------------------------------+----------------------------------+
| t3lib_T                          | deprecated since TYPO3           |
| CEforms_inline::getNewRecordLink | 4.2.0-beta1, this function will  |
|                                  | be removed in TYPO3 4.6.         |
+----------------------------------+----------------------------------+
| tx                               | deprecated since 4.5             |
| _scheduler_CronCmd::getNextValue |                                  |
+----------------------------------+----------------------------------+
| Tx_E                             | deprecated since Extbase 1.3.0;  |
| xtbase_Object_Manager::getObject | will be removed in Extbase       |
|                                  | 1.5.0. Please use                |
|                                  | Tx_Extbase_Object_ObjectManager  |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| Tx_E                             | deprecated since Extbase 1.3.0;  |
| xtbase_Object_Manager::getObject | will be removed in Extbase       |
|                                  | 1.5.0. Please use                |
|                                  | Tx_Extbase_Object_ObjectManager  |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| Tx_Extbase_MV                    | deprecated since Extbase 1.4.0,  |
| C_Controller_Argument::getOrigin | will be removed in Extbase 6.0   |
+----------------------------------+----------------------------------+
| Tx_Extbase_D                     | deprecated since Extbase 1.3.0;  |
| ispatcher::getPersistenceManager | will be removed in Extbase 1.5.0 |
+----------------------------------+----------------------------------+
| Tx_Extbase_D                     | deprecated since Extbase 1.3.0;  |
| ispatcher::getPersistenceManager | will be removed in Extbase 1.5.0 |
+----------------------------------+----------------------------------+
| Tx_Extbase_Utility_              | deprecated since Extbase 1.4.0;  |
| Extension::getPluginNameByAction | will be removed in Extbase 6.0 - |
|                                  | Use                              |
|                                  | Tx_                              |
|                                  | Extbase_Service_ExtensionService |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| Tx_Extbase_Utili                 | deprecated since Extbase 1.4.0;  |
| ty_Extension::getPluginNamespace | will be removed in Extbase 6.0 - |
|                                  | Use                              |
|                                  | Tx_                              |
|                                  | Extbase_Service_ExtensionService |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| Tx_Fluid_Core_ViewHelper_Abstrac | deprecated since Extbase 1.4.0,  |
| tViewHelper::getRenderingContext | will be removed in Extbase       |
|                                  | 1.6.0. use                       |
|                                  | $this->renderingContext instead  |
+----------------------------------+----------------------------------+
| Tx_Extbase                       | deprecated since Extbase 1.4.0,  |
| _Persistence_Manager::getSession | will be removed in Extbase 6.0   |
+----------------------------------+----------------------------------+
| tslib_fe::getSimulFileName       | deprecated since TYPO3 4.3, will |
|                                  | be removed in TYPO3 4.6, please  |
|                                  | use the simulatestatic" sysext   |
|                                  | directly"                        |
+----------------------------------+----------------------------------+
| t3lib_install::getStatementArray | deprecated Since TYPO3 4.6, will |
|                                  | be removed in 4.8, use method    |
|                                  | from t3lib_install_Sql instead   |
+----------------------------------+----------------------------------+
| tx_cms_layout::getTable_fe_users | deprecated since TYPO3 4.6, will |
|                                  | be removed in TYPO3 4.8          |
+----------------------------------+----------------------------------+
| tx_cms_layout::getTable_sys_note | deprecated since TYPO3 4.6, will |
|                                  | be removed in TYPO3 4.8          |
+----------------------------------+----------------------------------+
| tx                               | deprecated since TYPO3 4.6, will |
| _cms_layout::getTable_tt_address | be removed in TYPO3 4.8          |
+----------------------------------+----------------------------------+
| tx_cms_layout::getTable_tt_board | deprecated since TYPO3 4.6, will |
|                                  | be removed in TYPO3 4.8          |
+----------------------------------+----------------------------------+
| tx_                              | deprecated since TYPO3 4.6, will |
| cms_layout::getTable_tt_calender | be removed in TYPO3 4.8          |
+----------------------------------+----------------------------------+
| tx_cms_layout::getTable_tt_guest | deprecated since TYPO3 4.6, will |
|                                  | be removed in TYPO3 4.8          |
+----------------------------------+----------------------------------+
| tx_cms_layout::getTable_tt_links | deprecated since TYPO3 4.6, will |
|                                  | be removed in TYPO3 4.8          |
+----------------------------------+----------------------------------+
| tx_cms_layout::getTable_tt_news  | deprecated since TYPO3 4.6, will |
|                                  | be removed in TYPO3 4.8          |
+----------------------------------+----------------------------------+
| tx_                              | deprecated since TYPO3 4.6, will |
| cms_layout::getTable_tt_products | be removed in TYPO3 4.8          |
+----------------------------------+----------------------------------+
| t3lib_i                          | deprecated Since TYPO3 4.6, will |
| nstall::getTableInsertStatements | be removed in 4.8, use method    |
|                                  | from t3lib_install_Sql instead   |
+----------------------------------+----------------------------------+
| Tx_Extbase_Utility               | deprecated since Extbase 1.4.0;  |
| _Extension::getTargetPidByPlugin | will be removed in Extbase 6.0 - |
|                                  | Use                              |
|                                  | Tx_                              |
|                                  | Extbase_Service_ExtensionService |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| t3lib_l10n_L                     | deprecated since TYPO3 4.6       |
| ocales::getTerLocaleDependencies |                                  |
+----------------------------------+----------------------------------+
| t                                | deprecated since TYPO3 4.6       |
| 3lib_l10n_Locales::getTerLocales |                                  |
+----------------------------------+----------------------------------+
| tx_scheduler_CronCmd::getTstamp  | deprecated since 4.5             |
+----------------------------------+----------------------------------+
| t3l                              | deprecated Since TYPO3 4.6, will |
| ib_install::getUpdateSuggestions | be removed in 4.8, use method    |
|                                  | from t3lib_install_Sql instead   |
+----------------------------------+----------------------------------+
| Tx_Extbase_Domain_M              | deprecated since Extbase 1.3.0;  |
| odel_FrontendUser::getUsergroups | will be removed in Extbase 1.5.0 |
|                                  | - use                            |
|                                  | Tx_Extbase_Domain_Mo             |
|                                  | del_FrontendUser::getUsergroup() |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| Tx_Extbase_Domain_M              | deprecated since Extbase 1.3.0;  |
| odel_FrontendUser::getUsergroups | will be removed in Extbase 1.5.0 |
|                                  | - use                            |
|                                  | Tx_Extbase_Domain_Mo             |
|                                  | del_FrontendUser::getUsergroup() |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| gzip_encode::gzip_accepted       | deprecated since TYPO3 4.3, this |
|                                  | function will be removed in      |
|                                  | TYPO3 4.6, we're using the       |
|                                  | ob_gzhandler" for compression    |
|                                  | now."                            |
+----------------------------------+----------------------------------+
| gzip_encode::gzip_encode         | deprecated since TYPO3 4.3, this |
|                                  | function will be removed in      |
|                                  | TYPO3 4.6, we're using the       |
|                                  | ob_gzhandler" for compression    |
|                                  | now."                            |
+----------------------------------+----------------------------------+
| t                                | deprecated since TYPO3 4.5, will |
| x_em_Extensions_Details::helpCol | be removed in TYPO3 4.7          |
+----------------------------------+----------------------------------+
| template::helpStyle              | deprecated since TYPO3 4.5, will |
|                                  | be removed in TYPO3 4.7          |
+----------------------------------+----------------------------------+
| t3lib_TCEforms::helpText         | deprecated since TYPO3 4.5, will |
|                                  | be removed in TYPO3 4.7          |
+----------------------------------+----------------------------------+
| t                                | deprecated since TYPO3 4.5, this |
| 3lib_TCEforms::helpText_typeFlex | function will be removed in      |
|                                  | TYPO3 4.7. Use                   |
|                                  | t3lib_BEfunc::wrapInHelp()       |
|                                  | instead.                         |
+----------------------------------+----------------------------------+
| t3lib_TCEforms::helpTextIcon     | deprecated since TYPO3 4.5, will |
|                                  | be removed in TYPO3 4.7          |
+----------------------------------+----------------------------------+
| t3lib                            | deprecated since TYPO3 4.5, this |
| _TCEforms::helpTextIcon_typeFlex | function will be removed in      |
|                                  | TYPO3 4.7. Use                   |
|                                  | t3lib_BEfunc::wrapInHelp()       |
|                                  | instead.                         |
+----------------------------------+----------------------------------+
| language::hscAndCharConv         | deprecated since TYPO3 4.6, will |
|                                  | be removed in TYPO3 4.8 - Use    |
|                                  | htmlspecialchars() instead.      |
+----------------------------------+----------------------------------+
| tslib_fe::idPartsAnalyze         | deprecated since TYPO3 4.3, will |
|                                  | be removed in TYPO3 4.5, please  |
|                                  | use the simulatestatic" sysext   |
|                                  | directly"                        |
+----------------------------------+----------------------------------+
| tslib_fe::idPartsAnalyze         | deprecated since TYPO3 4.3, will |
|                                  | be removed in TYPO3 4.5, please  |
|                                  | use the simulatestatic" sysext   |
|                                  | directly"                        |
+----------------------------------+----------------------------------+
| t3lib_stdGraphic::imagecreate    | deprecated since TYPO3 4.4, this |
|                                  | function will be removed in      |
|                                  | TYPO3 4.6.                       |
+----------------------------------+----------------------------------+
| t3li                             | deprecated since TYPO3 4.0, this |
| b_stdGraphic::imageCreateFromGif | function will be removed in      |
|                                  | TYPO3 4.6.                       |
+----------------------------------+----------------------------------+
| t3lib_stdGraphic::imageGif       | deprecated since TYPO3 4.0, this |
|                                  | function will be removed in      |
|                                  | TYPO3 4.6.                       |
+----------------------------------+----------------------------------+
| tslib_menu::includeMakeMenu      | deprecated since TYPO3 3.6, this |
|                                  | function will be removed in      |
|                                  | TYPO3 4.6, use HMENU of type     |
|                                  | userfunction" instead of         |
|                                  | "userdefined""                   |
+----------------------------------+----------------------------------+
| tx_cms_layout::infoGif           | deprecated since TYPO3 4.4, this |
|                                  | function will be removed in      |
|                                  | TYPO3 4.6                        |
+----------------------------------+----------------------------------+
| t3                               | deprecated since TYPO3           |
| lib_TCEforms_inline::initForAJAX | 4.2.0-alpha3, this function will |
|                                  | be removed in TYPO3 4.6.         |
+----------------------------------+----------------------------------+
| Tx_Extbase_M                     | deprecated since Extbase 1.4.0,  |
| VC_Controller_AbstractController | will be removed in Extbase 6.0   |
| ::injectDeprecatedPropertyMapper |                                  |
+----------------------------------+----------------------------------+
| t3lib_userAuthGroup::inList      | deprecated since TYPO3 4.7,      |
|                                  | should be removed in TYPO3 4.9,  |
|                                  | use equivalent function          |
|                                  | t3lib_div::inList()              |
+----------------------------------+----------------------------------+
| Tx_Extbase_Util                  | deprecated since Extbase 1.4.0;  |
| ity_Extension::isActionCacheable | will be removed in Extbase 6.0 - |
|                                  | Use                              |
|                                  | Tx_                              |
|                                  | Extbase_Service_ExtensionService |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| Tx_Extbase                       | deprecated since Extbase 1.4.0,  |
| _MVC_Web_Request::isHmacVerified | will be removed in Extbase 6.0   |
+----------------------------------+----------------------------------+
| Tx_Extb                          | deprecated since Extbase 1.4.0,  |
| ase_Validation_Validator_Generic | will be removed in Extbase 6.0   |
| ObjectValidator::isPropertyValid |                                  |
+----------------------------------+----------------------------------+
| Tx_Extbase_Validation_Validat    | deprecated since Extbase 1.4.0,  |
| or_ConjunctionValidator::isValid | will be removed in Extbase 6.0   |
+----------------------------------+----------------------------------+
| Tx_Extbase_Validation_Validat    | deprecated since Extbase 1.4.0,  |
| or_DisjunctionValidator::isValid | will be removed in Extbase 6.0   |
+----------------------------------+----------------------------------+
| Tx_Extbase_Validation_Validator  | deprecated since Extbase 1.4.0,  |
| _GenericObjectValidator::isValid | will be removed in Extbase 6.0   |
+----------------------------------+----------------------------------+
| Tx_Extbase_Validation            | deprecated since Extbase 1.4.0,  |
| _Validator_RawValidator::isValid | will be removed in Extbase 6.0   |
+----------------------------------+----------------------------------+
| Tx_Extbase_                      | deprecated since Extbase 1.4.0,  |
| MVC_Controller_Argument::isValue | will be removed with Extbase 6.0 |
+----------------------------------+----------------------------------+
| gzip_encode::linux_loadavg       | deprecated since TYPO3 4.3, this |
|                                  | function will be removed in      |
|                                  | TYPO3 4.6, we're using the       |
|                                  | ob_gzhandler" for compression    |
|                                  | now."                            |
+----------------------------------+----------------------------------+
| Tx_Extbas                        | deprecated since Extbase 1.4.0;  |
| e_Utility_ClassLoader::loadClass | will be removed in Extbase 6.0.  |
|                                  | TYPO3 core autoloader handles    |
|                                  | extbase files as well            |
+----------------------------------+----------------------------------+
| localFolderTree::localFolderTree | deprecated since TYPO3 4.6 and   |
|                                  | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| localFolderTree::localFolderTree | deprecated since TYPO3 4.6 and   |
|                                  | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| localPageTree::localPageTree     | deprecated since TYPO3 4.6 and   |
|                                  | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| localPageTree::localPageTree     | deprecated since TYPO3 4.6 and   |
|                                  | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| localPageTree::localPageTree     | deprecated since TYPO3 4.6 and   |
|                                  | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| tslib_fe::make_seed              | deprecated since TYPO3 4.3, this |
|                                  | function will be removed in      |
|                                  | TYPO3 4.6, the random number     |
|                                  | generator is seeded              |
|                                  | automatically since PHP 4.2.0    |
+----------------------------------+----------------------------------+
| tx_                              | deprecated since TYPO3 4.3, this |
| indexedsearch_indexer::makeCHash | function will be removed in      |
|                                  | TYPO3 4.6, use directly          |
|                                  | t3lib_div::calculateCHash()      |
+----------------------------------+----------------------------------+
| SC_index::makeLoginNews          | deprecated                       |
|                                  | $GLOBALS['TYPO                   |
|                                  | 3_CONF_VARS']['BE']['loginNews'] |
|                                  | is deprecated since 4.5. Use     |
|                                  | system news records instead.     |
+----------------------------------+----------------------------------+
| tx_simulatesta                   | deprecated since TYPO3 4.3, will |
| tic::makeSimulatedFileNameCompat | be deleted in TYPO3 4.6          |
+----------------------------------+----------------------------------+
| tslib_fe::makeSimulFileName      | deprecated since TYPO3 4.3, will |
|                                  | be removed in TYPO3 4.6, please  |
|                                  | use the simulatestatic" sysext   |
|                                  | directly"                        |
+----------------------------------+----------------------------------+
| tx_indexedsearch::md5inthash     | deprecated will be removed in    |
|                                  | 4.8                              |
+----------------------------------+----------------------------------+
| tx_i                             | deprecated will be removed in    |
| ndexedsearch_indexer::md5inthash | 4.8.                             |
+----------------------------------+----------------------------------+
| SC_index::mergeOldLoginLabels    | deprecated since TYPO3 4.6,      |
|                                  | remove in TYPO3 4.8              |
+----------------------------------+----------------------------------+
| template::middle                 | deprecated since TYPO3 3.6, will |
|                                  | be removed in TYPO3 4.6          |
+----------------------------------+----------------------------------+
| t3lib_timeTrack::mtime           | deprecated since TYPO3 4.3, this |
|                                  | function will be removed in      |
|                                  | TYPO3 4.6, use                   |
|                                  | getDifferenceToStarttime()       |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| Tx_Extbase_Uti                   | deprecated since Extbase 1.4.0;  |
| lity_TypeHandling::normalizeType | will be removed in Extbase 6.0 - |
|                                  | Use                              |
|                                  | Tx_E                             |
|                                  | xtbase_Service_TypoScriptService |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| t3lib_TCEforms::noTitle          | deprecated since TYPO3 4.1, this |
|                                  | function will be removed in      |
|                                  | TYPO3 4.6.                       |
+----------------------------------+----------------------------------+
| tslib_fe::pageCachePostProcess   | deprecated since 4.6, will be    |
|                                  | removed in 4.8                   |
+----------------------------------+----------------------------------+
| adoSchema::ParseSchemaFile       | deprecated Replaced by           |
|                                  | adoSchema::ParseSchema() and     |
|                                  | adoSchema::ParseSchemaString()   |
+----------------------------------+----------------------------------+
| adoSchema::ParseSchemaFile       | deprecated Replaced by           |
|                                  | adoSchema::ParseSchema() and     |
|                                  | adoSchema::ParseSchemaString()   |
+----------------------------------+----------------------------------+
| adoSchema::ParseSchemaFile       | deprecated Replaced by           |
|                                  | adoSchema::ParseSchema() and     |
|                                  | adoSchema::ParseSchemaString()   |
+----------------------------------+----------------------------------+
| adoSchema::ParseSchemaFile       | deprecated Replaced by           |
|                                  | adoSchema::ParseSchema() and     |
|                                  | adoSchema::ParseSchemaString()   |
+----------------------------------+----------------------------------+
| Tx_Extbase                       | deprecated since Extbase 1.4.0;  |
| _Utility_TypeHandling::parseType | will be removed in Extbase 6.0 - |
|                                  | Use                              |
|                                  | Tx_E                             |
|                                  | xtbase_Service_TypoScriptService |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| t3l                              | deprecated Since TYPO3 4.6, will |
| ib_install::performUpdateQueries | be removed in 4.8, use method    |
|                                  | from t3lib_install_Sql instead   |
+----------------------------------+----------------------------------+
| tslib_pibase::pi_list_query      | deprecated since TYPO3 3.6, this |
|                                  | function will be removed in      |
|                                  | TYPO3 4.5, use pi_exec_query()   |
|                                  | instead!                         |
+----------------------------------+----------------------------------+
| tslib_pibase::pi_setClassStyle   | deprecated since TYPO3 3.6, this |
|                                  | function will be removed in      |
|                                  | TYPO3 4.6, I think this function |
|                                  | should not be used (and probably |
|                                  | isn't used anywhere). It was a   |
|                                  | part of a concept which was left |
|                                  | behind quite quickly.            |
+----------------------------------+----------------------------------+
| SC_view_help::printItemFlex      | deprecated since TYPO3 4.5, this |
|                                  | function will be removed in      |
|                                  | TYPO3 4.7. Use printItem()       |
|                                  | instead.                         |
+----------------------------------+----------------------------------+
| formRender::printPalette         | deprecated since TYPO3 4.3, will |
|                                  | be removed in TYPO3 4.6          |
+----------------------------------+----------------------------------+
| t3lib_TStemplate::procesIncludes | deprecated since TYPO3 4.4 -     |
|                                  | Method name misspelled. Use      |
|                                  | processIncludes" instead! This   |
|                                  | function will be removed in      |
|                                  | TYPO3 4.6."                      |
+----------------------------------+----------------------------------+
| tx_sv_au                         | deprecated will be removed with  |
| th::processOriginalPasswordValue | 4.9                              |
+----------------------------------+----------------------------------+
| tx_indexedsea                    | deprecated since TYPO3 4.0, this |
| rch_indexer::procesWordsInArrays | function will be removed in      |
|                                  | TYPO3 4.6.                       |
+----------------------------------+----------------------------------+
| t3lib_htmlmail::quoted_printable | deprecated since TYPO3 4.0, will |
|                                  | be removed in TYPO3 4.6          |
+----------------------------------+----------------------------------+
| tslib_search::quotemeta          | deprecated This function is      |
|                                  | deprecated since TYPO3 4.6 and   |
|                                  | will be removed in TYPO3 4.8.    |
|                                  | Please, use preg_quote()         |
|                                  | instead.                         |
+----------------------------------+----------------------------------+
| ux_t3lib_DB::quoteSelectFields   | deprecated since TYPO3 4.0, will |
|                                  | be removed in TYPO3 4.6          |
+----------------------------------+----------------------------------+
| t3lib_userAuth::redirect         | deprecated since TYPO3 3.6, this |
|                                  | function will be removed in      |
|                                  | TYPO3 4.6.                       |
+----------------------------------+----------------------------------+
| t3lib_stdGraphic::reduceColors   | deprecated since TYPO3 4.4, this |
|                                  | function will be removed in      |
|                                  | TYPO3 4.6.                       |
+----------------------------------+----------------------------------+
| RemoveXSS::RemoveXSS             | deprecated since TYPO3 4.3, will |
|                                  | be removed in TYPO3 4.6 - use    |
|                                  | static call RemoveXSS::process() |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| tslib_content_PhpScript::render  | deprecated since TYPO3 4.6, will |
|                                  | be removed in TYPO3 4.8          |
+----------------------------------+----------------------------------+
| tslib_c                          | deprecated since TYPO3 4.6, will |
| ontent_PhpScriptExternal::render | be removed in TYPO3 4.8          |
+----------------------------------+----------------------------------+
| tslib_c                          | deprecated since TYPO3 4.6, will |
| ontent_PhpScriptInternal::render | be removed in TYPO3 4.8          |
+----------------------------------+----------------------------------+
| SC_view_help::render_SingleFlex  | deprecated since TYPO3 4.5, this |
|                                  | function will be removed in      |
|                                  | TYPO3 4.7. Use render_Single()   |
|                                  | instead.                         |
+----------------------------------+----------------------------------+
| SC_mod_user_setup_index::r       | deprecated since TYPO3 4.6 -     |
| enderInstallToolEnableFileButton | will be removed with TYPO3 4.8   |
+----------------------------------+----------------------------------+
| Tx_Extb                          | deprecated since Extbase 1.4.0,  |
| ase_MVC_Controller_ControllerCon | will be removed in Extbase 6.0   |
| text::setArgumentsMappingResults |                                  |
+----------------------------------+----------------------------------+
| t3lib_cache_                     | deprecated since TYPO3 4.6: The  |
| backend_DbBackend::setCacheTable | backend calculates the table     |
|                                  | name internally, this method     |
|                                  | does nothing anymore             |
+----------------------------------+----------------------------------+
| T                                | deprecated since Extbase 1.4.0,  |
| x_Extbase_MVC_Request::setErrors | will be removed with Extbase 6.0 |
+----------------------------------+----------------------------------+
| t3lib_spritemanager_Spr          | deprecated IE6 support will be   |
| iteGenerator::setGenerateGifCopy | dropped within 4.6 - then        |
|                                  | gifcopies are superflous         |
+----------------------------------+----------------------------------+
| Tx_Extbase_                      | deprecated since Extbase 1.4.0,  |
| MVC_Web_Request::setHmacVerified | will be removed in Extbase 6.0   |
+----------------------------------+----------------------------------+
| SC_mod_user_setup                | deprecated since TYPO3 4.6 -     |
| _index::setInstallToolFileExists | will be removed with TYPO3 4.8 - |
|                                  | use                              |
|                                  | Tx_Install_Service_BasicService  |
+----------------------------------+----------------------------------+
| SC_mod_user_set                  | deprecated since TYPO3 4.6 -     |
| up_index::setInstallToolFileKeep | will be removed with TYPO3 4.8 - |
|                                  | use                              |
|                                  | Tx_Install_Service_BasicService  |
+----------------------------------+----------------------------------+
| Tx_Extbase_MVC_Controller_Argu   | deprecated since Extbase 1.4.0,  |
| ment::setNewValidatorConjunction | will be removed in Extbase 6.0   |
+----------------------------------+----------------------------------+
| Tx_Ext                           | deprecated since Extbase 1.4.0,  |
| base_Validation_Validator_Abstra | will be removed in Extbase 6.0   |
| ctCompositeValidator::setOptions |                                  |
+----------------------------------+----------------------------------+
| Tx_Extbase_Validation_Validat    | deprecated since Extbase 1.4.0,  |
| or_AbstractValidator::setOptions | will be removed in Extbase 6.0.  |
|                                  | use constructor instead.         |
+----------------------------------+----------------------------------+
| Tx_Extbase_Validation_Va         | deprecated since Extbase 1.4.0,  |
| lidator_RawValidator::setOptions | will be removed in Extbase 6.0   |
+----------------------------------+----------------------------------+
| t                                | deprecated since TYPO3 4.3, will |
| slib_fe::setSimulReplacementChar | be removed in TYPO3 4.6, please  |
|                                  | use the simulatestatic" sysext   |
|                                  | directly"                        |
+----------------------------------+----------------------------------+
| t3lib_cache                      | deprecated since TYPO3 4.6: The  |
| _backend_DbBackend::setTagsTable | backend calculates the table     |
|                                  | name internally, this method     |
|                                  | does nothing anymore             |
+----------------------------------+----------------------------------+
| tslib_fe::simulat                | deprecated since TYPO3 4.3, will |
| eStaticDocuments_pEnc_onlyP_proc | be removed in TYPO3 4.6, please  |
|                                  | use the simulatestatic" sysext   |
|                                  | directly"                        |
+----------------------------------+----------------------------------+
| t3lib_DB::sql                    | deprecated since TYPO3 3.6, will |
|                                  | be removed in TYPO3 4.6          |
+----------------------------------+----------------------------------+
| ux_t3lib_DB::sql                 | deprecated since TYPO3 4.1, will |
|                                  | be removed in TYPO3 4.6          |
+----------------------------------+----------------------------------+
| tslib_content_Abstract::stdWrap  | deprecated since TYPO3 4.5, this |
|                                  | function will be removed in      |
|                                  | TYPO3 4.7, use                   |
|                                  | $this->cObj->stdWrap() instead.  |
+----------------------------------+----------------------------------+
| tx_cms_layout::strip_tags        | deprecated since TYPO3 4.6, will |
|                                  | be removed in 4.8 - using        |
|                                  | php-function strip_tags now      |
+----------------------------------+----------------------------------+
| t3lib_cli::t3lib_cli             | deprecated since TYPO3 4.6 and   |
|                                  | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| t3                               | deprecated since TYPO3 4.6 and   |
| lib_folderTree::t3lib_folderTree | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| t3lib_install::t3lib_install     | deprecated since TYPO3 4.6 and   |
|                                  | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| t3lib_TCEforms::t3lib_TCEforms   | deprecated since TYPO3 4.6 and   |
|                                  | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| t3lib_xml::t3lib_xml             | deprecated since TYPO3 4.6 and   |
|                                  | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| TBE_browser_re                   | deprecated since TYPO3 4.6 and   |
| cordList::TBE_browser_recordList | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| template::template               | deprecated since TYPO3 4.6 and   |
|                                  | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| tx_em_Connect                    | deprecated since 4.6, will be    |
| ion_ExtDirectSoap::testUserLogin | removed in 4.8                   |
+----------------------------------+----------------------------------+
| template::thisBlur               | deprecated since TYPO3 4.5, will |
|                                  | be removed in TYPO3 4.7          |
+----------------------------------+----------------------------------+
| t3lib_beUserAuth::trackBeUser    | deprecated since TYPO3 3.6, this |
|                                  | function will be removed in      |
|                                  | TYPO3 4.6.                       |
+----------------------------------+----------------------------------+
| Tx_Extbase_MVC_Con               | deprecated since Extbase 1.4,    |
| troller_Argument::transformValue | will be removed in Extbase 6.0   |
+----------------------------------+----------------------------------+
| tslib_fe::tslib_fe               | deprecated since TYPO3 4.6 and   |
|                                  | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| tslib_pibase::tslib_pibase       | deprecated since TYPO3 4.6 and   |
|                                  | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| tx_cms_layout::tt_board_drawItem | deprecated since TYPO3 4.6, will |
|                                  | be removed in TYPO3 4.8          |
+----------------------------------+----------------------------------+
| tx_cms_layout::tt_board_getTree  | deprecated since TYPO3 4.6, will |
|                                  | be removed in TYPO3 4.8          |
+----------------------------------+----------------------------------+
| tx_indexedsear                   | deprecated since TYPO3 4.6 and   |
| ch_lexer::tx_indexedsearch_lexer | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| tx_install::tx_install           | deprecated since TYPO3 4.6 and   |
|                                  | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| tx_lowlevel_ad                   | deprecated since TYPO3 4.6 and   |
| min_core::tx_lowlevel_admin_core | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| tx_lowlevel_cleane               | deprecated since TYPO3 4.6 and   |
| r_core::tx_lowlevel_cleaner_core | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| tx_lowlevel_cleanfle             | deprecated since TYPO3 4.6 and   |
| xform::tx_lowlevel_cleanflexform | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| tx_lowle                         | deprecated since TYPO3 4.6 and   |
| vel_deleted::tx_lowlevel_deleted | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| tx_lowlevel_double               | deprecated since TYPO3 4.6 and   |
| _files::tx_lowlevel_double_files | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| tx_lowlevel_lo                   | deprecated since TYPO3 4.6 and   |
| st_files::tx_lowlevel_lost_files | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| tx_lowlevel_missing_             | deprecated since TYPO3 4.6 and   |
| files::tx_lowlevel_missing_files | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| tx_lowlevel_missing_relation     | deprecated since TYPO3 4.6 and   |
| s::tx_lowlevel_missing_relations | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| tx_lowlevel_orphan_rec           | deprecated since TYPO3 4.6 and   |
| ords::tx_lowlevel_orphan_records | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| tx_lowlevel_rt                   | deprecated since TYPO3 4.6 and   |
| e_images::tx_lowlevel_rte_images | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| tx_low                           | deprecated since TYPO3 4.6 and   |
| level_syslog::tx_lowlevel_syslog | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| tx_lowleve                       | deprecated since TYPO3 4.6 and   |
| l_versions::tx_lowlevel_versions | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| tx_indexedsearch_                | deprecated since 4.7, will be    |
| modfunc1::utf8_to_currentCharset | removed in 4.9                   |
+----------------------------------+----------------------------------+
| Tx_Extb                          | deprecated since Extbase 1.4;    |
| ase_Configuration_FrontendConfig | will be removed in Extbase 6.0   |
| urationManager::walkFlexformNode |                                  |
+----------------------------------+----------------------------------+
| webPageTree::webPageTree         | deprecated since TYPO3 4.6 and   |
|                                  | will be removed in TYPO3 4.8.    |
|                                  | Use \__construct() instead.      |
+----------------------------------+----------------------------------+
| tslib_cObj::whereSelectFromList  | deprecated since TYPO3 3.6, will |
|                                  | be removed in TYPO3 4.6 - Use    |
|                                  | $                                |
|                                  | GLOBALS['TYPO3_DB']->listQuery() |
|                                  | directly!                        |
+----------------------------------+----------------------------------+
| Tx_Ex                            | deprecated since Extbase 1.2.0;  |
| tbase_Persistence_Query::withUid | was removed in FLOW3; will be    |
|                                  | removed in Extbase 1.3.0; use    |
|                                  | equals() instead                 |
+----------------------------------+----------------------------------+
| tslib_fe::workspacePreviewInit   | deprecated since TYPO3 4.7, will |
|                                  | be removed in TYPO3 4.9 as this  |
|                                  | is part of Tx_Version now        |
+----------------------------------+----------------------------------+
| t3lib_userAuthGrou               | deprecated since TYPO3 4.4, will |
| p::workspaceVersioningTypeAccess | be removed in TYPO3 4.8 as only  |
|                                  | element versioning is supported  |
|                                  | now                              |
+----------------------------------+----------------------------------+
| t3lib_userAuthGroup::w           | deprecated since TYPO3 4.4, will |
| orkspaceVersioningTypeGetClosest | be removed in TYPO3 4.8 as only  |
|                                  | element versioning is supported  |
|                                  | now                              |
+----------------------------------+----------------------------------+
| tx_coreupdates_installn          | deprecated since TYPO3 4.5, will |
| ewsysexts::writeNewExtensionList | be removed in TYPO3 4.7 - Use    |
|                                  | Tx_Install_U                     |
|                                  | pdates_Base::installExtensions() |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| tx_coreupdates_insta             | deprecated since TYPO3 4.5, will |
| llsysexts::writeNewExtensionList | be removed in TYPO3 4.7 - Use    |
|                                  | Tx_Install_U                     |
|                                  | pdates_Base::installExtensions() |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| formRender                       | deprecated since TYPO3 4.3, will |
|                                  | be removed in TYPO3 4.6          |
+----------------------------------+----------------------------------+
| tslib_content_Html               | deprecated since TYPO3 4.6, will |
|                                  | be removed in TYPO3 4.8 - use    |
|                                  | TEXT from now on                 |
+----------------------------------+----------------------------------+
| tx_aboutmodules_Functions        | deprecated since 4.7, will be    |
|                                  | removed in 4.9                   |
+----------------------------------+----------------------------------+
| Tx_Extbase_BaseTestCase          | deprecated since Extbase 1.3;    |
|                                  | will be removed in Extbase 1.5   |
+----------------------------------+----------------------------------+
| Tx_Extbase_BaseTestCase          | deprecated use                   |
|                                  | Tx                               |
|                                  | _Extbase_Tests_Unit_BaseTestCase |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| Tx_Extbase_Dispatcher            | deprecated since Extbase 1.3.0;  |
|                                  | will be removed in Extbase 1.5.0 |
+----------------------------------+----------------------------------+
| Tx_Extbase_Dispatcher            | deprecated since Extbase 1.3.0;  |
|                                  | will be removed in Extbase 1.5.0 |
+----------------------------------+----------------------------------+
| Tx_Extb                          | deprecated since Extbase 1.4.0,  |
| ase_MVC_Controller_ArgumentError | will be removed in Extbase 6.0   |
+----------------------------------+----------------------------------+
| Tx_Extbase_M                     | deprecated since Extbase 1.4.0,  |
| VC_Controller_ArgumentsValidator | will be removed in Extbase 6.0.  |
|                                  | Is only needed for old property  |
|                                  | mapper.                          |
+----------------------------------+----------------------------------+
| Tx_Extbase_Object_Manager        | deprecated since Extbase 1.3.0;  |
|                                  | will be removed in Extbase 1.5.0 |
+----------------------------------+----------------------------------+
| Tx_Extbase_Object_Manager        | deprecated since Extbase 1.3.0;  |
|                                  | will be removed in Extbase 1.5.0 |
+----------------------------------+----------------------------------+
| Tx_Extbase_Persistence_QOM_Qu    | deprecated since Extbase 1.1;    |
| eryObjectModelConstantsInterface | use                              |
|                                  | Tx_Extbas                        |
|                                  | e_Persistence_QueryInterface::\* |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| Tx_Extbase_Persistence_QOM_Qu    | deprecated since Extbase 1.1;    |
| eryObjectModelConstantsInterface | use                              |
|                                  | Tx_Extbas                        |
|                                  | e_Persistence_QueryInterface::\* |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| Tx_Extbase_Property_Mapper       | deprecated since Extbase 1.4.0   |
+----------------------------------+----------------------------------+
| Tx                               | deprecated since Extbase 1.4.0,  |
| _Extbase_Property_MappingResults | will be removed in Extbase 6.0   |
+----------------------------------+----------------------------------+
| Tx_Extbase_Utility_Cache         | deprecated since Extbase 1.4.0;  |
|                                  | will be removed in Extbase 6.0.  |
|                                  | Please use                       |
|                                  | Tx_Extbase_Service_CacheService  |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| Tx_Extbase_Utility_TypeHandling  | deprecated since Extbase 1.4.0;  |
|                                  | will be removed in Extbase 6.0.  |
|                                  | Please use                       |
|                                  | Tx_Ext                           |
|                                  | base_Service_TypeHandlingService |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| Tx_Extbase_Utility_TypoScript    | deprecated since Extbase 1.4.0;  |
|                                  | will be removed in Extbase 6.0.  |
|                                  | Please use                       |
|                                  | Tx_E                             |
|                                  | xtbase_Service_TypoScriptService |
|                                  | instead                          |
+----------------------------------+----------------------------------+
| Tx_                              | deprecated since Extbase 1.4.0,  |
| Extbase_Validation_PropertyError | will be removed in Extbase 6.0   |
+----------------------------------+----------------------------------+
| Tx_Extbase_Validation_V          | deprecated since Extbase 1.4.0,  |
| alidator_AbstractObjectValidator | will be removed in Extbase 6.0   |
+----------------------------------+----------------------------------+
| Tx_Extbase_Validation_Va         | deprecated since Extbase 1.4.0,  |
| lidator_ObjectValidatorInterface | will be removed in Extbase 6.0   |
+----------------------------------+----------------------------------+
| Tx_Fluid_Co                      | deprecated. Extend               |
| re_ViewHelper_TagBasedViewHelper | Tx_Fluid_Core_ViewH              |
|                                  | elper_AbstractTagBasedViewHelper |
|                                  | instead!                         |
+----------------------------------+----------------------------------+
| Tx_Fluid_Co                      | deprecated. Extend               |
| re_ViewHelper_TagBasedViewHelper | Tx_Fluid_Core_ViewH              |
|                                  | elper_AbstractTagBasedViewHelper |
|                                  | instead!                         |
+----------------------------------+----------------------------------+
| Tx_Fl                            | deprecated since Extbase 1.4.0;  |
| uid_ViewHelpers_EscapeViewHelper | will be removed in Extbase       |
|                                  | 1.6.0. Please use the            |
|                                  | <f:format.*> ViewHelpers         |
|                                  | instead.                         |
+----------------------------------+----------------------------------+
| Tx_Fluid_V                       | deprecated since Extbase 1.4.0,  |
| iewHelpers_Form_ErrorsViewHelper | will be removed with Extbase     |
|                                  | 1.6.0.                           |
+----------------------------------+----------------------------------+
| Tx_Fluid_Vi                      | deprecated since Extbase 1.4.0;  |
| ewHelpers_Form_TextboxViewHelper | will be removed in Extbase       |
|                                  | 1.6.0. Please use the            |
|                                  | <f:form.textfield> ViewHelper    |
|                                  | instead.                         |
+----------------------------------+----------------------------------+
| Tx_Fluid_Vi                      | deprecated since 1.0.0 alpha 7   |
| ewHelpers_Form_TextboxViewHelper |                                  |
+----------------------------------+----------------------------------+
| Tx_Fluid_ViewHelpe               | deprecated since Extbase 1.3.0;  |
| rs_RenderFlashMessagesViewHelper | will be removed in Extbase 1.5.0 |
+----------------------------------+----------------------------------+
| Tx_Fluid_ViewHelpe               | deprecated since Extbase 1.3.0;  |
| rs_RenderFlashMessagesViewHelper | will be removed in Extbase 1.5.0 |
+----------------------------------+----------------------------------+
