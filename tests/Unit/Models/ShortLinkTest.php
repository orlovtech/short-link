<?php

declare(strict_types=1);

namespace OrlovTech\ShortLink\Test\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use OrlovTech\ShortLink\Facades\ShortLink;
use OrlovTech\ShortLink\Test\TestCase;

final class ShortLinkTest extends TestCase
{
    use RefreshDatabase;

    public function testItRecordAddedToDatabase(): void
    {
        $shortLink = ShortLink::generate('https://google.com/');

        $this->assertSame('https://google.com/', $shortLink->destination_url);
        $this->assertNotEmpty($shortLink->url_key);
        $this->assertFalse($shortLink->single_use);
    }
}
