@extends('layouts.main', ['title' => 'DASHBOARD', 'active' => 'dashboard'])

@section('content')
    <div class="w-100 h-100 p-5">
        <div class="d-flex align-items-center mb-5">
            <a href="{{ route('admin.dashboard') }}">
                <h2 class="me-2" style="color: #A6DBD8; font-weight: 600;">Dashboard</h2>
            </a>
            <span style="color: #A6DBD8; font-size: 1.5rem;">/</span>
            <a href="{{ route('admin.dashboard.strand') }}">
                <h2 class="ms-2" style="color: #216ABF; font-weight: 600;">Strand</h2>
            </a>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white text-center">
                <h4>Strands</h4>
            </div>
            <ul class="list-group list-group-flush">

            <ul class="list-group list-group-flush">

                @php
                    $strands = [
                        ['image' => 'abm.png', 'title' => 'ABM', 'desc' => 'Accountancy, Business, and Management'],
                        ['image' => 'stem.png', 'title' => 'STEM', 'desc' => 'Science, technology, engineering, and mathematics'],
                        ['image' => 'humss.png', 'title' => 'HUMSS', 'desc' => 'Humanities and Social Sciences'],
                        ['image' => 'gas.png', 'title' => 'GAS', 'desc' => 'General Academic Strand'],
                        ['image' => 'he.png', 'title' => 'TVL', 'desc' => 'Technical Vocational Livelihood'],
                    ];
                @endphp

                @foreach ($strands as $strand)
                    <li class="list-group-item d-flex align-items-center">
                        <img src="{{ asset('img/' . $strand['image']) }}" alt="{{ $strand['title'] }}" class="me-3" style="width: 40px; height: 40px;">
                        <div>
                            <strong>{{ $strand['title'] }}</strong><br>
                            <small class="text-muted">{{ $strand['desc'] }}</small>
                        </div>
                    </li>
                @endforeach

                </ul>

            </ul>
        </div>

    </div>
@endsection