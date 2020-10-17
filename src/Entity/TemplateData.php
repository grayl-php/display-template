<?php

namespace Grayl\Display\Template\Entity;

use Grayl\Mixin\Common\Entity\KeyedDataBag;

/**
 * Class TemplateData
 * The entity for template data
 *
 * @package Grayl\Display\Template
 */
class TemplateData
{

    /**
     * The unique ID of the template
     *
     * @var string
     */
    private string $id;

    /**
     * A KeyedDataBag that holds the template variables
     *
     * @var KeyedDataBag
     */
    private KeyedDataBag $variables;


    /**
     * The class constructor
     *
     * @param string $id The unique ID of the template
     */
    public function __construct(string $id)
    {

        // Set the class data
        $this->setID($id);

        // Create the KeyedDataBag
        $this->variables = new KeyedDataBag();
    }


    /**
     * Gets the ID
     *
     * @return string
     */
    public function getID(): string
    {

        // Return the ID
        return $this->id;
    }


    /**
     * Sets the ID
     *
     * @param string $id The unique ID of the template
     */
    public function setID(string $id): void
    {

        // Set the ID
        $this->id = $id;
    }


    /**
     * Retrieves the value of a stored variable
     *
     * @param string $key The key name for the variable
     *
     * @return mixed
     */
    public function getVariable(string $key)
    {

        // Return the value
        return $this->variables->getVariable($key);
    }


    /**
     * Retrieves the entire array of variables
     *
     * @return array
     */
    public function getVariables(): array
    {

        // Return all variables
        return $this->variables->getVariables();
    }


    /**
     * Sets a single variable
     *
     * @param string $key   The key name for the variable
     * @param mixed  $value The value of the variable
     */
    public function setVariable(
        string $key,
        $value
    ): void {

        // Set the variable
        $this->variables->setVariable(
            $key,
            $value
        );
    }


    /**
     * Sets multiple variables using a passed array
     *
     * @param array $variables The associative array of variables to set ( key => value )
     */
    public function setVariables(array $variables): void
    {

        // Set the variables
        $this->variables->setVariables($variables);
    }

}