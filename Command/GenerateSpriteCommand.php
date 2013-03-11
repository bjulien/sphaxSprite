<?php
namespace Sphax\SpriteBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateSpriteCommand extends ContainerAwareCommand
{
    protected function configure()
    {
 
        $this
            ->setName('sprite:generate')
            ->setDescription('Generate sprite')
            ;
    }
 
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Starting generate sprite process</info>');
        $sprite = $this->getContainer()->get('sphax.sprite');
        $output->writeln('<info>Step 1 : create folder and sprite file configuration</info>');
        $sprite->createSprite();
        $output->writeln('<comment>Step 1 : done</comment>');
        $output->writeln('<info>Step 2 : generate sprite</info>');
        $sprite->generateSprite();
        $output->writeln('<comment>Step 2 : done</comment>');
    }
}