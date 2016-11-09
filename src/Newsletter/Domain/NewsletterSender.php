<?php

namespace Newsletter\Domain;


interface NewsletterSender
{
    /**
     * @param Newsletter $newsletter
     * @param Subscriber $subscriber
     */
    public function sendNewsletter(Newsletter $newsletter,
                                   Subscriber $subscriber);

}