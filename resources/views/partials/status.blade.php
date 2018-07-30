@if($errors->any())
    <div class="alert-message error">
        <i class="icon-flag"></i>
        <p><span>Error message</span><br>
            <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </p>
    </div>
@endif
