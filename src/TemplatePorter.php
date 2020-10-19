<?php

   namespace Grayl\Display\Template;

   use Grayl\Display\Template\Controller\TemplateController;
   use Grayl\Display\Template\Entity\TemplateData;
   use Grayl\Display\Template\Service\TemplateService;
   use Grayl\File\FilePorter;
   use Grayl\Mixin\Common\Entity\KeyedDataBag;
   use Grayl\Mixin\Common\Traits\StaticTrait;

   /**
    * Front-end for the Template package
    *
    * @package Grayl\Display\Template
    */
   class TemplatePorter
   {

      // Use the static instance trait
      use StaticTrait;

      /**
       * The directory path where template files are stored
       *
       * @var string
       */
      private string $template_dir;

      /**
       * A KeyedDataBag entity for storing saved templates
       *
       * @var KeyedDataBag
       */
      private KeyedDataBag $saved_templates;


      /**
       * The class constructor
       */
      public function __construct ()
      {

         // Set the config directory path
         $this->template_dir = dirname( $_SERVER[ 'DOCUMENT_ROOT' ] ) . '/resource/template/';

         // Create a KeyedDataBag for storing templates
         $this->saved_templates = new KeyedDataBag();
      }


      /**
       * Creates a TemplateController
       *
       * @param string string $filename The filename of the template file
       *
       * @return TemplateController
       */
      public function newTemplateControllerFromFile ( string $filename ): TemplateController
      {

         // Get a new FileController for this template file
         $template_file = FilePorter::getInstance()
                                    ->newFileController( $this->template_dir . $filename );

         // Get a safe template ID from the filename
         $template_id = $this->getTemplateIDFromFilename( $filename );

         // Return the controller
         return new TemplateController( new TemplateData( $template_id ),
                                        $template_file,
                                        new TemplateService() );
      }


      /**
       * Retrieves a previously created TemplateController entity if it exists, otherwise a new one is created
       *
       * @param string $filename The filename of the template file
       *
       * @return TemplateController
       */
      public function getSavedTemplateController ( string $filename ): TemplateController
      {

         // Get a safe template ID from the filename
         $template_id = $this->getTemplateIDFromFilename( $filename );

         // Grab the saved copy of this specific TemplateController
         $controller = $this->saved_templates->getVariable( $template_id );

         // If we don't have an entity for this controller yet, create one
         if ( empty ( $controller ) ) {
            // Request the entity
            $controller = $this->newTemplateControllerFromFile( $filename );

            // Save it for re-use
            $this->saved_templates->setVariable( $template_id,
                                                 $controller );
         }

         // Return the controller
         return $controller;
      }


      /**
       * Makes a safe ID based on the name of a template file
       *
       * @param string $filename The filename of the template
       *
       * @return string
       */
      public function getTemplateIDFromFilename ( string $filename ): string
      {

         // Characters to replace with underscores in a filename
         $characters = [ "/",
                         "\\",
                         ".", ];

         // Sanitize the filename to create an ID
         return str_replace( $characters,
                             "_",
                             strtolower( $filename ) );
      }

   }