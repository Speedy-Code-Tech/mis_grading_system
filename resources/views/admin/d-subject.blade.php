@extends('layouts.main', ['title' => 'DASHBOARD', 'active' => 'dashboard'])

@section('content')
    <div class="w-100 h-100 p-5">
        <!-- Header Navigation -->
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route('admin.dashboard') }}">
                <h2 class="me-2" style="color: #A6DBD8; font-weight: 600;">Dashboard</h2>
            </a>
            <span style="color: #A6DBD8; font-size: 1.5rem;">/</span>
            <a href="{{ route('admin.dashboard.student') }}">
                <h2 class="ms-2" style="color: #EA3865; font-weight: 600;">Subject</h2>
            </a>
        </div>

        <!-- Main Content Selection -->
        <div class="bg-white p-4 shadow rounded">

            <!-- Grade Level Selection -->
            <div class="container mb-4">
                <h4 class="fw-bold" style="color: #189993">Grade Level</h4>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="level border fw-semibold rounded p-3 m-2 text-center flex-fill" style="cursor: pointer;" value="11">
                        Grade 11
                    </div>
                    <div class="level border fw-semibold rounded p-3 m-2 text-center flex-fill" style="cursor: pointer;" value="12">
                        Grade 12
                    </div>
                </div>
            </div>

            <!-- Strand Selection -->
            <div class="container mb-4">
                <h4 class="fw-bold" style="color: #189993">Strand</h4>
                <div class="strand border rounded p-3 m-2 d-flex align-items-center selected" value="ABM" style="cursor: pointer;">
                    <img src="{{ asset('img/abm.png') }}" alt="humss" class="me-3" style="width: 30px; height: 30px;">
                    <div>
                        <strong>ABM</strong><br>
                        <small>Accountancy, Business, and Management</small>
                    </div>
                </div>
                <div class="strand border rounded p-3 m-2 d-flex align-items-center" value="STEM" style="cursor: pointer;">
                    <img src="{{ asset('img/stem.png') }}" alt="humss" class="me-3" style="width: 30px; height: 30px;">
                    <div>
                        <strong>STEM</strong><br>
                        <small>Science, technology, engineering, and mathematics</small>
                    </div>
                </div>
                <div class="strand border rounded p-3 m-2 d-flex align-items-center" value="HUMSS" style="cursor: pointer;">
                    <img src="{{ asset('img/humss.png') }}" alt="humss" class="me-3" style="width: 30px; height: 30px;">
                    <div>
                        <strong>HUMSS</strong><br>
                        <small>Humanities and Social Sciences</small>
                    </div>
                </div>
                <div class="strand border rounded p-3 m-2 d-flex align-items-center" value="ICT" style="cursor: pointer;">
                    <img src="{{ asset('img/gas.png') }}" alt="humss" class="me-3" style="width: 30px; height: 30px;">
                    <div>
                        <strong>ICT</strong><br>
                        <small>Information and Communications Technology</small>
                    </div>
                </div>
                <div class="strand border rounded p-3 m-2 d-flex align-items-center" value="TVL" style="cursor: pointer;">
                    <img src="{{ asset('img/he.png') }}" alt="humss" class="me-3" style="width: 30px; height: 30px;">
                    <div>
                        <strong>TVL</strong><br>
                        <small>Technical Vocational Livelihood</small>
                    </div>
                </div>
            </div>
            
            <!-- Hidden Inputs -->
            <input type="hidden" id="level" name="level" value="">
            <input type="hidden" id="strand" name="strand" value="">
    
            <!-- Next Button -->
            <div class="d-flex justify-content-end">
                <a href="#" id="nextBtn" class="btn btn-teal px-5 py-2" style="background-color: #189993; color: white;">Next</a>
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        .level.selected,
        .strand.selected {
            background-color: #189993;
            color: white;
        }

        .strand.selected small {
            color: white;
        }

        .strand i {
            min-width: 2rem;
        }
    </style>

    <!-- Interaction Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const levels = document.querySelectorAll('.level');
            const strands = document.querySelectorAll('.strand');
            const levelInput = document.getElementById('level');
            const strandInput = document.getElementById('strand');
            const nextBtn = document.getElementById('nextBtn');

            // Grade Level default + selection
            levels.forEach(level => {
                if (level.getAttribute("value") === "11") {
                    level.classList.add('selected');
                    levelInput.value = "11";
                }

                level.addEventListener('click', function () {
                    levels.forEach(lvl => lvl.classList.remove('selected'));
                    this.classList.add('selected');
                    levelInput.value = this.getAttribute("value");
                    updateLink();
                });
            });

            // Strand selection
            strands.forEach(strand => {
                strand.addEventListener('click', function () {
                    strands.forEach(s => s.classList.remove('selected'));
                    this.classList.add('selected');
                    strandInput.value = this.getAttribute("value");
                    updateLink();
                });
            });

            // Dynamically update the Next button href
            function updateLink() {
                const level = levelInput.value;
                const strand = strandInput.value;

                if (level && strand) {
                    nextBtn.href = `/admin/dashboard/subject/${level}/${strand}`;
                } else {
                    nextBtn.href = "/admin/dashboard/subject/11/ABM";
                }
            }

            updateLink(); // initial call in case default values are set
        });
    </script>
@endsection