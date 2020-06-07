<?php


namespace Seydu\DataGrid;


interface PaginatableListDataProviderInterface extends ListDataProviderInterface
{
    /**
     * @param int $currentPage
     * @param int $itemsPerPage
     * @return iterable
     */
    public function getPageData(int $currentPage, int $itemsPerPage) ;

}
