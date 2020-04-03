<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HtmlCleanerTest extends TestCase
{
    /**
     * @test
     */
    public function the_cleaner_page_is_available_to_all_guests()
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/html-cleaner');

        $response->assertOk();
    }

    /**
     * @test
     */
    public function a_post_request_can_be_made_to_clean_html()
    {
        $this->withoutExceptionHandling();

        $data = [
            'original' => '<h1>Hello World</h1>',
            'tags' => '',
            'attributes' => ''
        ];

        $response = $this->post('/html-cleaner', $data);

        $response->assertSeeText('Hello World');
    }
}
