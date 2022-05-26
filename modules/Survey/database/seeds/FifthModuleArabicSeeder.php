<?php
use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;
use Survey\Models\Survey;
use Survey\Models\Field;

class FifthModuleArabicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lists = [
            'Business Expansion' => 'توسيع الأعمال',
            'There are plans to grow the business (bigger space, more locations) given positive performance' => 'هناك خطط لتطوير العمل (مساحة أكبر، مواقع أكثر) نظرا للأداء الإيجابي',
            'Clear plans are prepared on when the business should grow' => 'يتم إعداد خطط واضحة حول موعد نمو الأعمال',
            'Appropriate systems and processes are in place should the opportunity to grow the business arise' =>	'يتم توفير الأنظمة والعمليات المناسبة في حال ظهور فرصة لتطوير الأعمال',
            'Extent products/or services are ready to be exported' =>	'مدى جاهزية المنتجات/الخدمات للتصدير',
            'Marketing Strategies' =>	'إستراتيجيات التسويق',
            'Clear marketing plan prepared to attract your desired customers' => 'يتم اعداد خطة تسويق لجذب العملاء المرغوب فيهم',
            'Appropriate marketing channels (social media, newspaper, flyers) used to communicate about the products and/or services' =>	'استخدام قنوات التسويق المناسبة (الوسائل التواصل الاجتماعية والصحف والنشرات الإعلانية) للإعلان عن المنتجات و/أو الخدمات',
            'Sufficient resources (manpower and/or budget) have been provided to perform marketing effectively' =>	'تم توفير موارد كافية (القوى العاملة و/أو الميزانية) لإجراء التسويق بفعالية',
            'Capacity Utilisation' => 'إستغلال السعة',
            'What is the current utilisation of your business capacity?' =>	 'ما هو معدل الاستخدام الحالي لسعة شركتك؟',
            'Endorsement, Certification & Standards (Hygiene, Service Quality, ISO,etc.)' => 'تظهير، شهادة و مقاييس ( النظافة وجودة الخدمة و ISO، إلخ)',
            'Endorsement, Certification & Standards' => 'تظهير، شهادة و مقاييس ',
	        "Location (Describe your level of satisfaction with your current business location's ability to serve customers)" =>	"موقع ( صف مستوى رضاك عن امكانية موقع شركتك الحالي على خدمة العملاء.)",
	        'Value (Size compared to rental fee)' =>'القيمة (الحجم بالمقارنة مع رسوم الإيجار)',
            'Customer Volume (Footfall)' =>	'حجم العملاء (الإقبال)',
            'Strongly Disagree' => 'غير موافق بشدة' ,
            'Disagree' => 'غير موافق ',
            'Moderately Agree' => 'موافق باعتدال ',
            'Agree' => 'موافق',
            'Strongly Agree' => 'موافق بشدة',
            'Minimum standards required by the authorities are met' => 'استيفاء أدنى الحد من المقاييس التي تطلبها الهيئات',
            'Critical certifications and standards are acquired to maintain high standards in the business' => 'يتم الحصول على الشهادات والمقاييس الهامة للمحافظة على مستويات عالية في الأعمال',
            'Certifications & Standards acquired over and above requirements to drive business growth & innovation' => 'الشهادات والمعايير التي تم الحصول عليها فوق المتطلبات لتحفيز نمو الأعمال والابتكار',
            'I am not aware of any industry standards or certifications required' => 'ليس لدي علم بأي معايير الصناعية أو شهادات المطلوبة لهذا النطاق',
            'There are no industry standards required in my business' => 'لا توجد معايير الصناعية المطلوبة في شركتي',
            'Least Satisfied' => 'أقل رضا',
            'Very Satisfied' => 'راض جدا'
        ];

        foreach ($lists as $keyList => $keyItem) {
            LanguageLine::updateOrCreate([
                'group' => '*',
                'key' => $keyList ?? null,
            ], [
                'group' => '*',
                'text' => [
                    'en' => $keyList,
                    'ar' => $keyItem
                ],
            ]);
        }

        
    }
}
