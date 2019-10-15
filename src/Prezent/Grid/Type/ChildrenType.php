<?php
/**
 * Created by PhpStorm.
 * User: saidou
 * Date: 9/10/18
 * Time: 3:03 PM
 */

namespace Seydu\DataGrid\Prezent\Grid\Type;

use Prezent\Grid\BaseElementType;
use Prezent\Grid\ElementView;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ChildrenType extends BaseElementType
{
    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'add_child_link' => false,
                'child_url_generator' => null,
                'child_link_options' => [],
                'add_children_link' => false,
                'children_url_generator' => null,
                'children_link_options' => [
                    'label' => 'See more ...'
                ],
            ])
            ->setAllowedTypes('add_child_link', 'bool')
            ->setAllowedTypes('child_url_generator', ['null', 'callable'])
            ->setAllowedTypes('child_link_options', 'array')
            ->setAllowedTypes('add_children_link', 'bool')
            ->setAllowedTypes('children_url_generator', ['null', 'callable'])
            ->setAllowedTypes('children_link_options', 'array')
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function buildView(ElementView $view, array $options)
    {
        $view->vars['add_child_link']           = $options['add_child_link'];
        $view->vars['add_children_link']        = $options['add_children_link'];
        $view->vars['child_url_generator']      = $options['child_url_generator'];
        $view->vars['children_url_generator']   = $options['children_url_generator'];
        $view->vars['child_link_options']       = $options['child_link_options'];
        $view->vars['children_link_options']    = $options['children_link_options'];
    }

    /**
     * {@inheritDoc}
     */
    public function bindView(ElementView $view, $item)
    {

    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'one_to_many';
    }
}
