<?php

require_once 'AmityConnectionApiGateway.php';
require_once 'modules/dialogue1_amity/clients/base/interactors/AmityDomainFormatter.php';
require 'modules/dialogue1_amity/vendor/autoload.php';

class AmityConnector implements AmityConnectionApiGateway
{
    private $amityDomainFormatter;

    public function __construct()
    {
        $this->amityDomainFormatter = new AmityDomainFormatter();
    }

    /**
     * Connects user to amity. If passed values pass authentication with amity, user is connected.
     *
     * @param $apiKey
     * @param $tenantId
     * @param $domain
     * @return mixed
     * @throws SugarApiExceptionInvalidParameter
     */
    public function connect($apiKey, $tenantId, $domain)
    {
        $apiClient = dialogue1\amity\API\Client::create(
            $this->amityDomainFormatter->getUriFromDomain($domain),
            true,
            $tenantId,
            $apiKey
        );

        $response = $apiClient->getContactService()->getMany();

        if (!$this->responseIsValid($response)) {
            throw new SugarApiExceptionInvalidParameter();
        }

        return $response;
    }

    private function responseIsValid($response)
    {
        $codeForSuccessfulRequest = 200;

        return !empty($response) ||
        (!empty($response['status']) && $response['status'] === $codeForSuccessfulRequest);
    }
}