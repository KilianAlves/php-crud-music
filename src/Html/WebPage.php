<?php

namespace Html;

class WebPage
{
    private string $head;
    private string $title;
    private string $body;

    public function __construct(string $title = "")
    {
        $this->title = $title;
        $this->head = "";
        $this->body = "";
    }

    public function getHead(): string
    {
        $rep = $this->head;
        return $rep;
    }

    public function getTitle(): string
    {
        $rep = $this->title;
        return $rep;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getBody(): string
    {
        $rep = $this->body;
        return $rep;
    }

    public function appendToHead(string $content)
    {
        $this->head = $this->head . $content;
    }

    public function appendCss(string $css)
    {
        $this->appendToHead("<style>" . $css . "</style>");
    }

    public function appendCssUrl(string $url)
    {
        $this->appendToHead("<link rel='stylesheet' href='{$url}'>");
    }

    public function appendJs(string $js)
    {
        $this->appendToHead("<script>" . $js . "</script>");
    }

    public function appendJsUrl(string $url)
    {
        $this->appendToHead("<script src='{$url}'></script> ");
    }

    public function appendContent(string $content)
    {
        $this->body = $this->body . $content;
    }

    public function toHTML(): string
    {
        $res = "<!doctype html>";
        $res .= '<html lang="fr">';
        $res .= '<head> <meta charset="utf-8"> ';
        $res .= '<meta name="viewport" content="width=device-width, initial-scale=1">';
        $res .= $this->head;
        $res .= "<title>" . $this->title . "</title>";
        $res .= "</head>";
        $res .= "<body>" . $this->body . "</body>";
        $res .= "</html>";
        return $res;
    }

    public static function getLastModification(): string
    {
        echo "Dernière modification : " . date("F d Y H:i:s.", getlastmod());
    }

    public static function escapeString(string $string): string
    {
        $res = htmlspecialchars($string, $flags = ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, $encoding = null, $double_encode = true);
        return $res;
    }
}
