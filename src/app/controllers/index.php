<?php
    $title = "Home";

    use ProyectoWeb\repository\AsociadoRepository;
    use ProyectoWeb\repository\CategoriaRepository;
    use ProyectoWeb\repository\ImagenGaleriaRepository;
    
    $repositorioCategorias = new CategoriaRepository();
    $repositorioImagenes = new ImagenGaleriaRepository();
    $repositorioAsociados = new AsociadoRepository();

    $categorias = $repositorioCategorias->findAll();
    $imagenes = [];
    foreach ($categorias as $categoria) {
        $imagenes[] = ['categoria' => $categoria, 'imagenes' => $repositorioImagenes->findByCategoria($categoria->getId())];
    }
    $asociados = $repositorioAsociados->getAsociados();

    include(__DIR__ . "/../views/index.view.php");