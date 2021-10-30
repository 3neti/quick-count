<?php

use App\Models\Contact;

return [
	'table_names' => [
        'airtime_contact' => 'airtime_contact',
        'airtimes' => 'airtimes',
		'contacts' => 'contacts',
        'smss'     => 's_m_s_s',
		'relays'   => 'relays',
        'topups'   => 'topups',
	],
    'classes' => [
        'models' => [
            'airtime' => \LBHurtado\Missive\Models\Airtime::class,
            'contact' => Contact::class,
            'relay' => \LBHurtado\Missive\Models\Relay::class,
            'sms' => \LBHurtado\Missive\Models\SMS::class,
            'topups' => \LBHurtado\Missive\Models\Topup::class,
        ],
        'pivots' => [
            'airtime_contact' => \LBHurtado\Missive\Pivots\AirtimeContact::class
        ],
        'commands' => [
            'sms' => [
                'create' => \LBHurtado\Missive\Commands\CreateSMSCommand::class
            ]
        ],
        'handlers' => [
            'sms' => [
                'create' => \LBHurtado\Missive\Handlers\CreateSMSHandler::class
            ]
        ],
        'middlewares' => [
            'sms' => [
                'relay' => [
                    \LBHurtado\Missive\Validators\CreateSMSValidator::class,
                    \LBHurtado\Missive\Transforms\CreateSMSTransform::class,
                    \LBHurtado\Missive\Responders\CreateSMSResponder::class,
//                \LBHurtado\Missive\Actions\Middleware\ChargeSMSMiddleware::class,
                ],
                'verify' => [
                    \LBHurtado\Missive\Validators\CreateSMSValidator::class,
                    \LBHurtado\Missive\Responders\CreateSMSResponder::class,
                    \LBHurtado\Missive\Actions\Middleware\VerifyContactHandler::class,
//                    \LBHurtado\Missive\Actions\Middleware\ChargeSMSMiddleware::class,
                ],
                'topup' => [
                    \LBHurtado\Missive\Validators\CreateSMSValidator::class,
                    \LBHurtado\Missive\Responders\CreateSMSResponder::class,
                    \LBHurtado\Missive\Actions\Middleware\TopupMobileHandler::class,
//                    \LBHurtado\Missive\Actions\Middleware\ChargeSMSMiddleware::class,
                ],
            ],
        ],
    ],
    'relay' => [
        'default' => env('MISSIVE_RELAY', 'local'),
        'providers' => [
            'local' => [
                'from' => 'from',
                'to' => 'to',
                'message' => 'message',
            ],
            'telerivet' => [
                'from' => 'from_number',
                'to' => 'to_number',
                'message' => 'content',
            ],
        ],
    ],
    'otp' => [
        'period' => env('DEFAULT_OTP_PERIOD', 60 * 60),
    ],
];
