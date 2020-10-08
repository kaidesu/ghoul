<?php

namespace Ghoul;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GhoulCommand extends Command
{
    protected static $defaultName = 'ghoul';

    /**
     * Configure the command options.
     *
     * @return void
     */
    protected function configure()
    {
        $this->addArgument('path', InputArgument::REQUIRED, 'What script do you want to run?');
    }

    /**
     * Execute the command.
     *
     * @param  \Symfony\Component\Console\Input\InputInterface  $input
     * @param  \Symfony\Component\Console\Output\OutputInterface  $output
     * @return integer
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io   = new SymfonyStyle($input, $output);
        $path = realpath($input->getArgument('path'));

        $this->registerAutoload($path);

        $result = $this->executeScript($path);

        if ($result === true) {
            return Command::SUCCESS;
        }

        $io->warning('Could not find executable script: '.$input->getArgument('path'));
        return Command::FAILURE;
    }

    /**
     * Register Composer's autoloader if it exists.
     *
     * @param  string  $directory
     * @return void
     */
    private function registerAutoload($path)
    {
        $directory = dirname($path).'/vendor/autoload.php';
        $realpath  = realpath($path).'/vendor/autoload.php';

        if (file_exists($realpath)) {
            require($realpath);
        } else if (file_exists($directory)) {
            require($directory);
        }
    }

    /**
     * Execute the provided script.
     *
     * @param  string  $path
     * @return boolean
     */
    private function executeScript($path)
    {
        $script = $path;

        if (file_exists($path.'/index.php')) {
            $script .= '/index.php';
        } else if (file_exists($path.'/main.php')) {
            $script .= '/main.php';
        }

        if (! require($script)) {
            return false;
        }

        return true;
    }
}