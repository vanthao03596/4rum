<div class="col-md-12">
    <div class="page-content page-content-user-profile">
        <div class="user-profile-widget">
            <h2>User Stats</h2>
            <div class="ul_list ul_list-icon-ok">
                <ul>
                    <li><i class="icon-question-sign"></i><a href="{{ route('profile.questions', $user->name)}}">Questions<span> ( <span>{{ $questionsCount }}</span> ) </span></a></li>
                    <li><i class="icon-comment"></i><a href="{{ route('profile.answers', $user->name) }}">Answers<span> ( <span>{{ $answersCount }}</span> ) </span></a></li>
                    <li><i class="icon-star"></i><a href="{{ route('profile.fav_question', $user->name)}}">Favorite Questions<span> ( <span>{{ $favQuestionsCount }}</span> ) </span></a></li>
                    <li><i class="icon-heart"></i><a href="{{ route('profile.points', $user->name) }}">Points<span> ( <span>{{ $totalPoint }}</span> ) </span></a></li>
                    <li><i class="icon-asterisk"></i>Best Answers<span> ( <span>2</span> ) </span></li>
                </ul>
            </div>
        </div><!-- End user-profile-widget -->
    </div><!-- End page-content -->
</div>