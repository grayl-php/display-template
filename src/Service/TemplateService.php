<?php

namespace Grayl\Display\Template\Service;

use Grayl\Display\Template\Entity\TemplateData;
use Grayl\File\Controller\FileController;

/**
 * Class TemplateService
 * The service for working with template files
 *
 * @package Grayl\Display\Template
 */
class TemplateService
{

    /**
     * Renders a FileController with variables from a TemplateData object
     *
     * @param TemplateData   $template_data The TemplateData instance to work with
     * @param FileController $template_file A FileController entity for the template file to render
     *
     * @return string
     * @throws \Exception
     */
    public function getRenderedTemplate(
        TemplateData $template_data,
        FileController $template_file
    ): string {

        // Use the FileController to render the template
        return $template_file->getRenderedFile($template_data->getVariables());
    }


    /**
     * Gets the raw source of a FileController without parsing it
     *
     * @param FileController $template_file A FileController entity for the template file to retrieve
     *
     * @return string
     * @throws \Exception
     */
    public function getRawTemplate(FileController $template_file): string
    {

        // Return the FileController's source
        return $template_file->getRawFile();
    }

}