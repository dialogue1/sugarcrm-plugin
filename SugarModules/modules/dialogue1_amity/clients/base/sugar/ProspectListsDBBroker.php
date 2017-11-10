<?php
require_once 'modules/dialogue1_amity/clients/base/sugar/SugarAuthorization.php';
require_once 'modules/ProspectLists/ProspectList.php';

class ProspectListsDBBroker
{
    private $listId;

    /**
     * Gets stored prospect(target) list members from Sugar.
     * 
     * @param $module
     * @param $listId
     * @return array
     * @throws SugarApiExceptionNotAuthorized
     */
    public function getProspectListMembers($module, $listId) 
    {
        $this->listId = $listId;

        SugarAuthorization::checkIfUserIsAuthorizedForExport($module);

        return $this->fetchMembersOfTargetList();
    }

    private function fetchMembersOfTargetList()
    {
        $db = DBManagerFactory::getInstance();
        $result = $db->query($this->prepareQueryForFetchingMembersOfList(), true);
        
        $members = array();
        $row = $db->fetchByAssoc($result);

        while (!empty($row)) {
            $members[] = $row;
            $row = $db->fetchByAssoc($result);
        }

        return $members;
    }

    private function prepareQueryForFetchingMembersOfList()
    {
        $prospectList = new ProspectList();
        return $prospectList->create_export_members_query("'" . $this->listId . "'");
    }

}