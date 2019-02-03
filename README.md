 # [Deprecated] Atlas ORM Bundle

This bundle is already deprecated as alternative you can use <https://github.com/atlasphp/Atlas.Symfony>

Symfony Bundle for <http://atlasphp.io>

## Installation

Install using composer

```bash
composer require cydrickn/atlas-orm-bundle
```

## Requirements

* PHP >=7.1
* Symfony >=4

## Configuration
```yaml
cydrickn_atlas:
    connection:
        driver: extendedpdo_mysql
        host: 'database host'
        database: 'database name'
        username: 'database username'
        password: 'database user password'
    mapper: []
```

## Service

The bundle only have one service namely **cydrickn_atlas.service**.
The service class is Cydrickn\AtlasBundle\Services\AtlasService.

## Usage

In Controller
```php

<?php

namespace ...;

use Atlas\Orm\Atlas;
use Cydrickn\AtlasBundle\Services\AtlasService;

class ...Controller extends BaseController
{
    ...

    private function getAtlasService(): AtlasService
    {
        return $this->get('cydrickn_atlas.service');
    }

    private function getAtlasOrm(): Atlas
    {
        return $this->getAtlasService()->getAtlas();
    }
}

```

Passing to service

```
services:
    myservice.pass_service:
        class: ...
        arguments:
            - '@cydrickn_atlas.service'
    myservice.pass_atlas_orm:
        class: ...
        arguments:
            - '@=service("cydrickn_atlas.service").getAtlas()'
```

## More

For more information about atlas you can visit this site <http://atlasphp.io>
By the way the the bundle use the atlas orm version 2.
