<?php

return [
    'description' => 'The Business Sustainability practices and procedures were further analysed based on how well the documentation procedures, personnel, ICT and work processes were being managed.',

	'documentation' => [
        'greaterThan90' => ':name has an excellent documentation practice. Continue reviewing how existing practices can be improved.',
		'50to90' => ':name has a very good documentation policies & practices in place. Advisable to look into how :item1 can be better executed.',
        '30to50' => ':name has fair documentation procedures and practices in place. Advisable to look into how well :item1 and :item2 can be better implemented.',
        'less30' => "No documentation practices recorded. & Organization needs to start implementing a comprehensive review & systematic documentation relating to matters such as work culture and strategic plans."
        // 'less30' => 'Poor documentation practices recorded. & Organisation to start implementing a comprehensive review & systematic documentation relating to matters such as operating procedures and strategic plans.',
	],
	'talent' => [
        'greaterThan90' => 'Excellent employee development and management practices. Keeping employees up to date is desirable for all organisations. Continue to review organisational culture to retain talent.',
		'50to90' => "Very good employee management and development. An area to consider focusing is on :item1.",
		'30to50' => 'Fair involvement of employees in strategic matters. Organisation is recommended to focus on how employees can be better involved by looking into :item1 & :item2.',
        'less30' => 'Poor talent development processes and practices observed. & While it may seemed less of a priority, more needs to be done across all areas impacting employees directly to uplift their involvement and satisfaction.',
		// 'less30' => 'Poor talent development processes and practices recorded. More can be done across all areas impacting employees directly to uplift their work satisfaction.',
	],
	'technology' => [
        'greaterThan90' => "Excellent ICT implementation. Continue to upkeep the ICT to further organisation's operational and management needs.",
		'50to90' => 'Very good technology adoption. Greater technology adoption across the organisation is advisable to enhance operational processes.',
		'30to50' => 'Fair ICT system is in place. :name should focus on how current and new technology adopted can reflect better alignment and usability, especially in terms of :item1.',
		// 'less30' => 'Poor technology adoption reported. Significant improvement in technology adoption recommended to improve overall organisational operating practices.',
        'less30' => "Absence of digital solutions within organization. & Appropriate investment into solutions recommended to improve overall organizational operating practices."
	],
	'workflow' => [
        'greaterThan90' => 'Excellent workflow processes. Ensure continuous monitoring and reviewing processes to maintain an effective and efficient operations based on its future technological needs and talent available.',
		'50to90' => 'Very good internal processes in place. Immediate efforts may be channeled towards :item1 & :item2.',
		'30to50' => 'Fair implementation of process within :name. More could still be done to ensure that its desired outcomes are achieved relating to :item1, :item2 & :item3.',
		// 'less30' => "Poor organisational processes & practices. Clearer processes and timely communication is advisable to ensure everyone is clear of the organisation's strategies and operating culture.",
        'less30' => "Poor organizational processes & practices. Clearer processes and timely communication is advisable to ensure everyone is clear of the organization's strategies and work culture."
	],
];
