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
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

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
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'..').DIRECTORY_SEPARATOR,
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/forgotPassword", name="forgotPassword")
     */
    public function forgotPasswordAction(Request $request)
    {
        $forgotPass = array(
            'username' => null
        );
        $form = $this->createFormBuilder($forgotPass)
            ->add('username', TextType::class, array(
                'constraints' => array(
                    new NotBlank(),
                    new Length(array('min' => 6))
            )))
            ->add('save', SubmitType::class, array('label' => 'Send Email'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $forgotPass = $form->getData();
            $realUser = $this->getDoctrine()->getRepository('AppBundle:User')->findOneByUsername($forgotPass['username']);
            if(is_null($realUser)) {
                return $this->render('security/forgotPassword.html.twig', array(
                    'base_dir' => realpath($this->getParameter('kernel.root_dir').'..').DIRECTORY_SEPARATOR,
                    'status' => $forgotPass['username'] . ' is not a valid user',
                ));
            }
            $resetCode = $this->generateSignupCode();
            $realUser->setForgotPasswordKey($resetCode);
            $realUser->setForgotPasswordExpiry(time() + 2 * 60 * 60);
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
                'status' => 'Sent Password Reset Email to ' . $forgotPass['username'],
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

        if( is_null($forgottenUser) ) {
            return $this->render('security/forgotPassword.html.twig', array(
                'base_dir' => realpath($this->getParameter('kernel.root_dir').'..').DIRECTORY_SEPARATOR,
                'status' => 'Invalid Password Reset Link',
            ));
        }

        if ( $forgottenUser->getForgotPasswordExpiry() < time() ) {
            return $this->render('security/forgotPassword.html.twig', array(
                'base_dir' => realpath($this->getParameter('kernel.root_dir').'..').DIRECTORY_SEPARATOR,
                'status' => 'Password Reset Link has expired',
            ));
        }

        $forgotPass = array(
            'password' => null,
        );


        $form = $this->createFormBuilder($forgotPass)
            ->add('password', PasswordType::class, array(
                'constraints' => array(
                    new NotBlank(),
                    new Length(array('min' => 6))
                )))
            ->add('save', SubmitType::class, array('label' => 'Reset Password'))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $forgotPass = $form->getData();
            $password = $this->get('security.password_encoder')
                ->encodePassword($forgottenUser, $forgotPass['password']);
            $forgottenUser->setPassword($password);
            $forgottenUser->setForgotPasswordKey(null);
            $forgottenUser->setForgotPasswordExpiry(null);

            $em = $this->getDoctrine()->getManager();

            $em->persist($forgottenUser);
            $em->flush();


            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            'security/forgotPassword.html.twig',
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