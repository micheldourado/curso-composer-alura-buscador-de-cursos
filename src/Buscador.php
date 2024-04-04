<?php

namespace Alura\BuscadorDeCursos;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Buscador
{
    private $httpClient;
    private $crawler;
    public function __construct(ClientInterface $httpCliente,  Crawler $crawler){
        $this->httpClient = $httpCliente;
        $this->crawler = $crawler;
    }

    public function buscar(string $url): array{
        $response = $this->httpClient->request("GET",$url);
        $html= $response->getBody();
        $crawler = new Crawler();
        $crawler -> addHtmlContent($html);

        $elementosCursos = $crawler ->filter('span.card-curso__nome');
        $cursos = [];

        foreach($elementosCursos as $elemento){
            $cursos[] = $elemento->textContent;
        }
    return $cursos;

    }
}
