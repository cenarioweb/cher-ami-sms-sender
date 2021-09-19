<?php

return [
    /**
     * Credenciais da API da Best Voice Telecomunicações
     * https://www.bvtelecom.com.br/
     */
	'bvtelecom' => [
        'baseUrl' => env('BVTELECOM_BASEURL', 'https://apishort.bestvoice.com.br/bot/'),
        'usuario' => env('BVTELECOM_USUARIO'),
        'chave' => env('BVTELECOM_CHAVE')
    ],

    /**
     * Credenciais da API da King SMS
     * https://www.kingsms.com.br/
     */
    'kingsms' => [
        'baseUrl' => env('KINGSMS_BASEURL', 'http://painel.kingsms.com.br/kingsms/'),
        'login' => env('KINGSMS_LOGIN'),
        'token' => env('KINGSMS_TOKEN')
    ],

    /**
     * Credenciais da API da Mobizon
     * https://mobizon.com.br/
     */
    'mobizon' => [
        'baseUrl' => env('MOBIZON_BASEURL', 'https://api.mobizon.com.br'),
        'chave' => env('MOBIZON_CHAVE')
    ],

    /**
     * Credenciais da API da SMS Dev
     * https://www.smsdev.com.br/
     */
    'smsdev' => [
        'baseUrl' => env('SMSDEV_BASEURL', 'https://api.smsdev.com.br/v1/'),
        'chave' => env('SMSDEV_CHAVE')
    ],

    /**
     * Credenciais da API da Zenvia
     * https://www.zenvia.com/
     */
    'zenvia' => [
        'baseUrl' => env('ZENVIA_BASEURL', 'https://api.zenvia.com/v2/'),
        'token' => env('ZENVIA_TOKEN')
    ]
];
