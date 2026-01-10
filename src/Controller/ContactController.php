<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mime\Email;
use App\Form\ContactType;

final class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact_index')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $email = (new Email())
                ->from('no-reply@rooney.tech')
                ->to('rooneykalumba610@gmail.com')
                ->replyTo($data['email'] ?? 'no-reply@rooney.tech')
                ->subject('Nouveau message de contact - ' . ($data['name'] ?? ''))
                ->text(sprintf(
                    "Nom: %s\nEmail: %s\nTéléphone: %s\nSujet: %s\n\nMessage:\n%s",
                    $data['name'] ?? '',
                    $data['email'] ?? '',
                    $data['phone'] ?? '',
                    $data['subject'] ?? '',
                    $data['message'] ?? ''
                ));

            try {
                $mailer->send($email);
                $this->addFlash('success', 'Ton message a bien été envoyé.');
                return $this->redirectToRoute('app_contact_index');
            } catch (TransportExceptionInterface $e) {
                $this->addFlash('error', "L'envoi de l'email a échoué. Merci de réessayer plus tard.");
            }
        }

        return $this->render('pages/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
