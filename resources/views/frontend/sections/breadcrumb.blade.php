@php

    $content = content('breadcrumb.content');

@endphp
<!--Banner Start-->
<div class="container banner-area flex" style="background-image:url({{getFile('breadcrumb',@$content->data->image)}});">
    <div class="text-center">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-text">
                    <h2>{{changeDynamic($pageTitle)}}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Banner End-->