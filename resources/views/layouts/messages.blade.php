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
