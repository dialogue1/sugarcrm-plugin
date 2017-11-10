<?php

require_once 'modules/dialogue1_amity/clients/base/sugar/ProspectListsDBBroker.php';

class ProspectListsFactory
{
    public function makeProspectListsDBBroker() {
        return new ProspectListsDBBroker();
    }
}