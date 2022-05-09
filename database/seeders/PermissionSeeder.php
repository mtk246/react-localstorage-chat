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
        $auditorRole = Role::where('slug', 'auditor')->first();
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
                'slug' => 'billingCompany.view',
                'module' => 'Billing Company Management',
                'constraint' => '',
                'description' => 'View Billing Companies'
            ],
            [
                'name' => 'Create Billing Company',
                'slug' => 'billingCompany.create',
                'module' => 'Billing Company Management',
                'constraint' => 'billingCompany.view',
                'description' => 'Create Billing Company'
            ],
            [
                'name' => 'Show Billing Company',
                'slug' => 'billingCompany.show',
                'module' => 'Billing Company Management',
                'constraint' => 'billingCompany.view',
                'description' => 'Show Billing Company'
            ],
            [
                'name' => 'Edit Billing Company',
                'slug' => 'billingCompany.edit',
                'module' => 'Billing Company Management',
                'constraint' => '',
                'description' => 'Edit Billing Company'
            ],
            [
                'name' => 'Disable Billing Company',
                'slug' => 'billingCompany.disable',
                'module' => 'Billing Company Management',
                'constraint' => '',
                'description' => 'Disable Billing Company'
            ],
            [
                'name' => 'View a Billing Company Change History',
                'slug' => 'billingCompany.history',
                'module' => 'Billing Company Management',
                'constraint' => 'billingCompany.view',
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
                'slug' => 'clearingHouse.view',
                'module' => 'Clearing House Management',
                'constraint' => '',
                'description' => 'View Clearing Houses'
            ],
            [
                'name' => 'Create Clearing House',
                'slug' => 'clearingHouse.create',
                'module' => 'Clearing House Management',
                'constraint' => 'clearingHouse.view',
                'description' => 'Create Clearing House'
            ],
            [
                'name' => 'Show Clearing House',
                'slug' => 'clearingHouse.show',
                'module' => 'Clearing House Management',
                'constraint' => 'clearingHouse.view',
                'description' => 'Show Clearing House'
            ],
            [
                'name' => 'Edit Clearing House',
                'slug' => 'clearingHouse.edit',
                'module' => 'Clearing House Management',
                'constraint' => 'clearingHouse.show',
                'description' => 'Edit Clearing House'
            ],
            [
                'name' => 'Disable Clearing House',
                'slug' => 'clearingHouse.disable',
                'module' => 'Clearing House Management',
                'constraint' => 'clearingHouse.show',
                'description' => 'Disable Clearing House'
            ],
            [
                'name' => 'View a Clearing House Change History',
                'slug' => 'clearingHouse.history',
                'module' => 'Clearing House Management',
                'constraint' => 'clearingHouse.show',
                'description' => 'View a Clearing House Change History'
            ],
            [
                'name' => 'View Insurance Companies',
                'slug' => 'insuranceCompany.view',
                'module' => 'Insurance Management',
                'constraint' => '',
                'description' => 'View Insurance Companies'
            ],
            [
                'name' => 'Create Insurance Company',
                'slug' => 'insuranceCompany.create',
                'module' => 'Insurance Management',
                'constraint' => 'insuranceCompany.view',
                'description' => 'Create Insurance Company'
            ],
            [
                'name' => 'Show Insurance Company',
                'slug' => 'insuranceCompany.show',
                'module' => 'Insurance Management',
                'constraint' => 'insuranceCompany.view',
                'description' => 'Show Insurance Company'
            ],
            [
                'name' => 'Edit Insurance Company',
                'slug' => 'insuranceCompany.edit',
                'module' => 'Insurance Management',
                'constraint' => 'insuranceCompany.show',
                'description' => 'Edit Insurance Company'
            ],
            [
                'name' => 'Disable Insurance Company',
                'slug' => 'insuranceCompany.disable',
                'module' => 'Insurance Management',
                'constraint' => 'insuranceCompany.show',
                'description' => 'Disable Insurance Company'
            ],
            [
                'name' => 'View a Insurance Company Change History',
                'slug' => 'insuranceCompany.history',
                'module' => 'Insurance Management',
                'constraint' => 'insuranceCompany.show',
                'description' => 'View a Insurance Company Change History'
            ],
            [
                'name' => 'View Insurance Plans',
                'slug' => 'insuranceCompany.insurancePlan.view',
                'module' => 'Insurance Management',
                'constraint' => '',
                'description' => 'View Insurance Plans'
            ],
            [
                'name' => 'Create Insurance Plan',
                'slug' => 'insuranceCompany.insurancePlan.create',
                'module' => 'Insurance Management',
                'constraint' => 'insuranceCompany.insurancePlan.view',
                'description' => 'Create Insurance Plan'
            ],
            [
                'name' => 'Show Insurance Plan',
                'slug' => 'insuranceCompany.insurancePlan.show',
                'module' => 'Insurance Management',
                'constraint' => 'insuranceCompany.insurancePlan.view',
                'description' => 'Show Insurance Plan'
            ],
            [
                'name' => 'Edit Insurance Plan',
                'slug' => 'insuranceCompany.insurancePlan.edit',
                'module' => 'Insurance Management',
                'constraint' => 'insuranceCompany.insurancePlan.show',
                'description' => 'Edit Insurance Plan'
            ],
            [
                'name' => 'Disable Insurance Plan',
                'slug' => 'insuranceCompany.insurancePlan.disable',
                'module' => 'Insurance Management',
                'constraint' => 'insuranceCompany.insurancePlan.show',
                'description' => 'Disable Insurance Plan'
            ],
            [
                'name' => 'View a Insurance Plan Change History',
                'slug' => 'insuranceCompany.insurancePlan.history',
                'module' => 'Insurance Management',
                'constraint' => 'insuranceCompany.insurancePlan.show',
                'description' => 'View a Insurance Plan Change History'
            ],
            [
                'name' => 'View Health Professionals',
                'slug' => 'heatlhProfessional.view',
                'module' => 'Health Professional Management',
                'constraint' => '',
                'description' => 'View Health Professionals'
            ],
            [
                'name' => 'Create Heatlh Professional',
                'slug' => 'heatlhProfessional.create',
                'module' => 'Health Professional Management',
                'constraint' => 'heatlhProfessional.view',
                'description' => 'Create Heatlh Professional'
            ],
            [
                'name' => 'Show Heatlh Professional',
                'slug' => 'heatlhProfessional.show',
                'module' => 'Health Professional Management',
                'constraint' => 'heatlhProfessional.view',
                'description' => 'Show Heatlh Professional'
            ],
            [
                'name' => 'Edit Heatlh Professional',
                'slug' => 'heatlhProfessional.edit',
                'module' => 'Health Professional Management',
                'constraint' => 'heatlhProfessional.show',
                'description' => 'Edit Heatlh Professional'
            ],
            [
                'name' => 'Disable Heatlh Professional',
                'slug' => 'heatlhProfessional.disable',
                'module' => 'Health Professional Management',
                'constraint' => 'heatlhProfessional.show',
                'description' => 'Disable Heatlh Professional'
            ],
            [
                'name' => 'View a Heatlh Professional Change History',
                'slug' => 'heatlhProfessional.history',
                'module' => 'Health Professional Management',
                'constraint' => 'heatlhProfessional.show',
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
                'name' => 'View Procedure of Services',
                'slug' => 'service.view',
                'module' => 'Procedure of Service',
                'constraint' => '',
                'description' => 'View Procedure of Services'
            ],
            [
                'name' => 'Create Procedure of Service',
                'slug' => 'service.create',
                'module' => 'Procedure of Service',
                'constraint' => 'service.view',
                'description' => 'Create Procedure of Service'
            ],
            [
                'name' => 'Show Procedure of Service',
                'slug' => 'service.show',
                'module' => 'Procedure of Service',
                'constraint' => 'service.view',
                'description' => 'Show Procedure of Service'
            ],
            [
                'name' => 'Edit Procedure of Service',
                'slug' => 'service.edit',
                'module' => 'Procedure of Service',
                'constraint' => 'service.show',
                'description' => 'Edit Procedure of Service'
            ],
            [
                'name' => 'Disable Procedure of Service',
                'slug' => 'service.disable',
                'module' => 'Procedure of Service',
                'constraint' => 'service.show',
                'description' => 'Disable Procedure of Service'
            ],
            [
                'name' => 'View a Procedure of Service Change History',
                'slug' => 'service.history',
                'module' => 'Procedure of Service',
                'constraint' => 'service.show',
                'description' => 'View a Procedure of Service Change History'
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
                'billingCompany.view',
                'billingCompany.create',
                'billingCompany.show',
                'billingCompany.edit',
                'billingCompany.disable',
                'billingCompany.history',
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
                'clearingHouse.view',
                'clearingHouse.create',
                'clearingHouse.show',
                'clearingHouse.edit',
                'clearingHouse.history',
                'insuranceCompany.view',
                'insuranceCompany.create',
                'insuranceCompany.show',
                'insuranceCompany.edit',
                'insuranceCompany.history',
                'insuranceCompany.insurancePlan.view',
                'insuranceCompany.insurancePlan.create',
                'insuranceCompany.insurancePlan.show',
                'insuranceCompany.insurancePlan.edit',
                'insuranceCompany.insurancePlan.history',
                'heatlhProfessional.view',
                'heatlhProfessional.create',
                'heatlhProfessional.show',
                'heatlhProfessional.edit',
                'heatlhProfessional.history',
                'patient.view',
                'patient.create',
                'patient.show',
                'patient.edit',
                'patient.history',
                'service.view',
                'service.create',
                'service.show',
                'service.edit',
                'service.history',
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
                'billingCompany.show',
                'billingCompany.edit',
                'billingCompany.history',
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
                'clearingHouse.view',
                'clearingHouse.create',
                'clearingHouse.show',
                'clearingHouse.edit',
                'clearingHouse.disable',
                'clearingHouse.history',
                'insuranceCompany.view',
                'insuranceCompany.create',
                'insuranceCompany.show',
                'insuranceCompany.edit',
                'insuranceCompany.disable',
                'insuranceCompany.history',
                'insuranceCompany.insurancePlan.view',
                'insuranceCompany.insurancePlan.create',
                'insuranceCompany.insurancePlan.show',
                'insuranceCompany.insurancePlan.edit',
                'insuranceCompany.insurancePlan.disable',
                'insuranceCompany.insurancePlan.history',
                'heatlhProfessional.view',
                'heatlhProfessional.create',
                'heatlhProfessional.show',
                'heatlhProfessional.edit',
                'heatlhProfessional.disable',
                'heatlhProfessional.history',
                'patient.view',
                'patient.create',
                'patient.show',
                'patient.edit',
                'patient.disable',
                'patient.history',
                'service.view',
                'service.create',
                'service.show',
                'service.edit',
                'service.disable',
                'service.history',
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
            ],
            'biller' => [
                'setting.profile.show',
                'setting.profile.edit',
                'facility.view',
                'facility.create',
                'facility.show',
                'facility.edit',
                'insuranceCompany.view',
                'insuranceCompany.create',
                'insuranceCompany.show',
                'insuranceCompany.edit',
                'insuranceCompany.insurancePlan.view',
                'insuranceCompany.insurancePlan.create',
                'insuranceCompany.insurancePlan.show',
                'insuranceCompany.insurancePlan.edit',
                'heatlhProfessional.view',
                'heatlhProfessional.create',
                'heatlhProfessional.show',
                'heatlhProfessional.edit',
                'heatlhProfessional.history',
                'patient.view',
                'patient.create',
                'patient.show',
                'patient.edit',
                'patient.history',
                'service.view',
                'service.create',
                'service.show',
                'service.edit',
                'service.disable',
                'service.history',
                'claim.view',
                'claim.create',
                'claim.show',
                'claim.verifydebug',
                'claim.correctsubmit',
                'claim.generateappeal',
                'report.create',
                'report.view',
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
            ],
            'collector' => [
                'setting.profile.show',
                'setting.profile.edit',
                'patient.view',
                'patient.show',
                'patient.edit',
                'service.view',
                'service.show',
                'service.edit',
                'claim.view',
                'claim.show',
                'claim.verifydebug',
                'claim.correctsubmit',
                'claim.generateappeal',
                'payment.generatepatientaccount',
                'report.create',
                'report.view',
            ],
            'accountmanager' => [
                'setting.profile.show',
                'setting.profile.edit',
                'claim.view',
                'claim.show',
                'report.create',
                'report.view',
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
            'auditor' => [
                'setting.profile.show',
                'setting.profile.edit',
                'audit.view',
                'audit.show',
            ],
            'developmentsupport' => [
                'setting.profile.show',
                'setting.profile.edit',
                'setting.errorreport.create',
                'setting.responses.manage',
            ],
        ];

        $oldPermissions = Permission::all();

        DB::transaction(function () use ($permissions, $defaultPermissions, $oldPermissions, $superUserRole,
                                         $billingManagerRole, $billerRole, $paymentProcessorRole, $collectorRole,
                                         $accountManagerRole, $auditorRole, $healthProfessionalRole, $patientRole,
                                         $clientRole, $developmentSupportRole) {

            $superUserRole->detachAllPermissions();
            $billingManagerRole->detachAllPermissions();
            $billerRole->detachAllPermissions();
            $paymentProcessorRole->detachAllPermissions();
            $collectorRole->detachAllPermissions();
            $accountManagerRole->detachAllPermissions();
            $auditorRole->detachAllPermissions();
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
                if ($auditorRole && in_array($permission['slug'], $defaultPermissions['auditor'])) {
                    $auditorRole->attachPermission($per);
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
