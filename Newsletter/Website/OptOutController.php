<?php

public class NewsletterOptOutController extends Controller
{
    public function optOutAction($emailAddress)
    {
        try {
            $emailAddress = new EmailAddress($emailAddress);
        } catch (\InvalidArgumentException){
            return $this->render('Error400.html.twig');
        }

        try {
            $this->optOutService->optOutSubscriber($emailAddress);
            return $this->render('Newsletter:opt_out_thanks.html.twig');
        } catch (EmailAddressNotFoundException) {
            return $this->render('Newsletter:error.html.twig');
        }
    }
}