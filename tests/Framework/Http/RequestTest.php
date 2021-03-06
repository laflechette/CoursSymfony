<?php

namespace Tests\Framework\Http;

use Framework\Http\Request;

class RequestTest extends \PHPUnit_Framework_TestCase
{

    public function testAddSameHttpHeaderTwice()
    {
        $headers = [
            'Content-type' => 'text/xml',
            'CONTENT-TYPE' => 'application/json',
        ];

        new Request('GET', '/', 'HTTP', '1.1', $headers);
    }


    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider provideInvalidHttpScheme
     */
    public function testUnsupportedHttpScheme($scheme)
    {
        new Request('GET', '/', $scheme, '1.1');
    }

    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider provideInvalidHttpScheme
     */
    public function testSupportedHttpScheme($scheme)
    {
        new Request('GET', '/', $scheme, '1.1');
    }

    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider provideInvalidHttpScheme
     */
    public function testUnsupportedHttpSchemeVersion($schemeVersion)
    {
        new Request('GET', '/', 'HTTP', $schemeVersion);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider provideInvalidHttpScheme
     */
    public function testSupportedHttpSchemeVersion($schemeVersion)
    {
        new Request('GET', '/', 'HTTP', $schemeVersion);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider provideInvalidHttpMethod
     */
    public function testUnsupportedHttpMethod($method)
    {
        new Request($method, '/', 'HTTP', '1.1');
    }

    public function provideInvalidHttpMethod()
    {
        return [
            ['FOO'],
            ['BAR'],
            ['BAZ'],
            ['PURGE'],
            ['TOTO'],
        ];
    }

    public function provideInvalidHttpScheme()
    {
        return [
            ['FTP'],
            ['SFTP'],
            ['SSH'],
        ];
    }

    public function provideInvalidHttpSchemeVersion()
    {
        return [
            ['3.9'],
            ['6.9'],
            ['8.6'],
        ];
    }

    /**
     * @dataProvider providerRequestParameters
     */
    public function testCreateRequestInstance($method, $path)
    {
        $request = new Request($method, $path, Request::HTTP, '1.1', [
            'Host' => 'http://wikipedia.com',
            'User-Agent' => 'Mozilla/Firefox'
        ]);

        $this->assertSame($method, $request->getMethod());
        $this->assertSame($path, $request->getPath());
        $this->assertSame(Request::HTTP, $request->getScheme());
        $this->assertSame('1.1', $request->getSchemeVersion());
        $this->assertCount(2, $request->getHeaders());
        $this->assertSame(
            ['host' => 'http://wikipedia.com', 'user-agent' => 'Mozilla/Firefox'],
            $request->getHeaders()
        );
        $this->assertSame('http://wikipedia.com', $request->getHeader('Host'));
        $this->assertSame('Mozilla/Firefox', $request->getHeader('User-Agent'));
        $this->assertEmpty($request->getBody());
    }

    public function providerRequestParameters()
    {
        return [
            [Request::GET,      '/'                 ],
            [Request::POST,     '/home'             ],
            [Request::PUT,      '/foo'              ],
            [Request::PATCH,    '/bar'              ],
            [Request::OPTIONS,  '/options'          ],
            [Request::CONNECT,  '/lol'              ],
            [Request::TRACE,    '/contact'          ],
            [Request::HEAD,     '/fr/article/42'    ],
            [Request::DELETE,   '/cgv'              ],
        ];
    }

    public function provideRequestHttpScheme()
    {
        return [
            [Request::HTTP, ],
            [Request::HTTPS, ]
        ];
    }

    public function provideRequestHttpSchemeVersion()
    {
        return [
            [Request::VERSION_1_0],
            [Request::VERSION_1_1],
            [Request::VERSION_2_0]
        ];
    }
}
