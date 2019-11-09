<?php


namespace Seydu\DataGrid;


class Action
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var array
     */
    private $data;

    public function __construct(string $name, array $data)
    {
        $this->name = $name;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

}