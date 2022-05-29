<?php
/**@var App\Models\Seo $seo */ ?>
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
            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="noindex" @checked(1) class="custom-control-input">
                    <label class="custom-control-label" for="noindex">No index</label>
                </div>
            </div>
            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="nofollow" @checked(1) class="custom-control-input">
                    <label class="custom-control-label" for="nofollow">No follow</label>
                </div>
            </div>
            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="in_sitemap" @checked(1) class="custom-control-input">
                    <label class="custom-control-label" for="in_sitemap">In sitemap</label>
                </div>
            </div>
            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="is_canonical" @checked(1) class="custom-control-input">
                    <label class="custom-control-label" for="is_canonical">Canonical</label>
                </div>
            </div>
        </div>
    </div>
</div>
