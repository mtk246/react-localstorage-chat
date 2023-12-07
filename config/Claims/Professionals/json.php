<?php

declare(strict_types=1);

use App\Enums\Claim\RuleType;

return [
    'controlNumber' => [
        'type' => RuleType::SINGLE->value,
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
    'receiver.organizationName' => [
        'type' => RuleType::SINGLE->value,
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
    'subscriber.memberId' => [
        'type' => RuleType::SINGLE->value,
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
    'subscriber.ssn' => [
        'type' => RuleType::SINGLE->value,
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
    'subscriber.contactInformation.name' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Subscriber contact information name',
        'value' => [
            'id' => 'claim:subscriber.contactInformation.name',
            'name' => 'Subscriber contact information name',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:subscriber.contactInformation.name',
                    'name' => 'Subscriber contact information name',
                ],
            ],
        ],
    ],
    'subscriber.contactInformation.phoneNumber' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Subscriber contact information phone number',
        'value' => [
            'id' => 'claim:subscriber.contactInformation.phoneNumber',
            'name' => 'Subscriber contact information phone number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:subscriber.contactInformation.phoneNumber',
                    'name' => 'Subscriber contact information phone number',
                ],
            ],
        ],
    ],
    'subscriber.contactInformation.faxNumber' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Subscriber contact information fax number',
        'value' => [
            'id' => 'claim:subscriber.contactInformation.faxNumber',
            'name' => 'Subscriber contact information fax number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:subscriber.contactInformation.faxNumber',
                    'name' => 'Subscriber contact information fax number',
                ],
            ],
        ],
    ],
    'subscriber.contactInformation.email' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Subscriber contact information email',
        'value' => [
            'id' => 'claim:subscriber.contactInformation.email',
            'name' => 'Subscriber contact information email',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:subscriber.contactInformation.email',
                    'name' => 'Subscriber contact information email',
                ],
            ],
        ],
    ],
    'subscriber.contactInformation.phoneExtension' => [
        'type' => RuleType::NONE->value,
        'description' => 'Submitter contact information phone extension',
        'value' => [],
        'values' => [],
    ],
    'subscriber.address.address1' => [
        'type' => RuleType::SINGLE->value,
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
    'dependent.contactInformation.name' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Dependent contact information name',
        'value' => [
            'id' => 'claim:dependent.contactInformation.name',
            'name' => 'Dependent contact information name',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:dependent.contactInformation.name',
                    'name' => 'Dependent contact information name',
                ],
            ],
        ],
    ],
    'dependent.contactInformation.phoneNumber' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Dependent contact information phone number',
        'value' => [
            'id' => 'claim:dependent.contactInformation.phoneNumber',
            'name' => 'Dependent contact information phone number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:dependent.contactInformation.phoneNumber',
                    'name' => 'Dependent contact information phone number',
                ],
            ],
        ],
    ],
    'dependent.contactInformation.faxNumber' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Dependent contact information fax number',
        'value' => [
            'id' => 'claim:dependent.contactInformation.faxNumber',
            'name' => 'Dependent contact information fax number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:dependent.contactInformation.faxNumber',
                    'name' => 'Dependent contact information fax number',
                ],
            ],
        ],
    ],
    'dependent.contactInformation.email' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Dependent contact information email',
        'value' => [
            'id' => 'claim:dependent.contactInformation.email',
            'name' => 'Dependent contact information email',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:dependent.contactInformation.email',
                    'name' => 'Dependent contact information email',
                ],
            ],
        ],
    ],
    'dependent.contactInformation.phoneExtension' => [
        'type' => RuleType::NONE->value,
        'description' => 'Submitter contact information phone extension',
        'value' => [],
        'values' => [],
    ],
    'dependent.address.address1' => [
        'type' => RuleType::SINGLE->value,
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
    'claimInformation.propertyCasualtyClaimNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information property casualty claim number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.deathDate' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information death date',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.patientWeight' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information patient weight',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.pregnancyIndicator' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information pregnancy indicator',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.patientControlNumber' => [
        'type' => RuleType::SINGLE->value,
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
    'claimInformation.claimChargeAmount' => [
        'type' => RuleType::SINGLE->value,
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
    'claimInformation.signatureIndicator' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information signature indicator',
        'value' => [
            'id' => 'claim:claimInformation.signatureIndicator',
            'name' => 'Claim information signature indicator',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.signatureIndicator',
                    'name' => 'Claim information signature indicator',
                ],
            ],
        ],
    ],
    'claimInformation.planParticipationCode' => [
        'type' => RuleType::SINGLE->value,
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
    'claimInformation.patientSignatureSourceCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information patient signature source code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.relatedCausesCode' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information related causes code',
        'value' => [
            'id' => 'claim:claimInformation.relatedCausesCode',
            'name' => 'Claim information related causes code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.relatedCausesCode',
                    'name' => 'Claim information related causes code',
                ],
            ],
        ],
    ],
    'claimInformation.autoAccidentStateCode' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information auto accident state code',
        'value' => [
            'id' => 'claim:claimInformation.autoAccidentStateCode',
            'name' => 'Claim information auto accident state code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.autoAccidentStateCode',
                    'name' => 'Claim information auto accident state code',
                ],
            ],
        ],
    ],
    'claimInformation.autoAccidentCountryCode' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information auto accident country code',
        'value' => [
            'id' => 'claim:claimInformation.autoAccidentCountryCode',
            'name' => 'Claim information auto accident country code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.autoAccidentCountryCode',
                    'name' => 'Claim information auto accident country code',
                ],
            ],
        ],
    ],
    'claimInformation.specialProgramCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information special program code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.delayReasonCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information delay reason code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.patientAmountPaid' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information patient amount paid',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.fileInformation' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information file information',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.fileInformationList' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information file information list',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimDateInformation.symptomDate' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information symptom date',
        'value' => [
            'id' => 'claim:claimInformation.claimDateInformation.symptomDate',
            'name' => 'Claim information symptom date',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimDateInformation.symptomDate',
                    'name' => 'Claim information symptom date',
                ],
            ],
        ],
    ],
    'claimInformation.claimDateInformation.initialTreatmentDate' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information initial treatment date',
        'value' => [
            'id' => 'claim:claimInformation.claimDateInformation.initialTreatmentDate',
            'name' => 'Claim information initial treatment date',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimDateInformation.initialTreatmentDate',
                    'name' => 'Claim information initial treatment date',
                ],
            ],
        ],
    ],
    'claimInformation.claimDateInformation.lastSeenDate' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information last seen date',
        'value' => [
            'id' => 'claim:claimInformation.claimDateInformation.lastSeenDate',
            'name' => 'Claim information last seen date',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimDateInformation.lastSeenDate',
                    'name' => 'Claim information last seen date',
                ],
            ],
        ],
    ],
    'claimInformation.claimDateInformation.acuteManifestationDate' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information acute manifestation date',
        'value' => [
            'id' => 'claim:claimInformation.claimDateInformation.acuteManifestationDate',
            'name' => 'Claim information acute manifestation date',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimDateInformation.acuteManifestationDate',
                    'name' => 'Claim information acute manifestation date',
                ],
            ],
        ],
    ],
    'claimInformation.claimDateInformation.accidentDate' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information accident date',
        'value' => [
            'id' => 'claim:claimInformation.claimDateInformation.accidentDate',
            'name' => 'Claim information accident date',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimDateInformation.accidentDate',
                    'name' => 'Claim information accident date',
                ],
            ],
        ],
    ],
    'claimInformation.claimDateInformation.lastMenstrualPeriodDate' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information last menstrual period date',
        'value' => [
            'id' => 'claim:claimInformation.claimDateInformation.lastMenstrualPeriodDate',
            'name' => 'Claim information last menstrual period date',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimDateInformation.lastMenstrualPeriodDate',
                    'name' => 'Claim information last menstrual period date',
                ],
            ],
        ],
    ],
    'claimInformation.claimDateInformation.lastXRayDate' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information last X-Ray date',
        'value' => [
            'id' => 'claim:claimInformation.claimDateInformation.lastXRayDate',
            'name' => 'Claim information last X-Ray date',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimDateInformation.lastXRayDate',
                    'name' => 'Claim information last X-Ray date',
                ],
            ],
        ],
    ],
    'claimInformation.claimDateInformation.hearingAndVisionPrescriptionDate' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information hearing and vision prescription date',
        'value' => [
            'id' => 'claim:claimInformation.claimDateInformation.hearingAndVisionPrescriptionDate',
            'name' => 'Claim information hearing and vision prescription date',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimDateInformation.hearingAndVisionPrescriptionDate',
                    'name' => 'Claim information hearing and vision prescription date',
                ],
            ],
        ],
    ],
    'claimInformation.claimDateInformation.disabilityBeginDate' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information disability begin date',
        'value' => [
            'id' => 'claim:claimInformation.claimDateInformation.disabilityBeginDate',
            'name' => 'Claim information disability begin date',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimDateInformation.disabilityBeginDate',
                    'name' => 'Claim information disability begin date',
                ],
            ],
        ],
    ],
    'claimInformation.claimDateInformation.disabilityEndDate' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information disability end date',
        'value' => [
            'id' => 'claim:claimInformation.claimDateInformation.disabilityEndDate',
            'name' => 'Claim information disability end date',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimDateInformation.disabilityEndDate',
                    'name' => 'Claim information disability end date',
                ],
            ],
        ],
    ],
    'claimInformation.claimDateInformation.lastWorkedDate' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information last worked date',
        'value' => [
            'id' => 'claim:claimInformation.claimDateInformation.lastWorkedDate',
            'name' => 'Claim information last worked date',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimDateInformation.lastWorkedDate',
                    'name' => 'Claim information last worked date',
                ],
            ],
        ],
    ],
    'claimInformation.claimDateInformation.authorizedReturnToWorkDate' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information authorized return to work date',
        'value' => [
            'id' => 'claim:claimInformation.claimDateInformation.authorizedReturnToWorkDate',
            'name' => 'Claim information authorized return to work date',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimDateInformation.authorizedReturnToWorkDate',
                    'name' => 'Claim information authorized return to work date',
                ],
            ],
        ],
    ],
    'claimInformation.claimDateInformation.admissionDate' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information admission date',
        'value' => [
            'id' => 'claim:claimInformation.claimDateInformation.admissionDate',
            'name' => 'Claim information admission date',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimDateInformation.admissionDate',
                    'name' => 'Claim information admission date',
                ],
            ],
        ],
    ],
    'claimInformation.claimDateInformation.dischargeDate' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information discharge date',
        'value' => [
            'id' => 'claim:claimInformation.claimDateInformation.dischargeDate',
            'name' => 'Claim information discharge date',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimDateInformation.dischargeDate',
                    'name' => 'Claim information discharge date',
                ],
            ],
        ],
    ],
    'claimInformation.claimDateInformation.assumedAndRelinquishedCareBeginDate' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information assumed and relinquished care begin date',
        'value' => [
            'id' => 'claim:claimInformation.claimDateInformation.assumedAndRelinquishedCareBeginDate',
            'name' => 'Claim information assumed and relinquished care begin date',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimDateInformation.assumedAndRelinquishedCareBeginDate',
                    'name' => 'Claim information assumed and relinquished care begin date',
                ],
            ],
        ],
    ],
    'claimInformation.claimDateInformation.assumedAndRelinquishedCareEndDate' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information assumed and relinquished care end date',
        'value' => [
            'id' => 'claim:claimInformation.claimDateInformation.assumedAndRelinquishedCareEndDate',
            'name' => 'Claim information assumed and relinquished care end date',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimDateInformation.assumedAndRelinquishedCareEndDate',
                    'name' => 'Claim information assumed and relinquished care end date',
                ],
            ],
        ],
    ],
    'claimInformation.claimDateInformation.repricerReceivedDate' => [
        'type' => RuleType::SINGLE->value,
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
    'claimInformation.claimDateInformation.firstContactDate' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information first contact date',
        'value' => [
            'id' => 'claim:claimInformation.claimDateInformation.firstContactDate',
            'name' => 'Claim information first contact date',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.claimDateInformation.firstContactDate',
                    'name' => 'Claim information first contact date',
                ],
            ],
        ],
    ],
    'claimInformation.claimContractInformation.contractTypeCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information contract type code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimContractInformation.contractAmount' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information contract amount',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimContractInformation.contractPercentage' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information contract percentage',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimContractInformation.contractCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information contract code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimContractInformation.termsDiscountPercentage' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information terms discount percentage',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimContractInformation.contractVersionIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information contract version identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimSupplementalInformation.reportInformation.attachmentReportTypeCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim supplemental information attachment report type code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimSupplementalInformation.reportInformation.attachmentTransmissionCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim supplemental information file information list',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimSupplementalInformation.reportInformation.attachmentControlNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim supplemental information file information list',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimSupplementalInformation.priorAuthorizationNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim supplemental information file information list',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimSupplementalInformation.referralNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim supplemental information file information list',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimSupplementalInformation.claimControlNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim supplemental information file information list',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimSupplementalInformation.cliaNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim supplemental information file information list',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimSupplementalInformation.repricedClaimNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim supplemental information file information list',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimSupplementalInformation.adjustedRepricedClaimNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim supplemental information file information list',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimSupplementalInformation.investigationalDeviceExemptionNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim supplemental information file information list',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimSupplementalInformation.claimNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim supplemental information file information list',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimSupplementalInformation.mammographyCertificationNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim supplemental information file information list',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimSupplementalInformation.medicalRecordNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim supplemental information file information list',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimSupplementalInformation.demoProjectIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim supplemental information file information list',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimSupplementalInformation.carePlanOversightNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim supplemental information file information list',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimSupplementalInformation.medicareCrossoverReferenceId' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim supplemental information file information list',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimSupplementalInformation.serviceAuthorizationExceptionCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim supplemental information file information list',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimNote.additionalInformation' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information note additional information',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimNote.certificationNarrative' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information note certification narrative',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimNote.goalRehabOrDischargePlans' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information note goal rehab or discharge plans',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimNote.diagnosisDescription' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information note diagnosis description',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimNote.thirdPartOrgNotes' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information note third part org notes',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.ambulanceTransportInformation.patientWeightInPounds' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information ambulance transport patient weight in pounds',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.ambulanceTransportInformation.ambulanceTransportReasonCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information ambulance transport reason code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.ambulanceTransportInformation.transportDistanceInMiles' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information ambulance transport distance in miles',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.ambulanceTransportInformation.roundTripPurposeDescription' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information ambulance transport round trip purpose description',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.ambulanceTransportInformation.stretcherPurposeDescription' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information ambulance transport stretcher purpose description',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.spinalManipulationServiceInformation.patientConditionCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information spinal manipulation service patient condition code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.spinalManipulationServiceInformation.patientConditionDescription1' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information spinal manipulation service patient condition description1',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.spinalManipulationServiceInformation.patientConditionDescription2' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information spinal manipulation service patient condition description2',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.ambulanceCertification.certificationConditionIndicator' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information ambulance certification condition indicator',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.ambulanceCertification.conditionCodes' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information ambulance certification condition codes',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.patientConditionInformationVision.codeCategory' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information patient code category',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.patientConditionInformationVision.certificationConditionIndicator' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information patient certification condition indicator',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.patientConditionInformationVision.conditionCodes' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information patient condition codes',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.homeboundIndicator' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information homebound indicator',
        'value' => [
            'id' => 'claim:claimInformation.homeboundIndicator',
            'name' => 'Claim information homebound indicator',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.homeboundIndicator',
                    'name' => 'Claim information homebound indicator',
                ],
            ],
        ],
    ],
    'claimInformation.epsdtReferral.certificationConditionCodeAppliesIndicator' => [
        'type' => RuleType::SINGLE->value,
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
    'claimInformation.healthCareCodeInformation.diagnosisTypeCode' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information healthCare diagnosis type code',
        'value' => [
            'id' => 'claim:claimInformation.healthCareCodeInformation.diagnosisTypeCode',
            'name' => 'Claim information healthCare diagnosis type code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.healthCareCodeInformation.diagnosisTypeCode',
                    'name' => 'Claim information healthCare diagnosis type code',
                ],
            ],
        ],
    ],
    'claimInformation.healthCareCodeInformation.diagnosisCode' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information healthCare diagnosis code',
        'value' => [
            'id' => 'claim:claimInformation.healthCareCodeInformation.diagnosisCode',
            'name' => 'Claim information healthCare diagnosis code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.healthCareCodeInformation.diagnosisCode',
                    'name' => 'Claim information healthCare diagnosis code',
                ],
            ],
        ],
    ],
    'claimInformation.anesthesiaRelatedSurgicalProcedure' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information anesthesia related surgical procedure',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.conditionInformation.conditionCodes' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information condition codes',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimPricingRepricingInformation.pricingMethodologyCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information repricing pricing methodology code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimPricingRepricingInformation.repricedAllowedAmount' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information repriced allowed amount',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimPricingRepricingInformation.repricedSavingAmount' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information repriced saving amount',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimPricingRepricingInformation.repricingOrganizationIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information repricing organization identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimPricingRepricingInformation.repricingPerDiemOrFlatRateAmoung' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information repricing per diem or flat rate amoung',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimPricingRepricingInformation.repricedApprovedAmbulatoryPatientGroupCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information repriced approved ambulatory patient group code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimPricingRepricingInformation.repricedApprovedAmbulatoryPatientGroupAmount' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information repriced approved ambulatory patient group amount',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimPricingRepricingInformation.rejectReasonCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information pricing repricing reject reason code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimPricingRepricingInformation.policyComplianceCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information pricing repricing policy compliance code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.claimPricingRepricingInformation.exceptionCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information pricing repricing exception code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceFacilityLocation.organizationName' => [
        'type' => RuleType::SINGLE->value,
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
    'claimInformation.serviceFacilityLocation.npi' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information service facility npi',
        'value' => [
            'id' => 'claim:claimInformation.serviceFacilityLocation.npi',
            'name' => 'Claim information service facility npi',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceFacilityLocation.npi',
                    'name' => 'Claim information service facility npi',
                ],
            ],
        ],
    ],
    'claimInformation.serviceFacilityLocation.secondaryIdentifier.qualifier' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information service facility secondary identifier qualifier',
        'value' => [
            'id' => 'claim:claimInformation.serviceFacilityLocation.secondaryIdentifier.qualifier',
            'name' => 'Claim information service facility secondary identifier qualifier',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceFacilityLocation.secondaryIdentifier.qualifier',
                    'name' => 'Claim information service facility secondary identifier qualifier',
                ],
            ],
        ],
    ],
    'claimInformation.serviceFacilityLocation.secondaryIdentifier.identifier' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information service facility secondary identifier',
        'value' => [
            'id' => 'claim:claimInformation.serviceFacilityLocation.secondaryIdentifier.identifier',
            'name' => 'Claim information service facility secondary identifier',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceFacilityLocation.secondaryIdentifier.identifier',
                    'name' => 'Claim information service facility secondary identifier',
                ],
            ],
        ],
    ],
    'claimInformation.serviceFacilityLocation.secondaryIdentifier.otherIdentifier' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information service facility secondary other identifier',
        'value' => [
            'id' => 'claim:claimInformation.serviceFacilityLocation.secondaryIdentifier.otherIdentifier',
            'name' => 'Claim information service facility secondary other identifier',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceFacilityLocation.secondaryIdentifier.otherIdentifier',
                    'name' => 'Claim information service facility secondary other identifier',
                ],
            ],
        ],
    ],
    'claimInformation.serviceFacilityLocation.phoneName' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information service facility phone name',
        'value' => [
            'id' => 'claim:claimInformation.serviceFacilityLocation.phoneName',
            'name' => 'Claim information service facility phone name',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceFacilityLocation.phoneName',
                    'name' => 'Claim information service facility phone name',
                ],
            ],
        ],
    ],
    'claimInformation.serviceFacilityLocation.phoneNumber' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information service facility phone number',
        'value' => [
            'id' => 'claim:claimInformation.serviceFacilityLocation.phoneNumber',
            'name' => 'Claim information service facility phone number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceFacilityLocation.phoneNumber',
                    'name' => 'Claim information service facility phone number',
                ],
            ],
        ],
    ],
    'claimInformation.serviceFacilityLocation.phoneExtension' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information service facility phone extension',
        'value' => [
            'id' => 'claim:claimInformation.serviceFacilityLocation.phoneExtension',
            'name' => 'Claim information service facility phone extension',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceFacilityLocation.phoneExtension',
                    'name' => 'Claim information service facility phone extension',
                ],
            ],
        ],
    ],
    'claimInformation.ambulancePickUpLocation.address1' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information ambulance pick up address 1',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.ambulancePickUpLocation.address2' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information ambulance pick up address 2',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.ambulancePickUpLocation.city' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information ambulance pick up city',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.ambulancePickUpLocation.state' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information ambulance pick up state',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.ambulancePickUpLocation.postalCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information ambulance pick up postal code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.ambulancePickUpLocation.countryCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information ambulance pick up country code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.ambulancePickUpLocation.countrySubDivisionCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information ambulance pick up country subdivision code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.ambulanceDropOffLocation.address1' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information ambulance drop off address 1',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.ambulanceDropOffLocation.address2' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information ambulance drop off address 2',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.ambulanceDropOffLocation.city' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information ambulance drop off city',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.ambulanceDropOffLocation.state' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information ambulance drop off state',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.ambulanceDropOffLocation.postalCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information ambulance drop off postal code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.ambulanceDropOffLocation.countryCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information ambulance drop off country code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.ambulanceDropOffLocation.countrySubDivisionCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information ambulance drop off country subdivision code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.paymentResponsibilityLevelCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber payment responsibility level code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.individualRelationshipCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber individual relationship code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.insuranceGroupOrPolicyNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber insurance group or policy number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherInsuredGroupName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other insured group name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.insuranceTypeCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber insurance type code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.claimFilingIndicatorCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber claim filing indicator code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.claimLevelAdjustments.adjustmentGroupCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber claim level adjustment group code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.claimLevelAdjustments.adjustmentReasonCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber claim level adjustment reason code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.claimLevelAdjustments.adjustmentAmount' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber claim level adjustment amount',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.claimLevelAdjustments.adjustmentQuantity' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber claim level adjustment quantity',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.payerPaidAmount' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber payer paid amount',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.nonCoveredChargeAmount' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber non covered charge amount',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.remainingPatientLiability' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber remaining patient liability',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.benefitsAssignmentCertificationIndicator' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber benefits assignment certification indicator',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.patientSignatureGeneratedForPatient' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber patient signature generated for patient',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.releaseOfInformationCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber release of information code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.medicareOutpatientAdjudication.reimbursementRate' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber medicare outpatient adjudication reimbursement rate',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.medicareOutpatientAdjudication.hcpcsPayableAmount' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber medicare outpatient adjudication hcpcs payable amount',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.medicareOutpatientAdjudication.claimPaymentRemarkCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber medicare outpatient adjudication claim payment remark code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.medicareOutpatientAdjudication.endStageRenalDiseasePaymentAmount' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber medicare outpatient adjudication end stage renal disease payment amount',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.medicareOutpatientAdjudication.nonPayableProfessionalComponentBilledAmount' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber medicare outpatient adjudication non payable professional component billed amount',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherSubscriberName.otherInsuredQualifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other insured qualifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherSubscriberName.otherInsuredLastName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other insured last name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherSubscriberName.otherInsuredFirstName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other insured first name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherSubscriberName.otherInsuredMiddleName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other insured middle name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherSubscriberName.otherInsuredNameSuffix' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other insured name suffix',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherSubscriberName.otherInsuredIdentifierTypeCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other insured identifier type code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherSubscriberName.otherInsuredIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other insured identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherSubscriberName.otherInsuredAddress.address1' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other insured address address 1',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherSubscriberName.otherInsuredAddress.address2' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other insured address address 2',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherSubscriberName.otherInsuredAddress.city' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other insured address city',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherSubscriberName.otherInsuredAddress.state' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other insured address state',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherSubscriberName.otherInsuredAddress.postalCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other insured address postal code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherSubscriberName.otherInsuredAddress.countryCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other insured address country code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherSubscriberName.otherInsuredAddress.countrySubDivisionCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other insured address country sub division code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherSubscriberName.otherInsuredAdditionalIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other insured additional identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerName.otherInsuredAdditionalIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer additional identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerName.otherPayerOrganizationName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer organization name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerName.otherPayerIdentifierTypeCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer identifier type code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerName.otherPayerIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerName.otherPayerAddress.address1' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer address address 1',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerName.otherPayerAddress.address2' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer address address 2',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerName.otherPayerAddress.city' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer address city',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerName.otherPayerAddress.state' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer address state',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerName.otherPayerAddress.postalCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer address postal code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerName.otherPayerAddress.countryCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer address country code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerName.otherPayerAddress.countrySubDivisionCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer address country sub division code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerName.otherPayerAdjudicationOrPaymentDate' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer adjudication or payment date',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerName.otherPayerSecondaryIdentifier.qualifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer secondary identifier qualifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerName.otherPayerSecondaryIdentifier.identifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer secondary identifier identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerName.otherPayerSecondaryIdentifier.otherIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer secondary identifier other identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerName.otherPayerPriorAuthorizationNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer prior authorization number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerName.otherPayerPriorAuthorizationOrReferralNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer prior authorization or referral number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerName.otherPayerClaimAdjustmentIndicator' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer claim adjustment indicator',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerName.otherPayerClaimControlNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer claim control number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerReferringProvider.otherPayerReferringProviderIdentifier.qualifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer referring provider identifier qualifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerReferringProvider.otherPayerReferringProviderIdentifier.identifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer referring provider identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerReferringProvider.otherPayerReferringProviderIdentifier.otherIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer referring provider other identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerRenderingProvider.entityTypeQualifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer rendering provider entity type qualifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerRenderingProvider.otherPayerRenderingProviderSecondaryIdentifier.qualifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer rendering provider secondary identifier qualifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerRenderingProvider.otherPayerRenderingProviderSecondaryIdentifier.identifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer rendering provider secondary identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerRenderingProvider.otherPayerRenderingProviderSecondaryIdentifier.otherIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer rendering provider secondary other identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerServiceFacilityLocation.otherPayerServiceFacilityLocation.SecondaryIdentifier.qualifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer service facility location secondary identifier qualifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerServiceFacilityLocation.otherPayerServiceFacilityLocation.SecondaryIdentifier.identifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer service facility location secondary identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerServiceFacilityLocation.otherPayerServiceFacilityLocation.SecondaryIdentifier.otherIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer service facility location secondary other identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerSupervisingProvider.otherPayerSupervisingProviderIdentifier.qualifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer supervising provider identifier qualifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerSupervisingProvider.otherPayerSupervisingProviderIdentifier.identifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer supervising provider identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerSupervisingProvider.otherPayerSupervisingProviderIdentifier.otherIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer supervising provider other identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerBillingProvider.entityTypeQualifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer billing provider entity type qualifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerBillingProvider.otherPayerBillingProviderIdentifier.qualifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer billing provider identifier qualifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerBillingProvider.otherPayerBillingProviderIdentifier.identifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer billing provider identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.otherSubscriberInformation.otherPayerBillingProvider.otherPayerBillingProviderIdentifier.otherIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information other subscriber other payer billing provider other identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.assignedNumber' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information service lines assigned number',
        'value' => [
            'id' => 'claim:claimInformation.serviceLines.assignedNumber',
            'name' => 'Claim information service lines assigned number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceLines.assignedNumber',
                    'name' => 'Claim information service lines assigned number',
                ],
            ],
        ],
    ],
    'claimInformation.serviceLines.serviceDate' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information service lines service date',
        'value' => [
            'id' => 'claim:claimInformation.serviceLines.serviceDate',
            'name' => 'Claim information service lines service date',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceLines.serviceDate',
                    'name' => 'Claim information service lines service date',
                ],
            ],
        ],
    ],
    'claimInformation.serviceLines.serviceDateEnd' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information service lines service date end',
        'value' => [
            'id' => 'claim:claimInformation.serviceLines.serviceDateEnd',
            'name' => 'Claim information service lines service date end',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceLines.serviceDateEnd',
                    'name' => 'Claim information service lines service date end',
                ],
            ],
        ],
    ],
    'claimInformation.serviceLines.providerControlNumber' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information service lines provider control number',
        'value' => [
            'id' => 'claim:claimInformation.serviceLines.providerControlNumber',
            'name' => 'Claim information service lines provider control number',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceLines.providerControlNumber',
                    'name' => 'Claim information service lines provider control number',
                ],
            ],
        ],
    ],
    'claimInformation.serviceLines.professionalService.procedureIdentifier' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information service lines professional service procedure identifier',
        'value' => [
            'id' => 'claim:claimInformation.serviceLines.professionalService.procedureIdentifier',
            'name' => 'Claim information service lines professional service procedure identifier',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceLines.professionalService.procedureIdentifier',
                    'name' => 'Claim information service lines professional service procedure identifier',
                ],
            ],
        ],
    ],
    'claimInformation.serviceLines.professionalService.procedureCode' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information service lines professional service procedure code',
        'value' => [
            'id' => 'claim:claimInformation.serviceLines.professionalService.procedureCode',
            'name' => 'Claim information service lines professional service procedure code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceLines.professionalService.procedureCode',
                    'name' => 'Claim information service lines professional service procedure code',
                ],
            ],
        ],
    ],
    'claimInformation.serviceLines.professionalService.procedureModifiers' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information service lines professional service procedure modifiers',
        'value' => [
            'id' => 'claim:claimInformation.serviceLines.professionalService.procedureModifiers',
            'name' => 'Claim information service lines professional service procedure modifiers',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceLines.professionalService.procedureModifiers',
                    'name' => 'Claim information service lines professional service procedure modifiers',
                ],
            ],
        ],
    ],
    'claimInformation.serviceLines.professionalService.description' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information service lines professional service description',
        'value' => [
            'id' => 'claim:claimInformation.serviceLines.professionalService.description',
            'name' => 'Claim information service lines professional service description',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceLines.professionalService.description',
                    'name' => 'Claim information service lines professional service description',
                ],
            ],
        ],
    ],
    'claimInformation.serviceLines.professionalService.lineItemChargeAmount' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information service lines professional service line item charge amount',
        'value' => [
            'id' => 'claim:claimInformation.serviceLines.professionalService.lineItemChargeAmount',
            'name' => 'Claim information service lines professional service line item charge amount',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceLines.professionalService.lineItemChargeAmount',
                    'name' => 'Claim information service lines professional service line item charge amount',
                ],
            ],
        ],
    ],
    'claimInformation.serviceLines.professionalService.measurementUnit' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information service lines professional service measurement unit',
        'value' => [
            'id' => 'claim:claimInformation.serviceLines.professionalService.measurementUnit',
            'name' => 'Claim information service lines professional service measurement unit',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceLines.professionalService.measurementUnit',
                    'name' => 'Claim information service lines professional service measurement unit',
                ],
            ],
        ],
    ],
    'claimInformation.serviceLines.professionalService.serviceUnitCount' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information service lines professional service service unit count',
        'value' => [
            'id' => 'claim:claimInformation.serviceLines.professionalService.serviceUnitCount',
            'name' => 'Claim information service lines professional service service unit count',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceLines.professionalService.serviceUnitCount',
                    'name' => 'Claim information service lines professional service service unit count',
                ],
            ],
        ],
    ],
    'claimInformation.serviceLines.professionalService.placeOfServiceCode' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information service lines professional service place of service code',
        'value' => [
            'id' => 'claim:claimInformation.serviceLines.professionalService.placeOfServiceCode',
            'name' => 'Claim information service lines professional service place of service code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceLines.professionalService.placeOfServiceCode',
                    'name' => 'Claim information service lines professional service place of service code',
                ],
            ],
        ],
    ],
    'claimInformation.serviceLines.professionalService.compositeDiagnosisCodePointers.diagnosisCodePointers' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information service lines professional service composite  diagnosis code pointers',
        'value' => [
            'id' => 'claim:claimInformation.serviceLines.professionalService.compositeDiagnosisCodePointers.diagnosisCodePointers',
            'name' => 'Claim information service lines professional service composite  diagnosis code pointers',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceLines.professionalService.compositeDiagnosisCodePointers.diagnosisCodePointers',
                    'name' => 'Claim information service lines professional service composite  diagnosis code pointers',
                ],
            ],
        ],
    ],
    'claimInformation.serviceLines.professionalService.emergencyIndicator' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information service lines professional service emergency indicator',
        'value' => [
            'id' => 'claim:claimInformation.serviceLines.professionalService.emergencyIndicator',
            'name' => 'Claim information service lines professional service emergency indicator',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceLines.professionalService.emergencyIndicator',
                    'name' => 'Claim information service lines professional service emergency indicator',
                ],
            ],
        ],
    ],
    'claimInformation.serviceLines.professionalService.epsdtIndicator' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information service lines professional service epsdt indicator',
        'value' => [
            'id' => 'claim:claimInformation.serviceLines.professionalService.epsdtIndicator',
            'name' => 'Claim information service lines professional service epsdt indicator',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceLines.professionalService.epsdtIndicator',
                    'name' => 'Claim information service lines professional service epsdt indicator',
                ],
            ],
        ],
    ],
    'claimInformation.serviceLines.professionalService.familyPlanningIndicator' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information service lines professional service family planning indicator',
        'value' => [
            'id' => 'claim:claimInformation.serviceLines.professionalService.familyPlanningIndicator',
            'name' => 'Claim information service lines professional service family planning indicator',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceLines.professionalService.familyPlanningIndicator',
                    'name' => 'Claim information service lines professional service family planning indicator',
                ],
            ],
        ],
    ],
    'claimInformation.serviceLines.professionalService.copayStatusCode' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information service lines professional service copay status code',
        'value' => [
            'id' => 'claim:claimInformation.serviceLines.professionalService.copayStatusCode',
            'name' => 'Claim information service lines professional service copay status code',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.serviceLines.professionalService.copayStatusCode',
                    'name' => 'Claim information service lines professional service copay status code',
                ],
            ],
        ],
    ],
    'claimInformation.serviceLines.durableMedicalEquipmentService.days' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines durable medical equipment service days',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.durableMedicalEquipmentService.rentalPrice' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines durable medical equipment service rental price',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.durableMedicalEquipmentService.purchasePrice' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines durable medical equipment service purchase price',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.durableMedicalEquipmentService.frequencyCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines durable medical equipment service frequency code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceLineSupplementalInformation.attachmentReportTypeCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supplemental information attachment report type code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceLineSupplementalInformation.attachmentTransmissionCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supplemental information attachment transmission code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceLineSupplementalInformation.attachmentControlNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supplemental information attachment control number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.durableMedicalEquipmentCertificateOfMedicalNecessity.attachmentTransmissionCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines durable medical equipment certificate of medical necessity attachment transmission code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.ambulanceTransportInformation.patientWeightInPounds' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ambulatory transport information patient weight in pounds',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.ambulanceTransportInformation.ambulanceTransportReasonCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ambulatory transport information ambulatory transport reason code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.ambulanceTransportInformation.transportDistanceInMiles' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ambulatory transport information transport distance in miles',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.ambulanceTransportInformation.roundTripPurposeDescription' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ambulatory transport information round trip purpose description',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.ambulanceTransportInformation.stretcherPurposeDescription' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ambulatory transport information stretcher purpose description',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.durableMedicalEquipmentCertification.certificationTypeCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines durable medical equipment certification type code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.durableMedicalEquipmentCertification.durableMedicalEquipmentDurationInMonths' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines durable medical equipment certification durable medical equipment duration in months',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.ambulanceCertification.certificationConditionIndicator' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ambulatory certification condition indicator',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.ambulanceCertification.conditionCodes' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ambulatory certification condition codes',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.hospiceEmployeeIndicator' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines hospice employee indicator',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.conditionIndicatorDurableMedicalEquipment.certificationConditionIndicator' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines condition indicator durable medical equipment certification condition indicator',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.conditionIndicatorDurableMedicalEquipment.conditionIndicator' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines condition indicator durable medical equipment condition indicator',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.conditionIndicatorDurableMedicalEquipment.conditionIndicatorCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines condition indicator durable medical equipment condition indicator code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceLineDateInformation.prescriptionDate' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines service line date information prescription date',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceLineDateInformation.certificationRevisionOrRecertificationDate' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines service line date information certification revision or recertification date',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceLineDateInformation.beginTherapyDate' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines service line date information begin therapy date',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceLineDateInformation.lastCertificationDate' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines service line date information last certification date',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceLineDateInformation.treatmentOrTherapyDate' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines service line date information treatment or therapy date',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceLineDateInformation.hemoglobinTestDate' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines service line date information hemoglobin test date',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceLineDateInformation.serumCreatineTestDate' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines service line date information serum creatine test date',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceLineDateInformation.shippedDate' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines service line date information shipped date',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceLineDateInformation.lastXRayDate' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines service line date information last x ray date',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceLineDateInformation.initialTreatmentDate' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines service line date information initial treatment date',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.ambulancePatientCount' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ambulatory patient count',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.obstetricAnesthesiaAdditionalUnits' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines obstetric anesthesia additional units',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.testResults.measurementReferenceIdentificationCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines test results measurement reference identification code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.testResults.measurementQualifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines test results measurement qualifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.testResults.testResults' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines test results test results',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.contractInformation.contractTypeCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines contract information contract type code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.contractInformation.contractAmount' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines contract information contract amount',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.contractInformation.contractPercentage' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines contract information contract percentage',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.contractInformation.contractCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines contract information contract code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.contractInformation.termsDiscountPercentage' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines contract information terms discount percentage',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.contractInformation.contractVersionIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines contract information contract version identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceLineReferenceInformation.repricedLineItemReferenceNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines reference information repriced line item reference number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceLineReferenceInformation.adjustedRepricedLineItemReferenceNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines reference information adjusted repriced line item reference number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceLineReferenceInformation.priorAuthorization.priorAuthorizationOrReferralNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines reference information prior authorization or referral number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceLineReferenceInformation.priorAuthorization.otherPayerPrimaryIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines reference information prior authorization other payer primary identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceLineReferenceInformation.mammographyCertificationNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines reference information mammography certification number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceLineReferenceInformation.clinicalLaboratoryImprovementAmendmentNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines reference information clinical laboratory improvement amendment number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceLineReferenceInformation.referringCliaNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines reference information referring clia number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceLineReferenceInformation.immunizationBatchNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines reference information immunization batch number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceLineReferenceInformation.referralNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines reference information referral number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.salesTaxAmount' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines sales tax amount',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.postageTaxAmount' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines postage tax amount',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.fileInformation' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines file information',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.additionalNotes' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines additional notes',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.goalRehabOrDischargePlans' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines goal rehab or discharge plans',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.thirdPartyOrganizationNotes' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines third party organization notes',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceInformation.purchasedServiceProviderIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service information purchased service provider identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceInformation.purchasedServiceChargeAmount' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service information purchased service charge amount',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.linePricingRepricingInformation.pricingMethodologyCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines line pricing repricing information pricing methodology code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.linePricingRepricingInformation.repricedAllowedAmount' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines line pricing repricing information repriced allowed amount',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.linePricingRepricingInformation.repricedSavingAmount' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines line pricing repricing information repriced saving amount',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.linePricingRepricingInformation.repricingOrganizationIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines line pricing repricing information repricing organization identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.linePricingRepricingInformation.repricingPerDiemOrFlatRateAmoung' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines line pricing repricing information repricing per diem or flat rate amoung',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.linePricingRepricingInformation.repricedApprovedAmbulatoryPatientGroupCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines line pricing repricing information repriced approved ambulatory patient group code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.linePricingRepricingInformation.repricedApprovedAmbulatoryPatientGroupAmount' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines line pricing repricing information repriced approved ambulatory patient group amount',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.linePricingRepricingInformation.rejectReasonCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines line pricing repricing information reject reason code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.linePricingRepricingInformation.policyComplianceCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines line pricing repricing information policy compliance code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.linePricingRepricingInformation.exceptionCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines line pricing repricing information exception code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.drugIdentification.serviceIdQualifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines drug identification service id qualifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.drugIdentification.nationalDrugCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines drug identification national drug code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.drugIdentification.nationalDrugUnitCount' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines drug identification national drug unit count',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.drugIdentification.measurementUnitCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines drug identification measurement unit code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.drugIdentification.linkSequenceNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines drug identification link sequence number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.drugIdentification.pharmacyPrescriptionNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines drug identification pharmacy prescription number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.providerType' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider provider type',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.npi' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider npi',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.ssn' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider ssn',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.employerId' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider employer id',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.commercialNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider commercial number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.locationNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider location number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.payerIdentificationNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider payer identification number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.employerIdentificationNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider employer identification number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.claimOfficeNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider claim office number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.naic' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider naic',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.stateLicenseNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider state license number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.providerUpinNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider provider upin number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.taxonomyCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider taxonomy code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.firstName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider first name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.lastName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider last name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.middleName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider middle name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.suffix' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider suffix',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.organizationName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider organization name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.address.address1' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider address 1',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.address.address2' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider address 2',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.address.city' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider city',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.address.state' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider state',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.address.postalCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider postal code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.address.countryCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider country code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.address.countrySubDivisionCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider country sub division code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.contactInformation.name' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider contact information name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.contactInformation.phoneNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider contact information phone number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.contactInformation.faxNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider contact information fax number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.contactInformation.email' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider contact information email',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.contactInformation.phoneExtension' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider contact information phone extension',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.otherIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider other identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.secondaryIdentifier.qualifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider secondary identifier qualifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.secondaryIdentifier.identifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider secondary identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.renderingProvider.secondaryIdentifier.otherIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines rendering provider secondary identifier other identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.providerType' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider provider type',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.npi' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider npi',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.ssn' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider ssn',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.employerId' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider employer id',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.commercialNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider commercial number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.locationNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider location number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.payerIdentificationNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider payer identification number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.employerIdentificationNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider employer identification number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.claimOfficeNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider claim office number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.naic' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider naic',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.stateLicenseNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider state license number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.providerUpinNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider provider upin number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.taxonomyCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider taxonomy code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.firstName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider first name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.lastName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider last name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.middleName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider middle name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.suffix' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider suffix',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.organizationName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider organization name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.address.address1' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider address 1',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.address.address2' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider address 2',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.address.city' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider city',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.address.state' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider state',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.address.postalCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider postal code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.address.countryCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider country code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.address.countrySubDivisionCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider country sub division code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.contactInformation.name' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider contact information name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.contactInformation.phoneNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider contact information phone number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.contactInformation.faxNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider contact information fax number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.contactInformation.email' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider contact information email',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.contactInformation.phoneExtension' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider contact information phone extension',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.otherIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider other identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.secondaryIdentifier.qualifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider secondary identifier qualifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.secondaryIdentifier.identifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider secondary identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.purchasedServiceProvider.secondaryIdentifier.otherIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines purchased service provider secondary identifier other identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceFacilityLocation.organizationName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines service facility location organization name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceFacilityLocation.address.address1' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines service facility location address 1',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceFacilityLocation.address.address2' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines service facility location address 2',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceFacilityLocation.address.city' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines service facility location city',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceFacilityLocation.address.state' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines service facility location state',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceFacilityLocation.address.postalCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines service facility location postal code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceFacilityLocation.address.countryCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines service facility location country code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceFacilityLocation.address.countrySubDivisionCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines service facility location country sub division code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceFacilityLocation.npi' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines service facility location npi',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceFacilityLocation.secondaryIdentifier.qualifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines service facility location secondary identifier qualifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceFacilityLocation.secondaryIdentifier.identifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines service facility location secondary identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceFacilityLocation.secondaryIdentifier.otherIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines service facility location secondary identifier other identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceFacilityLocation.phoneName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines service facility location phone name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceFacilityLocation.phoneNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines service facility location phone number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.serviceFacilityLocation.phoneExtension' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines service facility location phone extension',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.providerType' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider type',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.npi' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider npi',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.ssn' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider ssn',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.employerId' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider employer id',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.commercialNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider commercial number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.locationNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider location number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.payerIdentificationNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider payer identification number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.employerIdentificationNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider employer identification number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.claimOfficeNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider claim office number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.naic' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider naic',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.stateLicenseNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider state license number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.providerUpinNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider provider upin number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.taxonomyCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider taxonomy code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.firstName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider first name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.lastName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider last name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.middleName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider middle name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.suffix' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider suffix',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.organizationName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider organization name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.address.address1' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider address 1',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.address.address2' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider address 2',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.address.city' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider city',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.address.state' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider state',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.address.postalCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider postal code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.address.countryCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider country code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.address.countrySubDivisionCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider country sub division code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.contactInformation.name' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider contact information name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.contactInformation.phoneNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider contact information phone number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.contactInformation.faxNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider contact information fax number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.contactInformation.email' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider contact information email',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.contactInformation.phoneExtension' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider contact information phone extension',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.otherIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider other identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.secondaryIdentifier.qualifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider secondary identifier qualifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.secondaryIdentifier.identifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider secondary identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.supervisingProvider.secondaryIdentifier.otherIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines supervising provider secondary identifier other identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.providerType' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider provider type',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.npi' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider npi',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.ssn' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider ssn',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.employerId' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider employer id',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.commercialNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider commercial number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.locationNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider location number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.payerIdentificationNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider payer identification number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.employerIdentificationNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider employer identification number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.claimOfficeNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider claim office number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.naic' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider naic',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.stateLicenseNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider state license number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.providerUpinNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider provider upin number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.taxonomyCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider taxonomy code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.firstName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider first name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.lastName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider last name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.middleName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider middle name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.suffix' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider suffix',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.organizationName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider organization name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.address.address1' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider address 1',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.address.address2' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider address 2',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.address.city' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider city',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.address.state' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider state',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.address.postalCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider postal code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.address.countryCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider country code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.address.countrySubDivisionCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider country sub division code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.contactInformation.name' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider contact information name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.contactInformation.phoneNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider contact information phone number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.contactInformation.faxNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider contact information fax number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.contactInformation.email' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider contact information email',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.contactInformation.phoneExtension' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider contact information phone extension',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.otherIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider other identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.secondaryIdentifier.qualifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider secondary identifier qualifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.secondaryIdentifier.identifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider secondary identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.orderingProvider.secondaryIdentifier.otherIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ordering provider secondary identifier other identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.providerType' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider provider type',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.npi' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider npi',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.ssn' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider ssn',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.employerId' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider employer id',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.commercialNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider commercial number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.locationNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider location number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.payerIdentificationNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider payer identification number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.employerIdentificationNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider employer identification number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.claimOfficeNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider claim office number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.naic' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider naic',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.stateLicenseNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider state license number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.providerUpinNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider provider upin number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.taxonomyCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider taxonomy code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.firstName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider first name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.lastName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider last name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.middleName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider middle name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.suffix' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider suffix',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.organizationName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider organization name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.address.address1' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider address 1',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.address.address2' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider address 2',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.address.city' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider city',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.address.state' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider state',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.address.postalCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider postal code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.address.countryCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider country code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.address.countrySubDivisionCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider country sub division code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.contactInformation.name' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider contact information name',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.contactInformation.phoneNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider contact information phone number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.contactInformation.faxNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider contact information fax number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.contactInformation.email' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider contact information email',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.contactInformation.phoneExtension' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider contact information phone extension',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.otherIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider other identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.secondaryIdentifier.qualifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider secondary identifier qualifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.secondaryIdentifier.identifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider secondary identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.referringProvider.secondaryIdentifier.otherIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines referring provider secondary identifier other identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.ambulancePickUpLocation.address1' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ambulatory pick up location address 1',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.ambulancePickUpLocation.address2' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ambulatory pick up location address 2',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.ambulancePickUpLocation.city' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ambulatory pick up location city',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.ambulancePickUpLocation.state' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ambulatory pick up location state',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.ambulancePickUpLocation.postalCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ambulatory pick up location postal code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.ambulancePickUpLocation.countryCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ambulatory pick up location country code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.ambulancePickUpLocation.countrySubDivisionCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ambulatory pick up location country sub division code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.ambulanceDropOffLocation.address1' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ambulatory drop off location address 1',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.ambulanceDropOffLocation.address2' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ambulatory drop off location address 2',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.ambulanceDropOffLocation.city' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ambulatory drop off location city',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.ambulanceDropOffLocation.state' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ambulatory drop off location state',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.ambulanceDropOffLocation.postalCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ambulatory drop off location postal code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.ambulanceDropOffLocation.countryCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ambulatory drop off location country code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.ambulanceDropOffLocation.countrySubDivisionCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines ambulatory drop off location country sub division code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.lineAdjudicationInformation.otherPayerPrimaryIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines line adjudication information other payer primary identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.lineAdjudicationInformation.serviceLinePaidAmount' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines line adjudication information service line paid amount',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.lineAdjudicationInformation.serviceIdQualifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines line adjudication information service id qualifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.lineAdjudicationInformation.procedureCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines line adjudication information procedure code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.lineAdjudicationInformation.procedureModifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines line adjudication information procedure modifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.lineAdjudicationInformation.procedureCodeDescription' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines line adjudication information procedure code description',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.lineAdjudicationInformation.paidServiceUnitCount' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines line adjudication information paid service unit count',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.lineAdjudicationInformation.bundledOrUnbundledLineNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines line adjudication information bundled or unbundled line number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.lineAdjudicationInformation.claimAdjustmentInformation.adjustmentGroupCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines line adjudication information claim adjustment information adjustment group code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.lineAdjudicationInformation.claimAdjustmentInformation.adjustmentDetails.adjustmentReasonCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines line adjudication information claim adjustment information adjustment details adjustment reason code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.lineAdjudicationInformation.claimAdjustmentInformation.adjustmentDetails.adjustmentAmount' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines line adjudication information claim adjustment information adjustment details adjustment amount',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.lineAdjudicationInformation.claimAdjustmentInformation.adjustmentDetails.adjustmentQuantity' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines line adjudication information claim adjustment information adjustment details adjustment quantity',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.lineAdjudicationInformation.adjudicationOrPaymentDate' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines line adjudication information adjudication or payment date',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.lineAdjudicationInformation.remainingPatientLiability' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines line adjudication information remaining patient liability',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.formIdentification.formTypeCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines form identification form type code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.formIdentification.formIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines form identification form identifier',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.formIdentification.supportingDocumentation.questionNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines form identification supporting documentation question number',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.formIdentification.supportingDocumentation.questionResponseCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines form identification supporting documentation question response code',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.formIdentification.supportingDocumentation.questionResponse' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines form identification supporting documentation question response',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.formIdentification.supportingDocumentation.questionResponseAsDate' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines form identification supporting documentation question response as date',
        'value' => [],
        'values' => [],
    ],
    'claimInformation.serviceLines.formIdentification.supportingDocumentation.questionResponseAsPercent' => [
        'type' => RuleType::NONE->value,
        'description' => 'Claim information service lines form identification supporting documentation question response as percent',
        'value' => [],
        'values' => [],
    ],
    'payToAddress.address1' => [
        'type' => RuleType::SINGLE->value,
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
    'payToPlan.organizationName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Pay to plan organization name',
        'value' => [],
        'values' => [],
    ],
    'payToPlan.primaryIdentifierTypeCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Pay to plan primary identifier type code',
        'value' => [],
        'values' => [],
    ],
    'payToPlan.primaryIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Pay to plan primary identifier',
        'value' => [],
        'values' => [],
    ],
    'payToPlan.address.address1' => [
        'type' => RuleType::NONE->value,
        'description' => 'Pay to plan address address 1',
        'value' => [],
        'values' => [],
    ],
    'payToPlan.address.address2' => [
        'type' => RuleType::NONE->value,
        'description' => 'Pay to plan address address 2',
        'value' => [],
        'values' => [],
    ],
    'payToPlan.address.city' => [
        'type' => RuleType::NONE->value,
        'description' => 'Pay to plan address city',
        'value' => [],
        'values' => [],
    ],
    'payToPlan.address.state' => [
        'type' => RuleType::NONE->value,
        'description' => 'Pay to plan address state',
        'value' => [],
        'values' => [],
    ],
    'payToPlan.address.postalCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Pay to plan address postal code',
        'value' => [],
        'values' => [],
    ],
    'payToPlan.address.countryCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Pay to plan address country code',
        'value' => [],
        'values' => [],
    ],
    'payToPlan.address.countrySubDivisionCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Pay to plan address country sub division code',
        'value' => [],
        'values' => [],
    ],
    'payToPlan.secondaryIdentifierTypeCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Pay to plan secondary identifier type code',
        'value' => [],
        'values' => [],
    ],
    'payToPlan.secondaryIdentifier' => [
        'type' => RuleType::NONE->value,
        'description' => 'Pay to plan secondary identifier',
        'value' => [],
        'values' => [],
    ],
    'payToPlan.taxIdentificationNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Pay to plan tax identification number',
        'value' => [],
        'values' => [],
    ],
    'payerAddress.address1' => [
        'type' => RuleType::NONE->value,
        'description' => 'Payer address address 1',
        'value' => [],
        'values' => [],
    ],
    'payerAddress.address2' => [
        'type' => RuleType::NONE->value,
        'description' => 'Payer address address 2',
        'value' => [],
        'values' => [],
    ],
    'payerAddress.city' => [
        'type' => RuleType::NONE->value,
        'description' => 'Payer address city',
        'value' => [],
        'values' => [],
    ],
    'payerAddress.state' => [
        'type' => RuleType::NONE->value,
        'description' => 'Payer address state',
        'value' => [],
        'values' => [],
    ],
    'payerAddress.postalCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Payer address postal code',
        'value' => [],
        'values' => [],
    ],
    'payerAddress.countryCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Payer address country code',
        'value' => [],
        'values' => [],
    ],
    'payerAddress.countrySubDivisionCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Payer address country sub division code',
        'value' => [],
        'values' => [],
    ],
    'billing.providerType' => [
        'type' => RuleType::SINGLE->value,
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
        'description' => 'Billing contact information phone extension',
        'value' => [
            'id' => 'claim:claimInformation.patientControlNumber',
            'name' => 'Billing contact information phone extension',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.patientControlNumber',
                    'name' => 'Billing contact information phone extension',
                ],
            ],
        ],
    ],
    'referring.providerType' => [
        'type' => RuleType::SINGLE->value,
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
        'description' => 'Referring contact information phone extension',
        'value' => [
            'id' => 'claim:claimInformation.patientControlNumber',
            'name' => 'Referring contact information phone extension',
        ],
        'values' => [
            'common' => [
                [
                    'id' => 'claim:claimInformation.patientControlNumber',
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
    'ordering.providerType' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering provider type',
        'value' => [],
        'values' => [],
    ],
    'ordering.npi' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering npi',
        'value' => [],
        'values' => [],
    ],
    'ordering.ssn' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering ssn',
        'value' => [],
        'values' => [],
    ],
    'ordering.employerId' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering employerId',
        'value' => [],
        'values' => [],
    ],
    'ordering.commercialNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering commercial number',
        'value' => [],
        'values' => [],
    ],
    'ordering.locationNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering location number',
        'value' => [],
        'values' => [],
    ],
    'ordering.payerIdentificationNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering payer identification number',
        'value' => [],
        'values' => [],
    ],
    'ordering.employerIdentificationNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering employer identification number',
        'value' => [],
        'values' => [],
    ],
    'ordering.claimOfficeNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering claim office number',
        'value' => [],
        'values' => [],
    ],
    'ordering.naic' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering naic',
        'value' => [],
        'values' => [],
    ],
    'ordering.stateLicenseNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering state license number',
        'value' => [],
        'values' => [],
    ],
    'ordering.providerUpinNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering provider upin number',
        'value' => [],
        'values' => [],
    ],
    'ordering.taxonomyCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering taxonomy code',
        'value' => [],
        'values' => [],
    ],
    'ordering.firstName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering first name',
        'value' => [],
        'values' => [],
    ],
    'ordering.lastName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering last name',
        'value' => [],
        'values' => [],
    ],
    'ordering.middleName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering middle name',
        'value' => [],
        'values' => [],
    ],
    'ordering.suffix' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering suffix',
        'value' => [],
        'values' => [],
    ],
    'ordering.organizationName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering organization name',
        'value' => [],
        'values' => [],
    ],
    'ordering.address.address1' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering address address 1',
        'value' => [],
        'values' => [],
    ],
    'ordering.address.address2' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering address address 2',
        'value' => [],
        'values' => [],
    ],
    'ordering.address.city' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering address city',
        'value' => [],
        'values' => [],
    ],
    'ordering.address.state' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering address state',
        'value' => [],
        'values' => [],
    ],
    'ordering.address.postalCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering address postal code',
        'value' => [],
        'values' => [],
    ],
    'ordering.address.countryCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering address country code',
        'value' => [],
        'values' => [],
    ],
    'ordering.address.countrySubDivisionCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering address country sub division code',
        'value' => [],
        'values' => [],
    ],
    'ordering.contactInformation.name' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering contact information name',
        'value' => [],
        'values' => [],
    ],
    'ordering.contactInformation.phoneNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering contact information phone number',
        'value' => [],
        'values' => [],
    ],
    'ordering.contactInformation.faxNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering contact information fax number',
        'value' => [],
        'values' => [],
    ],
    'ordering.contactInformation.email' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering contact information email',
        'value' => [],
        'values' => [],
    ],
    'ordering.contactInformation.phoneExtension' => [
        'type' => RuleType::NONE->value,
        'description' => 'Ordering contact information phone extension',
        'value' => [],
        'values' => [],
    ],
    'supervising.providerType' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising provider type',
        'value' => [],
        'values' => [],
    ],
    'supervising.npi' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising npi',
        'value' => [],
        'values' => [],
    ],
    'supervising.ssn' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising ssn',
        'value' => [],
        'values' => [],
    ],
    'supervising.employerId' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising employerId',
        'value' => [],
        'values' => [],
    ],
    'supervising.commercialNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising commercial number',
        'value' => [],
        'values' => [],
    ],
    'supervising.locationNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising location number',
        'value' => [],
        'values' => [],
    ],
    'supervising.payerIdentificationNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising payer identification number',
        'value' => [],
        'values' => [],
    ],
    'supervising.employerIdentificationNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising employer identification number',
        'value' => [],
        'values' => [],
    ],
    'supervising.claimOfficeNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising claim office number',
        'value' => [],
        'values' => [],
    ],
    'supervising.naic' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising naic',
        'value' => [],
        'values' => [],
    ],
    'supervising.stateLicenseNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising state license number',
        'value' => [],
        'values' => [],
    ],
    'supervising.providerUpinNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising provider upin number',
        'value' => [],
        'values' => [],
    ],
    'supervising.taxonomyCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising taxonomy code',
        'value' => [],
        'values' => [],
    ],
    'supervising.firstName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising first name',
        'value' => [],
        'values' => [],
    ],
    'supervising.lastName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising last name',
        'value' => [],
        'values' => [],
    ],
    'supervising.middleName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising middle name',
        'value' => [],
        'values' => [],
    ],
    'supervising.suffix' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising suffix',
        'value' => [],
        'values' => [],
    ],
    'supervising.organizationName' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising organization name',
        'value' => [],
        'values' => [],
    ],
    'supervising.address.address1' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising address address 1',
        'value' => [],
        'values' => [],
    ],
    'supervising.address.address2' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising address address 2',
        'value' => [],
        'values' => [],
    ],
    'supervising.address.city' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising address city',
        'value' => [],
        'values' => [],
    ],
    'supervising.address.state' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising address state',
        'value' => [],
        'values' => [],
    ],
    'supervising.address.postalCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising address postal code',
        'value' => [],
        'values' => [],
    ],
    'supervising.address.countryCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising address country code',
        'value' => [],
        'values' => [],
    ],
    'supervising.address.countrySubDivisionCode' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising address country sub division code',
        'value' => [],
        'values' => [],
    ],
    'supervising.contactInformation.name' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising contact information name',
        'value' => [],
        'values' => [],
    ],
    'supervising.contactInformation.phoneNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising contact information phone number',
        'value' => [],
        'values' => [],
    ],
    'supervising.contactInformation.faxNumber' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising contact information fax number',
        'value' => [],
        'values' => [],
    ],
    'supervising.contactInformation.email' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising contact information email',
        'value' => [],
        'values' => [],
    ],
    'supervising.contactInformation.phoneExtension' => [
        'type' => RuleType::NONE->value,
        'description' => 'Supervising contact information phone extension',
        'value' => [],
        'values' => [],
    ],
];
