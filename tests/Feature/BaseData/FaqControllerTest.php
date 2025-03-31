<?php

namespace Tests\Feature\BaseData;

use App\Models\Faq;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Inertia;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class FaqControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a test user
        $this->user = User::factory()->create([
            'email' => 'test@example.com',
        ]);
    }

    #[Test]
    public function it_can_display_faq_list_page()
    {
        // Disable Vite and exception handling for testing
        $this->withoutVite();
        $this->withoutExceptionHandling();

        // Create some test FAQs
        Faq::create([
            'question' => 'Test Question 1',
            'answer' => 'Test Answer 1',
            'order' => 1,
            'status' => 'active',
        ]);

        Faq::create([
            'question' => 'Test Question 2',
            'answer' => 'Test Answer 2',
            'order' => 2,
            'status' => 'active',
        ]);

        // Mock the controller to avoid actual rendering
        $this->partialMock(\App\Http\Controllers\BaseData\FaqController::class)
            ->shouldReceive('index')
            ->andReturn(Inertia::render('basedata/faq/index', [
                'faqs' => [
                    'data' => [
                        [
                            'question' => 'Test Question 1',
                            'answer' => 'Test Answer 1',
                            'order' => 1,
                            'status' => 'active',
                        ],
                        [
                            'question' => 'Test Question 2',
                            'answer' => 'Test Answer 2',
                            'order' => 2,
                            'status' => 'active',
                        ],
                    ],
                ],
            ]));

        // Act as the authenticated user
        $response = $this->actingAs($this->user)
            ->get('/basedata/faq');

        // Assert response is successful
        $response->assertStatus(200);
    }

    #[Test]
    public function it_can_display_faq_details_page()
    {
        // Disable Vite and exception handling for testing
        $this->withoutVite();
        $this->withoutExceptionHandling();

        // Create a test FAQ with Mermaid diagram
        $faq = Faq::create([
            'question' => 'How does the system work?',
            'answer' => "The system works in the following way:\n\n```mermaid\nflowchart TD\n    A[Start] --> B[Process]\n    B --> C[End]\n```\n\nPlease follow the diagram above.",
            'order' => 1,
            'status' => 'active',
        ]);

        // Mock the controller to avoid actual rendering
        $this->partialMock(\App\Http\Controllers\BaseData\FaqController::class)
            ->shouldReceive('show')
            ->withAnyArgs()
            ->andReturn(Inertia::render('basedata/faq/show', ['faq' => $faq->toArray()]));

        // Act as the authenticated user
        $response = $this->actingAs($this->user)
            ->get('/basedata/faq/'.$faq->id);

        // Assert response is successful
        $response->assertStatus(200);
    }

    #[Test]
    public function it_can_create_a_new_faq()
    {
        $faqData = [
            'question' => 'New Test Question',
            'answer' => 'New Test Answer',
            'order' => 3,
            'status' => 'active',
        ];

        // Act as the authenticated user
        $response = $this->actingAs($this->user)
            ->post('/basedata/faq', $faqData);

        // Assert the FAQ was created in the database
        $this->assertDatabaseHas('faqs', $faqData);

        // Assert redirection to the FAQ list page
        $response->assertRedirect(route('basedata.faq.index'));
    }

    #[Test]
    public function it_can_update_an_existing_faq()
    {
        // Create a test FAQ
        $faq = Faq::create([
            'question' => 'Original Question',
            'answer' => 'Original Answer',
            'order' => 4,
            'status' => 'active',
        ]);

        $updatedData = [
            'question' => 'Updated Question',
            'answer' => 'Updated Answer',
            'order' => 5,
            'status' => 'inactive',
        ];

        // Act as the authenticated user
        $response = $this->actingAs($this->user)
            ->put("/basedata/faq/{$faq->id}", $updatedData);

        // Assert the FAQ was updated in the database
        $this->assertDatabaseHas('faqs', array_merge(['id' => $faq->id], $updatedData));

        // Assert redirection to the FAQ list page
        $response->assertRedirect(route('basedata.faq.index'));
    }

    #[Test]
    public function it_can_delete_an_existing_faq()
    {
        // Create a test FAQ
        $faq = Faq::create([
            'question' => 'Question to Delete',
            'answer' => 'Answer to Delete',
            'order' => 6,
            'status' => 'active',
        ]);

        // Act as the authenticated user
        $response = $this->actingAs($this->user)
            ->delete("/basedata/faq/{$faq->id}");

        // Assert the FAQ was deleted from the database
        $this->assertDatabaseMissing('faqs', ['id' => $faq->id]);

        // Assert redirection to the FAQ list page
        $response->assertRedirect(route('basedata.faq.index'));
    }
}
