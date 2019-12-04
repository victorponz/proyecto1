<?php
namespace ProyectoWeb\app\controllers;

use Psr\Container\ContainerInterface;
use ProyectoWeb\repository\AsociadoRepository;
use ProyectoWeb\repository\CategoriaRepository;
use ProyectoWeb\repository\ImagenGaleriaRepository;


class PageController
{
    protected $container;

    // constructor receives container instance
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }
    public function home($request, $response, $args) {
         $title = "Home";
         $repositorioCategorias = new CategoriaRepository();
         $repositorioImagenes = new ImagenGaleriaRepository();
         $repositorioAsociados = new AsociadoRepository();
     
         $categorias = $repositorioCategorias->findAll();
         $imagenes = [];
         foreach ($categorias as $categoria) {
             $imagenes[] = ['categoria' => $categoria, 'imagenes' => $repositorioImagenes->findByCategoria($categoria->getId())];
         }
         $asociados = $repositorioAsociados->getAsociados();

         return $this->container->renderer->render($response, "index.view.php", compact('title', 'imagenes', 'asociados'));
         
    }
 
    public function about($request, $response, $args) {
        $title = "About";
    
        return $this->container->renderer->render($response, "about.view.php", compact('title'));
      
    }

    public function blog($request, $response, $args) {
        $title = "Blog";

        return $this->container->renderer->render($response, "blog.view.php", compact('title'));   
    }

    public function singlePost($request, $response, $args) {
        $title = "Single post";

        return $this->container->renderer->render($response, "single_post.view.php", compact('title'));   
    }

}