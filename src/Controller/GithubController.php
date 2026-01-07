<?php
// src/Controller/GithubController.php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

use Symfony\Component\Routing\Attribute\Route;

class GithubController extends AbstractController
{
    #[Route('/api/github/contributions', name: 'github_contributions')]
    public function contributions(HttpClientInterface $client): Response
    {
        $token = $_ENV['GITHUB_TOKEN'] ?? null;
        $username = 'rooneyi';
        if (!$token) {
            return new JsonResponse(['error' => 'Missing GitHub token'], 403);
        }

        $response = $client->request('GET', "https://api.github.com/user/repos?type=all&sort=updated", [
            'headers' => [
                'Authorization' => 'token ' . $token,
                'Accept' => 'application/vnd.github+json',
                'User-Agent' => 'Symfony-App',
            ],
        ]);
        $repos = $response->toArray();

        // Retourne tous les repos (perso et contributions)
        $contributions = [];
        foreach ($repos as $repo) {
            $contributions[] = [
                'name' => $repo['name'],
                'html_url' => $repo['html_url'],
                'owner' => [
                    'login' => $repo['owner']['login'],
                    'avatar_url' => $repo['owner']['avatar_url'],
                ],
            ];
        }

        return new JsonResponse($contributions);
    }
}
