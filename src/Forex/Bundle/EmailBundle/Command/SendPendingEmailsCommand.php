<?php

namespace Forex\Bundle\EmailBundle\Command;

use Forex\Bundle\EmailBundle\Entity\EmailMessage;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Request;

class SendPendingEmailsCommand extends ContainerAwareCommand
{
    protected $em;
    protected $sender;

    protected function configure()
    {
        $this
            ->setName('email:send-pending-emails')
            ->setDescription('Sends all pending emails')
        ;
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();
        $request = new Request();
        $request->headers->set('host', $container->getParameter('cli_host'));
        $container->set('request', $request);
        $container->enterScope('request');

        $this->em = $container->get('doctrine.orm.default_entity_manager');
        $this->sender = $container->get('forex.email_sender');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $progress = $this->getHelperSet()->get('progress');

        $pendingMessages = $this->em->getRepository('ForexEmailBundle:EmailMessage')->findPendingEmails();

        $progress->start($output, count($pendingMessages));

        foreach ($pendingMessages as $message) {
            $this->sender->send($message);
            $progress->advance();
        }

        $progress->finish();
        $this->em->flush();
    }
}
