<?php


namespace Seydu\DataGrid;


class GridDefinitionProvider implements GridDefinitionProviderInterface
{
    private function findByClass($class)
    {
        if(!class_exists($class)) {
            return null;
        }
        $gridDefinition = new $class();
        if(!$gridDefinition instanceof DefinitionInterface) {
            throw new \LogicException("No grid definition found because class '$class' is not allowed");
        }
        return $gridDefinition;
    }

    public function load($class)
    {
        $gridDefinition = $this->findByClass($class);
        if($gridDefinition !== null) {
            return $gridDefinition;
        }
        throw new \LogicException("No grid definition found for '$class'");
    }
}
