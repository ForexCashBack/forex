<?php

namespace Forex\Bundle\EmailBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendEmailCommand extends ContainerAwareCommand
{
    protected $manager;
    protected $em;

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

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();

        $this->em = $container->get('doctrine.orm.default_entity_manager');
        $this->manager = $container->get('forex.email_manager');
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($user = $this->em->getRepository('ForexCoreBundle:User')->findOneByEmail($input->getArgument('email'))) {
            $this->manager->sendToUser(
                $user,
                $input->getArgument('subject'),
                $input->getArgument('template'),
                json_decode($input->getArgument('data'), true)
            );
        } else {
            $this->manager->sendToEmail(
                $input->getArgument('email'),
                $input->getArgument('subject'),
                $input->getArgument('template'),
                json_decode($input->getArgument('data'), true)
            );
        }

        $this->em->flush();
    }
}
