<?php

declare(strict_types=1);

namespace App\Command;

use Psr\Container\ContainerInterface;
use Symfony\Bundle\MakerBundle\Generator;

class MakeCrudCommandFactory
{
    public function __invoke(ContainerInterface $container): MakeCrudCommand
    {
        return new MakeCrudCommand(
            $container->get(Generator::class)
        );
    }
}