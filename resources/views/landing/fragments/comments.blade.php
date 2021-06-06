<div>
    <h2 class="text-center"> لیست کامنت ها </h2>
    <hr>
    @foreach ($list as $comment)
        <div class="alert alert-info my-2">
            {{$comment->text}}
            <hr>
            {{persianDate($comment->created_at)}}
        </div>
    @endforeach
    <h5 class="my-3"> در صورت تمایل میتوانید کامنت بذارید </h5>
    <form action="{{route('comment.store')}}" method="post">
        @csrf
        <input type="hidden" name="owner_id" value="{{$owener_id}}">
        <input type="hidden" name="owner_type" value="{{$owner_type}}">
        <textarea name="text" class="form-control my-2" rows="4" placeholder="متن کامنت"></textarea>
        <div class="text-center">
            <button type="submit" class="btn btn-primary"> تایید </button>
        </div>
    </form>
</div>
