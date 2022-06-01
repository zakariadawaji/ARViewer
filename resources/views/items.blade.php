@extends('layouts.app')

@section('styles')
<style>
  input[type="file"] {
    display: none;
}
.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
}
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-dark text-white">Items</div>

                <div class="card-body">
                    <div class="card-body">
                        <h3>Upload items</h3>
                        <form method="POST" action="{{ route('addItem') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="file" class="col-md-2 col-form-label">Upload item:</label>

                                <div class="col-md-6">
                                    <label for="file" class="custom-file-upload">
                                        <i class="fa fa-cloud-upload"></i> Select your item file
                                    </label>
                                    <input id="file" type="file" class="form-control @error('file') is-invalid @enderror" name="file">
                                    @error('file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <div>
                          <h3>My items</h3>
                          @if( count( $items ) <= 0 )
                            <div class="alert alert-danger"> You currently don't have any items!! </div>
                          @endif
                          @foreach ($items as $item)
                            <div class="mb-2">
                              <form style="height: 35px;" action="/delete-item/{{ $item->id }}" method = "DELETE">
                              <li style="display:inline; padding-top: 25px"> {{$item->name}} </li>
                              <button type="submit" class="btn btn-danger" style="float: right">Delete</button>
                              </form>
                            </div>
                          @endforeach
                        </div>


                    </div>

                    @if (isset($data))
                    <div>
                        <ul>
                            @foreach ($data as $d)
                                <li>{{print_r($d)}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
