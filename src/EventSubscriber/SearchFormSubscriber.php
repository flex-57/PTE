<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Form\FormFactoryInterface;
use App\Form\SearchType;
use Twig\Environment;

class SearchFormSubscriber implements EventSubscriberInterface
{
    private Environment $twig;
    private FormFactoryInterface $formFactory;

    public function __construct(Environment $twig, FormFactoryInterface $formFactory)
    {
        $this->twig = $twig;
        $this->formFactory = $formFactory;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }

    public function onKernelController(): void
    {
        $form = $this->formFactory->createNamed('', SearchType::class, null, [
            'method' => 'get',
            'csrf_protection' => false,
        ]);

        $this->twig->addGlobal('searchForm', $form->createView());
    }
}
