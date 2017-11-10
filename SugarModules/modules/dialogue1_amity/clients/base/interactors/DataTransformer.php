<?php

class DataTransformer
{
    /**
     * Transforms Sugar format of members that needs to be synchronized to amity format.
     * @param $sugarMembers
     * @return array
     */
    public function transformMembersFromSugarToAmity($sugarMembers)
    {
        $amityMembers = array();

        foreach ($sugarMembers as $sugarMember) {
            if (empty($sugarMember['primary_email_address'])) {
                continue;
            }

            $formattedAmityMember = array(
                'gender' => $this->getGenderBasedOnSalutation($sugarMember['salutation']),
                'name1' => $sugarMember['last_name'],
                'name2' => $sugarMember['first_name'],
                'email' => $sugarMember['primary_email_address'],
            );

            $amityMembers[] = $formattedAmityMember;
        }
        
        return $amityMembers;
    }

    private function getGenderBasedOnSalutation($salutation)
    {
        $lowerCaseSalutation = strtolower($salutation);

        if ($lowerCaseSalutation === 'mr.') {
            return 'M';
        }

        if ($lowerCaseSalutation === 'mrs.' || $lowerCaseSalutation === 'ms.') {
            return 'F';
        }
        
        return 'X';
    }
}