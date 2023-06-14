<x-frontend.master>
    <x-slot:title>
        NSTU Sports
    </x-slot:title>

    <x-frontend.matches.index :currentMatches="$currentMatches" :upcomingMatches="$upcomingMatches" :matchResults="$matchResults" />

    <!-- Recent Notice section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <h2>Recent Notices</h2>
                <div class="col-md-12 mx-auto">
                    <div class="scroll-container" style="max-height: 50rem; overflow-y: scroll;">
                        @forelse ($notices as $notice)
                        <div class="card my-4">
                            <div class="row g-0">
                                <div class="p-2 col-md-2 d-flex justify-content-center align-items-center">
                                    @php
                                        $imgSrc = 'https://placehold.co/180@3x?text=' . $notice->name;
                                        if ($notice->images && $notice->images->first())
                                            $imgSrc = asset('storage/notices/' . $notice->images?->first()?->image);
                                    @endphp
                                    <img src="{{ $imgSrc }}" alt="" class="m-2 img-fluid" width="180px">
                                </div>
                                <div class="col-md-10">
                                    <div class="card-body m-2">
                                        <h5 class="card-title">{{ $notice->updated_at->format('F j, Y g:i A') }}</h5>
                                        <p class="card-text">{{ $notice->name }}</p>
                                        <div class="d-flex w-100 justify-content-between">
                                            <small class="text-muted">Last updated {{ $notice->updated_at->diffForHumans() }}</small>
                                            <a href="{{ route('frontend.notices.show', $notice->slug) }}" class="btn btn-sm btn-outline-primary">More details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p>No notices</p>
                        @endforelse

                        {{--<div class="card m-4">
                            <div class="row g-0">
                                <div class="col-md-2">
                                    <img src="https://via.placeholder.com/400" alt="" class="m-2 img-fluid"
                                        width="180px">
                                </div>
                                <div class="col-md-10">
                                    <div class="card-body m-2">
                                        <h5 class="card-title">Match 1 - April 26, 2023</h5>
                                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Vivamus volutpat faucibus augue vitae maximus. Sed fermentum venenatis
                                            libero a
                                            fringilla. Proin blandit mi sit amet aliquet congue.</p>
                                        <div class="d-flex w-100 justify-content-between">
                                            <small class="text-muted">Last updated 3 mins ago</small>
                                            <a href="#" class="btn btn-sm btn-outline-primary">More details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-frontend.master>
