@if (Session::has('error'))
<div class="alert alert-danger" style="position: relative;left: 0px;right: 700px"> {{Session::get('error')}}</div>
@endif
