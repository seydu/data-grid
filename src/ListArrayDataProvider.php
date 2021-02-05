<?php


namespace Seydu\DataGrid;


class ListArrayDataProvider implements ListDataProviderInterface
{
    private $data;
    private $totalSize;
    private $dataSize;

    public function __construct(array $data = [], $totalSize = null, $dataSize = null)
    {
        $this->processData($data, $totalSize, $dataSize);
    }

    private function processData(array $data, $totalSize, $dataSize)
    {
        $this->data = $data;
        $this->totalSize = $totalSize ?: count($data);
        $this->dataSize = $dataSize ?? count($data);
    }

    public function setData(array $data, $totalSize = null, $dataSize = null): self
    {
        $this->processData($data, $totalSize, $dataSize);
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getTotalSize(): int
    {
        return $this->totalSize;
    }

    public function getDataSize(): int
    {
        return $this->dataSize;
    }
}
