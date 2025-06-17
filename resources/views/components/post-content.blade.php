@props(['post'])

@php $hasBuilderContent = !empty($post->content_builder) && is_array($post->content_builder); @endphp

@if($hasBuilderContent)
    <div class="builder-content space-y-8">
        @foreach($post->content_builder as $block)
            @if(isset($block['type']) && isset($block['data']))
                @switch($block['type'])
                    @case('paragraph')
                        <div class="prose prose-lg max-w-none">{!! $block['data']['content'] ?? '' !!}</div>
                        @break

                    @case('image')
                        <div class="my-8">
                            @if(!empty($block['data']['image']))
                                <div class="text-center">
                                    <img src="{{ asset('storage/' . $block['data']['image']) }}" alt="{{ $block['data']['alt'] ?? '' }}" class="max-w-full h-auto rounded-lg shadow-lg mx-auto" loading="lazy">
                                    @if(!empty($block['data']['caption']))<p class="text-sm text-gray-600 mt-3 italic">{{ $block['data']['caption'] }}</p>@endif
                                </div>
                            @endif
                        </div>
                        @break

                    @case('gallery')
                        <div class="my-8">
                            @if(!empty($block['data']['images']) && is_array($block['data']['images']))
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach($block['data']['images'] as $image)
                                        <div class="aspect-square overflow-hidden rounded-lg">
                                            <img src="{{ asset('storage/' . $image) }}" alt="Gallery image" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300" loading="lazy">
                                        </div>
                                    @endforeach
                                </div>
                                @if(!empty($block['data']['caption']))<p class="text-sm text-gray-600 mt-4 text-center italic">{{ $block['data']['caption'] }}</p>@endif
                            @endif
                        </div>
                        @break

                    @case('quote')
                        <div class="my-8">
                            <blockquote class="border-l-4 border-red-500 bg-red-50 p-6 rounded-r-lg">
                                <p class="text-lg italic text-gray-800 mb-4">"{{ $block['data']['content'] ?? '' }}"</p>
                                @if(!empty($block['data']['author']) || !empty($block['data']['source']))
                                    <footer class="text-sm text-gray-600">
                                        @if(!empty($block['data']['author']))<cite class="font-medium">— {{ $block['data']['author'] }}</cite>@endif
                                        @if(!empty($block['data']['source']))<span class="ml-2">({{ $block['data']['source'] }})</span>@endif
                                    </footer>
                                @endif
                            </blockquote>
                        </div>
                        @break

                    @case('video')
                        <div class="my-8">
                            @if($block['data']['type'] === 'youtube' && !empty($block['data']['url']))
                                @php preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\n?#]+)/', $block['data']['url'], $matches); $videoId = $matches[1] ?? ''; @endphp
                                @if($videoId)<div class="aspect-video"><iframe src="https://www.youtube.com/embed/{{ $videoId }}" class="w-full h-full rounded-lg" frameborder="0" allowfullscreen></iframe></div>@endif
                            @elseif($block['data']['type'] === 'vimeo' && !empty($block['data']['url']))
                                @php preg_match('/vimeo\.com\/(\d+)/', $block['data']['url'], $matches); $videoId = $matches[1] ?? ''; @endphp
                                @if($videoId)<div class="aspect-video"><iframe src="https://player.vimeo.com/video/{{ $videoId }}" class="w-full h-full rounded-lg" frameborder="0" allowfullscreen></iframe></div>@endif
                            @elseif($block['data']['type'] === 'upload' && !empty($block['data']['file']))
                                <div class="aspect-video"><video controls class="w-full h-full rounded-lg"><source src="{{ asset('storage/' . $block['data']['file']) }}" type="video/mp4">Trình duyệt của bạn không hỗ trợ video.</video></div>
                            @endif
                            @if(!empty($block['data']['caption']))<p class="text-sm text-gray-600 mt-3 text-center italic">{{ $block['data']['caption'] }}</p>@endif
                        </div>
                        @break

                    @case('divider')
                        <div class="my-8">
                            @php $style = $block['data']['style'] ?? 'solid'; $borderClass = match($style) { 'dashed' => 'border-dashed', 'dotted' => 'border-dotted', 'double' => 'border-double border-t-4', default => 'border-solid' }; @endphp
                            <hr class="border-gray-300 {{ $borderClass }}">
                        </div>
                        @break

                    @default
                @endswitch
            @endif
        @endforeach
    </div>
@else
    <div class="prose prose-lg max-w-none">{!! $post->content !!}</div>
@endif
