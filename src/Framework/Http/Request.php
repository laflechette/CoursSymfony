<?php

namespace Framework\Http;

class Request
{
    //constant for verb
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const PATCH = 'PATCH';
    const OPTIONS = 'OPTIONS';
    const CONNECT = 'CONNECT';
    const TRACE = 'TRACE';
    const HEAD = 'HEAD';
    const DELETE = 'DELETE';

    const HTTP = 'HTTP';
    const HTTPS = 'HTTPS';

    const VERSION_1_0 = '1.0';
    const VERSION_1_1 = '1.1';
    const VERSION_2_0 = '2.0';

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
        $this->setMethod($method);
        $this->path = $path;
        $this->setScheme($scheme);
        $this->setSchemeVersion($schemeVersion);
        $this->headers = $headers;
        $this->body = $body;
    }

    /**
     * @param string $method
     */
    public function setMethod($method)
    {
        $methods = [
            self::GET,
            self::POST,
            self::PUT,
            self::PATCH,
            self::OPTIONS,
            self::CONNECT,
            self::TRACE,
            self::HEAD,
            self::DELETE,
        ];

        if(!in_array($method, $methods)) {
            throw new \InvalidArgumentException(sprintf(
                'Method %s is not supported and must be one of %s.',
                $method,
                implode(', ', $methods)
            ));
        }
        $this->method = $method;
    }

    /**
     * @param $scheme
     */
    private function setScheme($scheme)
    {

        $schemes = [ self::HTTP, self::HTTPS ];

        if(!in_array($scheme, $schemes)) {
            throw new \InvalidArgumentException(sprintf(
                'Scheme %s is not supported and must be one of %s.',
                $scheme,
                implode(', ', $schemes)
            ));
        }
        $this->scheme = $scheme;
    }


    private function setSchemeVersion($schemeVersion)
    {

        $schemeVersions = [ self::VERSION_1_0, self::VERSION_1_1, self::VERSION_2_0 ];

        if(!in_array($schemeVersion, $schemeVersions)) {
            throw new \InvalidArgumentException(sprintf(
                'Scheme %s is not supported and must be one of %s.',
                $schemeVersion,
                implode(', ', $schemeVersions)
            ));
        }
        $this->schemeVersion = $schemeVersion;
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