<?php

return [
    'videos' => [
        'Admin' => [
            [
                'title' => 'How to assign/edit user roles for users',
                'url' => url('storage/modules/faqs/admin-assign-edit-role.mp4'),
                'code' => 'faqs.admin',
            ],
            [
                'title' => 'How to download a report and email it to a company personnel',
                'url' => url('storage/modules/faqs/admin-download-report.mp4'),
                'code' => 'faqs.admin',
            ],
            [
                'title' => 'How to remove company records',
                'url' => url('storage/modules/faqs/admin-remove-company-records.mp4'),
                'code' => 'faqs.admin',
            ],
            [
                'title' => 'How to delete a wrongly generated report',
                'url' => url('storage/modules/faqs/admin-wrongly-generated-report.mp4'),
                'code' => 'faqs.admin',
            ],
        ],
        'Manager' => [
            [
                'title' => 'How to download a report and email it to a company personnel',
                'url' => url('storage/modules/faqs/manager-download-report.mp4'),
                'code' => 'faqs.manager',
            ],
            [
                'title' => 'How to delete a wrongly generated report',
                'url' => url('storage/modules/faqs/manager-wrongly-generated-report.mp4'),
                'code' => 'faqs.manager',
            ],
        ],
        'Business Counselor' => [
             [
                'title' => 'How to download a report and email it to a company personnel',
                'url' => url('storage/modules/faqs/counselor-download-report.mp4'),
                'code' => 'faqs.counselor',
            ],
        ]
    ]
];
