<?php

interface AmitySyncDataApiGateway
{
    public function createAmityList($listName);
    
    public function addContactsToList($contacts, $listIdForContacts);
}