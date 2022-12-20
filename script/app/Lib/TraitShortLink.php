<?php

namespace App\Lib;

use App\Models\ShortenLink;

trait TraitShortLink
{
    public function getHash(string $url)
    {
        return hash("crc32", $url);
    }

    public function getShortLink($url)
    {
        return route('frontend.home.shortLink', [
            'hash' => $this->getHash($url)
        ]);
    }

    public function findLink(string $hash)
    {
        return ShortenLink::whereHash($hash)->first();
    }

    public function saveShortLink(string $url)
    {
        $hash = $this->getHash($url);

        $shortLink = $this->findLink($hash);

        if (!$shortLink) {
            ShortenLink::create([
                'long_url' => $url,
                'hash' => $hash
            ]);
        }

        return $this->getShortLink($url);
    }

    public function redirectToUrl(string $hash)
    {
        $shortLink = $this->findLink($hash);

        return redirect($shortLink->long_url);
    }
}
