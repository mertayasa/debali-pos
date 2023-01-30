<div class="row">
    @if ($fieldTitle != null)
        {!! Form::label($fieldName, $fieldTitle, ['class' => 'mb-1 fw-bold col-form-label '.$labelClass] + $labelAttribute, false) !!}
    @endif
    <div class="@if($formColWidth != '') {{ $formColWidth }} @else {{ 'col-12' }} @endif">
        {!! $hint !!}

        @if ($fieldType == 'email')
            {!! Form::email($fieldName, $defaultValue, ['class' => 'form-control rounded '.$inputClass, 'id' => $fieldName] + $inputAttribute) !!}
        @endif

        @if ($fieldType == 'text')
            {!! Form::text($fieldName, $defaultValue, ['class' => 'form-control rounded '.$inputClass, 'id' => $fieldName] + $inputAttribute) !!}
        @endif

        @if ($fieldType == 'number')
            {!! Form::number($fieldName, $defaultValue, ['class' => 'form-control rounded '.$inputClass, 'id' => $fieldName] + $inputAttribute) !!}
        @endif

        @if ($fieldType == 'password')
            {!! Form::password($fieldName, ['class' => 'form-control rounded '.$inputClass, 'id' => $fieldName] + $inputAttribute) !!}
        @endif

        @if ($fieldType == 'textarea')
            {!! Form::textarea($fieldName, $defaultValue, ['class' => 'form-control rounded '.$inputClass, 'id' => $fieldName] + $inputAttribute) !!}
        @endif

        @if ($fieldType == 'file')
            <div class="input-group">
                {!! Form::file($fieldName, ['class' => 'form-control rounded '.$inputClass, 'id' => $fieldName] + $inputAttribute) !!}
                <div class="input-group-prepend mb-3">
                    <button class="input-group-text btn-danger" id="clearUpload" type="button" onclick="clearFileUpload(`{{ $fieldName }}`)">Clear</button>
                </div>
            </div>
        @endif

        @if ($fieldType == 'select')
            {!! Form::select($fieldName, $optionList, $defaultValue, ['class' => 'form-control rounded '.$inputClass, 'id' => $fieldName] + $inputAttribute) !!}
        @endif
    </div>
</div>

@push('scripts')
    <script>
        function validateFileInput(event) {
            if (event.target.files.length > 0) {
                // Validate Size
                const fileSize = Math.round((event.target.files[0].size / 1024))
                if (fileSize >= 10240) {
                    event.target.value = ''
                    return showSwalAlert('error', 'File too big, please select a file less than 10MB')
                }

                // Validate extension
                const fileName = event.target.files[0].name
                const extension = fileName.substr(fileName.lastIndexOf("."))
                const allowedExtensionsRegx = /(\.jpg|\.jpeg|\.png|\.gif|\.svg|\.zip|\.doc|\.csv|\.xlsx|\.docx|\.txt|\.pdf)$/i;
                const isAllowed = allowedExtensionsRegx.test(extension)
                if(!isAllowed){
                    event.target.value = ''
                    return showSwalAlert('error', 'Invalid file type, please upload .png .svg .jpg .jpeg .gif .zip .docx .csv .xlsx .docx .txt .pdf file')
                }
            }
        }

        function clearFileUpload(inputId){
            document.getElementById(inputId).value = ''
        }
    </script>
@endpush