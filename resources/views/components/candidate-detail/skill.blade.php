@props(['candidate', 'applicationParams'])

<div id="modal-form-skill" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div id="vertical-form" class="p-5">
                <form method="POST" action="{{ route('candidate.update.skill', ['id' => $candidate->id]) }}"
                    class="max-w-4xl m-auto">
                    @csrf
                    <input type="hidden" id="frm-skl-id" name="id" />
                    <div class="preview">
                        <div class="@error('skill') input-form has-error @enderror">
                            <label for="frm-edu-skill" class="form-label">Skill</label>
                            <input id="frm-edu-skill" name="skill" type="text" class="form-control"
                                value="{{ old('skill') }}">
                            @error('skill')
                            <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="@error('skill_level_id') input-form has-error @enderror mt-3">
                            <label for="frm-skl-skill-level-id" class="form-label">Skill Level</label>
                            <select class="tom-select w-full" name="skill_level_id">
                                <option value=""></option>
                                @foreach($applicationParams as $data)
                                @if($data->type == 'skill_levels')
                                <option value="{{ $data->id }}" @selected( old('skill_level_id')==$data->id)>{{
                                    $data->label }}</option>
                                @endif
                                @endforeach
                            </select>
                            @error('skill_level_id')
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