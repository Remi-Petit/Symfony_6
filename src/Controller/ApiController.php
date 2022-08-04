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
        // Ici, URLs stock toute les URL donnée par l'URL suivante :
        // 'https://pokeapi.co/api/v2/pokemon/?limit=$var  ($var étant ici 10)
        // Chacune de ces URLs contiennent les infos d'un Pokémon spécifique
        $URLs = array();
        for ($i = 0; $i < $var; $i++) {
            $URL = $this->getAPI('pokemon/?limit=' . $var);
            $URL = $URL["results"][$i]["url"];
            $URLs[] = $URL;
        }
        // Ici, InfoPokes contient toute les infos relative aux URL qui correspondaient
        $InfoPokes = array();
        for ($i = 0; $i < $var-1; $i++) {
            $Poke = $this->client->request(
                'GET',
                $URLs[$i]
            );
            $Poke = $Poke->toArray();
            $InfoPokes[] = $Poke;
        }
        return $InfoPokes;
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