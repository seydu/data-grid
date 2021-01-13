<?php


namespace Seydu\DataGrid;


interface GridDefinitionProviderInterface
{
    /**
     * @param $name
     * @return DefinitionInterface
     */
    public function load($name);
}
