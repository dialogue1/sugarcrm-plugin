<?php

class AmityCredentialsDbBroker {
    
    private static $dbBrokerInstance = null;

    public static function getInstance() 
    {
        if (self::$dbBrokerInstance === null) {
            self::$dbBrokerInstance = new AmityCredentialsDbBroker();
        }

        return self::$dbBrokerInstance;
    }

    private function __construct() {
        
    }

    /**
     * Gets saved amity credentials for connecting to amity.
     *
     * @return array|mixed
     */
    public function getAmityCredentials() 
    {
        global $current_user;
        $moduleName = 'dialogue1_amity';
        $amityBean =  BeanFactory::getBean($moduleName);
        if (!$amityBean || empty($current_user->id)) {
            return array();
        }

        $query = sprintf('SELECT * FROM %s WHERE assigned_user_id = %s AND deleted <> 1', $moduleName, $current_user->id);
        $result = $amityBean->db->query($query, true, 'Error reading configurations');
        
        return $amityBean->db->fetchByAssoc($result);
    }
}