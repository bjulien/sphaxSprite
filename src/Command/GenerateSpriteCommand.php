<?php
namespace SphaxSprite\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use SphaxSprite\Exception\SpriteException;

class GenerateSpriteCommand extends ContainerAwareCommand
{
    /**
     * configure
     *
     * @access protected
     * @return void
     */
    protected function configure()
    {
 
        $this
            ->setName('sphax:sprite:generate')
            ->setDescription('Generate sprite')
            ->addArgument(
                'name',
                InputArgument::OPTIONAL,
                'You can specifie the name of one of your sprites. ' .
                    'If not set, all the sprites are generated.'
            );
    }
 
    /**
     * execute
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @access protected
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $name = $input->getArgument('name');
             if (!empty($name)) {
                $output->writeln('<info>Starting generate sprite ' . $name . '</info>');
                $sprite = $this->getContainer()->get('sphax.sprite');
                $sprite->generateOneSprite($name);
             } else {
                $output->writeln('<info>Starting generate sprite process</info>');
                $sprite = $this->getContainer()->get('sphax.sprite');
                $sprite->generateSprite();
             }
         } catch (SpriteException $e) {
             $output->writeln('<error>' . $e->getMessage() . '</error>');
         }
    }
}
