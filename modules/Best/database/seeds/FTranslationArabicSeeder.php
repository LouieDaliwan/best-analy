<?php

use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;

class FTranslationArabicSeeder extends Seeder
{
    protected $words = [
        'SME Ratings Report' => 'تقرير تقييم أداء المؤسسة',
        'Gross Margin' => 'الهامش الإجمالي',
        'Net Margin after Tax' => 'الهامش الصافي بعد الضريية',
        'Current Ratio' => 'معامل السيولة',
        'Debt Ratio' => 'نسبة الدين',
        'ROI' => 'عائد الاستثمار',
        'Raw Materials Margin' => 'هامش الموارد الخام',
        'Excellent' => 'ممتاز',
        'Good' => 'جيد',
        'Moderate' => 'متوسط',
        'Poor' => 'ضعيف',
        'Very Poor' => 'ضعيف جدا',
        'Industrial' => 'مجال الصناعي',
        'Non Industrial' => 'مجال غير الصناعي',
        'Immediate efforts should be focused on improving production processes through cost cutting automation' => 'التركيز الفوري على إعادة تخطيط عملية الإنتاج والمواد الخام لضمان هامش ربح إجمالي الأصح',
        'Business sustainability is in a very serious situation, requiring immediate improvements to remain viable' => ' استدامة الأعمال التجارية في وضع بالغ الخطورة، ويحتاج إلى تحسينات فورية للحفاظ على قابلية الاستمرار',
        'Business may be in a critically difficult situation to be able to meet its short term financial obligations and will need to source for additional liquidity' => 'وقد تكون الأعمال التجارية في وضع صعب للغاية لكي تتمكن من الوفاء بالتزاماتها المالية القصيرة الأجل، وستحتاج إلى توفير سيولة إضافية',
        'With a very heavy short and long-term financial burden, business may need to resort to bring in additional business partners while improving its asset proportion' => 'مع عبء مالي ثقيل للغاية على المديين القصير والطويل، قد تحتاج الأعمال التجارية إلى الاستعانة بشركاء أعمال إضافيين مع تحسين نسبة أصولها',
        'Business should review the key purpose of the investment and explore alternative strategies to mitigate and revive the gains from the investment' => 'ينبغي أن تستعرض الأعمال التجارية الغرض الرئيسي من الاستثمار وأن تستكشف إستراتيجيات بديلة للتخفيف الخسائر وإحياء المكاسب من الاستثمار',
        'Critical consideration to review existing suppliers and partners, widen the group of suppliers available and/or negotiate for a significant reduction in costs to ensure a healthy and sustainable business operations' => 'إعتبار بالغ الأهمية لاستعراض الموردين والشركاء الحاليين، وتوسيع مجموعة الموردين المتاحين و/أو التفاوض من أجل تخفيض كبير في التكاليف لكفالة عمليات تجارية سليمة ومستدامة',
        'Serious consideration to seek alternative suppliers to significantly improve profitability' => 'النظر بجدية في البحث على الموردين البديلين لتحسين الربحية بقدر كبير',
        'Given the very slim margin, business may risk slipping into losses. Aggressive business development required to improve business sustainability' => 'قد تقع الشركة على الخسائر نظرا إلى هامش الربح الضئيل. فمن الضرورة، تطوير الأعمال التجارية على شكل فعّال لتحسين إستدامة الأعمال',
        'A review of asset management while reducing short-term liabilities will be necessary to bring the business out of potential payment defaults' => ' إستعراض إدارة الأصول مع خفض الالتزامات القصيرة الأجل ضروريا لإخراج الشركة من التخلف المحتمل عن السداد',
        'Rebalancing the books to strengthen the assets should be implemented to remain business viability while also attractingpotntial funding agencies' => ' ينبغي تنفيذ إعادة التوازن في الدفاتر من أجل تعزيز الأصول حتى تبقى الشركة قادرة على استمرار في مجال الأعمال التجارية، مع الاستعانة أيضا لجذب الوكالات التمويل المحتملة',
        'Revist the business plan to review prior sales estimates and marketing drivers' => 'مراجعة خطة العمل للستعراض تقديرات المبيعات السابقة وبرامج تشغيل التسويق',
        'Strengthen partnership with existing supply partners to gain better price and improved margin' => 'تعزيز الشراكة مع شركاء التوريد الحاليين لحصول على الأسعار الأحسن وتحسين هامش الربح',
        'Room to expand and explore several other suppliers to further reduce cost of goods sold' => 'هناك مجال لتوسيع واستكشاف عدة موردين آخرين لزيادة تخفيض تكلفة السلع المباعة',
        'While margin remains within respectable level, business should explore reducing operational costs through comprehensive review of operations' => 'بينما يبقى الهامش ضمن مستوى مقبول، ينبغي للأعمال التجارية أن تستكشف خفض التكاليف التشغيلية من خلال إستعراض شامل للعمليات',
        'While asset to liquidity remains within the fence, efforts should go towards improving short term credits and risk analysis' => 'بينما تبقى الأصول المخصصة للسيولة داخل السياج، فتكون الجهود متجها إلى تحسين الائتمانات القصيرة الأجل وتحليل المخاطر',
        'While debt looks within marginally acceptable means, close review of borrowings will be wlecomed to mitigate both long term and short term cash impact'  => 'بينما الديون تبدو في حدود مقبولة ، الاستعراض الدقيق للاقتراض مرغوبا لتخفيف التأثيرات النقدية في المديين القصير والطويل',
        'A review of business strategy is recommended to explore operational improvements and technology adoption into business operations' => 'من المستحسن ، إجراء إستعراض لاستراتيجية الأعمال التجارية حتى تستكشف التحسينات التشغيلية واعتماد التكنولوجيا في العمليات التجارية',
        'While margin remains within modest levels, volatility in pricing due to external factors calls for a more cautious approach and risk diversification' => 'بينما الهامش ضمن مستويات متواضعة، فتقلب الأسعار بسبب عوامل خارجية يتطلب نهجا أكثر حذرا وتنويع المخاطر',
        'To remain sustainable, good to explore additional suppliers to improve profitability' => 'للحفاظ على الاستدامة، من الجيد أن يستكشف موردين إضافيين لتحسين الربحية',
        'Safe levels achieved by business to push performance to a higher level through better technology adoption' => '  تحقق الأعمال التجارية مستويات آمنة لدفع الأداء إلى مستوى أعلى باعتماد على التكنواوجيا الأفضل _ بطريق تحسين اعتماد التكنولوجي',
        'Heatlhy net profit levels to be retained for now while exploring greater automation to further streamline the work process' => 'الحفاظ على مستويات صافي الأرباح العالية حاليا مع استكشاف إمكانية أتمتة أكبر لزيادة تبسيط عملية تدفق العمل',
        'Business is in a steadfast situation while keeping long term obligations within sufficient means' => 'الأعمال التجارية في وضع ثابت مع الحفاظ على الالتزامات طويلة الأجل بأداء كافية',
        'Healthy investment likely to lead better future for business' => 'الاستثمار الصحي من المرجح أن يقود مستقبلا أفضل للشركة',
        'Positive margins could help in finding appropriatemale partner for further explansion' => 'قد تساعد الهوامش الإيجابية في إيجاد شريك مناسب للمزيد من التوسع',
        'To continue be cautious of potential cost increase due to external factors and changing economic situation' => 'يبقى حذرا على الزيادة المحتملة في التكاليف بسبب العوامل الخارجية وتغير الحالة الاقتصادية',
        'Continue to enhance IT systems to ensure continued efforts go towards enhancing values, reshaping business goals' => 'مواصلة تحسين أنظمة تقنية المعلومات لضمان مواصلة الجهود متجها إلى تعزيز القيم وإعادة صياغة أهداف الشركات',
        'Continue to monitor and keep indicators monitored 24/7' => 'متابعة مراقبة المؤاشرات على مدار الساعة',
        'Recommended to maintaindebt levels' => 'من المستحتن ، الحفاظ على مستويات الدين',
        'Firm position to continue expansionary strategies' => 'الموقف الثابت لمواصلة الاستراتيجيات التوسعية',
        'Retain existing suppliers while continuing to monitor and reduce direct costs further optimising profits levels' => 'الاحتفاظ بالموردين الحاليين مع الاستمرار في مراقبة التكاليف المباشرة وخفضها مما يزيد من تحسين مستويات الأرباح',
        'Excellent Gross Margin by Non-Industrial standards' => 'الهامش الإجمالي ممتاز حسب المعاييرمجال غير الصناعي',
        'Excellent Gross Margin by Industrial standards' => 'الهامش الإجمالي ممتاز حسب المعاييرمجال الصناعي',
        'Good Gross Margin by Non-Industrial standards' => 'الهامش الإجمالي جيد حسب المعاييرمجال غير الصناعي',
        'Good Gross Margin by Industrial standards' => 'الهامش الإجمالي جيد حسب المعاييرمجال الصناعي',
        'Moderate Gross Margin by Non-Industrial standards' => 'الهامش الإجمالي متوسط حسب المعاييرمجال غير الصناعي',
        'Moderate Gross Margin by Industrial standards' => 'الهامش الإجمالي متوسط حسب المعاييرمجال الصناعي',
        'Poor Gross Margin by Non-Industrial standards' => 'الهامش الإجمالي ضعيف حسب المعاييرمجال غير الصناعي',
        'Poor Gross Margin by Industrial standards' => 'الهامش الإجمالي ضعيف حسب المعاييرمجال الصناعي',
        'Very Poor Gross Margin by Non-Industrial standards' => 'الهامش الإجمالي ضعيف جدا حسب المعاييرمجال غير الصناعي',
        'Very Poor Gross Margin by Industrial standards' => 'الهامش الإجمالي ضعيف جدا حسب المعاييرمجال الصناعي',
        'Excellent Net Margin after Tax by Non-Industrial standards' => 'الهامش الصافي بعد الضريية ممتاز حسب المعاييرمجال غير الصناعي',
        'Excellent Net Margin after Tax by Industrial standards' => 'الهامش الصافي بعد الضريية ممتاز حسب المعاييرمجال الصناعي',
        'Good Net Margin after Tax by Non-Industrial standards' => 'الهامش الصافي بعد الضريية جيد حسب المعاييرمجال غير الصناعي',
        'Good Net Margin after Tax by Industrial standards' => 'الهامش الصافي بعد الضريية جيد حسب المعاييرمجال الصناعي',
        'Moderate Net Margin after Tax by Non-Industrial standards' => 'الهامش الصافي بعد الضريية متوسط حسب المعاييرمجال غير الصناعي',
        'Moderate Net Margin after Tax by Industrial standards' => 'الهامش الصافي بعد الضريية متوسط حسب المعاييرمجال الصناعي',
        'Poor Net Margin after Tax by Non-Industrial standards' => 'الهامش الصافي بعد الضريية ضعيف حسب المعاييرمجال غير الصناعي',
        'Poor Net Margin after Tax by Industrial standards' => 'الهامش الصافي بعد الضريية ضعيف حسب المعاييرمجال الصناعي',
        'Very Poor Net Margin after Tax by Non-Industrial standards' => 'الهامش الصافي بعد الضريية ضعيف جدا حسب المعاييرمجال غير الصناعي',
        'Very Poor Net Margin after Tax by Industrial standards' => 'الهامش الصافي بعد الضريية ضعيف جدا حسب المعاييرمجال الصناعي',
        'Excellent Current Ratio by Non-Industrial standards' => 'معامل السيولة ممتاز حسب المعاييرمجال غير الصناعي',
        'Excellent Current Ratio by Industrial standards' => 'معامل السيولة ممتاز حسب المعاييرمجال الصناعي',
        'Good Current Ratio by Non-Industrial standards' => 'معامل السيولة جيد حسب المعاييرمجال غير الصناعي',
        'Good Current Ratio by Industrial standards' => 'معامل السيولة جيد حسب المعاييرمجال الصناعي',
        'Moderate Current Ratio by Non-Industrial standards' => 'معامل السيولة متوسط حسب المعاييرمجال غير الصناعي',
        'Moderate Current Ratio by Industrial standards' => 'معامل السيولة متوسط حسب المعاييرمجال الصناعي',
        'Poor Current Ratio by Non-Industrial standards' => 'معامل السيولة ضعيف حسب المعاييرمجال غير الصناعي',
        'Poor Current Ratio by Industrial standards' => 'معامل السيولة ضعيف حسب المعاييرمجال الصناعي',
        'Very Poor Current Ratio by Non-Industrial standards' => 'معامل السيولة ضعيف جدا حسب المعاييرمجال غير الصناعي',
        'Very Poor Current Ratio by Industrial standards' => 'معامل السيولة ضعيف جدا حسب المعاييرمجال الصناعي',
        'Excellent Debt Ratio by Non-Industrial standards' => 'نسبة الدين ممتاز حسب المعاييرمجال غير الصناعي',
        'Excellent Debt Ratio by Industrial standards' => 'نسبة الدين ممتاز حسب المعاييرمجال الصناعي',
        'Good Debt Ratio by Non-Industrial standards' => 'نسبة الدين جيد حسب المعاييرمجال غير الصناعي',
        'Good Debt Ratio by Industrial standards' => 'نسبة الدين جيد حسب المعاييرمجال الصناعي',
        'Moderate Debt Ratio by Non-Industrial standards' => 'نسبة الدين متوسط حسب المعاييرمجال غير الصناعي',
        'Moderate Debt Ratio by Industrial standards' => 'نسبة الدين متوسط حسب المعاييرمجال الصناعي',
        'Poor Debt Ratio by Non-Industrial standards' => 'نسبة الدين ضعيف حسب المعاييرمجال غير الصناعي',
        'Poor Debt Ratio by Industrial standards' => 'نسبة الدين ضعيف حسب المعاييرمجال الصناعي',
        'Very Poor Debt Ratio by Non-Industrial standards' => 'نسبة الدين ضعيف جدا حسب المعاييرمجال غير الصناعي',
        'Very Poor Debt Ratio by Industrial standards' => 'نسبة الدين ضعيف جدا حسب المعاييرمجال الصناعي',
        'Excellent ROI by Non-Industrial standards' => 'عائد الاستثمار ممتاز حسب المعاييرمجال غير الصناعي',
        'Excellent ROI by Industrial standards' => 'عائد الاستثمار ممتاز حسب المعاييرمجال الصناعي',
        'Good ROI by Non-Industrial standards' => 'عائد الاستثمار جيد حسب المعاييرمجال غير الصناعي',
        'Good ROI by Industrial standards' => 'عائد الاستثمار جيد حسب المعاييرمجال الصناعي',
        'Moderate ROI by Non-Industrial standards' => 'عائد الاستثمار متوسط حسب المعاييرمجال غير الصناعي',
        'Moderate ROI by Industrial standards' => 'عائد الاستثمار متوسط حسب المعاييرمجال الصناعي',
        'Poor ROI by Non-Industrial standards' => 'عائد الاستثمار ضعيف حسب المعاييرمجال غير الصناعي',
        'Poor ROI by Industrial standards' => 'عائد الاستثمار ضعيف حسب المعاييرمجال الصناعي',
        'Very Poor ROI by Non-Industrial standards' => 'عائد الاستثمار ضعيف جدا حسب المعاييرمجال غير الصناعي',
        'Very Poor ROI by Industrial standards' => 'عائد الاستثمار ضعيف جدا حسب المعاييرمجال الصناعي',
        'Excellent Raw Materials Margin by Non-Industrial standards' => 'هامش الموارد الخام ممتاز حسب المعاييرمجال غير الصناعي',
        'Excellent Raw Materials Margin by Industrial standards' => 'هامش الموارد الخام ممتاز حسب المعاييرمجال الصناعي',
        'Good Raw Materials Margin by Non-Industrial standards' => 'هامش الموارد الخام جيد حسب المعاييرمجال غير الصناعي',
        'Good Raw Materials Margin by Industrial standards' => 'هامش الموارد الخام جيد حسب المعاييرمجال الصناعي',
        'Moderate Raw Materials Margin by Non-Industrial standards' => 'هامش الموارد الخام متوسط حسب المعاييرمجال غير الصناعي',
        'Moderate Raw Materials Margin by Industrial standards' => 'هامش الموارد الخام متوسط حسب المعاييرمجال الصناعي',
        'Poor Raw Materials Margin by Non-Industrial standards' => 'هامش الموارد الخام ضعيف حسب المعاييرمجال غير الصناعي',
        'Poor Raw Materials Margin by Industrial standards' => 'هامش الموارد الخام ضعيف حسب المعاييرمجال الصناعي',
        'Very Poor Raw Materials Margin by Non-Industrial standards' => 'هامش الموارد الخام ضعيف جدا حسب المعاييرمجال غير الصناعي',
        'Very Poor Raw Materials Margin by Industrial standards' => 'هامش الموارد الخام ضعيف جدا حسب المعاييرمجال الصناعي',
        'Immediate focus would be to re-strategise the production process and choice of raw materials suppliers to ensure a healthier gross profit margin' => '.تركيز الجهود الفورية على تحسين عمليات الإنتاج من خلال التشغيل الآلي لخفض التكاليف',
        "The SME Ratings Report (SME Ratings) is an organizational scorecard that measures five fundamental elements of performance, namely Business Sustainability, Productivity & Financial Management, Human Resource and Strategy Development & Management. The Report provides relevant diagnostics relating to the effectiveness and impact of the organization's functions and how well these are align to the vision and strategy of the organization." => "تقرير تقييم أداء المؤسسة (SME Ratings)هو سجل أداء تنظيمي الذي يقيس 5 عناصر أساسية للأداء، وهي استدامة الأعمال، وإدارة الإنتاجية، وإدارة المالية، والموارد البشرية، ووضع الاستراتيجيات وإدارتها. ويقدم التقرير التشخيصات لفعّالية وتأثير وظائف المؤسسة ومدى اتساقهما مع الرؤية واستراتيجيتها.",
        "This highlights the ability to translate organizational expansion strategies into concrete development interventions through effective resource utilization, marketing strategies and compliance with standards to drive business opportunities" => "هذا يسلط الضوء على القدرة تحويل إستراتيجيات التوسع التنظيمي إلى تدخلات إنمائية من خلال الاستخدام الفعّال للموارد، واستراتيجيات التسويق، والامتثال للمعايير لدفع فرص الأعمال التجارية",
        "SDMI is measured by 5 elements namely; Business Expansion, Marketing Strategies, Capacity Utilisation, Certification & Standards and Location" => "يقاس مؤشر SDMI ب 5 عناصر هي: توسيع الأعمال، واستراتيجيات التسويق، وإستغلال السعة، والشهادة و المقاييس، والموقع.",
        "The SME Ratings Score gives the organization an idea of how well the core functions of the organization are performing in addition to its financial performance. Through our comprehensive review, the score is organized into 4 broad categories:" => "تعطي نتيجة تقييم أداء المؤسسة (SME Ratings) فكرة عن مدى جودة وظائف الأساسية للمؤسسة بالإضافة إلى أدائها المالي. ومن خلال مراجعتنا الشاملة، يتم تنظيم النتيجة في أربع فئات عريضة:",
        "Failed" => "-فشل",
        "Critical" => "-خطير",
        "Corrective Action" => "-إجراء تصحيحي",
        "Normal" => "-عادي",
        "It is important that the understanding, perception and observation of an organization cannot be relied upon from an individual only. A collective observation from multiple individuals is critical to ensure that a better understanding of an organisation is achieved. Hence, a minimum sample size of 5 to 10% of the total organisation staff strength is RECOMMENDED to complete the series of questionnaire to ensure the reliability of the report is not compromised" => "ومن المهم، ألا يعتمد على فهم المؤسسة وتصورها وملاحظتها من جانب فرد واحد فحسب. فالمراقبة الجماعية من عدة أفراد هي أمر حاسم لضمان تحقيق فهم الأفضل للمؤسسة. ولضمان موثوقية التقرير ، يوصى باستكمال سلسلة الاستبيان بحد أدنى من حجم العينة يتراوح بين 5 و 10 في المائة من مجموع قوام موظفي المؤسسة.",
        "Alternatively, the inputs given by the representative of the organization can be validated through the observation and sharing of evidences with a 3rd-party Business Advisor" => "وبدلا من ذلك، يمكن التحقق من المدخلات المقدَّمة من ممثِّل المؤسسة من خلال مراقبة الأدلة وتبادلها مع مستشار تجاري تابع لطرف ثالث.",
        "Report Printed on" => "تقرير طبع في",
        "Business Growth And Marketing Strategy Index" => "مؤشر استراتجية التسويق ونمو الأعمال",
    ];

    public function run() :void
    {
        foreach ($this->words as $word => $ar) {
            LanguageLine::updateOrCreate([
                'group' => '*',
                'key' => $word,
            ], [
                'group' => '*',
                'text' => [
                    'en' => $word,
                    'ar' => $ar
                ],
            ]);
        }

    }
}
