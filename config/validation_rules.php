<?php

return [
    'formatJson' => [
        'rules' => [
            'data.jsonString' => 'required|string',
        ],
        'errorMessages' => [
            'data.jsonString.required' => 'jsonString:為必填',
            'data.jsonString.string' => 'jsonString:只能為string',
        ],
    ],
];
