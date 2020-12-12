<?php

namespace App\Tests;

use App\Services\EmbedVideo;
use PHPUnit\Framework\TestCase;

class EmbedVideoTest extends TestCase
{
    public function testSearchVideoId()
    {
        //Test with youtube
        $embedVideo = new EmbedVideo;
        $url = "https://www.youtube.com/watch?v=gCR5NvT_X1Q";
        $result = $embedVideo->searchVideoId($url);
        $this->assertEquals('gCR5NvT_X1Q', $result['videoId']);
        $this->assertEquals('youtube', $result['type']);

        //Test with vimeo
        $embedVideo = new EmbedVideo;
        $url = "https://vimeo.com/350769496";
        $result = $embedVideo->searchVideoId($url);
        $this->assertEquals('350769496', $result['videoId']);
        $this->assertEquals('vimeo', $result['type']);

        //Test with DailyMotion
        $embedVideo = new EmbedVideo;
        $url = "https://www.dailymotion.com/video/x2p4ddi";
        $result = $embedVideo->searchVideoId($url);
        $this->assertEquals('x2p4ddi', $result['videoId']);
        $this->assertEquals('dailymotion', $result['type']);

        //Test with a wrong value with the dailymotion adress
        //return null if the result is empty
        $embedVideo = new EmbedVideo;
        $url = "https://www.dailmotion.com/video/x2p4ddi";
        $result = $embedVideo->searchVideoId($url);
        $this->assertEquals(null, $result);
    }

    public function testVideoPlayer()
    {
        //Test with Youtube
        $embedVideo = new EmbedVideo;
        $url = "https://www.youtube.com/watch?v=gCR5NvT_X1Q";
        $result = $embedVideo->videoPlayer($url);
        $this->assertEquals('https://www.youtube.com/embed/gCR5NvT_X1Q?autoplay=1frameborder="0" allowfullscreen autoplay="1"', $result);

        // Test with Vimeo
        $embedVideo = new EmbedVideo;
        $url = "https://vimeo.com/350769496";
        $result = $embedVideo->videoPlayer($url);
        $this->assertEquals('https://player.vimeo.com/video/350769496?autoplay=1frameborder="0"  webkitallowfullscreen mozallowfullscreen allowfullscreen', $result);

        // Test with DailyMotion
        $embedVideo = new EmbedVideo;
        $url = "https://www.dailymotion.com/video/x2p4ddi";
        $result = $embedVideo->videoPlayer($url);
        $this->assertEquals('https://www.dailymotion.com/embed/video/x2p4ddi?autoplay=1', $result);

        //Test with a wrong value with the dailymotion adress
        //return null if the result is empty
        $embedVideo = new EmbedVideo;
        $url = "https://www.dailmotion.com/video/x2p4ddi";
        $result = $embedVideo->videoPlayer($url);
        $this->assertEquals(null, $result);
    }
}
