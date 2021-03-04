@component('mail::message')
# Notification

{{$comment->initials}} has added a comment to the Palapa Menu Log
<p>{{$comment->comment}}</p>

@component('mail::button', ['url' => 'http://palapablog.herokuapp.com/'])
View Log
@endcomponent

@endcomponent
