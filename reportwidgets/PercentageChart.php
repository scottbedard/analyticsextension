<?php namespace Bedard\AnalyticsExtension\ReportWidgets;

use Backend\Classes\ReportWidgetBase;

/**
 * Google Analytics custom percentage chart
 */
class PercentageChart extends ReportWidgetBase
{
    use \Bedard\AnalyticsExtension\Traits\DataTrait;

    /**
     * Define widget properties
     * @return  array
     */
    public function defineProperties()
    {
        return [
            'title' => [
                'title'             => 'Widget title',
                'default'           => 'Percentage Chart',
                'type'              => 'string',
                'validationPattern' => '^.+$',
                'validationMessage' => 'The Widget Title is required.'
            ],
            'dimension' => [
                'title'             => 'Dimension',
                'type'              => 'string',
                'validationPattern' => '^ga:[a-zA-Z]+$',
                'validationMessage' => 'That does not appear to be a valid analytics dimension.'
            ],
            'metric' => [
                'title'             => 'Metric',
                'default'           => 'ga:visits',
                'type'              => 'string',
                'validationPattern' => '^ga:[a-zA-Z]+$',
                'validationMessage' => 'That does not appear to be a valid analytics metric.'
            ],
            'dimensionLabel' => [
                'title'             => 'Dimension label',
                'type'              => 'string'
            ],
            'metricLabel' => [
                'title'             => 'Metric label',
                'type'              => 'string',
                'default'           => 'Visits'
            ],
            'days' => [
                'title'             => 'Days to display',
                'default'           => '30',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$'
            ],
            'number' => [
                'title'             => 'Results to display',
                'default'           => '10',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'description'       => 'A value of 0 will display all results.'
            ]
        ];
    }

    /**
     * Render the widget data
     */
    protected function renderData()
    {
        $data = $this->loadData();

        $rows = $data->getRows() ?: [];
        $number = $this->property('number') ?: 0;
        $this->vars['rows'] = $number > 0
            ? array_slice($rows, 0, $number)
            : $data->getRows();

        $total = 0;
        foreach ($rows as $row)
            $total += $row[1];

        $this->vars['total'] = $total;
    }
}