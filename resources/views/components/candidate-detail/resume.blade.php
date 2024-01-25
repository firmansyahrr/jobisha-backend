
<div id="modal-form-resume" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div id="vertical-form" class="p-5">
                <form method="POST" action="{{ route('candidate.store') }}" class="max-w-4xl m-auto">
                    @csrf
                    <input type="hidden" id="frm-skl-id" name="id" />
                    <div class="preview">
                        <div class="@error('resume') input-form has-error @enderror">
                            <label for="frm-rsm-resume" class="form-label">Resume</label>
                            <input id="frm-rsm-resume" name="resume" type="text" class="form-control"
                                value="{{ old('resume') }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>