<?php

class AmityDomainFormatter
{
    public function getUriFromDomain($domain)
    {
        $domain = $this->removeLastSlash($domain);

        return $this->removeProtocol($domain);
    }

    private function removeLastSlash($domain)
    {
        if ($domain[strlen($domain) - 1] === '/') {
            return substr($domain, 0, -1);
        }

        return $domain;
    }

    private function removeProtocol($domain)
    {
        return str_replace(array('https://', 'http://'), '', $domain);
    }
}