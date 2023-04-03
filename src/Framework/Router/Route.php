<?php
namespace Framework\Router;

/**
 * Class route
 * Represent a matched route
 */
class Route
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var callable
     */
    private $callback;

    /**
     * @var array
     */
    private $parameters;


    public function __construct(string $name, callable $callable, array $parameters)
    {
        $this->name = $name;
        $this->callback = $callable;
        $this->parameters = $parameters;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return callable
     */
    public function getCallback(): callable
    {
        return $this->callback;
    }

    /**
     * @return string[]
     */
    public function getParams(): array
    {
        return $this->parameters;
    }
}
