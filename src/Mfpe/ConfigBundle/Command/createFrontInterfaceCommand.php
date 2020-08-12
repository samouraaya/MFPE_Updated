<?php
namespace Mfpe\ConfigBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class createFrontInterfaceCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('create:interface')
            ->setDescription('create front interface')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $text =  $this->getContainer()->get('app_front_interface_service')->createFrontInterface();
        $output->writeln($text);
    }
}

{

}