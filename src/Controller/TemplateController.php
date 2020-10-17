<?php

namespace Grayl\Display\Template\Controller;

use Grayl\Display\Template\Entity\TemplateData;
use Grayl\Display\Template\Service\TemplateService;
use Grayl\File\Controller\FileController;

/**
 * Class TemplateController
 * The controller for working with Template objects
 *
 * @package Grayl\Display\Template
 */
class TemplateController
{

    /**
     * The TemplateData instance to interact with
     *
     * @var TemplateData
     */
    private TemplateData $template_data;

    /**
     * The FileController entity of the template file
     *
     * @var FileController
     */
    private FileController $template_file;

    /**
     * The TemplateService instance to interact with
     *
     * @var TemplateService
     */
    private TemplateService $template_service;


    /**
     * The class constructor
     *
     * @param TemplateData    $template_data    The TemplateData instance to interact with
     * @param FileController  $template_file    A FileController entity for the template file
     * @param TemplateService $template_service The TemplateService instance to use
     */
    public function __construct(
        TemplateData $template_data,
        FileController $template_file,
        TemplateService $template_service
    ) {

        // Setup the class
        $this->template_data = $template_data;
        $this->template_file = $template_file;

        // Set the template service
        $this->template_service = $template_service;
    }


    /**
     * Renders a template with variables from a TemplateData object
     *
     * @return string
     * @throws \Exception
     */
    public function getRenderedTemplate(): string
    {

        // Render the template
        return $this->template_service->getRenderedTemplate(
            $this->template_data,
            $this->template_file
        );
    }


    /**
     * Gets the raw source of a template without parsing it
     *
     * @return string
     * @throws \Exception
     */
    public function getRawTemplate(): string
    {

        // Get the raw template source
        return $this->template_service->getRawTemplate($this->template_file);
    }


    /**
     * Retrieves the value of a stored template variable
     *
     * @param string $key The key name for the variable
     *
     * @return mixed
     */
    public function getVariable(string $key)
    {

        // Return the value
        return $this->template_data->getVariable($key);
    }


    /**
     * Retrieves the entire array of template variables
     *
     * @return array
     */
    public function getVariables(): array
    {

        // Return all variables
        return $this->template_data->getVariables();
    }


    /**
     * Sets a single template variable
     *
     * @param string $key   The key name for the variable
     * @param mixed  $value The value of the variable
     */
    public function setVariable(
        string $key,
        $value
    ): void {

        // Set the variable
        $this->template_data->setVariable(
            $key,
            $value
        );
    }


    /**
     * Sets multiple template variables using a passed array
     *
     * @param array $variables The associative array of variables to set ( key => value )
     */
    public function setVariables(array $variables): void
    {

        // Set the variables
        $this->template_data->setVariables($variables);
    }

}