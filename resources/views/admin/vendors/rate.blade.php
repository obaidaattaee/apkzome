@for($i = 1 ; $i <= 5 ; $i++)
    @if( $rate >= $i)
        <i class="fa fa-star"></i>
    @else
        <i class="far fa-star"></i>
    @endif

@endfor
