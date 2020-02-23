@if(have_posts())
    @while(have_posts())
        @php(the_post())
        {{ $slot }}
    @endwhile
@endif
