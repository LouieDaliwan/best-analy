<?php

namespace Core\Widgets;

use Core\Application\Widget\AbstractWidget;
use Illuminate\Foundation\Inspiring;

class InspiringQuote extends AbstractWidget
{
    /**
     * The alias of the widget when calling
     * from the widget container.
     *
     * @var string
     */
    protected $alias = 'inspiring';

    /**
     * The widget description.
     *
     * @var string
     */
    protected $description = 'Output an inspiring quote.';

    /**
     * The interval in seconds
     * before reloading content.
     *
     * False means the widget will not reload.
     *
     * @var integer|float|boolean
     */
    protected $intervals = 10000;

    /**
     * Render the widget into the view.
     *
     * @return string|null
     */
    public function handle()
    {
        return view('widgets::inspire')->withQuote(Inspiring::quote());
    }
}
