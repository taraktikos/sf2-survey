<?php

namespace My\SurveyBundle\EventListener;

use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

use Maxmind\Bundle\GeoipBundle\Service\GeoipManager;

class CountryListener
{
    private $router;

    private $geoip_manager;

    public function __construct(Router $router, GeoipManager $geoip_manager)
    {
        $this->router = $router;
        $this->geoip_manager = $geoip_manager;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->getRequest()->get('country_alias')) {
            $geoip = $this->geoip_manager->lookup($event->getRequest()->getClientIp());
            if ($geoip) {
                $url = $this->router->generate('country_homepage', array('country_alias' => strtolower($geoip->getCountryCode())));
                $event->setResponse(new RedirectResponse($url));
            }
        }
    }

}
