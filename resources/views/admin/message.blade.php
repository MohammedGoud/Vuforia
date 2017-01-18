@if(Session::has('addcat'))
    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('addcat') }}</p>
@endif


@if(Session::has('editcat'))
    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('editcat') }}</p>
@endif


@if(Session::has('delcat'))
    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('delcat') }}</p>
@endif

@if(Session::has('updatecat'))
    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('updatecat') }}</p>
@endif


@if(Session::has('activate'))
    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('activate') }}</p>
@endif
@if(Session::has('deactivate'))
    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('deactivate') }}</p>
@endif
