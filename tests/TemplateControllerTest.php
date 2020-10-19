<?php

   namespace Grayl\Test\Display\Template;

   use Grayl\Display\Template\Controller\TemplateController;
   use Grayl\Display\Template\TemplatePorter;
   use PHPUnit\Framework\TestCase;

   /**
    * Test class for the Template package
    *
    * @package Grayl\Display\Template
    */
   class TemplateControllerTest extends TestCase
   {

      /**
       * Tests the creation of a TemplateController object from a render
       *
       * @return TemplateController
       */
      public function testCreateTemplateControllerFromRender (): TemplateController
      {

         // Request a new TemplateController object
         $template = TemplatePorter::getInstance()
                                   ->newTemplateControllerFromFile( 'test/render.php' );

         // Check the type of object returned
         $this->assertInstanceOf( TemplateController::class,
                                  $template );

         // Set template variables
         $template->setVariables( [ 'string' => 'testing',
                                    'bool'   => true,
                                    'int'    => 123, ] );

         // Return the object
         return $template;
      }


      /**
       * Tests the data of a TemplateController from a render
       *
       * @param TemplateController $template A TemplateController entity to test
       *
       * @throws \Exception
       * @depends testCreateTemplateControllerFromRender
       */
      public function testTemplateControllerDataFromRender ( TemplateController $template ): void
      {

         // Get the rendered template
         $output = $template->getRenderedTemplate();

         // Test the rendered template
         $this->assertNotEmpty( $output );
         $this->assertIsString( $output );
         $this->assertEquals( 'testing ' . $template->getVariable( 'int' ),
                              $output );
      }


      /**
       * Tests the creation of a TemplateController object from raw source
       *
       * @return TemplateController
       */
      public function testCreateTemplateControllerFromRaw (): TemplateController
      {

         // Request a new TemplateController object
         $template = TemplatePorter::getInstance()
                                   ->newTemplateControllerFromFile( 'test/raw.php' );

         // Check the type of object returned
         $this->assertInstanceOf( TemplateController::class,
                                  $template );

         // Return the object
         return $template;
      }


      /**
       * Tests the data of a TemplateController from raw source
       *
       * @param TemplateController $template A TemplateController entity to test
       *
       * @throws \Exception
       * @depends testCreateTemplateControllerFromRaw
       */
      public function testTemplateControllerDataFromRaw ( TemplateController $template ): void
      {

         // Get the rendered template
         $output = $template->getRawTemplate();

         // Test the rendered template
         $this->assertNotEmpty( $output );
         $this->assertIsString( $output );
         $this->assertEquals( '<?php #test',
                              $output );
      }


      /**
       * Tests the creation of a saved TemplateController object
       *
       * @return TemplateController
       */
      public function testCreateSavedTemplateController (): TemplateController
      {

         // Request a saved TemplateController object
         $template = TemplatePorter::getInstance()
                                   ->getSavedTemplateController( 'test/saved.php' );

         // Check the type of object returned
         $this->assertInstanceOf( TemplateController::class,
                                  $template );

         // Set template variables
         $template->setVariables( [ 'string' => 'testing saved',
                                    'bool'   => true,
                                    'int'    => 55, ] );

         // Return the object
         return $template;
      }


      /**
       * Tests the data of a saved TemplateController
       *
       * @param TemplateController $template A TemplateController entity to test
       *
       * @throws \Exception
       * @depends testCreateSavedTemplateController
       */
      public function testSavedTemplateControllerData ( TemplateController $template ): void
      {

         // Get the saved template
         $saved_template = TemplatePorter::getInstance()
                                         ->getSavedTemplateController( 'test/saved.php' );

         // Make sure the objects are the same
         $this->assertSame( $saved_template,
                            $template );

         // Test the variables of the passed template
         $this->assertNotEmpty( $template->getVariable( 'string' ) );
         $this->assertIsString( $template->getVariable( 'string' ) );
         $this->assertEquals( 'testing saved',
                              $template->getVariable( 'string' ) );

         // Make sure the saved template matches the passed template value
         $this->assertEquals( $template->getVariable( 'string' ),
                              $saved_template->getVariable( 'string' ) );
      }


      /**
       * Tests the data of a TemplateController from a render
       *
       * @param TemplateController $template A TemplateController entity to test
       *
       * @throws \Exception
       * @depends testCreateSavedTemplateController
       */
      public function testSavedTemplateControllerDataFromRender ( TemplateController $template ): void
      {

         // Get the saved template
         $saved_template = TemplatePorter::getInstance()
                                         ->getSavedTemplateController( 'test/saved.php' );

         // Get the output of the passed template via render
         $output = $template->getRenderedTemplate();

         // Test the raw output of both
         $this->assertNotEmpty( $output );
         $this->assertIsString( $output );
         $this->assertEquals( 'saved template',
                              $output );

         // Make sure the saved template output matches the passed template
         $this->assertEquals( $output,
                              $saved_template->getRenderedTemplate() );
      }

   }
