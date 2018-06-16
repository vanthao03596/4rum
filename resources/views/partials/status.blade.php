
@if(session()->get('success'))
<div class="alert-message success">
    <i class="icon-ok"></i>
    <p><span>Success message</span><br>
    {{ session()->get('success')}}.</p>
</div>
@endif

@if($errors->any())
    <div class="alert-message error">
        <i class="icon-flag"></i>
        <p><span>Error message</span><br>
        Something wrong, please try again.</p>
    </div>
@endif