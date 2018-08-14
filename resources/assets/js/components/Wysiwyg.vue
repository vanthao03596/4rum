<template>
    <div id="question-details">
        <input id="body" value="Editor content goes here" type="hidden" :name="name">
        <trix-editor ref="trix" input="body"></trix-editor>
    </div>
</template>

<script>
    import Trix from 'trix';
    export default {
        props : ['name']
    }
</script>
