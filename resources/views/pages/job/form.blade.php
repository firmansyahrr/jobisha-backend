@extends('../layouts/side-menu')

@section('subhead')
    <title>{{ $pageTitle }}</title>
@endsection

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            {{ $pageTitle }}
        </h2>
    </div>

    <div class="intro-y box mt-5">
        <!-- BEGIN: Vertical Form -->
        <div class="intro-y box">
            <div id="vertical-form" class="p-5">
                @if ($action == 'create')
                        <form id="form-job" method="POST" action="{{ route('job.store') }}" class="max-w-4xl m-auto">
                    @else
                        <form id="form-job" method="POST" action="{{ route('job.update', ['id' => $job->id]) }}" class="max-w-4xl m-auto">
                            <input type="hidden" name="id" value="{{ $job->id }}" />
                @endif
                @csrf
                    <div class="preview">
                        <div class="@error('company_id') input-form has-error @enderror">
                            <label for="frm-company" class="form-label">Company</label>
                            <select class="tom-select w-full" name="company_id">
                                <option value=""></option>
                                @foreach ($companies as $data)
                                    <option value="{{ $data->id }}" @selected(old('company_id', isset($job) ? $job->company_id : '') == $data->id)>{{ $data->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('company_id')
                                <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="@error('title') input-form has-error @enderror mt-3">
                            <label for="frm-job-title" class="form-label">Job Title</label>
                            <input id="frm-job-title" name="title" type="text" class="form-control"
                                value="{{ old('title', isset($job) ? $job->title : '') }}">
                            @error('title')
                                <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="@error('job_type_id') input-form has-error @enderror mt-3">
                            <label for="frm-job_type" class="form-label">Job Type</label>
                            <select class="tom-select w-full" name="job_type_id">
                                <option value=""></option>
                                @foreach ($applicationParams as $data)
                                    @if ($data->type == 'job_types')
                                        <option value="{{ $data->id }}" @selected(old('job_type_id', isset($job) ? $job->job_type_id : '') == $data->id)> {{ $data->label }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('job_type_id')
                                <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="@error('year_of_experience') input-form has-error @enderror mt-3">
                            <label for="frm-year_of_experience" class="form-label">Experiences</label>
                            <select class="tom-select w-full" name="year_of_experience">
                                <option value="1" @selected(old('year_of_experience', isset($job) ? $job->year_of_experience : ''))==1)>1</option>
                                <option value="2" @selected(old('year_of_experience', isset($job) ? $job->year_of_experience : ''))==2)>2</option>
                                <option value="3" @selected(old('year_of_experience', isset($job) ? $job->year_of_experience : ''))==3)>3</option>
                                <option value="4" @selected(old('year_of_experience', isset($job) ? $job->year_of_experience : ''))==4)>4</option>
                                <option value="5" @selected(old('year_of_experience', isset($job) ? $job->year_of_experience : ''))==5)>5</option>
                            </select>
                            @error('year_of_experience')
                                <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="@error('career_level_id') input-form has-error @enderror mt-3">
                            <label for="frm-we-career-level-id" class="form-label">Career Level</label>
                            <select class="tom-select w-full" name="career_level_id">
                                <option value=""></option>
                                @foreach ($applicationParams as $data)
                                    @if ($data->type == 'career_levels')
                                        <option value="{{ $data->id }}" @selected(old('career_level_id', isset($job) ? $job->career_level_id : '') == $data->id)>{{ $data->label }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('career_level_id')
                                <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="@error('job_specialization_id') input-form has-error @enderror mt-3">
                            <label for="frm-we-job-specialization-id" class="form-label">Job Specialization</label>
                            <select class="tom-select w-full" name="job_specialization_id">
                                <option value=""></option>
                                @foreach ($jobSpecializations as $data)
                                    <option value="{{ $data->id }}" @selected(old('job_specialization_id', isset($job) ? $job->job_specialization_id : '') == $data->id)>{{ $data->label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('job_specialization_id')
                                <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="@error('job_role_id') input-form has-error @enderror mt-3">
                            <label for="frm-we-job-role-id" class="form-label">Job Role</label>
                            <select class="tom-select w-full" name="job_role_id">
                                <option value=""></option>
                                @foreach ($jobRoles as $data)
                                    <option value="{{ $data->id }}" @selected(old('job_role_id', isset($job) ? $job->job_role_id : '') == $data->id)>{{ $data->label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('job_role_id')
                                <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="@error('valid_until') input-form has-error @enderror mt-3">
                            <label for="frm-date-of-birth" class="form-label">Job Post Valid Until ?</label>
                            <div class="relative">
                                <div
                                    class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                    <i data-lucide="calendar" class="w-4 h-4"></i>
                                </div>
                                <input id="frm-date-of-birth" name="valid_until" type="text"
                                    class="datepicker form-control pl-12" data-single-mode="true"
                                    value="{{ old('valid_until', isset($job) ? $job->valid_until : '') }}">
                            </div>

                            @error('valid_until')
                                <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="@error('job_preferences') input-form has-error @enderror mt-3">
                            <label for="frm-date-of-birth" class="form-label">Job Preference</label>
                            <select data-placeholder="Select your favorite actors" class="tom-select w-full"
                                name="job_preferences[]" multiple>
                                @foreach ($applicationParams as $data)
                                    @if ($data->type == 'work_preferences')
                                        <option value="{{ $data->id }}" @selected( in_array($data->id, old('job_preferences', isset($job) ? collect($job->job_preferences)->pluck('id')->toArray(): [])))>{{ $data->label }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>

                            @error('job_preferences')
                                <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="@error('job_locations') input-form has-error @enderror mt-3">
                            <label for="frm-date-of-birth" class="form-label">Job Location</label>
                            <select data-placeholder="Select your favorite actors" class="tom-select w-full"
                                name="job_locations[]" multiple>
                                @foreach ($cities as $data)
                                    <option value="{{ $data->id }}" @selected(in_array($data->id, old('job_locations',isset($job) ? collect($job->job_locations)->pluck('id')->toArray(): [])))>{{ $data->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('job_locations')
                                <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="@error('job_description') input-form has-error @enderror mt-3">
                            <label for="frm-job-description" class="form-label">Job Description</label>

                            <div id="txtarea-job_description">
                                <div class="preview">
                                    <textarea class="editor" name="job_description">
                                        {!! old('job_description', isset($job) ? $job->job_description : '') !!}
                                    </textarea>
                                </div>
                            </div>

                            @error('job_description')
                                <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="@error('requirement') input-form has-error @enderror mt-3">
                            <label for="frm-requirement" class="form-label">Requirement</label>

                            <div id="txtarea-requirement">
                                <div class="preview">
                                    <textarea class="editor" name="requirement">
                                        {!! old('requirement', isset($job) ? $job->requirement : '') !!}
                                    </textarea>
                                </div>
                            </div>

                            @error('requirement')
                                <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- <div class="@error('responsibilities') input-form has-error @enderror mt-3">
                            <label for="frm-responsibilities" class="form-label">Responsibilities</label>

                            <div id="txtarea-responsibilities">
                                <div class="preview">
                                    <textarea class="editor" name="responsibilities">
                                        {!! old('responsibilities', isset($job) ? $job->responsibilities : '') !!}
                                    </textarea>
                                </div>
                            </div>

                            @error('responsibilities')
                                <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div> --}}

                        <div class="@error('benefit') input-form has-error @enderror mt-3">
                            <label for="frm-benefit" class="form-label">Benefit</label>

                            <div id="txtarea-benefit">
                                <div class="preview">
                                    <textarea class="editor" name="benefit">
                                        {!! old('benefit', isset($job) ? $job->benefit : '') !!}
                                    </textarea>
                                </div>
                            </div>
>
                            @error('benefit')
                                <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- <div class="@error('qualification') input-form has-error @enderror mt-3">
                            <label for="frm-qualification" class="form-label">Qualification</label>
                            
                            <div id="txtarea-qualification">
                                <div class="preview">
                                    <textarea class="editor" name="qualification">
                                        {!! old('qualification', isset($job) ? $job->qualification : '') !!}
                                    </textarea>
                                </div>
                            </div>

                            @error('qualification')
                                <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div> --}}

                        <button type="submit" class="btn btn-primary mt-5">Save</button>
                        &nbsp;&nbsp;
                        <a href="{{ route('candidate.index') }}" type="reset" class="btn btn-info mt-5">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- END: Vertical Form -->
    </div>
@endsection

@once
@push('scripts')

<script src="{{ asset('/dist/js/ckeditor-classic.js') }}"></script>

@endpush
@endonce