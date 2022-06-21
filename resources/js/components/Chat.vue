<template>
    <div>
        <div
            class="chat-window-option-choose py-2 px-2 d-flex justify-content-between"
            @click="isChatOpen = true"
        >
            <p class="p-0 m-0">Chat with Tutors</p>
            <i class="fas fa-comments"></i>
        </div>
        <div class="chat-window-option" v-if="isChatOpen">
            <div
                class="chat-window-open py-2 px-2 text-white d-flex justify-content-between"
            >
                <p class="p-0 m-0 font-weight-bold text-center">All Chats</p>
                <span @click="isChatOpen = false"
                    ><i class="fas fa-times"></i
                ></span>
            </div>

            <div class="chat-group-wrapper pt-2 px-1">
                <!-- Showing all chats -->
                <div v-if="isAll">
                    <AllChats
                        @close-all-chats="isAll = false"
                        @select-single-chat="selectWriter($event)"
                        :writers="writers"
                        :allMessages="allMessages"
                    />
                </div>

                <!-- showing single chat -->
                <div v-if="!isAll">
                    <Single
                        @close-single-chat="(isAll = true), (writer = null)"
                        :user="user"
                        :writer="writer"
                        :add_message_url="add_message_url"
                        :messages="messages"
                        :sound="sound"
                        v-on:message-send="fetchMessages()"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AllChats from "./chat/AllChats.vue";
import Single from "./chat/Single.vue";
export default {
    components: {
        AllChats,
        Single
    },
    props: [
        "writers",
        "user",
        "add_message_url",
        "get_message_url",
        "change_message_status_url",
        "isChatOpen",
        "isAll",
        "writer",
        "sound"
    ],
    // computed: {
    //     isChatOpen: function() {
    //         return isChatOpen;
    //     }
    // },
    mounted() {
        window.setInterval(() => {
            this.fetchMessages();
        }, 3000);
    },

    data() {
        return {
            allMessages: [],
            messages: []
        };
    },
    created() {
        this.fetchMessages();
    },
    methods: {
        selectWriter(id) {
            const select = this.writers.find(item => item.id === id);
            this.writer = select;
            this.filterMessages();
        },
        fetchMessages() {
            axios.get(this.get_message_url).then(response => {
                // this.allMessages = response.data;
                let newArr = response.data.map(item => {
                    return {
                        ...item,
                        isRead: item.status === 0 ? false : true
                    };
                });
                this.allMessages = newArr;
                if (this.writer) {
                    this.filterMessages();
                }
            });
        },
        filterMessages() {
            let messageFilters = this.allMessages.filter(
                item =>
                    (parseInt(item.user_id) === parseInt(this.user.id) &&
                        parseInt(item.receiver_id) ===
                            parseInt(this.writer.id)) ||
                    (parseInt(item.user_id) === parseInt(this.writer.id) &&
                        parseInt(item.receiver_id) === parseInt(this.user.id))
            );
            this.messages = messageFilters;
            // filtering unread messages
            if (this.writer) {
                let unreadMessages = messageFilters.filter(
                    item =>
                        !item.isRead &&
                        parseInt(item.user_id) === parseInt(this.writer.id)
                );
                if (unreadMessages.length > 0) {
                    this.changeMessageStatus(unreadMessages);
                }
            }
        },
        // changing status of unread messages to read in db
        changeMessageStatus(unreadMessages) {
            axios
                .post(this.change_message_status_url, { data: unreadMessages })
                .then(response => {
                    this.fetchMessages();
                    // console.log(response.data);
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>

<style></style>
