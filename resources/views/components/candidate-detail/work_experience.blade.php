<div id="modal-form-work-experience" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div id="vertical-form" class="p-5">
                <form method="POST" action="{{ route('candidate.store') }}" class="max-w-4xl m-auto">
                @csrf
                    <input type="hidden" id="frm-we-id" name="id" />
                    <div class="preview">
                        <div class="@error('company_name') input-form has-error @enderror">
                            <label for="frm-we-company-name" class="form-label">Company Name</label>
                            <input id="frm-we-company-name" name="company_name" type="text" class="form-control"
                                value="{{ old('company_name') }}">
                        </div>

                        <div class="@error('job_title') input-form has-error @enderror mt-3">
                            <label for="frm-we-job-title" class="form-label">Job Title</label>
                            <input id="frm-we-job-title" name="job_title" type="text" class="form-control"
                                value="{{ old('job_title') }}">
                        </div>

                        <div class="@error('description') input-form has-error @enderror mt-3">
                            <label for="frm-we-description" class="form-label">Job Description</label>
                            <textarea id="frm-we-description" class="form-control" name="description">{{ old('description') }}</textarea>
                        </div>
 
                        <div class="@error('salary_range_id') input-form has-error @enderror mt-3">
                            <label for="frm-we-salary-range-id" class="form-label">Salary Range</label>
                            <select class="tom-select w-full" name="salary_range_id">
                                <option value=""></option>
                            </select>
                        </div>
                  
                        <div class="@error('job_type_id') input-form has-error @enderror mt-3">
                            <label for="frm-we-job-type-id" class="form-label">Job Type</label>
                            <select class="tom-select w-full" name="job_type_id">
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="@error('career_level_id') input-form has-error @enderror mt-3">
                            <label for="frm-we-career-level-id" class="form-label">Career Level</label>
                            <select class="tom-select w-full" name="career_level_id">
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="@error('job_role_id') input-form has-error @enderror mt-3">
                            <label for="frm-we-job-role-id" class="form-label">Job Role</label>
                            <select class="tom-select w-full" name="job_role_id">
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="@error('job_specialization_id') input-form has-error @enderror mt-3">
                            <label for="frm-we-job-specialization-id" class="form-label">Job Specialization</label>
                            <select class="tom-select w-full" name="job_specialization_id">
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="@error('start_of_work') input-form has-error @enderror mt-3">
                            <label for="frm-we-start-of-work" class="form-label">Start of Work</label>
                            <input id="frm-we-start-of-work" name="start_of_work" type="text" class="form-control"
                                value="{{ old('start_of_work') }}">
                        </div>

                        <div class="@error('is_till_current') input-form has-error @enderror mt-3">
                            <label for="frm-we-till-current" class="form-label">Is Still Current ?</label>
                            <input id="frm-we-till-current" name="is_till_current" type="text" class="form-control"
                                value="{{ old('is_till_current') }}">
                        </div>

                        <div class="@error('end_of_work') input-form has-error @enderror mt-3">
                            <label for="frm-we-end-of-work" class="form-label">End of Work</label>
                            <input id="frm-we-end-of-work" name="end_of_work" type="text" class="form-control"
                                value="{{ old('end_of_work') }}">
                        </div>

                        <button type="submit" class="btn btn-primary mt-5">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>