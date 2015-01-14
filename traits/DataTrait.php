<?php namespace Bedard\AnalyticsExtension\Traits;

use Exception;
use RainLab\GoogleAnalytics\Classes\Analytics;
use System\Classes\ApplicationException;

trait DataTrait {

    /**
     * Renders the widget
     */
    public function render()
    {
        try {
            $this->renderData();
        }
        catch (Exception $ex) {
            $this->vars['error'] = $ex->getMessage();
        }

        return $this->makePartial('widget');
    }

    /**
     * Loads the analytics data
     */
    protected function loadData()
    {
        if (!$days = $this->property('days'))
            throw new ApplicationException('Invalid days value: '.$days);

        if (!$dimension = $this->property('dimension'))
            throw new ApplicationException('Invalid dimension value: '.$dimension);

        if (!$metric = $this->property('metric'))
            throw new ApplicationException('Invalid metric value: '.$metric);

        $obj = Analytics::instance();
        return $obj->service->data_ga->get(
            $obj->viewId,
            $this->property('days').'daysAgo',
            'today',
            $this->property('metric'),
            ['dimensions' => $this->property('dimension'), 'sort' => '-'.$this->property('metric')]
        );
    }

}