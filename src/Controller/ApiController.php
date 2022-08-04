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

    public function getIdPokemons(int $var): array {
        $IdPokemons = $this->getAPI('pokemon/?limit=' . $var);
        return $IdPokemons["results"];
    }

    public function getIdsPokemons(int $var): array {
        
        $URLs = array();

        for ($i = 1; $i < $var; $i++) {
            $URL = $this->getAPI('pokemon/?limit=' . $var);
            $URL = $URL["results"][$i]["url"];
            $URLs[] = $URL;
        }

        return $URLs;
    }

    public function getIdssPokemons(int $var): array {
        
        $URLs = array();

        for ($i = 1; $i < $var; $i++) {
            $URL = $this->getAPI('pokemon/?limit=' . $var);
            $URL = $URL["results"][$i]["url"];
            $URLs[] = $URL;
        }

        return $URLs;
    }

    public function getInfosPokemon(): array {
        $InfosPokemon = $this->getAPI('pokemon/1');
        return $InfosPokemon;
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