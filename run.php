#!/bin/php
<?php

require_once __DIR__ . '/vendor/autoload.php';

(static function () {
    $container = new \Symfony\Component\DependencyInjection\ContainerBuilder();
    $container->set(\Symfony\Bundle\MakerBundle\Generator::class, (new \App\GeneratorFactory())($container));
    $container->set(\App\Command\MakeCrudCommand::class, (new \App\Command\MakeCrudCommandFactory())($container));

    $application = new Symfony\Component\Console\Application();
    $application->add($container->get(\App\Command\MakeCrudCommand::class));
    $result = $application->run();

    exit($result);
})();