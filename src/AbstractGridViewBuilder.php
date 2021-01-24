<?php


namespace Seydu\DataGrid;


abstract class AbstractGridViewBuilder implements GridViewBuilderInterface
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

    public function build($object)
    {
        return new View($object, $this->buildData($object));
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
