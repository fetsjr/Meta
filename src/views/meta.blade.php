@foreach($metas as $meta)
    @if($meta['tag'] == 'meta' || $meta['tag'] == 'equiv')
        <meta {{ $meta['attributes'] }}>
    @endif

    @if($meta['tag'] == 'title')
        <title>{{ $meta['attributes'] }}</title>
    @endif
@endforeach