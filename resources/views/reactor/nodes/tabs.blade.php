<?php $flaps = [
    'reactor.contents.edit'       => 'nodes.content',
    'reactor.contents.parameters' => 'nodes.parameters',
    'reactor.contents.seo'        => 'nodes.seo',
]; ?>

<ul class="content-tabs-bar">
    @foreach($flaps as $route => $text)
        <li>
            @if($currentTab === $route)
                <span class="content-tab-flap active">{{ uppercase(trans($text)) }}</span>
            @else
                @if($route === 'reactor.contents.parameters' || !isset($source))
                    {!! link_to_route($route, uppercase(trans($text)), $currentKey, ['class' => 'content-tab-flap']) !!}
                @else
                    {!! link_to_route($route, uppercase(trans($text)), ['id' => $currentKey, 'source' => $source->getKey()], ['class' => 'content-tab-flap']) !!}
                @endif
            @endif
        </li>
    @endforeach
</ul>
