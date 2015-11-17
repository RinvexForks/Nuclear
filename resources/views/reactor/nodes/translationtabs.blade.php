@if(locale_count() > 1)
<div class="translation-tabs">
    <ul class="content-tabs-bar secondary-tabs-bar">
        @foreach($node->translations as $translation)
            <li>
                @if($translation->locale === $locale)
                    <span class="content-tab-flap active">{{ uppercase($translation->locale) }}</span>
                @else
                    {!! link_to_route($route, uppercase($translation->locale), ['id' => $node->getKey(), 'source' => $translation->getKey()], ['class' => 'content-tab-flap']) !!}
                @endif
            </li>
        @endforeach
    </ul>
    @if(count($node->translations) < locale_count())
    <a href="{{ route('reactor.contents.translation.create', $node->getKey()) }}" class="add-translation-button">
        <i class="icon-plus"></i>
    </a>
    @endif
</div>
@endif
