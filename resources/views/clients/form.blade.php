<div class="grid grid-cols-1 md:grid-cols-2 gap-3">

    <div>
        <label class="font-bold">Name</label>
        <input type="text" name="name" value="{{ old('name', $client->name ?? '') }}" class="w-full win-input">
    </div>

    <div>
        <label class="font-bold">Company</label>
        <input type="text" name="company_name" value="{{ old('company_name', $client->company_name ?? '') }}"
            class="w-full win-input">
    </div>

    <div>
        <label class="font-bold">Email</label>
        <input type="email" name="email" value="{{ old('email', $client->email ?? '') }}" class="w-full win-input">
    </div>

    <div>
        <label class="font-bold">Phone</label>
        <input type="text" name="phone" value="{{ old('phone', $client->phone ?? '') }}" class="w-full win-input">
    </div>

    <div class="md:col-span-2">
        <label class="font-bold">Address</label>
        <textarea name="address" rows="2" class="w-full win-input">{{ old('address', $client->address ?? '') }}</textarea>
    </div>

    <div class="md:col-span-2">
        <label class="font-bold">Notes</label>
        <textarea name="notes" rows="2" class="w-full win-input">{{ old('notes', $client->notes ?? '') }}</textarea>
    </div>

</div>
