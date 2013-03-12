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
            ->addArgument('oneOrAll',InputArgument::OPTIONAL,'You can specifie a name or generate all sprite. Default will generate all sprite ?')
            ;
    }
 
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $oneOrAll = $input->getArgument('oneOrAll');
         if ($oneOrAll) {
            $output->writeln('<info>Starting generate sprite '.$oneOrAll.'</info>');
            $sprite = $this->getContainer()->get('sphax.sprite');
            $sprite->createOneSprite($oneOrAll);
            $sprite->generateOneSprite($oneOrAll);
         } else {
            $output->writeln('<info>Starting generate sprite process</info>');
            $sprite = $this->getContainer()->get('sphax.sprite');
            $sprite->createSprite();
            $sprite->generateSprite();
         }
    }
}