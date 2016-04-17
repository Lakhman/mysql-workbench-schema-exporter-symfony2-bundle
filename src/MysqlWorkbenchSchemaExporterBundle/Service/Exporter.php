<?php

namespace MysqlWorkbenchSchemaExporterBundle\Service;

use MysqlWorkbenchSchemaExporterBundle\Core\Schema;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Description of Exporter.
 *
 * @author marc
 */
class Exporter
{
    use ContainerAwareTrait;

    /**
     * Schemas.
     *
     * @var \MysqlWorkbenchSchemaExporterBundle\Core\Schema[]
     */
    protected $schemas = array();

    /**
     * Constructure.
     *
     * @param type $schemas
     */
    public function __construct($schemas = array())
    {
        $this->setSchemas($schemas);
    }

    /**
     * Set the schema.
     *
     * @param array $schemas
     *
     * @return \MysqlWorkbenchSchemaExporterBundle\Service\Exporter
     */
    public function setSchemas(array $schemas)
    {
        $this->schemas = $schemas;

        return $this;
    }

    /**
     * Get the current schemas.
     *
     * @return \MysqlWorkbenchSchemaExporterBundle\Core\Schema[]
     */
    public function getSchemas()
    {
        foreach ($this->schemas as $name => &$value) {
            if ($value instanceof Schema) {
                continue;
            }

            if (is_array($value)) {
                $value = new Schema($name, $value);
                $value->setContainer($this->container);
                $value->initTool();
            }
        }

        return $this->schemas;
    }

    /**
     * Export.
     *
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    public function export(OutputInterface $output)
    {
        foreach ($this->getSchemas() as $schema) {
            $schema->export($output);
        }
    }
    /**
     * Export.
     *
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    public function exportWithRepository(OutputInterface $output)
    {
        foreach ($this->getSchemas() as $schema) {
            $schema->exportWithRepository($output);
        }
    }
}
