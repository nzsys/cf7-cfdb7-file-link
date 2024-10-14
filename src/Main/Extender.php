<?php declare(strict_types=1);

final class Extender
{
    private const FILE_NAME_RETRIEVER_PRIORITY = 10;
    private const MAIL_BODY_APPENDER_PRIORITY = 15;

    public function __construct(
        private FileNameRetriever $fileNameRetriever,
        private MailBodyAppender $mailBodyAppender
    ) {
        $this->initializeHooks();
    }

    private function initializeHooks(): void
    {
        add_filter('cfdb7_before_save_data', [$this->fileNameRetriever, 'filter'], self::FILE_NAME_RETRIEVER_PRIORITY);
        add_action('wpcf7_before_send_mail', [$this->mailBodyAppender, 'append'], self::MAIL_BODY_APPENDER_PRIORITY, 3);
    }
}
