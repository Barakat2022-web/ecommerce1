@if (Session::has('error'))
<div class="alert alert-danger" style="position: relative;left: 0px;right: 700px;top:78px"> {{Session::get('error')}}</div>
@endif
