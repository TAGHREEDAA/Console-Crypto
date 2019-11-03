<?php

namespace Crypto\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class CryptoCommand extends Command
{
    /**
     * Configure the command options.
     *
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('crypto')
            ->setDescription('Encrypt and decrypt given string/word with different algorithms.')
            ->addArgument('word', InputArgument::REQUIRED)
            ->addArgument('algorithm', InputArgument::REQUIRED)
            ->addArgument('operation', InputArgument::REQUIRED);
    }

    /**
     * Execute the command.
     *
     * @param  \Symfony\Component\Console\Input\InputInterface  $input
     * @param  \Symfony\Component\Console\Output\OutputInterface  $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $word = $input->getArgument('word');
        $algorithm = $input->getArgument('algorithm');
        $operation = $input->getArgument('operation');

        $output->writeln('<info>Loading</info>');
        $output->writeln('<comment>Comment</comment>');
    }

    /**
     * Check if the given word is valid
     *
     * @param $word
     * @return bool
     */
    protected function isValidWord($word)
    {
        if (trim($word) != "") {
            return true;
        }
        return false;
    }
}