<?php

declare(strict_types=1);

namespace OrlovTech\ShortLink\Test\Unit\Models;

use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use OrlovTech\ShortLink\Models\ShortLink;
use OrlovTech\ShortLink\Test\TestCase;

final class ShortLinkTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_find_short_link_by_key(): void
    {
        $shortLink = $this->createShortLink([
            'url_key' => 'test-key',
            'destination_url' => 'http://example.com',
            'single_use' => false,
        ]);

        $foundLink = ShortLink::findByKey('test-key');

        $this->assertInstanceOf(ShortLink::class, $foundLink);
        $this->assertEquals($shortLink->id, $foundLink->id);
        $this->assertEquals($shortLink->destination_url, $foundLink->destination_url);
        $this->assertEquals($shortLink->single_use, $foundLink->single_use);
    }

    /** @test */
    public function it_returns_null_for_non_existing_key(): void
    {
        $foundLink = ShortLink::findByKey('non-existing-key');

        $this->assertNull($foundLink);
    }

    /** @test */
    public function it_uses_immutable_datetime_casts(): void
    {
        $shortLink = $this->createShortLink();

        $this->assertInstanceOf(CarbonImmutable::class, $shortLink->created_at);
        $this->assertInstanceOf(CarbonImmutable::class, $shortLink->updated_at);
    }

    /** @test */
    public function it_casts_single_use_to_boolean(): void
    {
        $shortLink = $this->createShortLink(['single_use' => 1]);

        $this->assertTrue($shortLink->single_use);
    }

    /** @test */
    public function it_has_soft_deletes(): void
    {
        $shortLink = $this->createShortLink();

        $shortLink->delete();

        $this->assertSoftDeleted('short_links', ['id' => $shortLink->id]);
    }

    private function createShortLink(array $attributes = []): ShortLink
    {
        return ShortLink::create(array_merge([
            'destination_url' => 'http://example.com',
            'default_short_url' => 'http://example.com/default',
            'url_key' => 'test-key',
            'single_use' => false,
        ], $attributes));
    }
}
