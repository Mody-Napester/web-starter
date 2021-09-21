@extends('@dashboard._layouts.master')

@section('title') {{ trans('media.Create') }} @endsection

@section('contents')

    <!-- Page Heading -->
    <div class="page-title-box">
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home.index') }}">{{ trans('home.Title') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('media.Page_Title') }}</li>
            </ol>
        </div>
        <h4 class="page-title">{{ trans('media.Page_Title') }} </h4>
    </div>

    <!-- Create -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">General</h5>

                    <div class="mb-3">
                        <label for="product-name" class="form-label">Product Name <span class="text-danger">*</span></label>
                        <input type="text" id="product-name" class="form-control" placeholder="e.g : Apple iMac">
                    </div>

                    <div class="mb-3">
                        <label for="product-reference" class="form-label">Reference <span class="text-danger">*</span></label>
                        <input type="text" id="product-reference" class="form-control" placeholder="e.g : Apple iMac">
                    </div>

                    <div class="mb-3">
                        <label for="product-summary" class="form-label">Product Summary</label>
                        <textarea class="form-control" id="product-summary" rows="3" placeholder="Please enter summary"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="product-category" class="form-label">Categories <span class="text-danger">*</span></label>
                        <select class="form-control select2" id="product-category">
                            <option>Select</option>
                            <optgroup label="Shopping">
                                <option value="SH1">Shopping 1</option>
                                <option value="SH2">Shopping 2</option>
                                <option value="SH3">Shopping 3</option>
                                <option value="SH4">Shopping 4</option>
                            </optgroup>
                            <optgroup label="CRM">
                                <option value="CRM1">Crm 1</option>
                                <option value="CRM2">Crm 2</option>
                                <option value="CRM3">Crm 3</option>
                                <option value="CRM4">Crm 4</option>
                            </optgroup>
                            <optgroup label="eCommerce">
                                <option value="E1">eCommerce 1</option>
                                <option value="E2">eCommerce 2</option>
                                <option value="E3">eCommerce 3</option>
                                <option value="E4">eCommerce 4</option>
                            </optgroup>

                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="product-price">Price <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="product-price" placeholder="Enter amount">
                    </div>

                    <div class="mb-3">
                        <label class="mb-2">Status <span class="text-danger">*</span></label>
                        <br>
                        <div class="radio form-check-inline">
                            <input type="radio" id="inlineRadio1" value="option1" name="radioInline" checked="">
                            <label for="inlineRadio1"> Online </label>
                        </div>
                        <div class="radio form-check-inline">
                            <input type="radio" id="inlineRadio2" value="option2" name="radioInline">
                            <label for="inlineRadio2"> Offline </label>
                        </div>
                        <div class="radio form-check-inline">
                            <input type="radio" id="inlineRadio3" value="option3" name="radioInline">
                            <label for="inlineRadio3"> Draft </label>
                        </div>
                    </div>

                    <div>
                        <label class="form-label">Comment</label>
                        <textarea class="form-control" rows="3" placeholder="Please enter comment"></textarea>
                    </div>
                </div>
            </div> <!-- end card -->
        </div> <!-- end col -->

    </div>

@endsection
