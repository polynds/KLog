<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace KLog\Server\Event;

use Swoole\Http\Request;
use Swoole\Http\Response;

class RouterDispatchEvent
{
    protected Request $request;

    protected Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function setRequest(Request $request): self
    {
        $this->request = $request;
        return $this;
    }

    public function getResponse(): Response
    {
        return $this->response;
    }

    public function setResponse(Response $response): self
    {
        $this->response = $response;
        return $this;
    }
}
