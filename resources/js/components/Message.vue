<template>
    <div class="row h-secreen">
        <!-- <Users :users="users" @select-student="selectUser($event)" /> -->
        <div class="col-md-3 border-right chat-messages writer-web-message">
            <div
                class="user-chat d-flex align-items-center border-bottom pb-2 cursor-pointer pt-2 pl-2"
                v-for="(user, index) in users"
                :key="index"
                @click="selectUser(user.id)"
            >
                <img
                    :src="imageUrl(user.photo)"
                    class="rounded-circle"
                    alt="User Profile Picture"
                />
                <h5 class="pt-2 mx-4 font-sm">
                    {{ user.first_name }} {{ user.last_name }}
                </h5>

                <small class="unread" v-if="messages.length > 0">{{
                    messages.filter(
                        item =>
                            !item.isRead &&
                            parseInt(item.user_id) === parseInt(user.id)
                    ).length
                }}</small>
            </div>
        </div>
        <div class="col-md-9" v-if="student">
            <h5>{{ student.first_name }} {{ student.last_name }}</h5>
            <div class="chat-messages writer-web-message">
                <div
                    class="chat-message m-1 mb-2 p-1 rounded d-flex justify-content-between"
                    v-for="message in userMessages"
                    :key="message.id"
                    :class="
                        message.user_id === user.id
                            ? 'my-message'
                            : 'writer-message'
                    "
                >
                    <img
                        :src="message.message"
                        alt=""
                        class="message-image"
                        v-if="message.type === 'image'"
                    />
                    <a
                        :href="message.message"
                        style="color:#fff"
                        v-else-if="message.type === 'file'"
                        download=""
                        ><i class="far fa-file-alt mr-2"></i
                        >{{ message.file_name }}</a
                    >
                    <span v-else>{{ message.message }}</span>
                    <!-- <small class="mt-1">{{
                        new Date(message.created_at).toLocaleTimeString(
                            "en-US",
                            {
                                hour: "2-digit",
                                minute: "2-digit"
                            }
                        )
                    }}</small> -->
                    <small class="mt-1">{{ message.created_at }}</small>
                </div>
            </div>

            <div class="chat-input chat-writer-input">
                <form @submit.prevent="handleSubmit" class="d-flex">
                    <span
                        @click="showModal = true"
                        class="attachment"
                        title="attachment"
                        ><i class="fas fa-link"></i
                    ></span>
                    <input
                        type="text"
                        placeholder="Write your message"
                        v-model="message"
                    />
                    <button type="submit" class="chat-send-msg-panel__btn">
                        Send
                    </button>
                </form>
            </div>
            <!-- modal -->
            <div v-if="showModal">
                <transition name="modal">
                    <div class="modal-mask">
                        <div class="modal-wrapper">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            Upload Attachment
                                        </h5>
                                        <button
                                            type="button"
                                            class="close"
                                            data-dismiss="modal"
                                            aria-label="Close"
                                        >
                                            <span
                                                aria-hidden="true"
                                                @click="showModal = false"
                                                >&times;</span
                                            >
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form
                                            @submit.prevent="handleFileSubmit"
                                        >
                                            <div class="row">
                                                <div class="col-9">
                                                    <input
                                                        type="file"
                                                        ref="fileRef"
                                                        class="form-control"
                                                    />
                                                </div>
                                                <div class="col-3">
                                                    <button
                                                        :disabled="loading"
                                                        type="submit"
                                                        class="btn btn-primary"
                                                    >
                                                        Send
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
        <audio controls style="display:none" ref="play">
            <source :src="sound" type="audio/ogg" />
        </audio>
    </div>
</template>

<script>
import Users from "./Messages/Users.vue";
export default {
    components: {
        Users
    },
    props: [
        "get_all_message",
        "add_message_url",
        "user",
        "change_message_status_url",
        "sound"
    ],

    mounted: function() {
        window.setInterval(() => {
            this.fetchMessages();
        }, 3000);
    },
    created() {
        this.fetchMessages();
    },
    data() {
        return {
            showModal: false,
            student: null,
            users: [],
            messages: [],
            userMessages: [],
            message: "",
            file: null,
            loading: false
        };
    },
    methods: {
        imageUrl(url) {
            return location.origin + "/storage/" + url;
        },
        handleSubmit() {
            axios
                .post(this.add_message_url, {
                    receiverId: this.student.id,
                    message: this.message
                })
                .then(response => {
                    this.message = "";
                    // this.$emit("message-send");
                    this.fetchMessages();
                    this.$refs.play.play();
                })
                .catch(error => {
                    console.log(error);
                });
        },
        handleFileSubmit() {
            this.loading = true;
            this.file = this.$refs.fileRef.files[0];
            let formData = new FormData();
            formData.append("receiverId", this.student.id);
            formData.append("file", this.file);
            var $scope = this;
            axios
                .post(this.add_message_url, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data"
                    }
                })
                .then(res => {
                    this.loading = false;
                    $scope.showModal = false;
                })
                .catch(function(error) {
                    this.loading = false;
                    console.log(error);
                    alert("Something went wrongs");
                });
        },
        fetchMessages() {
            axios.get(this.get_all_message).then(response => {
                this.users = response.data.users;
                let newArr = response.data.messages.map(item => {
                    return {
                        ...item,
                        isRead: item.status === 0 ? false : true
                    };
                });
                this.messages = newArr;
                if (this.student) {
                    this.filterMessages();
                }
            });
        },

        selectUser(id) {
            const select = this.users.find(item => item.id === id);
            this.student = select;
            this.filterMessages();
        },
        filterMessages() {
            let messageFilter = this.messages.filter(
                item =>
                    (parseInt(item.user_id) === parseInt(this.user.id) &&
                        parseInt(item.receiver_id) ===
                            parseInt(this.student.id)) ||
                    (parseInt(item.user_id) === parseInt(this.student.id) &&
                        parseInt(item.receiver_id) === parseInt(this.user.id))
            );
            this.userMessages = messageFilter;
            if (this.student) {
                let unreadMessages = messageFilter.filter(
                    item =>
                        !item.isRead &&
                        parseInt(item.user_id) === parseInt(this.student.id)
                );
                if (unreadMessages.length > 0) {
                    this.changeMessageStatus(unreadMessages);
                }
            }
        },
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
