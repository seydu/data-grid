<?php


namespace Seydu\DataGrid;


use Seydu\DataQueryFilter\SortDefinitionInterface;

interface ListDataProviderInterface
{
    /**
     * @return array|iterable
     */
    public function getData();

    /**
     * @return int
     */
    public function getCurrentPage();

    /**
     * @return boolean
     */
    public function haveToPaginate();

    /**
     * @return int
     */
    public function count();

    /**
     * @return array
     */
    public function getNormalizedFilterData();

    /**
     * @return boolean
     */
    public function isMaxPerPageSet();

    /**
     * @param int $maxPerPage
     * @return $this
     */
    public function setMaxPerPage($maxPerPage);

    /**
     * @param array $definitions
     * @return $this
     */
    public function setFilterDefinitions(array $definitions);

    /**
     * @param array $data
     * @return $this
     */
    public function setFilterData(array $data);

    /**
     * @return SortDefinitionInterface
     */
    public function getSortDefinition();

}