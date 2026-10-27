@extends('layouts.app')
@section('title','Add Student')
@section('eyebrow','Students / Add Student')
@section('content')
<div class="mb-7"><a href="{{ route('students.index') }}" class="text-sm font-bold text-blue-700 hover:text-blue-900">← Back to Students</a><h1 class="mt-4 text-3xl font-extrabold tracking-tight text-slate-900">Add Student</h1><p class="mt-2 text-sm text-slate-500">Fill in the details below. Fields marked * are required.</p></div>
<form method="POST" action="{{ route('students.store') }}"  class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">@csrf 
<div class="border-b border-slate-100 px-6 py-5"><h2 class="font-extrabold text-slate-900">Student information</h2><p class="mt-1 text-sm text-slate-500">Contact and identification details</p></div>
<div class="grid gap-5 p-6 md:grid-cols-2">
    <div><label class="mb-2 block text-sm font-bold text-slate-700" for="name">Full name <span class="text-rose-500">*</span></label><input id="name" name="name" required value="{{ old('name') }}" class="field" placeholder="Enter full name"></div>
    <div><label class="mb-2 block text-sm font-bold text-slate-700" for="email">Email address <span class="text-rose-500">*</span></label><input id="email" type="email" name="email" required value="{{ old('email') }}" class="field" placeholder="name@example.com"></div>
    <div><label class="mb-2 block text-sm font-bold text-slate-700" for="gender">Gender <span class="text-rose-500">*</span></label><select id="gender" name="gender" required class="field"><option value="">Select gender</option>@foreach(['male'=>'Male','female'=>'Female','other'=>'Other'] as $key=>$label)<option value="{{ $key }}" @selected(old('gender', '') === $key)>{{ $label }}</option>@endforeach</select></div>
    <div><label class="mb-2 block text-sm font-bold text-slate-700" for="phone">Phone number</label><input id="phone" name="phone" value="{{ old('phone') }}" class="field" placeholder="Optional contact number"></div>
    <div class="md:col-span-2"><label class="mb-2 block text-sm font-bold text-slate-700" for="address">Address</label><input id="address" name="address" value="{{ old('address') }}" class="field" placeholder="Optional address"></div></div>
<div class="flex flex-col-reverse gap-3 border-t border-slate-100 bg-slate-50/70 px-6 py-5 sm:flex-row sm:justify-end"><a href="{{ route('students.index') }}" class="btn-secondary">Cancel</a><button type="submit" class="btn-primary">Create Student</button></div></form>
@endsection
