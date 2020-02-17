<?php
//Парсер
interface HTML
{
    public function getHtml();
}

class HTMLParser implements HTML
{
    private $url;
    public $html;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function getHtml()
    {
        $this->html = file_get_contents($this->url);

        return $this;
    }
}

class HTMLDecoder
{
    private $html;
    private $preg = '/\/\w+>/';

    public function __construct(HTML $html)
    {
        $this->html = $html->html;
    }

    public function getAllTags(): array
    {
        preg_match_all($this->preg, $this->html, $allTags);
        $tags = array_map(function ($value) {
            return substr($value, 1, -1);
        }, $allTags[0]);
        $tags[] = count($allTags[0]) - 1;
        return array_unique($tags);
    }
}

$url = 'https://www.google.com/search?q=%D0%BA%D0%B0%D0%BA+%D1%83%D1%81%D1%82%D1%80%D0%BE%D0%B8%D1%82%D1%81%D1%8F+%D0%BD%D0%B0+%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D1%83+php+%D0%BF%D1%80%D0%BE%D0%B3%D1%80%D0%B0%D0%BC%D0%BC%D0%B8%D1%81%D1%82%D0%BE%D0%BC&oq=%D0%BA%D0%B0%D0%BA+%D1%83%D1%81%D1%82%D1%80%D0%BE%D0%B8%D1%82%D1%81%D1%8F+%D0%BD%D0%B0+%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D1%83+php+%D0%BF%D1%80%D0%BE%D0%B3%D1%80%D0%B0%D0%BC%D0%BC%D0%B8%D1%81%D1%82%D0%BE%D0%BC&aqs=chrome..69i57j33l3.29969j0j7&sourceid=chrome&ie=UTF-8'; //Входная ссылка

$a = (new HTMLParser($url))
    ->getHtml();
$b = (new HTMLDecoder($a))
    ->getAllTags();

pr($b); //массив содержит все теги на странице, последний элемент массива содержит количество всех тегов


function pr(array $array): void
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
