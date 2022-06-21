<template>
    <div v-if="loading" class="mt-3 text-center">Fetching...</div>
    <div v-else>
        <div v-if="activities.length > 0" class="mt-2">
            <div
                class="media mb-2"
                style="display:block;"
                v-for="(activity, index) in activities"
                :key="index"
            >
                <div class="media-body">
                    <a :href="activity.user_profile">{{
                        activity.user_name
                    }}</a>
                    has <span v-html="activity.description"></span>
                </div>
                <small class="text-muted">
                    {{ activity.created_at }}
                </small>
            </div>
        </div>
        <div v-else class="mt-3">
            No activity
        </div>
    </div>
</template>

<script>
export default {
    props: ["fetch_activities"],
    mounted() {
        window.setInterval(() => {
            this.fetchActivities();
        }, 5000);
    },
    data() {
        return {
            activities: [],
            loading: true
        };
    },
    created() {
        this.fetchActivities();
    },
    methods: {
        fetchActivities() {
            axios.get(this.fetch_activities).then(response => {
                this.activities = response.data;
                this.loading = false;
            });
        }
    }
};
</script>

<style></style>
