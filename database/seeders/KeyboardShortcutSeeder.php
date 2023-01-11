<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KeyboardShortcut;
use App\Models\BillingCompanyKeyboardShortcut;

class KeyboardShortcutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $keyboardShortcuts = [
            [
                "key"           => "CTRL + ALT",
                "description"   => "Show menu",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "CTRL + ALT + C",
                "description"   => "Access to Claims Management",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "CTRL + ALT + P",
                "description"   => "Access to Payments Management",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "CTRL + ALT + Z",
                "description"   => "Access to Patient Management",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "CTRL + ALT + H",
                "description"   => "Access to Health Care Professional Management",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "CTRL + ALT + I",
                "description"   => "Access to Insurance Management",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "CTRL + ALT + X",
                "description"   => "Access to Company Management",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "CTRL + ALT + F",
                "description"   => "Access to Facility Management",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "CTRL + ALT + V",
                "description"   => "Access to Procedure Management",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "CTRL + ALT + D",
                "description"   => "Access to Diagnosis Management",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "CTRL + ALT + M",
                "description"   => "Access to Modifier Management",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "CTRL + ALT + U",
                "description"   => "Access to Users Management",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "CTRL + ALT + O",
                "description"   => "Access to ClearingHouse Management",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "CTRL + ALT + B",
                "description"   => "Access to Billing Company Management",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "CTRL + ALT + S",
                "description"   => "Access to Status Management",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "CTRL + ALT + R",
                "description"   => "Access to Reports",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "CTRL + ALT + A",
                "description"   => "Access to File Manager",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "CTRL + ALT + W",
                "description"   => "Access to Web Browser",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "CTRL + ALT + N",
                "description"   => "Access to Sticky Notes",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "CTRL + ALT + E",
                "description"   => "Access to Messenger",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "CTRL + ALT + Y",
                "description"   => "Access to Calculator",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "CTRL + ALT + J",
                "description"   => "Access to Widgets",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "CTRL + ALT + K",
                "description"   => "Access to Setting",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "CTRL + ALT+ L",
                "description"   => "Access to Profile",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "CTRL + ALT  + 1",
                "description"   => "Access to Permission Management",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "CTRL + ALT + 2",
                "description"   => "Access to Role Management",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "CTRL + ALT + 3",
                "description"   => "Access to Restriction by IP",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "CTRL + ALT + T",
                "description"   => "Access to Technical Support",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "CTRL + ALT + G",
                "description"   => "Access to Guidelines",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "CTRL + ALT + 9",
                "description"   => "Logout",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "ALT",
                "description"   => "Show shortcuts in view",
                "shortcut_type" => "General",
                "module"        => ""
            ],
            [
                "key"           => "F4",
                "description"   => "Minimize window",
                "shortcut_type" => "Per module",
                "module"        => ""
            ],
            [
                "key"           => "F5",
                "description"   => "Minimize or expand window size",
                "shortcut_type" => "Per module",
                "module"        => ""
            ],
            [
                "key"           => "F6",
                "description"   => "Close module",
                "shortcut_type" => "Per module",
                "module"        => ""
            ],
            [
                "key"           => "ESC",
                "description"   => "Close action modal inside a module",
                "shortcut_type" => "Per module",
                "module"        => ""
            ],
            [
                "key"           => "F2",
                "description"   => "Search",
                "shortcut_type" => "Per module",
                "module"        => ""
            ],
            [
                "key"           => "ALT + Plus",
                "description"   => "Add New",
                "shortcut_type" => "Per module",
                "module"        => ""
            ],
            [
                "key"           => "ALT + Backspace",
                "description"   => "Back ",
                "shortcut_type" => "Per module",
                "module"        => ""
            ],
            [
                "key"           => "ESC",
                "description"   => "Close",
                "shortcut_type" => "Per module",
                "module"        => ""
            ],
            [
                "key"           => "ALT + N",
                "description"   => "Next",
                "shortcut_type" => "Per module",
                "module"        => ""
            ],
            [
                "key"           => "ALT + T",
                "description"   => "Move between tabs",
                "shortcut_type" => "Per module",
                "module"        => ""
            ],
            [
                "key"           => "ALT + M",
                "description"   => "Add a new block",
                "shortcut_type" => "Per module",
                "module"        => ""
            ],
            [
                "key"           => "ALT + V",
                "description"   => "View",
                "shortcut_type" => "Module level actions",
                "module"        => ""
            ],
            [
                "key"           => "ALT + X",
                "description"   => "Edit",
                "shortcut_type" => "Module level actions",
                "module"        => ""
            ],
            [
                "key"           => "ALT + A",
                "description"   => "Disable/Enable",
                "shortcut_type" => "Module level actions",
                "module"        => ""
            ],
            [
                "key"           => "ALT + R",
                "description"   => "Record",
                "shortcut_type" => "Module level actions",
                "module"        => ""
            ],
            [
                "key"           => "ALT + B",
                "description"   => "Event",
                "shortcut_type" => "Module level actions",
                "module"        => ""
            ],
            [
                "key"           => "ALT + Z",
                "description"   => "Facilities",
                "shortcut_type" => "Module level actions",
                "module"        => ""
            ],
            [
                "key"           => "ALT + S",
                "description"   => "Services",
                "shortcut_type" => "Module level actions",
                "module"        => ""
            ],
            [
                "key"           => "ALT + O",
                "description"   => "Copay",
                "shortcut_type" => "Module level actions",
                "module"        => ""
            ],
            [
                "key"           => "ALT + Q",
                "description"   => "Contract fee",
                "shortcut_type" => "Module level actions",
                "module"        => ""
            ],
            [
                "key"           => "ALT + G",
                "description"   => "Plans",
                "shortcut_type" => "Module level actions",
                "module"        => ""
            ],
            [
                "key"           => "ALT + W",
                "description"   => "Companies",
                "shortcut_type" => "Module level actions",
                "module"        => ""
            ],
            [
                "key"           => "ALT + C",
                "description"   => "Claim",
                "shortcut_type" => "Module level actions",
                "module"        => ""
            ],
            [
                "key"           => "ALT + P",
                "description"   => "Policies",
                "shortcut_type" => "Module level actions",
                "module"        => ""
            ],
            [
                "key"           => "ALT + I",
                "description"   => "Preview Claim",
                "shortcut_type" => "Module level actions",
                "module"        => ""
            ],
            [
                "key"           => "ALT + J",
                "description"   => "Status",
                "shortcut_type" => "Module level actions",
                "module"        => ""
            ],
            [
                "key"           => "ALT + K",
                "description"   => "Delete",
                "shortcut_type" => "Module level actions",
                "module"        => ""
            ],

            [
                "key"           => "ALT + T",
                "description"   => "Role access",
                "shortcut_type" => "Others",
                "module"        => ""
            ],
        ];

        foreach ($keyboardShortcuts as $keyboardShortcut) {

            $keyShortcut = KeyboardShortcut::updateOrCreate([
                "description"   => $keyboardShortcut["description"],
                "shortcut_type" => $keyboardShortcut["shortcut_type"],
                "module"        => $keyboardShortcut["module"]
            ], [
                "description"   => $keyboardShortcut["description"],
                "shortcut_type" => $keyboardShortcut["shortcut_type"],
                "module"        => $keyboardShortcut["module"]
            ]);
            
            BillingCompanyKeyboardShortcut::updateOrCreate([
                "billing_company_id"   => null,
                "keyboard_shortcut_id" => $keyShortcut->id
            ], [
                "key"   => $keyboardShortcut["key"]
            ]);
        }
    }
}