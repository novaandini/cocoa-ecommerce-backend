<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CustomerController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return CustomerResource::collection(
            Customer::query()->with('user')->latest()->paginate(),
        );
    }

    public function show(Customer $customer): CustomerResource
    {
        return new CustomerResource($customer->load('user'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer): CustomerResource
    {
        $customer->update($request->validated());

        return (new CustomerResource($customer->refresh()->load('user')))
            ->additional(['message' => 'Customer updated successfully.']);
    }
}
