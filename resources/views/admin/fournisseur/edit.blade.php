@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-briefcase"></i> {{ $pageTitle }}</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <form action="{{ route('admin.fournisseur.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="tile-body">
                                <div class="form-group">
                                        <label class="control-label" for="name">Name <span class="m-l-5 text-danger"> *</span></label>
                                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name') }}"/>
                                        @error('name') {{ $message }} @enderror
                                    </div>
                                    <label class="control-label" for="name">email </label>
                                    <input
                                        class="form-control @error('email ') is-invalid @enderror"
                                        type="text"
                                        placeholder="Enter attribute email "
                                        id="email "
                                        name="email "
                                        value="{{ old('email ', $fournisseur->email ) }}"
                                    />
                                    <input type="hidden" name="email" value="{{ $fournisseur->email }}">
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('email') <span>{{ $message }}</span> @enderror
                                    </div>
                                    <label class="control-label" for="name">address </label>
                                    <input
                                        class="form-control @error('address ') is-invalid @enderror"
                                        type="text"
                                        placeholder="Enter attribute address "
                                        id="address "
                                        name="address "
                                        value="{{ old('address ', $fournisseur->address ) }}"
                                    />
                                    <input type="hidden" name="address" value="{{ $fournisseur->address }}">
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('address') <span>{{ $message }}</span> @enderror
                                    </div>
                               
                                    <label class="control-label" for="name">tel </label>
                                    <input
                                        class="form-control @error('address ') is-invalid @enderror"
                                        type="text"
                                        placeholder="Enter attribute tel "
                                        id="tel "
                                        name="tel "
                                        value="{{ old('tel ', $fournisseur->tel ) }}"
                                    />
                                    <input type="hidden" name="tel" value="{{ $fournisseur->tel}}">
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('tel') <span>{{ $message }}</span> @enderror
                                    </div>
                            
                                    
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save fournisseur</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.fournisseur.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush
