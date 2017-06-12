<?php

namespace Application\RSS;
use Application\Models\News;

class RSS
{

    const RSS_NAME = __DIR__ . '/../../admin/rss/rss.xml';
    const RSS_NAME_TO_READ = __DIR__ . '/../../admin/rss/news.xml';
    const RSS_TITLE = 'Last news';
    const RSS_LINK = 'http://profithomework.local/index.php';

    private $dom;

    public function __construct()
    {

    }

    public function createRSS()
    {
        //get news
        $news = new News();
        $news_tape = $news->findAllRevers();

        //create DOM
        $this->dom = new \DOMDocument('1.0', 'utf-8');
        $this->dom->formatOutput = true;
        $this->dom->preserveWhiteSpace = false;

        //create rss element
        $rss = $this->dom->createElement('rss');
        $this->dom->appendChild($rss);
        $version = $this->dom->createAttribute('version');
        $version->value = '2.0';
        $rss->appendChild($version);

        //create channel element
        $channel = $this->dom->createElement('channel');
        $rss->appendChild($channel);

        //create title, link, description & language elements
        $title = $this->dom->createElement('title', self::RSS_TITLE);
        $link = $this->dom->createElement('link', self::RSS_LINK);
        $description = $this->dom->createElement('description', self::RSS_TITLE);
        $language = $this->dom->createElement('language', 'ru');
        $channel->appendChild($title);
        $channel->appendChild($link);
        $channel->appendChild($description);
        $channel->appendChild($language);

        //create item elements with content
        foreach ($news_tape as $value) {
            $item = $this->dom->createElement('item');

            //create title element with CDATA section
            $title = $this->dom->createElement('title');
            $cdata = $this->dom->createCDATASection($value->title);
            $title->appendChild($cdata);
            $item->appendChild($title);

            //create link element
            $link = $this->dom->createElement(
                'link',
                'http://profithomework.local/index.php?action=OneNews&amp;id=' . $value->id
            );
            $item->appendChild($link);

            //create description with CDATA section
            $description = $this->dom->createElement('description');
            $cdata = $this->dom->createCDATASection(mb_substr($value->article, 0, 400) . '...');
            $description->appendChild($cdata);
            $item->appendChild($description);

            //append item to channel
            $channel->appendChild($item);
        }

        //save document
        $this->dom->save(self::RSS_NAME);
    }

    public function readRSS(string $url)
    {
        $rss_data = [];

        //read remote .xml file
        if ('' !== trim($url)) {
            $file = file_get_contents($url);
        } else {
            $e = new \Exception('Введите адрес удаленного RSS');
            throw $e;
        }

        //save remote file into the /admin/rss/
        file_put_contents(self::RSS_NAME_TO_READ, $file);

        //disable libxml errors
        libxml_use_internal_errors(true);

        //interprets an .xml file into an object
        $sxml = simplexml_load_file(self::RSS_NAME_TO_READ);
        if (!$sxml) {
            $e = new \Exception('Вы ввели некоректный адрес удаленного RSS');
            throw $e;
        }

        $main_title = (string)$sxml->channel->title;
        $rss_data['title'] = $main_title;

        $i = 0;
        foreach ($sxml->channel->item as $item) {
            $rss_data['items'][$i]['title'] = (string)$item->title;
            $rss_data['items'][$i]['description'] = strip_tags((string)$item->description, '<a>');
            $rss_data['items'][$i]['pubDate'] = date('F j, Y, g:i a', strtotime((string)$item->pubDate));
            $rss_data['items'][$i]['link'] = (string)$item->link;
            $i++;
        }

        return $rss_data;
    }

}