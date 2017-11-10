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
require_once 'modules/dialogue1_amity/clients/base/amityModuleDbBroker/AmityCredentialsDbBroker.php';

$viewdefs['ProspectLists']['base']['view']['recordlist'] = array(
    'rowactions' => array(
        'actions' => array(
            array(
                'type' => 'rowaction',
                'css_class' => 'btn',
                'tooltip' => 'LBL_PREVIEW',
                'event' => 'list:preview:fire',
                'icon' => 'fa-eye',
                'acl_action' => 'view',
            ),
            array(
                'type' => 'rowaction',
                'name' => 'edit_button',
                'label' => 'LBL_EDIT_BUTTON',
                'event' => 'list:editrow:fire',
                'acl_action' => 'edit',
            ),
            array(
                'type' => 'rowaction',
                'name' => 'delete_button',
                'event' => 'list:deleterow:fire',
                'label' => 'LBL_DELETE_BUTTON',
                'acl_action' => 'delete',
            )
        ),
    ),
    'last_state' => array(
        'id' => 'record-list',
    ),
);

$credentials = AmityCredentialsDbBroker::getInstance()->getAmityCredentials();

if (!empty($credentials['api_key'])) {
    $viewdefs['ProspectLists']['base']['view']['recordlist']['rowactions']['actions'][] = array(
        'type' => 'rowaction',
        'event' => 'button:export_to_amity:click',
        'name' => 'export_to_amity',
        'label' => 'LBL_EXPORT_TO_AMITY_BUTTON_LABEL',
        'acl_action' => 'export_to_amity',
    );
}
