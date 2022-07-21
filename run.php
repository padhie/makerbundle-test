<?php

require_once __DIR__ . '/vendor/autoload.php';


$rootDirectory = __DIR__ . '/src';
$templateDirectory = __DIR__ . '/resource';

$targetDirectory = $rootDirectory . '/Command';
$targetName = 'TestCommand';
$targetFilename = $targetName . '.php';

if (file_exists($targetDirectory . '/' . $targetFilename)) {
    unlink($targetDirectory . '/' . $targetFilename);
}

$generator = new \Symfony\Bundle\MakerBundle\Generator(
    new \Symfony\Bundle\MakerBundle\FileManager(
        new \Symfony\Component\Filesystem\Filesystem(),
        new \Symfony\Bundle\MakerBundle\Util\AutoloaderUtil(
            new \Symfony\Bundle\MakerBundle\Util\ComposerAutoloaderFinder(__DIR__)
        ),
        new \Symfony\Bundle\MakerBundle\Util\MakerFileLinkFormatter,
        $rootDirectory
    ),
    'App'
);


$commandClassNameDetails = $generator->createClassNameDetails(
    $targetName,
    'Command\\'
);

$useStatements = new \Symfony\Bundle\MakerBundle\Util\UseStatementGenerator([
    \Symfony\Component\Console\Command\Command::class,
    \Symfony\Component\Console\Input\InputArgument::class,
    \Symfony\Component\Console\Input\InputInterface::class,
    \Symfony\Component\Console\Input\InputOption::class,
    \Symfony\Component\Console\Output\OutputInterface::class,
    \Symfony\Component\Console\Style\SymfonyStyle::class,
    \Symfony\Component\Console\Attribute\AsCommand::class,
]);

$generator->generateClass(
    $commandClassNameDetails->getFullName(),
    $templateDirectory . '/Command.tpl.php',
    [
        'use_statements' => $useStatements,
        'command_name' => 'AnyName',
        'set_description' => !class_exists(\Symfony\Component\Console\Command\LazyCommand::class),
    ]
);

$generator->writeChanges();
