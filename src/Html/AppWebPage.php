<?php

namespace Html;

class AppWebPage extends WebPage
{
    public function __construct(string $title = "")
    {
        parent::__construct($title);
        $this->appendCssUrl('/css/style.css') ;
    }
    public function toHTML(): string
    {
        $lastUpdate = WebPage::getLastModification();

        return <<<HTML
        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta charset="utf-8">
                <title>{$this->getTitle()}</title>
                {$this->getHead()}
            </head>
            <body>
                <header class="header">
                    <h1>{$this->getTitle()}</h1>
                </header>
                <main class="content">
                    {$this->getBody()}
                </main>
                <footer class="footer">
                    <p>$lastUpdate</p>
                </footer>
            </body>
        </html>
        HTML;
    }
}
