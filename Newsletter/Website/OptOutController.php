<?php

use Newsletter\Domain\EmailAddress;
use Newsletter\Domain\NewsletterOptService;

class NewsletterOptOutController extends Controller
{
    private $optOutService;

    public function __construct()
    {
        $connectionString = "mysql://localhost/newsletter";
        $repository = new MysqlSubscriberRepository($connectionString);
        $this->optOutService = new NewsletterOptService($repository);
    }

    public function optOutAction($emailAddress)
    {
        try {
            $emailAddress = new EmailAddress($emailAddress);
        } catch (\InvalidArgumentException $e){
            return $this->render('Error400.html.twig');
        }

        try {
            $this->optOutService->optOutSubscriber($emailAddress);
            return $this->render('Newsletter:opt_out_thanks.html.twig');
        } catch (SubscriberNotFoundException $e) {
            return $this->render('Newsletter:error.html.twig');
        }
    }
}
