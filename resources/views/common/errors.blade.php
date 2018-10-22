@if (count($errors) > 0)
    <!-- Form Error List -->
    <div class="alert alert-danger">
        <strong>{{__('error.title')}}</strong>

        <br><br>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ __('validation.'.$error) }}</li>
            @endforeach
        </ul>
    </div>
@endif