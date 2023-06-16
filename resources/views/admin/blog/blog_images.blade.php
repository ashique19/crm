@if($photos->total)
<ul class="list-inline">
	@foreach($photos->results as $key=>$photo)
	<li class="list-inline-item blog_images">
		<a href="javascript:void(0);">
			<img src="{{ $photo->urls->regular }}" width="100px;">
		</a>
	</li>
	@endforeach
</ul>
@else
No image found!
@endif