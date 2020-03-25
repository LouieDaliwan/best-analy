<?php

return [
    'description' => 'The HR administration and management were further analysed based on how well the documentation procedures, personnel, ICT and work processes were being managed.',

    'documentation' => [
        'greaterThan90' => ":name has excellent documentation practices. Continue to assess how existing practices can be improved.",
        '50to90' => ':name has very good documentation policies & practices in place. Advisable to look into how :item1 can be better executed.',
        '30to50' => ':name has fair documentation procedures and practices in place. Advisable to look into how well :item1 and :item2 can be better implemented.',
        'less30' => ':name has recorded poor documentation practices. Organisation to start implementing a comprehensive review & systematic documentation of all HR policies & practices to facilitate employee management.',
    ],
    'talent' => [
        'greaterThan90' => "Excellent employee development and management practices. Continue to maintain and review favourable talent development and retention strategies.",
        '50to90' => "Very good employee management and development. An area to consider focusing is on :item1.",
        '30to50' => 'Fair HR management practices and processes. Organisation is recommended to focus on how employees can be better managed by looking into :item1 & :item2.',
        'less30' => 'Poor talent development processes and practices recorded. More can be done across all areas impacting employees directly to uplift their work satisfaction.',
    ],
    'technology' => [
        'greaterThan90' => "Excellent ICT implementation. Continue to upkeep the ICT to further organisation's personnel growth.",
        '50to90' => 'Very good technology adoption. Greater technology adoption across the organisation is advisable to better manage and monitor HR processes & practices.',
        '30to50' => 'Fair ICT system is in place. :name should focus on how current and new technology adopted can reflect better alignment and usability, especially in terms of :item1.',
        'less30' => 'Poor technology adoption reported. Significant improvement in technology adoption recommended to improve overall organisational HR practices.',
    ],
    'workflow' => [
        'greaterThan90' => "Excellent workflow processes. Ensure continuous monitoring to maintain effective execution of roles and functions.",
        '50to90' => 'Very good HR processes in place. Immediate efforts should be channeled towards :item1 & :item2.',
        '30to50' => 'Fair implementation of processes within :name. More could still be done to ensure that its desired outcome is achieved relating to :item1, :item2 & :item3.',
        'less30' => "Poor HR processes & practices. Thorough review of the workflow processes recommended beginning with the areas identified below.",
    ],
];