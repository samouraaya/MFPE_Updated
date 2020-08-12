<?php
namespace Mfpe\CollectDataBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateAnetiTable1Command extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('create:anetiTable1')
            ->setDescription('insert file txt aneti')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $text = $this->getContainer()->get('app_aneti_service')->insertAnetiTable1();
        $output->writeln($text);
    }
}
