<?php

return [
    'client' => [
        'base_uri' => env('CRM_BASE_URI', 'https://smartapiuat.khalifafund.ae'),
        'headers' => [
            'Accept' => 'application/json',
        ],
    ],

    'api' => [
        'get' => 'SiteVisit/GetSiteVisitByFileNo?FileNo=%s',
        'post' => 'SiteVisit/UpdateSiteVisitById',
        'document' => 'SiteVisit/UpdateSiteVisitDocumentById',
        'financial' => 'SiteVisit/AddFinancialsByFileNo',
    ],
];
