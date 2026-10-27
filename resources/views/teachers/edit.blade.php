@extends('layouts.app')
@section('title','Edit Teacher')
@section('eyebrow','Teachers / Edit Teacher')
@section('content')
<div class="mb-7"><a href="{{ route('teachers.index') }}" class="text-sm font-bold text-blue-700 hover:text-blue-900">← Back to Teachers</a><h1 class="mt-4 text-3xl font-extrabold tracking-tight text-slate-900">Edit Teacher</h1><p class="mt-2 text-sm text-slate-500">Fill in the details below. Fields marked * are required.</p></div>
<form method="POST" action="{{ route('teachers.update', $teacher) }}" enctype="multipart/form-data" class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">@csrf @method("PUT")
<div class="border-b border-slate-100 px-6 py-5"><h2 class="font-extrabold text-slate-900">Teacher information</h2><p class="mt-1 text-sm text-slate-500">Contact and identification details</p></div>
<div class="grid gap-5 p-6 md:grid-cols-2">
    <div><label class="mb-2 block text-sm font-bold text-slate-700" for="name">Full name <span class="text-rose-500">*</span></label><input id="name" name="name" required value="{{ old('name', $teacher->name) }}" class="field" placeholder="Enter full name"></div>
    <div><label class="mb-2 block text-sm font-bold text-slate-700" for="email">Email address <span class="text-rose-500">*</span></label><input id="email" type="email" name="email" required value="{{ old('email', $teacher->email) }}" class="field" placeholder="name@example.com"></div>
    <div><label class="mb-2 block text-sm font-bold text-slate-700" for="gender">Gender <span class="text-rose-500">*</span></label><select id="gender" name="gender" required class="field"><option value="">Select gender</option>@foreach(['male'=>'Male','female'=>'Female','other'=>'Other'] as $key=>$label)<option value="{{ $key }}" @selected(old('gender', $teacher) === $key)>{{ $label }}</option>@endforeach</select></div>
    <div><label class="mb-2 block text-sm font-bold text-slate-700" for="phone">Phone number</label><input id="phone" name="phone" value="{{ old('phone', $teacher->phone) }}" class="field" placeholder="Optional contact number"></div>
    <div class="md:col-span-2"><label class="mb-2 block text-sm font-bold text-slate-700" for="image">Profile photo</label><input id="image" type="file" accept=".jpg,.jpeg,.png,.webp" name="image" class="field" ><p class="mt-2 text-xs text-slate-400">JPG, PNG or WebP · maximum 2 MB.</p>@if($teacher->image)<div class="mt-3 flex items-center gap-3"><img src="{{ asset('storage/'.$teacher->image) }}" class="h-14 w-14 rounded-xl object-cover" alt="Current photo"><span class="text-xs text-slate-500">Current photo will be replaced if you upload another.</span></div>@endif</div></div>
<div class="flex flex-col-reverse gap-3 border-t border-slate-100 bg-slate-50/70 px-6 py-5 sm:flex-row sm:justify-end"><a href="{{ route('teachers.index') }}" class="btn-secondary">Cancel</a><button type="submit" class="btn-primary">Save changes</button></div></form>
@endsection
