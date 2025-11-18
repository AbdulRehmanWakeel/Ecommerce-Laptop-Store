@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark fw-bold">Edit Shop Owner</div>
        <div class="card-body">
            <form action="{{ route('shop-owners.update', $shopOwner) }}" method="POST">
                @csrf
                @method('PUT')
                @include('shop_owners.form', ['button' => 'Update'])
            </form>
        </div>
    </div>
</div>
@endsection
