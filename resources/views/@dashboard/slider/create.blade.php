@extends('@dashboard._layouts.master')

@section('page_title') Slider @endsection

@section('page_contents')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Slider</h1>
    </div>

    <!-- Page Forms -->
    <form action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create new slider</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach(config('vars.langs') as $lang)
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-col-form-label" for="text_1_{{ $lang }}">Text 1 ({{ $lang }})</label>
                                <input class="form-control @error('text_1_'.$lang) is-invalid @enderror "
                                       id="text_1_{{ $lang }}"
                                       type="text" name="text_1_{{ $lang }}"
                                       placeholder="Enter text 1 {{ $lang }} .." value="{{ old('text_1_' . $lang) }}">

                                @error('text_1_'.$lang)
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endforeach

                    @foreach(config('vars.langs') as $lang)
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-col-form-label" for="text_2_{{ $lang }}">Text 2 ({{ $lang }})</label>
                                <input class="form-control @error('text_2_'.$lang) is-invalid @enderror "
                                       id="text_2_{{ $lang }}"
                                       type="text" name="text_2_{{ $lang }}"
                                       placeholder="Enter text 2 {{ $lang }} .." value="{{ old('text_2_' . $lang) }}">

                                @error('text_2_'.$lang)
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endforeach

                    @foreach(config('vars.langs') as $lang)
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-col-form-label" for="text_3_{{ $lang }}">Text 3 ({{ $lang }})</label>
                                <textarea class="form-control @error('text_3_'.$lang) is-invalid @enderror "
                                          id="text_3_{{ $lang }}" name="text_3_{{ $lang }}"
                                          placeholder="Enter text 3 {{ $lang }} .."></textarea>

                                @error('text_3_'.$lang)
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <script>
                                    CKEDITOR.replace( 'text_3_{{ $lang }}' );
                                </script>
                            </div>
                        </div>
                    @endforeach

                    @foreach(config('vars.langs') as $lang)
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-col-form-label" for="button_1_text_{{ $lang }}">Button 1 Text ({{ $lang }})</label>
                                <input class="form-control @error('button_1_text_'.$lang) is-invalid @enderror "
                                       id="button_1_text_{{ $lang }}"
                                       type="text" name="button_1_text_{{ $lang }}"
                                       placeholder="Enter button 1 text {{ $lang }} .." value="{{ old('button_1_text_' . $lang) }}">

                                @error('button_1_text_'.$lang)
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endforeach

                    @foreach(config('vars.langs') as $lang)
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-col-form-label" for="button_2_text_{{ $lang }}">Button 2 Text ({{ $lang }})</label>
                                <input class="form-control @error('button_2_text_'.$lang) is-invalid @enderror "
                                       id="button_2_text_{{ $lang }}"
                                       type="text" name="button_2_text_{{ $lang }}"
                                       placeholder="Enter button 2 text {{ $lang }} .." value="{{ old('button_2_text_' . $lang) }}">

                                @error('button_2_text_'.$lang)
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endforeach

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-col-form-label" for="button_1_link">Button 1 link</label>
                            <input class="form-control @error('button_1_link') is-invalid @enderror "
                                   id="button_1_link" type="text" name="button_1_link"
                                   placeholder="Enter button 1 link .." value="{{ old('button_1_link') }}">

                            @error('button_1_link')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-col-form-label" for="button_2_link">Button 2 link</label>
                            <input class="form-control @error('button_2_link') is-invalid @enderror "
                                   id="button_2_link" type="text" name="button_2_link"
                                   placeholder="Enter button 2 link .." value="{{ old('button_2_link') }}">

                            @error('button_2_link')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-col-form-label" for="image">Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" id="image" type="file" name="image">

                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-save"></i> Save</button>
            </div>
        </div>
    </form>


@endsection
