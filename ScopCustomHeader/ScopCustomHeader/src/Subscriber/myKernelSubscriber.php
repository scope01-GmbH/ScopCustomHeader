<?php

namespace Scop\ScopCustomHeader\Subscriber;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class myKernelSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => "myKernelSubscriberFunction"
//            KernelEvents::RESPONSE => "myKernelResponseOverride"
        ];
    }

    public function myKernelSubscriberFunction()
    {
    }


}

