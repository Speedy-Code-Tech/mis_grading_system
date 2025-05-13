@extends('layouts.main',['title'=>'MY CLASSES','active'=>'my_classes'])

@section('content')
    <div class="w-100 h-100 px-5 py-2">
        <div class="container mt-5">
            <h5 class="fw-bold mb-4">My Classes</h5>

            <!-- Filters -->
            <!-- <div class="row my-4 text-center fw-bold w-75">
                <div class="col">
                    <label for="schoolYear" class="form-label d-block">School Year</label>
                    <select id="schoolYear" class="form-select form-select-sm text-center rounded-pill bg-transparent border-success" style="border-color: #189993;">
                        <option selected>2025-2026</option>
                        <option>2024-2025</option>
                        <option>2023-2024</option>
                    </select>
                </div>
                <div class="col">
                    <label for="semester" class="form-label d-block">Semester</label>
                    <select id="semester" class="form-select form-select-sm text-center rounded-pill bg-transparent border-success" style="border-color: #189993;">
                        <option selected>1st</option>
                        <option>2nd</option>
                    </select>
                </div>
                <div class="col">
                    <label for="track" class="form-label d-block">Track</label>
                    <select id="track" class="form-select form-select-sm text-center rounded-pill bg-transparent border-success" style="border-color: #189993;">
                        <option selected>STEM</option>
                        <option>GAS</option>
                        <option>HUMSS</option>
                    </select>
                </div>
                <div class="col">
                    <label for="gradeLevel" class="form-label d-block">Grade Level</label>
                    <select id="gradeLevel" class="form-select form-select-sm text-center rounded-pill bg-transparent border-success" style="border-color: #189993;">
                        <option selected>11</option>
                        <option>12</option>
                    </select>
                </div>
            </div> -->

            <div class="bg-white p-4 shadow rounded">
                <!-- Table Headers -->
                <table id="assignedSubjectsTable" class="table align-middle" style="background-color: transparent;">
                    <thead class="fw-bold border-bottom">
                        <tr>
                            <th class="bg-transparent">Section</th>
                            <th class="bg-transparent">Subject</th>
                            <th class="bg-transparent">Academic Track</th>
                            <th class="bg-transparent">Grade Level</th>
                            <th class="bg-transparent">Students</th>
                            <th class="bg-transparent">Quarter</th>
                            <th class="bg-transparent text-end"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($subject_teacher as $subject)
                        <tr>
                            <td class="bg-transparent">{{ $subject->section->name }}</td>
                            <td class="bg-transparent">{{ $subject->subject->name }}</td>
                            <td class="bg-transparent">{{ $subject->department ? $subject->department->course_code : 'N/A' }}</td>
                            <td class="bg-transparent">{{ $subject->subject->level }}</td>
                            <td class="bg-transparent">
                                {{ $subject->section->students()->count() }}
                            </td>
                            <td class="bg-transparent">
                                {{ $subject->quarter->name }}
                            </td>
                            <td class="bg-transparent">
                                <a href="{{ route('teacher.grade.view', $subject->uuid) }}" class="btn btn-sm rounded-pill w-100" style="background-color: #189993; color: white;">Enter Grades</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>


    <script>
        $(document).ready(function () {
            $('#assignedSubjectsTable').DataTable({
                responsive: true,
                paging: true,
                pageLength: 5,
                lengthMenu: [5, 10, 25],
                searching: true,
                ordering: true,
                columnDefs: [
                    { orderable: false, targets: 6 },
                ],
                language: {
                    search: "Search Records:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No records available",
                    zeroRecords: "No matching records found",
                    paginate: {
                        previous: "Previous",
                        next: "Next"
                    }
                }
            });
        });
    </script>
@endsection