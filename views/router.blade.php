@php
    $page = section('page')->list('active', 'title', 'slug');
    $page->text('title')->min(2)->max(300)->required();
    $page->text('uri')->unique()->required();
    $page->checkbox('active');
    $page->select('template')->fromDirectory('views.templates');

    $currentPage = $page->where('slug' , request()->slug())->first();
@endphp
@if($currentPage && $currentPage->get('active'))
    @section('page_title')
        {{ $currentPage->get('title') }}
    @endsection
    @include($currentPage->get('template'), ['page', $currentPage])
@else
    @include('errors.404')
@endif