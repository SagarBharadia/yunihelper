@if(session()->has('message'))
    <div class="success-messages">
        {{ session()->get('message') }}
    </div>
@endif
