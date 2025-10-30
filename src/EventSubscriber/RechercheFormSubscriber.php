<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Form\RechercheType;
use Twig\Environment;

class RechercheFormSubscriber implements EventSubscriberInterface
{
    private Environment $twig;
    private FormFactoryInterface $formFactory;
    private RequestStack $requestStack;

    public function __construct(Environment $twig, FormFactoryInterface $formFactory, RequestStack $requestStack)
    {
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->requestStack = $requestStack;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }

    public function onKernelController(): void
    {
        $request = $this->requestStack->getCurrentRequest();
        if (!$request) return;

        $requestData = $request->query->all();

        // Transforme toutes les cases en booléens pour Symfony
        foreach (RechercheType::CATEGORIES as $checkbox) {
            $requestData[$checkbox] = !empty($requestData[$checkbox]);
        }

        $form = $this->formFactory->createNamed(
            '',
            RechercheType::class,
            $requestData,
            [
                'method' => 'get',
                'csrf_protection' => false,
            ]
        );

        $this->twig->addGlobal('rechercheForm', $form->createView());
    }
}
