<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-sky-900 leading-tight">
            Los Palmares Palapa Menu Beta Test Comments
        </h2>
    </x-slot>

    <div class="py-12">
    <form action="{{route('comment.store')}}" method="post">
        @csrf

        <div class="flex justify-between mx-2">
            <div class="comment w-10/12 ml-2 mr-1" >
                <textarea name="comment" placeholder="Your Comment" class="w-11/12 mx-2"></textarea>
            </div>
            <div class="initials w-2/12 mr-2">
                <input type="text" name="initials" placeholder="Your Initials" class="w-11/12 mx-2">
            </div>
        </div>
        <div class="button">
            <button type="submit" class="btn btn-success">Add Comment</button>
        </div>

    </form>

    @foreach ($comments as $comment)
        <div class="comments flex justify-between mx-4">
            <span {{$comment->fixed ? 'class=line-through':''}}>{{$comment->comment}}</span>
            <span class="initials">{{$comment->initials}}</span>
            <form action="{{route('comment.update', $comment->id)}}" method="post">
                @method('PATCH')
                @csrf
                <button class="btn btn-primary">Fixed</button>
                <input type="hidden" name="fixed" value="1">
            </form>
        </div>
    @endforeach
  </div>
    </div>
</x-app-layout>