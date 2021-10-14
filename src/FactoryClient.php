<?php

namespace CenarioWeb\CherAmi;

use CenarioWeb\CherAmi\Exceptions\InvalidProviderException;

class FactoryClient
{
    protected $services = [
        'bvtelecom'  => \CenarioWeb\CherAmi\Clients\BestVoiceTelecom::class
        // 'kingsms' => \CenarioWeb\CherAmi\Clients\KingSms::class,
        // 'mobizon' => \CenarioWeb\CherAmi\Clients\Mobizon::class,
        // 'smsdev' => \CenarioWeb\CherAmi\Clients\SmsDev::class,
        // 'zenvia' => \CenarioWeb\CherAmi\Clients\Zenvia::class
    ];

    protected $config = [];

    // public function __construct(array $config)
    // {
    //     $this->config = $config;
    // }

    public function get($name)
    {
        if (! isset($this->services[$name])) {
            throw new InvalidProviderException(sprintf("O Client %s não foi encontrada", $name));
        }

        $client = $this->services[$name];

        return new $client($this->config[$name]);
    }
}