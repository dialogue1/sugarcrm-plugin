<?php

require_once 'AmitySyncDataApiGateway.php';
require_once 'modules/dialogue1_amity/clients/base/amityModuleDbBroker/AmityCredentialsDbBroker.php';
require_once 'modules/dialogue1_amity/clients/base/interactors/AmityDomainFormatter.php';
require 'modules/dialogue1_amity/vendor/autoload.php';

class AmityDataTransferer implements AmitySyncDataApiGateway
{
    private $apiClient;
    private $listService;
    private $contactService;
    private $contactListService;
    private $amityDomainFormatter;

    public function __construct()
    {
        $credentials = AmityCredentialsDbBroker::getInstance()->getAmityCredentials();
        $this->amityDomainFormatter = new AmityDomainFormatter();
        $this->apiClient = dialogue1\amity\API\Client::create(
            $this->amityDomainFormatter->getUriFromDomain($credentials['domain']),
            true,
            $credentials['tenant_id'],
            $credentials['api_key']
        );
        $this->listService = $this->apiClient->getListService();
        $this->contactService = $this->apiClient->getContactService();
        $this->contactListService = $this->apiClient->getContactListService();
    }

    /**
     * Creates new list. If the list already exists it is deleted and then created again.
     *
     * @param $listName
     *
     * @return mixed
     * @throws SugarApiException
     */
    public function createAmityList($listName)
    {
        $response = null;
        try {
            $response = $this->createListAndFetchId($listName);

        } catch (Exception $e) {
        }

        $this->handleErrorInCreatingList($response, $listName);

        return $response;
    }

    private function handleErrorInCreatingList($response, $listName)
    {
        if (empty($response)) {
            $GLOBALS['log']->error($listName . ' can not be created');
            throw new SugarApiException('List ' . $listName .' could not be created');
        }
    }

    private function createListAndFetchId($listName)
    {
        $existingAmityLists = $this->getAllAmityLists();
        $listIdOnAmity = $this->findListAmongExistingAmityLists($listName, $existingAmityLists);
        $this->deleteListOnAmity($listIdOnAmity);
        
        return $this->createNewList($listName);
    }

    private function getAllAmityLists()
    {
        $response = $this->listService->getAll();
        return !empty($response) ? $response : array();
    }

    private function findListAmongExistingAmityLists($needleListName, $existingAmityLists)
    {
        foreach ($existingAmityLists as $list) {
            if (strtolower($list['label']) === strtolower($needleListName)) {
                return $list['id'];
            }
        }

        return null;
    }

    private function deleteListOnAmity($listIdOnAmity)
    {
        if ($listIdOnAmity !== null) {
            $this->listService->delete($listIdOnAmity);
        }
    }

    private function createNewList($listName)
    {
        $response = $this->listService->create($listName);

        return !empty($response['id']) ? $response['id'] : null;
    }

    /**
     * Adds contacts to the newly created list.
     *
     * @param $contacts
     * @param $listIdForContacts
     *
     * @throws SugarApiExceptionError
     */
    public function addContactsToList($contacts, $listIdForContacts)
    {
        foreach ($contacts as $contact) {
            $this->sendAndLinkContactWithProperList($contact, $listIdForContacts);
        }
    }

    private function sendAndLinkContactWithProperList($contact, $listIdForContacts)
    {
        $response = null;
        try {
            $response = $this->sendContactsDataToAmity($contact, $listIdForContacts);
        } catch (Exception $e) {
        }

        $this->logErrorForFailedContactSync($response, $contact, $listIdForContacts);
    }

    private function sendContactsDataToAmity($contact, $listIdForContacts)
    {
        $existingContacts = $this->contactService->getMany(null, null, $contact['email']);

        if (!empty($existingContacts[0]['id'])) {
            $this->updateContact($existingContacts[0]['id'], $contact);
            return $this->setContactToProperAmityList($existingContacts[0], $listIdForContacts);
        }

        return $this->contactService->create($contact, array($listIdForContacts));
    }

    private function updateContact($contactIdOnAmity, $newContact)
    {
        $response = null;
        try {
            $response = $this->contactService->update($contactIdOnAmity, $newContact);
        } catch (Exception $e) {
        }

        $this->logErrorForFailedContactUpdate($response, $contactIdOnAmity);
    }

    private function logErrorForFailedContactUpdate($response, $contactIdOnAmity)
    {
        if (empty($response)) {
            $GLOBALS['log']->error('Contact' . $contactIdOnAmity  . ' can not be updated.');
        }
    }

    private function setContactToProperAmityList($existingContact, $listIdForContacts)
    {
        return $this->contactListService->addContactToList($existingContact['id'], $listIdForContacts);
    }

    private function logErrorForFailedContactSync($response, $contact, $listIdForContacts)
    {
        if (empty($response)) {
            $GLOBALS['log']->error($contact['email'] . ' can not be added to list ' . $listIdForContacts);
        }
    }
}
