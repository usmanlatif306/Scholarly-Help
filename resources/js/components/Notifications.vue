<template>
    <li class="dropdown">
        <audio controls style="display:none" ref="play">
            <source :src="sound" type="audio/ogg" />
        </audio>
        <audio controls style="display:none" muted ref="dom">
            <source src="sound.mp3" type="audio/ogg" />
        </audio>
        <!-- <button class="btn" v-on:click="PlaySound()">Play</button> -->
        <a
            href="#!"
            v-on:click="interectDom()"
            class="dropdown-toggle icon-menu"
            data-toggle="dropdown"
            ><i class="icon-bell far fa fa-bell-o"></i>
            <span class="notification-dot" v-if="messages > 0"></span
        ></a>
        <a
            v-on:click="logout()"
            title="Logout"
            class="icon-menu cursor-pointer cursor"
            ><i class="icon-login fa fa-sign-in"></i
        ></a>

        <ul class="dropdown-menu notifications">
            <li class="header">
                <strong>You have {{ messages }} new Messages</strong>
            </li>
            <li class="footer">
                <a href="#" v-on:click="goInbox()" class="more"
                    >See All Messages</a
                >
            </li>
        </ul>
    </li>
</template>

<script>
export default {
    props: ["get_messages_url", "inbox", "sound", "login_url", "logout_url"],
    mounted() {
        window.setInterval(() => {
            this.old = 0;
            this.fetchMessages();
        }, 3000);
    },
    data() {
        return {
            messages: 0,
            old: 0,
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content")
        };
    },
    created() {
        this.fetchMessages();
    },
    methods: {
        fetchMessages() {
            axios.get(this.get_messages_url).then(response => {
                this.messages = response.data.message;
                if (response.data.message > this.old) {
                    this.PlaySound();
                }
            });
        },
        goInbox() {
            window.location.href = this.inbox;
        },
        PlaySound() {
            this.$refs.play.play();
            this.old = this.messages;
        },
        interectDom() {
            this.$refs.dom.play();
        },
        logout() {
            axios.post(this.logout_url).then(response => {
                window.location.href = this.login_url;
            });
        }
    }
};
</script>

<style></style>
