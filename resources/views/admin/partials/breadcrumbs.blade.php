<ol class="breadcrumb">
    @if (count($breadcrumbs))
        @foreach ($breadcrumbs as $breadcrumb)
            @if ($breadcrumb->url && !$loop->last)
                <li><a href="{{ $breadcrumb->url }}">
                        @if($breadcrumb->title == 'Dashboard')
                            <i class="fa fa-dashboard"></i>
                        @endif
                    {{ trans('admin.' . strtolower($breadcrumb->title)) }}</a>
                </li>
            @else
                <li class="active">
                    @if($breadcrumb->title == 'Dashboard')
                        <i class="fa fa-dashboard"></i>
                    @endif
                    {{ trans('admin.' . strtolower($breadcrumb->title)) }}
                </li>
            @endif
        @endforeach
    @endif
</ol>
