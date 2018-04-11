<?php

namespace Cydrickn\AtlasBundle\Services;

use Atlas\Orm\Atlas;
use Atlas\Orm\AtlasContainer;
use Aura\Sql\ExtendedPdo;

/**
 * Description of AtlasService
 *
 * @author Cydrick Nonog <cydrick.dev@gmail.com>
 */
class AtlasService
{
    private $config;
    private $atlasContainer;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->init();
    }

    public function getAtlasContainer(): AtlasContainer
    {
        return $this->atlasContainer;
    }

    public function getAtlas(): Atlas
    {
        return $this->getAtlasContainer()->getAtlas();
    }

    private function init(): void
    {
        $this->initContainer();
        $this->initMapper();
    }

    private function initContainer(): void
    {
        $driver = $this->config['connection']['driver'];
        $host = $this->config['connection']['host'];
        $database = $this->config['connection']['database'];
        $username = $this->config['connection']['username'];
        $password = $this->config['connection']['password'];

        $dsn = null;
        if ($driver === 'extendedpdo_mysql') {
            $dsn = new ExtendedPdo(sprintf('mysql:host=%s;dbname=%s', $host, $database), $username, $password);
        } elseif ($driver === 'pdo_mysql') {
            $dsn = new PDO(sprintf('mysql:host=%s;dbname=%s', $host, $database), $username, $password);
        }

        $this->atlasContainer = new AtlasContainer($dsn);
    }

    private function initMapper(): void
    {
        $this->getAtlasContainer()->setMappers($this->config['mapper']);
    }
}
