<?php
// src/EventSubscriber/RequestSubscriber.php
namespace App\EventSubscriber;
use SymfonyComponentEventDispatcherEventSubscriberInterface;
use SymfonyComponentHttpKernelEvent\RequestEvent;
use PsrLogLoggerInterface;
class RequestSubscriber implements EventSubscriberInterface
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
          $this->logger = $logger;
     }

     public static function getSubscribedEvents()
     {
          return ['kernel.request' => 'onKernelRequest',];
     }

     public function onKernelRequest(RequestEvent $event)
     {
          $request = $event->getRequest();
          $this->logger->info('Visita a la página: ' . $request->getUri());
     }
}