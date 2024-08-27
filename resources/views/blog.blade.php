<x-leaf.theme mode="navbar-light" title="บทความ" description="บทความที่เกี่ยวข้องกับงายวิจัย ความรู้ที่เป็นประโยชน์และต้องการเผยแพร่สู่สาธารณะ" image="https://cdn-images-1.medium.com/max/1024/1*pnw6OuU-R4JXzgUUPWbmbg.jpeg">
    <section class="section section-header">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>บทความ</h1>
                    <p class="mb-0">
                        {{-- Updated August 10th, --}}
                        {{ $blogObject['channel']['lastBuildDate'] }}
                        <span class="current-year"></span>
                    </p>
                    <hr class="my-4" />
                </div>
            </div>
            @php
                $blogs = $blogObject['channel']['item'];
            @endphp

            <div class="row">
                @foreach ($blogs as $item)
                    <div class="col-12 col-lg-6">
                        <div class="blog-card">
                            <div class="card border-0" data-equalize-height="related-news" >
                                <a href="{{ $item['link'] }}" target="_blank">
                                    <img src="{{ $item['image_url'] }}" class="card-img-top" alt="Related news image 1"
                                        height=300>
                                </a>
                                <div class="card-body px-0">
                                    <small class="d-block mb-2">
                                        {{-- January 20, <span class="current-year">2022</span> --}}
                                        {{ $item['pubDate'] }}
                                    </small>
                                    <h2 class="h5">
                                        <a href="{{ $item['link'] }}" target="_blank">{{ $item['title'] }}</a>
                                    </h2>
                                    <p class="card-text my-2">{{ $item['first_paragraph'] }}</p>
                                    <small class="d-block mb-2">
                                        {{-- January 20, <span class="current-year">2022</span> --}}
                                        {{ $item['creator'] }}
                                    </small>
                                </div>
                                <div class="card-footer px-0 pt-0">
                                    <a class="btn btn-sm btn-block btn-primary animate-up-2" href="{{ $item['link'] }}"
                                        target="_blank">
                                        <span class="fas fa-book-open mr-1"></span> Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-leaf.theme>
