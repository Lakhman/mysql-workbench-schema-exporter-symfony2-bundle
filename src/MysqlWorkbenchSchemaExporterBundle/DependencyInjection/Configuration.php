<?php

namespace MysqlWorkbenchSchemaExporterBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('mysql_workbench_schema_exporter');
        $rootNode->children()
            ->arrayNode('schema')
                ->requiresAtLeastOneElement()
                ->useAttributeAsKey('name')
                ->prototype('array')
                ->children()
                    ->scalarNode('bundle')
                        ->isRequired()
                    ->end()
                    ->scalarNode('formatter')
                        ->defaultValue('doctrine2-annotation')
                    ->end()
                    ->arrayNode('params')
                        ->children()
                            ->scalarNode('useTabs')->end()
                            ->scalarNode('logToConsole')->end()
                            ->scalarNode('logFile')->end()
                            ->scalarNode('skipGetterAndSetter')->end()
                            ->scalarNode('repositoryNamespace')->end()
                            ->scalarNode('backupExistingFile')->end()
                            ->scalarNode('skipPluralNameChecking')->end()
                            ->scalarNode('skipColumnWithManyRelation')->end()
                            ->scalarNode('relatedVarNameFormat')->end()
                            ->scalarNode('relatedPrefix')->end()
                            ->scalarNode('enhanceManyToManyDetection')->end()
                            ->scalarNode('generateEntitySerialization')->end()
                            ->scalarNode('generateEntityToArray')->end()
                            ->scalarNode('baseNamespace')->end()
                            ->scalarNode('bundleNamespace')->end()
                            ->scalarNode('bundleNamespaceTo')->end()
                            ->scalarNode('entityNamespace')->end()

                            ->scalarNode('useAnnotationPrefix')->end()
                            ->scalarNode('useAutomaticRepository')->end()
                            ->scalarNode('indentation')->end()
                            ->scalarNode('filename')->end()
                            ->scalarNode('quoteIdentifier')->end()
                            ->scalarNode('indentation')->end()
                            ->scalarNode('extendsClass')->end()
                        ->end()
                    ->end()
                    ->scalarNode('output_dir')
                        ->defaultValue('Entity/Model')
                    ->end()
                    ->scalarNode('config_dir')
                        ->defaultValue('Resources/config')
                    ->end()
                    ->scalarNode('file')
                        ->defaultValue('Resources/workbench/%s.mwb')
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
