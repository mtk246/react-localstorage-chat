<?php

declare(strict_types=1);

use App\Enums\Claim\RuleType;

return [
    'controlNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim control number',
        'value' => [
            'id' => 'claim:controlNumber',
            'name' => 'Claim control number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:controlNumber',
                    'name' => 'Claim control number',
                ],
            ],
        ],
    ],
    'tradingPartnerServiceId' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim trading partner service id',
        'value' => [
            'id' => 'claim:tradingPartnerServiceId',
            'name' => 'Claim trading partner service id',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:tradingPartnerServiceId',
                    'name' => 'Claim trading partner service id',
                ],
            ],
        ],
    ],
    'tradingPartnerName' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim trading partner service id',
        'value' => [
            'id' => 'claim:tradingPartnerName',
            'name' => 'Claim trading partner service id',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:tradingPartnerName',
                    'name' => 'Claim trading partner service id',
                ],
            ],
        ],
    ],
    'usageIndicator' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim usage indicator',
        'value' => [
            'id' => 'claim:usageIndicator',
            'name' => 'Claim usage indicator',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:usageIndicator',
                    'name' => 'Claim usage indicator',
                ],
            ],
        ],
    ],
    'submitter.organizationName' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Organization name',
        'value' => [
            'id' => 'claim:submitter.organizationName',
            'name' => 'Submitter organization name',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:submitter.organizationName',
                    'name' => 'Submitter organization name',
                ],
            ],
        ],
    ],
    'submitter.taxId' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Submitter taxId',
        'value' => [
            'id' => 'claim:submitter.taxId',
            'name' => 'Submitter taxId',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:submitter.taxId',
                    'name' => 'Submitter taxId',
                ],
            ],
        ],
    ],
    'submitter.lastName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Submitter last name',
        'value' => [],
        'values' => [],
    ],
    'submitter.firstName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Submitter first name',
        'value' => [],
        'values' => [],
    ],
    'submitter.middleName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Submitter middle name',
        'value' => [],
        'values' => [],
    ],
    'submitter.contactInformation.name' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Submitter contact information name',
        'value' => [
            'id' => 'claim:submitter.contactInformation.name',
            'name' => 'Submitter contact information name',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:submitter.contactInformation.name',
                    'name' => 'Submitter contact information name',
                ],
            ],
        ],
    ],
    'submitter.contactInformation.phoneNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Submitter contact information phone number',
        'value' => [
            'id' => 'claim:submitter.contactInformation.phoneNumber',
            'name' => 'Submitter contact information phone number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:submitter.contactInformation.phoneNumber',
                    'name' => 'Submitter contact information phone number',
                ],
            ],
        ],
    ],
    'submitter.contactInformation.faxNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Submitter contact information fax number',
        'value' => [
            'id' => 'claim:submitter.contactInformation.faxNumber',
            'name' => 'Submitter contact information fax number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:submitter.contactInformation.faxNumber',
                    'name' => 'Submitter contact information fax number',
                ],
            ],
        ],
    ],
    'submitter.contactInformation.email' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Submitter contact information email',
        'value' => [
            'id' => 'claim:submitter.contactInformation.email',
            'name' => 'Submitter contact information email',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:submitter.contactInformation.email',
                    'name' => 'Submitter contact information email',
                ],
            ],
        ],
    ],
    'submitter.contactInformation.phoneExtension' => [
        'type' => RuleType::NONE->value,
        'description' => 'Submitter contact information phone extension',
        'value' => [],
        'values' => [],
    ],
    'submitter.contactInformation.validContact' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Submitter contact information valid',
        'value' => [
            'id' => 'claim:submitter.contactInformation.validContact',
            'name' => 'Submitter contact information valid',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:submitter.contactInformation.validContact',
                    'name' => 'Submitter contact information valid',
                ],
            ],
        ],
    ],
    'receiver.organizationName' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Receiver organization name',
        'value' => [
            'id' => 'claim:receiver.organizationName',
            'name' => 'Receiver organization name',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:receiver.organizationName',
                    'name' => 'Receiver organization name',
                ],
            ],
        ],
    ],
    'receiver.taxId' => [
        'type' => RuleType::NONE->value,
        'description' => 'Receiver taxId',
        'value' => [],
        'values' => [],
    ],
    'subscriber.memberId' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Subscriber member ID',
        'value' => [
            'id' => 'claim:subscriber.memberId',
            'name' => 'Subscriber member ID',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:subscriber.memberId',
                    'name' => 'Subscriber member ID',
                ],
            ],
        ],
    ],
    'subscriber.standardHealthId' => [
        'type' => RuleType::NONE->value,
        'description' => 'Subscriber standard health id',
        'value' => [],
        'values' => [],
    ],
    'subscriber.ssn' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Subscriber ssn',
        'value' => [
            'id' => 'claim:subscriber.ssn',
            'name' => 'Subscriber ssn',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:subscriber.ssn',
                    'name' => 'Subscriber ssn',
                ],
            ],
        ],
    ],
    'subscriber.paymentResponsibilityLevelCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Subscriber payment responsibility level code',
        'value' => [
            'id' => 'claim:subscriber.paymentResponsibilityLevelCode',
            'name' => 'Subscriber payment responsibility level code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:subscriber.paymentResponsibilityLevelCode',
                    'name' => 'Subscriber payment responsibility level code',
                ],
            ],
        ],
    ],
    'subscriber.organizationName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Subscriber organization name',
        'value' => [],
        'values' => [],
    ],
    'subscriber.insuranceTypeCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Subscriber insurance type code',
        'value' => [],
        'values' => [],
    ],
    'subscriber.subscriberGroupName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Subscriber group name',
        'value' => [],
        'values' => [],
    ],
    'subscriber.firstName' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Subscriber first name',
        'value' => [
            'id' => 'claim:subscriber.firstName',
            'name' => 'Subscriber first name',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:subscriber.firstName',
                    'name' => 'Subscriber first name',
                ],
            ],
        ],
    ],
    'subscriber.lastName' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Subscriber last name',
        'value' => [
            'id' => 'claim:subscriber.lastName',
            'name' => 'Subscriber last name',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:subscriber.lastName',
                    'name' => 'Subscriber last name',
                ],
            ],
        ],
    ],
    'subscriber.middleName' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Subscriber middle name',
        'value' => [
            'id' => 'claim:subscriber.middleName',
            'name' => 'Subscriber middle name',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:subscriber.middleName',
                    'name' => 'Subscriber middle name',
                ],
            ],
        ],
    ],
    'subscriber.suffix' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Subscriber name suffix',
        'value' => [
            'id' => 'claim:subscriber.suffix',
            'name' => 'Subscriber name suffix',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:subscriber.suffix',
                    'name' => 'Subscriber name suffix',
                ],
            ],
        ],
    ],
    'subscriber.gender' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Subscriber gender',
        'value' => [
            'id' => 'claim:subscriber.gender',
            'name' => 'Subscriber gender',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:subscriber.gender',
                    'name' => 'Subscriber gender',
                ],
            ],
        ],
    ],
    'subscriber.dateOfBirth' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Subscriber date of birth',
        'value' => [
            'id' => 'claim:subscriber.dateOfBirth',
            'name' => 'Subscriber date of birth',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:subscriber.dateOfBirth',
                    'name' => 'Subscriber date of birth',
                ],
            ],
        ],
    ],
    'subscriber.policyNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Subscriber policy number',
        'value' => [
            'id' => 'claim:subscriber.policyNumber',
            'name' => 'Subscriber policy number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:subscriber.policyNumber',
                    'name' => 'Subscriber policy number',
                ],
            ],
        ],
    ],
    'subscriber.groupNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Subscriber group number',
        'value' => [],
        'values' => [],
    ],
    'subscriber.address.address1' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Subscriber contact information address1',
        'value' => [
            'id' => 'claim:subscriber.address.address1',
            'name' => 'Subscriber contact information address1',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:subscriber.address.address1',
                    'name' => 'Subscriber contact information address1',
                ],
            ],
        ],
    ],
    'subscriber.address.address2' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Subscriber contact information address2',
        'value' => [
            'id' => 'claim:subscriber.address.address2',
            'name' => 'Subscriber contact information address2',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:subscriber.address.address2',
                    'name' => 'Subscriber contact information address2',
                ],
            ],
        ],
    ],
    'subscriber.address.city' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Subscriber contact information city',
        'value' => [
            'id' => 'claim:subscriber.address.city',
            'name' => 'Subscriber contact information city',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:subscriber.address.city',
                    'name' => 'Subscriber contact information city',
                ],
            ],
        ],
    ],
    'subscriber.address.state' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Subscriber contact information state',
        'value' => [
            'id' => 'claim:subscriber.address.state',
            'name' => 'Subscriber contact information state',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:subscriber.address.state',
                    'name' => 'Subscriber contact information state',
                ],
            ],
        ],
    ],
    'subscriber.address.postalCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Subscriber contact information postal code',
        'value' => [
            'id' => 'claim:subscriber.address.postalCode',
            'name' => 'Subscriber contact information postal code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:subscriber.address.postalCode',
                    'name' => 'Subscriber contact information postal code',
                ],
            ],
        ],
    ],
    'subscriber.address.countryCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Subscriber contact information country code',
        'value' => [
            'id' => 'claim:subscriber.address.countryCode',
            'name' => 'Subscriber contact information country code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:subscriber.address.countryCode',
                    'name' => 'Subscriber contact information country code',
                ],
            ],
        ],
    ],
    'subscriber.address.countrySubDivisionCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Subscriber contact information country subdivision code',
        'value' => [
            'id' => 'claim:subscriber.address.countrySubDivisionCode',
            'name' => 'Subscriber contact information country subdivision code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:subscriber.address.countrySubDivisionCode',
                    'name' => 'Subscriber contact information country subdivision code',
                ],
            ],
        ],
    ],
    'dependent.firstName' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Dependent first name',
        'value' => [
            'id' => 'claim:dependent.firstName',
            'name' => 'Dependent first name',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:dependent.firstName',
                    'name' => 'Dependent first name',
                ],
            ],
        ],
    ],
    'dependent.lastName' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Dependent last name',
        'value' => [
            'id' => 'claim:dependent.lastName',
            'name' => 'Dependent last name',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:dependent.lastName',
                    'name' => 'Dependent last name',
                ],
            ],
        ],
    ],
    'dependent.middleName' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Dependent middle name',
        'value' => [
            'id' => 'claim:dependent.middleName',
            'name' => 'Dependent middle name',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:dependent.middleName',
                    'name' => 'Dependent middle name',
                ],
            ],
        ],
    ],
    'dependent.suffix' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Dependent name suffix',
        'value' => [
            'id' => 'claim:dependent.suffix',
            'name' => 'Dependent name suffix',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:dependent.suffix',
                    'name' => 'Dependent name suffix',
                ],
            ],
        ],
    ],
    'dependent.gender' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Dependent gender',
        'value' => [
            'id' => 'claim:dependent.gender',
            'name' => 'Dependent gender',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:dependent.gender',
                    'name' => 'Dependent gender',
                ],
            ],
        ],
    ],
    'dependent.dateOfBirth' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Dependent date of birth',
        'value' => [
            'id' => 'claim:dependent.dateOfBirth',
            'name' => 'Dependent date of birth',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:dependent.dateOfBirth',
                    'name' => 'Dependent date of birth',
                ],
            ],
        ],
    ],
    'dependent.ssn' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Dependent ssn',
        'value' => [
            'id' => 'claim:dependent.ssn',
            'name' => 'Dependent ssn',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:dependent.ssn',
                    'name' => 'Dependent ssn',
                ],
            ],
        ],
    ],
    'dependent.memberId' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Dependent member id',
        'value' => [
            'id' => 'claim:dependent.memberId',
            'name' => 'Dependent member id',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:dependent.memberId',
                    'name' => 'Dependent member id',
                ],
            ],
        ],
    ],
    'dependent.relationshipToSubscriberCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Dependent relationship to subscriber code',
        'value' => [
            'id' => 'claim:dependent.relationshipToSubscriberCode',
            'name' => 'Dependent relationship to subscriber code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:dependent.relationshipToSubscriberCode',
                    'name' => 'Dependent relationship to subscriber code',
                ],
            ],
        ],
    ],
    'dependent.address.address1' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Dependent contact information address1',
        'value' => [
            'id' => 'claim:dependent.address.address1',
            'name' => 'Dependent contact information address1',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:dependent.address.address1',
                    'name' => 'Dependent contact information address1',
                ],
            ],
        ],
    ],
    'dependent.address.address2' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Dependent contact information address2',
        'value' => [
            'id' => 'claim:dependent.address.address2',
            'name' => 'Dependent contact information address2',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:dependent.address.address2',
                    'name' => 'Dependent contact information address2',
                ],
            ],
        ],
    ],
    'dependent.address.city' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Dependent contact information city',
        'value' => [
            'id' => 'claim:dependent.address.city',
            'name' => 'Dependent contact information city',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:dependent.address.city',
                    'name' => 'Dependent contact information city',
                ],
            ],
        ],
    ],
    'dependent.address.state' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Dependent contact information state',
        'value' => [
            'id' => 'claim:dependent.address.state',
            'name' => 'Dependent contact information state',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:dependent.address.state',
                    'name' => 'Dependent contact information state',
                ],
            ],
        ],
    ],
    'dependent.address.postalCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Dependent contact information postal code',
        'value' => [
            'id' => 'claim:dependent.address.postalCode',
            'name' => 'Dependent contact information postal code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:dependent.address.postalCode',
                    'name' => 'Dependent contact information postal code',
                ],
            ],
        ],
    ],
    'dependent.address.countryCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Dependent contact information country code',
        'value' => [
            'id' => 'claim:dependent.address.countryCode',
            'name' => 'Dependent contact information country code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:dependent.address.countryCode',
                    'name' => 'Dependent contact information country code',
                ],
            ],
        ],
    ],
    'dependent.address.countrySubDivisionCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Dependent contact information country subdivision code',
        'value' => [
            'id' => 'claim:dependent.address.countrySubDivisionCode',
            'name' => 'Dependent contact information country subdivision code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:dependent.address.countrySubDivisionCode',
                    'name' => 'Dependent contact information country subdivision code',
                ],
            ],
        ],
    ],
    'claimInformation.claimFilingCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information filing code',
        'value' => [
            'id' => 'claim:claimInformation.claimFilingCode',
            'name' => 'Claim information filing code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimFilingCode',
                    'name' => 'Claim information filing code',
                ],
            ],
        ],
    ],
    'claimInformation.patientControlNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information patient control number',
        'value' => [
            'id' => 'claim:claimInformation.patientControlNumber',
            'name' => 'Claim information patient control number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.patientControlNumber',
                    'name' => 'Claim information patient control number',
                ],
            ],
        ],
    ],
    'claimInformation.planParticipationCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information plan participation code',
        'value' => [
            'id' => 'claim:claimInformation.planParticipationCode',
            'name' => 'Claim information plan participation code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.planParticipationCode',
                    'name' => 'Claim information plan participation code',
                ],
            ],
        ],
    ],
    'claimInformation.benefitsAssignmentCertificationIndicator' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information benefits assignment certification indicator',
        'value' => [
            'id' => 'claim:claimInformation.benefitsAssignmentCertificationIndicator',
            'name' => 'Claim information benefits assignment certification indicator',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.benefitsAssignmentCertificationIndicator',
                    'name' => 'Claim information benefits assignment certification indicator',
                ],
            ],
        ],
    ],
    'claimInformation.releaseInformationCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information release information code',
        'value' => [
            'id' => 'claim:claimInformation.releaseInformationCode',
            'name' => 'Claim information release information code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.releaseInformationCode',
                    'name' => 'Claim information release information code',
                ],
            ],
        ],
    ],
    'claimInformation.claimDateInformation.admissionDateAndHour' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information admission date and hour',
        'value' => [
            'id' => 'claim:claimInformation.claimDateInformation.admissionDateAndHour',
            'name' => 'Claim information admission date and hour',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimDateInformation.admissionDateAndHour',
                    'name' => 'Claim information admission date and hour',
                ],
            ],
        ],
    ],
    'claimInformation.claimDateInformation.statementBeginDate' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information statement begin date',
        'value' => [
            'id' => 'claim:claimInformation.claimDateInformation.statementBeginDate',
            'name' => 'Claim information statement begin date',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimDateInformation.statementBeginDate',
                    'name' => 'Claim information statement begin date',
                ],
            ],
        ],
    ],
    'claimInformation.claimDateInformation.statementEndDate' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information statement end date',
        'value' => [
            'id' => 'claim:claimInformation.claimDateInformation.statementEndDate',
            'name' => 'Claim information statement end date',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimDateInformation.statementEndDate',
                    'name' => 'Claim information statement end date',
                ],
            ],
        ],
    ],
    'claimInformation.claimDateInformation.dischargeHour' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information discharge hour',
        'value' => [
            'id' => 'claim:claimInformation.claimDateInformation.dischargeHour',
            'name' => 'Claim information discharge hour',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimDateInformation.dischargeHour',
                    'name' => 'Claim information discharge hour',
                ],
            ],
        ],
    ],
    'claimInformation.claimDateInformation.repricerReceivedDate' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information repricer received date',
        'value' => [
            'id' => 'claim:claimInformation.claimDateInformation.repricerReceivedDate',
            'name' => 'Claim information repricer received date',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimDateInformation.repricerReceivedDate',
                    'name' => 'Claim information repricer received date',
                ],
            ],
        ],
    ],
    'claimInformation.claimSupplementalInformation.priorAuthorizationNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information supplemental prior authorization number',
        'value' => [
            'id' => 'claim:claimInformation.claimSupplementalInformation.priorAuthorizationNumber',
            'name' => 'Claim information supplemental prior authorization number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimSupplementalInformation.priorAuthorizationNumber',
                    'name' => 'Claim information supplemental prior authorization number',
                ],
            ],
        ],
    ],
    'claimInformation.claimSupplementalInformation.autoAccidentState' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information supplemental auto accident state',
        'value' => [
            'id' => 'claim:claimInformation.claimSupplementalInformation.autoAccidentState',
            'name' => 'Claim information supplemental auto accident state',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimSupplementalInformation.autoAccidentState',
                    'name' => 'Claim information supplemental auto accident state',
                ],
            ],
        ],
    ],
    'claimInformation.principalDiagnosis.qualifierCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information principal diagnosis qualifier code',
        'value' => [
            'id' => 'claim:claimInformation.principalDiagnosis.qualifierCode',
            'name' => 'Claim information principal diagnosis qualifier code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.principalDiagnosis.qualifierCode',
                    'name' => 'Claim information principal diagnosis qualifier code',
                ],
            ],
        ],
    ],
    'claimInformation.principalDiagnosis.principalDiagnosisCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information principal diagnosis code',
        'value' => [
            'id' => 'claim:claimInformation.principalDiagnosis.principalDiagnosisCode',
            'name' => 'Claim information principal diagnosis code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.principalDiagnosis.principalDiagnosisCode',
                    'name' => 'Claim information principal diagnosis code',
                ],
            ],
        ],
    ],
    'claimInformation.principalDiagnosis.presentOnAdmissionIndicator' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information principal diagnosis present on admission indicator',
        'value' => [
            'id' => 'claim:claimInformation.principalDiagnosis.presentOnAdmissionIndicator',
            'name' => 'Claim information principal diagnosis present on admission indicator',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.principalDiagnosis.presentOnAdmissionIndicator',
                    'name' => 'Claim information principal diagnosis present on admission indicator',
                ],
            ],
        ],
    ],
    'claimInformation.admittingDiagnosis.qualifierCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information admitting diagnosis qualifier code',
        'value' => [
            'id' => 'claim:claimInformation.admittingDiagnosis.qualifierCode',
            'name' => 'Claim information admitting diagnosis qualifier code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.admittingDiagnosis.qualifierCode',
                    'name' => 'Claim information admitting diagnosis qualifier code',
                ],
            ],
        ],
    ],
    'claimInformation.admittingDiagnosis.admittingDiagnosisCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information admitting diagnosis code',
        'value' => [
            'id' => 'claim:claimInformation.admittingDiagnosis.admittingDiagnosisCode',
            'name' => 'Claim information admitting diagnosis code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.admittingDiagnosis.admittingDiagnosisCode',
                    'name' => 'Claim information admitting diagnosis code',
                ],
            ],
        ],
    ],
    'claimInformation.diagnosisRelatedGroupInformation.drugRelatedGroupCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information diagnosis related group',
        'value' => [
            'id' => 'claim:claimInformation.diagnosisRelatedGroupInformation.drugRelatedGroupCode',
            'name' => 'Claim information diagnosis related group',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.diagnosisRelatedGroupInformation.drugRelatedGroupCode',
                    'name' => 'Claim information diagnosis related group',
                ],
            ],
        ],
    ],
    'claimInformation.otherDiagnosisInformationList' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information other diagnosis information list',
        'value' => [
            'id' => 'claim:claimInformation.otherDiagnosisInformationList',
            'name' => 'Claim information other diagnosis information list',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.otherDiagnosisInformationList',
                    'name' => 'Claim information other diagnosis information list',
                ],
            ],
        ],
    ],
    'claimInformation.valueInformationList' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim value information list',
        'value' => [
            'id' => 'claim:claimInformation.valueInformationList',
            'name' => 'Claim value information list',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.valueInformationList',
                    'name' => 'Claim value information list',
                ],
            ],
        ],
    ],
    'claimInformation.serviceFacilityLocation.organizationName' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information service facility organization name',
        'value' => [
            'id' => 'claim:claimInformation.serviceFacilityLocation.organizationName',
            'name' => 'Claim information service facility organization name',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceFacilityLocation.organizationName',
                    'name' => 'Claim information service facility organization name',
                ],
            ],
        ],
    ],
    'claimInformation.serviceFacilityLocation.address.address1' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information service facility address1',
        'value' => [
            'id' => 'claim:claimInformation.serviceFacilityLocation.address.address1',
            'name' => 'Claim information service facility address1',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceFacilityLocation.address.address1',
                    'name' => 'Claim information service facility address1',
                ],
            ],
        ],
    ],
    'claimInformation.serviceFacilityLocation.address.address2' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information service facility address2',
        'value' => [
            'id' => 'claim:claimInformation.serviceFacilityLocation.address.address2',
            'name' => 'Claim information service facility address2',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceFacilityLocation.address.address2',
                    'name' => 'Claim information service facility address2',
                ],
            ],
        ],
    ],
    'claimInformation.serviceFacilityLocation.address.city' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information service facility city',
        'value' => [
            'id' => 'claim:claimInformation.serviceFacilityLocation.address.city',
            'name' => 'Claim information service facility city',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceFacilityLocation.address.city',
                    'name' => 'Claim information service facility city',
                ],
            ],
        ],
    ],
    'claimInformation.serviceFacilityLocation.address.state' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information service facility state',
        'value' => [
            'id' => 'claim:claimInformation.serviceFacilityLocation.address.state',
            'name' => 'Claim information service facility state',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceFacilityLocation.address.state',
                    'name' => 'Claim information service facility state',
                ],
            ],
        ],
    ],
    'claimInformation.serviceFacilityLocation.address.postalCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information service facility postal code',
        'value' => [
            'id' => 'claim:claimInformation.serviceFacilityLocation.address.postalCode',
            'name' => 'Claim information service facility postal code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceFacilityLocation.address.postalCode',
                    'name' => 'Claim information service facility postal code',
                ],
            ],
        ],
    ],
    'claimInformation.serviceFacilityLocation.address.countryCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information service facility country code',
        'value' => [
            'id' => 'claim:claimInformation.serviceFacilityLocation.address.countryCode',
            'name' => 'Claim information service facility country code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceFacilityLocation.address.countryCode',
                    'name' => 'Claim information service facility country code',
                ],
            ],
        ],
    ],
    'claimInformation.serviceFacilityLocation.address.countrySubDivisionCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information service facility country sub division code',
        'value' => [
            'id' => 'claim:claimInformation.serviceFacilityLocation.address.countrySubDivisionCode',
            'name' => 'Claim information service facility country sub division code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceFacilityLocation.address.countrySubDivisionCode',
                    'name' => 'Claim information service facility country sub division code',
                ],
            ],
        ],
    ],
    'claimInformation.serviceLines' => [
        'type' => RuleType::MULTIPLE->value,
        'default' => true,
        'length' => 30,
        'glue' => '',
        'description' => 'Claim information service lines',
        'value' => [
            [
                'id' => 'claim:claimInformation.serviceLines.lineSupplementInformation',
                'name' => 'Claim information service lines supplement information',
            ],
            [
                'id' => 'claim:claimInformation.serviceLines.institutionalService',
                'name' => 'Claim information service lines institutional service',
            ],
            [
                'id' => 'claim:claimInformation.serviceLines.assignedNumber',
                'name' => 'Claim information service lines assigned number',
            ],
            [
                'id' => 'claim:claimInformation.serviceLines.serviceDate',
                'name' => 'Claim information service lines service date',
            ],
            [
                'id' => 'claim:claimInformation.serviceLines.serviceDateEnd',
                'name' => 'Claim information service lines service date end',
            ],
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceLines.lineSupplementInformation',
                    'name' => 'Claim information service lines supplement information',
                ],
                [
                    'id' => 'claim:claimInformation.serviceLines.institutionalService',
                    'name' => 'Claim information service lines institutional service',
                ],
                [
                    'id' => 'claim:claimInformation.serviceLines.assignedNumber',
                    'name' => 'Claim information service lines assigned number',
                ],
                [
                    'id' => 'claim:claimInformation.serviceLines.serviceDate',
                    'name' => 'Claim information service lines service date',
                ],
                [
                    'id' => 'claim:claimInformation.serviceLines.serviceDateEnd',
                    'name' => 'Claim information service lines service date end',
                ],
            ],
        ],
    ],
    'claimInformation.claimCodeInformation.admissionTypeCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information admission type code',
        'value' => [
            'id' => 'claim:claimInformation.claimCodeInformation.admissionTypeCode',
            'name' => 'Claim information admission type code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimCodeInformation.admissionTypeCode',
                    'name' => 'Claim information admission type code',
                ],
            ],
        ],
    ],
    'claimInformation.claimCodeInformation.admissionSourceCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information admission source code',
        'value' => [
            'id' => 'claim:claimInformation.claimCodeInformation.admissionSourceCode',
            'name' => 'Claim information admission source code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimCodeInformation.admissionSourceCode',
                    'name' => 'Claim information admission source code',
                ],
            ],
        ],
    ],
    'claimInformation.claimCodeInformation.patientStatusCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information patient status code',
        'value' => [
            'id' => 'claim:claimInformation.claimCodeInformation.patientStatusCode',
            'name' => 'Claim information patient status code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimCodeInformation.patientStatusCode',
                    'name' => 'Claim information patient status code',
                ],
            ],
        ],
    ],
    'claimInformation.epsdtReferral.certificationConditionCodeAppliesIndicator' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information epsdt certification condition code applies indicator',
        'value' => [
            'id' => 'claim:claimInformation.epsdtReferral.certificationConditionCodeAppliesIndicator',
            'name' => 'Claim information epsdt certification condition code applies indicator',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.epsdtReferral.certificationConditionCodeAppliesIndicator',
                    'name' => 'Claim information epsdt certification condition code applies indicator',
                ],
            ],
        ],
    ],
    'claimInformation.epsdtReferral.conditionCodes' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information epsdt referral condition codes',
        'value' => [
            'id' => 'claim:claimInformation.epsdtReferral.conditionCodes',
            'name' => 'Claim information epsdt referral condition codes',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.epsdtReferral.conditionCodes',
                    'name' => 'Claim information epsdt referral condition codes',
                ],
            ],
        ],
    ],
    'claimInformation.claimChargeAmount' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information claim charge amount',
        'value' => [
            'id' => 'claim:claimInformation.claimChargeAmount',
            'name' => 'Claim information claim charge amount',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimChargeAmount',
                    'name' => 'Claim information claim charge amount',
                ],
            ],
        ],
    ],
    'claimInformation.placeOfServiceCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information place of service code',
        'value' => [
            'id' => 'claim:claimInformation.placeOfServiceCode',
            'name' => 'Claim information place of service code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.placeOfServiceCode',
                    'name' => 'Claim information place of service code',
                ],
            ],
        ],
    ],
    'claimInformation.claimFrequencyCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Claim information claim frequency code',
        'value' => [
            'id' => 'claim:claimInformation.claimFrequencyCode',
            'name' => 'Claim information claim frequency code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimFrequencyCode',
                    'name' => 'Claim information claim frequency code',
                ],
            ],
        ],
    ],
    'payToAddress.address1' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Pay to address address 1',
        'value' => [
            'id' => 'claim:payToAddress.address1',
            'name' => 'Pay to address address 1',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:payToAddress.address1',
                    'name' => 'Pay to address address 1',
                ],
            ],
        ],
    ],
    'payToAddress.address2' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Pay to address address 2',
        'value' => [
            'id' => 'claim:payToAddress.address2',
            'name' => 'Pay to address address 2',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:payToAddress.address2',
                    'name' => 'Pay to address address 2',
                ],
            ],
        ],
    ],
    'payToAddress.city' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Pay to address city',
        'value' => [
            'id' => 'claim:payToAddress.city',
            'name' => 'Pay to address city',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:payToAddress.city',
                    'name' => 'Pay to address city',
                ],
            ],
        ],
    ],
    'payToAddress.state' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Pay to address state',
        'value' => [
            'id' => 'claim:payToAddress.state',
            'name' => 'Pay to address state',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:payToAddress.state',
                    'name' => 'Pay to address state',
                ],
            ],
        ],
    ],
    'payToAddress.postalCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Pay to address postal code',
        'value' => [
            'id' => 'claim:payToAddress.postalCode',
            'name' => 'Pay to address postal code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:payToAddress.postalCode',
                    'name' => 'Pay to address postal code',
                ],
            ],
        ],
    ],
    'payToAddress.countryCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Pay to address country code',
        'value' => [
            'id' => 'claim:payToAddress.countryCode',
            'name' => 'Pay to address country code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:payToAddress.countryCode',
                    'name' => 'Pay to address country code',
                ],
            ],
        ],
    ],
    'payToAddress.countrySubDivisionCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Pay to address country sub division code',
        'value' => [
            'id' => 'claim:payToAddress.countrySubDivisionCode',
            'name' => 'Pay to address country sub division code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:payToAddress.countrySubDivisionCode',
                    'name' => 'Pay to address country sub division code',
                ],
            ],
        ],
    ],
    'billing.providerType' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing provider type',
        'value' => [
            'id' => 'claim:billing.providerType',
            'name' => 'Billing provider type',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.providerType',
                    'name' => 'Billing provider type',
                ],
            ],
        ],
    ],
    'billing.npi' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing npi',
        'value' => [
            'id' => 'claim:billing.npi',
            'name' => 'Billing npi',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.npi',
                    'name' => 'Billing npi',
                ],
            ],
        ],
    ],
    'billing.ssn' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing ssn',
        'value' => [
            'id' => 'claim:billing.ssn',
            'name' => 'Billing ssn',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.ssn',
                    'name' => 'Billing ssn',
                ],
            ],
        ],
    ],
    'billing.employerId' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing employerId',
        'value' => [
            'id' => 'claim:billing.employerId',
            'name' => 'Billing employerId',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.employerId',
                    'name' => 'Billing employerId',
                ],
            ],
        ],
    ],
    'billing.commercialNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing commercial number',
        'value' => [
            'id' => 'claim:billing.commercialNumber',
            'name' => 'Billing commercial number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.commercialNumber',
                    'name' => 'Billing commercial number',
                ],
            ],
        ],
    ],
    'billing.locationNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing location number',
        'value' => [
            'id' => 'claim:billing.locationNumber',
            'name' => 'Billing location number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.locationNumber',
                    'name' => 'Billing location number',
                ],
            ],
        ],
    ],
    'billing.payerIdentificationNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing payer identification number',
        'value' => [
            'id' => 'claim:billing.payerIdentificationNumber',
            'name' => 'Billing payer identification number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.payerIdentificationNumber',
                    'name' => 'Billing payer identification number',
                ],
            ],
        ],
    ],
    'billing.employerIdentificationNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing employer identification number',
        'value' => [
            'id' => 'claim:billing.employerIdentificationNumber',
            'name' => 'Billing employer identification number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.employerIdentificationNumber',
                    'name' => 'Billing employer identification number',
                ],
            ],
        ],
    ],
    'billing.claimOfficeNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing claim office number',
        'value' => [
            'id' => 'claim:billing.claimOfficeNumber',
            'name' => 'Billing claim office number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.claimOfficeNumber',
                    'name' => 'Billing claim office number',
                ],
            ],
        ],
    ],
    'billing.naic' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing naic',
        'value' => [
            'id' => 'claim:billing.naic',
            'name' => 'Billing naic',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.naic',
                    'name' => 'Billing naic',
                ],
            ],
        ],
    ],
    'billing.stateLicenseNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing state license number',
        'value' => [
            'id' => 'claim:billing.stateLicenseNumber',
            'name' => 'Billing state license number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.stateLicenseNumber',
                    'name' => 'Billing state license number',
                ],
            ],
        ],
    ],
    'billing.providerUpinNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing provider upin number',
        'value' => [
            'id' => 'claim:billing.providerUpinNumber',
            'name' => 'Billing provider upin number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.providerUpinNumber',
                    'name' => 'Billing provider upin number',
                ],
            ],
        ],
    ],
    'billing.taxonomyCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing taxonomy code',
        'value' => [
            'id' => 'claim:billing.taxonomyCode',
            'name' => 'Billing taxonomy code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.taxonomyCode',
                    'name' => 'Billing taxonomy code',
                ],
            ],
        ],
    ],
    'billing.firstName' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing first name',
        'value' => [
            'id' => 'claim:billing.firstName',
            'name' => 'Billing first name',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.firstName',
                    'name' => 'Billing first name',
                ],
            ],
        ],
    ],
    'billing.lastName' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing last name',
        'value' => [
            'id' => 'claim:billing.lastName',
            'name' => 'Billing last name',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.lastName',
                    'name' => 'Billing last name',
                ],
            ],
        ],
    ],
    'billing.middleName' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing middle name',
        'value' => [
            'id' => 'claim:billing.middleName',
            'name' => 'Billing middle name',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.middleName',
                    'name' => 'Billing middle name',
                ],
            ],
        ],
    ],
    'billing.suffix' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing suffix',
        'value' => [
            'id' => 'claim:billing.suffix',
            'name' => 'Billing suffix',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.suffix',
                    'name' => 'Billing suffix',
                ],
            ],
        ],
    ],
    'billing.organizationName' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing organization name',
        'value' => [
            'id' => 'claim:billing.organizationName',
            'name' => 'Billing organization name',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.organizationName',
                    'name' => 'Billing organization name',
                ],
            ],
        ],
    ],
    'billing.address.address1' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing address address 1',
        'value' => [
            'id' => 'claim:billing.address.address1',
            'name' => 'Billing address address 1',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.address.address1',
                    'name' => 'Billing address address 1',
                ],
            ],
        ],
    ],
    'billing.address.address2' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing address address 2',
        'value' => [
            'id' => 'claim:billing.address.address2',
            'name' => 'Billing address address 2',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.address.address2',
                    'name' => 'Billing address address 2',
                ],
            ],
        ],
    ],
    'billing.address.city' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing address city',
        'value' => [
            'id' => 'claim:billing.address.city',
            'name' => 'Billing address city',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.address.city',
                    'name' => 'Billing address city',
                ],
            ],
        ],
    ],
    'billing.address.state' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing address state',
        'value' => [
            'id' => 'claim:billing.address.state',
            'name' => 'Billing address state',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.address.state',
                    'name' => 'Billing address state',
                ],
            ],
        ],
    ],
    'billing.address.postalCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing address postal code',
        'value' => [
            'id' => 'claim:billing.address.postalCode',
            'name' => 'Billing address postal code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.address.postalCode',
                    'name' => 'Billing address postal code',
                ],
            ],
        ],
    ],
    'billing.address.countryCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing address country code',
        'value' => [
            'id' => 'claim:billing.address.countryCode',
            'name' => 'Billing address country code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.address.countryCode',
                    'name' => 'Billing address country code',
                ],
            ],
        ],
    ],
    'billing.address.countrySubDivisionCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing address country sub division code',
        'value' => [
            'id' => 'claim:billing.address.countrySubDivisionCode',
            'name' => 'Billing address country sub division code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.address.countrySubDivisionCode',
                    'name' => 'Billing address country sub division code',
                ],
            ],
        ],
    ],
    'billing.contactInformation.name' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing contact information name',
        'value' => [
            'id' => 'claim:billing.contactInformation.name',
            'name' => 'Billing contact information name',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.contactInformation.name',
                    'name' => 'Billing contact information name',
                ],
            ],
        ],
    ],
    'billing.contactInformation.phoneNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing contact information phone number',
        'value' => [
            'id' => 'claim:billing.contactInformation.phoneNumber',
            'name' => 'Billing contact information phone number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.contactInformation.phoneNumber',
                    'name' => 'Billing contact information phone number',
                ],
            ],
        ],
    ],
    'billing.contactInformation.faxNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing contact information fax number',
        'value' => [
            'id' => 'claim:billing.contactInformation.faxNumber',
            'name' => 'Billing contact information fax number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.contactInformation.faxNumber',
                    'name' => 'Billing contact information fax number',
                ],
            ],
        ],
    ],
    'billing.contactInformation.email' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing contact information email',
        'value' => [
            'id' => 'claim:billing.contactInformation.email',
            'name' => 'Billing contact information email',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.contactInformation.email',
                    'name' => 'Billing contact information email',
                ],
            ],
        ],
    ],
    'billing.contactInformation.phoneExtension' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Billing contact information phone extension',
        'value' => [
            'id' => 'claim:billing.contactInformation.phoneExtension',
            'name' => 'Billing contact information phone extension',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:billing.contactInformation.phoneExtension',
                    'name' => 'Billing contact information phone extension',
                ],
            ],
        ],
    ],
    'referring.providerType' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring provider type',
        'value' => [
            'id' => 'claim:referring.providerType',
            'name' => 'Referring provider type',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.providerType',
                    'name' => 'Referring provider type',
                ],
            ],
        ],
    ],
    'referring.npi' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring npi',
        'value' => [
            'id' => 'claim:referring.npi',
            'name' => 'Referring npi',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.npi',
                    'name' => 'Referring npi',
                ],
            ],
        ],
    ],
    'referring.ssn' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring ssn',
        'value' => [
            'id' => 'claim:referring.ssn',
            'name' => 'Referring ssn',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.ssn',
                    'name' => 'Referring ssn',
                ],
            ],
        ],
    ],
    'referring.employerId' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring employerId',
        'value' => [
            'id' => 'claim:referring.employerId',
            'name' => 'Referring employerId',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.employerId',
                    'name' => 'Referring employerId',
                ],
            ],
        ],
    ],
    'referring.commercialNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring commercial number',
        'value' => [
            'id' => 'claim:referring.commercialNumber',
            'name' => 'Referring commercial number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.commercialNumber',
                    'name' => 'Referring commercial number',
                ],
            ],
        ],
    ],
    'referring.locationNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring location number',
        'value' => [
            'id' => 'claim:referring.locationNumber',
            'name' => 'Referring location number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.locationNumber',
                    'name' => 'Referring location number',
                ],
            ],
        ],
    ],
    'referring.payerIdentificationNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring payer identification number',
        'value' => [
            'id' => 'claim:referring.payerIdentificationNumber',
            'name' => 'Referring payer identification number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.payerIdentificationNumber',
                    'name' => 'Referring payer identification number',
                ],
            ],
        ],
    ],
    'referring.employerIdentificationNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring employer identification number',
        'value' => [
            'id' => 'claim:referring.employerIdentificationNumber',
            'name' => 'Referring employer identification number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.employerIdentificationNumber',
                    'name' => 'Referring employer identification number',
                ],
            ],
        ],
    ],
    'referring.claimOfficeNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring claim office number',
        'value' => [
            'id' => 'claim:referring.claimOfficeNumber',
            'name' => 'Referring claim office number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.claimOfficeNumber',
                    'name' => 'Referring claim office number',
                ],
            ],
        ],
    ],
    'referring.naic' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring naic',
        'value' => [
            'id' => 'claim:referring.naic',
            'name' => 'Referring naic',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.naic',
                    'name' => 'Referring naic',
                ],
            ],
        ],
    ],
    'referring.stateLicenseNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring state license number',
        'value' => [
            'id' => 'claim:referring.stateLicenseNumber',
            'name' => 'Referring state license number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.stateLicenseNumber',
                    'name' => 'Referring state license number',
                ],
            ],
        ],
    ],
    'referring.providerUpinNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring provider upin number',
        'value' => [
            'id' => 'claim:referring.providerUpinNumber',
            'name' => 'Referring provider upin number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.providerUpinNumber',
                    'name' => 'Referring provider upin number',
                ],
            ],
        ],
    ],
    'referring.taxonomyCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring taxonomy code',
        'value' => [
            'id' => 'claim:referring.taxonomyCode',
            'name' => 'Referring taxonomy code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.taxonomyCode',
                    'name' => 'Referring taxonomy code',
                ],
            ],
        ],
    ],
    'referring.firstName' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring first name',
        'value' => [
            'id' => 'claim:referring.firstName',
            'name' => 'Referring first name',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.firstName',
                    'name' => 'Referring first name',
                ],
            ],
        ],
    ],
    'referring.lastName' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring last name',
        'value' => [
            'id' => 'claim:referring.lastName',
            'name' => 'Referring last name',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.lastName',
                    'name' => 'Referring last name',
                ],
            ],
        ],
    ],
    'referring.middleName' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring middle name',
        'value' => [
            'id' => 'claim:referring.middleName',
            'name' => 'Referring middle name',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.middleName',
                    'name' => 'Referring middle name',
                ],
            ],
        ],
    ],
    'referring.suffix' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring suffix',
        'value' => [
            'id' => 'claim:referring.suffix',
            'name' => 'Referring suffix',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.suffix',
                    'name' => 'Referring suffix',
                ],
            ],
        ],
    ],
    'referring.organizationName' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring organization name',
        'value' => [
            'id' => 'claim:referring.organizationName',
            'name' => 'Referring organization name',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.organizationName',
                    'name' => 'Referring organization name',
                ],
            ],
        ],
    ],
    'referring.address.address1' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring address address 1',
        'value' => [
            'id' => 'claim:referring.address.address1',
            'name' => 'Referring address address 1',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.address.address1',
                    'name' => 'Referring address address 1',
                ],
            ],
        ],
    ],
    'referring.address.address2' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring address address 2',
        'value' => [
            'id' => 'claim:referring.address.address2',
            'name' => 'Referring address address 2',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.address.address2',
                    'name' => 'Referring address address 2',
                ],
            ],
        ],
    ],
    'referring.address.city' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring address city',
        'value' => [
            'id' => 'claim:referring.address.city',
            'name' => 'Referring address city',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.address.city',
                    'name' => 'Referring address city',
                ],
            ],
        ],
    ],
    'referring.address.state' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring address state',
        'value' => [
            'id' => 'claim:referring.address.state',
            'name' => 'Referring address state',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.address.state',
                    'name' => 'Referring address state',
                ],
            ],
        ],
    ],
    'referring.address.postalCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring address postal code',
        'value' => [
            'id' => 'claim:referring.address.postalCode',
            'name' => 'Referring address postal code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.address.postalCode',
                    'name' => 'Referring address postal code',
                ],
            ],
        ],
    ],
    'referring.address.countryCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring address country code',
        'value' => [
            'id' => 'claim:referring.address.countryCode',
            'name' => 'Referring address country code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.address.countryCode',
                    'name' => 'Referring address country code',
                ],
            ],
        ],
    ],
    'referring.address.countrySubDivisionCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring address country sub division code',
        'value' => [
            'id' => 'claim:referring.address.countrySubDivisionCode',
            'name' => 'Referring address country sub division code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.address.countrySubDivisionCode',
                    'name' => 'Referring address country sub division code',
                ],
            ],
        ],
    ],
    'referring.contactInformation.name' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring contact information name',
        'value' => [
            'id' => 'claim:referring.contactInformation.name',
            'name' => 'Referring contact information name',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.contactInformation.name',
                    'name' => 'Referring contact information name',
                ],
            ],
        ],
    ],
    'referring.contactInformation.phoneNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring contact information phone number',
        'value' => [
            'id' => 'claim:referring.contactInformation.phoneNumber',
            'name' => 'Referring contact information phone number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.contactInformation.phoneNumber',
                    'name' => 'Referring contact information phone number',
                ],
            ],
        ],
    ],
    'referring.contactInformation.faxNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring contact information fax number',
        'value' => [
            'id' => 'claim:referring.contactInformation.faxNumber',
            'name' => 'Referring contact information fax number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.contactInformation.faxNumber',
                    'name' => 'Referring contact information fax number',
                ],
            ],
        ],
    ],
    'referring.contactInformation.email' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring contact information email',
        'value' => [
            'id' => 'claim:referring.contactInformation.email',
            'name' => 'Referring contact information email',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.contactInformation.email',
                    'name' => 'Referring contact information email',
                ],
            ],
        ],
    ],
    'referring.contactInformation.phoneExtension' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Referring contact information phone extension',
        'value' => [
            'id' => 'claim:referring.contactInformation.phoneExtension',
            'name' => 'Referring contact information phone extension',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:referring.contactInformation.phoneExtension',
                    'name' => 'Referring contact information phone extension',
                ],
            ],
        ],
    ],
    'rendering.providerType' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering provider type',
        'value' => [],
        'values' => [],
    ],
    'rendering.npi' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering npi',
        'value' => [],
        'values' => [],
    ],
    'rendering.ssn' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering ssn',
        'value' => [],
        'values' => [],
    ],
    'rendering.employerId' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering employerId',
        'value' => [],
        'values' => [],
    ],
    'rendering.commercialNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering commercial number',
        'value' => [],
        'values' => [],
    ],
    'rendering.locationNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering location number',
        'value' => [],
        'values' => [],
    ],
    'rendering.payerIdentificationNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering payer identification number',
        'value' => [],
        'values' => [],
    ],
    'rendering.employerIdentificationNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering employer identification number',
        'value' => [],
        'values' => [],
    ],
    'rendering.claimOfficeNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering claim office number',
        'value' => [],
        'values' => [],
    ],
    'rendering.naic' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering naic',
        'value' => [],
        'values' => [],
    ],
    'rendering.stateLicenseNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering state license number',
        'value' => [],
        'values' => [],
    ],
    'rendering.providerUpinNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering provider upin number',
        'value' => [],
        'values' => [],
    ],
    'rendering.taxonomyCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering taxonomy code',
        'value' => [],
        'values' => [],
    ],
    'rendering.firstName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering first name',
        'value' => [],
        'values' => [],
    ],
    'rendering.lastName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering last name',
        'value' => [],
        'values' => [],
    ],
    'rendering.middleName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering middle name',
        'value' => [],
        'values' => [],
    ],
    'rendering.suffix' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering suffix',
        'value' => [],
        'values' => [],
    ],
    'rendering.organizationName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering organization name',
        'value' => [],
        'values' => [],
    ],
    'rendering.address.address1' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering address address 1',
        'value' => [],
        'values' => [],
    ],
    'rendering.address.address2' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering address address 2',
        'value' => [],
        'values' => [],
    ],
    'rendering.address.city' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering address city',
        'value' => [],
        'values' => [],
    ],
    'rendering.address.state' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering address state',
        'value' => [],
        'values' => [],
    ],
    'rendering.address.postalCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering address postal code',
        'value' => [],
        'values' => [],
    ],
    'rendering.address.countryCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering address country code',
        'value' => [],
        'values' => [],
    ],
    'rendering.address.countrySubDivisionCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering address country sub division code',
        'value' => [],
        'values' => [],
    ],
    'rendering.contactInformation.name' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering contact information name',
        'value' => [],
        'values' => [],
    ],
    'rendering.contactInformation.phoneNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering contact information phone number',
        'value' => [],
        'values' => [],
    ],
    'rendering.contactInformation.faxNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering contact information fax number',
        'value' => [],
        'values' => [],
    ],
    'rendering.contactInformation.email' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering contact information email',
        'value' => [],
        'values' => [],
    ],
    'rendering.contactInformation.phoneExtension' => [
        'type' => RuleType::NONE->value,
        'description' => 'Rendering contact information phone extension',
        'value' => [],
        'values' => [],
    ],
    'attending.providerType' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending provider type',
        'value' => [
            'id' => 'claim:attending.providerType',
            'name' => 'Attending provider type',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.providerType',
                    'name' => 'Attending provider type',
                ],
            ],
        ],
    ],
    'attending.npi' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending npi',
        'value' => [
            'id' => 'claim:attending.npi',
            'name' => 'Attending npi',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.npi',
                    'name' => 'Attending npi',
                ],
            ],
        ],
    ],
    'attending.ssn' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending ssn',
        'value' => [
            'id' => 'claim:attending.ssn',
            'name' => 'Attending ssn',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.ssn',
                    'name' => 'Attending ssn',
                ],
            ],
        ],
    ],
    'attending.employerId' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending employerId',
        'value' => [
            'id' => 'claim:attending.employerId',
            'name' => 'Attending employerId',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.employerId',
                    'name' => 'Attending employerId',
                ],
            ],
        ],
    ],
    'attending.commercialNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending commercial number',
        'value' => [
            'id' => 'claim:attending.commercialNumber',
            'name' => 'Attending commercial number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.commercialNumber',
                    'name' => 'Attending commercial number',
                ],
            ],
        ],
    ],
    'attending.locationNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending location number',
        'value' => [
            'id' => 'claim:attending.locationNumber',
            'name' => 'Attending location number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.locationNumber',
                    'name' => 'Attending location number',
                ],
            ],
        ],
    ],
    'attending.payerIdentificationNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending payer identification number',
        'value' => [
            'id' => 'claim:attending.payerIdentificationNumber',
            'name' => 'Attending payer identification number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.payerIdentificationNumber',
                    'name' => 'Attending payer identification number',
                ],
            ],
        ],
    ],
    'attending.employerIdentificationNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending employer identification number',
        'value' => [
            'id' => 'claim:attending.employerIdentificationNumber',
            'name' => 'Attending employer identification number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.employerIdentificationNumber',
                    'name' => 'Attending employer identification number',
                ],
            ],
        ],
    ],
    'attending.claimOfficeNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending claim office number',
        'value' => [
            'id' => 'claim:attending.claimOfficeNumber',
            'name' => 'Attending claim office number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.claimOfficeNumber',
                    'name' => 'Attending claim office number',
                ],
            ],
        ],
    ],
    'attending.naic' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending naic',
        'value' => [
            'id' => 'claim:attending.naic',
            'name' => 'Attending naic',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.naic',
                    'name' => 'Attending naic',
                ],
            ],
        ],
    ],
    'attending.stateLicenseNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending state license number',
        'value' => [
            'id' => 'claim:attending.stateLicenseNumber',
            'name' => 'Attending state license number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.stateLicenseNumber',
                    'name' => 'Attending state license number',
                ],
            ],
        ],
    ],
    'attending.providerUpinNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending provider upin number',
        'value' => [
            'id' => 'claim:attending.providerUpinNumber',
            'name' => 'Attending provider upin number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.providerUpinNumber',
                    'name' => 'Attending provider upin number',
                ],
            ],
        ],
    ],
    'attending.taxonomyCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending taxonomy code',
        'value' => [
            'id' => 'claim:attending.taxonomyCode',
            'name' => 'Attending taxonomy code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.taxonomyCode',
                    'name' => 'Attending taxonomy code',
                ],
            ],
        ],
    ],
    'attending.firstName' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending first name',
        'value' => [
            'id' => 'claim:attending.firstName',
            'name' => 'Attending first name',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.firstName',
                    'name' => 'Attending first name',
                ],
            ],
        ],
    ],
    'attending.lastName' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending last name',
        'value' => [
            'id' => 'claim:attending.lastName',
            'name' => 'Attending last name',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.lastName',
                    'name' => 'Attending last name',
                ],
            ],
        ],
    ],
    'attending.middleName' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending middle name',
        'value' => [
            'id' => 'claim:attending.middleName',
            'name' => 'Attending middle name',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.middleName',
                    'name' => 'Attending middle name',
                ],
            ],
        ],
    ],
    'attending.suffix' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending suffix',
        'value' => [
            'id' => 'claim:attending.suffix',
            'name' => 'Attending suffix',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.suffix',
                    'name' => 'Attending suffix',
                ],
            ],
        ],
    ],
    'attending.organizationName' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending organization name',
        'value' => [
            'id' => 'claim:attending.organizationName',
            'name' => 'Attending organization name',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.organizationName',
                    'name' => 'Attending organization name',
                ],
            ],
        ],
    ],
    'attending.address.address1' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending address address 1',
        'value' => [
            'id' => 'claim:attending.address.address1',
            'name' => 'Attending address address 1',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.address.address1',
                    'name' => 'Attending address address 1',
                ],
            ],
        ],
    ],
    'attending.address.address2' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending address address 2',
        'value' => [
            'id' => 'claim:attending.address.address2',
            'name' => 'Attending address address 2',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.address.address2',
                    'name' => 'Attending address address 2',
                ],
            ],
        ],
    ],
    'attending.address.city' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending address city',
        'value' => [
            'id' => 'claim:attending.address.city',
            'name' => 'Attending address city',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.address.city',
                    'name' => 'Attending address city',
                ],
            ],
        ],
    ],
    'attending.address.state' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending address state',
        'value' => [
            'id' => 'claim:attending.address.state',
            'name' => 'Attending address state',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.address.state',
                    'name' => 'Attending address state',
                ],
            ],
        ],
    ],
    'attending.address.postalCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending address postal code',
        'value' => [
            'id' => 'claim:attending.address.postalCode',
            'name' => 'Attending address postal code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.address.postalCode',
                    'name' => 'Attending address postal code',
                ],
            ],
        ],
    ],
    'attending.address.countryCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending address country code',
        'value' => [
            'id' => 'claim:attending.address.countryCode',
            'name' => 'Attending address country code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.address.countryCode',
                    'name' => 'Attending address country code',
                ],
            ],
        ],
    ],
    'attending.address.countrySubDivisionCode' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending address country sub division code',
        'value' => [
            'id' => 'claim:attending.address.countrySubDivisionCode',
            'name' => 'Attending address country sub division code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.address.countrySubDivisionCode',
                    'name' => 'Attending address country sub division code',
                ],
            ],
        ],
    ],
    'attending.contactInformation.name' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending contact information name',
        'value' => [
            'id' => 'claim:attending.contactInformation.name',
            'name' => 'Attending contact information name',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.contactInformation.name',
                    'name' => 'Attending contact information name',
                ],
            ],
        ],
    ],
    'attending.contactInformation.phoneNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending contact information phone number',
        'value' => [
            'id' => 'claim:attending.contactInformation.phoneNumber',
            'name' => 'Attending contact information phone number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.contactInformation.phoneNumber',
                    'name' => 'Attending contact information phone number',
                ],
            ],
        ],
    ],
    'attending.contactInformation.faxNumber' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending contact information fax number',
        'value' => [
            'id' => 'claim:attending.contactInformation.faxNumber',
            'name' => 'Attending contact information fax number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.contactInformation.faxNumber',
                    'name' => 'Attending contact information fax number',
                ],
            ],
        ],
    ],
    'attending.contactInformation.email' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending contact information email',
        'value' => [
            'id' => 'claim:attending.contactInformation.email',
            'name' => 'Attending contact information email',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.contactInformation.email',
                    'name' => 'Attending contact information email',
                ],
            ],
        ],
    ],
    'attending.contactInformation.phoneExtension' => [
        'type' => RuleType::SINGLE->value,
        'default' => true,
        'description' => 'Attending contact information phone extension',
        'value' => [
            'id' => 'claim:attending.contactInformation.phoneExtension',
            'name' => 'Attending contact information phone extension',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:attending.contactInformation.phoneExtension',
                    'name' => 'Attending contact information phone extension',
                ],
            ],
        ],
    ],
];
