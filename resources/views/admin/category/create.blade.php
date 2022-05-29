@extends('layouts.admin')

@section('seo')
@endsection

@section('content')

    <div class="col-8">
        <div class="card card-primary card-outline collapsed-card">
            <div class="card-header" data-card-widget="collapse">
                <h3 class="card-title">Seo</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool">
                    </button>
                </div>
            </div>

            <div class="card-body" style="display: none;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Minimal</label>
                            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                                    data-select2-id="1" tabindex="-1" aria-hidden="true">
                                <option selected="selected" data-select2-id="3">Alabama</option>
                                <option>Alaska</option>
                                <option>California</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Washington</option>
                            </select><span class="select2 select2-container select2-container--default" dir="ltr"
                                           data-select2-id="2" style="width: 100%;"><span class="selection"><span
                                        class="select2-selection select2-selection--single" role="combobox"
                                        aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false"
                                        aria-labelledby="select2-ep0q-container"><span
                                            class="select2-selection__rendered" id="select2-ep0q-container"
                                            role="textbox" aria-readonly="true" title="Alabama">Alabama</span><span
                                            class="select2-selection__arrow" role="presentation"><b
                                                role="presentation"></b></span></span></span><span
                                    class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>

                        <div class="form-group">
                            <label>Disabled</label>
                            <select class="form-control select2 select2-hidden-accessible" disabled=""
                                    style="width: 100%;" data-select2-id="4" tabindex="-1" aria-hidden="true">
                                <option selected="selected" data-select2-id="6">Alabama</option>
                                <option>Alaska</option>
                                <option>California</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Washington</option>
                            </select><span
                                class="select2 select2-container select2-container--default select2-container--disabled"
                                dir="ltr" data-select2-id="5" style="width: 100%;"><span class="selection"><span
                                        class="select2-selection select2-selection--single" role="combobox"
                                        aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="true"
                                        aria-labelledby="select2-tnd5-container"><span
                                            class="select2-selection__rendered" id="select2-tnd5-container"
                                            role="textbox" aria-readonly="true" title="Alabama">Alabama</span><span
                                            class="select2-selection__arrow" role="presentation"><b
                                                role="presentation"></b></span></span></span><span
                                    class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Multiple</label>
                            <select class="select2 select2-hidden-accessible" multiple=""
                                    data-placeholder="Select a State" style="width: 100%;" data-select2-id="7"
                                    tabindex="-1" aria-hidden="true">
                                <option>Alabama</option>
                                <option>Alaska</option>
                                <option>California</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Washington</option>
                            </select><span class="select2 select2-container select2-container--default" dir="ltr"
                                           data-select2-id="8" style="width: 100%;"><span class="selection"><span
                                        class="select2-selection select2-selection--multiple" role="combobox"
                                        aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false"><ul
                                            class="select2-selection__rendered"><li
                                                class="select2-search select2-search--inline"><input
                                                    class="select2-search__field" type="search" tabindex="0"
                                                    autocomplete="off" autocorrect="off" autocapitalize="none"
                                                    spellcheck="false" role="searchbox" aria-autocomplete="list"
                                                    placeholder="Select a State" style="width: 319px;"></li></ul></span></span><span
                                    class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>

                        <div class="form-group">
                            <label>Disabled Result</label>
                            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                                    data-select2-id="9" tabindex="-1" aria-hidden="true">
                                <option selected="selected" data-select2-id="11">Alabama</option>
                                <option>Alaska</option>
                                <option disabled="disabled">California (disabled)</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Washington</option>
                            </select><span class="select2 select2-container select2-container--default" dir="ltr"
                                           data-select2-id="10" style="width: 100%;"><span class="selection"><span
                                        class="select2-selection select2-selection--single" role="combobox"
                                        aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false"
                                        aria-labelledby="select2-02ly-container"><span
                                            class="select2-selection__rendered" id="select2-02ly-container"
                                            role="textbox" aria-readonly="true" title="Alabama">Alabama</span><span
                                            class="select2-selection__arrow" role="presentation"><b
                                                role="presentation"></b></span></span></span><span
                                    class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>

                    </div>

                </div>

                <h5>Custom Color Variants</h5>
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label>Minimal (.select2-danger)</label>
                            <select class="form-control select2 select2-danger select2-hidden-accessible"
                                    data-dropdown-css-class="select2-danger" style="width: 100%;" data-select2-id="12"
                                    tabindex="-1" aria-hidden="true">
                                <option selected="selected" data-select2-id="14">Alabama</option>
                                <option>Alaska</option>
                                <option>California</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Washington</option>
                            </select><span class="select2 select2-container select2-container--default" dir="ltr"
                                           data-select2-id="13" style="width: 100%;"><span class="selection"><span
                                        class="select2-selection select2-selection--single" role="combobox"
                                        aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false"
                                        aria-labelledby="select2-pv5m-container"><span
                                            class="select2-selection__rendered" id="select2-pv5m-container"
                                            role="textbox" aria-readonly="true" title="Alabama">Alabama</span><span
                                            class="select2-selection__arrow" role="presentation"><b
                                                role="presentation"></b></span></span></span><span
                                    class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>

                    </div>

                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label>Multiple (.select2-purple)</label>
                            <div class="select2-purple">
                                <select class="select2 select2-hidden-accessible" multiple=""
                                        data-placeholder="Select a State" data-dropdown-css-class="select2-purple"
                                        style="width: 100%;" data-select2-id="15" tabindex="-1" aria-hidden="true">
                                    <option>Alabama</option>
                                    <option>Alaska</option>
                                    <option>California</option>
                                    <option>Delaware</option>
                                    <option>Tennessee</option>
                                    <option>Texas</option>
                                    <option>Washington</option>
                                </select><span class="select2 select2-container select2-container--default" dir="ltr"
                                               data-select2-id="16" style="width: 100%;"><span class="selection"><span
                                            class="select2-selection select2-selection--multiple" role="combobox"
                                            aria-haspopup="true" aria-expanded="false" tabindex="-1"
                                            aria-disabled="false"><ul class="select2-selection__rendered"><li
                                                    class="select2-search select2-search--inline"><input
                                                        class="select2-search__field" type="search" tabindex="0"
                                                        autocomplete="off" autocorrect="off" autocapitalize="none"
                                                        spellcheck="false" role="searchbox" aria-autocomplete="list"
                                                        placeholder="Select a State"
                                                        style="width: 319px;"></li></ul></span></span><span
                                        class="dropdown-wrapper" aria-hidden="true"></span></span>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="card-footer" style="display: none;">
                Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information
                about
                the plugin.
            </div>
        </div>
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Input Addon</h3>
            </div>
            <div class="card-body">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">@</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Username">
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control">
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="text" class="form-control">
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
                <h4>With icons</h4>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input type="email" class="form-control" placeholder="Email">
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-check"></i></span>
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
<span class="input-group-text">
<i class="fas fa-dollar-sign"></i>
</span>
                    </div>
                    <input type="text" class="form-control">
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fas fa-ambulance"></i></div>
                    </div>
                </div>
                <h5 class="mt-4 mb-2">With checkbox and radio inputs</h5>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
<span class="input-group-text">
<input type="checkbox">
</span>
                            </div>
                            <input type="text" class="form-control">
                        </div>

                    </div>

                    <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><input type="radio"></span>
                            </div>
                            <input type="text" class="form-control">
                        </div>

                    </div>

                </div>

                <h5 class="mt-4 mb-2">With buttons</h5>
                <p>Large: <code>.input-group.input-group-lg</code></p>
                <div class="input-group input-group-lg mb-3">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                            Action
                        </button>
                        <ul class="dropdown-menu">
                            <li class="dropdown-item"><a href="#">Action</a></li>
                            <li class="dropdown-item"><a href="#">Another action</a></li>
                            <li class="dropdown-item"><a href="#">Something else here</a></li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item"><a href="#">Separated link</a></li>
                        </ul>
                    </div>

                    <input type="text" class="form-control">
                </div>

                <p>Normal</p>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-danger">Action</button>
                    </div>

                    <input type="text" class="form-control">
                </div>

                <p>Small <code>.input-group.input-group-sm</code></p>
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control">
                    <span class="input-group-append">
<button type="button" class="btn btn-info btn-flat">Go!</button>
</span>
                </div>

            </div>

        </div>
    </div>
@endsection

@section('js')
@endsection
