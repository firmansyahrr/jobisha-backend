@extends('../layouts/side-menu')

@section('subhead')
<title>{{ $pageTitle }}</title>
@endsection

@section('subcontent')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Edit Candidate
    </h2>
</div>

<div class="intro-y box mt-5">
    <!-- BEGIN: Vertical Form -->
    <div class="intro-y box">
        <div id="vertical-form" class="p-5">
            <form method="POST" action="{{ route('candidate.update', ['id' => $candidate->id]) }}" class="max-w-4xl m-auto"
                enctype="multipart/form-data">
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
                        <input id="frm-name" name="name" type="text" class="form-control"
                            value="{{ old('name', (isset($candidate)) ? $candidate->name : '') }}">
                        @error('name')
                        <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="@error('email') input-form has-error @enderror mt-3">
                        <label for="frm-email" class="form-label">Email</label>
                        <input id="frm-email" disabled type="email" class="form-control"
                            value="{{ old('email', (isset($candidate)) ? $candidate->email : '') }}">
                        @error('email')
                        <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="@error('phone_number') input-form has-error @enderror mt-3">
                        <label for="frm-phone-number" class="form-label">Phone Number</label>
                        <input id="frm-phone-number" name="phone_number" type="text" class="form-control"
                            value="{{ old('phone_number', (isset($candidate)) ? $candidate->phone_number : '') }}">
                        @error('phone_number')
                        <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="@error('place_of_birth') input-form has-error @enderror mt-3">
                        <label for="frm-place-of-birth" class="form-label">Place of Birth</label>
                        <input id="frm-place-of-birth" name="place_of_birth" type="text" class="form-control"
                            value="{{ old('place_of_birth', (isset($candidate)) ? $candidate->place_of_birth : '') }}">
                        @error('place_of_birth')
                        <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="@error('birthday') input-form has-error @enderror mt-3">
                        <label for="frm-date-of-birth" class="form-label">Date of Birth</label>
                        <div class="relative">
                            <div
                                class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                <i data-lucide="calendar" class="w-4 h-4"></i>
                            </div>
                            <input id="frm-date-of-birth" name="birthday" type="text"
                                class="datepicker form-control pl-12" data-single-mode="true"
                                value="{{ old('birthday', (isset($candidate)) ? $candidate->birthday : '') }}">
                        </div>

                        @error('birthday')
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

                    <div class="mt-3">
                        <label for="frm-gender" class="form-label">Gender</label>
                        <select class="tom-select w-full" name="gender_id">
                            <option value=""></option>
                            @foreach($genders as $data)
                            <option value="{{ $data->id }}" @selected( old('gender_id', (isset($candidate)) ? $candidate->gender_id : '')==$data->id)>{{ $data->label }}
                            </option>
                            @endforeach
                        </select>
                        @error('gender_id')
                        <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="frm-address" class="form-label">Address</label>
                        <textarea rows="4" id="frm-address" class="form-control"
                            name="address">{{ old('address', (isset($candidate)) ? $candidate->address : '') }}</textarea>
                        @error('address')
                        <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="frm-about-me" class="form-label">About Me</label>
                        <textarea rows="4" id="frm-about-me" class="form-control"
                            name="about_me">{{ old('about_me', (isset($candidate)) ? $candidate->about_me : '') }}</textarea>
                        @error('about_me')
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