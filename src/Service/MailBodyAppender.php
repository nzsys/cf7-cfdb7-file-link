<?php declare(strict_types=1);

final class MailBodyAppender
{
    public function __construct(
        private FileNameRetriever $fileNameRetriever
    ) {}

    public function append(
        WPCF7_ContactForm $contactForm,
        bool $about,
        WPCF7_Submission $submission
    ): WPCF7_ContactForm {
        $renameFile = $this->fileNameRetriever->getRenameFile();
        if (!$renameFile) {
            return $contactForm;
        }

        $uploadedFiles = array_filter($submission->uploaded_files(), static function($value) {
            return !(is_array($value) && empty($value));
        });

        if ($uploadedFiles) {
            $uploadDirectory = wp_upload_dir();
            $contactForm->set_properties([
                'mail' => array_merge($contactForm->prop('mail'), [
                    'body' => $contactForm->prop('mail')['body'] . "\n{$uploadDirectory['baseurl']}/cfdb7_uploads/{$renameFile}"
                ])
            ]);
        }

        return $contactForm;
    }
}
