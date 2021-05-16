<?php


namespace Seydu\DataGrid;


use Symfony\Contracts\Translation\TranslatorInterface;

abstract class AbstractShowDefinition implements DefinitionInterface
{
    /**
     * @var TranslatorInterface
     */
    protected $translator;

    public function __construct(
        TranslatorInterface $translator
    )
    {
        $this->translator = $translator;
    }

}
