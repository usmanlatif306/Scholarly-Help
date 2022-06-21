<template>
    <div class="col-md-3 border-right chat-messages writer-web-message">
        <div
            class="user-chat d-flex border-bottom pb-2 cursor-pointer pt-2 pl-2"
            v-for="(user, index) in users"
            :key="index"
            @click="$emit('select-student', user.id)"
        >
            <img
                src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8dXNlciUyMHByb2ZpbGV8ZW58MHx8MHx8&ixlib=rb-1.2.1&w=1000&q=80"
                class="rounded-circle"
                alt="User Profile Picture"
            />
            <h5 class="pt-2 mx-4 font-sm">
                {{ user.user.first_name }} {{ user.user.last_name }}
            </h5>
        </div>
    </div>
</template>

<script>
export default {
    props: ["users"]
};
</script>

<style></style>
