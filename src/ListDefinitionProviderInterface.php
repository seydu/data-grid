<?php


namespace Seydu\DataGrid;


use Seydu\Security\ActionAuthorizationCheckerInterface;

interface ListDefinitionProviderInterface
{
    /**
     * @param ActionAuthorizationCheckerInterface $actionAuthorizationChecker
     * @return self
     */
    public function withActionAuthorizationChecker(ActionAuthorizationCheckerInterface $actionAuthorizationChecker);

    /**
     * @param $class
     * @return ListDefinitionInterface
     */
    public function load($class);
}
