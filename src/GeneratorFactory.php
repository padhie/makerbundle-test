<?php

declare(strict_types=1);

namespace App;

use Psr\Container\ContainerInterface;
use Symfony\Bundle\MakerBundle\FileManager;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\Util\AutoloaderUtil;
use Symfony\Bundle\MakerBundle\Util\ComposerAutoloaderFinder;
use Symfony\Bundle\MakerBundle\Util\MakerFileLinkFormatter;
use Symfony\Component\Filesystem\Filesystem;

final class GeneratorFactory
{
    public function __invoke(ContainerInterface $container): Generator
    {
        return new Generator(
            new FileManager(
                new Filesystem(),
                new AutoloaderUtil(
                    new ComposerAutoloaderFinder(__DIR__)
                ),
                new MakerFileLinkFormatter,
                dirname(__DIR__) . '/output'
            ),
            'App'
        );
    }
}