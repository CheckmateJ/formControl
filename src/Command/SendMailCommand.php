<?php

namespace App\Command;

use App\Entity\FormPanel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

#[AsCommand(
    name: 'app:send-email',
)]
class SendMailCommand extends Command
{

    private $em;
    private $appAdminMail;
    private $mailer;

    public function __construct(EntityManagerInterface $entityManager, string $appAdminMail, MailerInterface $mailer)
    {
        $this->em = $entityManager;
        $this->appAdminMail = $appAdminMail;
        $this->mailer = $mailer;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $em = $this->em;
        $formPanel = $em->getRepository(FormPanel::class)->findAll();
        $tr = '';
        foreach ($formPanel as $form) {
            $tr .= '<tr>';
            $tr .= '<td>'. $form->getId() .'</td>';
            $tr .= '<td>'. $form->getName() .'</td>';
            $tr .= '<td>'. $form->getSurname() .'</td>';
            $tr .= '<td>'. $form->getRole() .'</td>';
            $tr .= '<td>'. $form->getNip() .'</td>';
            $tr .= '<td>'. $form->getPesel() .'</td>';
            $tr .= '<td>'. $form->getPhoneNumber() .'</td>';
            $tr .= '<td>'. $form->getEmail() .'</td>';
            $tr .= '<td>'. $form->getStreetAddress() .'</td>';
            $tr .= '<td>'. $form->getLocalNumber() .'</td>';
            $tr .= '<td>'. $form->getZipCode() .'</td>';
            $tr .= '<td>'. $form->getCorrespondenceAddress() .'</td>';
            $tr .= '<td>'. $form->getCorrespondenceLocalNumber() .'</td>';
            $tr .= '<td>'. $form->getCorrespondenceZipCode() .'</td>';
            $tr .= '<td>'. $form->getContactHours() .'</td>';
            $tr .= '<td>'. $form->getTopic() .'</td>';
            $tr .= '<td>'. $form->getPdfFileName() .'</td>';
            $tr .= '<td>'. $form->getIpAddress() .'</td>';
            $tr .= '<td>'. $form->getBrowserName() .'</td>';
            $tr .= '</tr>';
        }

        $email = (new Email())
            ->from('demo@example.com')
            ->to($this->appAdminMail)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<table class="table table-hover">
                          <thead>
                            <tr>
                              <th scope="col">Id</th>
                              <th scope="col">Name</th>
                              <th scope="col">Surname</th>
                              <th scope="col">Role</th>
                              <th scope="col">NIP</th>
                              <th scope="col">Pesel</th>
                              <th scope="col">Phone number</th>
                              <th scope="col">Email</th>
                              <th scope="col">Street address</th>
                              <th scope="col">Local number</th>
                              <th scope="col">Zip code</th>
                              <th scope="col">Correspondence address</th>
                              <th scope="col">Correspondence local number</th>
                              <th scope="col">Correspondence zip code</th>
                              <th scope="col">Contact hours</th>
                              <th scope="col">Topic</th>
                              <th scope="col">Pdf file name</th>
                              <th scope="col">Ip address</th>
                              <th scope="col">Browser name</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>'. $tr .'
                            </tr>
                          </tbody>
                        </table>');

        $this->mailer->send($email);

        return Command::SUCCESS;
    }
}
