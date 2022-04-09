<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($posts as $post)
        <item>
            <title>{{ $post->title }}</title>
            <pubDate>{{ $post->created_at->tz('UTC')->toAtomString() }}</pubDate>
            <description>{{ $post->description }}</description>
            <link>{{ route('frontend.details',[$post->id,$post->slug])}}</link>
        </item>
    @endforeach
</urlset>