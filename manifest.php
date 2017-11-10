<?php
/*
 * Your installation or use of this SugarCRM file is subject to the applicable
 * terms available at
 * http://support.sugarcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this SugarCRM file.
 *
 * Copyright (C) SugarCRM Inc. All rights reserved.
 */

$manifest = array(
    'key' => 'amity',
    'name' => 'amitySync',
    'description' => '',
    'version' => '1.0',
    'icon' => '',
    'author' => 'Logeecom',
    'readme' => include 'readme.php',
    'built_in_version' => '7.9.2.0',
    'acceptable_sugar_versions' => array(
        'regex_matches' => array(
            '7.7.*',
            '7.8.*',
            '7.9.*',
        ),
    ),
    'acceptable_sugar_flavors' => array('CE', 'PRO', 'ENT', 'ULT'),
    'is_uninstallable' => true,
    'published_date' => '2017-11-01',
    'type' => 'module',
    'remove_tables' => 'prompt',
);

$installdefs = array(
    'id' => 'dialogue1',
    'beans' => array(
        array(
            'module' => 'dialogue1_amity',
            'class' => 'dialogue1_amity',
            'path' => 'modules/dialogue1_amity/dialogue1_amity.php',
            'tab' => true,
        ),
    ),
    'layoutdefs' => array(),
    'relationships' => array(),
    'copy' => array(
        array(
            'from' => '<basepath>/SugarModules/modules/dialogue1_amity',
            'to' => 'modules/dialogue1_amity',
        ),
        array(
            'from' => '<basepath>/SugarModules/modules/override/recordlist/recordlist.js',
            'to' => 'modules/ProspectLists/clients/base/views/recordlist/recordlist.js',
        ),
        array(
            'from' => '<basepath>/SugarModules/modules/override/recordlist/recordlist.php',
            'to' => 'modules/ProspectLists/clients/base/views/recordlist/recordlist.php',
        ),
        array(
            'from' => '<basepath>/SugarModules/modules/override/customroutes/amityCustomRoutes.php',
            'to' => 'custom/Extension/application/Ext/JSGroupings/amityCustomRoutes.php',
        ),
        array(
            'from' => '<basepath>/SugarModules/modules/override/javascript/amityCustomRoutes.js',
            'to' => 'custom/javascript/amityCustomRoutes.js',
        ),
        array(
            'from' => '<basepath>/SugarModules/language/prospectLists/en_us.lang.php',
            'to' => 'custom/Extension/modules/ProspectLists/Ext/Language/en_us.lang.php',
        ),
        array(
            'from' => '<basepath>/SugarModules/language/prospectLists/de_DE.lang.php',
            'to' => 'custom/Extension/modules/ProspectLists/Ext/Language/de_DE.lang.php',
        ),
    ),
    'language' => array(
        array(
            'from' => '<basepath>/SugarModules/language/application/en_us.lang.php',
            'to_module' => 'application',
            'language' => 'en_us',
        ),
    ),
    'logic_hooks' => array(
        array(
            'module' => 'dialogue1_amity',
            'hook' => 'before_save',
            'order' => 1,
            'description' => 'before_save_amity_credentials',
            'file' => 'modules/dialogue1_amity/clients/base/api/AmityConnectionController.php',
            'class' => 'AmityConnectionController',
            'function' => 'connect',
        ),
        array(
            'module' => 'dialogue1_amity',
            'hook' => 'after_save',
            'order' => 1,
            'description' => 'after_save_amity_credentials',
            'file' => 'modules/dialogue1_amity/clients/base/api/AmityConnectionController.php',
            'class' => 'AmityConnectionController',
            'function' => 'repairAndRebuild',
        ),
        array(
            'module' => 'dialogue1_amity',
            'hook' => 'before_delete',
            'order' => 1,
            'description' => 'after_delete_amity_credentials',
            'file' => 'modules/dialogue1_amity/clients/base/api/AmityConnectionController.php',
            'class' => 'AmityConnectionController',
            'function' => 'repairAndRebuild',
        ),
    ),
);
