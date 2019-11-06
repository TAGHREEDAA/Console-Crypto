<?php

namespace Crypto\Commands;

use Crypto\Encrypter\Encrypter;
use Crypto\Encrypter\MatrixEncrypter;
use Crypto\Encrypter\ReverseEncrypter;
use Crypto\Encrypter\ShiftEncrypter;
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
     *  Execute the command.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     *
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $word = $input->getArgument('word');
        $algorithm = $input->getArgument('algorithm');
        $operation = $input->getArgument('operation');
        $wordValid = $this->isWordValid($word);
        $algorithmAvailable = $this->isAlgorithmAvailable($algorithm);

        if ($wordValid && $algorithmAvailable) {
            if ($operation === 'encrypt' || $operation === 'decrypt') {
                $output->writeln("<info>Loading...</info>");
                $result = $this->getEncrypter($algorithm)->{$operation}($word);

                if (isset($result['success'])) {
                    $output->writeln('<comment>Result:</comment>');
                    $output->writeln('<comment>' . $result['success']['data'] . '</comment>');
                }
                else {
                    $output->writeln('<error>Error Occurred:</error> ' . $result['error']['code']);
                    $output->writeln('<error>' . $result['error']['message'] . '</error>');
                }
            }
            else {
                $output->writeln('<error>Operation is not defined!</error>');
            }
        } else {
            if (!$wordValid) {
                $output->writeln('<error>The string can not be blank!</error>');
            }

            if (!$algorithmAvailable) {
                $output->writeln('<error>Algorithm is not valid!</error>');
            }
        }

    }

    /**
     * Check if the given word is valid
     *
     * @param $word
     * @return bool
     */
    protected function isWordValid($word)
    {
        if (trim($word) != "") {
            return true;
        }
        return false;
    }


    /**
     * Check if the given algorithm is available or not
     *
     * @param $algorithm
     * @return bool
     */
    protected function isAlgorithmAvailable($algorithm)
    {
        $availableAlgorithms = ['shift', 'matrix', 'reverse'];

        if (in_array($algorithm, $availableAlgorithms)) {
            return true;
        }

        return false;
    }

    /**
     * @param $encrypter
     * @return Encrypter|null
     */
    protected function getEncrypter($encrypter)
    {
        if ($encrypter == "shift") {
            return new ShiftEncrypter();
        }

        if ($encrypter == "matrix") {
            return new MatrixEncrypter();
        }

        if ($encrypter == "reverse") {
            return new ReverseEncrypter();
        }

        return null;
    }
}