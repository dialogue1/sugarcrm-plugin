<?php

class SugarAuthorization
{
    /**
     * System checking extracted to method (Code copied from sugar authentication mechanism)
     * 
     * @param $module
     * @throws SugarApiExceptionNotAuthorized
     */
    public static function checkIfUserIsAuthorizedForExport($module)
    {
        $seed = BeanFactory::newBean($module);

        if (!$seed->ACLAccess('export')) {
            throw new SugarApiExceptionNotAuthorized($GLOBALS['app_strings']['ERR_EXPORT_DISABLED']);
        }
        
        global $sugar_config;
        global $current_user;

        $theModule = clean_string($module);

        if (
            $sugar_config['disable_export'] ||
            (
                !empty($sugar_config['admin_export_only']) &&
                !(is_admin($current_user) ||
                    (
                        ACLController::moduleSupportsACL($theModule) && ACLAction::getUserAccessLevel(
                            $current_user->id,
                            $theModule,
                            'access'
                        ) == ACL_ALLOW_ENABLED &&
                        (ACLAction::getUserAccessLevel($current_user->id, $theModule, 'admin') == ACL_ALLOW_ADMIN ||
                            ACLAction::getUserAccessLevel(
                                $current_user->id,
                                $theModule,
                                'admin'
                            ) == ACL_ALLOW_ADMIN_DEV
                        )
                    )
                )
            )
        ) {
            throw new SugarApiExceptionNotAuthorized($GLOBALS['app_strings']['ERR_EXPORT_DISABLED']);
        }
    }
}