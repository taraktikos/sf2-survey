<?php

namespace My\SurveyBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GenerateReportCommand extends ContainerAwareCommand
{
    /**
     * @see Command
     */
    protected function configure()
    {
        $this
            ->setName('survey:generate:report')
            ->setDescription('Generate survey report')
            ->addArgument(
                'email',
                InputArgument::REQUIRED,
                'Email'
            )
            ->setHelp(<<<EOF
<info>php app/console survey:generate:report email</info>
EOF
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $email = $input->getArgument('email');
        $file = $this->getContainer()->get('kernel')->getRootDir() . '/../web/data/report.xml';
        if(!file_exists($file)) {
            $this->createFile($file);
        }

        $em = $this->getContainer()->get('doctrine');
        $users = $em->getRepository('MySurveyBundle:User')->findAll();

        $file = fopen($file, 'r+');
        fseek($file, -8, SEEK_END);
        foreach($users as $user) {
            $entry = '<user>'.
                '<firstName>'.$user->getFirstName().'</firstName>'.
                '<lastName>'.$user->getLastName().'</lastName>'.
                '<ip>'.$user->getIp().'</ip>'.
                '<finished>'.($user->getSurvey() ? 1 : 0).'</finished>'.
                '<survey>'.
                    '<question></question>'.
                    '<answer></answer>'.
                '</survey>'.
                '<errors>'.
                    '<question></question>'.
                    '<error></error>'.
                '</errors>'.
                '</user>'.PHP_EOL;
            fwrite($file, $entry);
        }
        fwrite($file, '</users>');
        fclose($file);
        return $output->writeln("<info>".$email."</info>");
    }

    private function createFile($file) {
        $content = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<users>
</users>
EOF;
        $fp = fopen($file, "wb");
        fwrite($fp,$content);
        fclose($fp);
    }
}
