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

require_once 'modules/dialogue1_amity/clients/base/sugar/ProspectListsFactory.php';
require_once 'modules/dialogue1_amity/clients/base/interactors/DataTransformer.php';
require_once 'modules/dialogue1_amity/clients/base/interactors/AmitySyncDataApiGateway.php';
require_once 'modules/dialogue1_amity/clients/base/interactors/AmityApiFactory.php';

class ExportToAmityApi extends ModuleApi
{

    private $prospectListsFactory;
    private $dataTransformer;

    /**
     * @var AmitySyncDataApiGateway
     */
    private $amityDataTransferor;

    public function __construct()
    {
        $this->prospectListsFactory = new ProspectListsFactory();
        $this->dataTransformer = new DataTransformer();
        $amitySyncDataFactory = new AmityApiFactory();
        $this->amityDataTransferor = $amitySyncDataFactory->makeAmityDataTransferer();
    }

    /**
     * Registers new REST API endpoint
     * 
     * @return array
     */
    public function registerApiRest()
    {
        return array(
            'export_to_amity' => array(
                'reqType' => 'POST',
                'path' => array('ExportToAmityApi', 'export'),
                'pathVars' => array('', ''),
                'method' => 'export',
                'shortHelp' => 'This method is used for exporting Prospect Lists from Sugar to amity',
            ),
        );
    }

    /**
     * Exports target lists contacts from Sugar to amity.
     * 
     * @param ServiceBase $api
     * @param array $args
     * 
     * @return array
     * @throws SugarApiException
     */
    public function export(ServiceBase $api, array $args)
    {
        try {
            return $this->makeNewAmityListAndTransferContacts($args);
        } catch (Exception $e) {
            throw new SugarApiException('Export failed!');
        }
    }
    
    private function makeNewAmityListAndTransferContacts($args)
    {
        $prospectListsDbBroker = $this->prospectListsFactory->makeProspectListsDBBroker();
        $members = $prospectListsDbBroker->getProspectListMembers($args['module'], $args['listId']);
        $createdListId = $this->amityDataTransferor->createAmityList($args['listName']);
        $formattedMembers = $this->dataTransformer->transformMembersFromSugarToAmity($members);
        $this->amityDataTransferor->addContactsToList($formattedMembers, $createdListId);

        return array('status' => 200);
    }
}

