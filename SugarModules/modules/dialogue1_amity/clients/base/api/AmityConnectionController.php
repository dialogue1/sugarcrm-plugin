<?php

if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once 'include/api/SugarApiException.php';
require_once 'include/utils.php';
require_once 'modules/dialogue1_amity/clients/base/interactors/AmityConnectionApiGateway.php';
require_once 'modules/dialogue1_amity/clients/base/interactors/AmityApiFactory.php';
require_once 'modules/Administration/QuickRepairAndRebuild.php';

class AmityConnectionController
{
    /**
     * @var AmityConnectionApiGateway
     */
    private $amityConnector;

    public function __construct()
    {
        $amityApiFactory = new AmityApiFactory();
        $this->amityConnector = $amityApiFactory->makeConnector();
        $this->repairer = new RepairAndClear();
    }

    /**
     * Connects to amity if credentials are good. If not throw an exception that will be also http response.
     *
     * @param $bean
     * @throws SugarApiExceptionInvalidParameter
     */
    public function connect($bean)
    {
        try {
            $this->amityConnector->connect($bean->api_key, $bean->tenant_id, $bean->domain);

        } catch (Exception $e) {
            throw new SugarApiExceptionInvalidParameter(translate('ERR_AMITY_CONNECTION_CREDENTIALS', 'ProspectLists'));
        }
    }

    /**
     * Does repair and rebuild of the modules
     */
    public function repairAndRebuild()
    {
        $this->repairer->repairAndClearAll(array('clearAll'), array('All Modules'), false, false, '');
    }
}