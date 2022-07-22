<?php

declare(strict_types=1);

namespace App\Helper;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class QuestionAskHelper
{
    public function __construct(
        private InputInterface $input,
        private OutputInterface $output,
        private $helper
    ) {}

    public function infinityQuestion(string $question): string
    {
        do {
            $answer = $this->singleQuestion($question);
            if ($answer !== null) {
                return $answer;
            }

            $this->output->writeln("Invalid answer. Try it again!\n");

        } while (true);
    }

    public function singleQuestion(string $question): ?string
    {
        $questionObject = new Question($question . ' ', null);

        return $this->helper->ask($this->input, $this->output, $questionObject);
    }
}