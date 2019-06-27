@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Post Advertisement') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="display_image" class="col-md-4 col-form-label text-md-right">{{ __('Display Image') }}</label>
    
                            <div class="col-md-6">
                                <input id="display_image" type="file" class=" @error('display_image') is-invalid @enderror" name="display_image" value="{{ old('display_image') }}" required autocomplete="display_image" autofocus>
    
                                @error('display_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Product Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="brand" class="col-md-4 col-form-label text-md-right">{{ __('Brand') }}</label>

                            <div class="col-md-6">
                                <input id="brand" type="text" class="form-control @error('brand') is-invalid @enderror" name="brand" value="{{ old('brand') }}" required autocomplete="brand" autofocus>

                                @error('brand')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>
    
                                <div class="col-md-6">
                                    <select class="form-control">
                                        {{ $categories = App\Category::all() }}
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
    
                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="condition" class="col-md-4 col-form-label text-md-right">{{ __('Condition') }}</label>
    
                                <div class="col-md-6">
                                    <select  class="form-control">
                                        <option value="Intact">Intact</option>
                                        <option value="Used">Used</option>
                                    </select>    
                                    @error('condition')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="buying_year" class="col-md-4 col-form-label text-md-right">{{ __('Buying year (for used product)') }}</label>
    
                                <div class="col-md-6">
                                    <input id="buying_year" type="text" class="form-control @error('buying_year') is-invalid @enderror" name="buying_year" value="{{ old('buying_year') }}" required autocomplete="buying_year" autofocus>
    
                                    @error('buying_year')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="specification" class="col-md-4 col-form-label text-md-right">{{ __('Specification') }}</label>
    
                                <div class="col-md-6">
                                    <textarea id="specification" rows="10" class="form-control @error('specification') is-invalid @enderror" name="specification" value="{{ old('specification') }}" required autocomplete="specification" autofocus></textarea>
    
                                    @error('specification')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="color" class="col-md-4 col-form-label text-md-right">{{ __('Color') }}</label>
    
                                <div class="col-md-6">
                                    <input id="color" type="text" class="form-control @error('color') is-invalid @enderror" name="color" value="{{ old('color') }}" autocomplete="color" autofocus>
    
                                    @error('color')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="weight" class="col-md-4 col-form-label text-md-right">{{ __('Weight (kgs)') }}</label>
    
                                <div class="col-md-6">
                                    <input id="weight" type="text" class="form-control @error('weight') is-invalid @enderror" name="weight" value="{{ old('weight') }}" autocomplete="weight" autofocus>
    
                                    @error('weight')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="size" class="col-md-4 col-form-label text-md-right">{{ __('Size (metres)') }}</label>
    
                                <div class="col-md-6">
                                    <input id="size" type="text" class="form-control @error('size') is-invalid @enderror" name="size" value="{{ old('size') }}" autocomplete="size" autofocus>
    
                                    @error('size')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="guarantee" class="col-md-4 col-form-label text-md-right">{{ __('Guarantee (months)') }}</label>
    
                                <div class="col-md-6">
                                    <input id="guarantee" type="number" class="form-control @error('guarantee') is-invalid @enderror" name="guarantee" value="{{ old('guarantee') }}" autocomplete="guarantee" autofocus>
    
                                    @error('guarantee')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="warranty" class="col-md-4 col-form-label text-md-right">{{ __('Warranty (months)') }}</label>
    
                                <div class="col-md-6">
                                    <input id="warranty" type="warranty" class="form-control @error('warranty') is-invalid @enderror" name="warranty" value="{{ old('warranty') }}" autocomplete="warranty" autofocus>
    
                                    @error('warranty')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="img1" class="col-md-4 col-form-label text-md-right">{{ __('Additional Image 1') }}</label>
        
                            <div class="col-md-6">
                                <input id="img1" type="file" class=" @error('img1') is-invalid @enderror" name="img1" value="{{ old('img1') }}" autocomplete="img1" autofocus>
        
                                @error('img1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="img2" class="col-md-4 col-form-label text-md-right">{{ __('Additional Image 2') }}</label>
            
                            <div class="col-md-6">
                                <input id="img2" type="file" class=" @error('img2') is-invalid @enderror" name="img2" value="{{ old('img2') }}" autocomplete="img2" autofocus>
            
                                @error('img2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="img3" class="col-md-4 col-form-label text-md-right">{{ __('Additional Image 3') }}</label>
                
                            <div class="col-md-6">
                                <input id="img3" type="file" class=" @error('img3') is-invalid @enderror" name="img3" value="{{ old('img3') }}" autocomplete="img3" autofocus>
                
                                @error('img3')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="img4" class="col-md-4 col-form-label text-md-right">{{ __('Additional Image 4') }}</label>
                    
                            <div class="col-md-6">
                                <input id="img4" type="file" class=" @error('img4') is-invalid @enderror" name="img4" value="{{ old('img4') }}" autocomplete="img4" autofocus>
                    
                                @error('img4')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
