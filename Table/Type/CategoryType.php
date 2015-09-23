<?php

namespace Ekyna\Bundle\BlogBundle\Table\Type;

use Ekyna\Bundle\AdminBundle\Table\Type\ResourceTableType;
use Ekyna\Component\Table\TableBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CategoryType
 * @package Ekyna\Bundle\BlogBundle\Table\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class CategoryType extends ResourceTableType
{
    /**
     * {@inheritdoc}
     */
    public function buildTable(TableBuilderInterface $builder, array $options)
    {
        $builder
            ->addColumn('name', 'anchor', [
                'label' => 'ekyna_core.field.name',
                'sortable' => false,
                'route_name' => 'ekyna_blog_category_admin_show',
                'route_parameters_map' => [
                    'categoryId' => 'id',
                ],
            ])
            ->addColumn('enabled', 'boolean', [
                'label' => 'ekyna_core.field.enabled',
                'sortable' => true,
                'route_name' => 'ekyna_blog_category_admin_toggle',
                'route_parameters_map' => [
                    'categoryId' => 'id',
                ],
            ])
            ->addColumn('createdAt', 'datetime', [
                'label' => 'ekyna_core.field.created_at',
                'sortable' => false,
            ])
            ->addColumn('actions', 'admin_actions', [
                'buttons' => [
                    [
                        'label' => 'ekyna_core.button.move_up',
                        'icon' => 'arrow-up',
                        'class' => 'primary',
                        'route_name' => 'ekyna_blog_category_admin_move_up',
                        'route_parameters_map' => [
                            'categoryId' => 'id'
                        ],
                        'permission' => 'edit',
                    ],
                    [
                        'label' => 'ekyna_core.button.move_down',
                        'icon' => 'arrow-down',
                        'class' => 'primary',
                        'route_name' => 'ekyna_blog_category_admin_move_down',
                        'route_parameters_map' => [
                            'categoryId' => 'id'
                        ],
                        'permission' => 'edit',
                    ],
                    [
                        'label' => 'ekyna_core.button.edit',
                        'icon' => 'pencil',
                        'class' => 'warning',
                        'route_name' => 'ekyna_blog_category_admin_edit',
                        'route_parameters_map' => [
                            'categoryId' => 'id'
                        ],
                        'permission' => 'edit',
                    ],
                    [
                        'label' => 'ekyna_core.button.remove',
                        'icon' => 'trash',
                        'class' => 'danger',
                        'route_name' => 'ekyna_blog_category_admin_remove',
                        'route_parameters_map' => [
                            'categoryId' => 'id'
                        ],
                        'permission' => 'delete',
                    ],
                ],
            ])
            ->addFilter('name', 'text', [
                'label' => 'ekyna_core.field.name',
            ])
            ->addFilter('enabled', 'boolean', [
                'label' => 'ekyna_core.field.enabled',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'default_sorts' => ['position asc'],
            'max_per_page' => 100,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ekyna_blog_category';
    }
}
