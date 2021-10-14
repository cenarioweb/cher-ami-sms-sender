<?php

namespace CenarioWeb\CherAmi\Clients;

use CenarioWeb\CherAmi\AbstractClient;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

class BestVoiceTelecom extends AbstractClient
{
    protected $credentials = [];

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

    public function setCredentials(array $credentials)
    {
        $this->credentials = [
            'usuario' => $credentials['usuario'],
            'chave' => $credentials['chave']
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
            'base_uri' => 'https://apishort.bestvoice.com.br/bot/',
            'timeout'  => 4.2,
            'headers' => [
                'usuario' => $this->credentials['usuario'],
                'chave' => $this->credentials['chave']
            ]
        ]);

        $response = $client->request('POST', 'single-sms.php', [
            'json' => [
                'celular' => $numero,
                'mensagem' => $mensagem,
                'parceiroId' => $mensagemId
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
            'base_uri' => 'https://apishort.bestvoice.com.br/bot/',
            'timeout'  => 4.2,
            'headers' => [
                'usuario' => $this->credentials['usuario'],
                'chave' => $this->credentials['chave']
            ]
        ]);

        $response = $client->request('POST', 'bulk-sms.php', [
            'json' => [
                'bulk' => $data
            ]
        ]);

        $body = $response->getBody();

        $content = json_decode($body->getContents());

        return collect($content)->toArray();
    }
}