{{-- TODO: Replace with dynamic route (https://github.com/orchidsoftware/crud/issues/95) --}}
<ul>
@foreach($model->posts as $post)
    <li><a class="text-primary text-decoration-underline" href="/admin/crud/edit/post-resources/{{ $post->id }}">{{ $post->title }}</a></li>
@endforeach
</ul>
