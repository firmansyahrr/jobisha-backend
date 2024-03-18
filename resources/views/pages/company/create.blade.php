@extends('../layouts/side-menu')

@section('subhead')
<title>{{ $pageTitle }}</title>
@endsection

@section('subcontent')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        New Company
    </h2>
</div>

<div class="intro-y box mt-5">
    <!-- BEGIN: Vertical Form -->
    <div class="intro-y box">
        <div id="vertical-form" class="p-5">
            <form method="POST" action="{{ route('company.store') }}" class="max-w-4xl m-auto" enctype="multipart/form-data">
                @csrf
                <div class="preview">                    
                    <div class=" @error('photo') input-form has-error @enderror">
                        <label for="frm-photo" class="form-label">Photo</label>
                        <div class="fallback"> <input name="photo" type="file" /> </div>
                        @error('photo')
                        <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="@error('name') input-form has-error @enderror mt-3">
                        <label for="frm-name" class="form-label">Name</label>
                        <input id="frm-job-title" name="name" type="text" class="form-control" value="{{ old('name') }}">
                        @error('name')
                        <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="@error('email') input-form has-error @enderror mt-3">
                        <label for="frm-email" class="form-label">Email</label>
                        <input id="frm-email" name="email" type="email" class="form-control" value="{{ old('email') }}">
                        @error('email')
                        <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="@error('website') input-form has-error @enderror mt-3">
                        <label for="frm-website" class="form-label">Website</label>
                        <input id="frm-website" name="website" type="text" class="form-control" value="{{ old('website') }}">
                        @error('website')
                        <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="@error('since_year') input-form has-error @enderror mt-3">
                        <label for="frm-since_year" class="form-label">Since Year</label>
                        <input id="frm-since_year" name="since_year" type="text" class="form-control" value="{{ old('since_year') }}">
                        @error('since_year')
                        <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="@error('description') input-form has-error @enderror mt-3">
                        <label for="frm-description" class="form-label">Description</label>
                        <textarea rows="4" id="frm-description" class="form-control" name="description">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="@error('phone_number') input-form has-error @enderror mt-3">
                        <label for="frm-phone_number" class="form-label">Phone Number</label>
                        <input id="frm-phone_number" name="phone_number" type="text" class="form-control" value="{{ old('phone_number') }}">
                        @error('phone_number')
                        <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="frm-province" class="form-label">Province</label>
                        <select class="tom-select w-full" name="province_id">
                            <option value=""></option>
                            @foreach($provinces as $data)
                            <option value="{{ $data->id }}" @selected( old('province_id', (isset($candidate)) ? $candidate->province_id : '')==$data->id)>{{ $data->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('province_id')
                        <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="frm-city" class="form-label">City</label>
                        <select class="tom-select w-full" name="city_id">
                            <option value=""></option>
                            @foreach($cities as $data)
                            <option value="{{ $data->id }}" @selected( old('city_id', (isset($candidate)) ? $candidate->city_id : '')==$data->id)>{{ $data->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('city_id')
                        <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="@error('address') input-form has-error @enderror mt-3">
                        <label for="frm-address" class="form-label">Address</label>
                        <textarea rows="2" id="frm-address" class="form-control" name="address">{{ old('address') }}</textarea>
                        @error('address')
                        <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="@error('zip_code') input-form has-error @enderror mt-3">
                        <label for="frm-zip_code" class="form-label">Zip Code</label>
                        <input id="frm-zip_code" name="zip_code" type="text" class="form-control" value="{{ old('zip_code') }}">
                        @error('zip_code')
                        <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="@error('employee_size_id') input-form has-error @enderror mt-3">
                        <label for="frm-we-career-level-id" class="form-label">Employee Size</label>
                        <select class="tom-select w-full" name="employee_size_id">
                            <option value=""></option>
                            @foreach($applicationParams as $data)
                            @if($data->type == 'employee_sizes')
                            <option value="{{ $data->id }}" @selected( old('employee_size_id')==$data->id)>{{
                                $data->label }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('employee_size_id')
                        <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="@error('company_industry_id') input-form has-error @enderror mt-3">
                        <label for="frm-we-career-level-id" class="form-label">Company Industry</label>
                        <select class="tom-select w-full" name="company_industry_id">
                            <option value=""></option>
                            @foreach($applicationParams as $data)
                            @if($data->type == 'company_industries')
                            <option value="{{ $data->id }}" @selected( old('company_industry_id')==$data->id)>{{
                                $data->label }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('company_industry_id')
                        <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

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