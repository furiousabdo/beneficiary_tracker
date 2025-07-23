@extends('layouts.app')
@section('title', 'Welcome')
@section('content')
<div class="home-hero">
    <div class="home-content">
        <h1 class="home-title">Beneficiary Tracker</h1>
        <p class="home-desc">
            Beneficiary Tracker is a web platform designed to help organizations and associations fairly manage and track aid distribution among beneficiaries. It ensures that priority is given to those who have received the least support, prevents duplicate aid within families, and provides a transparent overview of all aid activities.
        </p>
        <a href="{{ route('priority.index') }}" class="home-cta">Go to Dashboard</a>
    </div>
</div>
<style>
    .home-hero {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 60vh;
        background: #f8fafc;
    }
    .home-content {
        max-width: 520px;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 2px 24px #2563eb11;
        padding: 3rem 2rem 2.5rem 2rem;
        text-align: center;
    }
    .home-title {
        font-size: 2.3rem;
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 1.2rem;
        color: #222;
    }
    .home-desc {
        font-size: 1.13rem;
        color: #555;
        margin-bottom: 2.2rem;
        line-height: 1.7;
    }
    .home-cta {
        display: inline-block;
        background: #2563eb;
        color: #fff;
        font-size: 1.08rem;
        font-weight: 600;
        padding: 0.95rem 2.2rem;
        border-radius: 8px;
        text-decoration: none;
        box-shadow: 0 2px 8px #2563eb22;
        transition: background 0.18s, box-shadow 0.18s, transform 0.13s;
    }
    .home-cta:hover {
        background: #174bbd;
        box-shadow: 0 6px 24px #2563eb33;
        transform: translateY(-2px) scale(1.03);
    }
    @media (max-width: 600px) {
        .home-content { padding: 1.5rem 0.5rem; }
        .home-title { font-size: 1.5rem; }
    }
</style>
@endsection
