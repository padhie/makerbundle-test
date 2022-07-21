<?php

declare(strict_types=1);

namespace App;

use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\DependencyBuilder;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Bundle\MakerBundle\MakerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;

final class MakeTesting implements MakerInterface
{
    public static function getCommandName(): string
    {
        return 'testing';
    }

    public function configureCommand(Command $command, InputConfiguration $inputConfig): void
    {
    }

    public function configureDependencies(DependencyBuilder $dependencies): void
    {
    }

    public function interact(InputInterface $input, ConsoleStyle $io, Command $command): void
    {
    }

    public function generate(InputInterface $input, ConsoleStyle $io, Generator $generator): void
    {
    }

    public function __call(string $name, array $arguments): void
    {
    }
}