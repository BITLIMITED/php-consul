## Install PHP-component
```
 $ compoer req bitms/consul
```
> Dependencies require:

|#|package name|version| composer command |
|-----------|-------------|--------------|----------|
| 1 | PHP | ^7.4 | composer req php^7.4 |
| 1 | php-json | ^7.4 | composer req ext-json |
| 1 | php-curl | ^7.4 | composer req ext-curl |
| 1 | guzzlehttp/guzzle | ^7.2 | composer req guzzlehttp/guzzle |
| 1 | psr/log | ^1.1 | composer req psr/log |

## Start 
```php
<?php

namespace App;

use bitms\Consul\Service\{Registry, KeyValue, Discovery, HealthCheck};

class Example 
{
     // TODO customer code
}
```

## Service model
> Example of use
```php
<?php

use bitms\Consul\Model\Service;

$service = new Service();

/**
 * @default 127.0.0.1
 * @type string
 */
$service->getAddress('localhost');

/**
 * @default 80
 * @type integer
 */
$service->getPort(8080);

/**
 * @default null
 * @type string
 */
$service->getName('admin');

/**
 * @default null
 * @type string
 */
$service->getId('admin1');


$tags = ['v1','example'];

/**
 * @default ['v1', 'primary']
 * @type string
 */
$service->getTag($tags);

/** Additional method */

/**
 * @default null
 * @type string
 */
$service->addTag('myCustomerTag');
```

## Registration of an agent in Consul
> Use Service - Agent HTTP API

###Register Service
```php
<?php

namespace App;

use bitms\Consul\Service\Registry;
use bitms\Consul\Model\Service;
class Example
{
    public function __construct() {
        $pattern = new Service;
        $pattern->setId('example1');
        $pattern->setName('example');
        $pattern->setAddress('127.0.0.1');
        $pattern->setPort(1790);
        $pattern->setTag(['v1']);
        $service = new Registry;
        $service->install($pattern);
    }
}
 
```

###Deregister Service
```php
<?php

namespace App;

use bitms\Consul\Service\Registry;

class Example
{
    public function __construct() {        
        $service = new Registry;
        $service->uninstall('myServiceId');
    }
}

```
###Get Service Configuration
