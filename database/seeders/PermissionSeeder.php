<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Roles\Models\Permission;
use App\Roles\Models\Role;
use App\Models\User;

use DB;

class  PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superUserRole = Role::where('slug', 'superuser')->first();
        $billingManagerRole = Role::where('slug', 'billingmanager')->first();
        $billerRole = Role::where('slug', 'biller')->first();
        $paymentProcessorRole = Role::where('slug', 'paymentprocessor')->first();
        $collectorRole = Role::where('slug', 'collector')->first();
        $accountManagerRole = Role::where('slug', 'accountmanager')->first();
        $auditorRole = Role::where('slug', 'superauditor')->first();
        $auditorBCRole = Role::where('slug', 'billingcompanyauditor')->first();
        $healthProfessionalRole = Role::where('slug', 'healthprofessional')->first();
        $patientRole = Role::where('slug', 'patient')->first();
        $clientRole = Role::where('slug', 'client')->first();
        $developmentSupportRole = Role::where('slug', 'developmentsupport')->first();

        $permissions = [
            [
                'name' => 'Manage permissions for each role',
                'slug' => 'permission.manage.role',
                'module' => 'Permission Management',
                'constraint' => '',
                'description' => 'Manage permissions for each role'
            ],
            [
                'name' => 'Manage permissions for each user',
                'slug' => 'permission.manage.user',
                'module' => 'Permission Management',
                'constraint' => 'user.view',
                'description' => 'Manage permissions for each role'
            ],
            [
                'name' => 'View Restrictions',
                'slug' => 'setting.restriction.view',
                'module' => 'User Restriction by IP',
                'constraint' => '',
                'description' => 'View Restrictions'
            ],
            [
                'name' => 'Create Restriction',
                'slug' => 'setting.restriction.create',
                'module' => 'User Restriction by IP',
                'constraint' => 'setting.restriction.view',
                'description' => 'Create Restrictions'
            ],
            [
                'name' => 'Show Restriction',
                'slug' => 'setting.restriction.show',
                'module' => 'User Restriction by IP',
                'constraint' => 'setting.restriction.view',
                'description' => 'Show Restrictions'
            ],
            [
                'name' => 'Edit Restriction',
                'slug' => 'setting.restriction.edit',
                'module' => 'User Restriction by IP',
                'constraint' => 'setting.restriction.show',
                'description' => 'Edit Restrictions'
            ],
            [
                'name' => 'Remove Restriction',
                'slug' => 'setting.restriction.remove',
                'module' => 'User Restriction by IP',
                'constraint' => 'setting.restriction.show',
                'description' => 'Remove Restrictions'
            ],
            [
                'name' => 'View Users',
                'slug' => 'user.view',
                'module' => 'User Management',
                'constraint' => '',
                'description' => 'View Users'
            ],
            [
                'name' => 'Create User',
                'slug' => 'user.create',
                'module' => 'User Management',
                'constraint' => 'user.view',
                'description' => 'Create User'
            ],
            [
                'name' => 'Show User',
                'slug' => 'user.show',
                'module' => 'User Management',
                'constraint' => 'user.view',
                'description' => 'Show User'
            ],
            [
                'name' => 'Edit User',
                'slug' => 'user.edit',
                'module' => 'User Management',
                'constraint' => 'user.show',
                'description' => 'Edit User'
            ],
            [
                'name' => 'Disable User',
                'slug' => 'user.disable',
                'module' => 'User Management',
                'constraint' => 'user.show',
                'description' => 'Disable User'
            ],
            [
                'name' => 'View a User Change History',
                'slug' => 'user.history',
                'module' => 'User Management',
                'constraint' => 'user.show',
                'description' => 'View a User Change History'
            ],
            [
                'name' => 'View Blocked Users',
                'slug' => 'user.view.lock',
                'module' => 'User Management',
                'constraint' => '',
                'description' => 'View Blocked Users'
            ],
            [
                'name' => 'Unlock Users',
                'slug' => 'user.unlock',
                'module' => 'User Management',
                'constraint' => 'user.view.lock',
                'description' => 'Unlock Users'
            ],
            [
                'name' => 'Show Profile',
                'slug' => 'setting.profile.show',
                'module' => 'Profile',
                'constraint' => '',
                'description' => 'Show Profile'
            ],
            [
                'name' => 'Edit Profile',
                'slug' => 'setting.profile.edit',
                'module' => 'Profile',
                'constraint' => 'setting.profile.show',
                'description' => 'Edit Profile'
            ],
            [
                'name' => 'View Billing Companies',
                'slug' => 'billingcompany.view',
                'module' => 'Billing Company Management',
                'constraint' => '',
                'description' => 'View Billing Companies'
            ],
            [
                'name' => 'Create Billing Company',
                'slug' => 'billingcompany.create',
                'module' => 'Billing Company Management',
                'constraint' => 'billingcompany.view',
                'description' => 'Create Billing Company'
            ],
            [
                'name' => 'Show Billing Company',
                'slug' => 'billingcompany.show',
                'module' => 'Billing Company Management',
                'constraint' => 'billingcompany.view',
                'description' => 'Show Billing Company'
            ],
            [
                'name' => 'Edit Billing Company',
                'slug' => 'billingcompany.edit',
                'module' => 'Billing Company Management',
                'constraint' => '',
                'description' => 'Edit Billing Company'
            ],
            [
                'name' => 'Disable Billing Company',
                'slug' => 'billingcompany.disable',
                'module' => 'Billing Company Management',
                'constraint' => '',
                'description' => 'Disable Billing Company'
            ],
            [
                'name' => 'View a Billing Company Change History',
                'slug' => 'billingcompany.history',
                'module' => 'Billing Company Management',
                'constraint' => 'billingcompany.view',
                'description' => 'View a Billing Company Change History'
            ],
            [
                'name' => 'View Companies',
                'slug' => 'company.view',
                'module' => 'Company Management',
                'constraint' => '',
                'description' => 'View Companies'
            ],
            [
                'name' => 'Create Company',
                'slug' => 'company.create',
                'module' => 'Company Management',
                'constraint' => 'company.view',
                'description' => 'Create Company'
            ],
            [
                'name' => 'Show Company',
                'slug' => 'company.show',
                'module' => 'Company Management',
                'constraint' => 'company.view',
                'description' => 'Show Company'
            ],
            [
                'name' => 'Edit Company',
                'slug' => 'company.edit',
                'module' => 'Company Management',
                'constraint' => 'company.show',
                'description' => 'Edit Company'
            ],
            [
                'name' => 'Disable Company',
                'slug' => 'company.disable',
                'module' => 'Company Management',
                'constraint' => 'company.show',
                'description' => 'Disable Company'
            ],
            [
                'name' => 'Assign Company',
                'slug' => 'company.assign',
                'module' => 'Company Management',
                'constraint' => 'company.show',
                'description' => 'Assign Company to a Worker'
            ],
            [
                'name' => 'View a Company Change History',
                'slug' => 'company.history',
                'module' => 'Company Management',
                'constraint' => 'company.show',
                'description' => 'View a Company Change History'
            ],
            [
                'name' => 'View Facilities',
                'slug' => 'facility.view',
                'module' => 'Facility Management',
                'constraint' => '',
                'description' => 'View Facilities'
            ],
            [
                'name' => 'Create Facility',
                'slug' => 'facility.create',
                'module' => 'Facility Management',
                'constraint' => 'facility.view',
                'description' => 'Create Facility'
            ],
            [
                'name' => 'Show Facility',
                'slug' => 'facility.show',
                'module' => 'Facility Management',
                'constraint' => 'facility.view',
                'description' => 'Show Facility'
            ],
            [
                'name' => 'Edit Facility',
                'slug' => 'facility.edit',
                'module' => 'Facility Management',
                'constraint' => 'facility.show',
                'description' => 'Edit Facility'
            ],
            [
                'name' => 'Disable Facility',
                'slug' => 'facility.disable',
                'module' => 'Facility Management',
                'constraint' => 'facility.show',
                'description' => 'Disable Facility'
            ],
            [
                'name' => 'View a Facility Change History',
                'slug' => 'facility.history',
                'module' => 'Facility Management',
                'constraint' => 'facility.show',
                'description' => 'View a Facility Change History'
            ],
            [
                'name' => 'View Clearing Houses',
                'slug' => 'clearinghouse.view',
                'module' => 'Clearing House Management',
                'constraint' => '',
                'description' => 'View Clearing Houses'
            ],
            [
                'name' => 'Create Clearing House',
                'slug' => 'clearinghouse.create',
                'module' => 'Clearing House Management',
                'constraint' => 'clearinghouse.view',
                'description' => 'Create Clearing House'
            ],
            [
                'name' => 'Show Clearing House',
                'slug' => 'clearinghouse.show',
                'module' => 'Clearing House Management',
                'constraint' => 'clearinghouse.view',
                'description' => 'Show Clearing House'
            ],
            [
                'name' => 'Edit Clearing House',
                'slug' => 'clearinghouse.edit',
                'module' => 'Clearing House Management',
                'constraint' => 'clearinghouse.show',
                'description' => 'Edit Clearing House'
            ],
            [
                'name' => 'Disable Clearing House',
                'slug' => 'clearinghouse.disable',
                'module' => 'Clearing House Management',
                'constraint' => 'clearinghouse.show',
                'description' => 'Disable Clearing House'
            ],
            [
                'name' => 'View a Clearing House Change History',
                'slug' => 'clearinghouse.history',
                'module' => 'Clearing House Management',
                'constraint' => 'clearinghouse.show',
                'description' => 'View a Clearing House Change History'
            ],
            [
                'name' => 'View Insurance Companies',
                'slug' => 'insurancecompany.view',
                'module' => 'Insurance Management',
                'constraint' => '',
                'description' => 'View Insurance Companies'
            ],
            [
                'name' => 'Create Insurance Company',
                'slug' => 'insurancecompany.create',
                'module' => 'Insurance Management',
                'constraint' => 'insurancecompany.view',
                'description' => 'Create Insurance Company'
            ],
            [
                'name' => 'Show Insurance Company',
                'slug' => 'insurancecompany.show',
                'module' => 'Insurance Management',
                'constraint' => 'insurancecompany.view',
                'description' => 'Show Insurance Company'
            ],
            [
                'name' => 'Edit Insurance Company',
                'slug' => 'insurancecompany.edit',
                'module' => 'Insurance Management',
                'constraint' => 'insurancecompany.show',
                'description' => 'Edit Insurance Company'
            ],
            [
                'name' => 'Disable Insurance Company',
                'slug' => 'insurancecompany.disable',
                'module' => 'Insurance Management',
                'constraint' => 'insurancecompany.show',
                'description' => 'Disable Insurance Company'
            ],
            [
                'name' => 'View a Insurance Company Change History',
                'slug' => 'insurancecompany.history',
                'module' => 'Insurance Management',
                'constraint' => 'insurancecompany.show',
                'description' => 'View a Insurance Company Change History'
            ],
            [
                'name' => 'View Insurance Plans',
                'slug' => 'insurancecompany.insuranceplan.view',
                'module' => 'Insurance Management',
                'constraint' => '',
                'description' => 'View Insurance Plans'
            ],
            [
                'name' => 'Create Insurance Plan',
                'slug' => 'insurancecompany.insuranceplan.create',
                'module' => 'Insurance Management',
                'constraint' => 'insurancecompany.insuranceplan.view',
                'description' => 'Create Insurance Plan'
            ],
            [
                'name' => 'Show Insurance Plan',
                'slug' => 'insurancecompany.insuranceplan.show',
                'module' => 'Insurance Management',
                'constraint' => 'insurancecompany.insuranceplan.view',
                'description' => 'Show Insurance Plan'
            ],
            [
                'name' => 'Edit Insurance Plan',
                'slug' => 'insurancecompany.insuranceplan.edit',
                'module' => 'Insurance Management',
                'constraint' => 'insurancecompany.insuranceplan.show',
                'description' => 'Edit Insurance Plan'
            ],
            [
                'name' => 'Disable Insurance Plan',
                'slug' => 'insurancecompany.insuranceplan.disable',
                'module' => 'Insurance Management',
                'constraint' => 'insurancecompany.insuranceplan.show',
                'description' => 'Disable Insurance Plan'
            ],
            [
                'name' => 'View a Insurance Plan Change History',
                'slug' => 'insurancecompany.insuranceplan.history',
                'module' => 'Insurance Management',
                'constraint' => 'insurancecompany.insuranceplan.show',
                'description' => 'View a Insurance Plan Change History'
            ],
            [
                'name' => 'View Health Professionals',
                'slug' => 'heatlhprofessional.view',
                'module' => 'Health Professional Management',
                'constraint' => '',
                'description' => 'View Health Professionals'
            ],
            [
                'name' => 'Create Heatlh Professional',
                'slug' => 'heatlhprofessional.create',
                'module' => 'Health Professional Management',
                'constraint' => 'heatlhprofessional.view',
                'description' => 'Create Heatlh Professional'
            ],
            [
                'name' => 'Show Heatlh Professional',
                'slug' => 'heatlhprofessional.show',
                'module' => 'Health Professional Management',
                'constraint' => 'heatlhprofessional.view',
                'description' => 'Show Heatlh Professional'
            ],
            [
                'name' => 'Edit Heatlh Professional',
                'slug' => 'heatlhprofessional.edit',
                'module' => 'Health Professional Management',
                'constraint' => 'heatlhprofessional.show',
                'description' => 'Edit Heatlh Professional'
            ],
            [
                'name' => 'Disable Heatlh Professional',
                'slug' => 'heatlhprofessional.disable',
                'module' => 'Health Professional Management',
                'constraint' => 'heatlhprofessional.show',
                'description' => 'Disable Heatlh Professional'
            ],
            [
                'name' => 'View a Heatlh Professional Change History',
                'slug' => 'heatlhprofessional.history',
                'module' => 'Health Professional Management',
                'constraint' => 'heatlhprofessional.show',
                'description' => 'View a Heatlh Professional Change History'
            ],
            [
                'name' => 'View Patients',
                'slug' => 'patient.view',
                'module' => 'Patient Management',
                'constraint' => '',
                'description' => 'View Patients'
            ],
            [
                'name' => 'Create Patient',
                'slug' => 'patient.create',
                'module' => 'Patient Management',
                'constraint' => 'patient.view',
                'description' => 'Create Patient'
            ],
            [
                'name' => 'Show Patient',
                'slug' => 'patient.show',
                'module' => 'Patient Management',
                'constraint' => 'patient.view',
                'description' => 'Show Patient'
            ],
            [
                'name' => 'Edit Patient',
                'slug' => 'patient.edit',
                'module' => 'Patient Management',
                'constraint' => 'patient.show',
                'description' => 'Edit Patient'
            ],
            [
                'name' => 'Disable Patient',
                'slug' => 'patient.disable',
                'module' => 'Patient Management',
                'constraint' => 'patient.show',
                'description' => 'Disable Patient'
            ],
            [
                'name' => 'View a Patient Change History',
                'slug' => 'patient.history',
                'module' => 'Patient Management',
                'constraint' => 'patient.show',
                'description' => 'View a Patient Change History'
            ],
            [
                'name' => 'View Procedure',
                'slug' => 'procedure.view',
                'module' => 'Procedure Management',
                'constraint' => '',
                'description' => 'View Procedure'
            ],
            [
                'name' => 'Create Procedure',
                'slug' => 'procedure.create',
                'module' => 'Procedure Management',
                'constraint' => 'procedure.view',
                'description' => 'Create Procedure'
            ],
            [
                'name' => 'Show Procedure',
                'slug' => 'procedure.show',
                'module' => 'Procedure Management',
                'constraint' => 'procedure.view',
                'description' => 'Show Procedure Management'
            ],
            [
                'name' => 'Edit Procedure',
                'slug' => 'procedure.edit',
                'module' => 'Procedure Management',
                'constraint' => 'procedure.show',
                'description' => 'Edit Procedure'
            ],
            [
                'name' => 'Disable Procedure',
                'slug' => 'procedure.disable',
                'module' => 'Procedure Management',
                'constraint' => 'procedure.show',
                'description' => 'Disable Procedure'
            ],
            [
                'name' => 'View a Procedure Change History',
                'slug' => 'procedure.history',
                'module' => 'Procedure Management',
                'constraint' => 'procedure.show',
                'description' => 'View a Procedure Change History'
            ],
            [
                'name' => 'Validity Period Procedure',
                'slug' => 'procedure.validityperiod',
                'module' => 'Procedure Management',
                'constraint' => 'procedure.view',
                'description' => 'Validity Period Procedure'
            ],
            [
                'name' => 'View Audits',
                'slug' => 'audit.view',
                'module' => 'Audit Management',
                'constraint' => '',
                'description' => 'View Audits'
            ],
            [
                'name' => 'Show Audit',
                'slug' => 'audit.show',
                'module' => 'Audit Management',
                'constraint' => 'audit.view',
                'description' => 'Show Audit'
            ],
            [
                'name' => 'View Audits for User',
                'slug' => 'audit.user.view',
                'module' => 'Audit Management',
                'constraint' => 'user.view',
                'description' => 'View Audits for user'
            ],
            [
                'name' => 'View Claims',
                'slug' => 'claim.view',
                'module' => 'Claims Management',
                'constraint' => '',
                'description' => 'View Claims'
            ],
            [
                'name' => 'Create Claim',
                'slug' => 'claim.create',
                'module' => 'Claims Management',
                'constraint' => 'claim.view',
                'description' => 'Create Claim'
            ],
            [
                'name' => 'Show Claim',
                'slug' => 'claim.show',
                'module' => 'Claims Management',
                'constraint' => 'claim.view',
                'description' => 'Show Claim'
            ],
            [
                'name' => 'Verification and debuggin claim',
                'slug' => 'claim.verifydebug',
                'module' => 'Claims Management',
                'constraint' => 'claim.view',
                'description' => 'Verification and debuggin claim'
            ],
            [
                'name' => 'Manage users responsible for a claims',
                'slug' => 'claim.manageusers',
                'module' => 'Claims Management',
                'constraint' => 'claim.show',
                'description' => 'Manage users responsible for a claims'
            ],
            [
                'name' => 'Correct and re-submit claim',
                'slug' => 'claim.correctsubmit',
                'module' => 'Claims Management',
                'constraint' => 'claim.show',
                'description' => 'Correct and re-submit claim'
            ],
            [
                'name' => 'Generate Appeal',
                'slug' => 'claim.generateappeal',
                'module' => 'Claims Management',
                'constraint' => 'claim.show',
                'description' => 'Generate Appeal'
            ],
            [
                'name' => 'Register Payment',
                'slug' => 'payment.create',
                'module' => 'Payments Management',
                'constraint' => '',
                'description' => 'Register Payment'
            ],
            [
                'name' => 'Generate patient accounts statements',
                'slug' => 'payment.generatepatientaccount',
                'module' => 'Payments Management',
                'constraint' => '',
                'description' => 'Generate patient accounts statements'
            ],
            [
                'name' => 'Send co-pays and co-insurance',
                'slug' => 'payment.sendcopayscoinsurance',
                'module' => 'Payments Management',
                'constraint' => '',
                'description' => 'Send co-pays and co-insurance'
            ],
            [
                'name' => 'Generate Report',
                'slug' => 'report.create',
                'module' => 'Reports Management',
                'constraint' => '',
                'description' => 'Generate Reports'
            ],
            [
                'name' => 'View Reports',
                'slug' => 'report.view',
                'module' => 'Reports Management',
                'constraint' => '',
                'description' => 'View Reports'
            ],
            [
                'name' => 'Generate error report',
                'slug' => 'setting.errorreport.create',
                'module' => 'Development Support',
                'constraint' => '',
                'description' => 'Generate error report'
            ],
            [
                'name' => 'Manage responses in the FAQ forum',
                'slug' => 'setting.responses.manage',
                'module' => 'Development Support',
                'constraint' => '',
                'description' => 'Manage responses in the FAQ forum'
            ],
            [
                'name' => 'View Modifier',
                'slug' => 'modifier.view',
                'module' => 'Modifier Management',
                'constraint' => '',
                'description' => 'View Modifier'
            ],
            [
                'name' => 'Create Modifier',
                'slug' => 'modifier.create',
                'module' => 'Modifier Management',
                'constraint' => 'modifier.view',
                'description' => 'Create Modifier'
            ],
            [
                'name' => 'Show Modifier',
                'slug' => 'modifier.show',
                'module' => 'Modifier Management',
                'constraint' => 'modifier.view',
                'description' => 'Show Modifier'
            ],
            [
                'name' => 'Edit Modifier',
                'slug' => 'modifier.edit',
                'module' => 'Modifier Management',
                'constraint' => 'modifier.show',
                'description' => 'Edit Modifier'
            ],
            [
                'name' => 'Disable Modifier',
                'slug' => 'modifier.disable',
                'module' => 'Modifier Management',
                'constraint' => 'modifier.show',
                'description' => 'Disable Modifier'
            ],
            [
                'name' => 'View a Modifier Change History',
                'slug' => 'modifier.history',
                'module' => 'Modifier Management',
                'constraint' => 'modifier.show',
                'description' => 'View a Modifier Change History'
            ],
            [
                'name' => 'Validity Period Modifier',
                'slug' => 'modifier.validityperiod',
                'module' => 'Modifier Management',
                'constraint' => 'modifier.view',
                'description' => 'Validity Period Modifier'
            ],
            [
                'name' => 'View Diagnosis',
                'slug' => 'diagnosis.view',
                'module' => 'Diagnosis Management',
                'constraint' => '',
                'description' => 'View Diagnosis'
            ],
            [
                'name' => 'Create Diagnosis',
                'slug' => 'diagnosis.create',
                'module' => 'Diagnosis Management',
                'constraint' => 'diagnosis.view',
                'description' => 'Create Diagnosis'
            ],
            [
                'name' => 'Show Diagnosis',
                'slug' => 'diagnosis.show',
                'module' => 'Diagnosis Management',
                'constraint' => 'diagnosis.view',
                'description' => 'Show Diagnosis'
            ],
            [
                'name' => 'Edit Diagnosis',
                'slug' => 'diagnosis.edit',
                'module' => 'Diagnosis Management',
                'constraint' => 'diagnosis.show',
                'description' => 'Edit Diagnosis'
            ],
            [
                'name' => 'Disable Diagnosis',
                'slug' => 'diagnosis.disable',
                'module' => 'Diagnosis Management',
                'constraint' => 'diagnosis.show',
                'description' => 'Disable Diagnosis'
            ],
            [
                'name' => 'View a Diagnosis Change History',
                'slug' => 'diagnosis.history',
                'module' => 'Diagnosis Management',
                'constraint' => 'diagnosis.show',
                'description' => 'View a Diagnosis Change History'
            ],
            [
                'name' => 'Validity Period Diagnosis',
                'slug' => 'diagnosis.validityperiod',
                'module' => 'Diagnosis Management',
                'constraint' => 'diagnosis.view',
                'description' => 'Validity Period Diagnosis'
            ],
            [
                'name' => 'View Status',
                'slug' => 'status.view',
                'module' => 'Status Management',
                'constraint' => '',
                'description' => 'View Status'
            ],
            [
                'name' => 'Create Status',
                'slug' => 'status.create',
                'module' => 'Status Management',
                'constraint' => 'status.view',
                'description' => 'Create Status'
            ],
            [
                'name' => 'Show Status',
                'slug' => 'status.show',
                'module' => 'Status Management',
                'constraint' => 'status.view',
                'description' => 'Show Status'
            ],
            [
                'name' => 'Edit Status',
                'slug' => 'status.edit',
                'module' => 'Status Management',
                'constraint' => 'status.show',
                'description' => 'Edit Status'
            ],
            [
                'name' => 'Disable Status',
                'slug' => 'status.disable',
                'module' => 'Status Management',
                'constraint' => 'status.show',
                'description' => 'Disable Status'
            ],
            [
                'name' => 'View a Status Change History',
                'slug' => 'status.history',
                'module' => 'Status Management',
                'constraint' => 'status.show',
                'description' => 'View a Status Change History'
            ],
        ];

        $defaultPermissions = [
            'superuser' => [
                'permission.manage.role',
                'permission.manage.user',
                'setting.restriction.view',
                'setting.restriction.create',
                'setting.restriction.show',
                'setting.restriction.edit',
                'setting.restriction.remove',
                'user.view',
                'user.create',
                'user.show',
                'user.edit',
                'user.unlock',
                'user.history',
                'setting.profile.show',
                'setting.profile.edit',
                'billingcompany.view',
                'billingcompany.create',
                'billingcompany.show',
                'billingcompany.edit',
                'billingcompany.disable',
                'billingcompany.history',
                'company.view',
                'company.create',
                'company.show',
                'company.edit',
                'company.assign',
                'company.history',
                'facility.view',
                'facility.create',
                'facility.show',
                'facility.edit',
                'facility.history',
                'clearinghouse.view',
                'clearinghouse.create',
                'clearinghouse.show',
                'clearinghouse.edit',
                'clearinghouse.history',
                'insurancecompany.view',
                'insurancecompany.create',
                'insurancecompany.show',
                'insurancecompany.edit',
                'insurancecompany.history',
                'insurancecompany.insuranceplan.view',
                'insurancecompany.insuranceplan.create',
                'insurancecompany.insuranceplan.show',
                'insurancecompany.insuranceplan.edit',
                'insurancecompany.insuranceplan.history',
                'heatlhprofessional.view',
                'heatlhprofessional.create',
                'heatlhprofessional.show',
                'heatlhprofessional.edit',
                'heatlhprofessional.history',
                'patient.view',
                'patient.create',
                'patient.show',
                'patient.edit',
                'patient.history',
                'procedure.view',
                'procedure.create',
                'procedure.show',
                'procedure.edit',
                'procedure.disable',
                'procedure.history',
                'audit.view',
                'audit.show',
                'audit.user.view',
                'claim.view',
                'claim.create',
                'claim.show',
                'claim.verifydebug',
                'claim.manageusers',
                'claim.correctsubmit',
                'claim.generateappeal',
                'payment.create',
                'payment.generatepatientaccount',
                'payment.sendcopayscoinsurance',
                'report.create',
                'report.view',
                'diagnosis.view',
                'diagnosis.create',
                'diagnosis.show',
                'diagnosis.edit',
                'diagnosis.disable',
                'diagnosis.history',
                'modifier.view',
                'modifier.create',
                'modifier.show',
                'modifier.edit',
                'modifier.disable',
                'modifier.history',
                'status.view',
                'status.create',
                'status.show',
                'status.edit',
                'status.disable',
                'status.history',
            ],
            'billingmanager' => [
                'permission.manage.user',
                'setting.restriction.view',
                'setting.restriction.create',
                'setting.restriction.show',
                'setting.restriction.edit',
                'setting.restriction.remove',
                'user.view',
                'user.create',
                'user.show',
                'user.edit',
                'user.unlock',
                'user.disable',
                'user.history',
                'setting.profile.show',
                'setting.profile.edit',
                'billingcompany.show',
                'billingcompany.edit',
                'billingcompany.history',
                'company.view',
                'company.create',
                'company.show',
                'company.edit',
                'company.assign',
                'company.disable',
                'company.history',
                'facility.view',
                'facility.create',
                'facility.show',
                'facility.edit',
                'facility.disable',
                'facility.history',
                'clearinghouse.view',
                'clearinghouse.create',
                'clearinghouse.show',
                'clearinghouse.edit',
                'clearinghouse.disable',
                'clearinghouse.history',
                'insurancecompany.view',
                'insurancecompany.create',
                'insurancecompany.show',
                'insurancecompany.edit',
                'insurancecompany.disable',
                'insurancecompany.history',
                'insurancecompany.insuranceplan.view',
                'insurancecompany.insuranceplan.create',
                'insurancecompany.insuranceplan.show',
                'insurancecompany.insuranceplan.edit',
                'insurancecompany.insuranceplan.disable',
                'insurancecompany.insuranceplan.history',
                'heatlhprofessional.view',
                'heatlhprofessional.create',
                'heatlhprofessional.show',
                'heatlhprofessional.edit',
                'heatlhprofessional.disable',
                'heatlhprofessional.history',
                'patient.view',
                'patient.create',
                'patient.show',
                'patient.edit',
                'patient.disable',
                'patient.history',
                'procedure.view',
                'procedure.create',
                'procedure.show',
                'procedure.edit',
                'procedure.disable',
                'procedure.history',
                'claim.view',
                'claim.create',
                'claim.show',
                'claim.verifydebug',
                'claim.manageusers',
                'claim.correctsubmit',
                'claim.generateappeal',
                'payment.create',
                'payment.generatepatientaccount',
                'payment.sendcopayscoinsurance',
                'report.create',
                'report.view',
                'diagnosis.view',
                'diagnosis.create',
                'diagnosis.show',
                'diagnosis.edit',
                'diagnosis.disable',
                'diagnosis.history',
                'modifier.view',
                'modifier.create',
                'modifier.show',
                'modifier.edit',
                'modifier.disable',
                'modifier.history',
                'status.view',
                'status.create',
                'status.show',
                'status.edit',
                'status.disable',
                'status.history',
            ],
            'biller' => [
                'setting.profile.show',
                'setting.profile.edit',
                'facility.view',
                'facility.create',
                'facility.show',
                'facility.edit',
                'insurancecompany.view',
                'insurancecompany.create',
                'insurancecompany.show',
                'insurancecompany.edit',
                'insurancecompany.insuranceplan.view',
                'insurancecompany.insuranceplan.create',
                'insurancecompany.insuranceplan.show',
                'insurancecompany.insuranceplan.edit',
                'heatlhprofessional.view',
                'heatlhprofessional.create',
                'heatlhprofessional.show',
                'heatlhprofessional.edit',
                'heatlhprofessional.history',
                'patient.view',
                'patient.create',
                'patient.show',
                'patient.edit',
                'patient.history',
                'procedure.view',
                'procedure.show',
                'claim.view',
                'claim.create',
                'claim.show',
                'claim.verifydebug',
                'claim.correctsubmit',
                'claim.generateappeal',
                'report.create',
                'report.view',
                'diagnosis.view',
                'diagnosis.show',
                'modifier.view',
                'modifier.show',
            ],
            'paymentprocessor' => [
                'setting.profile.show',
                'setting.profile.edit',
                'patient.view',
                'patient.show',
                'patient.edit',
                'claim.view',
                'claim.show',
                'payment.create',
                'payment.generatepatientaccount',
                'payment.sendcopayscoinsurance',
                'report.create',
                'report.view',
                'procedure.view',
                'procedure.show',
                'diagnosis.view',
                'diagnosis.show',
                'modifier.view',
                'modifier.show',
            ],
            'collector' => [
                'setting.profile.show',
                'setting.profile.edit',
                'patient.view',
                'patient.show',
                'patient.edit',
                'procedure.view',
                'procedure.show',
                'claim.view',
                'claim.show',
                'claim.verifydebug',
                'claim.correctsubmit',
                'claim.generateappeal',
                'payment.generatepatientaccount',
                'report.create',
                'report.view',
                'diagnosis.view',
                'diagnosis.show',
                'modifier.view',
                'modifier.show',
            ],
            'accountmanager' => [
                'setting.profile.show',
                'setting.profile.edit',
                'claim.view',
                'claim.show',
                'report.create',
                'report.view',
                'procedure.view',
                'procedure.show',
                'diagnosis.view',
                'diagnosis.show',
                'modifier.view',
                'modifier.show',
            ],
            'client' => [
                'setting.profile.show',
                'setting.profile.edit',
            ],
            'healthprofessional' => [
                'setting.profile.show',
                'setting.profile.edit',
            ],
            'patient' => [
                'setting.profile.show',
                'setting.profile.edit',
            ],
            'superauditor' => [
                'setting.profile.show',
                'setting.profile.edit',
                'audit.view',
                'audit.show',
                'procedure.view',
                'procedure.show',
                'procedure.history',
                'diagnosis.view',
                'diagnosis.show',
                'diagnosis.history',
                'modifier.view',
                'modifier.show',
                'modifier.history',
            ],
            'billingcompanyauditor' => [
                'setting.profile.show',
                'setting.profile.edit',
                'audit.view',
                'audit.show',
                'procedure.view',
                'procedure.show',
                'procedure.history',
                'diagnosis.view',
                'diagnosis.show',
                'diagnosis.history',
                'modifier.view',
                'modifier.show',
                'modifier.history',
            ],
            'developmentsupport' => [
                'setting.profile.show',
                'setting.profile.edit',
                'setting.errorreport.create',
                'setting.responses.manage',
                'procedure.view',
                'procedure.show',
                'procedure.history',
                'procedure.validityperiod',
                'diagnosis.view',
                'diagnosis.show',
                'diagnosis.history',
                'diagnosis.validityperiod',
                'modifier.view',
                'modifier.show',
                'modifier.history',
                'modifier.validityperiod',
            ],
        ];

        $oldPermissions = Permission::all();

        DB::transaction(function () use ($permissions, $defaultPermissions, $oldPermissions, $superUserRole,
                                         $billingManagerRole, $billerRole, $paymentProcessorRole, $collectorRole,
                                         $accountManagerRole, $auditorRole, $auditorBCRole, $healthProfessionalRole, $patientRole,
                                         $clientRole, $developmentSupportRole) {

            $superUserRole->detachAllPermissions();
            $billingManagerRole->detachAllPermissions();
            $billerRole->detachAllPermissions();
            $paymentProcessorRole->detachAllPermissions();
            $collectorRole->detachAllPermissions();
            $accountManagerRole->detachAllPermissions();
            $auditorRole->detachAllPermissions();
            $auditorBCRole->detachAllPermissions();
            $healthProfessionalRole->detachAllPermissions();
            $patientRole->detachAllPermissions();
            $clientRole->detachAllPermissions();
            $developmentSupportRole->detachAllPermissions();
            
            foreach ($oldPermissions as $perm) {
                $perm->delete();
            }

            /** Assign permissions to role */

            foreach ($permissions as $permission) {

                $per = Permission::updateOrCreate([
                    'slug' => $permission['slug']
                    ],
                    [
                        'name' => $permission['name'],
                        'module' => $permission['module'] ?? '',
                        'constraint' => $permission['constraint'] ?? '',
                        'description' => $permission['description']
                    ]
                );
                if ($superUserRole) {
                    $superUserRole->attachPermission($per);
                }
                if ($billingManagerRole && in_array($permission['slug'], $defaultPermissions['billingmanager'])) {
                    $billingManagerRole->attachPermission($per);
                }
                if ($billerRole && in_array($permission['slug'], $defaultPermissions['biller'])) {
                    $billerRole->attachPermission($per);
                }
                if ($paymentProcessorRole && in_array($permission['slug'], $defaultPermissions['paymentprocessor'])) {
                    $paymentProcessorRole->attachPermission($per);
                }
                if ($collectorRole && in_array($permission['slug'], $defaultPermissions['collector'])) {
                    $collectorRole->attachPermission($per);
                }
                if ($accountManagerRole && in_array($permission['slug'], $defaultPermissions['accountmanager'])) {
                    $accountManagerRole->attachPermission($per);
                }
                if ($auditorRole && in_array($permission['slug'], $defaultPermissions['superauditor'])) {
                    $auditorRole->attachPermission($per);
                }
                if ($auditorBCRole && in_array($permission['slug'], $defaultPermissions['billingcompanyauditor'])) {
                    $auditorBCRole->attachPermission($per);
                }
                if ($healthProfessionalRole && in_array($permission['slug'], $defaultPermissions['healthprofessional'])) {
                    $healthProfessionalRole->attachPermission($per);
                }
                if ($patientRole && in_array($permission['slug'], $defaultPermissions['patient'])) {
                    $patientRole->attachPermission($per);
                }
                if ($clientRole && in_array($permission['slug'], $defaultPermissions['client'])) {
                    $clientRole->attachPermission($per);
                }
                if ($developmentSupportRole && in_array($permission['slug'], $defaultPermissions['developmentsupport'])) {
                    $developmentSupportRole->attachPermission($per);
                }
            }
            /** Assign permissions to users */
            foreach (User::all() as $usr) {
                $usr->detachAllPermissions();
                if ($usr->hasRole('superuser')) {
                    $perms = Permission::whereHas('roles', function ($query) use ($superUserRole) {
                        $query->where('role_id', $superUserRole->id);
                    })->get();
                    foreach ($perms as $perm) {
                        $usr->attachPermission($perm);
                    }
                }
                if ($usr->hasRole('billingmanager')) {
                    $perms = Permission::whereHas('roles', function ($query) use ($billingManagerRole) {
                        $query->where('role_id', $billingManagerRole->id);
                    })->get();
                    foreach ($perms as $perm) {
                        $usr->attachPermission($perm);
                    }
                }
            }
        });
    }
}
