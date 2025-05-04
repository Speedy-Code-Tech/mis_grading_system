@extends('layouts.main',['title'=>'MY CLASSES','active'=>'my_classes'])

@section('content')
    <div class="w-100 h-100 px-5 py-2">
        <!-- <h2 class="mb-3">DASHBOARD</h2> -->

        <div class="container my-4">
            <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                    <div class="d-flex flex-column gap-1">
                        <p class="mb-1 text-uppercase" style="font-size: .8rem;"><strong class="me-2">TEACHER:</strong> {{ $faculty_info->fname }} {{ $faculty_info->lname }}</p>
                        <p class="mb-1 text-uppercase" style="font-size: .8rem;"><strong class="me-2">ACADEMIC TRACK:</strong> GENERAL ACADEMIC STRAND</p>
                        <p class="mb-1 text-uppercase" style="font-size: .8rem;"><strong class="me-2">GRADE & SECTION:</strong> GRADE 11 - CONFIDENCE</p>
                        <p class="mb-1 text-uppercase" style="font-size: .8rem;"><strong class="me-2">SUBJECT:</strong> PHYSICAL SCIENCE</p>
                        <p class="mb-1 text-uppercase" style="font-size: .8rem;"><strong class="me-2">REGION:</strong> V</p>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                    <div class="d-flex flex-column gap-1">
                        <p class="mb-1 text-uppercase" style="font-size: .8rem;"><strong class="me-2">SCHOOL YEAR:</strong> 2024-2025</p>
                        <p class="mb-1 text-uppercase" style="font-size: .8rem;"><strong class="me-2">SCHOOL NAME:</strong> MORENO INTEGRATED SCHOOL</p>
                        <p class="mb-1 text-uppercase" style="font-size: .8rem;"><strong class="me-2">SEMESTER:</strong> 1ST SEMESTER <span>&#9662;</span></p>
                        <p class="mb-1 text-uppercase" style="font-size: .8rem;"><strong class="me-2">QUARTER:</strong> 1ST QUARTER <span>&#9662;</span></p>
                        <p class="mb-1 text-uppercase" style="font-size: .8rem;"><strong class="me-2">DIVISION:</strong> CAMARINES NORTE</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="d-flex gap-4 my-4 text-center fw-bold w-100">
            <div class="">
                <label for="written" class="form-0 mb-0">Written Works</label>
                <select id="written" class="form-select form-select-sm rounded-pill bg-transparent border-success">
                    <option selected>20%</option>
                    <option>30%</option>
                    <option>50%</option>
                </select>
            </div>
            <div class="">
                <label for="performance" class="form-label mb-0">Performance Task</label>
                <select id="performance" class="form-select form-select-sm rounded-pill bg-transparent border-success">
                    <option>20%</option>
                    <option selected>30%</option>
                    <option>50%</option>
                </select>
            </div>
            <div class="">
                <label for="exam" class="form-label mb-0">Exam</label>
                <select id="exam" class="form-select form-select-sm rounded-pill bg-transparent border-success">
                    <option>20%</option>
                    <option>30%</option>
                    <option selected>50%</option>
                </select>
            </div>
        </div>


        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="fw-bold border-bottom">
                    <tr>
                        <th></th>
                        <th>Students Name</th>
                        <th>Written Work</th>
                        <th>Performance Task</th>
                        <th>Exam</th>
                        <th>Grades</th>
                        <th>Remarks</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <th>No.</th>
                        <th>Male</th>
                        <th colspan="3"></th>
                        <th>Quarterly</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td style="background-color: #f8fafc;">1</td>
                        <td style="background-color: #f8fafc;">Joshi Angelo Adlawan</td>
                        <td style="background-color: #f8fafc;">
                            <input 
                                type="number"
                                class="text-center" 
                                style="border: none; outline: none; width: 100%; height: 100%; padding: 0; margin: 0; background-color: transparent;"
                            >
                        </td>
                        <td style="background-color: #f8fafc;">
                            <input 
                                type="number"
                                class="text-center" 
                                style="border: none; outline: none; width: 100%; height: 100%; padding: 0; margin: 0; background-color: transparent;"
                            >
                        </td>
                        <td style="background-color: #f8fafc;">
                            <input 
                                type="number"
                                class="text-center" 
                                style="border: none; outline: none; width: 100%; height: 100%; padding: 0; margin: 0; background-color: transparent;"
                            >
                        </td>
                        <td style="background-color: #f8fafc;">98</td>
                        <td style="background-color: #f8fafc;">
                            <input 
                                type="text" 
                                placeholder="remarks..."
                                class="text-center"
                                style="border: none; outline: none; width: 100%; height: 100%; padding: 0; margin: 0; background-color: transparent;"
                            >
                        </td>
                    </tr>
                    <tr>
                        <th>No.</th>
                        <th>Female</th>
                        <th colspan="3"></th>
                        <th>Quarterly</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td style="background-color: #f8fafc;">1</td>
                        <td style="background-color: #f8fafc;">Lyle Xavier</td>
                        <td style="background-color: #f8fafc;">20</td>
                        <td style="background-color: #f8fafc;">30</td>
                        <td style="background-color: #f8fafc;">60</td>
                        <td style="background-color: #f8fafc;">98</td>
                        <td style="background-color: #f8fafc;">Secret</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between mt-3">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Back</a>
            <div class="d-flex gap-2">
                <button type="reset" class="btn btn-outline-secondary">Discard</button>
                <button type="submit" class="btn btn-info text-white">Save</button>
            </div>
        </div>
    </div>
@endsection