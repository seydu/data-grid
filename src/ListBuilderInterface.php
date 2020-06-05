<?php


namespace Seydu\DataGrid;


interface ListBuilderInterface
{
    public function build(
        ListDefinitionInterface $definition,
        ListDataProviderInterface $dataProvider,
        ListRendererInterface $renderer
    );
}
