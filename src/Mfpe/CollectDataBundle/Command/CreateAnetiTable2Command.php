<?php
namespace Mfpe\CollectDataBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateAnetiTable2Command extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('create:anetiTable2')
            ->setDescription('insert file perr_2 aneti')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $text = $this->getContainer()->get('app_aneti_service')->insertAnetiTable2();
        $output->writeln($text);
    }
}
