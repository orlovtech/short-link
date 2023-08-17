<?php

declare(strict_types=1);

namespace OrlovTech\ShortLink\Test\Unit\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\RedirectResponse;
use Mockery;
use OrlovTech\ShortLink\Actions\RedirectAction;
use OrlovTech\ShortLink\Http\Controllers\RedirectController;
use OrlovTech\ShortLink\Test\TestCase;

final class RedirectControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_redirects_to_destination_url_for_existing_short_link(): void
    {
        $urlKey = 'test-url-key';
        $destinationUrl = 'http://example.com';

        $redirectAction = Mockery::mock(RedirectAction::class);
        $redirectAction->shouldReceive('__invoke')->with($urlKey)->andReturn($destinationUrl);

        $controller = new RedirectController();

        $response = $controller->__invoke($urlKey, $redirectAction);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals($destinationUrl, $response->headers->get('Location'));
    }
}
