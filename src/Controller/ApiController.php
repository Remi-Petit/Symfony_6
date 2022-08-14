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

    public function getPokemons(int $var): array {
        $InfoPokes = $this->getAPI('pokemon/?limit=' . $var)["results"];
        return $InfoPokes;
    }

    public function getPokemon(string $id): array {
        $InfosPokemon = $this->getAPI('pokemon/' . $id);
        return $InfosPokemon;
    }

    public function getPokemonPlus(string $id): array {
        $InfosPokemon = $this->getAPI('pokemon-species/' . $id);
        return $InfosPokemon;
    }

    public function getPokemonEvolutions(string $url): array {
        $PokeEvolution = $this->client->request(
            'GET',
            $url
        );
        $PokeEvolution = $PokeEvolution->toArray();
        $Evolution = array();
        // EVOLUTION 1
        $Evolution[] = $PokeEvolution["chain"]["species"];
        // EVOLUTION 2
        if (isset($PokeEvolution["chain"]["evolves_to"][0]["species"])) {
            $Evolution[] = $PokeEvolution["chain"]["evolves_to"][0]["species"];
        }
        // EVOLUTION 3
        if (isset($PokeEvolution["chain"]["evolves_to"][0]["evolves_to"][0]["species"])) {
            $Evolution[] = $PokeEvolution["chain"]["evolves_to"][0]["evolves_to"][0]["species"];
        }

        return $Evolution;
        return $PokeEvolution->toArray();
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