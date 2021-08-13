@extends('admin_layouts.layout')
@section('contents')
    <div class="row ms-sm-auto col-lg-10 px-md-4">
        <h1>Update new product</h1>
        <form method="POST" action="{{ route('admin.products.update', $item->id) }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3 mt-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="name" value="{{ $item->name }}" name="name" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">

            </div>
            @error('name')
                <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3 mt-3">
                <label for="exampleInputEmail1" class="form-label">Description</label>
                <input type="text" name="description" value="{{ $item->description }}" class="form-control"
                    id="exampleInputEmail1" aria-describedby="emailHelp">

            </div>
            @error('description')
                <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3 mt-3">
                <label for="exampleInputEmail1" class="form-label">Price</label>
                <input type="number" name="price" value="{{ str_replace('$', '', $item->price) }}" class="form-control"
                    id="exampleInputEmail1" aria-describedby="emailHelp">

            </div>
            @error('price')
                <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3 mt-3">
                <label for="exampleInputEmail1" class="form-label">Price</label>
                <input type="file" name="images[]" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    multiple accept="image/*">

                @foreach ($item->images as $image)
                    <img src="{{ Storage::disk('local')->url($image->path) }}" width="100" alt="" />
                @endforeach
            </div>
            <div class="mb-3 mt-3">
                <label for="exampleInputEmail1" class="form-label">Categories</label>

                <select name="category_id" class="form-select" aria-label="Default select example">
                    @foreach ($cates as $data)
                        @foreach ($item->categories as $small)
                            @if ($data->id == $small->id)
                                <option selected="selected" value="{{ $data->id }}">{{ $data->name }}</option>
                            @else
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endif
                        @endforeach
                    @endforeach
                </select>
            </div>
            @error('category_id')
                <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3 mt-3">
                <label for="exampleInputEmail1" class="form-label">Brands</label>
                <select name="brand_id" class="form-select" aria-label="Default select example">
                    @foreach ($brands as $data)
                        @if (!$item->brands->isEmpty())
                            @foreach ($item->brands as $small)
                                @if ($data->id == $small->id)
                                    <option selected="selected" value="{{ $data->id }}">{{ $data->name }}</option>
                                @else
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endif
                            @endforeach
                        @else
                            <option value="{{ $data->id }}">{{ $data->name }}</option>

                        @endif

                    @endforeach
                </select>
            </div>
            @error('brand_id')
                <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


@endsection
