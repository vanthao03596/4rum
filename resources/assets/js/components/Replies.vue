<template>
<div>

<div id="commentlist" class="page-content">
    <div class="boxedtitle page-title">
        <h2>Answers ( <span class="color" v-text="repliesCount"></span> )</h2>
    </div>
    <ul class="commentlist clearfix">
        <transition-group name="fade">
        <reply v-if="hasItem" v-for="(item, index) in items"
                :key="item.id"
                :data="item"
                @deleted="remove(index)">
        </reply>
        </transition-group>
    </ul>
</div>
    <a href="#" v-if="hasMore" @click.prevent="loadMore" class="load-questions">
        <vue-simple-spinner v-if="loading" size="medium"></vue-simple-spinner>
        <div v-else>Load More Reply</div>
    </a>
    <new-reply @added="add"></new-reply>
</div>


</template>

<script>
import reply from './Reply';
import NewReply from '../components/NewReply'
import Spinner from 'vue-simple-spinner'
import {scroller} from 'vue-scrollto/src/scrollTo'
export default {
    props : ['initRepliesCount'],
    mounted() {
        if(window.location.hash) {
            const firstScrollTo = scroller()
            firstScrollTo(window.location.hash)
        }

    },
    data() {
        return {
            items : [],
            loading:false,
            setItem : [],
            repliesCount : this.initRepliesCount,
            next_url: false,
            page: 1
        }
    },
    async created() {
        await this.fetch();
    },
    components: {
        Spinner
    },

    methods: {
        fetch() {
            // setTimeout(() => {
                axios.get(this.url())
                .then(this.refresh)

            // }, 1000)

        },
        url() {
            return window.location.pathname + '/replies?page=' + this.page;
        },
        refresh(respone) {
            this.setItem = respone.data
            this.items = this.setItem.data

        },
        loadMore(){
            this.page++
            this.loading = true;
            axios.get(this.url()).then(res => {
                if(res.data.data.length > 0) {
                    this.setItem = res.data
                    this.items.push(...this.setItem.data)
                    this.loading = false
                }
                else {
                    this.loading = false
                }
            })
        },
        remove(index) {
            this.items.splice(index, 1);
            this.repliesCount--;
        },
        add(reply) {
            this.items.push(reply);
            this.repliesCount++
        },
        goto(id) {
            var element = id;
            var top = element.offsetTop;
            window.scrollTo(0, top);
        }
    },
    computed: {
        hasItem() {
            return this.items.length > 0;
        },
        hasMore() {
            return this.next_url;
        }
    },
    watch: {
        setItem() {
            this.next_url = this.setItem.next_page_url,
            this.page = this.setItem.current_page
        }
    },
    components : {
        NewReply : NewReply
    }
}
</script>
<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity 1s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
