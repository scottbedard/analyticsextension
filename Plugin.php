<?php namespace Bedard\AnalyticsExtension;

use System\Classes\PluginBase;

/**
 * AnalyticsExtension Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return  array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Analytics Extension',
            'description' => 'Extra widgets for RainLab.GoogleAnalytics.',
            'author'      => 'Scott Bedard',
            'icon'        => 'icon-bar-chart'
        ];
    }

    /**
     * Returns the extra report widgets.
     * 
     * @return  array
     */
    public function registerReportWidgets()
    {
        return [
            'Bedard\AnalyticsExtension\ReportWidgets\BarChart' => [
                'label'     => 'Google Analytics custom bar chart',
                'context'   => 'dashboard'
            ],
            'Bedard\AnalyticsExtension\ReportWidgets\PercentageChart' => [
                'label'     => 'Google Analytics custom percentage chart',
                'context'   => 'dashboard'
            ],
            'Bedard\AnalyticsExtension\ReportWidgets\PieChart' => [
                'label'     => 'Google Analytics custom pie chart',
                'context'   => 'dashboard'
            ],
        ];
    }

}
