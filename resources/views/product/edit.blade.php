@extends('layouts.app', ['page' => __('Product Management'), 'pageSlug' => 'products'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Product Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('products.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('products.update', $product->id) }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('Product information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', $product->name) }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>

                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">{{ __('Description') }}</label>
                                    <textarea name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="{{ __('Description') }}" required>
                                        {{ old('description', $product->description) }}
                                    </textarea>
                                    @include('alerts.feedback', ['field' => 'description'])
                                </div>

                                <label class="form-control-label" for="input-src">{{ __('Image') }}</label><br>
                                <input type="file" name="src" id="input-src" class="{{ $errors->has('src') ? ' is-invalid' : '' }}" value="{{ __('Image') }}">
                                @include('alerts.feedback', ['field' => 'src'])

                                <div class="form-group{{ $errors->has('published_from') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-published_from">{{ __('Publish from') }}</label>
                                    <input type="text" name="published_from" id="input-published_from" class="form-control form-control-alternative{{ $errors->has('published_from') ? ' is-invalid' : '' }}" placeholder="{{ __('Publish from') }}" value="{{ old('published_from', $product->published_from) }}">
                                    @include('alerts.feedback', ['field' => 'published_from'])
                                </div>

                                <div class="form-group{{ $errors->has('published_until') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-published_until">{{ __('Publish until') }}</label>
                                    <input type="text" name="published_until" id="input-published_until" class="form-control form-control-alternative{{ $errors->has('published_until') ? ' is-invalid' : '' }}" placeholder="{{ __('Publish until') }}" value="{{ old('published_until', $product->published_until) }}">
                                    @include('alerts.feedback', ['field' => 'published_until'])
                                </div>

                                <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-price">{{ __('Price') }}</label>
                                    <input type="number" name="price" id="input-price" class="form-control form-control-alternative{{ $errors->has('Price') ? ' is-invalid' : '' }}" placeholder="{{ __('Price') }}" value="{{ old('price', $product->price) }}" required>
                                    @include('alerts.feedback', ['field' => 'price'])
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
