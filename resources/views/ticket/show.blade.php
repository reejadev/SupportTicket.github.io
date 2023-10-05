<x-app-layout>



<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 
bg-gray-100 dark:bg-gray-900">




<h1 class="text-white text-lg font-bold">{{$ticket->title}}</h1>
<div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white shadow-md overflow-hidden
sm:rounded-lg">

<div class="flex justify-between py-6">
  <p>{{$ticket->description}}</p>
  <p>{{$ticket->created_at->diffForHumans()}}</p>
  @if($ticket->attachment)
  <a href="{{ '/storage/'.($ticket->attachment) }}" target="_blank">Attachment</a>
  @endif
</div>

<div class="flex justify-between">
<div class="flex">
  <a href="{{ route('ticket.edit', $ticket->id) }}">
<x-primary-button>Edit</x-primary-button>
</a>

<form class="ml-2" action="{{ route('ticket.destroy', $ticket->id) }}"  method="post">
  @method('delete')
  @csrf
<x-primary-button >Delete</x-primary-button>
</form>
</div>
@if(auth()->user()->isAdmin)

<div class="flex">
  <form action="{{ route('ticket.update',$ticket->id) }}" method="post">
  @csrf
  @method('patch')
  <input type="hidden" name="status" value="resolved" />
<x-primary-button>Resolved</x-primary-button>
</form>
<form action="{{ route('ticket.update',$ticket->id) }}" method="post">
  @csrf
@method('patch')
<input type="hidden" name="status" value="rejected" />
<x-primary-button class="ml-2">Reject</x-primary-button>
</form>
</div>
@else
<p >Status: {{ $ticket->status}}</p>
@endif
</div>



<div class="flex">



    <h1  class="text center mt-6 text-lg font-bold ">Add a Reply</h1>
    </div>
    <div class="flex">
    <form method="POST" action="{{ route('replies.store') }}">
        @csrf
        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
        <div class="form-group">
            <textarea name="content" class="form-control" rows="3" required></textarea>
        </div>

        <x-primary-button class="ml-2">Add Reply</x-primary-button>
        <!--button type="submit" class="btn btn-primary">Add Reply</!--button-->
    </form>
</div>


</div>

@if(session()->has('success'))
    <div class="alert alert-success text-white">
        {{ session('success') }}
    </div>
@endif
</div>

</x-app-layout>