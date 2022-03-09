<?php

namespace App\Console\Commands\techcrunch;

use App\Models\Post;
use voku\helper\HtmlDomParser;

class TechcrunchImport
{
    private $params = [];
    private $siteURL;

    public function __construct()
    {
        $this->siteURL = 'https://techcrunch.com/';
    }


    public function read(): bool
    {
        $templateHtml = file_get_contents('https://techcrunch.com/');
        $htmlTmp = HtmlDomParser::str_get_html($templateHtml);
        $bigDivs =  $htmlTmp->find('.post-block, .post-block--image, .post-block--unread');
        foreach($bigDivs as $key => $div) {
            if ($key > 9 ){
                break;
            }
            $link = $div->find('.post-block__title__link')->href['0'];
            $this->params[] = $this->getPostByURI($link);
        }

        return true;
    }


    public function getPostByURI($link): array
    {
        $data = [];
        $templateHtml = file_get_contents($link);
        $htmlTmp = HtmlDomParser::str_get_html($templateHtml);

        $data['title'] =  $htmlTmp->find('.article__title')[0]->innerHtml();
        $data['image_url'] = $htmlTmp->find('.article__featured-image, article__featured-image--block')->src['0'];
        $data['author'] = $htmlTmp->find('.article__byline a')[0]->innerText();
        $data['excerpt'] = $htmlTmp->find('.article-content')->innerHtml()[0];
        $data['site_url'] = $this->siteURL;
        $data['created_at'] = get_meta_tags($link)['sailthru_date'];

        return $data;
    }

    public function write(): bool
    {
        Post::insert($this->params);
        return true;
    }

    public function delete()
    {
        Post::where(['site_url'=> $this->siteURL])->delete();
    }


}
