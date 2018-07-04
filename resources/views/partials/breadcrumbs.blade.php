<div class="breadcrumbs">
    <section class="container">
        <div class="row">
             @if(isset( $breadcrumbs[2]))
                <div class="col-md-12">
                    <h1>{{ $breadcrumbs[2]->title}} </h1>
                </div>
            @endif
            @if (count($breadcrumbs))
            <div class="col-md-12">
                <div class="crumbs">
                    @foreach ($breadcrumbs as $breadcrumb)
                        @if ($breadcrumb->url && !$loop->last)
                            <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
                            <span class="crumbs-span">/</span>
                        @else
                        <span class="current">{{ $breadcrumb->title }}</span>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif
        </div><!-- End row -->
    </section><!-- End container -->
</div><!-- End breadcrumbs -->


