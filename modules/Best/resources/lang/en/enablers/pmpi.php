<?php

return [
    'description' => 'The Productivity Management practices and processes were further analysed based on how well the documentation procedures, personnel, ICT and work processes were being managed.',

	'documentation' => [
        'greaterThan90' => ':name has excellent documentation practices. Continue to assess how existing practices can be improved',
		'50to90' => ':name has a very good documentation policies & practices in place. Advisable to look into how well :item1 can be better executed.',
        '30to50' => ':name has a fair documentation procedures and practices in place. Advisable to look into how well :item1 and :item2 can be better executed.',
        'less30' => 'Poor documentation practices recorded. :name has to start implementing a comprehensive review & systematic documentation of productivity practices & reporting within this immediate term.',
	],
	'talent' => [
        'greaterThan90' => 'Excellent employee development and management practices. This should be maintained to ensure everyone is onboard with the productivity drive.',
		'50to90' => "Very good employee productivity development. One area to probably focus on is on :item1.",
		'30to50' => 'Fair productivity practices and management. Organisation is recommended to focus on how employees can be prepared to execute :item1 & :item2.',
		'less30' => 'Poor talent development processes and practices recorded. More can be done to inculcate appropriate productivity awareness and practices among employees.',
	],
	'technology' => [
        'greaterThan90' => 'Excellent ICT implementation. Continue to upkeep the ICT to complement operational work processes.',
		'50to90' => 'Very good technology adoption. Greater technology adoption across the organisation is advisable to measure and monitor productivity initiatives and performances.',
		'30to50' => 'Fair ICT system is in place. :name should focus on how the system is being streamlined to reflect better usability, especially in terms of :item1.',
		'less30' => 'Poor ICT implementation reported. Significant technology improvements highly recommended to improve organisational productivity.',
        'less30' => "Absence of digital adoption observed. & Significant investment into technology highly recommended to improve organizational productivity."
	],
	'workflow' => [
        'greaterThan90' => 'Excellent workflow processes. Ensure continuous monitoring to maintain effective execution of roles and functions.',
		'50to90' => 'Very good productivity processes in place. Immediate efforts should be channeled towards :item1 & :item2.',
		// '30to50' => 'Fair implementation of process within :name. More could still be done to ensure that its desired outcome is achieved relating to :item1, :item2 & :item3.',
        '30to50' => "Decent implementation of processes within :name. More could still be done to ensure that its desired outcome is achieved relating to :item1, :item2 & :item3.",
		// 'less30' => "Poor workflow processes recorded. Clearer processes with timely communication processes are critical within the immediate period.",
        'less30' => "Poor workflow processes recorded. & Clearer processes with timely communication processes are critically required within the immediate period."
	],
];
