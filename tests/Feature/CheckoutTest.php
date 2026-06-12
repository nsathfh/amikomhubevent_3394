<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that guest can view checkout page.
     */
    public function test_guest_can_view_checkout_page(): void
    {
        $category = Category::create(['name' => 'Seminar', 'slug' => 'seminar']);
        $event = Event::create([
            'category_id' => $category->id,
            'title' => 'Event Tech',
            'description' => 'Description test',
            'date' => now()->addDays(10),
            'location' => 'Lobby',
            'price' => 10000,
            'stock' => 50,
        ]);

        $response = $this->get("/checkout/{$event->id}");

        $response->assertStatus(200);
        $response->assertSee('Event Tech');
    }

    /**
     * Test that guest can checkout successfully.
     */
    public function test_guest_can_checkout_successfully(): void
    {
        $category = Category::create(['name' => 'Seminar', 'slug' => 'seminar']);
        $event = Event::create([
            'category_id' => $category->id,
            'title' => 'Event Tech',
            'description' => 'Description test',
            'date' => now()->addDays(10),
            'location' => 'Lobby',
            'price' => 10000,
            'stock' => 50,
        ]);

        $response = $this->post("/checkout/{$event->id}", [
            'customer_name' => 'John Doe',
            'customer_email' => 'john@example.com',
            'customer_phone' => '0812345678',
        ]);

        $response->assertRedirect('/');
        
        $this->assertDatabaseHas('transactions', [
            'event_id' => $event->id,
            'customer_name' => 'John Doe',
            'customer_email' => 'john@example.com',
            'customer_phone' => '0812345678',
            'total_price' => 15000, // 10000 + 5000 admin fee
            'status' => 'Pending',
        ]);

        $this->assertEquals(49, $event->fresh()->stock);
    }

    /**
     * Test that guest cannot checkout if stock is sold out.
     */
    public function test_guest_cannot_checkout_if_stock_sold_out(): void
    {
        $category = Category::create(['name' => 'Seminar', 'slug' => 'seminar']);
        $event = Event::create([
            'category_id' => $category->id,
            'title' => 'Event Sold Out',
            'description' => 'Description test',
            'date' => now()->addDays(10),
            'location' => 'Lobby',
            'price' => 10000,
            'stock' => 0, // sold out
        ]);

        $response = $this->post("/checkout/{$event->id}", [
            'customer_name' => 'John Doe',
            'customer_email' => 'john@example.com',
            'customer_phone' => '0812345678',
        ]);

        $response->assertSessionHas('error');
        $this->assertDatabaseMissing('transactions', [
            'event_id' => $event->id,
        ]);
    }

    /**
     * Test that admin can view transactions listing in admin panel.
     */
    public function test_admin_can_view_transactions_listing(): void
    {
        $admin = User::forceCreate([
            'name' => 'Admin Amikom',
            'email' => 'admin@amikom.ac.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $category = Category::create(['name' => 'Seminar', 'slug' => 'seminar']);
        $event = Event::create([
            'category_id' => $category->id,
            'title' => 'Event Tech',
            'description' => 'Description test',
            'date' => now()->addDays(10),
            'location' => 'Lobby',
            'price' => 10000,
            'stock' => 50,
        ]);

        Transaction::create([
            'event_id' => $event->id,
            'order_id' => 'TRX-123456',
            'customer_name' => 'John Doe',
            'customer_email' => 'john@example.com',
            'customer_phone' => '0812345678',
            'total_price' => 15000,
            'status' => 'Pending',
        ]);

        $response = $this->actingAs($admin)->get('/admin/transactions');

        $response->assertStatus(200);
        $response->assertSee('TRX-123456');
        $response->assertSee('John Doe');
    }
}
