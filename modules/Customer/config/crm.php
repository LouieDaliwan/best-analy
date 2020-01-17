<?php

return [
    'client' => [
        'base_uri' => 'https://smartapiuat.khalifafund.ae',
        'headers' => [
            'Accept' => 'application/json',
        ],
    ],

    'api' => [
        'get' => 'SiteVisit/GetSiteVisitByFileNo?FileNo=%s',
        'post' => 'SiteVisit/UpdateSiteVisitById'
    ],
];
