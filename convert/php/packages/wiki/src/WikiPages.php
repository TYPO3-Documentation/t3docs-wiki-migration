<?php

declare(strict_types=1);

namespace Typo3\Wiki;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class WikiPages extends AbstractWiki
{
    public function __construct(string $outputDir)
    {
        parent::__construct($outputDir);

        $this->setIncludePages($this->getMostVisitedWikiPages());
    }

    /**
     * Fetch list of TYPO3 Wiki pages.
     *
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws DecodingExceptionInterface
     *
     * @see https://www.mediawiki.org/wiki/API:Query
     * @see https://www.mediawiki.org/wiki/API:Info
     */
    protected function fetchListOfPages(): void
    {
        $client = HttpClient::create();
        $query = [
            'action' => 'query',
            'generator' => 'allpages',
            'prop' => 'info',
            'inprop' => 'url',
            'format' => 'json',
            'gaplimit' => 500,
        ];
        $pages = [];
        $includePagesIndex = array_flip($this->includePages);

        do {
            $response = $client->request('GET', self::WIKI_API_URL, ['query' => $query + [
                'gapcontinue' => $responseData['continue']['gapcontinue'] ?? ''
            ]]);
            $responseData = $response->toArray();
            if (!empty($responseData['query']['pages'])) {
                $pages += $responseData['query']['pages'];
            }
        } while (!empty($responseData['continue']['gapcontinue']));

        foreach ($pages as &$page) {
            if (!empty($includePagesIndex)) {
                if (isset($includePagesIndex[$page['canonicalurl']])) {
                    $this->pages[] = $page['canonicalurl'];
                }
            } else {
                $this->pages[] = $page['canonicalurl'];
            }
        }

        $this->info("%d pages will be fetched.", count($this->pages));
    }

    /**
     * List of most visited wiki pages.
     *
     * @return string[]
     * @see https://github.com/TYPO3-Documentation/T3DocTeam/issues/154
     */
    protected function getMostVisitedWikiPages(): array
    {
        return [
            'Default_Orderings_and_Query_Settings_in_Repository',
            'TYPO3_templates_repository',
            'FAQ/Reset_admin_password',
            'Upgrade',
            'Fluid',
            'How_to_upload_big_files',
            'Extension_Development,_using_Flexforms',
            'Dependency_Injection',
            'How_to_use_the_Fluid_Standalone_view_to_render_template_based_emails',
            'Extbase_HowTos',
            'Fluid_Inline_Notation',
            'Composer',
            'Extension_Developers_Guide',
            'Editors_(reST)',
            'QueryResult',
            'Add_your_own_favicon',
            'TypoScript_Constants',
            'Multidomain',
            'Performance_tuning',
            'Deprecation_Log',
            'Opcode_Cache',
            'How_to_uninstall_extensions',
            'Extension_Development,_Debugging',
            'TypoScript_language_additions,_override',
            'GraphicsMagick',
            'UTF-8_support',
            'Core_Team',
            'TYPO3-Docker',
            'Restart_your_webserver',
            'MySQL_configuration',
            'Faq/copy_parts_of_a_running_TYPO3_system_to_another_server',
            'TYPO3_Installation_on_Ubuntu',
            'Content_Slide',
            'Enhanced_Lazy_Loading',
            'Documentation_Process_-_Problems_and_Resolutions',
            'Protect_from_spam',
            'Breadcrumb_menu',
            'Realurl/manual',
            'Backup',
            'Php.ini',
            'Inline_Relational_Record_Editing_1:n',
            'Frontend_editing',
            'Windows',
            'TypoScript_-_PHP_Interaction',
            'Unit_Testing_TYPO3',
            'T3Doc/Fluidtemplate_by_example',
            'Image_Processing',
            'Inline_Relational_Record_Editing',
            'Check_Basic_Configuration',
            'Translations',
            'ReST_Syntax',
            'GIFBUILDER',
            'INCLUDE_TYPOSCRIPT',
            'Slack',
            'Felogin',
            'Symlinks_on_Windows',
            'Chown_and_Chmod',
            'Extension_Development,_add_static_extension_templates',
            'Online_shop',
            'PostgreSQL',
            'XCLASS',
            'FAL_Adapters',
            'Introduction_Package',
            'FAQ/Cached_files_in_typo3temp/',
            'Linux_cheat_sheet',
            'T3BOARD20EU',
            'Templates_&_Navigation',
            'Cooluri',
            'Translated_validation_error_messages_for_Fluid',
            'FLUIDTEMPLATE_Content_Object',
            'Efficiently_Debugging_TYPO3',
            'TYPO3.ElasticSearch',
            'Indexed_search',
            'Extension_Development,_using_POST_Forms',
            'Search_extensions',
            'TypoScript_Templates',
            'Overview_Developer_Manuals',
            'Alternative_Language',
            'External_links',
            'Tt_products',
            'How_to_delete_extensions',
            'Line_breaks',
            'Debian',
            'TS/CSS:_Typo3_TypoScript_Setup',
            'TYPO3_7.6_Extension_Migration_Guide',
            'Mssql',
            'Backend_user_group_permission_system',
            'My_first_TYPO3_site',
            'Alt_text_for_images',
            'Extension_Development,_add_Page_TSconfig,_User_TSconfig_and_TS',
            'TypoScript_Header_Image',
            'Apache2_TYPO3_WebDAV',
            'Backend_Programming',
            'Extension_Development,_add_Scheduler_Task',
            'Update_Git_Submodule_Pointer',
            'Skip_default_arguments_in_URIs',
            'Crawler',
            'Extension_Development',
            'TYPO3Wiki:About',
            'Overview_Administrator_Manuals',
            'Links_in_same_windows',
            'Rendering_trees_with_Extbase_and_Fluid',
            'TYPO3_Installation_Basics',
            'Additional_columns_in_WEB-Page_Module',
            'Blueprints/StructuredContentContainers',
            'PHP_Editors_/_IDE_for_TYPO3',
            'Pagetree',
            'RFC_Structure',
            'TYPO3_6.0_Extension_Migration_Tips',
            'Tt_products_marker',
            'Extbase_und_Fluid_FAQ',
            'Rootline',
            'TYPO3Wiki:General_disclaimer',
            'EXT/vimeovideo',
            'TS/CSS:_Typo3_Template_Setup',
            'Adding_fields_to_sr_feuser_register_registration_form',
            'Overview_Miscellaneous',
            'ChangeLog',
            'Content_Rendering_Schemes',
            'Tt_news/configuration',
            'MVC_Framework',
            'Security',
            'Hook_programming',
            'EXT/advancedtitle',
            'Tables',
            'Tt_products_tutorial',
            'Accessibility',
            'Configurable_Plugin_Namespaces',
            'DocumentationTeam',
            'FAQ/Reset_front_end_session',
            'Inline_Relational_Record_Editing_Attributes',
            'TYPO3Wiki:Users',
            'Overview_User_Manuals',
            'LanguageLabels',
            'Page_Header_with_Gifbuilder',
            'Gerrit_Review_Workflow',
            'Extbase/ViewHelper',
            'ComposerClassLoader',
            'Unique_fields',
            'Grunt_Bower',
            'ExtDirect',
            'Oracle',
            'Sandbox',
            'Tutorial/Sample_TypoScript_Setup',
            'Direct_mail',
            'New_reST_Project_with_Sphinx',
            'T3lib_http_Request',
            'Breaking_Changes',
            'ReST',
            'Ext/PDF_Generator_2',
            'Using_the_PHPUnit_extension_for_TYPO3_CMS_in_PhpStorm',
            'TemplaVoila',
            'TYPO3Wiki:Privacy_policy',
            'Dd_googlesitemap',
            'Extension_Development,_using_HTML-Templates',
            'Codeeditor',
            'Document_Matrix',
            'Blueprints/BackendRouting',
            'Running_with_TypoScript_and_CSS',
            'TYPO3_and_Moodle',
            'Caching_framework',
            'Sr_feuser_register',
            'Tt_news',
            'TYPO3_and_Magento',
            'Formidable',
            'TUG-Switzerland',
            'What_is_needed_to_run_TYPO3',
            'Calendar',
            'FAQ',
            'Iis7',
            'Ja:TYPO3_Tutorial_for_Editors',
            'TYPO3_and_Prestashop',
            'Doc_template',
            'Talk:Blueprints/ContentElementDefinitions',
            'Rendering_reST_on_Windows',
            'Blueprints/Logging',
            'OpenSearch',
            'T3Doc/Extension_Builder/Using_the_Extension_Builder',
            'WebDAV',
            'TemplaVoila/FCE',
            'Blueprints/DistributionManagement',
            'Distributions',
            'Modify_$TCA',
            'T3Bot',
            'Extending_typo3_tables',
            'Operating_System',
            'Responsive_Image_Rendering',
            'Transition_Days/Berlin_Manifesto',
            'TS/CSS:_Typo3_TypoScript_Constants',
            'WikiMigration',
            'Backend_Programming,_using_treeview',
            'Delete_Extensions',
            'Faq/Meta_Tags',
            'Translation',
            'Backend_Modules',
            'Documentation_changes_in_4.4_and_4.5',
            'Extension_Development_page_types',
            'FAQ/T3X_files',
            'How_to_build_GraphicsMagick_RPM_package',
            'T3Doc/Extension_Builder',
            'TS/CSS:_HTML_Template',
            'Enhanced_TypoScript_editing_with_the_jEdit_editor',
            'OverviewOfWiki',
            'Commerce',
            'Formidable_documentation',
            'EXT/Rating_AX',
            'Compatible_Licenses',
            'Ext/CSV_User_Import',
            'Static_File_Edit',
            'Boilerplate_extension',
            'Eclipse_Integration',
            'FluidSyntax',
            'Rte_htmlarea',
            'Extension_Development,_add_a_startingpoint',
            'Extension_Development,_add_user_TSConfig',
            'FAQ/How_to_create_a_TYPO3_package',
            'Accessible_menu',
            'Image_slider',
            'CWT',
            'Form_Wizard_for_TYPO3_4.2',
            'Human-Computer-Interaction',
            'Object_Persistence_Framework',
            'Webspace_vs._Webserver',
            'TemplaVoila/VideoTutorial/Overview_with_Image_and_Text',
            'TYPO3_and_Wordpress',
        ];
    }
}