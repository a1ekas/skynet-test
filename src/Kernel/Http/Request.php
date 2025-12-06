<?php

declare(strict_types=1);

namespace App\Kernel\Http;

class Request
{
    private bool|string|null $content = null;

    private ?string $method = null;

    private array $headers;

    /**
     * @param mixed[] $query
     * @param mixed[] $request
     * @param mixed[] $server
     */
    public function __construct(private $query = [], private $request = [], private $server = [])
    {
        $this->headers = $this->initHeaders();
    }

    public static function fromGlobals(): Request
    {
        return new static($_GET, $_POST, $_SERVER);
    }

    /**
     * Returns the request body content.
     */
    public function getContent(): string
    {
        if (null === $this->content) {
            $this->content = file_get_contents('php://input');
        }

        return $this->content;
    }

    /**
     * Returns request method
     */
    public function getMethod(): string
    {
        if (null === $this->method) {
            $this->method = strtoupper((string) $this->server['REQUEST_METHOD']) ?: 'GET';
        }

        return $this->method;
    }

    /**
     * Returns a header value by name.
     *
     * @param string $key The header name
     * @param mixed $default The default value
     */
    public function getHeader($key): ?string
    {
        $key = strtr(strtolower($key), '_', '-');

        if (!array_key_exists($key, $this->headers)) {
            return null;
        }

        return $this->headers[$key];
    }

    /**
     * Returns the requested URI (path and query string).
     */
    public function getRequestUri(): string
    {
        return $this->server['REQUEST_URI'];
    }

    /**
     * Returns the requested URI (path without query string).
     */
    public function getPathInfo(): string
    {
        if ('/' === ($requestUri = $this->getRequestUri())) {
            return $requestUri;
        }

        // Remove the query string from REQUEST_URI
        if ($pos = strpos($requestUri, '?')) {
            return substr($requestUri, 0, $pos);
        }

        return $requestUri;
    }

    /**
     * Checks request content type that is json
     */
    public function isJson(): bool
    {
        return str_contains((string) $this->getHeader('Accept'), 'application/json');
    }

    /**
     * Find and save http header
     */
    private function initHeaders(): array
    {
        $headers = [];
        $contentHeaders = ['CONTENT_LENGTH' => true, 'CONTENT_MD5' => true, 'CONTENT_TYPE' => true];

        foreach ($this->server as $key => $value) {
            if (str_starts_with((string) $key, 'HTTP_')) {
                $headers[strtr(strtolower(substr((string) $key, 5)), '_', '-')] = $value;
            } elseif (isset($contentHeaders[$key])) {
                $headers[strtr(strtolower($key), '_', '-')] = $value;
            }
        }

        return $headers;
    }
}
