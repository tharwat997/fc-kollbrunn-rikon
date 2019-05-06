<h2 style="text-align: center">Message from FC-Kollbrunn-Rikon Website</h2>
<ul>
    <li class="mb-3">Sender email: {{$data['sender_email']}}</li>
    <li class="mb-3">Sender name: {{$data['sender_name']}}</li>
    <li class="mb-3">Sender mobile: {{$data['sender_number']}}</li>
    <li class="mb-3">Purpose of contact:  {{$data['purpose_of_contact']}}</li>
    @if(isset($data['team']))
        <li class="mb-3">Team selected: {{$data['team']}}</li>
    @endif
    @if(isset($data['event']))
        <li class="mb-3">Event selected: {{$data['event']}}</li>
    @endif
    @if(isset($data['reason_of_joining_event']))
        <li class="mb-3">Reason of joining event: {{$data['reason_of_joining_event']}}</li>
    @endif
</ul>

<div class="d-flex align-items-center justify-content-center">
    <p>Message: {{$data['message']}}</p>
</div>
