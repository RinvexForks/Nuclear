{!! activity_open($activity, false) !!}

{!! trans('activities.updated_node_content', [
    'actorLink' => route('reactor.users.edit', $activity->user->getKey()),
    'actorName' => $activity->user->first_name,
    'subjectLink' => route('reactor.contents.edit', $activity->subject_id)
]) !!}

{!! activity_close() !!}