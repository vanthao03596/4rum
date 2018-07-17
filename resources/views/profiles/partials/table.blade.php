<div class="page-content">
    <div class="user-stats">
        <div class="user-stats-head">
            <div class="block-stats-1 stats-head">#</div>
            <div class="block-stats-2 stats-head">Today</div>
            <div class="block-stats-3 stats-head">Month</div>
            <div class="block-stats-4 stats-head">Total</div>
        </div>
        <div class="user-stats-item">
            <div class="block-stats-1">Questions</div>
            <div class="block-stats-2">{{ $table['questionToday']}}</div>
            <div class="block-stats-3">{{ $table['questionMonth']}}</div>
            <div class="block-stats-4">{{ $table['totalQuestion']}}</div>
        </div>
        <div class="user-stats-item">
            <div class="block-stats-1">Answers</div>
            <div class="block-stats-2">{{ $table['answerToday']}}</div>
            <div class="block-stats-3">{{ $table['answerMonth']}}</div>
            <div class="block-stats-4">{{ $table['totalAnswer']}}</div>
        </div>
        <div class="user-stats-item user-stats-item-last">
            <div class="block-stats-1">Visitors</div>
            <div class="block-stats-2">100</div>
            <div class="block-stats-3">3000</div>
            <div class="block-stats-4">5000</div>
        </div>
    </div>
    <!-- End user-stats -->
</div>