@extends('layouts.master')
@section('breadcrumbs', Breadcrumbs::render('home'))
@section('content')
<section class="container main-content">
    <div class="row">
        <ais-index
        app-id="{{ config('scout.algolia.id') }}"
        api-key="{{ config('scout.algolia.secret') }}"
        index-name="threads"
        query = {{ request('q') }}
      >

            <div class="col-md-9">
                <ais-stats>
                    <template slot-scope="{ totalResults, processingTime, query, resultStart, resultEnd }">
                        <h3>Showing @{{ resultStart }} - @{{ resultEnd }} of @{{ totalResults }} results. Your query: <b>@{{ query }}</b> took @{{ processingTime }}ms</h3>
                      </template>
                </ais-stats>
                <ais-results>
                  <template slot-scope="{ result }">
                    {{-- <p>
                        <a :href="result.path">
                            <ais-highlight :result="result" attribute-name="title"></ais-highlight>
                        </a>
                    </p> --}}
                    <article class="question question-type-normal">
                        <h2>
                        <a :href="result.path">
                            <ais-highlight :result="result" attribute-name="title"></ais-highlight>
                        </a>
                        </h2>
                        <a class="question-report" href="index_no_box.html#">Report</a>
                        <div class="question-type-main"><i class="icon-question-sign"></i>Question</div>
                        <div class="question-author">
                            <a :href="'/profile/' + result.creator.name" :original-title="result.creator.name" class="tooltip-n"><img :src="'/storage/' + result.creator.profile.avatar" /></a>
                        </div>
                        <div class="question-inner">
                            <div class="clearfix"></div>
                            <p class="question-desc"><ais-highlight :result="result" attribute-name="body"></ais-highlight></p>
                            <div class="question-details">
                                {{-- <span class="question-favorite"><i class="icon-star"></i>5</span> --}}
                            </div>
                            <span class="question-category"><a :href="result.channel.name"><i class="icon-folder-close"></i>@{{ result.channel.name }}</a></span>
                            <span class="question-date"><i class="icon-time"></i>@{{ result.created_at }}</span>
                            <span class="question-comment"><a href="#"><i class="icon-comment"></i>@{{ result.replies_count }} Answer</a></span>
                            <span class="question-view"><i class="icon-user"></i>@{{ result.view_count }} views</span>
                            <div class="clearfix"></div>
                        </div>
                    </article>
                  </template>
                </ais-results>
                <ais-no-results>

                </ais-no-results>
                <ais-pagination inline-template>
                    <div class="pagination" v-show="totalResults > 0">
                          <a :class="[bem('item', 'previous'), page === 1 ? bem('item', 'disabled', false) : '']" href="#" @click.prevent="goToPreviousPage" :class="bem('link')">
                            <slot name="previous">&lt;</slot>
                          </a>
                          <span v-for="item in pages" :key="item" :class="[bem('item'), page === item ? 'current' : '']" href="#" @click.prevent="goToPage(item)" :class="bem('link')">
                            <slot :value="item" :active="item === page">
                              @{{ item }}
                            </slot>
                          </span>
                          <a :class="[bem('item', 'next'), page >= totalPages ? bem('item', 'disabled', false) : '']":class="[bem('item', 'next'), page >= totalPages ? bem('item', 'disabled', false) : '']" href="#" @click.prevent="goToNextPage" :class="bem('link')">
                            <slot name="next">&gt;</slot>
                          </a>
                      </div>
                </ais-pagination>

        </div><!-- End main -->
        @include('partials.sidebar')<!-- End sidebar -->
        </ais-index>
    </div><!-- End row -->
</section>
@stop


