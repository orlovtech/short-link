<?php

declare(strict_types=1);

namespace OrlovTech\ShortLink\Test\Unit\Actions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use OrlovTech\ShortLink\Actions\RedirectAction;
use OrlovTech\ShortLink\Exceptions\LinkNotFoundException;
use OrlovTech\ShortLink\Models\ShortLink;
use OrlovTech\ShortLink\Test\TestCase;

final class RedirectActionTest extends TestCase
{
    use RefreshDatabase;

    protected readonly RedirectAction $redirectAction;

    protected function setUp(): void
    {
        parent::setUp();
        $this->redirectAction = app(RedirectAction::class);
    }

    /** @test */
    public function it_returns_destination_url_for_existing_short_link(): void
    {
        $destinationUrl = 'http://example.com';
        $urlKey = $this->createShortLink($destinationUrl, false);

        $result = $this->redirectAction->__invoke($urlKey);

        $this->assertEquals($destinationUrl, $result);
    }

    /** @test */
    public function it_deletes_single_use_short_link_after_access(): void
    {
        $destinationUrl = 'http://example.com';
        $urlKey = $this->createShortLink($destinationUrl, true);

        $result = $this->redirectAction->__invoke($urlKey);

        $this->assertEquals($destinationUrl, $result);
    }

    /** @test */
    public function it_throws_exception_for_non_existing_short_link(): void
    {
        $this->expectException(LinkNotFoundException::class);

        $this->redirectAction->__invoke('non-existing-key');
    }

    private function createShortLink(string $destinationUrl, bool $singleUse): string
    {
        $urlKey = Str::orderedUuid()->toString();

        ShortLink::query()
            ->create([
                'url_key' => $urlKey,
                'destination_url' => $destinationUrl,
                'single_use' => $singleUse,
            ]);

        return $urlKey;
    }
}
