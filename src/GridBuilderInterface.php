<?php


namespace Seydu\DataGrid;


interface GridBuilderInterface
{
    public function build(ListDefinitionInterface $definition, array $options);
}
