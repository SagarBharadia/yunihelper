@extends('partials.dashboard.master')

@section('content')
  <form method="POST" action="/notes/{{$note->id}}/update">
    {{ csrf_field() }}
    <div class="title">
      <h1>
        <input style="display: inline-block;" name="title" id="title" value="{{$note->title}}" autocomplete="off" required>
      </h1>
      <button type="submit">Update</button>
    </div>
    <div class="info-card-medium">
      <h2>Description</h2>
      <textarea name="description" id="description" required><?php echo "$note->description"; ?></textarea>
    </div><!-- White space remove
    --><div class="info-card-medium margin-right-none">
      <h2>Module</h2>
      <textarea name="module" id="module"><?php echo "$note->module"; ?></textarea>
    </div>
    <div class="info-card-body-text">
      <h2>Body</h2>
      <textarea name="body" id="body" required><?php echo "$note->body"; ?></textarea>
    </div>
  </form>
@endsection

@section('jsimports')
  <script type="text/javascript" src="/js/jquery.xautoresize.min.js"></script>
  <script type="text/javascript">
    $("textarea").xautoresize();
  </script>
@endsection
