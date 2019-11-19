<?php
    $title = "Asociados";
    require_once "./utils/utils.php";
    require_once "./Forms/InputElement.php";
    require_once "./Forms/TextareaElement.php";
    require_once "./Forms/ButtonElement.php";
    require_once "./Forms/FileElement.php";
    require_once "./Forms/FormElement.php";
    require_once "./Forms/custom/MyFormGroup.php";
    require_once "./Forms/custom/MyFormControl.php";
    require_once "./Forms/Validator/NotEmptyValidator.php";
    require_once "./Forms/Validator/MimetypeValidator.php";
    require_once "./Forms/Validator/MaxSizeValidator.php";    
    require_once "./exceptions/FileException.php";
    require_once "./utils/SimpleImage.php";
    require_once "./entity/Asociado.php";
    
    $info = $urlImagen = "";

    $nombre = new InputElement('nombre', 'text', 'nombre');
    $nombre
     ->setValidator(new NotEmptyValidator('El nombre es obligatorio', true));
    $nombreWrapper = new MyFormControl($nombre, 'Nombre', 'col-xs-12');

    $description = new TextareaElement('descripcion', 'descripcion');

    $descriptionWrapper = new MyFormControl($description, 'Descripción', 'col-xs-12');

    $fv = new MimetypeValidator(['image/jpeg', 'image/jpg', 'image/png'], 'Formato no soportado', true);
    $fv->setNextValidator(new MaxSizeValidator(2 * 1024 * 1024, 'El archivo no debe exceder 2M', true));

    $file = new FileElement('imagen', 'imagen');
    $file
      ->setValidator($fv);

    $labelFile = new LabelElement('Imagen', $file);

    $b = new ButtonElement('Send', '', '', '', 'pull-right btn btn-lg sr-button');

    $form = new FormElement('', 'multipart/form-data');
    $form
    ->setCssClass('form-horizontal')
    ->appendChild($labelFile)
    ->appendChild($file)
    ->appendChild($nombreWrapper)
    ->appendChild($descriptionWrapper)
    ->appendChild($b);

    if ("POST" === $_SERVER["REQUEST_METHOD"]) {
        $form->validate();
        if (!$form->hasError()) {
          try {
            $file->saveUploadedFile(Asociado::RUTA_IMAGENES_ASOCIADO);  
              // Create a new SimpleImage object
              $simpleImage = new \claviska\SimpleImage();
              $simpleImage
              ->fromFile(Asociado::RUTA_IMAGENES_ASOCIADO . $file->getFileName())  
              ->resize(50, 50)
              ->toFile(Asociado::RUTA_IMAGENES_ASOCIADO . $file->getFileName());
              $info = 'Imagen enviada correctamente'; 
              $urlImagen = Asociado::RUTA_IMAGENES_ASOCIADO . $file->getFileName();
              $form->reset();
            
          }catch(Exception $err) {
              $form->addError($err->getMessage());
              $imagenErr = true;
          }
        }else{
          
        }
    }    
    include("./views/asociados.view.php");