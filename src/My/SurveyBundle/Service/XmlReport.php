<?php

namespace My\SurveyBundle\Service;

use My\SurveyBundle\Entity\User;

class XmlReport
{
    private $fp;
    private $file;

    public function __construct($file, $create_new = false)
    {
        $this->file = $file;
        if(!file_exists($file) || $create_new) {
            $this->createNewFile();
        }
    }

    public function generate($users, $mtime = null) {
        if (count($users)) {
            $this->fp = fopen($this->file, 'r+');
            fseek($this->fp, -8, SEEK_END);
            foreach ($users as $user) {
                $this->addUserElement($user);
            }
            fwrite($this->fp, '</users>');
            fclose($this->fp);
            if ($mtime) {
                touch($this->file, $mtime);
            }
        }
    }

    private function addUserElement(User $user) {
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
        fwrite($this->fp, $entry);
    }

    private function createNewFile() {
        $content = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<users>
</users>
EOF;
        $fp = fopen($this->file, "wb");
        fwrite($fp,$content);
        fclose($fp);
    }

}