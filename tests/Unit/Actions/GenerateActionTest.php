<?php

declare(strict_types=1);

namespace OrlovTech\ShortLink\Test\Unit\Actions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use OrlovTech\ShortLink\Actions\GenerateAction;
use OrlovTech\ShortLink\Exceptions\UrlKeyAlreadyExistsException;
use OrlovTech\ShortLink\Exceptions\WrongLinkException;
use OrlovTech\ShortLink\Models\ShortLink;
use OrlovTech\ShortLink\Test\TestCase;

final class GenerateActionTest extends TestCase
{
    use RefreshDatabase;

    protected readonly GenerateAction $generateAction;

    protected function setUp(): void
    {
        parent::setUp();
        $this->generateAction = app(GenerateAction::class);
    }

    /** @test */
    public function it_generates_a_short_link_with_default_values(): void
    {
        $destinationUrl = 'http://example.com';

        $shortLink = $this->generateAction->generate($destinationUrl);

        $this->assertInstanceOf(ShortLink::class, $shortLink);
        $this->assertEquals($destinationUrl, $shortLink->destination_url);
        $this->assertEquals(config('short-link.prefix').$shortLink->url_key, $shortLink->default_short_url);
        $this->assertFalse($shortLink->single_use);
    }

    /** @test */
    public function it_generates_a_single_use_short_link()
    {
        $destinationUrl = 'http://example.com';

        $shortLink = $this->generateAction->generate($destinationUrl, true);

        $this->assertInstanceOf(ShortLink::class, $shortLink);
        $this->assertEquals($destinationUrl, $shortLink->destination_url);
        $this->assertEquals(config('short-link.prefix').$shortLink->url_key, $shortLink->default_short_url);
        $this->assertTrue($shortLink->single_use);
    }

    /** @test */
    public function it_throws_exception_for_invalid_destination_url(): void
    {
        $this->expectException(WrongLinkException::class);

        $this->generateAction->generate('invalid-url');
    }

    /** @test */
    public function it_generates_unique_short_links(): void
    {
        $destinationUrl = 'http://example.com';

        $shortLink1 = $this->generateAction->generate($destinationUrl);
        $shortLink2 = $this->generateAction->generate($destinationUrl);

        $this->assertNotEquals($shortLink1->url_key, $shortLink2->url_key);
    }

    /** @test */
    public function it_generates_a_url_key_with_default_length(): void
    {
        $urlKey = $this->generateAction->urlKey();

        $this->assertIsString($urlKey);
        $this->assertEquals(13, strlen($urlKey));
    }

    /** @test */
    public function it_generates_unique_url_keys(): void
    {
        $urlKey1 = $this->generateAction->urlKey();
        $urlKey2 = $this->generateAction->urlKey();

        $this->assertNotEquals($urlKey1, $urlKey2);
    }

    /** @test */
    public function it_generates_named_url_key(): void
    {
        $destinationUrl = 'http://example.com';

        $shortLink = $this->generateAction->generate($destinationUrl, true, 'custom_url_key');

        $this->assertEquals('custom_url_key', $shortLink->url_key);
    }
    
    /** @test */
    public function it_generates_unique_named_url_key(): void
    {
        $destinationUrl = 'http://example.com';
        $this->expectException(UrlKeyAlreadyExistsException::class);

        $shortLink1 = $this->generateAction->generate($destinationUrl, true, 'custom_url_key');
        $shortLink2 = $this->generateAction->generate($destinationUrl, true, 'custom_url_key');
    }
}
