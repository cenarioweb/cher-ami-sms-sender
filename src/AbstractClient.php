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
     * Função para adicionar as credenciais para autenticação
     *
     * @param array $credentials
     * @return void
     */
    abstract public function setCredentials(array $credentials);

    /**
     * Função para enviar um SMS de cada vez
     *
     * @param string $numero
     * @param string $mensagem
     * @param string|null $mensagemId
     * @return array
     */
    abstract public function sendSMS(string $numero, string $mensagem, string $mensagemId = null): array;

    /**
     * Função para enviar vários SMS de uma vez
     *
     * @param array $data
     * @return array
     */
    abstract public function sendMultipleSMS(array $data): array;
}