@foreach($apps as $app)
    <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="row">
            <div class="p-panel">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <img src="{{ object_get($app , 'image_file') }}"
                         title="{{ $app->translation('title' , app()->getLocale()) }}" class="img-responsive p-img"
                         alt="{{ $app->translation('title' , app()->getLocale()) }}"/>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 clr-left">
                    <h4 class="p-head text-overflow">{{ $app->translation('title' , app()->getLocale()) }}</h4>
                    <p class="p-text-sm">
                        Some text here
                    </p>
                    <p class="coming-soon">
                        COMING SOON</p>

                </div>
            </div>
        </div>
    </div>
@endforeach

