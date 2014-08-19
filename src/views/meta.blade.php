@foreach($metas as $meta)
    @if($meta['type'] == Meta::UNPAIRED_TAG)
        <meta {{ $meta['attributes'] }}>
    @endif

    @if($meta['type'] == Meta::PAIRED_TAG)
        <title {{ $meta['attributes'] }}>{{ $meta['content'] }}</title>
    @endif
@endforeach