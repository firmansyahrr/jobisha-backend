@props(['candidate', 'applicationParams'])

<div id="modal-form-education" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div id="vertical-form" class="p-5">
                <form method="POST" action="{{ route('candidate.update.education', ['id' => $candidate->id]) }}"
                    class="max-w-4xl m-auto">
                    @csrf
                    <input type="hidden" id="frm-edu-id" name="id" />
                    <div class="preview">
                        <div class="@error('name') input-form has-error @enderror">
                            <label for="frm-edu-name" class="form-label">Name</label>
                            <input id="frm-edu-name" name="name" type="text" class="form-control"
                                value="{{ old('name') }}">
                            @error('name')
                            <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="@error('education_level_id') input-form has-error @enderror mt-3">
                            <label for="frm-edu-education-level-id" class="form-label">Education Level</label>
                            <select class="tom-select w-full" name="education_level_id">
                                <option value=""></option>
                                @foreach($applicationParams as $data)
                                @if($data->type == 'education_levels')
                                <option value="{{ $data->id }}" @selected( old('education_level_id')==$data->id)>{{
                                    $data->label }}</option>
                                @endif
                                @endforeach
                            </select>
                            @error('education_level_id')
                            <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="@error('graduation_date') input-form has-error @enderror mt-3">
                            <label for="frm-edu-graduation-date" class="form-label">Graduation Date</label>
                            <div class="relative">
                                <div
                                    class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                    <i data-lucide="calendar" class="w-4 h-4"></i>
                                </div>
                                <input id="frm-edu-graduation-date" name="graduation_date" type="text"
                                    class="datepicker-yearmonth form-control pl-12" data-single-mode="true"
                                    value="{{ old('graduation_date') }}">
                            </div>
                            @error('graduation_date')
                            <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="@error('is_till_current') form-check has-error @enderror mt-3 form-check">
                            <input id="frm-edu-till-current" class="form-check-input" name="is_till_current"
                                type="checkbox" value="true">
                            <label class="form-check-label" for="frm-edu-till-current">Is Still Current ?</label>
                            @error('is_till_current')
                            <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="@error('description') input-form has-error @enderror mt-3">
                            <label for="frm-edu-description" class="form-label">Job Description</label>
                            <textarea id="frm-edu-description" class="form-control"
                                name="description">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mt-5">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>