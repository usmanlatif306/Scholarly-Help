<template>
    <div class="chat-group p-1">
        <div
            class="chat-group-single mb-1 p-1 rounded px-2 d-flex justify-content-between"
            v-for="writer in writers"
            :key="writer.id"
            @click="$emit('close-all-chats')"
        >
            <p class="m-0 p-0" @click="$emit('select-single-chat', writer.id)">
                {{ writer.first_name }} {{ writer.last_name }}
            </p>
            <small class="unread">{{
                allMessages.filter(
                    item =>
                        !item.isRead &&
                        parseInt(item.user_id) === parseInt(writer.id)
                ).length
            }}</small>
        </div>
    </div>
</template>

<script>
export default {
    props: ["writers", "allMessages"]
};
</script>

<style></style>
