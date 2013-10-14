<?php

namespace Forex\Bundle\EmailBundle\Command;

use Forex\Bundle\EmailBundle\Entity\EmailMessage;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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
        $this->em = $container->get('doctrine.orm.default_entity_manager');
        $this->sender = $container->get('forex.email_sender');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $progress = $this->getHelperSet()->get('progress');

        // TODO - Move to repo method
        $pendingMessages = $this->em->getRepository('ForexEmailBundle:EmailMessage')->findAll(array(
            'status' => EmailMessage::STATUS_PENDING,
        ));

        $progress->start($output, count($pendingMessages));

        foreach ($pendingMessages as $message) {
            $this->sender->send($message);
            $progress->advance();
        }

        $progress->finish();
        $this->em->flush();
    }
}
