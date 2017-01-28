<?php

namespace AppBundle\Controller;

use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/forgotPassword", name="forgotPassword")
     */
    public function forgotPasswordAction(Request $request)
    {
        $user = new User();
        $form = $this->createFormBuilder($user)
            ->add('username', TextType::class)
            ->add('email', TextType::class)
            ->add('plainPassword', PasswordType::class)
            ->add('signupCode', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Send Email'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $realUser = $this->getDoctrine()->getRepository('AppBundle:User')->findOneByUsername($user->getUsername());
            $resetCode = $this->generateSignupCode();
            $realUser->setForgotPasswordKey($resetCode);
            $realUser->setForgotPasswordExpiry(time());
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($realUser);
            $manager->flush();

            $email = \Swift_Message::newInstance()
                ->setSubject('Forgotten Password Reset - CLSP')
                ->setFrom('no-reply@dev.clsp.gatech.edu')
                ->setTo($realUser->getEmail())
                ->setBody(
                    $this->renderView(
                        'email/forgotPassword.html.twig',
                        array(
                            'base_dir' => realpath($this->getParameter('kernel.root_dir').'..').DIRECTORY_SEPARATOR,
                            'link_code' => $resetCode
                        )
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($email);

            return $this->render('security/forgotPassword.html.twig', array(
                'base_dir' => realpath($this->getParameter('kernel.root_dir').'..').DIRECTORY_SEPARATOR,
                'status' => 'Sent Password Reset Email',
            ));
        }
        return $this->render('security/forgotPassword.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/forgotPassword/{id}", name="forgotPasswordLink")
     */
    //TODO: edit registration code times also edit user's times
    //TODO: check expiry date for codes
    public function forgotPasswordLinkAction(Request $request, $id)
    {
        $forgottenUser = $this->getDoctrine()->getRepository('AppBundle:User')->findOneByForgotPasswordKey($id);

        $form = $this->createFormBuilder($forgottenUser)
            ->add('username', TextType::class)
            ->add('email', TextType::class)
            ->add('plainPassword', PasswordType::class)
            ->add('signupCode', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Reset Password'))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->get('security.password_encoder')
                ->encodePassword($forgottenUser, $forgottenUser->getPlainPassword());
            $forgottenUser->setPassword($password);
            $forgottenUser->setForgotPasswordKey(null);
            $forgottenUser->setForgotPasswordExpiry(null);

            $em = $this->getDoctrine()->getManager();

            $em->persist($forgottenUser);
            $em->flush();


            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }

    private function generateSignupCode() {
        $randString = "";
        for($i = 0; $i < 16; $i++) {
            $randVal = rand(0,35);
            if($randVal > 25) {
                $randString .= $randVal - 26;
            } else {
                $randString .= chr($randVal + 97);
            }
        }
        return $randString;

    }


}