<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Address
 *
 * @property int $id
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property int|null $user_id
 * @property int|null $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $clearing_house_id
 * @property int|null $facility_id
 * @property int|null $company_id
 * @property int|null $insurance_company_id
 * @property-read \App\Models\BillingCompany|null $billingCompany
 * @property-read \App\Models\ClearingHouse|null $clearingHouse
 * @property-read \App\Models\Company|null $company
 * @property-read \App\Models\Facility|null $facility
 * @property-read \App\Models\InsuranceCompany|null $insuranceCompany
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address query()
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereClearingHouseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereFacilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereInsuranceCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereZip($value)
 * @property string $addressable_type
 * @property int $addressable_id
 * @property int|null $address_type_id
 * @property string|null $country
 * @property string|null $country_subdivision_code
 * @property-read \App\Models\AddressType|null $addressType
 * @property-read Model|\Eloquent $addressable
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddressTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddressableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddressableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCountrySubdivisionCode($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class Address extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\AddressType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddressType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddressType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddressType query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddressType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddressType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddressType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddressType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class AddressType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Audit
 *
 * @property int $id
 * @property string|null $user_type
 * @property int|null $user_id
 * @property string $event
 * @property string $auditable_type
 * @property int $auditable_id
 * @property array|null $old_values
 * @property array|null $new_values
 * @property string|null $url
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property string|null $tags
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $auditable
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $user
 * @method static \Illuminate\Database\Eloquent\Builder|Audit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Audit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Audit query()
 * @method static \Illuminate\Database\Eloquent\Builder|Audit searchAudit($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit sortAudit($orderBy, $desc)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereAuditableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereAuditableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereEvent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereNewValues($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereOldValues($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereUserType($value)
 * @mixin \Eloquent
 */
	class Audit extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BillingCompany.
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $code
 * @property bool $status
 * @property \App\Models\Address|null $address
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\ClearingHouse[] $clearingHouses
 * @property int|null $clearing_houses_count
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Company[] $companies
 * @property int|null $companies_count
 * @property \App\Models\Contact|null $contact
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Facility[] $facilities
 * @property int|null $facilities_count
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\InsuranceCompany[] $insuranceCompany
 * @property int|null $insurance_company_count
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany query()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany whereUpdatedAt($value)
 * @property string|null $logo
 * @property string|null $abbreviation
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property int|null $addresses_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property int|null $contacts_count
 * @property mixed $last_modified
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @property int|null $health_professionals_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsuranceCompany> $insuranceCompanies
 * @property int|null $insurance_companies_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property int|null $insurance_plans_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestriction> $ipRestrictions
 * @property int|null $ip_restrictions_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\KeyboardShortcut> $keyboardShortcuts
 * @property int|null $keyboard_shortcuts_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Patient> $patients
 * @property int|null $patients_count
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany whereAbbreviation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany whereLogo($value)
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsuranceCompany> $insuranceCompanies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestriction> $ipRestrictions
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\KeyboardShortcut> $keyboardShortcuts
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Patient> $patients
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsuranceCompany> $insuranceCompanies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestriction> $ipRestrictions
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\KeyboardShortcut> $keyboardShortcuts
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Patient> $patients
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsuranceCompany> $insuranceCompanies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestriction> $ipRestrictions
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\KeyboardShortcut> $keyboardShortcuts
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Patient> $patients
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CustomShortcuts> $customKeyboardShortcuts
 * @property-read int|null $custom_keyboard_shortcuts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsuranceCompany> $insuranceCompanies
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestriction> $ipRestrictions
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Patient> $patients
 */
	class BillingCompany extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Claim.
 *
 * @property int $id
 * @property string|null $qr_claim
 * @property string|null $control_number
 * @property string|null $submitter_name
 * @property string|null $submitter_contact
 * @property string|null $submitter_phone
 * @property int|null $company_id
 * @property int|null $facility_id
 * @property int|null $patient_id
 * @property string|null $claim_formattable_type
 * @property int|null $claim_formattable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $validate
 * @property bool $automatic_eligibility
 * @property int|null $billing_provider_id
 * @property int|null $service_provider_id
 * @property int|null $referred_id
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\HealthProfessional|null $billingProvider
 * @property Model|\Eloquent $claimFormattable
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimStatusClaim> $claimStatusClaims
 * @property int|null $claim_status_claims_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimTransmissionResponse> $claimTransmissionResponses
 * @property int|null $claim_transmission_responses_count
 * @property \App\Models\Company|null $company
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Diagnosis> $diagnoses
 * @property int|null $diagnoses_count
 * @property \App\Models\Facility|null $facility
 * @property mixed $amount_paid
 * @property mixed $billed_amount
 * @property Attribute $billing_provider_name
 * @property mixed $date_of_service
 * @property Attribute $format
 * @property Attribute $insurance_company_id
 * @property mixed $last_modified
 * @property mixed $past_due_date
 * @property Attribute $private_note
 * @property Attribute $status
 * @property mixed $status_date
 * @property Attribute $status_history
 * @property Attribute $user_created
 * @property \App\Models\InsuranceCompany|null $insuranceCompany
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePolicy> $insurancePolicies
 * @property int|null $insurance_policies_count
 * @property \App\Models\Patient|null $patient
 * @property \App\Models\HealthProfessional|null $referred
 * @property \App\Models\HealthProfessional|null $serviceProvider
 * @method static \Illuminate\Database\Eloquent\Builder|Claim newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Claim newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Claim query()
 * @method static \Illuminate\Database\Eloquent\Builder|Claim search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereAutomaticEligibility($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereBillingProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereClaimFormattableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereClaimFormattableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereControlNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereFacilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereQrClaim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereReferredId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereServiceProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereSubmitterContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereSubmitterName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereSubmitterPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereValidate($value)
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimStatusClaim> $claimStatusClaims
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimTransmissionResponse> $claimTransmissionResponses
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Diagnosis> $diagnoses
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePolicy> $insurancePolicies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimStatusClaim> $claimStatusClaims
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimTransmissionResponse> $claimTransmissionResponses
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Diagnosis> $diagnoses
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePolicy> $insurancePolicies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimStatusClaim> $claimStatusClaims
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimTransmissionResponse> $claimTransmissionResponses
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Diagnosis> $diagnoses
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePolicy> $insurancePolicies
 * @mixin \Eloquent
 * @property int|null $referred_provider_role_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimStatusClaim> $claimStatusClaims
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimTransmissionResponse> $claimTransmissionResponses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Diagnosis> $diagnoses
 * @property-read \Illuminate\Database\Eloquent\Casts\Attribute $insurance_company
 * @property-read \Illuminate\Database\Eloquent\Casts\Attribute $insurance_plan
 * @property-read mixed $notes_history
 * @property-read \Illuminate\Database\Eloquent\Casts\Attribute $type_responsibility
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePolicy> $insurancePolicies
 * @property-read \App\Models\TypeCatalog|null $referredProviderRole
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereReferredProviderRoleId($value)
 */
	class Claim extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ClaimBatch
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $shipping_date
 * @property bool $fake_transmission
 * @property int $company_id
 * @property int|null $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $claims_reconciled
 * @property int|null $claim_batch_status_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\BillingCompany|null $billingCompany
 * @property-read \App\Models\ClaimBatchStatus|null $claimBatchStatus
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claim> $claims
 * @property-read int|null $claims_count
 * @property-read \App\Models\Company $company
 * @property-read mixed $last_modified
 * @property-read mixed $total_accepted
 * @property-read mixed $total_accepted_by_clearing_house
 * @property-read mixed $total_accepted_by_payer
 * @property-read mixed $total_claims
 * @property-read mixed $total_denied
 * @property-read mixed $total_denied_by_clearing_house
 * @property-read mixed $total_denied_by_payer
 * @property-read mixed $total_processed
 * @property-read mixed $claim_ids
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch whereClaimBatchStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch whereClaimsReconciled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch whereFakeTransmission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch whereShippingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claim> $claims
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claim> $claims
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claim> $claims
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claim> $claims
 */
	class ClaimBatch extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ClaimBatchStatus
 *
 * @property int $id
 * @property string $status
 * @property string $background_color
 * @property string $font_color
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimBatch> $claimBatches
 * @property-read int|null $claim_batches_count
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatchStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatchStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatchStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatchStatus whereBackgroundColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatchStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatchStatus whereFontColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatchStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatchStatus whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatchStatus whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimBatch> $claimBatches
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimBatch> $claimBatches
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimBatch> $claimBatches
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimBatch> $claimBatches
 */
	class ClaimBatchStatus extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ClaimCheckStatus
 *
 * @property int $id
 * @property string|null $response_details
 * @property string|null $interface_type
 * @property string|null $interface
 * @property string|null $consultation_date
 * @property string|null $resolution_time
 * @property string|null $past_due_date
 * @property int $private_note_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\PrivateNote $privateNote
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCheckStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCheckStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCheckStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCheckStatus whereConsultationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCheckStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCheckStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCheckStatus whereInterface($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCheckStatus whereInterfaceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCheckStatus wherePastDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCheckStatus wherePrivateNoteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCheckStatus whereResolutionTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCheckStatus whereResponseDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCheckStatus whereUpdatedAt($value)
 */
	final class ClaimCheckStatus extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ClaimDateInformation
 *
 * @property int $id
 * @property string|null $from_date_or_current
 * @property string|null $to_date
 * @property string|null $description
 * @property int|null $field_id
 * @property int|null $qualifier_id
 * @property int $physician_or_supplier_information_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\TypeCatalog|null $field
 * @property-read \App\Models\PhysicianOrSupplierInformation $physicianOrSupplierInformation
 * @property-read \App\Models\TypeCatalog|null $qualifier
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDateInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDateInformation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDateInformation query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDateInformation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDateInformation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDateInformation whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDateInformation whereFromDateOrCurrent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDateInformation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDateInformation wherePhysicianOrSupplierInformationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDateInformation whereQualifierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDateInformation whereToDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDateInformation whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class ClaimDateInformation extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ClaimEligibility
 *
 * @property int $id
 * @property string $control_number
 * @property int $patient_id
 * @property int $company_id
 * @property int|null $subscriber_id
 * @property int $insurance_policy_id
 * @property int $insurance_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array|null $response_details
 * @property int|null $claim_id
 * @property int|null $claim_eligibility_status_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ClaimEligibilityStatus|null $claimEligibilityStatus
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\InsuranceCompany $insuranceCompany
 * @property-read \App\Models\Patient $patient
 * @property-read \App\Models\Subscriber|null $subscriber
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility whereClaimEligibilityStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility whereClaimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility whereControlNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility whereInsuranceCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility whereInsurancePolicyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility whereResponseDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility whereSubscriberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class ClaimEligibility extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ClaimEligibilityBenefitsInformation
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property array|null $service_type_codes
 * @property array|null $service_types
 * @property string|null $insurance_type_code
 * @property string|null $insurance_type
 * @property string|null $time_qualifer_code
 * @property string|null $time_qualifer
 * @property string|null $benefit_amount
 * @property array|null $benefits_date_information
 * @property array|null $additional_information
 * @property int $claim_eligibility_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ClaimEligibility $claimEligibility
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereAdditionalInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereBenefitAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereBenefitsDateInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereClaimEligibilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereInsuranceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereInsuranceTypeCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereServiceTypeCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereServiceTypes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereTimeQualifer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereTimeQualiferCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class ClaimEligibilityBenefitsInformation extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ClaimEligibilityBenefitsInformationOther
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $service_type_codes
 * @property string $service_types
 * @property string $insurance_type_code
 * @property string $insurance_type
 * @property string $header_loop_identifier_code
 * @property string $trailer_loop_identifier_code
 * @property string $plan_number
 * @property string $plan_network_id_number
 * @property string $benefits_date_information
 * @property string $entity_identifier
 * @property string $entity_type
 * @property string $entity_name
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $postal_code
 * @property string $communication_mode
 * @property string $communication_number
 * @property int $claim_eligibility_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ClaimEligibility $claimEligibility
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereBenefitsDateInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereClaimEligibilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereCommunicationMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereCommunicationNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereEntityIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereEntityName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereHeaderLoopIdentifierCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereInsuranceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereInsuranceTypeCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther wherePlanNetworkIdNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther wherePlanNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereServiceTypeCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereServiceTypes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereTrailerLoopIdentifierCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class ClaimEligibilityBenefitsInformationOther extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ClaimEligibilityPayer
 *
 * @property int $id
 * @property string $name
 * @property string $entity_type
 * @property string $entity_identifier
 * @property int $claim_eligibility_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ClaimEligibility $claimEligibility
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPayer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPayer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPayer query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPayer whereClaimEligibilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPayer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPayer whereEntityIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPayer whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPayer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPayer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPayer whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class ClaimEligibilityPayer extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ClaimEligibilityPlanStatus
 *
 * @property int $id
 * @property string $status_code
 * @property string $status
 * @property int $claim_eligibility_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read int|null $claim_eligibilities_count
 * @property-read \App\Models\ClaimEligibility $claimEligibility
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPlanStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPlanStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPlanStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPlanStatus whereClaimEligibilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPlanStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPlanStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPlanStatus whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPlanStatus whereStatusCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPlanStatus whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 */
	class ClaimEligibilityPlanStatus extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ClaimEligibilityStatus
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $status
 * @property string|null $background_color
 * @property string|null $font_color
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read int|null $claim_eligibilities_count
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityStatus whereBackgroundColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityStatus whereFontColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityStatus whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityStatus whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 */
	class ClaimEligibilityStatus extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ClaimEligibilityTraceNumber
 *
 * @property int $id
 * @property string $trace_type_code
 * @property string $trace_type
 * @property string $reference_identification
 * @property string $originating_company_identifier
 * @property int $claim_eligibility_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ClaimEligibility $claimEligibility
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityTraceNumber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityTraceNumber newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityTraceNumber query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityTraceNumber whereClaimEligibilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityTraceNumber whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityTraceNumber whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityTraceNumber whereOriginatingCompanyIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityTraceNumber whereReferenceIdentification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityTraceNumber whereTraceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityTraceNumber whereTraceTypeCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityTraceNumber whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class ClaimEligibilityTraceNumber extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ClaimFormI
 *
 * @property int $id
 * @property string $type_of_bill
 * @property string $federal_tax_number
 * @property string|null $start_date_service
 * @property string|null $end_date_service
 * @property string|null $admission_date
 * @property int|null $admission_hour
 * @property string $type_of_admission
 * @property string $source_admission
 * @property int|null $discharge_hour
 * @property int|null $patient_discharge_stat
 * @property int|null $admit_dx
 * @property int $type_form_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIConditionCode> $claimFormIConditionCodes
 * @property-read int|null $claim_form_i_condition_codes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIOccurrence> $claimFormIOccurrences
 * @property-read int|null $claim_form_i_occurrences_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIRevenue> $claimFormIRevenues
 * @property-read int|null $claim_form_i_revenues_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormITreatmentAuthorizationCode> $claimFormITreatmentAuthorizationCodes
 * @property-read int|null $claim_form_i_treatment_authorization_codes_count
 * @property-read ClaimFormI $typeForm
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI whereAdmissionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI whereAdmissionHour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI whereAdmitDx($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI whereDischargeHour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI whereEndDateService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI whereFederalTaxNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI wherePatientDischargeStat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI whereSourceAdmission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI whereStartDateService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI whereTypeFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI whereTypeOfAdmission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI whereTypeOfBill($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormICodeAmount> $claimFormICodeAmounts
 * @property-read int|null $claim_form_i_code_amounts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIConditionCode> $claimFormIConditionCodes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIOccurrence> $claimFormIOccurrences
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIRevenue> $claimFormIRevenues
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormITreatmentAuthorizationCode> $claimFormITreatmentAuthorizationCodes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormICodeAmount> $claimFormICodeAmounts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIConditionCode> $claimFormIConditionCodes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIOccurrence> $claimFormIOccurrences
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIRevenue> $claimFormIRevenues
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormITreatmentAuthorizationCode> $claimFormITreatmentAuthorizationCodes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormICodeAmount> $claimFormICodeAmounts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIConditionCode> $claimFormIConditionCodes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIOccurrence> $claimFormIOccurrences
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIRevenue> $claimFormIRevenues
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormITreatmentAuthorizationCode> $claimFormITreatmentAuthorizationCodes
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormICodeAmount> $claimFormICodeAmounts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIConditionCode> $claimFormIConditionCodes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIOccurrence> $claimFormIOccurrences
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIRevenue> $claimFormIRevenues
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormITreatmentAuthorizationCode> $claimFormITreatmentAuthorizationCodes
 */
	class ClaimFormI extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ClaimFormICodeAmount
 *
 * @property int $id
 * @property string $code
 * @property string $amount
 * @property int $claim_form_i_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ClaimFormI $claimFormI
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormICodeAmount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormICodeAmount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormICodeAmount query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormICodeAmount whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormICodeAmount whereClaimFormIId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormICodeAmount whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormICodeAmount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormICodeAmount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormICodeAmount whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class ClaimFormICodeAmount extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ClaimFormIConditionCode
 *
 * @property int $id
 * @property string $code
 * @property int $claim_form_i_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ClaimFormI $claimFormI
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIConditionCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIConditionCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIConditionCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIConditionCode whereClaimFormIId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIConditionCode whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIConditionCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIConditionCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIConditionCode whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class ClaimFormIConditionCode extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ClaimFormIOccurrence
 *
 * @property int $id
 * @property string $date
 * @property string $code
 * @property string $through
 * @property int $claim_form_i_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ClaimFormI $claimFormI
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIOccurrence newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIOccurrence newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIOccurrence query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIOccurrence whereClaimFormIId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIOccurrence whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIOccurrence whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIOccurrence whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIOccurrence whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIOccurrence whereThrough($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIOccurrence whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class ClaimFormIOccurrence extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ClaimFormIRevenue
 *
 * @property int $id
 * @property string $code
 * @property string $description
 * @property string $hcpcs
 * @property string $service_date
 * @property string $service_units
 * @property string $total_charges
 * @property string $non_covered_charges
 * @property int $claim_form_i_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ClaimFormI $claimFormI
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue whereClaimFormIId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue whereHcpcs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue whereNonCoveredCharges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue whereServiceDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue whereServiceUnits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue whereTotalCharges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class ClaimFormIRevenue extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ClaimFormITreatmentAuthorizationCode
 *
 * @property int $id
 * @property int $treatment_authorization_code
 * @property int $claim_form_i_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ClaimFormI $claimFormI
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormITreatmentAuthorizationCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormITreatmentAuthorizationCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormITreatmentAuthorizationCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormITreatmentAuthorizationCode whereClaimFormIId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormITreatmentAuthorizationCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormITreatmentAuthorizationCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormITreatmentAuthorizationCode whereTreatmentAuthorizationCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormITreatmentAuthorizationCode whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class ClaimFormITreatmentAuthorizationCode extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ClaimFormP
 *
 * @property int $id
 * @property bool $head_benefit_plan_other
 * @property string|null $date_of_current
 * @property string|null $total_charge
 * @property int|null $type_form_id
 * @property int|null $type_insurance_id
 * @property int|null $relationship_to_insured_id
 * @property int|null $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\BillingCompany|null $billingCompany
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormPService> $claimFormServices
 * @property-read int|null $claim_form_services_count
 * @property-read \App\Models\Facility $facility
 * @property-read \App\Models\InsurancePolicy $insurancePolicy
 * @property-read \App\Models\Patient $patient
 * @property-read \App\Models\PatientOrInsuredInformation|null $patientOrInsuredInformation
 * @property-read \App\Models\PhysicianOrSupplierInformation|null $physicianOrSupplierInformation
 * @property-read \App\Models\RelationshipToInsured|null $relationshipToInsured
 * @property-read \App\Models\TypeForm|null $typeForm
 * @property-read \App\Models\TypeInsurance|null $typeInsurance
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormP newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormP newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormP query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormP whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormP whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormP whereDateOfCurrent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormP whereHeadBenefitPlanOther($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormP whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormP whereRelationshipToInsuredId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormP whereTotalCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormP whereTypeFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormP whereTypeInsuranceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormP whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormPService> $claimFormServices
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormPService> $claimFormServices
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormPService> $claimFormServices
 */
	class ClaimFormP extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ClaimFormPService
 *
 * @property int $id
 * @property string|null $from_service
 * @property string|null $to_service
 * @property string|null $price
 * @property array|null $diagnostic_pointers
 * @property int $claim_form_p_id
 * @property int|null $procedure_id
 * @property int|null $place_of_service_id
 * @property int|null $type_of_service_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array|null $modifier_ids
 * @property string|null $days_or_units
 * @property string|null $copay
 * @property bool $emg
 * @property int|null $epsdt_id
 * @property int|null $family_planning_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ClaimFormP $claimFormP
 * @property-read \App\Models\TypeCatalog|null $epsdt
 * @property-read \App\Models\TypeCatalog|null $familyPlanning
 * @property-read mixed $modifiers
 * @property-read \App\Models\PlaceOfService|null $placeOfService
 * @property-read \App\Models\Procedure|null $procedure
 * @property-read \App\Models\TypeOfService|null $typeOfService
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereClaimFormPId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereCopay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereDaysOrUnits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereDiagnosticPointers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereEmg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereEpsdtId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereFamilyPlanningId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereFromService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereModifierIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService wherePlaceOfServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereProcedureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereToService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereTypeOfServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class ClaimFormPService extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ClaimServiceLine
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Claim $claim
 * @property-read \App\Models\PlaceOfService $placeOfService
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimServiceLine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimServiceLine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimServiceLine query()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class ClaimServiceLine extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ClaimStatus
 *
 * @property int $id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $background_color
 * @property string|null $font_color
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimStatusClaim> $claimStatusClaims
 * @property-read int|null $claim_status_claims_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimSubStatus> $claimSubStatuses
 * @property-read int|null $claim_sub_statuses_count
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus whereBackgroundColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus whereFontColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimStatusClaim> $claimStatusClaims
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimSubStatus> $claimSubStatuses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimStatusClaim> $claimStatusClaims
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimSubStatus> $claimSubStatuses
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimStatusClaim> $claimStatusClaims
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimSubStatus> $claimSubStatuses
 */
	class ClaimStatus extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClaimStatusClaim
 *
 * @property int $id
 * @property int $claim_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $claim_status_type
 * @property int|null $claim_status_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Claim $claim
 * @property-read Model|\Eloquent $claimStatus
 * @property-read mixed $last_modified
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property-read int|null $private_notes_count
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusClaim newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusClaim newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusClaim query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusClaim whereClaimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusClaim whereClaimStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusClaim whereClaimStatusType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusClaim whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusClaim whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusClaim whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimCheckStatus> $claimCheckStatus
 * @property-read int|null $claim_check_status_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 */
	class ClaimStatusClaim extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ClaimStatusMedical
 *
 * @property int $id
 * @property string $control_number
 * @property int $company_id
 * @property int $subscriber_id
 * @property int $insurance_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\InsuranceCompany $insuranceCompany
 * @property-read \App\Models\Subscriber $subscriber
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusMedical newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusMedical newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusMedical query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusMedical whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusMedical whereControlNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusMedical whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusMedical whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusMedical whereInsuranceCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusMedical whereSubscriberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusMedical whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class ClaimStatusMedical extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ClaimSubStatus
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property-read int|null $billing_companies_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimStatus> $claimStatuses
 * @property-read int|null $claim_statuses_count
 * @property-read mixed $last_modified
 * @property-read mixed $specific_billing_company
 * @property-read mixed $status
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimSubStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimSubStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimSubStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimSubStatus search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimSubStatus whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimSubStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimSubStatus whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimSubStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimSubStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimSubStatus whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimStatus> $claimStatuses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimStatus> $claimStatuses
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimStatus> $claimStatuses
 */
	class ClaimSubStatus extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ClaimTransmissionResponse
 *
 * @property int $id
 * @property array|null $response_details
 * @property int|null $claim_id
 * @property int|null $claim_batch_id
 * @property int|null $claim_transmission_status_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Claim|null $claim
 * @property-read \App\Models\ClaimTransmissionStatus|null $claimTransmissionStatus
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionResponse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionResponse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionResponse query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionResponse whereClaimBatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionResponse whereClaimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionResponse whereClaimTransmissionStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionResponse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionResponse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionResponse whereResponseDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionResponse whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class ClaimTransmissionResponse extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ClaimTransmissionStatus
 *
 * @property int $id
 * @property string $status
 * @property string $background_color
 * @property string $font_color
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimTransmissionResponse> $ClaimTransmissionResponses
 * @property-read int|null $claim_transmission_responses_count
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionStatus whereBackgroundColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionStatus whereFontColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionStatus whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionStatus whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimTransmissionResponse> $ClaimTransmissionResponses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimTransmissionResponse> $ClaimTransmissionResponses
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimTransmissionResponse> $ClaimTransmissionResponses
 */
	class ClaimTransmissionStatus extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClaimValidation
 *
 * @property int $id
 * @property string $control_number
 * @property array|null $response_details
 * @property int $claim_id
 * @property int $insurance_policy_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Claim $claim
 * @property-read \App\Models\InsurancePolicy $insurancePolicy
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimValidation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimValidation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimValidation query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimValidation whereClaimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimValidation whereControlNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimValidation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimValidation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimValidation whereInsurancePolicyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimValidation whereResponseDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimValidation whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class ClaimValidation extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ClearingHouse
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Address|null $address
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BillingCompany[] $billingCompanies
 * @property-read int|null $billing_companies_count
 * @property-read \App\Models\Contact|null $contact
 * @property-read string $status
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereUpdatedAt($value)
 * @property int|null $org_type_id
 * @property int|null $transmission_format_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property-read int|null $abbreviations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property-read int|null $addresses_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read int|null $contacts_count
 * @property-read mixed $last_modified
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property-read int|null $nicknames_count
 * @property-read \App\Models\TypeCatalog|null $orgType
 * @property-read \App\Models\TypeCatalog|null $transmissionFormat
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereOrgTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereTransmissionFormatId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 */
	class ClearingHouse extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Company.
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $npi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $email
 * @property int $tax_id
 * @property \App\Models\Address|null $address
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\BillingCompany[] $billingCompanies
 * @property int|null $billing_companies_count
 * @property \App\Models\Contact|null $contact
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Facility[] $facilities
 * @property int|null $facilities_count
 * @property mixed $status
 * @method static \Illuminate\Database\Eloquent\Builder|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereNpi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereTaxId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUpdatedAt($value)
 * @property string|null $ein
 * @property string|null $upin
 * @property string|null $clia
 * @property int|null $name_suffix_id
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property int|null $abbreviations_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property int|null $addresses_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property int|null $claim_eligibilities_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompanyStatement> $companyStatements
 * @property int|null $company_statements_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property int|null $contacts_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ExceptionInsuranceCompany> $exceptionInsuranceCompanies
 * @property int|null $exception_insurance_companies_count
 * @property mixed $edit_name
 * @property mixed $last_modified
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @property int|null $health_professionals_count
 * @property \App\Models\TypeCatalog|null $nameSuffix
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property int|null $nicknames_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Patient> $patients
 * @property int|null $patients_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property int|null $private_notes_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property int|null $procedures_count
 * @property \App\Models\PublicNote|null $publicNote
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Service> $services
 * @property int|null $services_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Taxonomy> $taxonomies
 * @property int|null $taxonomies_count
 * @method static \Illuminate\Database\Eloquent\Builder|Company search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereClia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereEin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereNameSuffixId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUpin($value)
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompanyStatement> $companyStatements
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ExceptionInsuranceCompany> $exceptionInsuranceCompanies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Patient> $patients
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Service> $services
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Taxonomy> $taxonomies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompanyStatement> $companyStatements
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Copay> $copays
 * @property int|null $copays_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ExceptionInsuranceCompany> $exceptionInsuranceCompanies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Patient> $patients
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Service> $services
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Taxonomy> $taxonomies
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompanyStatement> $companyStatements
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContractFee> $contracFees
 * @property-read int|null $contrac_fees_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Copay> $copays
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ExceptionInsuranceCompany> $exceptionInsuranceCompanies
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Patient> $patients
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Service> $services
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Taxonomy> $taxonomies
 */
	final class Company extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\CompanyHealthProfessional.
 *
 * @property int $id
 * @property int $company_id
 * @property int $health_professional_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array|null $authorization
 * @property int|null $billing_company_id
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessional newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessional newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessional query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessional whereAuthorization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessional whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessional whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessional whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessional whereHealthProfessionalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessional whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessional whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\BillingCompany|null $billingCompany
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\HealthProfessional $healthProfessional
 */
	class CompanyHealthProfessional extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CompanyHealthProfessionalType
 *
 * @property int $id
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessionalType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessionalType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessionalType query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessionalType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessionalType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessionalType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessionalType whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class CompanyHealthProfessionalType extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\CondoMembership.
 *
 * @property mixed $roles
 * @method static \Illuminate\Database\Eloquent\Builder|CondoMembership newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CondoMembership newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CondoMembership query()
 * @property int $id
 * @property int $company_id
 * @property int $procedure_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float|null $price
 * @property float|null $price_percentage
 * @property int|null $insurance_label_fee_id
 * @property int|null $billing_company_id
 * @property int|null $modifier_id
 * @property int|null $mac_locality_id
 * @property string|null $clia
 * @property Collection<int, \App\Models\Medication> $medications
 * @property int|null $medications_count
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyProcedure whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyProcedure whereClia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyProcedure whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyProcedure whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyProcedure whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyProcedure whereInsuranceLabelFeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyProcedure whereMacLocalityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyProcedure whereModifierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyProcedure wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyProcedure wherePricePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyProcedure whereProcedureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyProcedure whereUpdatedAt($value)
 * @property \App\Models\Company|null $billingCompany
 * @property \App\Models\MacLocality $mac_locality
 * @property Collection<int, \App\Models\Medication> $medications
 * @property \App\Models\MacLocality|null $macLocality
 * @property \App\Models\Procedure|null $procedure
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Medication> $medications
 */
	final class CompanyProcedure extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CompanyStatement.
 *
 * @property int $id
 * @property int|null $rule_id
 * @property int|null $when_id
 * @property string|null $start_date
 * @property string|null $end_date
 * @property int $company_id
 * @property int $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array|null $apply_to_ids
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\Company $company
 * @property \App\Models\TypeCatalog|null $rule
 * @property \App\Models\TypeCatalog|null $when
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatement query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatement whereApplyToIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatement whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatement whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatement whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatement whereRuleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatement whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatement whereWhenId($value)
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \App\Models\BillingCompany $billingCompany
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class CompanyStatement extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Contact.
 *
 * @property int $id
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property int|null $user_id
 * @property int|null $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $clearing_house_id
 * @property int|null $facility_id
 * @property int|null $company_id
 * @property int|null $insurance_company_id
 * @property \App\Models\BillingCompany|null $billingCompany
 * @property \App\Models\ClearingHouse|null $clearingHouse
 * @property \App\Models\Company|null $company
 * @property \App\Models\Facility|null $facility
 * @property \App\Models\InsuranceCompany|null $insuranceCompany
 * @property \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereClearingHouseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereFacilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereFax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereInsuranceCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUserId($value)
 * @property string|null $mobile
 * @property string $contactable_type
 * @property int $contactable_id
 * @property string|null $contact_name
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property Model|\Eloquent $contactable
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereContactName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereContactableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereContactableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereMobile($value)
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class Contact extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ContractFee.
 *
 * @property int $id
 * @property int|null $company_id
 * @property int|null $modifier_id
 * @property int|null $mac_locality_id
 * @property int|null $insurance_plan_id
 * @property int|null $billing_company_id
 * @property int|null $insurance_label_fee_id
 * @property int|null $contract_fee_type_id
 * @property string $start_date
 * @property string $end_date
 * @property string|null $price
 * @property string|null $price_percentage
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \App\Models\Company|null $company
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property int|null $procedures_count
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereContractFeeTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereInsuranceLabelFeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereInsurancePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereMacLocalityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereModifierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee wherePricePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $insurance_company_id
 * @property string|null $private_note
 * @property-read \App\Models\InsuranceCompany|null $insuranceCompany
 * @property-read \App\Models\MacLocality|null $macLocality
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Modifier> $modifiers
 * @property-read int|null $modifiers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Patient> $patiens
 * @property-read int|null $patiens_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereInsuranceCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee wherePrivateNote($value)
 */
	final class ContractFee extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ContractFeePatient
 *
 * @property int $id
 * @property int|null $patient_id
 * @property int|null $contract_fee_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $start_date
 * @property string|null $end_date
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeePatient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeePatient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeePatient query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeePatient whereContractFeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeePatient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeePatient whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeePatient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeePatient wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeePatient whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeePatient whereUpdatedAt($value)
 */
	final class ContractFeePatient extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Copay.
 *
 * @todo compleate model structure
 * @property int $id
 * @property int|null $billing_company_id
 * @property int|null $insurance_plan_id
 * @property int|null $company_id
 * @property string|null $copay
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\Company|null $company
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property int|null $procedures_count
 * @method static \Illuminate\Database\Eloquent\Builder|Copay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Copay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Copay query()
 * @method static \Illuminate\Database\Eloquent\Builder|Copay whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Copay whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Copay whereCopay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Copay whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Copay whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Copay whereInsurancePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Copay whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $insurance_company_id
 * @property string|null $private_note
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @method static \Illuminate\Database\Eloquent\Builder|Copay whereInsuranceCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Copay wherePrivateNote($value)
 */
	final class Copay extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Country
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereUpdatedAt($value)
 */
	final class Country extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\CustomShortcuts
 *
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $billingCompany
 * @property-read \App\Models\KeyboardShortcut|null $keyboardShortcut
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $user
 * @method static \Illuminate\Database\Eloquent\Builder|CustomShortcuts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomShortcuts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomShortcuts query()
 */
	final class CustomShortcuts extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Device.
 *
 * @property int $id
 * @property string $ip
 * @property string $os
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $status
 * @property string|null $code_temp
 * @property \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Device newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Device newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Device query()
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereCodeTemp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereOs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereUserId($value)
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property string|null $last_login
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereLastLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereUserAgent($value)
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property string|null $type
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereType($value)
 */
	final class Device extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Diagnosis
 *
 * @property int $id
 * @property string $code
 * @property string $description
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $start_date
 * @property string|null $end_date
 * @property bool $injury_date_required
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read mixed $last_modified
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property-read int|null $procedures_count
 * @property-read \App\Models\PublicNote $publicNote
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis query()
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis whereInjuryDateRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 */
	class Diagnosis extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\DiagnosticPointer
 *
 * @method static \Illuminate\Database\Eloquent\Builder|DiagnosticPointer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiagnosticPointer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiagnosticPointer query()
 * @mixin \Eloquent
 */
	class DiagnosticPointer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Discriminatory
 *
 * @property int $id
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModifierConsideration> $modifierConsiderations
 * @property-read int|null $modifier_considerations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureConsideration> $procedureConsiderations
 * @property-read int|null $procedure_considerations_count
 * @method static \Illuminate\Database\Eloquent\Builder|Discriminatory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discriminatory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discriminatory query()
 * @method static \Illuminate\Database\Eloquent\Builder|Discriminatory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discriminatory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discriminatory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discriminatory whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModifierConsideration> $modifierConsiderations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureConsideration> $procedureConsiderations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModifierConsideration> $modifierConsiderations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureConsideration> $procedureConsiderations
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModifierConsideration> $modifierConsiderations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureConsideration> $procedureConsiderations
 */
	class Discriminatory extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\EligibilityStatus
 *
 * @property int $id
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibilityStatus> $claimEligibilityStatuses
 * @property-read int|null $claim_eligibility_statuses_count
 * @method static \Illuminate\Database\Eloquent\Builder|EligibilityStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EligibilityStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EligibilityStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|EligibilityStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EligibilityStatus whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EligibilityStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EligibilityStatus whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibilityStatus> $claimEligibilityStatuses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibilityStatus> $claimEligibilityStatuses
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibilityStatus> $claimEligibilityStatuses
 */
	class EligibilityStatus extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\EmergencyContact
 *
 * @property int $id
 * @property string $name
 * @property string $cellphone
 * @property string $relationship
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Patient|null $patient
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact query()
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact whereCellphone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact whereRelationship($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact whereUpdatedAt($value)
 * @property int $patient_id
 * @property int|null $relationship_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact whereRelationshipId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property int|null $billing_company_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \App\Models\BillingCompany|null $billingCompany
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact whereBillingCompanyId($value)
 */
	class EmergencyContact extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Employment
 *
 * @property int $id
 * @property string $employer_name
 * @property string $employer_address
 * @property string $employer_phone
 * @property string $position
 * @property int $patient_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Patient $patient
 * @method static \Illuminate\Database\Eloquent\Builder|Employment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Employment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Employment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Employment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employment whereEmployerAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employment whereEmployerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employment whereEmployerPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employment wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employment wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employment whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property int|null $billing_company_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \App\Models\BillingCompany|null $billingCompany
 * @method static \Illuminate\Database\Eloquent\Builder|Employment whereBillingCompanyId($value)
 */
	class Employment extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Encounter
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Facility $facility
 * @property-read \App\Models\HealthProfessional|null $healthProfessionals
 * @property-read \App\Models\Patient $patient
 * @method static \Illuminate\Database\Eloquent\Builder|Encounter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Encounter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Encounter query()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class Encounter extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\EntityAbbreviation
 *
 * @property int $id
 * @property string $abbreviation
 * @property string $abbreviable_type
 * @property int $abbreviable_id
 * @property int $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\BillingCompany $billingCompany
 * @method static \Illuminate\Database\Eloquent\Builder|EntityAbbreviation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EntityAbbreviation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EntityAbbreviation query()
 * @method static \Illuminate\Database\Eloquent\Builder|EntityAbbreviation whereAbbreviableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityAbbreviation whereAbbreviableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityAbbreviation whereAbbreviation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityAbbreviation whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityAbbreviation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityAbbreviation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityAbbreviation whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read Model|\Eloquent $abbreviable
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class EntityAbbreviation extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\EntityNickname
 *
 * @property int $id
 * @property string $nickname
 * @property string $nicknamable_type
 * @property int $nicknamable_id
 * @property int|null $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\BillingCompany|null $billingCompany
 * @method static \Illuminate\Database\Eloquent\Builder|EntityNickname newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EntityNickname newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EntityNickname query()
 * @method static \Illuminate\Database\Eloquent\Builder|EntityNickname whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityNickname whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityNickname whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityNickname whereNicknamableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityNickname whereNicknamableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityNickname whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityNickname whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read Model|\Eloquent $nicknamable
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class EntityNickname extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\EntityTimeFailed
 *
 * @property int $id
 * @property int|null $days
 * @property int|null $from_id
 * @property int $billing_company_id
 * @property string $time_failable_type
 * @property int $time_failable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\BillingCompany $billingCompany
 * @property-read \App\Models\TypeCatalog|null $from
 * @method static \Illuminate\Database\Eloquent\Builder|EntityTimeFailed newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EntityTimeFailed newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EntityTimeFailed query()
 * @method static \Illuminate\Database\Eloquent\Builder|EntityTimeFailed whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityTimeFailed whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityTimeFailed whereDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityTimeFailed whereFromId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityTimeFailed whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityTimeFailed whereTimeFailableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityTimeFailed whereTimeFailableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityTimeFailed whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read Model|\Eloquent $timeFailable
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class EntityTimeFailed extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ExceptionInsuranceCompany
 *
 * @property int $id
 * @property int $company_id
 * @property int $insurance_company_id
 * @property int $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\BillingCompany $billingCompany
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\InsuranceCompany $insuranceCompany
 * @method static \Illuminate\Database\Eloquent\Builder|ExceptionInsuranceCompany newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExceptionInsuranceCompany newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExceptionInsuranceCompany query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExceptionInsuranceCompany whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExceptionInsuranceCompany whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExceptionInsuranceCompany whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExceptionInsuranceCompany whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExceptionInsuranceCompany whereInsuranceCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExceptionInsuranceCompany whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class ExceptionInsuranceCompany extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Facility.
 *
 * @property int $id
 * @property int $type
 * @property string $name
 * @property string $company_name
 * @property string $npi
 * @property string $taxonomy
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $company_id
 * @property \App\Models\Address|null $address
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\BillingCompany[] $billingCompanies
 * @property int|null $billing_companies_count
 * @property \App\Models\Company|null $company
 * @property \App\Models\Contact|null $contact
 * @property mixed $status
 * @method static \Illuminate\Database\Eloquent\Builder|Facility newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Facility newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Facility query()
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereNpi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereTaxonomy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereUpdatedAt($value)
 * @property int $facility_type_id
 * @property string $code
 * @property string|null $nppes_verified_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property int|null $abbreviations_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property int|null $addresses_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property int|null $companies_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property int|null $contacts_count
 * @property \App\Models\FacilityType $facilityType
 * @property mixed $last_modified
 * @property mixed $verified_on_nppes
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @property int|null $health_professionals_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property int|null $nicknames_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlaceOfService> $placeOfServices
 * @property int|null $place_of_services_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Taxonomy> $taxonomies
 * @property int|null $taxonomies_count
 * @method static \Illuminate\Database\Eloquent\Builder|Facility search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereFacilityTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereNppesVerifiedAt($value)
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlaceOfService> $placeOfServices
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Taxonomy> $taxonomies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlaceOfService> $placeOfServices
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Taxonomy> $taxonomies
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlaceOfService> $placeOfServices
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Taxonomy> $taxonomies
 */
	class Facility extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\FacilityType
 *
 * @property int $id
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Facility> $facilities
 * @property-read int|null $facilities_count
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityType query()
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityType whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Facility> $facilities
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Facility> $facilities
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Facility> $facilities
 */
	class FacilityType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FailedLoginAttempt
 *
 * @property int $id
 * @property bool $status
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|FailedLoginAttempt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FailedLoginAttempt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FailedLoginAttempt query()
 * @method static \Illuminate\Database\Eloquent\Builder|FailedLoginAttempt whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FailedLoginAttempt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FailedLoginAttempt whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FailedLoginAttempt whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FailedLoginAttempt whereUserId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class FailedLoginAttempt extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Gender
 *
 * @property int $id
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModifierConsideration> $modifierConsiderations
 * @property-read int|null $modifier_considerations_count
 * @method static \Illuminate\Database\Eloquent\Builder|Gender newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Gender newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Gender query()
 * @method static \Illuminate\Database\Eloquent\Builder|Gender whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gender whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gender whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gender whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModifierConsideration> $modifierConsiderations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModifierConsideration> $modifierConsiderations
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModifierConsideration> $modifierConsiderations
 */
	class Gender extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Guarantor
 *
 * @property int $id
 * @property string $name
 * @property string|null $phone
 * @property int $patient_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Patient $patient
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property int|null $billing_company_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \App\Models\BillingCompany|null $billingCompany
 * @method static \Illuminate\Database\Eloquent\Builder|Guarantor whereBillingCompanyId($value)
 */
	class Guarantor extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\HealthProfessional.
 *
 * @property int $id
 * @property string $npi
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $code
 * @property bool $is_provider
 * @property string|null $npi_company
 * @property int|null $health_professional_type_id
 * @property int|null $company_id
 * @property string|null $nppes_verified_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property int|null $billing_companies_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property int|null $companies_count
 * @property \App\Models\Company|null $company
 * @property mixed $companies_providers
 * @property mixed $last_modified
 * @property mixed $status
 * @property mixed $verified_on_nppes
 * @property \App\Models\HealthProfessionalType|null $healthProfessionalType
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property int|null $private_notes_count
 * @property \App\Models\PublicNote|null $publicNote
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Taxonomy> $taxonomies
 * @property int|null $taxonomies_count
 * @property \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional query()
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereHealthProfessionalTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereIsProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereNpi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereNpiCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereNppesVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereUserId($value)
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Taxonomy> $taxonomies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Taxonomy> $taxonomies
 * @mixin \Eloquent
 * @property string|null $ein
 * @property string|null $upin
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Taxonomy> $taxonomies
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereEin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereUpin($value)
 */
	class HealthProfessional extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\HealthProfessionalType
 *
 * @property int $id
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @property-read int|null $health_professionals_count
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessionalType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessionalType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessionalType query()
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessionalType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessionalType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessionalType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessionalType whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 */
	class HealthProfessionalType extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Injury
 *
 * @property int $id
 * @property string $diag_date
 * @property int $diagnosis_id
 * @property int|null $type_diag_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Diagnosis $diagnosis
 * @property-read \App\Models\PublicNote $publicNote
 * @property-read \App\Models\TypeDiag|null $typeDiag
 * @method static \Illuminate\Database\Eloquent\Builder|Injury newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Injury newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Injury query()
 * @method static \Illuminate\Database\Eloquent\Builder|Injury whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Injury whereDiagDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Injury whereDiagnosisId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Injury whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Injury whereTypeDiagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Injury whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class Injury extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\InsuranceCompany
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $file_method
 * @property string $naic
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Address|null $address
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BillingCompany[] $billingCompanies
 * @property-read int|null $billing_companies_count
 * @property-read \App\Models\Contact|null $contact
 * @property-read string $status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\InsurancePlan[] $insurancePlan
 * @property-read int|null $insurance_plan_count
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany query()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereFileMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereNaic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereUpdatedAt($value)
 * @property string|null $payer_id
 * @property int|null $file_method_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property-read int|null $abbreviations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property-read int|null $addresses_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TypeCatalog> $appealReasons
 * @property-read int|null $appeal_reasons_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TypeCatalog> $billingIncompleteReasons
 * @property-read int|null $billing_incomplete_reasons_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read int|null $claim_eligibilities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read int|null $contacts_count
 * @property-read \App\Models\TypeCatalog|null $fileMethod
 * @property-read mixed $last_modified
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsuranceCompanyTimeFailed> $insuranceCompanyTimeFaileds
 * @property-read int|null $insurance_company_time_faileds_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property-read int|null $insurance_plans_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property-read int|null $nicknames_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property-read int|null $private_notes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property-read int|null $procedures_count
 * @property-read \App\Models\PublicNote $publicNote
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereFileMethodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany wherePayerId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TypeCatalog> $appealReasons
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TypeCatalog> $billingIncompleteReasons
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsuranceCompanyTimeFailed> $insuranceCompanyTimeFaileds
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TypeCatalog> $appealReasons
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TypeCatalog> $billingIncompleteReasons
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsuranceCompanyTimeFailed> $insuranceCompanyTimeFaileds
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TypeCatalog> $appealReasons
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TypeCatalog> $billingIncompleteReasons
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsuranceCompanyTimeFailed> $insuranceCompanyTimeFaileds
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 */
	class InsuranceCompany extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\InsuranceCompanyAppealReason
 *
 * @property int $id
 * @property int $appeal_reason_id
 * @property int $insurance_company_id
 * @property int $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyAppealReason newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyAppealReason newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyAppealReason query()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyAppealReason whereAppealReasonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyAppealReason whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyAppealReason whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyAppealReason whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyAppealReason whereInsuranceCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyAppealReason whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class InsuranceCompanyAppealReason extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\InsuranceCompanyBillingIncompleteReason
 *
 * @property int $id
 * @property int $billing_incomplete_reason_id
 * @property int $insurance_company_id
 * @property int $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyBillingIncompleteReason newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyBillingIncompleteReason newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyBillingIncompleteReason query()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyBillingIncompleteReason whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyBillingIncompleteReason whereBillingIncompleteReasonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyBillingIncompleteReason whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyBillingIncompleteReason whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyBillingIncompleteReason whereInsuranceCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyBillingIncompleteReason whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class InsuranceCompanyBillingIncompleteReason extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\InsuranceCompanyFileMethod
 *
 * @property int $id
 * @property string $file_method
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyFileMethod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyFileMethod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyFileMethod query()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyFileMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyFileMethod whereFileMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyFileMethod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyFileMethod whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class InsuranceCompanyFileMethod extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\InsuranceCompanyTimeFailed
 *
 * @property int $id
 * @property int|null $days
 * @property int|null $from_id
 * @property int $billing_company_id
 * @property int $insurance_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\BillingCompany $billingCompany
 * @property-read \App\Models\TypeCatalog|null $from
 * @property-read \App\Models\InsuranceCompany $insuranceCompany
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyTimeFailed newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyTimeFailed newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyTimeFailed query()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyTimeFailed whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyTimeFailed whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyTimeFailed whereDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyTimeFailed whereFromId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyTimeFailed whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyTimeFailed whereInsuranceCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyTimeFailed whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class InsuranceCompanyTimeFailed extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\InsuranceLabelFee
 *
 * @property int $id
 * @property string $description
 * @property int $insurance_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\InsuranceType $insuranceType
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureFee> $procedureFees
 * @property-read int|null $procedure_fees_count
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceLabelFee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceLabelFee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceLabelFee query()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceLabelFee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceLabelFee whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceLabelFee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceLabelFee whereInsuranceTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceLabelFee whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureFee> $procedureFees
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureFee> $procedureFees
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureFee> $procedureFees
 */
	class InsuranceLabelFee extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\InsurancePlan
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property bool $status
 * @property string $note
 * @property string $ins_type
 * @property string $plan_type
 * @property bool $accept_assign
 * @property bool $pre_authorization
 * @property bool $file_zero
 * @property bool $referral_required
 * @property bool $accrue_patient_resp
 * @property bool $require_abn
 * @property bool $pqrs_eligible
 * @property bool $allow_attached_files
 * @property string $eff_date
 * @property string $charge_using
 * @property string $format
 * @property string $method
 * @property string $naic
 * @property int $insurance_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\InsuranceCompany|null $insuranceCompany
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Patient[] $patients
 * @property-read int|null $patients_count
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan query()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereAcceptAssign($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereAccruePatientResp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereAllowAttachedFiles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereCapGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereChargeUsing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereEffDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereFileZero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereInsType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereInsuranceCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereNaic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan wherePlanType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan wherePqrsEligible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan wherePreAuthorization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereReferralRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereRequireAbn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereUpdatedAt($value)
 * @property bool $file_zero_changes
 * @property int|null $charge_using_id
 * @property int|null $ins_type_id
 * @property int|null $plan_type_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property-read int|null $abbreviations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property-read int|null $addresses_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property-read int|null $billing_companies_count
 * @property-read \App\Models\TypeCatalog|null $chargeUsing
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read int|null $contacts_count
 * @property-read mixed $last_modified
 * @property-read \App\Models\TypeCatalog|null $insType
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlanPrivate> $insurancePlanPrivate
 * @property-read int|null $insurance_plan_private_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlanService> $insurancePlanServices
 * @property-read int|null $insurance_plan_services_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePolicy> $insurancePolicies
 * @property-read int|null $insurance_policies_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property-read int|null $nicknames_count
 * @property-read \App\Models\TypeCatalog|null $planType
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property-read int|null $private_notes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property-read int|null $procedures_count
 * @property-read \App\Models\PublicNote|null $publicNote
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Service> $services
 * @property-read int|null $services_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityTimeFailed> $timeFaileds
 * @property-read int|null $time_faileds_count
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereChargeUsingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereFileZeroChanges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereInsTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan wherePlanTypeId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlanPrivate> $insurancePlanPrivate
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlanService> $insurancePlanServices
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePolicy> $insurancePolicies
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Service> $services
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityTimeFailed> $timeFaileds
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContractFee> $contractFees
 * @property-read int|null $contract_fees_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Copay> $copays
 * @property-read int|null $copays_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlanPrivate> $insurancePlanPrivate
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlanService> $insurancePlanServices
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePolicy> $insurancePolicies
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Service> $services
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityTimeFailed> $timeFaileds
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan search($search)
 * @mixin \Eloquent
 * @property string|null $payer_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContractFee> $contractFees
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Copay> $copays
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlanPrivate> $insurancePlanPrivate
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlanService> $insurancePlanServices
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePolicy> $insurancePolicies
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Service> $services
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityTimeFailed> $timeFaileds
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan wherePayerId($value)
 */
	class InsurancePlan extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\InsurancePlanFormat
 *
 * @property int $id
 * @property string $format
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanFormat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanFormat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanFormat query()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanFormat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanFormat whereFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanFormat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanFormat whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class InsurancePlanFormat extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\InsurancePlanPrivate
 *
 * @property int $id
 * @property string|null $naic
 * @property bool $file_capitated
 * @property int|null $format_id
 * @property int|null $file_method_id
 * @property int|null $insurance_plan_id
 * @property int|null $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\BillingCompany|null $billingCompany
 * @property-read \App\Models\TypeCatalog|null $fileMethod
 * @property-read \App\Models\TypeCatalog|null $format
 * @property-read \App\Models\InsurancePlan|null $insurancePlan
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate query()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate whereFileCapitated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate whereFileMethodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate whereFormatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate whereInsurancePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate whereNaic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $format_professional_id
 * @property int|null $format_cms_id
 * @property int|null $format_institutional_id
 * @property int|null $format_ub_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \App\Models\TypeCatalog|null $formatCMS
 * @property-read \App\Models\TypeCatalog|null $formatInstitutional
 * @property-read \App\Models\TypeCatalog|null $formatProfessional
 * @property-read \App\Models\TypeCatalog|null $formatUB
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate whereFormatCmsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate whereFormatInstitutionalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate whereFormatProfessionalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate whereFormatUbId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class InsurancePlanPrivate extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\InsurancePlanService
 *
 * @property-read \App\Models\InsurancePlan $insurancePlan
 * @property-read \App\Models\InsurancePlanServiceAliance|null $insurancePlanServiceAliance
 * @property-read \App\Models\Service|null $service
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanService query()
 * @mixin \Eloquent
 */
	class InsurancePlanService extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\InsurancePlanServiceAliance
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\InsurancePlanService|null $insurancePlanService
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanServiceAliance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanServiceAliance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanServiceAliance query()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class InsurancePlanServiceAliance extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\InsurancePolicy
 *
 * @property int $id
 * @property string $policy_number
 * @property string|null $group_number
 * @property string|null $payment_responsibility_level_code
 * @property string|null $eff_date
 * @property string|null $end_date
 * @property bool $release_info
 * @property bool $assign_benefits
 * @property int $insurance_plan_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $payer_responsibility_id
 * @property int|null $insurance_policy_type_id
 * @property int|null $type_responsibility_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read int|null $claim_eligibilities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimValidation> $claimValidations
 * @property-read int|null $claim_validations_count
 * @property-read mixed $insurance_company_id
 * @property-read mixed $insurance_company_name
 * @property-read mixed $own
 * @property-read mixed $payer_id
 * @property-read mixed $subscriber
 * @property-read \App\Models\InsurancePlan $insurancePlan
 * @property-read \App\Models\TypeCatalog|null $insurancePolicyType
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Patient> $patients
 * @property-read int|null $patients_count
 * @property-read \App\Models\PayerResponsibility|null $payerResponsibility
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subscriber> $subscribers
 * @property-read int|null $subscribers_count
 * @property-read \App\Models\TypeCatalog|null $typeResponsibility
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy query()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereAssignBenefits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereEffDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereGroupNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereInsurancePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereInsurancePolicyTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy wherePayerResponsibilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy wherePaymentResponsibilityLevelCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy wherePolicyNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereReleaseInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereTypeResponsibilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimValidation> $claimValidations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Patient> $patients
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subscriber> $subscribers
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimValidation> $claimValidations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Patient> $patients
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subscriber> $subscribers
 * @mixin \Eloquent
 * @property int|null $billing_company_id
 * @property int|null $patient_id
 * @property bool $status
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \App\Models\BillingCompany|null $billingCompany
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read \App\Models\ClaimEligibility|null $claimLastEligibility
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimValidation> $claimValidations
 * @property-read \App\Models\Patient|null $patient
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subscriber> $subscribers
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereOwn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereStatus($value)
 */
	class InsurancePolicy extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\InsurancePolicyType
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicyType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicyType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicyType query()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicyType whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicyType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicyType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicyType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicyType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class InsurancePolicyType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\InsuranceType
 *
 * @property int $id
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsuranceLabelFee> $insuranceLabelFees
 * @property-read int|null $insurance_label_fees_count
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceType query()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceType whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsuranceLabelFee> $insuranceLabelFees
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsuranceLabelFee> $insuranceLabelFees
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsuranceLabelFee> $insuranceLabelFees
 */
	class InsuranceType extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\IpRestriction.
 *
 * @property int $id
 * @property int|null $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $entity
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestrictionMult> $IpRestrictionMults
 * @property int|null $ip_restriction_mults_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\BillingCompany|null $billingCompany
 * @property mixed $last_modified
 * @property \Illuminate\Database\Eloquent\Collection<int, Role> $roles
 * @property int|null $roles_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestriction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestriction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestriction query()
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestriction search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestriction whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestriction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestriction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestriction whereEntity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestriction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestriction whereUpdatedAt($value)
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestrictionMult> $IpRestrictionMults
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, Role> $roles
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestrictionMult> $IpRestrictionMults
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, Role> $roles
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestrictionMult> $ipRestrictionMults
 * @property \Illuminate\Database\Eloquent\Collection<int, Role> $roles
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestrictionMult> $ipRestrictionMults
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Roles\Models\Role> $roles
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 */
	final class IpRestriction extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\IpRestrictionMult
 *
 * @property int $id
 * @property string $ip_beginning
 * @property string|null $ip_finish
 * @property bool $rank
 * @property int $ip_restriction_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\IpRestriction $ipRestriction
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestrictionMult newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestrictionMult newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestrictionMult query()
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestrictionMult whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestrictionMult whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestrictionMult whereIpBeginning($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestrictionMult whereIpFinish($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestrictionMult whereIpRestrictionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestrictionMult whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestrictionMult whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class IpRestrictionMult extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\KeyboardShortcut.
 *
 * @property int $id
 * @property string $description
 * @property string $shortcut_type
 * @property string|null $module
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property mixed $key
 * @method static \Illuminate\Database\Eloquent\Builder|KeyboardShortcut newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KeyboardShortcut newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KeyboardShortcut query()
 * @method static \Illuminate\Database\Eloquent\Builder|KeyboardShortcut whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeyboardShortcut whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeyboardShortcut whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeyboardShortcut whereModule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeyboardShortcut whereShortcutType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeyboardShortcut whereUpdatedAt($value)
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property int|null $billing_companies_count
 * @mixin \Eloquent
 * @property string|null $default_key
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CustomShortcuts> $keys
 * @property-read int|null $keys_count
 * @method static \Illuminate\Database\Eloquent\Builder|KeyboardShortcut whereDefaultKey($value)
 */
	final class KeyboardShortcut extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\MacLocality
 *
 * @property int $id
 * @property string $mac
 * @property string $state
 * @property string $fsa
 * @property string $counties
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $locality_number
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read Attribute $modifier
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureFee> $procedureFees
 * @property-read int|null $procedure_fees_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property-read int|null $procedures_count
 * @method static \Illuminate\Database\Eloquent\Builder|MacLocality newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MacLocality newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MacLocality query()
 * @method static \Illuminate\Database\Eloquent\Builder|MacLocality whereCounties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MacLocality whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MacLocality whereFsa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MacLocality whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MacLocality whereLocalityNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MacLocality whereMac($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MacLocality whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MacLocality whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureFee> $procedureFees
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureFee> $procedureFees
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureFee> $procedureFees
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 */
	class MacLocality extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Marital
 *
 * @property int $id
 * @property string $spuse_name
 * @property string|null $spuse_work
 * @property string|null $spuse_work_phone
 * @property int $patient_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Patient $patient
 * @method static \Illuminate\Database\Eloquent\Builder|Marital newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Marital newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Marital query()
 * @method static \Illuminate\Database\Eloquent\Builder|Marital whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marital whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marital wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marital whereSpuseName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marital whereSpuseWork($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marital whereSpuseWorkPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marital whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property int|null $billing_company_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \App\Models\BillingCompany|null $billingCompany
 * @method static \Illuminate\Database\Eloquent\Builder|Marital whereBillingCompanyId($value)
 */
	class Marital extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\MaritalStatus
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|MaritalStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MaritalStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MaritalStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|MaritalStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaritalStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaritalStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaritalStatus whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class MaritalStatus extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Medication.
 *
 * @property int $id
 * @property string $code
 * @property string $date
 * @property string $drug_code
 * @property string $batch
 * @property int $quantity
 * @property int $frequency
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $company_procedure_id
 * @property \App\Models\CompanyProcedure|null $companyProcedure
 * @method static \Illuminate\Database\Eloquent\Builder|Medication newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Medication newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Medication query()
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereBatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereCompanyProcedureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereDrugCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereFrequency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	final class Medication extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Metadata
 *
 * @property int $id
 * @property string|null $dataset_name
 * @property string|null $description
 * @property string|null $machine_used
 * @property string $start_date
 * @property string $end_date
 * @property string $time
 * @property string|null $location
 * @property string|null $ip_machine
 * @property string|null $mac_machine
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata query()
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata whereDatasetName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata whereIpMachine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata whereMacMachine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata whereMachineUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata whereUserId($value)
 * @mixin \Eloquent
 */
	class Metadata extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Modifier
 *
 * @property int $id
 * @property string $modifier
 * @property string $special_coding_instructions
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $start_date
 * @property string|null $end_date
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read mixed $last_modified
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModifierConsideration> $modifierConsiderations
 * @property-read int|null $modifier_considerations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModifierInvalidCombination> $modifierInvalidCombinations
 * @property-read int|null $modifier_invalid_combinations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property-read int|null $procedures_count
 * @property-read \App\Models\PublicNote|null $publicNote
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier query()
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier whereModifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier whereSpecialCodingInstructions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModifierConsideration> $modifierConsiderations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModifierInvalidCombination> $modifierInvalidCombinations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModifierConsideration> $modifierConsiderations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModifierInvalidCombination> $modifierInvalidCombinations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModifierConsideration> $modifierConsiderations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModifierInvalidCombination> $modifierInvalidCombinations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 */
	class Modifier extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ModifierConsideration
 *
 * @property int $id
 * @property int $modifier_id
 * @property int $gender_id
 * @property int $age_init
 * @property int $age_end
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $discriminatory_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Discriminatory $discriminatory
 * @property-read \App\Models\Gender $gender
 * @property-read \App\Models\Modifier $modifier
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierConsideration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierConsideration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierConsideration query()
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierConsideration whereAgeEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierConsideration whereAgeInit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierConsideration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierConsideration whereDiscriminatoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierConsideration whereGenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierConsideration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierConsideration whereModifierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierConsideration whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class ModifierConsideration extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ModifierInvalidCombination
 *
 * @property int $id
 * @property string $invalid_combination
 * @property int $modifier_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Modifier $modifier
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierInvalidCombination newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierInvalidCombination newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierInvalidCombination query()
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierInvalidCombination whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierInvalidCombination whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierInvalidCombination whereInvalidCombination($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierInvalidCombination whereModifierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierInvalidCombination whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class ModifierInvalidCombination extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Patient.
 *
 * @property int $id
 * @property string $marital_status
 * @property string $driver_licence
 * @property bool $dependent
 * @property string $guardian_name
 * @property string $guardian_phone
 * @property string $spuse_name
 * @property string $employer
 * @property string $employer_address
 * @property string $position
 * @property string $phone_employer
 * @property string $spuse_employer
 * @property string $spuse_work_phone
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\EmergencyContact[] $emergencyContacts
 * @property int|null $emergency_contacts_count
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\InsurancePlan[] $insurancePlans
 * @property int|null $insurance_plans_count
 * @property \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Patient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient query()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereDependent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereDriverLicence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereEmployer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereEmployerAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereGuardianName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereGuardianPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereMaritalStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient wherePhoneEmployer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereSpuseEmployer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereSpuseName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereSpuseWorkPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereUserId($value)
 * @property string|null $driver_license
 * @property string|null $code
 * @property int|null $marital_status_id
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property int|null $billing_companies_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property int|null $companies_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Employment> $employments
 * @property int|null $employments_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Encounter> $encounters
 * @property int|null $encounters_count
 * @property mixed $last_modified
 * @property mixed $status
 * @property \App\Models\Guarantor|null $guarantor
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Injury> $injuries
 * @property int|null $injuries_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePolicy> $insurancePolicies
 * @property int|null $insurance_policies_count
 * @property \App\Models\Marital|null $marital
 * @property \App\Models\MaritalStatus|null $maritalStatus
 * @property \App\Models\PatientConditionRelated|null $patientConditionRelated
 * @property \App\Models\PatientPrivate|null $patientPrivate
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property int|null $private_notes_count
 * @property \App\Models\PublicNote $publicNote
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subscriber> $subscribers
 * @property int|null $subscribers_count
 * @method static \Illuminate\Database\Eloquent\Builder|Patient search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereDriverLicense($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereMaritalStatusId($value)
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Employment> $employments
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Encounter> $encounters
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Injury> $injuries
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePolicy> $insurancePolicies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subscriber> $subscribers
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Employment> $employments
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Encounter> $encounters
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Injury> $injuries
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePolicy> $insurancePolicies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subscriber> $subscribers
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claim> $claims
 * @property-read int|null $claims_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContractFee> $contractFees
 * @property-read int|null $contract_fees_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Employment> $employments
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Encounter> $encounters
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Guarantor> $guarantors
 * @property-read int|null $guarantors_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Injury> $injuries
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePolicy> $insurancePolicies
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Marital> $maritals
 * @property-read int|null $maritals_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subscriber> $subscribers
 */
	class Patient extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\PatientConditionRelated
 *
 * @property int $id
 * @property bool $employment
 * @property bool $auto_accident
 * @property bool $other_accident
 * @property string|null $place_state
 * @property int $patient_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Patient $patient
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConditionRelated newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConditionRelated newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConditionRelated query()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConditionRelated whereAutoAccident($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConditionRelated whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConditionRelated whereEmployment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConditionRelated whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConditionRelated whereOtherAccident($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConditionRelated wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConditionRelated wherePlaceState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConditionRelated whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class PatientConditionRelated extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\PatientOrInsuredInformation
 *
 * @property int $id
 * @property bool $employment_related_condition
 * @property bool $auto_accident_related_condition
 * @property string|null $auto_accident_place_state
 * @property bool $other_accident_related_condition
 * @property bool $patient_signature
 * @property bool $insured_signature
 * @property int $claim_form_p_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ClaimFormP $claimFormP
 * @method static \Illuminate\Database\Eloquent\Builder|PatientOrInsuredInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientOrInsuredInformation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientOrInsuredInformation query()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientOrInsuredInformation whereAutoAccidentPlaceState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientOrInsuredInformation whereAutoAccidentRelatedCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientOrInsuredInformation whereClaimFormPId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientOrInsuredInformation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientOrInsuredInformation whereEmploymentRelatedCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientOrInsuredInformation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientOrInsuredInformation whereInsuredSignature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientOrInsuredInformation whereOtherAccidentRelatedCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientOrInsuredInformation wherePatientSignature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientOrInsuredInformation whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class PatientOrInsuredInformation extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\PatientPrivate
 *
 * @property int $id
 * @property string $reference_num
 * @property string $patient_num
 * @property string $med_num
 * @property int $billing_company_id
 * @property int $patient_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Patient $patient
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate query()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate whereMedNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate wherePatientNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate whereReferenceNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class PatientPrivate extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\PayerResponsibility
 *
 * @property int $id
 * @property string $code
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePolicy> $insurancePolicies
 * @property-read int|null $insurance_policies_count
 * @method static \Illuminate\Database\Eloquent\Builder|PayerResponsibility newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PayerResponsibility newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PayerResponsibility query()
 * @method static \Illuminate\Database\Eloquent\Builder|PayerResponsibility whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayerResponsibility whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayerResponsibility whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayerResponsibility whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayerResponsibility whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePolicy> $insurancePolicies
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePolicy> $insurancePolicies
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePolicy> $insurancePolicies
 */
	class PayerResponsibility extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\PhysicianOrSupplierInformation
 *
 * @property int $id
 * @property string|null $prior_authorization_number
 * @property bool $outside_lab
 * @property string|null $charges
 * @property string|null $patient_account_num
 * @property bool $accept_assignment
 * @property int $claim_form_p_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimDateInformation> $claimDateInformations
 * @property-read int|null $claim_date_informations_count
 * @property-read \App\Models\ClaimFormP $claimFormP
 * @method static \Illuminate\Database\Eloquent\Builder|PhysicianOrSupplierInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhysicianOrSupplierInformation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhysicianOrSupplierInformation query()
 * @method static \Illuminate\Database\Eloquent\Builder|PhysicianOrSupplierInformation whereAcceptAssignment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhysicianOrSupplierInformation whereCharges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhysicianOrSupplierInformation whereClaimFormPId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhysicianOrSupplierInformation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhysicianOrSupplierInformation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhysicianOrSupplierInformation whereOutsideLab($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhysicianOrSupplierInformation wherePatientAccountNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhysicianOrSupplierInformation wherePriorAuthorizationNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhysicianOrSupplierInformation whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimDateInformation> $claimDateInformations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimDateInformation> $claimDateInformations
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimDateInformation> $claimDateInformations
 */
	class PhysicianOrSupplierInformation extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\PlaceOfService
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimServiceLine> $claimServiceLines
 * @property-read int|null $claim_service_lines_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Facility> $facilities
 * @property-read int|null $facilities_count
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfService query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfService whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfService whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfService whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfService whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimServiceLine> $claimServiceLines
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Facility> $facilities
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimServiceLine> $claimServiceLines
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Facility> $facilities
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimServiceLine> $claimServiceLines
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Facility> $facilities
 */
	class PlaceOfService extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\PlanStatusServiceTypeCode
 *
 * @property int $id
 * @property string $service_type_code
 * @property int $claim_eligibility_plan_status_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ClaimEligibilityPlanStatus $claimEligibilityPlanStatus
 * @method static \Illuminate\Database\Eloquent\Builder|PlanStatusServiceTypeCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanStatusServiceTypeCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanStatusServiceTypeCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanStatusServiceTypeCode whereClaimEligibilityPlanStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanStatusServiceTypeCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanStatusServiceTypeCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanStatusServiceTypeCode whereServiceTypeCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanStatusServiceTypeCode whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class PlanStatusServiceTypeCode extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\PrivateNote
 *
 * @property int $id
 * @property string $note
 * @property int|null $billing_company_id
 * @property string $publishable_type
 * @property int $publishable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read mixed $last_modified
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateNote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateNote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateNote query()
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateNote whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateNote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateNote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateNote whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateNote wherePublishableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateNote wherePublishableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateNote whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read Model|\Eloquent $publishable
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class PrivateNote extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Procedure.
 *
 * @property int $id
 * @property string $code
 * @property string $description
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $start_date
 * @property string|null $end_date
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property int|null $companies_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Diagnosis> $diagnoses
 * @property int|null $diagnoses_count
 * @property mixed $last_modified
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsuranceCompany> $insuranceCompanies
 * @property int|null $insurance_companies_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property int|null $insurance_plans_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\MacLocality> $macLocalities
 * @property int|null $mac_localities_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Modifier> $modifiers
 * @property int|null $modifiers_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureConsideration> $procedureCosiderations
 * @property int|null $procedure_cosiderations_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureFee> $procedureFees
 * @property int|null $procedure_fees_count
 * @property \App\Models\PublicNote|null $publicNote
 * @method static \Illuminate\Database\Eloquent\Builder|Procedure newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Procedure newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Procedure query()
 * @method static \Illuminate\Database\Eloquent\Builder|Procedure search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Procedure whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Procedure whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Procedure whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Procedure whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Procedure whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Procedure whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Procedure whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Procedure whereUpdatedAt($value)
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Diagnosis> $diagnoses
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsuranceCompany> $insuranceCompanies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\MacLocality> $macLocalities
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Modifier> $modifiers
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureConsideration> $procedureCosiderations
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureFee> $procedureFees
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Copay> $copays
 * @property int|null $copays_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Diagnosis> $diagnoses
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsuranceCompany> $insuranceCompanies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\MacLocality> $macLocalities
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Modifier> $modifiers
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureConsideration> $procedureCosiderations
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureFee> $procedureFees
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Copay> $copays
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Diagnosis> $diagnoses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsuranceCompany> $insuranceCompanies
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MacLocality> $macLocalities
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Modifier> $modifiers
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureConsideration> $procedureCosiderations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureFee> $procedureFees
 */
	class Procedure extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ProcedureConsideration
 *
 * @property int $id
 * @property int $procedure_id
 * @property int $gender_id
 * @property int $age_init
 * @property int|null $age_end
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $discriminatory_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Discriminatory $discriminatory
 * @property-read \App\Models\Gender $gender
 * @property-read \App\Models\Procedure $procedure
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration whereAgeEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration whereAgeInit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration whereDiscriminatoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration whereGenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration whereProcedureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class ProcedureConsideration extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ProcedureFee
 *
 * @property int $id
 * @property float $fee
 * @property int $procedure_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $insurance_label_fee_id
 * @property int $mac_locality_id
 * @property string|null $fee_start_date
 * @property string|null $fee_end_date
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\InsuranceLabelFee $insuranceLabelFee
 * @property-read \App\Models\MacLocality $macLocality
 * @property-read \App\Models\Procedure $procedure
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureFee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureFee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureFee query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureFee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureFee whereFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureFee whereFeeEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureFee whereFeeStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureFee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureFee whereInsuranceLabelFeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureFee whereMacLocalityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureFee whereProcedureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureFee whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class ProcedureFee extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Profile.
 *
 * @property int $id
 * @property string|null $ssn
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $last_name
 * @property string $sex
 * @property string|null $date_of_birth
 * @property string|null $avatar
 * @property bool $credit_score
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\SocialMedia> $socialMedias
 * @property int|null $social_medias_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $user
 * @property int|null $user_count
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile query()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCreditScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereSsn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUpdatedAt($value)
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\SocialMedia> $socialMedias
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $user
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\SocialMedia> $socialMedias
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $user
 * @mixin \Eloquent
 * @property int|null $name_suffix_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \App\Models\TypeCatalog|null $nameSuffix
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SocialMedia> $socialMedias
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereNameSuffixId($value)
 */
	final class Profile extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\PublicNote
 *
 * @property int $id
 * @property string $note
 * @property string $publishable_type
 * @property int $publishable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read mixed $last_modified
 * @method static \Illuminate\Database\Eloquent\Builder|PublicNote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicNote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicNote query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicNote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicNote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicNote whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicNote wherePublishableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicNote wherePublishableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicNote whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read Model|\Eloquent $publishable
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class PublicNote extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\RelationshipToInsured
 *
 * @property int $id
 * @property string $relationship
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|RelationshipToInsured newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RelationshipToInsured newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RelationshipToInsured query()
 * @method static \Illuminate\Database\Eloquent\Builder|RelationshipToInsured whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelationshipToInsured whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelationshipToInsured whereRelationship($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelationshipToInsured whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class RelationshipToInsured extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models\Reports{
/**
 * App\Models\Reports\Report.
 *
 * @property string $uuid
 * @property string $name
 * @property string $use
 * @property string $description
 * @property ReportType $type
 * @property array $tags
 * @property array $configuration
 * @property \Illuminate\Support\Carbon $range
 * @property bool $favorite
 * @property int|null $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property BillingCompany|null $billingCompany
 * @method static \Illuminate\Database\Eloquent\Builder|Report newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Report newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Report query()
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereConfiguration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereFavorite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereRange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereUse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereUuid($value)
 * @mixin \Eloquent
 * @property string $id
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereId($value)
 */
	final class Report extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RevCenter
 *
 * @property int $id
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RevCenter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RevCenter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RevCenter query()
 * @method static \Illuminate\Database\Eloquent\Builder|RevCenter whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevCenter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevCenter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevCenter whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class RevCenter extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Service
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\BillingCompany $billingCompany
 * @property-read \App\Models\Company $company
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlanService> $insurancePlanServices
 * @property-read int|null $insurance_plan_services_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property-read int|null $insurance_plans_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property-read int|null $private_notes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PublicNote> $publicNote
 * @property-read int|null $public_note_count
 * @property-read \App\Models\ServiceApplicableTo|null $serviceApplicableTo
 * @property-read \App\Models\ServiceGroup|null $serviceGroup1
 * @property-read \App\Models\ServiceGroup|null $serviceGroup2
 * @property-read \App\Models\ServiceRevCenter|null $serviceRevCenter
 * @property-read \App\Models\ServiceSpecialInstruction|null $serviceSpecialInstruction
 * @property-read \App\Models\ServiceStmtDescription|null $serviceStmtDescription
 * @property-read \App\Models\ServiceType|null $serviceType
 * @property-read \App\Models\ServiceTypeOfService|null $serviceTypeOfService
 * @method static \Illuminate\Database\Eloquent\Builder|Service newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service query()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlanService> $insurancePlanServices
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PublicNote> $publicNote
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlanService> $insurancePlanServices
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PublicNote> $publicNote
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlanService> $insurancePlanServices
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PublicNote> $publicNote
 */
	class Service extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ServiceApplicableTo
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceApplicableTo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceApplicableTo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceApplicableTo query()
 * @mixin \Eloquent
 */
	class ServiceApplicableTo extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ServiceGroup
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceGroup query()
 * @mixin \Eloquent
 */
	class ServiceGroup extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ServiceRevCenter
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceRevCenter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceRevCenter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceRevCenter query()
 * @mixin \Eloquent
 */
	class ServiceRevCenter extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ServiceSpecialInstruction
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceSpecialInstruction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceSpecialInstruction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceSpecialInstruction query()
 * @mixin \Eloquent
 */
	class ServiceSpecialInstruction extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ServiceStmtDescription
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceStmtDescription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceStmtDescription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceStmtDescription query()
 * @mixin \Eloquent
 */
	class ServiceStmtDescription extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ServiceType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceType query()
 * @mixin \Eloquent
 */
	class ServiceType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ServiceTypeOfService
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceTypeOfService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceTypeOfService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceTypeOfService query()
 * @mixin \Eloquent
 */
	class ServiceTypeOfService extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SocialMedia
 *
 * @property int $id
 * @property string $link
 * @property int $profile_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $social_network_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Profile $profile
 * @property-read \App\Models\SocialNetwork|null $socialNetwork
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMedia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMedia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMedia query()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMedia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMedia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMedia whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMedia whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMedia whereSocialNetworkId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMedia whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property int|null $billing_company_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \App\Models\BillingCompany|null $billingCompany
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMedia whereBillingCompanyId($value)
 */
	class SocialMedia extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\SocialNetwork
 *
 * @property int $id
 * @property string $name
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SocialMedia> $socialMedias
 * @property-read int|null $social_medias_count
 * @method static \Illuminate\Database\Eloquent\Builder|SocialNetwork newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialNetwork newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialNetwork query()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialNetwork whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialNetwork whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialNetwork whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialNetwork whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialNetwork whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SocialMedia> $socialMedias
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SocialMedia> $socialMedias
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SocialMedia> $socialMedias
 */
	class SocialNetwork extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\State
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $country_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|State newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State query()
 * @method static \Illuminate\Database\Eloquent\Builder|State whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereUpdatedAt($value)
 */
	final class State extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\StatusClaimMedical
 *
 * @property int $id
 * @property string $status_category_code
 * @property string $status_category_code_value
 * @property string $status_code
 * @property string $status_code_value
 * @property string $entity_code
 * @property string $entity
 * @property string $effective_date
 * @property float $submitted_amount
 * @property float $amount_paid
 * @property string $paid_date
 * @property string $check_issue_date
 * @property string $check_number
 * @property string $tracking_number
 * @property string $claim_service_date
 * @property string $trading_partner_claim_number
 * @property int $claim_status_medical_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ClaimStatusMedical $claimStatusMedical
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical query()
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereAmountPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereCheckIssueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereCheckNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereClaimServiceDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereClaimStatusMedicalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereEffectiveDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereEntity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereEntityCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical wherePaidDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereStatusCategoryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereStatusCategoryCodeValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereStatusCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereStatusCodeValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereSubmittedAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereTrackingNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereTradingPartnerClaimNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class StatusClaimMedical extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Std
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Std newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Std newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Std query()
 * @mixin \Eloquent
 */
	class Std extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Subscriber
 *
 * @property int $id
 * @property string|null $ssn
 * @property string|null $member_id
 * @property string $first_name
 * @property string $last_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $date_of_birth
 * @property int|null $relationship_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property-read int|null $addresses_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read int|null $claim_eligibilities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read int|null $contacts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Patient> $patients
 * @property-read int|null $patients_count
 * @property-read \App\Models\TypeCatalog|null $relationship
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber whereRelationshipId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber whereSsn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Patient> $patients
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePolicy> $insurancePolicies
 * @property-read int|null $insurance_policies_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Patient> $patients
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePolicy> $insurancePolicies
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Patient> $patients
 */
	class Subscriber extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Taxonomy
 *
 * @property int $id
 * @property bool $isPrimary
 * @property string $name
 * @property int|null $user_id
 * @property int|null $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy query()
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy whereIsPrimary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy whereUserId($value)
 * @property string $tax_id
 * @property bool $primary
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy wherePrimary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy whereTaxId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property-read int|null $companies_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Facility> $facilities
 * @property-read int|null $facilities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @property-read int|null $health_professionals_count
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Facility> $facilities
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 */
	class Taxonomy extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\TransmissionFormat
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TransmissionFormat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransmissionFormat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransmissionFormat query()
 * @method static \Illuminate\Database\Eloquent\Builder|TransmissionFormat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransmissionFormat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransmissionFormat whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransmissionFormat whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class TransmissionFormat extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Type
 *
 * @property int $id
 * @property string $description
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TypeCatalog> $typeCatalogs
 * @property-read int|null $type_catalogs_count
 * @method static \Illuminate\Database\Eloquent\Builder|Type newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Type newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Type query()
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TypeCatalog> $typeCatalogs
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TypeCatalog> $typeCatalogs
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TypeCatalog> $typeCatalogs
 */
	class Type extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TypeCatalog
 *
 * @property int $id
 * @property string $code
 * @property string $description
 * @property bool $status
 * @property int $type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Type $type
 * @method static \Illuminate\Database\Eloquent\Builder|TypeCatalog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeCatalog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeCatalog query()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeCatalog whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeCatalog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeCatalog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeCatalog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeCatalog whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeCatalog whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeCatalog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class TypeCatalog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TypeDiag
 *
 * @property int $id
 * @property string $code
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Injury> $injuries
 * @property-read int|null $injuries_count
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDiag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDiag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDiag query()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDiag whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDiag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDiag whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDiag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDiag whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Injury> $injuries
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Injury> $injuries
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Injury> $injuries
 */
	class TypeDiag extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\TypeForm
 *
 * @property int $id
 * @property string $form
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TypeForm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeForm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeForm query()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeForm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeForm whereForm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeForm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeForm whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class TypeForm extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TypeInsurance
 *
 * @property int $id
 * @property string $insurance
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|TypeInsurance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeInsurance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeInsurance query()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeInsurance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeInsurance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeInsurance whereInsurance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeInsurance whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 */
	class TypeInsurance extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\TypeOfService
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TypeOfService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeOfService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeOfService query()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeOfService whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeOfService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeOfService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeOfService whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeOfService whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class TypeOfService extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User.
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $sex
 * @property string $lastName
 * @property string $firstName
 * @property string $middleName
 * @property string|null $token
 * @property bool $available
 * @property bool $isLogged
 * @property string|null $img_profile
 * @property string|null $ssn
 * @property string|null $dateOfBirth
 * @property bool $isBlocked
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Address[] $address
 * @property int|null $address_count
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\BillingCompany[] $billingCompanyUser
 * @property int|null $billing_company_user_count
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Contact[] $contact
 * @property int|null $contact_count
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Device[] $devices
 * @property int|null $devices_count
 * @property \App\Models\Doctor|null $doctor
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Metadata[] $metadata
 * @property int|null $metadata_count
 * @property \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property int|null $notifications_count
 * @property \App\Models\Patient|null $patient
 * @property \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property int|null $permissions_count
 * @property \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property int|null $roles_count
 * @property \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereImgProfile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsBlocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsLogged($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSsn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @property string|null $usercode
 * @property string|null $userkey
 * @property bool $status
 * @property string|null $last_login
 * @property int|null $profile_id
 * @property string $language
 * @property string|null $last_activity
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property int|null $addresses_count
 * @property \Illuminate\Database\Eloquent\Collection<int, Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property int|null $billing_companies_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property int|null $contacts_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\FailedLoginAttempt> $failedLoginAttempts
 * @property int|null $failed_login_attempts_count
 * @property mixed $billing_company
 * @property mixed $billing_company_id
 * @property mixed $last_modified
 * @property \App\Models\HealthProfessional|null $healthProfessional
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestriction> $ipRestrictions
 * @property int|null $ip_restrictions_count
 * @property \App\Models\Profile|null $profile
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Roles\Models\Permission> $userPermissions
 * @property int|null $user_permissions_count
 * @method static \Illuminate\Database\Eloquent\Builder|User search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsercode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserkey($value)
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property \Illuminate\Database\Eloquent\Collection<int, Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\FailedLoginAttempt> $failedLoginAttempts
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestriction> $ipRestrictions
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Roles\Models\Permission> $userPermissions
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\FailedLoginAttempt> $failedLoginAttempts
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestriction> $ipRestrictions
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Roles\Models\Permission> $userPermissions
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CustomShortcuts> $customKeyboardShortcuts
 * @property-read int|null $custom_keyboard_shortcuts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FailedLoginAttempt> $failedLoginAttempts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestriction> $ipRestrictions
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Roles\Models\Permission> $userPermissions
 */
	final class User extends \Eloquent implements \Tymon\JWTAuth\Contracts\JWTSubject, \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Roles\Models{
/**
 * App\Roles\Models\Permission
 *
 * @class Permission
 * @brief Modelo para la gestión de permisos
 * 
 * Gestiona información sobre los permisos de acceso
 * @author ultraware\roles <a href="https://github.com/ultraware/roles.git">Ultraware\Roles</a>
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property string|null $module
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $constraint
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Roles\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereConstraint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereModule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Roles\Models\Role> $roles
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Roles\Models\Role> $roles
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Roles\Models\Role> $roles
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 */
	class Permission extends \Eloquent implements \App\Roles\Contracts\PermissionHasRelations, \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Roles\Models{
/**
 * App\Roles\Models\Role
 *
 * @class Role
 * @brief Modelo para la gestión de roles
 * 
 * Gestiona información sobre los roles de acceso
 * @author ultraware\roles <a href="https://github.com/ultraware/roles.git">Ultraware\Roles</a>
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property int $level
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestriction> $ipRestrictions
 * @property-read int|null $ip_restrictions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Roles\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestriction> $ipRestrictions
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Roles\Models\Permission> $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestriction> $ipRestrictions
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Roles\Models\Permission> $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestriction> $ipRestrictions
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Roles\Models\Permission> $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 */
	class Role extends \Eloquent implements \App\Roles\Contracts\RoleHasRelations, \OwenIt\Auditing\Contracts\Auditable {}
}

