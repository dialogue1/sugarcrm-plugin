<?php
interface AmityConnectionApiGateway
{
    public function connect($apiKey, $tenantId, $domain);
}