<?php

namespace My\SurveyBundle\Controller;

use My\SurveyBundle\Entity\User;
use My\SurveyBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $user = new User();

        $form = $this->createForm(new UserType(), $user);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }

        return array('name' => 'test');
    }

    /**
     * @Template()
     */
    public function countryAction(Request $request)
    {
        return array('country' => $request->get('country_alias'));
    }

    /**
     * @Route("/step2")
     * @Template()
     */
    public function stepTwoAction()
    {
        return array('name' => '2');
    }

    /**
     * @Route("/step3")
     * @Template()
     */
    public function stepThreeAction()
    {
        return array('name' => '3');
    }


}
