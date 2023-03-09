<?php

declare(strict_types=1);

namespace App;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Controller
{
    public function mongo(): ResponseInterface
    {
        (new MongoLoader())();

        return new Response(204);
    }

    public function elastic(): ResponseInterface
    {
        (new ElasticLoader())();

        return new Response(204);
    }

    public function full(): ResponseInterface
    {
        (new MongoLoader())();
        (new ElasticLoader())();

        return new Response(204);
    }

    public function mongoInsertUserdata(ServerRequestInterface $request): ResponseInterface
    {
        (new MongoInsert())([$request->getQueryParams()]);

        return new Response(204);
    }
}
