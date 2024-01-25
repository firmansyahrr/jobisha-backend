<div id="modal-form-skill" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div id="vertical-form" class="p-5">
                <form method="POST" action="{{ route('candidate.store') }}" class="max-w-4xl m-auto">
                    @csrf
                    <input type="hidden" id="frm-skl-id" name="id" />
                    <div class="preview">
                        <div class="@error('skill') input-form has-error @enderror">
                            <label for="frm-skl-skill" class="form-label">Skill</label>
                            <input id="frm-skl-skill" name="skill" type="text" class="form-control"
                                value="{{ old('skill') }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>