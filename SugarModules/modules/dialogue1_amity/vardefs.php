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

$dictionary['dialogue1_amity'] = array(
    'table' => 'dialogue1_amity',
    'audited' => true,
    'activity_enabled' => false,
    'duplicate_merge' => true,
    'fields' => array(
        'api_key' => array(
            'required' => true,
            'name' => 'api_key',
            'vname' => 'LBL_API_KEY',
            'type' => 'varchar',
            'massupdate' => false,
            'no_default' => false,
            'comments' => '',
            'help' => '',
            'importable' => 'false',
            'duplicate_merge' => 'disabled',
            'duplicate_merge_dom_value' => '0',
            'audited' => false,
            'reportable' => false,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'default' => '',
            'full_text_search' =>
                array(
                    'enabled' => '0',
                    'boost' => '1',
                    'searchable' => false,
                ),
            'calculated' => false,
            'len' => '255',
            'size' => '20',
        ),
        'tenant_id' => array(
            'required' => true,
            'name' => 'tenant_id',
            'vname' => 'LBL_TENANT_ID',
            'type' => 'varchar',
            'massupdate' => false,
            'no_default' => false,
            'comments' => '',
            'help' => '',
            'importable' => 'false',
            'duplicate_merge' => 'disabled',
            'duplicate_merge_dom_value' => '0',
            'audited' => false,
            'reportable' => false,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'default' => '',
            'full_text_search' =>
                array(
                    'enabled' => '0',
                    'boost' => '1',
                    'searchable' => false,
                ),
            'calculated' => false,
            'len' => '255',
            'size' => '20',
        ),
        'domain' => array(
            'required' => true,
            'name' => 'domain',
            'vname' => 'LBL_DOMAIN',
            'type' => 'varchar',
            'massupdate' => false,
            'no_default' => false,
            'comments' => '',
            'help' => '',
            'importable' => 'false',
            'duplicate_merge' => 'disabled',
            'duplicate_merge_dom_value' => '0',
            'audited' => false,
            'reportable' => false,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'default' => '',
            'full_text_search' =>
                array(
                    'enabled' => '0',
                    'boost' => '1',
                    'searchable' => false,
                ),
            'calculated' => false,
            'len' => '255',
            'size' => '20',
        ),
    ),
    'relationships' => array(),
    'optimistic_locking' => true,
    'unified_search' => true,
    'full_text_search' => true,
);

if (!class_exists('VardefManager')) {
}
VardefManager::createVardef(
    'dialogue1_amity',
    'dialogue1_amity',
    array('basic', 'team_security', 'assignable', 'taggable')
);