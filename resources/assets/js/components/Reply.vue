<template>
  <li class="comment">
    <div id="'reply-' + id" class="comment-body clearfix">
      <div class="avatar">
        <a :href="'/profiles/' + data.owner.name" :original-title="data.owner.name" class="tooltip-n">
          <img alt="">
        </a>
      </div>
      <div class="comment-text">
        <div class="author clearfix">
          <div class="comment-author">
            <a :href="'/profiles/' + data.owner.name" v-text="data.owner.name"></a>
          </div>
          <!-- @auth -->
          <favorite :reply="data"></favorite>
          <!-- @endauth -->
          <div class="comment-meta">
            <div class="date">
              <i class="icon-time"></i>{{ data.created_at }}</div>
          </div>
          <a class="comment-reply" href="single_question.html#">
            <i class="icon-reply"></i>Reply</a>
        </div>
        <div class="text">
          <div v-if="editing">
            <textarea style="width: 100%;" v-model="message"></textarea>
            <button class="button mini blue-button" @click="update">Update</button>
            <button class="button mini" @click="cancel">Cancel</button>
          </div>
          <div v-else>
            <p v-text="message"></p>
          </div>
          <button class="button mini blue-button" v-if="!editing" @click="editing = true">Edit</button>
          <button class="button mini red-button" v-if="!editing" @click="destroy">Delete</button>

        </div>
      </div>

    </div>
    <!-- @if (isset($comments[$comment->id]))
        @include('threads.inc.comments.comment_child', ['collection' => $comments[$comment->id]])
    @endif -->
  </li>
</template>

<script>
  import favorite from "./Favorite.vue";
  export default {
    props: ["data"],
    data() {
      return {
        editing: false,
        message: this.data.message,
        id: this.data.id
      };
    },
    methods: {
      update() {
        axios.patch("/replies/" + this.data.id, {
          message: this.message
        });
        this.editing = false;
        toastr.success("Updated comment successfully!", "System");
      },
      cancel() {
        this.editing = false;
        this.message = this.data.message;
      },
      destroy() {
        swal({
          title: "Are you sure?",
          width: 600,
          padding: "3em",
          backdrop: `
            rgba(0,0,123,0.4)
            url("/images/giphy.webp")
            center left
            no-repeat
        `,
          text: "You won't be able to revert this!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
        }).then(result => {
          if (result.value) {
            axios.delete("/replies/" + this.data.id).then((success) => {

            });
            this.$emit("deleted", this.data.id);
            swal("Deleted!", "Your comment has been deleted.", "success");

            // $(this.$el).fadeOut(300, () => {
            // swal("Deleted!", "Your comment has been deleted.", "success");
            // });
          }
        });
      }
    }
  };
</script>