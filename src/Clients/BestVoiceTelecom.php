<?php

namespace CenarioWeb\CherAmi\Clients;

use CenarioWeb\CherAmi\AbstractClient;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

class BestVoiceTelecom extends AbstractClient
{
    /**
	 * Provider API base url
	 *
	 * @var string
	 */
	private $baseUrl = 'http://apishort.bestvoice.com.br/bot';

    /**
     * Função para consultar o saldo de SMS no provedor
     *
     * @return integer
     */
    public function balance(): int
    {
        return 0;
    }

    /**
     * Função para enviar um SMS de cada vez
     *
     * @param array $data
     * @return array
     */
    public function sendSMS(array $data): array
    {
        $client = new Client([
            'base_url' => config('sms.bvtelecom.baseUrl'),
            'timeout'  => 4.2,
            'headers' => [
                'usuario' => config('sms.bvtelecom.usuario'),
                'chave' => config('sms.bvtelecom.chave')
            ]
        ]);

        $response = $client->request('POST', '', [
            'json' => [
                'celular' => $data['numero'],
                'mensagem' => $data['mensagem']
            ]
        ]);

        $body = $response->getBody();

        return collect($body)->toArray();
    }

    /**
     * Função para enviar vários SMS de uma vez
     *
     * @param array $data
     * @return array
     */
    public function sendMultipleSMS(array $data): array
    {
        return [];
    }
}