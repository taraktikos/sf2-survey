<?php

namespace My\SurveyBundle\Controller;

use My\SurveyBundle\Entity\Survey;
use My\SurveyBundle\Entity\User;
use My\SurveyBundle\Form\SurveyType;
use My\SurveyBundle\Form\UserType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $entity = new User();
        $form = $this->createForm(new UserType(), $entity, array(
            'action' => $this->generateUrl('my_survey_default_index'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Create'));

        $form->handleRequest($request);
        $entity->setIp($request->getClientIp());
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->set('user_id', $entity->getId());
            return $this->redirect($this->generateUrl('my_survey_default_steptwo'));
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/step2")
     * @Template()
     */
    public function stepTwoAction(Request $request)
    {
        $entity = new Survey();
        $em = $this->getDoctrine()->getManager();
        if ($user_id = $this->get('session')->get('user_id')) {
            $user = $em->getRepository('MySurveyBundle:User')->find($user_id);
        } else {
            return $this->redirect($this->generateUrl('my_survey_default_index'));
        }

        $entity->setUser($user);

        $form = $this->createForm(new SurveyType(), $entity, array(
            'action' => $this->generateUrl('my_survey_default_steptwo'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Create'));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('my_survey_default_stepthree'));
        }

        return array(
            'form' => $form->createView()
        );
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
