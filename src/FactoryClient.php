<?php

namespace CenarioWeb\CherAmi;

use CenarioWeb\CherAmi\Exceptions\InvalidProviderException;

class FactoryClient
{
    protected $services = [
        // 'bvtelecom' => [
        //     'name' => 'Best Voice Telecom',
        //     'class' => \CenarioWeb\CherAmi\Clients\BestVoiceTelecom::class
        // ],
        'infobip' => [
            'name' => 'Infobip',
            'class' => \CenarioWeb\CherAmi\Clients\Infobip::class
        ]
        // 'kingsms' => \CenarioWeb\CherAmi\Clients\KingSms::class,
        // 'mobizon' => \CenarioWeb\CherAmi\Clients\Mobizon::class,
        // 'smsdev' => \CenarioWeb\CherAmi\Clients\SmsDev::class,
        // 'zenvia' => \CenarioWeb\CherAmi\Clients\Zenvia::class
    ];

    protected $config = [];

    public function get($name)
    {
        if (! isset($this->services[$name])) {
            throw new InvalidProviderException(sprintf("O Client %s não foi encontrada", $name));
        }

        $client = $this->services[$name]['class'];

        return new $client($this->config[$name]['class']);
    }

    public function listServices()
    {
        $services = [];

        foreach ($this->services as $key => $service) {
            array_push($services, [
                'id' => $key,
                'name' => $service['name']
            ]);
        }

        return $services;
    }
}