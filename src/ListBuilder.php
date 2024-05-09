<?php


namespace Seydu\DataGrid;


use Seydu\DataProvider\ListDataProviderInterface;

class ListBuilder implements ListBuilderInterface
{
    /**
     * @var ListGridBuilderInterface
     */
    private $gridBuilder;

    public function __construct(
        ListGridBuilderInterface $gridBuilder
    )
    {
        $this->gridBuilder = $gridBuilder;
    }

    public function build(ListDefinitionInterface $definition,  ListDataProviderInterface $dataProvider, ListRendererInterface $renderer)
    {
        $metadata = [
            'total_size' => $dataProvider->getTotalSize(),
            'result_set_size' => $dataProvider->getDataSize(),
        ];

        $grid = $this->gridBuilder->build($definition, $renderer->getOptions());
        return $renderer->render($grid, $dataProvider->getData(), $metadata);
    }
}
