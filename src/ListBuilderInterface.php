<?php


namespace Seydu\DataGrid;

use Seydu\DataProvider\ListDataProviderInterface;

interface ListBuilderInterface
{
    public function build(
        ListDefinitionInterface $definition,
        ListDataProviderInterface $dataProvider,
        ListRendererInterface $renderer
    );
}
