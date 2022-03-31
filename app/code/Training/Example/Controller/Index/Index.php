<?php

namespace Training\Example\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Framework\App\Action\Action {

    protected $pageFactory;

    public function __construct(Context $context, PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {

        $lat = '21.0245';
        $lon = '105.8412';
        $api_key = '439d4b804bc8187953eb36d2a8c26a02';
        $api_url = 'https://openweathermap.org/data/2.5/onecall?lat=' . $lat . '&lon=' . $lon . '&units=metric&appid=' . $api_key;

        $weather_data = json_decode(file_get_contents($api_url), true);

        $day1_temp = $weather_data['daily'][0]['temp'];
        $day1_main_description = $weather_data['daily'][0]['weather'][0]['main'];
        $day1_icon = $weather_data['daily'][0]['weather'][0]['icon'];
        $day1_timestamp = $weather_data['daily'][0]['dt'];

        echo "<pre>";
        print_r($weather_data['daily'][0]);
//        print_r($day1_description);
        echo getdate($day1_timestamp)["weekday"].' '.date("d/m/Y",$day1_timestamp);
        echo "<img src='http://openweathermap.org/img/wn/".$day1_icon."@2x.png' />";
//        return $this->pageFactory->create();
    }
}
