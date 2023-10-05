<x-app-layout>

<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 
bg-gray-100 dark:bg-gray-900">

<div class="flex justify-between w-full sm:max-w-xl">

<h1 class="text-white text-lg font-bold">Support Tickets</h1>

<div >
<a href="{{route('ticket.create')}}" class="bg-white rounded-lg p-2">Create New</a>
</div>

</div>
<div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white shadow-md overflow-hidden
sm:rounded-lg">


@forelse ($tickets as $ticket)
<div class="flex justify-between py-6">
<p>{{$ticket->id}}</p>
 <a href="{{ route('ticket.show',$ticket->id) }}"> {{$ticket->title}}</a>
 
  <p>{{$ticket->created_at->diffForHumans()}}</p>
  </div>
    @empty
    <p>No Support tickets</p>

@endforelse
<!-- @if(count($tickets)===0)
@endif -->
</div>
</div>
</x-app-layout>