<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Attribute\Route;

final class CvController extends AbstractController
{
    #[Route('/cv/download', name: 'app_cv_download')]
    public function download(): BinaryFileResponse
    {
        $path = $this->getParameter('kernel.project_dir') . '/public/cv/Rooney-Kalumba-CV.pdf';

        if (!is_file($path)) {
            throw new FileNotFoundException(sprintf('CV file not found at "%s"', $path));
        }

        $response = new BinaryFileResponse($path);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'Rooney-Kalumba-CV.pdf');

        return $response;
    }
}
