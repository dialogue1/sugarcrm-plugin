<?php
$module_name = 'dialogue1_amity';
$viewdefs[$module_name] = array(
    'base' => array(
        'view' => array(
            'list' => array(
                'panels' => array(
                    array(
                        'label' => 'LBL_PANEL_1',
                        'fields' => array(
                            array(
                                'name' => 'domain',
                                'label' => 'LBL_DOMAIN',
                                'enabled' => true,
                                'default' => true,
                            ),
                            array(
                                'name' => 'tenant_id',
                                'label' => 'LBL_TENANT_ID',
                                'enabled' => true,
                                'default' => true,
                            ),
                            array(
                                'name' => 'api_key',
                                'label' => 'LBL_API_KEY',
                                'enabled' => true,
                                'default' => true,
                            ),
                        ),
                    ),
                ),
                'orderBy' => array(
                    'field' => 'date_modified',
                    'direction' => 'desc',
                ),
            ),
        ),
    ),
);
