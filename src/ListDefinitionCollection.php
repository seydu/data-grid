<?php


namespace Seydu\DataGrid;


class ListDefinitionCollection
{
    private $definitions;

    public function __construct()
    {
        $this->definitions = [];
    }

    public function add(ListDefinitionInterface $definition)
    {
        $this->definitions[\get_class($definition)] = $definition;
    }

    public function get($name): ?ListDefinitionInterface
    {
        return $this->definitions[$name] ?? null;
    }
}
