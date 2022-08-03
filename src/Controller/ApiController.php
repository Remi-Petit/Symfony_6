<?php
// src/Controller/ApiController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiController {

    private $client;

    public function __construct(HttpClientInterface $client) {
        $this->client = $client;
    }

    public function getPokemons(): array {
        $Pokemons = $this->getAPI('pokemon/?limit=20');
        return $Pokemons["results"];
    }

    private function getAPI(string $var): array {
        $response = $this->client->request(
            'GET',
            //'https://pokeapi.co/api/v2/pokemon/?limit=20&offset=20'
            'https://pokeapi.co/api/v2/' . $var
        );

        return $response->toArray();
    }
}