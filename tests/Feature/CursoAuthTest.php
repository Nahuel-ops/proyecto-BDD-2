<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CursoAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_access_the_course_creation_form(): void
    {
        $this->get(route('curso.create'))
            ->assertRedirect(route('login'));
    }

    public function test_guests_cannot_store_a_course(): void
    {
        $this->post(route('curso.store'), [
            'categoria_id' => 1,
            'name' => 'Curso de prueba',
        ])->assertRedirect(route('login'));
    }

    public function test_guests_can_still_see_the_course_listing_and_details(): void
    {
        $this->get(route('curso.index'))->assertOk();
    }
}
