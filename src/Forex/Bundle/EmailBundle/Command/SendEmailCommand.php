<?php

namespace Forex\Bundle\EmailBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendEmailCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('email:send-email')
            ->setDescription('Sends an email')
            ->addArgument('email',    InputArgument::REQUIRED, 'The email address to send to')
            ->addArgument('template', InputArgument::REQUIRED, 'The template')
            ->addArgument('subject',  InputArgument::REQUIRED, 'The subject')
            ->addArgument('data',     InputArgument::OPTIONAL, 'The data for the template (JSON formatted)', '[]')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()->get('forex.email_sender')
            ->sendToEmail(
                $input->getArgument('email'),
                $input->getArgument('subject'),
                $input->getArgument('template'),
                json_decode($input->getArgument('data'), true)
            );
    }
}
