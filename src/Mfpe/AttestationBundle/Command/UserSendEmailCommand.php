<?php
namespace Mfpe\AttestationBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UserSendEmailCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('sendEmailUser:OrderExccedTime')
            ->setDescription('email envoyer par succée')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $text = $this->getContainer()->get('mfpe_user_demandes_service')->sendEmailUserExccedTimePvUpload();
        $output->writeln($text);
    }
}
