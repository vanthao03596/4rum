<template>
<div>
    <p v-if="!signedIn" class="text-center">Please <a :href="'/login'">sign in</a> to participate
    <div v-else id="respond" class="comment-respond page-content clearfix">
        <div class="boxedtitle page-title"><h2>Leave a reply</h2></div>
        <form action="endpoint" method="post" id="commentform" class="comment-form">
            <div id="respond-textarea">
                <p>
                    <label class="required" for="comment">Comment<span>*</span></label>
                    <at-ta :members="members" name-key="name" v-model="message" @change="test1">
                        <template slot="item" slot-scope="s" >
                            <img :src="s.item.avatar">
                            <span v-text="s.item.name"></span>
                        </template>
                        <textarea
                            cols="58"
                            rows="8"
                            id="comment"
                            aria-required="true"
                            required
                            >
                            </textarea>
                    </at-ta>
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
import AtTa from 'vue-at/dist/vue-at-textarea'
export default {
    components: { AtTa },
    data() {
        return {
            'message' : '',
            members: []
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
    mounted() {
        this.getUser()
    },
    // mounted() {
    //     $('#comment').atwho({
    //             at: "@",
    //             delay: 750,
    //             limit : 5,
    //             callbacks: {
    //                 remoteFilter: function(query, callback) {
    //                     $.getJSON("/user/search", {q: query}, function(data) {
    //                         console.log(data);
    //                     });

    //                 }
    //             }
    //         })
    // },
    methods: {
        addReply() {
            if(this.message != '')
            {
                axios.post(this.endpoint, {'message' : this.message})
                .then(res => {
                    this.message = ''
                    toastr.success('Your reply has been posted !');
                    this.$emit('added', res.data);
                })
            }
        },
        test1() {
            console.log('ok');
        },
        getUser() {
            axios.get('/users').then(res => {
              this.members = res.data
            })
        }
    }
}
</script>


<style scoped>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
  margin-top: 30px;
}
.tag {
  border-radius: 5px;
  background: beige;
  border: 1ps outset yellow;
}
.editor {
  width: 400px;
  height: 200px;
  overflow: auto;
  white-space: pre-wrap;
  border: solid 2px rgba(0,0,0,.5);
}
.avatar {
  max-width: 1em;
  vertical-align: middle;
}

/* override styles */
#app .atwho-li {
  padding: 0 4px;
}
#app .atwho-li img {
  height: 100%;
  width: auto;
  -webkit-transform: scale(.8);
}
#app .atwho-li span {
  padding-left: 8px;
}
#app .atwho-wrap {
  vertical-align: top;
  margin-top: 30px;
}
</style>
