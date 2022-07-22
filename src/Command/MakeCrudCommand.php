<?php

declare(strict_types=1);

namespace App\Command;

use App\Helper\QuestionAskHelper;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class MakeCrudCommand extends Command
{
    public function __construct(private Generator $generator)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('app:make')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $answers = $this->askQuestions($input, $output);

        $targetDirectory = __DIR__ . '/' . $answers->directory;
        $targetName = $answers->name;

        $this->removeFile($targetDirectory . '/' . $targetName . '.php');

        $commandClassNameDetails = $this->generator->createClassNameDetails(
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

        $this->generator->generateClass(
            $commandClassNameDetails->getFullName(),
            dirname(__DIR__, 1) . '/Resource/Command.tpl.php',
            [
                'use_statements' => $useStatements,
                'command_name' => 'AnyName',
                'set_description' => !class_exists(\Symfony\Component\Console\Command\LazyCommand::class),
            ]
        );

        $this->generator->writeChanges();

        return Command::SUCCESS;
    }

    private function askQuestions(InputInterface $input, OutputInterface $output): MakeCrudAnswers
    {
        $questionHelper = new QuestionAskHelper($input, $output, $this->getHelper('question'));
        $answers = new MakeCrudAnswers();

        $answers->directory = $questionHelper->infinityQuestion('What is the directory?');
        $answers->name = $questionHelper->infinityQuestion('What is the Name?');

        return $answers;
    }

    private function removeFile(string $targetFile): void
    {
        if (file_exists($targetFile)) {
            unlink($targetFile);
        }
    }
}