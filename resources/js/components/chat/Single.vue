<template>
    <div class="single-chat">
        <div
            class="chat-back-option px-1 pb-2"
            @click="$emit('close-single-chat')"
        >
            <span><i class="fas fa-chevron-left"></i></span>
            <span>Back to all chatss</span>
        </div>
        <div class="chat-group chat-user-name p-2">
            <span class="font-weight-bold"
                >{{ writer.first_name }} {{ writer.last_name }}</span
            >
        </div>
        <!-- messages -->
        <div class="chat-messages">
            <!-- <div
                class="chat-message my-message writer-message m-1 mb-2 p-1 rounded d-flex justify-content-between"
            >
                <span>Hello</span>
                <span>12:56 pm</span>
            </div> -->
            <div
                class="chat-message m-1 mb-2 p-1 rounded d-flex justify-content-between"
                v-for="message in messages"
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
                <small class="mt-1">{{ message.created_at }}</small>
            </div>
        </div>
        <div class="chat-input">
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
                                    <form @submit.prevent="handleFileSubmit">
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
        <audio controls style="display:none" ref="play">
            <source :src="sound" type="audio/ogg" />
        </audio>
    </div>
</template>

<script>
export default {
    props: ["user", "writer", "add_message_url", "messages", "sound"],
    data() {
        return {
            showModal: false,
            file: null,
            loading: false,
            message: ""
        };
    },

    methods: {
        handleSubmit() {
            axios
                .post(this.add_message_url, {
                    receiverId: this.writer.id,
                    message: this.message
                })
                .then(response => {
                    this.message = "";
                    this.$emit("message-send");
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
            formData.append("receiverId", this.writer.id);
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
        }
    }
};
</script>

<style></style>
