<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<?php echo '<?xml-stylesheet type="text/xsl" href="'.asset("css/sitemap.xsl").'"?>'?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	@foreach ($data['routes'] as $name => $value)
	<url>
		<loc>{{ route($name,$value['route']) }}</loc>
		@if($value['date'])
		<lastmod>{{ $value['date']->tz('UTC')->toAtomString() }}</lastmod>
		@endif
	</url>
	@endforeach
	@foreach ($data['sub_pages'] as $page)
	<url>
		<loc>{{ route($page['route'],$page['slug']) }}</loc>
		@if($page['date'])
		<lastmod>{{ $page['date']->tz('UTC')->toAtomString() }}</lastmod>
		@endif
	</url>
	@endforeach
</urlset>