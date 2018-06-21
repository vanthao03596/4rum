<template>

</template>
<script>
import Replies from '../components/Replies'
export default {
    props : ['initRepliesCount'],
    data() {
        return {
            repliesCount : this.initRepliesCount
        }
    }
}
</script>
