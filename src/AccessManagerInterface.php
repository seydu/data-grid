<?php


namespace Seydu\DataGrid;


interface AccessManagerInterface
{
    /**
     * @param ActionList $actions
     * @return ActionList
     */
    public function filterActions(ActionList $actions): ActionList;

}