<template>
    <div class="">
        <div class="col-12 p-0" v-for="writer in writers" :key="writer.id">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <img
                                src="https://www.clipartmax.com/png/middle/171-1717870_stockvader-predicted-cron-for-may-user-profile-icon-png.png"
                                alt="Writer-Image"
                                class="writer-profile-image"
                            />
                            <!-- <a href="" class="text-muted writer-profile-link d-block mt-1">View Profile</a> -->
                        </div>
                        <div class="col-6">
                            <a href="" class="writer-name"
                                >{{ writer.first_name }}
                                {{ writer.last_name }}</a
                            >

                            <span class="writer-order-history d-block"
                                >{{
                                    writer.completed_orders_count +
                                        parseInt(writer.digit)
                                }}
                                completed order</span
                            >
                            <div
                                class="writer-rating"
                                v-if="
                                    writer.completed_orders_count +
                                        parseInt(writer.digit) >
                                        0
                                "
                            >
                                <span class="">100% completation rate</span>
                                <span class="d-block">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-3">
                            <span class="writer-bid-price"
                                >${{
                                    FormatNumber(writer.percentage, order.total)
                                }}</span
                            >
                            <button
                                :disabled="isDisabled"
                                type="submit"
                                class="btn btn-sm btn-warning mr-2 px-3 mt-2"
                                v-on:click.prevent="
                                    HireWriter(
                                        writer.id,
                                        writer.percentage,
                                        FormatNumber(
                                            writer.percentage,
                                            order.total
                                        )
                                    )
                                "
                            >
                                Hire
                            </button>
                            <button
                                type="button"
                                class="btn btn-sm btn-primary mr-2 px-3 mt-2"
                                v-on:click="OpenChat(writer.id)"
                            >
                                Chat
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Chat
            :writers="writers"
            :user="user"
            :add_message_url="add_message_url"
            :get_message_url="get_message_url"
            :change_message_status_url="change_message_status_url"
            :isChatOpen="isChatOpen"
            :isAll="isAll"
            :writer="writer"
            :sound="sound"
        />
    </div>
</template>

<script>
import Axios from "axios";
import Chat from "./Chat.vue";
export default {
    components: {
        Chat
    },
    props: [
        "writers",
        "user",
        "add_message_url",
        "get_message_url",
        "change_message_status_url",
        "order",
        "writer_choose_url",
        "sound"
    ],
    data() {
        return {
            isChatOpen: false,
            isAll: true,
            writer: null,
            isDisabled: false,
            form: {
                staffId: "",
                staffPaymentAmount: "",
                price: ""
            }
        };
    },
    methods: {
        OpenChat(id) {
            this.isChatOpen = true;
            this.isAll = false;
            this.writer = this.writers.find(item => item.id === id);
        },
        FormatNumber(writer, order) {
            let percentage = ((writer / 100) * order).toFixed(2);
            let price = Number(order) + Number(percentage);
            return price.toFixed(2);
        },
        HireWriter(staffId, StaffPayment, total) {
            this.isDisabled = true;
            axios
                .post(this.writer_choose_url, {
                    staff_id: staffId,
                    staff_payment_amount: StaffPayment,
                    price: total
                })
                .then(res => {
                    window.location.href = res.data.redirect_url;
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>

<style></style>
