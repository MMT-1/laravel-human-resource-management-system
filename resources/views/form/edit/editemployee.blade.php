
@extends('layouts.master')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Employee View</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Employee View Edit</li>
                        </ul>
                    </div>
                </div>
            </div>
			<!-- /Page Header -->
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Employee edit</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('all/employee/update') }}" method="POST">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ $employees[0]->id }}">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Full Name</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $employees[0]->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Email</label>
                                    <div class="col-md-10">
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $employees[0]->email }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Birth Date</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control datetimepicker" id="birth_date" name="birth_date" value="{{ $employees[0]->birth_date }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Gender</label>
                                    <div class="col-md-10">
                                        <select class="select form-control" id="gender" name="gender">
                                            <option value="{{ $employees[0]->gender }}" {{ ( $employees[0]->gender == $employees[0]->gender) ? 'selected' : '' }}>{{ $employees[0]->gender }} </option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Employee ID</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="employee_id" name="employee_id" value="{{ $employees[0]->employee_id }}" readonly>
                                    </div>
                                </div>
                               

                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Employee Permission</label>
                                    <div class="col-md-10">
                                        <div class="table-responsive m-t-15">
                                            <table class="table table-striped custom-table">
                                                <thead>
                                                    <tr>
                                                        <th>Module Permission</th>
                                                        <th class="text-center">Read</th>
                                                        <th class="text-center">Write</th>
                                                        <th class="text-center">Create</th>
                                                        <th class="text-center">Delete</th>
                                                        <th class="text-center">Import</th>
                                                        <th class="text-center">Export</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $key = 0;
                                                    $key1 = 0;
                                                    ?>
                                                    @foreach ($permission as $items )
                                                    <tr>
                                                        <td>{{ $items->module_permission }}</td>
                                                        <input type="hidden" name="permission[]" value="{{ $items->module_permission }}">
                                                        <input type="hidden" name="id_permission[]" value="{{ $items->id }}">
                                                        <td class="text-center">
                                                            <input type="checkbox" class="read{{ ++$key }}" id="read" name="read[]" value="Y"{{ $items->read =="Y" ? 'checked' : ''}} >
                                                            <input type="checkbox" class="read{{ ++$key1 }}" id="read" name="read[]" value="N" {{ $items->read =="N" ? 'checked' : ''}}>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="checkbox" class="write{{ ++$key }}" id="write" name="write[]" value="Y" {{ $items->write =="Y" ? 'checked' : ''}}>
                                                            <input type="checkbox" class="write{{ ++$key1 }}" id="write" name="write[]" value="N" {{ $items->write =="N" ? 'checked' : ''}}>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="checkbox" class="create{{ ++$key }}" id="create" name="create[]" value="Y" {{ $items->create =="Y" ? 'checked' : ''}}>
                                                            <input type="checkbox" class="create{{ ++$key1 }}" id="create" name="create[]" value="N" {{ $items->create =="N" ? 'checked' : ''}}>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="checkbox" class="delete{{ ++$key }}" id="delete" name="delete[]" value="Y" {{ $items->delete =="Y" ? 'checked' : ''}}>
                                                            <input type="checkbox" class="delete{{ ++$key1 }}" id="delete" name="delete[]" value="N" {{ $items->delete =="N" ? 'checked' : ''}}>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="checkbox" class="import{{ ++$key }}" id="import" name="import[]" value="Y" {{ $items->import =="Y" ? 'checked' : ''}}>
                                                            <input type="checkbox" class="import{{ ++$key1 }}" id="import" name="import[]" value="N" {{ $items->import =="N" ? 'checked' : ''}}>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="checkbox" class="export{{ ++$key }}" id="export" name="export[]" value="Y" {{ $items->export =="Y" ? 'checked' : ''}}>
                                                            <input type="checkbox" class="export{{ ++$key1 }}" id="export" name="export[]" value="N" {{ $items->export =="N" ? 'checked' : ''}}>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2"></label>
                                    <div class="col-md-10">
                                        <button type="submit" class="btn btn-primary submit-btn">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
        
    </div>
    <!-- /Page Wrapper -->
    @section('script')
    <script>
        $("input:checkbox").on('click', function()
        {
            var $box = $(this);
            if ($box.is(":checked"))
            {
                var group = "input:checkbox[class='" + $box.attr("class") + "']";
                $(group).prop("checked", false);
                $box.prop("checked", true);
            }
            else
            {
                $box.prop("checked", false);
            }
        });
    </script>
    @endsection

@endsection
