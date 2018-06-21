<template>
<ul class="commentlist clearfix">
    <reply v-for="(item, index) in items"
            :key="index"
            :data="item"
            @deleted="remove(index)">
    </reply>
</ul>
</template>

<script>
import reply from './Reply';
export default {
    props : ['data'],
    data() {
        return {
            items : this.data
        }
    },
    methods: {
        remove(index) {
            this.items.splice(this.items.indexOf(index), 1);
            this.$emit('removed');
        }
    }
}
</script>
