<?php

namespace App\Services;

use DiDom\Document;

class DidomService
{
    const URL = 'https://tashkent.hh.uz/resume/64caf92e000b12de5200578b2e675976776c46?vacancyId=67711786&hhtmFromLabel=suitable_resumes&t=2835418699&resumeId=185785938&hhtmFrom=employer_vacancy_responses';

    public function parse(): void
    {
        $html = $this->GPrequest(self::URL, null, 'SbUsj_xXeOVtJE_vsQPrDLOEUQPx');

        $document = new Document();

        $document->loadHtml($html);

        $posts = $document->find('h2[data-qa="resume-personal-name"] > span');

        foreach($posts as $post) {
            echo $post->text(), "\n";
        }
    }

    /**
     *
     * Function  GPrequest
     * @param string $url
     * @param array|null $data
     */
    public function GPrequest(string $url, array $data = null, $cookie = null)
    {
        $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/112.0';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
        $header = [
            'Accept: application/json',
            'Accept-Language: en-US,ru-RU;q=0.8,ru;q=0.5,en;q=0.3',
            'Content-Type: application/json; charset=utf-8',
            'Language: ru',
            'Content-Length: ' . strlen($data)];
        if($cookie) {
            $header[] = "Cookie: $cookie";
        }
        if ($data) {
            $data = json_encode($data, JSON_UNESCAPED_UNICODE);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}
