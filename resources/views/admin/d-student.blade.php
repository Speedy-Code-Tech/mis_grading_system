@extends('layouts.main', ['title' => 'DASHBOARD', 'active' => 'dashboard'])

@section('content')
    <div class="w-100 h-100 p-5">
        <div class="d-flex align-items-center mb-5">
            <a href="{{ route('admin.dashboard') }}">
                <h2 class="me-2" style="color: #A6DBD8; font-weight: 600;">Dashboard</h2>
            </a>
            <span style="color: #A6DBD8; font-size: 1.5rem;">/</span>
            <a href="{{ route('admin.dashboard.strand') }}">
                <h2 class="ms-2" style="color: #E9D819; font-weight: 600;">Student</h2>
            </a>
        </div>

        <div>
            <div class="container">
                <h4 class="container-fluid fw-bold" style="color: #189993">Grade Level</h4>

                <div class="container-fluid d-flex justify-content-between align-items-center">
                    <div 
                        class="container border fw-semibold rounded p-3 m-4 d-flex level justify-content-center align-items-center text-center"
                        style="cursor: pointer"
                        value="11"
                    >
                        Grade 11
                    </div>
                    <div 
                        class="container border fw-semibold rounded p-3 m-4 d-flex level justify-content-center align-items-center text-center"
                        style="cursor: pointer"
                        value="12"
                    >
                        Grade 12
                    </div>
                </div>
            </div>
        </div>

    </div>

    <input type="hidden" id="level" name="level" value="">

    <style>
        .level.selected {
            background-color: #189993;
            color: white;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const levels = document.querySelectorAll('.level');
            const levelInput = document.getElementById('level');

            levels.forEach(level => {
                if (level.getAttribute("value") === "11") {
                    level.classList.add('selected');
                    levelInput.value = "11";
                }
            });

            levels.forEach(level => {
                level.addEventListener('click', function () {
                    levels.forEach(lvl => lvl.classList.remove('selected'));
                    this.classList.add('selected');
                    levelInput.value = this.getAttribute("value");
                });
            });
        });
    </script>
@endsection