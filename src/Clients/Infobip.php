<?php

namespace CenarioWeb\CherAmi\Clients;

use CenarioWeb\CherAmi\AbstractClient;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

class Infobip extends AbstractClient
{
    protected $credentials = [];

    /**
	 * Provider API base url
	 *
	 * @var string
	 */
	private $baseUrl = 'http://api.messaging-service.com';

    /**
     * Função para consultar o saldo de SMS no provedor
     *
     * @return integer
     */
    public function balance(): int
    {
        return 0;
    }

    public function setCredentials(array $credentials)
    {
        $this->credentials = [
            'username' => $credentials['usuario'],
            'password' => $credentials['senha']
        ];

        return $this;
    }

    /**
     * Função para enviar um SMS de cada vez
     *
     * @param string $numero
     * @param string $mensagem
     * @param string|null $mensagemId
     * @return array
     */
    public function sendSMS(string $numero, string $mensagem, string $mensagemId = null): array
    {
        $client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout'  => 4.2,
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($this->credentials['username'] . ':' . $this->credentials['password'])
            ]
        ]);

        $response = $client->request('POST', 'sms/1/text/single', [
            'form_params' => [
                'to' => $numero,
                'text' => $mensagem
            ]
        ]);

        $body = $response->getBody();

        $content = json_decode($body->getContents());

        if (isset($content->status)) {
            throw new Exception($content->statusDetalhe, $content->status);
        }

        return collect($content)->toArray();
    }

    /**
     * Função para enviar vários SMS de uma vez
     *
     * @param array $data
     * @return array
     */
    public function sendMultipleSMS(array $data): array
    {
        $client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout'  => 4.2,
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($this->credentials['username'] . ':' . $this->credentials['password'])
            ]
        ]);

        foreach ($data as $sms) {
            $response = $client->request('POST', 'sms/1/text/single', [
                'form_params' => [
                    'to' => $sms['to'],
                    'text' => $sms['text']
                ]
            ]);
        }

        $body = $response->getBody();

        $content = json_decode($body->getContents());

        return collect($content)->toArray();
    }
}