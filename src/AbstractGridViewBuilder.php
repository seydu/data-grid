<?php


namespace Seydu\DataGrid;


abstract class AbstractGridViewBuilder implements GridViewBuilderInterface
{
    /**
     * @var ViewDataBuilderInterface|null
     */
    private $viewDataBuilder;

    public function __construct(?ViewDataBuilderInterface $viewDataBuilder = null)
    {
        $this->viewDataBuilder = $viewDataBuilder;
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
