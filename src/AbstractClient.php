<?php

namespace CenarioWeb\CherAmi;

abstract class AbstractClient
{
    /**
     * Função para consultar o saldo de SMS no provedor
     *
     * @return integer
     */
    abstract public function balance(): int;

    /**
     * Função para enviar um SMS de cada vez
     *
     * @param array $data
     * @return array
     */
    abstract public function sendSMS(array $data): array;

    /**
     * Função para enviar vários SMS de uma vez
     *
     * @param array $data
     * @return array
     */
    abstract public function sendMultipleSMS(array $data): array;
}