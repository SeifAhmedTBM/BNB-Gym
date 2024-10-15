@extends('layouts.admin')
@section('content')
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

</style>
    <div class="card">
        <div class="card-header">
            <h5>Edit Task</h5>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.tasks.update',$task->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="required" for="title">Title</label>
                            <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text"
                                name="title" id="title" value="{{ old('title', $task->title) }}" required>

                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="required" for="desct">Description</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control"
                                placeholder="Enter Description .. " required>{{ $task->description }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-6">
                        <label class="required" for="task_date">Task Date</label>
                        <input type="date" name="task_date" id="task_date" class="form-control"
                            value="{{ $task->task_date }}" required>
                    </div>

                    <div class="col-6">
                        <label class="required" for="supervisor_id">Supervisor</label>
                        <select name="supervisor_id" id="supervisor_id" class="form-control select2" required>
                            <option value="{{ NULL }}">{{ trans('global.pleaseSelect') }}</option>
                            @foreach (App\Models\User::whereHas('employee')->pluck('name','id') as $supervisor_id => $supervisor_name)
                                <option value="{{ $supervisor_id }}" {{ $task->supervisor_id == $supervisor_id ? 'selected' : '' }}>{{ $supervisor_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="row">
                        <div class="col-12 mt-5">
                            To User <label class="switch"> <input type="checkbox"><span class="slider round "></span></label>To
                            Role
                            <br><br>
    
                            <div class="user">
                                <div class="col-6">
                                    <label class="required" for="to_user_id">To User</label>
                                    <select name="to_user_id" id="to_user_id" class="form-control select2">
                                        <option value="{{ NULL }}">Please Select User</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ $user->id == $task->to_user_id ? 'selected' : '' }}>
                                                {{ $user->name . ' - ' . $user->roles[0]->title . ' - ' . ($user->employee->branch->name ?? 'Dont Have Branch') }}
                                            </option>
                                        @endforeach
                                    </select>
    
                                </div>
                            </div>
    
                            <div class="role " style="display: none">
                                <div class="col-6">
                                    <label class="required" for="to_role_id">To Role</label>
                                    <select name="to_role_id" id="to_role_id" class="form-control select2">
                                        @foreach ($roles as $key => $value)
                                            <option value="{{ $key }}"> {{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                

                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
