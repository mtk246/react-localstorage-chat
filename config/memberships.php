<?php

declare(strict_types=1);

return [
    'default_roles' => [
        [
            'name' => 'Account Manager',
            'slug' => 'accountmanager',
            'description' => 'Allows access to system functions for account manager management',
        ],
        [
            'name' => 'Biller',
            'slug' => 'biller',
            'description' => 'Allows access to system functions for biller management',
        ],
        [
            'name' => 'Payment Processor',
            'slug' => 'paymentprocessor',
            'description' => 'Allows access to system functions for payment processor management',
        ],
        [
            'name' => 'Collector',
            'slug' => 'collector',
            'description' => 'Allows access to system functions for collector management',
        ],
    ],
];
