<template>
<div>
    <p v-if="!signedIn" class="text-center">Please <a :href="'/login'">sign in</a> to participate
    <div v-else id="respond" class="comment-respond page-content clearfix">
        <div class="boxedtitle page-title"><h2>Leave a reply</h2></div>
        <form action="endpoint" method="post" id="commentform" class="comment-form">
            <div id="respond-textarea">
                <p>
                    <label class="required" for="comment">Comment<span>*</span></label>
                    <textarea 
                    id="comment" 
                    name="message" 
                    aria-required="true" 
                    cols="58" 
                    rows="8"
                    v-model="message"></textarea>
                </p>
            </div>
            <p class="form-submit">
                <input name="submit" @click.prevent="addReply" type="submit" id="submit" value="Post your answer" class="button small color">
            </p>
        </form>
    </div>
</div>

</template>
<script>
export default {
    data() {
        return {
            'message' : ''
        }
    },
    computed : {
        endpoint() {
            return window.location.pathname + '/replies';
        },
        signedIn() {
            return window.App.signedIn;
        },
    },
    methods: {
        addReply() {
            axios.post(this.endpoint, {'message' : this.message})
            .then(res => {
                this.message = ''
                toastr.success('Your reply has been posted !');
                this.$emit('added', res.data);
            })
        }
    }
}
</script>
