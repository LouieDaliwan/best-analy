<?php

namespace Customer\Support\Crm;

use Customer\Support\Crm\CrmApi;
use GuzzleHttp\Client;

class Crm implements Contracts\CrmInterface
{
    /**
     * The Client CRM API instance.
     *
     * @var \Customer\Support\Crm\CrmApi
     */
    protected $api;

    /**
     * Array of configuration.
     *
     * @var array
     */
    protected $config;

    /**
     * Initialize the class.
     *
     * @param \Customer\Support\Crm\CrmApi $api
     * @param array                        $config
     */
    public function __construct(CrmApi $api, array $config = [])
    {
        $this->api = $api;
        $this->config = $config;
    }

    /**
     * Retrieve the GET url of the
     * CRM API endpoint.
     *
     * @param  \Customer\Support\Crm\FileNumber $fileNumber
     * @param  array                            $params
     * @return object|mixed
     */
    public function get(FileNumber $fileNumber, array $params = []):? object
    {
        $url = sprintf($this->getUrl(), (string) $fileNumber);
        return json_decode($this->api->get($url, $params)->getBody());
    }

    /**
     * Retrieve the POST url of the
     * CRM API endpoint.
     *
     * @param  array $attributes
     * @return object|mixed
     */
    public function post(array $attributes):? object
    {
        return json_decode($this->api->post($this->postUrl(), ['form_params' => $attributes])->getBody());
    }

    /**
     * Retrieve the GET url of the CRM API endpoint.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->config['get'];
    }

    /**
     * Retrieve the POST url of the CRM API endpoint.
     *
     * @return string
     */
    public function postUrl(): string
    {
        return $this->config['post'];
    }
}
