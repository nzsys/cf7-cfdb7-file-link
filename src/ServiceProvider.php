<?php declare(strict_types=1);

include __DIR__ . '/Service/FileNameRetriever.php';
include __DIR__ . '/Service/MailBodyAppender.php';

final class ServiceProvider
{
    public function __construct(
        private DIContainer $container
    ) {
        $this->registerServices();
    }

    private function registerServices(): void
    {
        $this->container->register('fileNameRetriever', fn() => new FileNameRetriever);
        $this->container->register('mailBodyAppender', fn($container) => new MailBodyAppender($container->get('fileNameRetriever')));

        $this->container->register('Extender', fn($container) => new Extender(
            $container->get('fileNameRetriever'),
            $container->get('mailBodyAppender'),
        ));
    }
}
