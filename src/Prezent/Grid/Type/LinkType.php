<?php
/**
 * Created by PhpStorm.
 * User: saidou
 * Date: 11/6/18
 * Time: 2:34 PM
 */

namespace Seydu\DataGrid\Prezent\Grid\Type;

use Prezent\Grid\BaseElementType;
use Prezent\Grid\ElementView;
use Symfony\Component\OptionsResolver\OptionsResolver;


class LinkType extends BaseElementType
{
    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver
            ->setDefined(['link_generator'])
            ->setAllowedTypes('link_generator', 'callable')
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function buildView(ElementView $view, array $options)
    {
        parent::buildView($view, $options);
        $view->vars['link_generator'] = $options['link_generator'];
    }

    /**
     * {@inheritDoc}
     */
    public function bindView(ElementView $view, $item)
    {
        $callable = $view->vars['link_generator'];
        $view->vars['value'] = $callable($item);
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'link';
    }
}