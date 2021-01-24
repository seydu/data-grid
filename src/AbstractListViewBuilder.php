<?php


namespace Seydu\DataGrid;


abstract class AbstractListViewBuilder implements ListViewBuilderInterface
{
    /**
     * @var ViewDataBuilderInterface|null
     */
    private $viewDataBuilder;

    /**
     * @param ViewDataBuilderInterface $viewDataBuilder
     * @return $this
     */
    public function setViewDataBuilder(ViewDataBuilderInterface $viewDataBuilder)
    {
        $this->viewDataBuilder = $viewDataBuilder;
        return $this;
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
