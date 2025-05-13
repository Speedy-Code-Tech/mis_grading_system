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
            <div class="card-header text-white text-center opacity-75" style="background: #2874B3">
                <h4>Strands</h4>
            </div>

            <ul class="list-group list-group-flush">
                @foreach ($strands as $strand)
                    <li class="list-group-item d-flex align-items-center">
                        <div class="image-wrapper me-3">
                            <img src="{{ asset('img/' . strtolower($strand->course_code) . '.png') }}" alt="{{ $strand->course_code }} Logo"
                                class="strand-image" />
                        </div>
                        <div>
                            <strong>{{ $strand->course_code }}</strong><br>
                            <small class="text-muted">{{ $strand->description }}</small>
                        </div>
                    </li>
                @endforeach

                </ul>

            </ul>
        </div>

    </div>
@endsection