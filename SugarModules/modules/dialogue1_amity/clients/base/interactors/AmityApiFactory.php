<?php
require_once 'AmityConnector.php';
require_once 'modules/dialogue1_amity/clients/base/interactors/AmityDataTransferer.php';

class AmityApiFactory
{
    public function makeConnector()
    {
        return new AmityConnector();
    }

    public function makeAmityDataTransferer()
    {
        return new AmityDataTransferer();
    }
}