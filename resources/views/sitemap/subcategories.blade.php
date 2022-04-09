<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($subcategories as $category)
        <item>
            <title>{{ $category->title }}</title>
        </item>
    @endforeach
</urlset>