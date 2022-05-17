<?php defined('BASEPATH') or exit('No direct script access allowed');

use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot;
use LINE\LINEBot\MessageBuilder\RawMessageBuilder;

function line_message_appointment($settings, $customer, $service, $appointment){
    if (!empty($customer['lineuserid'])){
        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(config('line_access_token'));
        $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => config('line_secret')]);

        $RawMessageBuilder = new \LINE\LINEBot\MessageBuilder\RawMessageBuilder(
            [
                'type' => 'flex',
                'altText' => '預約服務訊息',
                'contents' => [
                    'type' => 'bubble',
                        'body' => [
                            'type' => 'box',
                            'layout' => 'vertical',
                            'contents' => [
                                [
                                    'type' => 'text',
                                    'text' => '預約待審核',
                                    'weight' => 'bold',
                                    'color' => '#1DB446',
                                    'size' => 'sm'
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $settings['company_name'],
                                    'weight' => 'bold',
                                    'size' => 'xxl',
                                    'margin' => 'md'
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $settings['company_address'],
                                    'size' => 'xs',
                                    'color' => '#aaaaaa',
                                    'wrap' => true
                                ],
                                [
                                    'type' => 'separator',
                                    'margin' => 'xxl'
                                ],
                                [
                                    'type' => 'box',
                                    'layout' => 'vertical',
                                    'margin' => 'xxl',
                                    'spacing' => 'sm',
                                    'contents' => [
                                        [
                                            'type' => 'box',
                                            'layout' => 'horizontal',
                                            'contents' => [
                                                [
                                                    'type' => 'text',
                                                    'text' => '姓名',
                                                    'size' => 'sm',
                                                    'color' => '#555555',
                                                    'flex' => 0
                                                ],
                                                [
                                                    'type' => 'text',
                                                    'text' => $customer['last_name'] .  $customer['first_name'],
                                                    'size' => 'sm',
                                                    'color' => '#111111',
                                                    'align' => 'end'
                                                ]
                                            ]
                                        ],
                                        [
                                            'type' => 'box',
                                            'layout' => 'horizontal',
                                            'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '預約日期',
                                            'size' => 'sm',
                                            'color' => '#555555',
                                            'flex' => 0
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $appointment['start_datetime'],
                                            'size' => 'sm',
                                            "color" => '#111111',
                                            'align' => 'end'
                                        ]
                                    ]
                                ],
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'contents' => [
                                        [
                                            'type'=> 'text',
                                            'text' => '預約時間',
                                            'size' => 'sm',
                                            'color' => '#555555',
                                            'flex' => 0
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $appointment['end_datetime'],
                                            'size' => 'sm',
                                            'color' => '#111111',
                                            'align' => 'end'
                                        ]
                                    ]
                                ],
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '預約服務',
                                            'size' => 'sm',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $service['name'],
                                            'size' => 'sm',
                                            'color' => '#111111',
                                            'align' => 'end'
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        [
                            'type' => 'separator',
                            'margin' => 'xxl'
                        ],
                        [
                            'type' => 'box',
                            'layout' => 'horizontal',
                            'margin' => 'md',
                            'contents' => [
                                [
                                    'type' => 'text',
                                    'text' => '預約服務審核中，如有疑問請洽店家',
                                    'size' => 'xs',
                                    'color' => '#aaaaaa',
                                    'flex' => 0
                                ]
                            ]
                        ]
                    ]
                ],
                'styles' => [
                    'footer' => [
                        'separator' => true
                    ]
                ]
            ]
        ]);
        
        $bot->pushMessage($customer['lineuserid'], $RawMessageBuilder);
    }
}

function line_message_change($settings, $customer, $service, $appointment){
    if(!empty($customer['lineUserId'])){
        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(config('line_access_token'));
        $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => config('line_secret')]);

        $message_title = '預約服務成功訊息';
        $message_result = '預約服務成功訊息';
        $message_tip = '預約成功，請提前 30 分鐘前往。';
        if ($appointment['situation'] == 2) {
            $message_title = '預約服務已遭取消';
            $message_result = '預約服務審核被拒';
            $message_tip = '審核被拒，煩請與店家確認';
        }

        $RawMessageBuilder = new \LINE\LINEBot\MessageBuilder\RawMessageBuilder([
            'type' => 'flex',
            'altText' => $message_title,
            'contents' => [
                'type' => 'bubble',
                    'body' => [
                        'type' => 'box',
                        'layout' => 'vertical',
                        'contents' => [
                            [
                                'type' => 'text',
                                'text' => $message_result,
                                'weight' => 'bold',
                                'color' => '#1DB446',
                                'size' => 'sm'
                            ],
                            [
                                'type' => 'text',
                                'text' => $settings['company_name'],
                                'weight' => 'bold',
                                'size' => 'xxl',
                                'margin' => 'md'
                            ],
                            [
                                'type' => 'text',
                                'text' => $settings['company_address'],
                                'size' => 'xs',
                                'color' => '#aaaaaa',
                                'wrap' => true
                            ],
                            [
                                'type' => 'separator',
                                'margin' => 'xxl'
                            ],
                            [
                                'type' => 'box',
                                'layout' => 'vertical',
                                'margin' => 'xxl',
                                'spacing' => 'sm',
                                'contents' => [
                                    [
                                        'type' => 'box',
                                        'layout' => 'horizontal',
                                        'contents' => [
                                            [
                                                'type' => 'text',
                                                'text' => '姓名',
                                                'size' => 'sm',
                                                'color' => '#555555',
                                                'flex' => 0
                                            ],
                                            [
                                                'type' => 'text',
                                                'text' => $customer['last_name'] .  $customer['first_name'],
                                                'size' => 'sm',
                                                'color' => '#111111',
                                                'align' => 'end'
                                            ]
                                        ]
                                    ],
                                    [
                                        'type' => 'box',
                                        'layout' => 'horizontal',
                                        'contents' => [
                                    [
                                        'type' => 'text',
                                        'text' => '預約日期',
                                        'size' => 'sm',
                                        'color' => '#555555',
                                        'flex' => 0
                                    ],
                                    [
                                        'type' => 'text',
                                        'text' => $appointment['start_datetime'],
                                        'size' => 'sm',
                                        "color" => '#111111',
                                        'align' => 'end'
                                    ]
                                ]
                            ],
                            [
                                'type' => 'box',
                                'layout' => 'horizontal',
                                'contents' => [
                                    [
                                        'type'=> 'text',
                                        'text' => '預約時間',
                                        'size' => 'sm',
                                        'color' => '#555555',
                                        'flex' => 0
                                    ],
                                    [
                                        'type' => 'text',
                                        'text' => $appointment['end_datetime'],
                                        'size' => 'sm',
                                        'color' => '#111111',
                                        'align' => 'end'
                                    ]
                                ]
                            ],
                            [
                                'type' => 'box',
                                'layout' => 'horizontal',
                                'contents' => [
                                    [
                                        'type' => 'text',
                                        'text' => '預約服務',
                                        'size' => 'sm',
                                        'color' => '#555555'
                                    ],
                                    [
                                        'type' => 'text',
                                        'text' => $service['name'],
                                        'size' => 'sm',
                                        'color' => '#111111',
                                        'align' => 'end'
                                    ]
                                ]
                            ]
                        ]
                    ],
                    [
                        'type' => 'separator',
                        'margin' => 'xxl'
                    ],
                    [
                        'type' => 'box',
                        'layout' => 'horizontal',
                        'margin' => 'md',
                        'contents' => [
                            [
                                'type' => 'text',
                                'text' => $message_tip,
                                'size' => 'xs',
                                'color' => '#aaaaaa',
                                'flex' => 0
                            ]
                        ]
                    ]
                ]
            ],
            'styles' => [
                'footer' => [
                    'separator' => true
                ]
            ]
        ]
    ]);
        $bot->pushMessage($customer['lineUserId'], $RawMessageBuilder);
    }
}

function line_message_delete($settings, $customer, $service, $appointment){
    if(!empty($customer['lineUserId'])){
        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(config('line_access_token'));
        $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => config('line_secret')]);

        $RawMessageBuilder = new \LINE\LINEBot\MessageBuilder\RawMessageBuilder([
            'type' => 'flex',
            'altText' => '預約服務刪除成功訊息',
            'contents' => [
                'type' => 'bubble',
                    'body' => [
                        'type' => 'box',
                        'layout' => 'vertical',
                        'contents' => [
                            [
                                'type' => 'text',
                                'text' => '預約刪除',
                                'weight' => 'bold',
                                'color' => '#1DB446',
                                'size' => 'sm'
                            ],
                            [
                                'type' => 'text',
                                'text' => $settings['company_name'],
                                'weight' => 'bold',
                                'size' => 'xxl',
                                'margin' => 'md'
                            ],
                            [
                                'type' => 'text',
                                'text' => $settings['company_address'],
                                'size' => 'xs',
                                'color' => '#aaaaaa',
                                'wrap' => true
                            ],
                            [
                                'type' => 'separator',
                                'margin' => 'xxl'
                            ],
                            [
                                'type' => 'box',
                                'layout' => 'vertical',
                                'margin' => 'xxl',
                                'spacing' => 'sm',
                                'contents' => [
                                    [
                                        'type' => 'box',
                                        'layout' => 'horizontal',
                                        'contents' => [
                                            [
                                                'type' => 'text',
                                                'text' => '姓名',
                                                'size' => 'sm',
                                                'color' => '#555555',
                                                'flex' => 0
                                            ],
                                            [
                                                'type' => 'text',
                                                'text' => $customer['last_name'] .  $customer['first_name'],
                                                'size' => 'sm',
                                                'color' => '#111111',
                                                'align' => 'end'
                                            ]
                                        ]
                                    ],
                                    [
                                        'type' => 'box',
                                        'layout' => 'horizontal',
                                        'contents' => [
                                    [
                                        'type' => 'text',
                                        'text' => '預約日期',
                                        'size' => 'sm',
                                        'color' => '#555555',
                                        'flex' => 0
                                    ],
                                    [
                                        'type' => 'text',
                                        'text' => $appointment['start_datetime'],
                                        'size' => 'sm',
                                        "color" => '#111111',
                                        'align' => 'end'
                                    ]
                                ]
                            ],
                            [
                                'type' => 'box',
                                'layout' => 'horizontal',
                                'contents' => [
                                    [
                                        'type'=> 'text',
                                        'text' => '預約時間',
                                        'size' => 'sm',
                                        'color' => '#555555',
                                        'flex' => 0
                                    ],
                                    [
                                        'type' => 'text',
                                        'text' => $appointment['end_datetime'],
                                        'size' => 'sm',
                                        'color' => '#111111',
                                        'align' => 'end'
                                    ]
                                ]
                            ],
                            [
                                'type' => 'box',
                                'layout' => 'horizontal',
                                'contents' => [
                                    [
                                        'type' => 'text',
                                        'text' => '預約服務',
                                        'size' => 'sm',
                                        'color' => '#555555'
                                    ],
                                    [
                                        'type' => 'text',
                                        'text' => $service['name'],
                                        'size' => 'sm',
                                        'color' => '#111111',
                                        'align' => 'end'
                                    ]
                                ]
                            ]
                        ]
                    ],
                    [
                        'type' => 'separator',
                        'margin' => 'xxl'
                    ],
                    [
                        'type' => 'box',
                        'layout' => 'horizontal',
                        'margin' => 'md',
                        'contents' => [
                            [
                                'type' => 'text',
                                'text' => '預約審核通過，拒絕才會收到此訊息，如有疑問請洽店家',
                                'size' => 'xs',
                                'color' => '#aaaaaa',
                                'flex' => 0
                            ]
                        ]
                    ]
                ]
            ],
            'styles' => [
                'footer' => [
                    'separator' => true
                ]
            ]
        ]
    ]);
        $bot->pushMessage($customer['lineUserId'], $RawMessageBuilder);
    }
}

function line_message_cronjob($provider, $settings, $customer, $service, $appointment){
    if (!empty($provider['lineuserid'])){
        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(config('line_access_token'));
        $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => config('line_secret')]);

        $RawMessageBuilder = new \LINE\LINEBot\MessageBuilder\RawMessageBuilder(
            [
                'type' => 'flex',
                'altText' => '預約服務提醒訊息',
                'contents' => [
                    'type' => 'bubble',
                        'body' => [
                            'type' => 'box',
                            'layout' => 'vertical',
                            'contents' => [
                                [
                                    'type' => 'text',
                                    'text' => '預約日期即將到達',
                                    'weight' => 'bold',
                                    'color' => '#1DB446',
                                    'size' => 'sm'
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $settings['company_name'],
                                    'weight' => 'bold',
                                    'size' => 'xxl',
                                    'margin' => 'md'
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $settings['company_address'],
                                    'size' => 'xs',
                                    'color' => '#aaaaaa',
                                    'wrap' => true
                                ],
                                [
                                    'type' => 'separator',
                                    'margin' => 'xxl'
                                ],
                                [
                                    'type' => 'box',
                                    'layout' => 'vertical',
                                    'margin' => 'xxl',
                                    'spacing' => 'sm',
                                    'contents' => [
                                        [
                                            'type' => 'box',
                                            'layout' => 'horizontal',
                                            'contents' => [
                                                [
                                                    'type' => 'text',
                                                    'text' => '姓名',
                                                    'size' => 'sm',
                                                    'color' => '#555555',
                                                    'flex' => 0
                                                ],
                                                [
                                                    'type' => 'text',
                                                    'text' => $customer['last_name'] .  $customer['first_name'],
                                                    'size' => 'sm',
                                                    'color' => '#111111',
                                                    'align' => 'end'
                                                ]
                                            ]
                                        ],
                                        [
                                            'type' => 'box',
                                            'layout' => 'horizontal',
                                            'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '預約日期',
                                            'size' => 'sm',
                                            'color' => '#555555',
                                            'flex' => 0
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $appointment['start_datetime'],
                                            'size' => 'sm',
                                            "color" => '#111111',
                                            'align' => 'end'
                                        ]
                                    ]
                                ],
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'contents' => [
                                        [
                                            'type'=> 'text',
                                            'text' => '預約時間',
                                            'size' => 'sm',
                                            'color' => '#555555',
                                            'flex' => 0
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $appointment['end_datetime'],
                                            'size' => 'sm',
                                            'color' => '#111111',
                                            'align' => 'end'
                                        ]
                                    ]
                                ],
                                [
                                    'type' => 'box',
                                    'layout' => 'horizontal',
                                    'contents' => [
                                        [
                                            'type' => 'text',
                                            'text' => '預約服務',
                                            'size' => 'sm',
                                            'color' => '#555555'
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $service['name'],
                                            'size' => 'sm',
                                            'color' => '#111111',
                                            'align' => 'end'
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        [
                            'type' => 'separator',
                            'margin' => 'xxl'
                        ],
                        [
                            'type' => 'box',
                            'layout' => 'horizontal',
                            'margin' => 'md',
                            'contents' => [
                                [
                                    'type' => 'text',
                                    'text' => '預約服務日期即將到達',
                                    'size' => 'xs',
                                    'color' => '#aaaaaa',
                                    'flex' => 0
                                ]
                            ]
                        ]
                    ]
                ],
                'styles' => [
                    'footer' => [
                        'separator' => true
                    ]
                ]
            ]
        ]);
        
        $bot->pushMessage($provider['lineuserid'], $RawMessageBuilder);
    }
}
