@extends('layouts.master')

@section('title', 'Merchants')

@section('head')
    <link href="{{ asset('css/uppy.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col-md-6">
                    <div class="block-content upload-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="block-header text-center mb-2">
                                    <form class="form-horizontal edt" action="/merchants" method="POST" enctype="multipart/form-data">
                                        <h3 class="upload-title">Upload</h3>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div id="drag-drop-area"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="block-content gallery-content">
                        <div class="row gallery-header">
                            <div class="col-md-12">
                                <div class="block-header text-center mb-1">
                                    <h3>Gallery</h3>
                                </div>
                            </div>
                        </div>
                        <div class="row gallery-body">
                            <div class="col-md-4">
                                <div class="row photo-feed">
                                    <article class="post">
                                        <img src="{{ asset('storage/profiles/15565325535cc6cd49b35c3.jpeg') }}" class="img-responsive" style="object-fit:cover;">
                                    </article>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row photo-feed">
                                    <article class="post">
                                        <img src="{{ asset('storage/profiles/15565325535cc6cd49b35c3.jpeg') }}" class="img-responsive" style="object-fit:cover;">
                                    </article>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row photo-feed">
                                    <article class="post">
                                        <img src="{{ asset('storage/profiles/15565325535cc6cd49b35c3.jpeg') }}" class="img-responsive" style="object-fit:cover;">
                                    </article>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row photo-feed">
                                    <article class="post">
                                        <img src="{{ asset('storage/profiles/15565325535cc6cd49b35c3.jpeg') }}" class="img-responsive" style="object-fit:cover;">
                                    </article>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row photo-feed">
                                    <article class="post">
                                        <img src="{{ asset('storage/profiles/15565325535cc6cd49b35c3.jpeg') }}" class="img-responsive" style="object-fit:cover;">
                                    </article>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row photo-feed">
                                    <article class="post">
                                        <img src="{{ asset('storage/profiles/15565325535cc6cd49b35c3.jpeg') }}" class="img-responsive" style="object-fit:cover;">
                                    </article>
                                </div>
                            </div>

                            <div class="scroller-status">
                                <div class="infinite-scroll-request loader-ellips">
                                      ...
                                </div>
                                <p class="infinite-scroll-last">End of content</p>
                                <p class="infinite-scroll-error">No more pages to load</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('js/uppy.js') }}"></script>
    {{-- <script src="{{ asset('js/infinite-scroll.js') }}"></script> --}}
    <script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.js"></script>

    <script>
		function dodelete()
		{
			job = confirm("Participant will delete permanently. Are you sure?");
			if(job != true)
			{
				return false;
			}
		}
    </script>

    <script>
        $('.gallery-body').infiniteScroll({
            append: '.post',
        });
    </script>

    <script>
        var uppy = Uppy.Core()
          .use(Uppy.Dashboard, {
            inline: true,
            target: '#drag-drop-area'
          })
          .use(Uppy.Tus, {endpoint: 'https://master.tus.io/files/'})
  
        uppy.on('complete', (result) => {
          console.log('Upload complete! We’ve uploaded these files:', result.successful)
        })
    </script>
@endsection