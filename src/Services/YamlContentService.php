<?php

declare(strict_types=1);

namespace App\Services;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Translation\LocaleSwitcher;
use Symfony\Component\Yaml\Yaml;
use Symfony\Contracts\Cache\CacheInterface;

/**
 * Class YamlContentService.
 *
 * @author rooneyi <22ki129@esisalama.org>
 */
final readonly class YamlContentService
{
    public function __construct(
        private CacheInterface $cache,
        #[Autowire('%kernel.project_dir%')] private string $projectDir,
        #[Autowire('%kernel.environment')] private string $environment,
        private LocaleSwitcher $localeSwitcher
    ) {
    }

    public function get(string $key): mixed
    {
        $locale = $this->localeSwitcher->getLocale();
        $data = sprintf(
            '%s/content/%s/%s.yaml',
            $this->projectDir,
            $this->localeSwitcher->getLocale(),
            $key
        );

        if ($this->environment === 'dev') {
            return Yaml::parseFile($data);
        }

        return $this->cache->get(sprintf('%s.%s', $key, $locale), fn (): mixed => Yaml::parseFile($data));
    }
}
