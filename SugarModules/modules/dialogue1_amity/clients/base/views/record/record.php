<?php
$module_name = 'dialogue1_amity';
$viewdefs[$module_name] = array(
    'base' => array(
        'view' => array(
            'record' => array(
                'buttons' => array(
                    array(
                        'type' => 'button',
                        'name' => 'cancel_button',
                        'label' => 'LBL_CANCEL_BUTTON_LABEL',
                        'css_class' => 'btn-invisible btn-link',
                        'showOn' => 'edit',
                        'events' => array(
                            'click' => 'button:cancel_button:click',
                        ),
                    ),
                    array(
                        'type' => 'rowaction',
                        'event' => 'button:save_button:click',
                        'name' => 'save_button',
                        'label' => 'LBL_SAVE_BUTTON_LABEL',
                        'css_class' => 'btn btn-primary',
                        'showOn' => 'edit',
                        'acl_action' => 'edit',
                    ),
                    array(
                        'type' => 'actiondropdown',
                        'name' => 'main_dropdown',
                        'primary' => true,
                        'showOn' => 'view',
                        'buttons' => array(
                            array(
                                'type' => 'rowaction',
                                'event' => 'button:edit_button:click',
                                'name' => 'edit_button',
                                'label' => 'LBL_EDIT_BUTTON_LABEL',
                                'acl_action' => 'edit',
                            ),
                            array(
                                'type' => 'divider',
                            ),
                            array(
                                'type' => 'rowaction',
                                'event' => 'button:delete_button:click',
                                'name' => 'delete_button',
                                'label' => 'LBL_DELETE_BUTTON_LABEL',
                                'acl_action' => 'delete',
                            ),
                        ),
                    ),
                ),
                'panels' => array(
                    array(
                        'name' => 'panel_header',
                        'label' => 'LBL_RECORD_HEADER',
                        'header' => true,
                        'fields' => array(),
                    ),
                    array(
                        'newTab' => false,
                        'panelDefault' => 'expanded',
                        'name' => 'LBL_RECORD_HEADER',
                        'label' => 'LBL_RECORD_HEADER',
                        'columns' => 2,
                        'labelsOnTop' => 1,
                        'placeholders' => 1,
                        'fields' => array(
                            array(
                                'name' => 'domain',
                                'label' => 'LBL_DOMAIN',
                            ),
                            array(),
                            array(
                                'name' => 'tenant_id',
                                'label' => 'LBL_TENANT_ID',
                            ),
                            array(),
                            array(
                                'name' => 'api_key',
                                'label' => 'LBL_API_KEY',
                            ),
                        ),
                    ),
                ),
                'templateMeta' => array(
                    'useTabs' => false,
                ),
            ),
        ),
    ),
);
