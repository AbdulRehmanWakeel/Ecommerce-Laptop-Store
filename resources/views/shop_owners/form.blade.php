<div class="mb-3">
    <label class="form-label fw-semibold">Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $shopOwner->name ?? '') }}">
    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label class="form-label fw-semibold">Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $shopOwner->email ?? '') }}">
    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label class="form-label fw-semibold">Shop Name</label>
    <input type="text" name="shop_name" class="form-control" value="{{ old('shop_name', $shopOwner->shop_name ?? '') }}">
    @error('shop_name') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label class="form-label fw-semibold">Password</label>
    <input type="password" name="password" class="form-control">
    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
    @isset($shopOwner)
        <small class="text-muted">Leave blank if you do not want to change the password.</small>
    @endisset
</div>

<button class="btn btn-success">{{ $button }}</button>
<a href="{{ route('shop-owners.index') }}" class="btn btn-secondary ms-2">Cancel</a>
