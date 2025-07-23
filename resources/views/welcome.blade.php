@extends('layouts.app')
@section('title', 'Welcome')
@section('content')
<div class="card" style="max-width:600px;margin:3rem auto 0 auto;">
    <h1 style="font-size:2rem;font-weight:700;margin-bottom:1.2rem;letter-spacing:1px;">Beneficiary Tracker</h1>
    <p style="font-size:1.13rem;color:#555;margin-bottom:2.2rem;line-height:1.7;">
        Beneficiary Tracker is a web platform designed to help organizations and associations fairly manage and track aid distribution among beneficiaries. It ensures that priority is given to those who have received the least support, prevents duplicate aid within families, and provides a transparent overview of all aid activities.
    </p>
    <a href="{{ route('priority.index') }}" class="btn btn-primary" style="font-size:1.13rem;">Go to Dashboard</a>
</div>
@endsection
