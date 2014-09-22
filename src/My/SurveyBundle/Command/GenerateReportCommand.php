<?php

namespace My\SurveyBundle\Command;

use My\SurveyBundle\Service\XmlReport;
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
                InputArgument::OPTIONAL,
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
        $file = $this->getContainer()->get('kernel')->getRootDir() . '/../web/data/report.xml';

        $survey_time = $this->getContainer()->getParameter('survey_time');
        $startDate = file_exists($file) ? new \DateTime(date('c', filemtime($file))) : null;
        $endDate = new \DateTime("-$survey_time minutes");

        $em = $this->getContainer()->get('doctrine');
        $users = $em->getRepository('MySurveyBundle:User')->findAllFinishedSurveyUsers($startDate, $endDate);

        $report = new XmlReport($file);
        $report->generate($users, $endDate->getTimestamp());

        if ($email = $input->getArgument('email')) {
            $date = new \DateTime('now');
            $message = \Swift_Message::newInstance()
                ->setSubject('Report generated')
                ->setFrom('sf2-survey@yandex.ua')
                ->setTo($email)
                ->setBody('Report generated at '.$date->format('Y-m-d H:i:s'))
            ;
            $this->getContainer()->get('mailer')->send($message);
        }

        return $output->writeln("<info>Done</info>");
    }


}
