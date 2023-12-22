<?php

declare(strict_types=1);

use App\Enums\Claim\RuleType;

return [
    'controlNumber' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'control number',
        'value' => ['name' => 'claim control number', 'id' => 'claim:controlNumber'],
        'values' => [
            'common' => [
                ['name' => 'claim control number', 'id' => 'claim:controlNumber'],
            ],
        ],
    ],
    'tradingPartnerServiceId' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'trading partner service id',
        'value' => ['name' => 'claim trading partner service id', 'id' => 'claim:tradingPartnerServiceId'],
        'values' => [
            'common' => [
                ['name' => 'claim trading partner service id', 'id' => 'claim:tradingPartnerServiceId'],
            ],
        ],
    ],
    'tradingPartnerName' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'trading partner name',
        'value' => ['name' => 'claim trading partner name', 'id' => 'claim:tradingPartnerName'],
        'values' => [
            'common' => [
                ['name' => 'claim trading partner name', 'id' => 'claim:tradingPartnerName'],
            ],
        ],
    ],
    'usageIndicator' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'usage indicator',
        'value' => ['name' => 'claim usage indicator', 'id' => 'claim:usageIndicator'],
        'values' => [
            'common' => [
                ['name' => 'claim usage indicator', 'id' => 'claim:usageIndicator'],
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
                ['id' => 'claim:submitter.organizationName', 'name' => 'Submitter organization name'],
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
                ['id' => 'claim:submitter.contactInformation.name', 'name' => 'Submitter contact information name'],
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
                ['id' => 'claim:submitter.contactInformation.phoneNumber', 'name' => 'Submitter contact information phone number'],
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
                ['id' => 'claim:submitter.contactInformation.faxNumber', 'name' => 'Submitter contact information fax number'],
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
                ['id' => 'claim:submitter.contactInformation.email', 'name' => 'Submitter contact information email'],
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
                ['id' => 'claim:receiver.organizationName', 'name' => 'Receiver organization name'],
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
                ['id' => 'claim:subscriber.memberId', 'name' => 'Subscriber member ID'],
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
                ['id' => 'claim:subscriber.ssn',  'name' => 'Subscriber ssn'],
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
                ['id' => 'claim:subscriber.paymentResponsibilityLevelCode',  'name' => 'Subscriber payment responsibility level code'],
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
                ['id' => 'claim:subscriber.firstName',  'name' => 'Subscriber first name'],
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
                ['id' => 'claim:subscriber.lastName',  'name' => 'Subscriber last name'],
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
                ['id' => 'claim:subscriber.middleName',  'name' => 'Subscriber middle name'],
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
                ['id' => 'claim:subscriber.suffix',  'name' => 'Subscriber name suffix'],
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
                ['id' => 'claim:subscriber.gender',  'name' => 'Subscriber gender'],
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
                ['id' => 'claim:subscriber.dateOfBirth',  'name' => 'Subscriber date of birth'],
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
                ['id' => 'claim:subscriber.policyNumber',  'name' => 'Subscriber policy number'],
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
                ['id' => 'claim:subscriber.contactInformation.name',  'name' => 'Subscriber contact information name'],
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
                ['id' => 'claim:subscriber.contactInformation.phoneNumber',  'name' => 'Subscriber contact information phone number'],
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
                ['id' => 'claim:subscriber.contactInformation.faxNumber',  'name' => 'Subscriber contact information fax number'],
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
                ['id' => 'claim:subscriber.contactInformation.email',  'name' => 'Subscriber contact information email'],
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
                ['id' => 'claim:subscriber.address.address1',  'name' => 'Subscriber contact information address1'],
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
                ['id' => 'claim:subscriber.address.address2',  'name' => 'Subscriber contact information address2'],
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
                ['id' => 'claim:subscriber.address.city',  'name' => 'Subscriber contact information city'],
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
                ['id' => 'claim:subscriber.address.state',  'name' => 'Subscriber contact information state'],
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
                ['id' => 'claim:subscriber.address.postalCode',  'name' => 'Subscriber contact information postal code'],
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
                ['id' => 'claim:subscriber.address.countryCode',  'name' => 'Subscriber contact information country code'],
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
                ['id' => 'claim:subscriber.address.countrySubDivisionCode',  'name' => 'Subscriber contact information country subdivision code'],
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
                ['id' => 'claim:dependent.firstName',  'name' => 'Dependent first name'],
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
                ['id' => 'claim:dependent.lastName',  'name' => 'Dependent last name'],
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
                ['id' => 'claim:dependent.middleName',  'name' => 'Dependent middle name'],
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
                ['id' => 'claim:dependent.suffix',  'name' => 'Dependent name suffix'],
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
                ['id' => 'claim:dependent.gender',  'name' => 'Dependent gender'],
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
                ['id' => 'claim:dependent.dateOfBirth',  'name' => 'Dependent date of birth'],
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
                ['id' => 'claim:dependent.ssn',  'name' => 'Dependent ssn'],
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
                ['id' => 'claim:dependent.memberId',  'name' => 'Dependent member id'],
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
                ['id' => 'claim:dependent.relationshipToSubscriberCode',  'name' => 'Dependent relationship to subscriber code'],
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
                ['id' => 'claim:dependent.contactInformation.name',  'name' => 'Dependent contact information name'],
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
                ['id' => 'claim:dependent.contactInformation.phoneNumber',  'name' => 'Dependent contact information phone number'],
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
                ['id' => 'claim:dependent.contactInformation.faxNumber',  'name' => 'Dependent contact information fax number'],
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
                ['id' => 'claim:dependent.contactInformation.email',  'name' => 'Dependent contact information email'],
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
                ['id' => 'claim:dependent.address.address1',  'name' => 'Dependent contact information address1'],
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
                ['id' => 'claim:dependent.address.address2',  'name' => 'Dependent contact information address2'],
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
                ['id' => 'claim:dependent.address.city',  'name' => 'Dependent contact information city'],
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
                ['id' => 'claim:dependent.address.state',  'name' => 'Dependent contact information state'],
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
                ['id' => 'claim:dependent.address.postalCode',  'name' => 'Dependent contact information postal code'],
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
                ['id' => 'claim:dependent.address.countryCode',  'name' => 'Dependent contact information country code'],
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
                ['id' => 'claim:dependent.address.countrySubDivisionCode',  'name' => 'Dependent contact information country subdivision code'],
            ],
        ],
    ],
    /*'providers' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claim:providers',
    ],
    'billingPayToPlanName' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claim:billingPayToPlanName',
    ],
    'billingPayToAddressName' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claim:billingPayToAddressName',
    ],
    'operatingPhysician' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claim:operatingPhysician',
    ],
    'otherOperatingPhysician' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claim:otherOperatingPhysician',
    ],*/
    'claimInformation.claimFilingCode' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'Claim information filing code',
        'value' => [
            'id' => 'claim:claimInformation.claimFilingCode',
            'name' => 'Claim information filing code',
        ],
        'values' => [
            'common' => [
                ['id' => 'claim:claimInformation.claimFilingCode',  'name' => 'Claim information filing code'],
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
                ['id' => 'claim:claimInformation.patientControlNumber',  'name' => 'Claim information patient control number'],
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
                ['id' => 'claim:claimInformation.claimChargeAmount',  'name' => 'Claim information claim charge amount'],
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
                ['id' => 'claim:claimInformation.placeOfServiceCode',  'name' => 'Claim information place of service code'],
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
                ['id' => 'claim:claimInformation.claimFrequencyCode',  'name' => 'Claim information claim frequency code'],
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
                ['id' => 'claim:claimInformation.signatureIndicator',  'name' => 'Claim information signature indicator'],
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
                ['id' => 'claim:claimInformation.planParticipationCode',  'name' => 'Claim information plan participation code'],
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
                ['id' => 'claim:claimInformation.benefitsAssignmentCertificationIndicator',  'name' => 'Claim information benefits assignment certification indicator'],
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
                ['id' => 'claim:claimInformation.releaseInformationCode',  'name' => 'Claim information release information code'],
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
                ['id' => 'claim:claimInformation.relatedCausesCode',  'name' => 'Claim information related causes code'],
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
                ['id' => 'claim:claimInformation.autoAccidentStateCode',  'name' => 'Claim information auto accident state code'],
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
                ['id' => 'claim:claimInformation.autoAccidentCountryCode',  'name' => 'Claim information auto accident country code'],
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
    'payToAddress.address1' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'pay to address',
        'value' => ['name' => 'claim pay to address', 'id' => 'claim:payToAddress.address'],
        'values' => [
            'common' => [
                ['name' => 'claim pay to address', 'id' => 'claim:payToAddress.address'],
            ],
        ],
    ],
    'payToAddress.address2' => [
        'type' => RuleType::NONE->value,
        'description' => 'pay to address',
        'value' => null,
        'values' => [
            'common' => [
                ['name' => 'claim pay to address', 'id' => 'claim:payToAddress.address'],
            ],
        ],
    ],
    'payToAddress.city' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'pay to address',
        'value' => ['name' => 'claim pay to address', 'id' => 'claim:payToAddress'],
        'values' => [
            'common' => [
                ['name' => 'claim pay to address', 'id' => 'claim:payToAddress'],
            ],
        ],
    ],
    'payToAddress.state' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'pay to address',
        'value' => ['name' => 'claim pay to address', 'id' => 'claim:payToAddress'],
        'values' => [
            'common' => [
                ['name' => 'claim pay to address', 'id' => 'claim:payToAddress'],
            ],
        ],
    ],
    'payToAddress.postalCode' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'pay to address',
        'value' => ['name' => 'claim pay to address', 'id' => 'claim:payToAddress'],
        'values' => [
            'common' => [
                ['name' => 'claim pay to address', 'id' => 'claim:payToAddress'],
            ],
        ],
    ],
    'payToAddress.countryCode' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'pay to address',
        'value' => ['name' => 'claim pay to address', 'id' => 'claim:payToAddress'],
        'values' => [
            'common' => [
                ['name' => 'claim pay to address', 'id' => 'claim:payToAddress'],
            ],
        ],
    ],
    'payToAddress.countrySubDivisionCode' => [
        'type' => RuleType::SINGLE->value,
        'description' => 'pay to address',
        'value' => ['name' => 'claim pay to address', 'id' => 'claim:payToAddress'],
        'values' => [
            'common' => [
                ['name' => 'claim pay to address', 'id' => 'claim:payToAddress'],
            ],
        ],
    ],
    'billing' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'billing',
        'value' => ['name' => 'claim billing', 'id' => 'claim:billing'],
        'values' => [
            'common' => [
                ['name' => 'claim billing', 'id' => 'claim:billing'],
            ],
        ],
    ],
    'referring' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'referring',
        'value' => ['name' => 'claim referring', 'id' => 'claim:referring'],
        'values' => [
            'common' => [
                ['name' => 'claim referring', 'id' => 'claim:referring'],
            ],
        ],
    ],
    /*'rendering' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'value' => 'claim:rendering',
    ],*/
    'attending' => [
        'type' => RuleType::SINGLE_ARRAY->value,
        'description' => 'attending',
        'value' => ['name' => 'claim attending', 'id' => 'claim:attending'],
        'values' => [
            'common' => [
                ['name' => 'claim attending', 'id' => 'claim:attending'],
            ],
        ],
    ],
];
