<?php


namespace Seydu\DataGrid;


class DefaultAccessManager implements AccessManagerInterface
{
    public function filterActions(ActionList $actions): ActionList
    {
        return $actions;
    }
}