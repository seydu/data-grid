<?php


namespace Seydu\DataGrid;


interface ListGridBuilderInterface
{
    public function build(ListDefinitionInterface $definition, array $options);
}
