<?php

namespace Cydrickn\AtlasBundle\DependencyInjection;

use Cydrickn\AtlasBundle\Services\AtlasService;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Description of CydricknAtlasExtension
 *
 * @author Cydrick Nonog <cydrick.dev@gmail.com>
 */
class CydricknAtlasExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        #$loader = new YamlFileLoader($container, new FileLocator([dirname(__DIR__).'/Resources/config']));
        #$loader->load('services.yml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $this->generateAtlasDefinition($config, $container);
    }

    private function generateAtlasDefinition(array $config, ContainerBuilder $container): void
    {
        $definition = $container->register('cydrickn_atlas.service');
        $definition->setClass(AtlasService::class);
        $definition->addArgument($config);
        $definition->setPublic(true);
    }
}
