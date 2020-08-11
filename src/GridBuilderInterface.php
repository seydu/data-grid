<?php


namespace Seydu\DataGrid;


interface GridBuilderInterface
{
    public function build(DefinitionInterface $definition, array $options);
}
