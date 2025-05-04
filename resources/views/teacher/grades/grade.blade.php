@extends('layouts.main',['title'=>'GRADES','active'=>'grades'])

@section('content')
    <div class="w-100 h-100 px-5 py-2">
        <div class="container mt-5">
            <h5 class="fw-bold">My Classes</h5>

            <!-- Filters -->
            <div class="row my-4 text-center fw-bold w-75">
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
            </div>

            <!-- Table Headers -->
            <table class="table align-middle" style="background-color: transparent;">
                <thead class="fw-bold border-bottom">
                    <tr>
                        <th class="bg-transparent">Subject</th>
                        <th class="bg-transparent">Academic Track</th>
                        <th class="bg-transparent">Grade Level</th>
                        <th class="bg-transparent">Section <span>&#9662;</span></th>
                        <th class="bg-transparent">Students</th>
                        <th class="bg-transparent">School Year</th>
                        <th class="bg-transparent text-end"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="bg-transparent">Physical Science</td>
                        <td class="bg-transparent">GAS</td>
                        <td class="bg-transparent">11</td>
                        <td class="bg-transparent">Confidence</td>
                        <td class="bg-transparent">36</td>
                        <td class="bg-transparent">2024-2025</td>
                        <td class="bg-transparent">
                            <button class="btn btn-sm rounded-pill w-100" style="background-color: #189993; color: white;">Enter Grades</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-transparent">General Mathematics</td>
                        <td class="bg-transparent">GAS</td>
                        <td class="bg-transparent">11</td>
                        <td class="bg-transparent">Confidence</td>
                        <td class="bg-transparent">36</td>
                        <td class="bg-transparent">2024-2025</td>
                        <td class="bg-transparent">
                            <button class="btn btn-sm rounded-pill w-100" style="background-color: #189993; color: white;">Enter Grades</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
@endsection