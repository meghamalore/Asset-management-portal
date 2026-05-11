@if(session()->has('success_msg'))
<div class="alert alert-primary fade-message">
    <span><b>{{ session()->get('success_msg')}}</b></span>
</div>
@endif
<!-- error msg code -->
@if(session()->has('error_msg'))
<div class="alert alert-danger fade-message">
    <span><b>{{ session()->get('error_msg')}}</b></span>
</div>
@endif

@if(session()->has('import_errors'))

<div class="card border-danger mt-3">
    <div class="card-header bg-danger text-white">
        Import Errors
    </div>

    <div class="card-body p-0">

        <table class="table table-bordered mb-0">
            <thead>
                <tr>
                    <th>Row</th>
                    <th>Column</th>
                    <th>Error</th>
                </tr>
            </thead>

            <tbody>
                @foreach(session('import_errors') as $failure)

                <tr>
                    <td>{{ $failure->row() }}</td>

                    <td>
                        {{ $failure->attribute() }}
                    </td>

                    <td>
                        {{ implode(', ', $failure->errors()) }}
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endif
