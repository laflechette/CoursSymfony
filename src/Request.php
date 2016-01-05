<?php

class Request
{
    //constant for verb
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const PATCH = 'PATCH';
    const OPTIONS = 'OPTIONS';
    const TRACE = 'TRACE';
    const DELETE = 'DELETE';

    const HTTP = 'HTTP';
    const HTTPS = 'HTTPS';

    private $method;        //method - verb
    private $scheme;        //protocol
    private $schemeVersion; //protocol version
    private $path;          //path of resource
    private $headers;       //different headers of request
    private $body;          //body

    /**
     * Constructor.
     * @param string $method            The HTTP verb
     * @param string $path              The resource path on the server
     * @param string $scheme            The protocol name (HTTP or HTTPS)
     * @param string $schemeVersion     The scheme version (ie: 1.0, 1.1 or 2.0)
     * @param array $headers            An associative array of headers
     * @param string $body              The request content
     */
    public function __construct($method, $path, $scheme, $schemeVersion, array $headers = [], $body = '')
    {
        $this->method = $method;
        $this->path = $path;
        $this->scheme = $scheme;
        $this->schemeVersion = $schemeVersion;
        $this->headers = $headers;
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return mixed
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * @return mixed
     */
    public function getSchemeVersion()
    {
        return $this->schemeVersion;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }
}