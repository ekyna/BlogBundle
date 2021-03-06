<?php

namespace Ekyna\Bundle\BlogBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Class AdminMenuPass
 * @package Ekyna\Bundle\BlogBundle\DependencyInjection\Compiler
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class AdminMenuPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('ekyna_admin.menu.pool')) {
            return;
        }

        $pool = $container->getDefinition('ekyna_admin.menu.pool');

        $pool->addMethodCall('createGroup', [[
            'name'     => 'blog',
            'label'    => 'ekyna_blog.blog',
            'icon'     => 'comment',
            'position' => 40,
        ]]);
        $pool->addMethodCall('createEntry', ['blog', [
            'name'     => 'posts',
            'route'    => 'ekyna_blog_post_admin_home',
            'label'    => 'ekyna_blog.post.label.plural',
            'resource' => 'ekyna_blog_post',
            'position' => 1,
        ]]);
        $pool->addMethodCall('createEntry', ['blog', [
            'name'     => 'categories',
            'route'    => 'ekyna_blog_category_admin_home',
            'label'    => 'ekyna_blog.category.label.plural',
            'resource' => 'ekyna_blog_category',
            'position' => 2,
        ]]);
    }
}
