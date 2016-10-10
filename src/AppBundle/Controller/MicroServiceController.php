<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Zend\Diactoros\ServerRequestFactory;

class MicroServiceController extends Controller
{
    /**
     * @Route("/{service}/{route}", name="ms",requirements={"route"=".+"})
     * Method("ANY")
     * Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * ParamConverter("post", options={"mapping": {"postSlug": "slug"}})
     */
    public function microServiceAction(Request $request,$service,$route)
    {
        $proxyUrls = ["config"=>"http://localhost:8001/"];

        $proxy = $this->get("http.proxy");
        $psr7Factory = $this->get("psr7.factory");
        $httpFoundationFactory = $this->get("foundation.factory");



        $proxyRequest = ServerRequestFactory::fromGlobals();//$psr7Factory->createRequest($request);
        $proxyRequest = $proxyRequest->withUri($proxyRequest->getUri()->withPath($route));
        $proxyRequest->getUri()->withPath("");

        $psrResponse = $proxy->forward($proxyRequest)->to($proxyUrls[$service]);


        return $httpFoundationFactory->createResponse($psrResponse);
    }
}
