<?php

use Newsletter\Domain\EmailAddress;
use Newsletter\Domain\NewsletterService;

class NewsletterController extends Controller
{
    private $newsletterService;

    public function __construct()
    {
        $connectionString = "mysql://localhost/newsletter";
        $repository = new MysqlSubscriberRepository($connectionString);
        $this->newsletterService = new NewsletterService($repository);
    }

    public function optOutAction($emailAddress)
    {
        try {
            $emailAddress = new EmailAddress($emailAddress);
        } catch (\InvalidArgumentException $e){
            return $this->render('Error400.html.twig');
        }

        try {
            $this->newsletterService->optOutSubscriber($emailAddress);
            return $this->render('Newsletter:opt_out_thanks.html.twig');
        } catch (SubscriberNotFoundException $e) {
            return $this->render('Newsletter:error.html.twig');
        }
    }

    public function signUp($firstName, $lastName, $emailAddress)
    {
        try {
            $emailAddress = new EmailAddress($emailAddress);
            $name = new SubscriberName($firstName, $lastName);
        } catch (\InvalidArgumentException $e){
            return $this->render('Error400.html.twig');
        }

        $this->newsletterService->optOutSubscriber($name, $emailAddress);
        return $this->render('Newsletter:opt_out_thanks.html.twig');
    }
}
