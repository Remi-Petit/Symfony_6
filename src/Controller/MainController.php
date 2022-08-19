<?php
// src/Controller/MainController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController {

    /** * @Route("/") */
    public function home(ApiController $ApiController): Response {
        return $this->render('pages/home.html.twig');
    }

    /** * @Route("/pokemon") */
    public function pokemons(ApiController $ApiController): Response {

        $limite = 898; //898 le max

        //dd($ApiController->getPokemons($limite));
        return $this->render('pages/pokemons.html.twig', [
            'pokemons' => $ApiController->getPokemons($limite),
        ]);
    }

    /** * @Route("/pokemon/{id}") */
    public function pokemon(ApiController $ApiController, string $id): Response {

        $evolution_family = $ApiController->getPokemonPlus($id)["evolution_chain"]["url"];

        //dd($ApiController->getPokemonEvolutions($evolution_family));
        return $this->render('pages/pokemon.html.twig', [
            'pokemon' => $ApiController->getPokemon($id),
            'info' => $ApiController->getPokemonPlus($id),
            'evolutions' => $ApiController->getPokemonEvolutions($evolution_family),
        ]);
    }

    /** * @Route("*") */
    public function all(ApiController $ApiController): Response {
        return $this->render('pages/home.html.twig');
    }

}