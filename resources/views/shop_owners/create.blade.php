@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white fw-bold">Create Shop Owner</div>
        <div class="card-body">
            <form action="{{ route('shop-owners.store') }}" method="POST">
                @csrf
                @include('shop_owners.form', ['button' => 'Create'])
            </form>
        </div>
    </div>
</div>
@endsection

