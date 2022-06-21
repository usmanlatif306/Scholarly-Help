<template>
    <div class="row">
        <Writer
            v-for="(writer, index) in writers"
            :key="index"
            :writer="writer"
            :order="order"
        />
    </div>
</template>

<script>
import Writer from "./Writer.vue";
export default {
    components: {
        Writer
    },
    props: ["writers", "order"],
    data() {
        return {};
    }
};
</script>

<style></style>
