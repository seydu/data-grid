<?php


namespace Seydu\DataGrid;


class ListArrayDataProvider implements ListDataProviderInterface
{
    private $data;
    private $totalSize;
    private $dataSize;

    public function __construct(array $data = [], $totalSize = null, $dataSize = null)
    {
        $this->data = $data;
        $this->totalSize = $totalSize ?: count($data);
        $this->dataSize = $dataSize ?? count($data);
    }

    public function getData()
    {
        return $this->data;
    }

    public function getTotalSize()
    {
        return $this->totalSize;
    }

    public function getDataSize()
    {
        return $this->dataSize;
    }
}
