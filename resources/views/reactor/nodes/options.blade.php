{!! content_options_open(null, false) !!}

@if($node->canHaveChildren())
<li class="dropdown-sub__item">
    <a href="{{ route('reactor.nodes.create', $node->getKey()) }}">
        <i class="icon-plus"></i>{{ trans('nodes.add_child') }}</a>
</li>
<li class="dropdown-sub__splitter"></li>
@endif

@if($node->canHaveMoreTranslations())
<li class="dropdown-sub__item">
    <a href="{{ route('reactor.nodes.translation.create', [$node->getKey(), $source->getKey()]) }}">
        <i class="icon-language"></i>{{ trans('general.add_translation') }}</a>
</li>
@endif

@if(isset($_edit) && $_edit === true && (count($node->translations) > 1))
<li class="dropdown-sub__item dropdown-sub__item--delete">
    {!! delete_form(
        route('reactor.nodes.translation.destroy', $source->getKey()),
        trans('general.destroy_translation'), '', false, 'icon-blank') !!}
</li>
@endif

<li class="dropdown-sub__item dropdown-sub__item--delete">
    {!! delete_form(
        route('reactor.nodes.destroy', $node->getKey()),
        trans('nodes.destroy')) !!}
</li>

@if( ! $node->isLocked())
<li class="dropdown-sub__splitter"></li>
<li class="dropdown-sub__item">
    <a href="{{ route('reactor.nodes.transform', $node->getKey()) }}">
        <i class="icon-blank"></i>{{ trans('nodes.transform') }}</a>
</li>
<li class="dropdown-sub__item">
    <a href="{{ route('reactor.nodes.move', $node->getKey()) }}">
        <i class="icon-blank"></i>{{ trans('nodes.move') }}</a>
</li>
@endif

<li class="dropdown-sub__splitter"></li>
<li class="dropdown-sub__item">{!! node_option_form(
    $node->isPublished() ? route('reactor.nodes.unpublish', $node->getKey()) : route('reactor.nodes.publish', $node->getKey()),
    $node->isPublished() ? 'icon-status-withheld' : 'icon-status-published',
    $node->isPublished() ? 'nodes.unpublish' : 'nodes.publish'
    ) !!}</li>
<li class="dropdown-sub__item">{!! node_option_form(
    $node->isLocked() ? route('reactor.nodes.unlock', $node->getKey()) : route('reactor.nodes.lock', $node->getKey()),
    $node->isLocked() ? 'icon-blank' : 'icon-status-locked',
    $node->isLocked() ? 'nodes.unlock' : 'nodes.lock'
    ) !!}</li>
<li class="dropdown-sub__item">{!! node_option_form(
    $node->isVisible() ? route('reactor.nodes.hide', $node->getKey()) : route('reactor.nodes.show', $node->getKey()),
    $node->isVisible() ? 'icon-status-invisible' : 'icon-blank',
    $node->isVisible() ? 'nodes.hide' : 'nodes.show'
    ) !!}</li>

{!! content_options_close(false) !!}