<?php


namespace Seydu\DataGrid;


abstract class AbstractListViewBuilder implements ListViewBuilderInterface
{
    /**
     * @var ViewDataBuilderInterface|null
     */
    private $viewDataBuilder;

    public function __construct(?ViewDataBuilderInterface $viewDataBuilder = null)
    {
        $this->viewDataBuilder = $viewDataBuilder;
    }

    /**
     * @param iterable $dataSet
     * @return array|\ArrayAccess
     */
    public function buildViews($dataSet)
    {
        $results = [];
        foreach ($dataSet as $object) {
            $results[] = new View($object, $this->buildData($object));
        }
        return $results;
    }

    /**
     * @param $object
     * @return array
     */
    protected function buildData($object)
    {
        return null === $this->viewDataBuilder ? [] : $this->viewDataBuilder->buildData($object);
    }
}
