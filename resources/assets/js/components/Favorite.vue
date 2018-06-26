<template>
<div>
    <div class="comment-vote">
        <ul class="single-question-vote" style="width:70px">
            <li>
                <a href="/" class="single-question-vote-down" title="Dislike"><i class="icon-thumbs-down"></i></a>
            </li>
            <li v-if="signedIn">
                <a href="#" :class="classes" @click.prevent="toogle" title="Like">
                    <i class="icon-thumbs-up"></i>
                </a>

            </li>
        </ul>
    </div>
    <span class="question-vote-result">+{{ favoritedCount }}</span>
</div>

</template>
<script>
export default {
    props: ['reply'],
    data() {
        return {
            favoritedCount : this.reply.favorites_count,
            isFavorited : this.reply.isFavorited
        }
    },
    computed: {
        classes() {
            return ['single-question-vote-up', this.isFavorited ? 'like' : ''];
        },
        endpoint() {
            return '/replies/' + this.reply.id + '/favorites';
        },
        signedIn() {
            return window.App.signedIn;
        },
        

    },
    methods: {
        toogle() {
            return this.isFavorited ? this.destroy() : this.create()
        },
        destroy() {
            axios.delete(this.endpoint)
            this.isFavorited = false
            this.favoritedCount--
        },
        create() {
            axios.post(this.endpoint)
            this.isFavorited = true
            this.favoritedCount++
        }
    }
};
</script>
