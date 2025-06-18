<h3>
    New webinar question! – CA Trust Law, APC</strong>
</h3>

<p><strong>Name:</strong> {{ $data['registration']->name }}</p>
<p><strong>Email:</strong> {{ $data['registration']->email }}</p>

<p><strong>Question: </strong>
    {{ $data['question'] }}
</p>



<a  href="{{ route('admin.users.show', $data['registration']->unique_id) }}"
    target="_blank">View User</a>



<p><strong>Submitted via: </strong> Webianr Portal</p>
