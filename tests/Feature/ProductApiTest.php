<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(LazilyRefreshDatabase::class);

it('allows unauthenticated users to view the product catalog', function () {
    $this->getJson('/api/products')->assertOk();
});

it('forbids non-admin users from creating, updating, or deleting products', function () {
    $customer = User::factory()->create([
        'phone_number' => '081234567893',
        'role' => 'customer',
    ]);
    $product = Product::create([
        'product_code' => 'P008',
        'product_name' => 'Cocoa Bean Standard',
        'product_type' => 'fermented',
        'grade' => 'A',
        'price_per_kg' => 150000,
        'is_active' => true,
    ]);

    $this->postJson('/api/products', [])->assertUnauthorized();
    $this->patchJson("/api/products/{$product->id}", [])->assertUnauthorized();
    $this->deleteJson("/api/products/{$product->id}")->assertUnauthorized();

    Sanctum::actingAs($customer);

    $this->postJson('/api/products', [
        'product_code' => 'P999',
        'product_name' => 'Unauthorized Product',
        'product_type' => 'fermented',
        'grade' => 'A',
        'price_per_kg' => 100000,
    ])->assertForbidden();

    $this->patchJson("/api/products/{$product->id}", [
        'product_name' => 'Unauthorized Update',
    ])->assertForbidden();

    $this->deleteJson("/api/products/{$product->id}")->assertForbidden();
});

it('allows admins to create and update a product and records updated_by', function () {
    $admin = User::factory()->create([
        'phone_number' => '081234567894',
        'role' => 'admin',
    ]);
    Sanctum::actingAs($admin);

    $createResponse = $this->postJson('/api/products', [
        'product_code' => 'P009',
        'product_name' => 'Cocoa Bean Premium',
        'product_type' => 'fermented',
        'grade' => 'A',
        'description' => 'Premium fermented cocoa beans.',
        'price_per_kg' => 225000,
        'image_url' => 'https://example.com/cocoa-bean-premium.jpg',
        'is_active' => true,
    ]);

    $createResponse->assertCreated()
        ->assertJsonPath('message', 'Product created successfully.')
        ->assertJsonPath('data.product_code', 'P009')
        ->assertJsonPath('data.updated_by', null);

    $product = Product::where('product_code', 'P009')->firstOrFail();
    $this->assertModelExists($product);

    $this->patchJson("/api/products/{$product->id}", [
        'product_name' => 'Cocoa Bean Premium Updated',
        'price_per_kg' => 230000,
    ])->assertOk()
        ->assertJsonPath('data.product_name', 'Cocoa Bean Premium Updated')
        ->assertJsonPath('data.price_per_kg', '230000.00')
        ->assertJsonPath('data.updated_by', $admin->id);

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'updated_by' => $admin->id,
    ]);
});

it('lists, shows, and deletes an unused product as admin', function () {
    $admin = User::factory()->create([
        'phone_number' => '081234567895',
        'role' => 'admin',
    ]);
    Sanctum::actingAs($admin);
    $product = Product::create([
        'product_code' => 'P010',
        'product_name' => 'Cocoa Bean Test',
        'product_type' => 'non_fermented',
        'grade' => 'B',
        'price_per_kg' => 175000,
        'is_active' => true,
    ]);

    $this->getJson('/api/products')->assertOk()
        ->assertJsonPath('data.0.product_code', 'P010');

    $this->getJson("/api/products/{$product->id}")->assertOk()
        ->assertJsonPath('data.product_code', 'P010');

    $this->deleteJson("/api/products/{$product->id}")->assertNoContent();
    $this->assertModelMissing($product);
});

it('returns 409 when deleting a product used by another resource', function () {
    $admin = User::factory()->create([
        'phone_number' => '081234567896',
        'role' => 'admin',
    ]);
    Sanctum::actingAs($admin);
    $product = Product::create([
        'product_code' => 'P011',
        'product_name' => 'Cocoa Bean In Use',
        'product_type' => 'fermented',
        'grade' => 'C',
        'price_per_kg' => 125000,
        'is_active' => true,
    ]);
    $product->batches()->create([
        'batch_code' => 'BATCH-TEST-001',
        'initial_quantity_kg' => 100,
        'available_quantity_kg' => 100,
    ]);

    $this->deleteJson("/api/products/{$product->id}")
        ->assertStatus(409)
        ->assertJsonPath('message', 'This product cannot be deleted because it is used by batches or order items.');
});
