<?php

namespace Customer\Services\Crm;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CrmApiClient
{
    /**
     * Instantiate the http property.
     *
     * @param \GuzzleHttp\Client $http
     */
    public function __construct(Client $http)
    {
        return $this->http = $http;
    }

    /**
     * Perform a GET request.
     *
     * @param  string $url
     * @param  mixed  $parameters
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function get($url, $parameters = [])
    {
        return $this->http->request(Request::METHOD_GET, $url, $parameters);
    }

    /**
     * Perform a POST request.
     *
     * @param  string $url
     * @param  mixed  $parameters
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function post($url, $parameters = [])
    {
        return $this->http->request(Request::METHOD_POST, $url, $parameters);
    }
}
