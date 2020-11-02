<div class="pl-lg-4">
    <div class="form-group{{ $errors->has('en.name') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="input-name">{{ __('Name') }} (en)</label>
        <input type="text" name="en[name]" id="input-name" class="form-control form-control-alternative{{ $errors->has('en.name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('en.name') ?? $product->{'name:en'} ?? '' }}" required autofocus>
        @include('alerts.feedback', ['field' => 'en.name'])
    </div>

    <div class="form-group{{ $errors->has('hu.name') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="input-name">{{ __('Name') }} (hu)</label>
        <input type="text" name="hu[name]" id="input-name" class="form-control form-control-alternative{{ $errors->has('hu.name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('hu.name') ?? $product->{'name:hu'} ?? '' }}">
        @include('alerts.feedback', ['field' => 'hu.name'])
    </div>

    <div class="form-group{{ $errors->has('en.description') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="input-description">{{ __('Description') }}  (en)</label>
        <textarea name="en[description]" id="input-description" class="form-control form-control-alternative{{ $errors->has('en.description') ? ' is-invalid' : '' }}" placeholder="{{ __('Description') }}" required>
                                        {{ old('en.description') ?? $product->{'description:en'} ?? '' }}
                                    </textarea>
        @include('alerts.feedback', ['field' => 'en.description'])
    </div>

    <div class="form-group{{ $errors->has('hu.description') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="input-description">{{ __('Description') }}  (hu)</label>
        <textarea name="hu[description]" id="input-description" class="form-control form-control-alternative{{ $errors->has('hu.description') ? ' is-invalid' : '' }}" placeholder="{{ __('Description') }}" required>
                                        {{ old('hu.description') ?? $product->{'description:hu'} ?? '' }}
                                    </textarea>
        @include('alerts.feedback', ['field' => 'hu.description'])
    </div>

    <label class="form-control-label" for="input-src">{{ __('Image') }}</label><br>
    <input type="file" name="src" id="input-src" class="{{ $errors->has('src') ? ' is-invalid' : '' }}" value="{{ __('Image') }}">
    @include('alerts.feedback', ['field' => 'src'])

    <div class="form-group{{ $errors->has('published_from') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="input-published_from">{{ __('Publish from') }}</label>
        <input type="text" name="published_from" id="input-published_from" class="form-control form-control-alternative{{ $errors->has('published_from') ? ' is-invalid' : '' }}" placeholder="{{ __('Publish from') }}" value="{{ old('published_from') ?? $product->published_from ?? '' }}">
        @include('alerts.feedback', ['field' => 'published_from'])
    </div>

    <div class="form-group{{ $errors->has('published_until') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="input-published_until">{{ __('Publish until') }}</label>
        <input type="text" name="published_until" id="input-published_until" class="form-control form-control-alternative{{ $errors->has('published_until') ? ' is-invalid' : '' }}" placeholder="{{ __('Publish until') }}" value="{{ old('published_until') ?? $product->published_until ?? '' }}">
        @include('alerts.feedback', ['field' => 'published_until'])
    </div>

    <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="input-price">{{ __('Price') }}</label>
        <input type="number" name="price" id="input-price" class="form-control form-control-alternative{{ $errors->has('Price') ? ' is-invalid' : '' }}" placeholder="{{ __('Price') }}" value="{{ old('price') ?? $product->price ?? '' }}" required>
        @include('alerts.feedback', ['field' => 'price'])
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
    </div>
</div>
