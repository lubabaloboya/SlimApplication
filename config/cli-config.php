<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once '/../bootstrap/app.php';

return ConsoleRunner::createHelperSet($app->getContainer()->get('entityManager'));