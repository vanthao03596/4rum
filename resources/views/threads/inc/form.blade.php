<div id="respond" class="comment-respond page-content clearfix">
    <div class="boxedtitle page-title"><h2>Leave a reply</h2></div>
    <form action="{{ $thread->path() . '/replies' }}" method="post" id="commentform" class="comment-form">
        @csrf
        <div id="respond-textarea">
            <p>
                <label class="required" for="comment">Comment<span>*</span></label>
                <textarea id="comment" name="message" aria-required="true" cols="58" rows="8"></textarea>
            </p>
        </div>
        <p class="form-submit">
            <input name="submit" type="submit" id="submit" value="Post your answer" class="button small color">
        </p>
    </form>
</div>